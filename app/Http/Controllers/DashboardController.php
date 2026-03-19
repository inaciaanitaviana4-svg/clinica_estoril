<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Horario;
use App\Models\Medico;
use App\Models\Notificacao;
use App\Models\Paciente;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function mostrar_dashboard_medico()
    {
        return view('dashboard.medico');
    }

    public function mostrar_dashboard_recepcionista()
    {
        return view('dashboard.recepcionista');
    }

    public function mostrar_dashboard_paciente()
    {
        return view('dashboard.paciente');

    }

    public function api_obter_dados_dashboard_paciente()
    {
        $paciente = verificar_paciente();
        if (! $paciente) {
            return response()->json(['erro' => 'Não tem permissão para acessar esta API'], status: 403);
        }
        $stats = [
            'total' => Consulta::where('id_paciente', $paciente->id_paciente)->count(),
            'agendadas' => Consulta::where('id_paciente', $paciente->id_paciente)->where('estado', 'agendada')->count(),
            'concluidas' => Consulta::where('id_paciente', $paciente->id_paciente)->where('estado', 'concluida')->count(),

        ];
        $proxima_consulta = Consulta::select('consultas.*',
            'medico.nome as medico',
            'servicos_clinicos.nome as servico_clinico',
            'tipos_consultas.nome as tipo_consulta')
            ->join('medico', 'medico.id_medico', '=', 'consultas.id_medico')
            ->join('servicos_clinicos', 'servicos_clinicos.id_servico_clinico', '=', 'consultas.id_servico_clinico')
            ->join('tipos_consultas', 'tipos_consultas.id_tipo_consulta', '=', 'consultas.id_tipo_consulta')
            ->where('consultas.id_paciente', $paciente->id_paciente)->where('consultas.estado', 'agendada')->orderBy('consultas.data', 'asc')->first();
        $consultas = Consulta::select('consultas.*',
            'medico.nome as medico',
            'servicos_clinicos.nome as servico_clinico',
            'tipos_consultas.nome as tipo_consulta')
            ->join('medico', 'medico.id_medico', '=', 'consultas.id_medico')
            ->join('servicos_clinicos', 'servicos_clinicos.id_servico_clinico', '=', 'consultas.id_servico_clinico')
            ->join('tipos_consultas', 'tipos_consultas.id_tipo_consulta', '=', 'consultas.id_tipo_consulta')
            ->where('consultas.id_paciente', $paciente->id_paciente)
            ->orderBy('consultas.data', 'asc')->get()->toArray();
        $noficacoes = Notificacao::select('notificacoes.*', 'notificacoes.id_notificacao as id')
            ->where('id_util', $paciente->id_util)->get()->toArray();

        return response()->json([
            'paciente' => $paciente,
            'stats' => $stats,
            'proxima_consulta' => $proxima_consulta,
            'consultas' => $consultas,
            'notificacoes' => $noficacoes,
        ]);
    }

    public function api_obter_dados_dashboard_medico()
    {
        $utilizador = verificar_medico();
        if (! $utilizador) {
            return response()->json(['erro' => 'Não tem permissão para acessar esta API'], status: 403);
        }

        $hoje = Carbon::today();
        $mesAtual = Carbon::now()->month;
        $anoAtual = Carbon::now()->year;
        $medico = Medico::find($utilizador->id_medico);
        $stats = [
            'hoje' => Consulta::where('id_medico', $utilizador->id_medico)->where('estado', 'confirmada')->whereDate('data', $hoje)->whereYear('data', $anoAtual)->whereMonth('data', $mesAtual)->count(),
            'mes' => Consulta::where('id_medico', $utilizador->id_medico)->where('estado', 'confirmada')->whereYear('data', $anoAtual)->whereMonth('data', $mesAtual)->count(),
            'pacientes_atendidos' => Paciente::join('consultas',
                'consultas.id_paciente',
                '=',
                'paciente.id_paciente')
                ->where('consultas.id_medico', $utilizador->id_medico)
                ->where('consultas.estado', 'concluida')
                ->distinct()
                ->count(),
            'concluidas_mes' => Consulta::where('id_medico', $utilizador->id_medico)->where('estado', 'concluida')->whereYear('data', $anoAtual)->whereMonth('data', $mesAtual)->count(),
        ];
        $agenda_hoje = Consulta::select('consultas.*', 'paciente.nome as paciente', 'servicos_clinicos.nome as servico_clinico', 'tipos_consultas.nome as tipo_consulta')
            ->join('servicos_clinicos', 'servicos_clinicos.id_servico_clinico', '=', 'consultas.id_servico_clinico')
            ->join('tipos_consultas', 'tipos_consultas.id_tipo_consulta', '=', 'consultas.id_tipo_consulta')
            ->join('paciente', 'consultas.id_paciente', '=', 'paciente.id_paciente')
            ->where('consultas.id_medico', $utilizador->id_medico)
            ->where('consultas.estado', 'confirmada')
            ->whereDate('consultas.data', $hoje)
            ->whereYear('consultas.data', $anoAtual)
            ->whereMonth('consultas.data', $mesAtual)
            ->get()
            ->toArray();
        $horarios = Horario::where('id_medico', $utilizador->id_medico)->where('activo', true)->get()->toArray();
        $pacientes_recentes = Paciente::join('consultas', 'consultas.id_paciente', '=', 'paciente.id_paciente')
            ->where('consultas.id_medico', $utilizador->id_medico)
            ->where('consultas.estado', 'concluida')
            ->distinct()
            ->orderBy('consultas.data', 'desc')
            ->limit(5)
            ->get()
            ->toArray();
        $pacientes_recentes = array_map(function ($paciente) {
            $total_consultas = Consulta::where('id_paciente', $paciente['id_paciente'])->where('estado', 'concluida')->count();
            $paciente['total_consultas'] = $total_consultas;
            $paciente['ultima_data'] = Consulta::where('id_paciente', $paciente['id_paciente'])->where('estado', 'concluida')->orderBy('data', 'desc')->first()->data ?? null;

            return $paciente;
        }, $pacientes_recentes);

        return response()->json([
            'medico' => $medico,
            'stats' => $stats,
            'agenda_hoje' => $agenda_hoje,
            'horarios' => $horarios,
            'pacientes_recentes' => $pacientes_recentes,
        ]);
    }
}
