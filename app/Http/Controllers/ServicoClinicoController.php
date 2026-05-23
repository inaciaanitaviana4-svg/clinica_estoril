<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use App\Models\Medico;
use App\Models\ServicoClinico;
use App\Models\ServicoClinicoEspecialidade;
use App\Models\TipoConsulta;
use DB;
use Illuminate\Http\Request;

class ServicoClinicoController extends Controller
{
    public function mostrar_registro_servico_clinico_admin($id_servico_clinico = null)
    {
        $servico_clinico = ServicoClinico::find($id_servico_clinico);
        if ($id_servico_clinico && ! $servico_clinico) {
            return redirect()->back()->with('error', 'servico_clinico não encontrada');
        }
        $tipos_consulta = TipoConsulta::all();
        $especialidades = Especialidade::where('activo', true)->get();

        return view('admin.servico_clinico_registro', compact('servico_clinico', 'tipos_consulta', 'especialidades'));
    }

    public function salvar_registro_servico_clinico_admin(Request $request, $id_servico_clinico = null)
    {
        $servico_clinico = ServicoClinico::find($id_servico_clinico);
        if ($id_servico_clinico && ! $servico_clinico) {
            return redirect()->back()->with('error', 'servico_clinico não encontrada');
        }
        try {
            DB::beginTransaction();
            if ($id_servico_clinico) {
                $servico_clinico->nome = $request->nome;
                $servico_clinico->id_tipo_consulta = $request->id_tipo_consulta;
                $servico_clinico->duracao_min = $request->duracao_min;
                $servico_clinico->preco = $request->preco;
                $servico_clinico->activo = $request->boolean('activo');
                $servico_clinico->possui_horario = $request->boolean('possui_horario');
                $servico_clinico->save();
            } else {
                $servico_clinico = ServicoClinico::create([
                    'nome' => $request->nome,
                    'id_tipo_consulta' => $request->id_tipo_consulta,
                    'duracao_min' => $request->duracao_min,
                    'preco' => $request->preco,
                    'activo' => $request->boolean('activo'),
                    'possui_horario' => $request->boolean('possui_horario'),
                ]);

            }
            $especialidades_ids = array_map(function ($especialidade) use ($servico_clinico) {
                $es['id_especialidade'] = $especialidade;
                $es['id_servico_clinico'] = $servico_clinico->id_servico_clinico;

                return $es;
            }, $request->input('especialidades', []));

            ServicoClinicoEspecialidade::where('id_servico_clinico', $servico_clinico->id_servico_clinico)->delete();
            ServicoClinicoEspecialidade::insert($especialidades_ids);
            DB::commit();

        } catch (\Throwable $th) {
            DB::rollback();

            return redirect()->back()->with('error', $th->getMessage());
        }

        return redirect(route('mostrar_cadastros_admin'));

    }

    public function remover_servico_clinico_admin($id_servico_clinico = null)
    {
        $servico_clinico = ServicoClinico::find($id_servico_clinico);
        if (! $servico_clinico) {

            return response()->json(['erro' => 'servico_clinico nao encontrada'], 404);

        }
        ServicoClinico::destroy($id_servico_clinico);

        return response()->json(['mensagem' => 'servico_clinico removida com secesso'], 200);

    }

    public function api_obter_servicos_clinicos(Request $request)
    {
        $tipo_consulta_id = $request->get('tipo_consulta_id');
        $servicos_clinicos = ServicoClinico::where('activo', true);

        if ($tipo_consulta_id) {
            $servicos_clinicos = $servicos_clinicos->where('id_tipo_consulta', $tipo_consulta_id);
        }

        $servicos_clinicos = $servicos_clinicos->get();

        return response()->json($servicos_clinicos);
    }

    public function api_listar_medicos_servico_clinico(Request $request)
    {
        $id_servico_clinico = $request->get('id_servico_clinico');
        if (! $id_servico_clinico) {
            return response()->json(['erro' => 'id_servico_clinico é obrigatório', 'medicos' => []], 400);
        }
        $medicos_sem_especialidade = Medico::where('especialidade', '=', 'Nenhuma')->select('medico.id_medico', 'medico.nome', 'medico.especialidade')->get()->toArray();
        $especialidades_total = ServicoClinicoEspecialidade::where('id_servico_clinico', $id_servico_clinico)->count();
        if ($especialidades_total == 0) {
            return response()->json(['erro' => 'Nenhuma especialidade associada a este serviço clínico', 'medicos' => $medicos_sem_especialidade], 404);
        }
        $medicos = Medico::join('especialidades', 'medico.especialidade', 'especialidades.nome')
            ->join('servicos_clinicos_especialidades', 'especialidades.id_espec', 'servicos_clinicos_especialidades.id_especialidade')
            ->where('servicos_clinicos_especialidades.id_servico_clinico', $id_servico_clinico)
            // ->where(function ($query) use ($id_servico_clinico) {
               // $query->where();
           // })
            ->select('medico.id_medico', 'medico.nome', 'medico.especialidade')
            ->distinct()
            ->get()
            ->toArray();

        return response()->json(['medicos' => array_merge($medicos_sem_especialidade, $medicos)], 200);
    }
}
