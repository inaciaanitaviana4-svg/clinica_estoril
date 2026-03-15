<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Notificacao;

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
}
