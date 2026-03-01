<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Diagnostico;
use App\Models\ExameSolicitado;
use App\Models\Paciente;
use App\Models\Receita;
use App\Models\ReceitaItem;

class ProntuarioController extends Controller
{
    public function mostrar_prontuarios_medico()
    {
        $utilizador = verificar_medico();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $pacientes = Paciente::join('consultas', 'paciente.id_paciente', '=', 'consultas.id_paciente')
            ->where('consultas.id_medico', '=', $utilizador->id_medico)
            ->select('paciente.*')
            ->distinct()->get();

        return view('medicos.prontuarios', compact('pacientes'));
    }

    public function mostrar_detalhes_prontuario_medico($id_paciente)
    {
        $paciente = Paciente::find($id_paciente);
        if (!$paciente) {
            return back()->with('erro', 'Paciente não encontrado');
        }

        $consultas = Consulta::select("consultas.*", "medico.nome AS nome_medico")
            ->join("medico", "consultas.id_medico", "=", "medico.id_medico")
            ->where('id_paciente', $id_paciente)
            ->get();

        $totalConsultas = $consultas->count();

        return view('medicos.detalhes_prontuario', compact('paciente', 'consultas', 'totalConsultas'));
    }

    public function api_buscar_consultas_prontuario_medico($id_consulta)
    {
        $utilizador = verificar_medico();
        if (! $utilizador) {
            return response()->json(['erro' => 'Não tem permissão para acessar esta API'], 403);
        }

        $consulta = Consulta::select("consultas.*", "medico.nome AS medico")
            ->join("medico", "consultas.id_medico", "=", "medico.id_medico")
            ->where('id_consulta', $id_consulta)
            ->first();

        if (!$consulta) {
            return response()->json(['erro' => 'Consulta não encontrada'], 404);
        }

        $diagnosticos = Diagnostico::where('id_consulta', $id_consulta)
            ->select('descricao')
            ->get()
            ->toArray();

        $exames = ExameSolicitado::where('id_consulta', $id_consulta)
            ->select('exames_solicitados.*', 'servicos_clinicos.nome as servico_clinico')
            ->join('servicos_clinicos', 'exames_solicitados.id_servico_clinico', '=', 'servicos_clinicos.id_servico_clinico')
            ->get()
            ->toArray();

        $receitas = Receita::where('id_consulta', $id_consulta)
            ->select('receitas.*')
            ->get()
            ->toArray();

        $receitas = array_map(function ($receita) {
            $itens = ReceitaItem::where('id_receita', $receita['id_receita'])
                ->select('medicamento', 'dosagem', 'frequencia', 'duracao')
                ->get()
                ->toArray();

            $receita['itens'] = array_map(function ($item) {
                return [
                    'medicamento' => $item['medicamento'],
                    'dosagem' => $item['dosagem'],
                    'frequencia' => $item['frequencia'],
                    'duracao' => $item['duracao']
                ];
            }, $itens);

            return $receita;
        }, $receitas);

        $resultado = [
            ...$consulta->toArray(),
            "diagnosticos" => $diagnosticos,
            "exames" => $exames,
            "receitas" => $receitas
        ];

        return response()->json($resultado);
    }
}
