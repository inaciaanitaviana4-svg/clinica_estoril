<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
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
                $servico_clinico->save();
            } else {
                $servico_clinico = ServicoClinico::create([
                    'nome' => $request->nome,
                    'id_tipo_consulta' => $request->id_tipo_consulta,
                    'duracao_min' => $request->duracao_min,
                    'preco' => $request->preco,
                    'activo' => $request->boolean('activo'),

                ]);

            }
            $especialidades_ids = array_map(function ($especialidade)use ($servico_clinico) {
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
}
