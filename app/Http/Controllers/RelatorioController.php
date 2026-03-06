<?php

namespace App\Http\Controllers;

use App\Models\Clinica;
use App\Models\Consulta;
use App\Models\Diagnostico;
use App\Models\ExameSolicitado;
use App\Models\Paciente;
use App\Models\Receita;
use App\Models\ReceitaItem;
use App\Models\recepcionista;
use App\Models\ServicoClinico;
use App\Models\TipoConsulta;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function mostrar_relatorios_medico()
    {
        $utilizador = verificar_medico();
        if (! $utilizador) {
            return back()->with('erro', 'não tem permissão para acessar essa pagina ');
        }
        $pacientes = Paciente::join('consultas', 'paciente.id_paciente', '=', 'consultas.id_paciente')
            ->where('consultas.id_medico', '=', $utilizador->id_medico)
            ->select('paciente.*')
            ->distinct()->get();
        $recepcionistas = recepcionista::join('consultas', 'recepcionista.id_recepcionista', '=', 'consultas.id_recepcionista')
            ->where('consultas.id_medico', '=', $utilizador->id_medico)
            ->select('recepcionista.*')
            ->distinct()->get();

        $tipos_consultas = TipoConsulta::join('consultas', 'tipos_consultas.id_tipo_consulta', '=', 'consultas.id_tipo_consulta')
            ->where('consultas.id_medico', '=', $utilizador->id_medico)
            ->select('tipos_consultas.*')
            ->distinct()->get();
        $servicos_clinicos = ServicoClinico::join('consultas', 'servicos_clinicos.id_servico_clinico', '=', 'consultas.id_servico_clinico')
            ->where('consultas.id_medico', '=', $utilizador->id_medico)
            ->select('servicos_clinicos.*')
            ->distinct()->get();
        $clinica = Clinica::first();

        return view('medicos.relatorios', compact('pacientes', 'recepcionistas', 'tipos_consultas', 'servicos_clinicos', 'clinica'));
    }

    public function api_relatorio_consultas(Request $request)
    {
        $medico = verificar_medico();
        $admin = verificar_admin();
        if (! $medico && ! $admin) {
            return response()->json(['erro' => 'Não tem permissão para acessar este relatório'], status: 403);
        }

        $query = Consulta::select('consultas.*',
            'paciente.nome as paciente',
            'medico.nome as medico',
            'tipos_consultas.nome as tipo_consulta',
            'servicos_clinicos.nome as servico_clinico',
            'recepcionista.nome as recepcionista')
            ->join('medico', 'consultas.id_medico', '=', 'medico.id_medico')
            ->join('tipos_consultas', 'consultas.id_tipo_consulta', '=', 'tipos_consultas.id_tipo_consulta')
            ->join('servicos_clinicos', 'consultas.id_servico_clinico', '=', 'servicos_clinicos.id_servico_clinico')
            ->join('recepcionista', 'consultas.id_recepcionista', '=', 'recepcionista.id_recepcionista')
            ->join('paciente',
                'consultas.id_paciente',
                '=',
                'paciente.id_paciente');

        // Filtros dinâmicos
        if ($medico || $request->id_medico) {
            $query->where('consultas.id_medico', $medico->id_medico ?? $request->id_medico);
        }

        if ($request->id_paciente) {
            $query->where('consultas.id_paciente', $request->id_paciente);
        }

        if ($request->estado) {
            $query->where('consultas.estado', $request->estado);
        }

        if ($request->id_recepcionista) {
            $query->where('consultas.id_recepcionista', $request->id_recepcionista);
        }

        if ($request->id_tipo_consulta) {
            $query->where('consultas.id_tipo_consulta', $request->id_tipo_consulta);
        }

        if ($request->id_servico_clinico) {
            $query->where('consultas.id_servico_clinico', $request->id_servico_clinico);
        }

        if ($request->data_inicio && $request->data_fim) {
            $query->whereBetween('consultas.data', [$request->data_inicio, $request->data_fim]);
        }

        $consultas = $query->orderBy('consultas.data', 'desc')->get();

        return response()->json($consultas);
    }

    public function api_relatorio_prontuario_paciente($id_paciente)
    {
        $paciente = Paciente::find($id_paciente);
        if (! $paciente) {
            return response()->json(['erro' => 'Paciente nao encontrado'], status: 404);
        }
        $consultas = Consulta::where('id_paciente', $id_paciente)->get()->toArray();
        $consultas = array_map(function ($consulta) {
            $id_consulta = $consulta['id_consulta'];
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
                        'duracao' => $item['duracao'],
                    ];
                }, $itens);

                return $receita;
            }, $receitas);

            return [
                ...$consulta,
                'diagnosticos' => $diagnosticos,
                'exames' => $exames,
                'receitas' => $receitas,
            ];
        }, $consultas);
        $resultado = [
            ...$paciente->toArray(),
            'consultas' => $consultas,
        ];

        return response()->json($resultado);

    }
}
