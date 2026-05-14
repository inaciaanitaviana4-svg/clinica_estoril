<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function mostrar_horarios_medico()
    {
        $utilizador = verificar_medico();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $horarios = Horario::where('id_medico', $utilizador->id_medico)->get();

        return view('medicos.horarios', compact('horarios'));
    }

    public function mostrar_horarios_recepcionista()
    {
        $utilizador = verificar_recepcionista();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $horarios = Horario::select('horarios.*', 'medico.nome as nome_medico')
            ->join('medico', 'horarios.id_medico', '=', 'medico.id_medico')
            ->get();

        return view('recepcionistas.horarios', compact('horarios'));
    }

    public function salvar_horarios_medico(Request $request)
    {
        $utilizador = verificar_medico();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $id_horario = $request->id_horario ?? null;
        if ($id_horario) {
            $horario = Horario::find($id_horario);
            if (! $horario) {
                return back()->with('erro', 'Horario não encontrado');
            }
            $horario->dia_semana = $request->dia_semana;
            $horario->hora = $request->hora;
            $horario->activo = $request->boolean('activo');
            $horario->save();
        } else {
            Horario::create([
                'id_medico' => $utilizador->id_medico,
                'dia_semana' => $request->dia_semana,
                'hora' => $request->hora,
                'activo' => $request->boolean('activo'),
            ]);
        }

        return redirect(route('mostrar_horarios_medico'))->with('mensagem', 'Horario salvo com sucesso');
    }

    public function remover_horario_medico_recepcionista($id_horario)
    {
        $utilizador = verificar_recepcionista();
        if (! $utilizador) {
            return response()->json(['erro' => 'Não tem permissão para acessar esta API'], status: 403);
        }
        $horario = Horario::find($id_horario);
        if (! $horario) {
            return response()->json(['erro' => 'horario não encontrado '], 404);
        }
        $horario->delete();

        return response()->json(['mensagem' => 'horario removido com secesso'], 200);

    }

    public function api_listar_horarios_medico(Request $request)
    {
        $id_medico = $request->query('id_medico');
        $id_servico_clinico = $request->query('id_servico_clinico');
        if (! $id_medico && ! $id_servico_clinico) {
            return response()->json(['erro' => 'deve fornecer id_medico ou id_servico_clinico'], 400);
        }
        $horarios = [];
        if ($id_servico_clinico) {
            $horarios = Horario::select('horarios.*')
                ->join('medico', 'horarios.id_medico', '=', 'medico.id_medico')
                ->join('especialidades', 'medico.especialidade', '=', 'especialidades.nome')
                ->join('servicos_clinicos_especialidades', 'especialidades.id_espec', '=', 'servicos_clinicos_especialidades.id_especialidade')
                ->where('servicos_clinicos_especialidades.id_servico_clinico', $id_servico_clinico)
                ->where('horarios.activo', true)
                ->distinct()
                ->get();
        } elseif ($id_medico) {
            $horarios = Horario::where('id_medico', $id_medico)->where('activo', true)->get();
        }
        $horariototal = count($horarios);
        if ($horariototal == 0) {
            return response()->json(['erro' => 'Nenhum horário ativo encontrado para este médico'], 404);
        }

        return response()->json($horarios);
    }
}