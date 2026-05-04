<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Especialidade;
use App\Models\Medico;
use App\Models\MetodoPagamento;
use App\Models\Paciente;
use App\Models\Pagamento;
use App\Models\recepcionista;
use App\Models\ServicoClinico;
use App\Models\TipoConsulta;
use App\Models\Utilizador;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    private function verificar_admin()
    {
        if (! session('id_utilizador')) {
            return false;
        }
        $utilizador = Utilizador::find(session('id_utilizador'));
        if (! $utilizador) {
            return false;
        }
        if (! $utilizador->id_admi) {
            return false;
        }
        if ($utilizador->nivel_acesso != 0) {
            return false;
        }

        return true;
    }

    public function mostrar_dashboard_admin()
    {
        if (! $this->verificar_admin()) {
            return redirect('/login');
        }

        $hoje = Carbon::today();
        $mesAtual = Carbon::now()->month;
        $anoAtual = Carbon::now()->year;
        $mesAnterior = Carbon::now()->subMonth();

        // ════════════════════════════════════════════════════
        // 1. TOTAL DE PACIENTES
        // ════════════════════════════════════════════════════
        $totalPacientes = Paciente::count();
        $totalPacientes = [
            'total' => $totalPacientes,
        ];

        // ════════════════════════════════════════════════════
        // 2. TOTAL DE CONSULTAS
        // ════════════════════════════════════════════════════
        $consultasMesAtual = Consulta::whereMonth('data', $mesAtual)
            ->whereYear('data', $anoAtual)
            ->count();
        $consultasMesAnterior = Consulta::whereMonth('data', $mesAnterior->month)
            ->whereYear('data', $mesAnterior->year)
            ->count();
        $consultasHoje = Consulta::whereDate('data', $hoje)->count();

        $percentagemConsultas = $consultasMesAnterior > 0
            ? round((($consultasMesAtual - $consultasMesAnterior) / $consultasMesAnterior) * 100, 1)
            : ($consultasMesAtual > 0 ? 100.0 : 0.0);

        $totalConsultas = [
            'total_mes' => $consultasMesAtual,
            'total_hoje' => $consultasHoje,
            'percentagem' => $percentagemConsultas,
        ];

        // ════════════════════════════════════════════════════
        // 3. TOTAL DE PAGAMENTOS (RECEITA DO MÊS)
        // ════════════════════════════════════════════════════
        $receitaMesAtual = Pagamento::whereMonth('data', $mesAtual)
            ->whereYear('data', $anoAtual)
            ->where('estado', 'sucesso')
            ->sum('total_pago');

        $receitaMesAnterior = Pagamento::whereMonth('data', $mesAnterior->month)
            ->whereYear('data', $mesAnterior->year)
            ->where('estado', 'sucesso')
            ->sum('total_pago');

        $percentagemReceita = $receitaMesAnterior > 0
            ? round((($receitaMesAtual - $receitaMesAnterior) / $receitaMesAnterior) * 100, 1)
            : ($receitaMesAtual > 0 ? 100.0 : 0.0);

        $totalPagamentos = [
            'receita_mes' => round($receitaMesAtual, 2),
            'percentagem' => $percentagemReceita,
        ];

        // ════════════════════════════════════════════════════
        // 4. MÉDICOS ACTIVOS + ESPECIALIDADES
        // ════════════════════════════════════════════════════

        // Assumindo que médico tem campo "activo" ou podemos contar pelo utilizadores
        // Caso não exista campo activo em medico, remova o where
        $totalMedicosActivos = Medico::count();
        // Se tiver campo activo: Medico::where('activo', true)->count();

        // Especialidades distintas dos médicos activos
        $totalEspecialidades = Medico::distinct('especialidade')
            ->whereNotNull('especialidade')
            ->count('especialidade');

        // Médicos do mês anterior para percentagem
        $medicosMesAnterior = 0; // Médicos raramente têm created_at relevante; ajuste se necessário
        $percentagemMedicos = 0.0;

        $totalMedicos = [
            'total_medicos_activos' => $totalMedicosActivos,
            'total_especialidades' => $totalEspecialidades,
            'percentagem' => $percentagemMedicos,
        ];

        // ════════════════════════════════════════════════════
        // 10. RESUMO DO SISTEMA
        // ════════════════════════════════════════════════════
        $resumoSistema = [
            'especialidades' => Especialidade::where('activo', true)->count(),
            'tipos_consulta' => TipoConsulta::count(),
            'recepcionistas' => recepcionista::count(),
            'metodos_pagamento' => MetodoPagamento::count(),
        ];

        return view('admin.dashboard', compact('totalPacientes', 'totalConsultas', 'totalPagamentos', 'totalMedicos', 'resumoSistema'));
    }

    /**
     * Retorna todos os dados necessários para o Dashboard.
     */
    public function api_obter_dados_dashboard()
    {

        // ════════════════════════════════════════════════════
        // 5. CONSULTAS DOS ÚLTIMOS 6 MESES (concluída / agendada)
        // ════════════════════════════════════════════════════
        $consultasPorMes = [];
        $meses_pt = [
            1 => 'Jan',
            2 => 'Fev',
            3 => 'Mar',
            4 => 'Abr',
            5 => 'Mai',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Ago',
            9 => 'Set',
            10 => 'Out',
            11 => 'Nov',
            12 => 'Dez',
        ];
        $agora = Carbon::now();
        for ($i = 5; $i >= 0; $i--) {
            $periodo = $agora->copy()->subMonths($i); // Meses passados
            $m = $periodo->month;
            $a = $periodo->year;
            $chave = $meses_pt[$m].'/'.$periodo->format('y'); // ex: "Jan/25"

            [$concluidas, $agendadas] = [
                Consulta::whereMonth('data', $m)->whereYear('data', $a)->where('estado', 'concluida')->count(),
                Consulta::whereMonth('data', $m)->whereYear('data', $a)->where('estado', 'agendada')->count(),
            ];

            $consultasPorMes[] = [$chave => [
                'concluidas' => $concluidas,
                'agendadas' => $agendadas,
            ]];
        }

        // ════════════════════════════════════════════════════
        // 6. PAGAMENTOS POR MÉTODO DE PAGAMENTO
        // ════════════════════════════════════════════════════
        $pagamentosPorMetodo = Pagamento::select(
            'metodos_pagamentos.nome as metodo_pagamento',
            DB::raw('SUM(pagamentos.total_pago) as total')
        )
            ->join('metodos_pagamentos', 'pagamentos.id_metodo_pagamento', '=', 'metodos_pagamentos.id_metodo_pagamento')
            ->where('pagamentos.estado', 'pago')
            ->groupBy('metodos_pagamentos.nome')
            ->orderByDesc('total')
            ->get()
            ->map(fn ($r) => [
                'metodo_pagamento' => $r->metodo_pagamento,
                'total' => round($r->total, 2),
            ])
            ->toArray();

        // ════════════════════════════════════════════════════
        // 7. CONSULTAS RECENTES
        // ════════════════════════════════════════════════════
        $consultasRecentes = Consulta::select(
            'consultas.id_consulta',
            'paciente.nome as paciente',
            'medico.nome as medico',
            'consultas.data',
            'consultas.hora',
            'consultas.estado'
        )
            ->join('paciente', 'consultas.id_paciente', '=', 'paciente.id_paciente')
            ->join('medico', 'consultas.id_medico', '=', 'medico.id_medico')
            ->orderByDesc('consultas.data')
            ->orderByDesc('consultas.hora')
            ->limit(10)
            ->get()
            ->map(fn ($r) => [
                'id' => $r->id_consulta,
                'paciente' => $r->paciente,
                'medico' => $r->medico,
                'data' => $r->data,
                'hora' => $r->hora,
                'estado' => $r->estado,
            ])
            ->toArray();

        // ════════════════════════════════════════════════════
        // 8. TOP MÉDICOS POR CONSULTAS REALIZADAS
        // ════════════════════════════════════════════════════
        $topMedicos = Medico::select(
            'medico.nome as medico',
            'medico.especialidade',
            DB::raw('COUNT(consultas.id_consulta) as consultas')
        )
            ->leftJoin('consultas', 'medico.id_medico', '=', 'consultas.id_medico')
            ->groupBy('medico.id_medico', 'medico.nome', 'medico.especialidade')
            ->orderByDesc('consultas')
            ->limit(10)
            ->get()
            ->map(fn ($r) => [
                'medico' => $r->medico,
                'especialidade' => $r->especialidade ?? '—',
                'consultas' => (int) $r->consultas,
            ])
            ->toArray();

        // ════════════════════════════════════════════════════
        // 9. SERVIÇOS MAIS USADOS
        // ════════════════════════════════════════════════════
        $servicosMaisUsados = ServicoClinico::select(
            'servicos_clinicos.nome as servico',
            DB::raw('COUNT(consultas.id_consulta) as total')
        )
            ->leftJoin('consultas', 'servicos_clinicos.id_servico_clinico', '=', 'consultas.id_servico_clinico')
            ->groupBy('servicos_clinicos.id_servico_clinico', 'servicos_clinicos.nome')
            ->orderByDesc('total')
            ->limit(8)
            ->get()
            ->map(fn ($r) => [
                'servico' => $r->servico,
                'total' => (int) $r->total,
            ])
            ->toArray();

        // ════════════════════════════════════════════════════
        // 11. PAGAMENTOS RECENTES
        // ════════════════════════════════════════════════════
        $pagamentosRecentes = Pagamento::select(
            'pagamentos.id_pagamento',
            'paciente.nome as paciente',
            'pagamentos.data',
            'metodos_pagamentos.nome as metodo_pagamento',
            'recepcionista.nome as recepcionista',
            'pagamentos.total_pago as total',
            'pagamentos.estado'
        )
            ->join('paciente', 'pagamentos.id_paciente', '=', 'paciente.id_paciente')
            ->join('metodos_pagamentos', 'pagamentos.id_metodo_pagamento', '=', 'metodos_pagamentos.id_metodo_pagamento')
            ->join('recepcionista', 'pagamentos.id_recepcionista', '=', 'recepcionista.id_recepcionista')
            ->orderByDesc('pagamentos.data')
            ->limit(10)
            ->get()
            ->map(fn ($r) => [
                'id' => $r->id_pagamento,
                'paciente' => $r->paciente,
                'data' => $r->data,
                'metodo_pagamento' => $r->metodo_pagamento,
                'recepcionista' => $r->recepcionista,
                'total' => round($r->total, 2),
                'estado' => $r->estado,
            ])
            ->toArray();

        $metodos = Pagamento::select(
            'metodos_pagamentos.nome',
            DB::raw('SUM(pagamentos.total_pago) as total')
        )
            ->join('metodos_pagamentos', 'pagamentos.id_metodo_pagamento', '=', 'metodos_pagamentos.id_metodo_pagamento')
            ->where('pagamentos.estado', 'sucesso')
            ->groupBy('metodos_pagamentos.id_metodo_pagamento', 'metodos_pagamentos.nome')
            ->orderByDesc('total')
            ->get()
            ->map(fn ($r) => [
                'nome' => $r->nome,
                'total' => round($r->total, 2),
            ])->toArray();

        // ════════════════════════════════════════════════════
        // RETORNO FINAL
        // ════════════════════════════════════════════════════
        return response()->json([
            'consultas_por_mes' => $consultasPorMes,
            'pagamentos_por_metodo' => $pagamentosPorMetodo,
            'consultas_recentes' => $consultasRecentes,
            'top_medicos' => $topMedicos,
            'servicos_mais_usados' => $servicosMaisUsados,
            'pagamentos_recentes' => $pagamentosRecentes,
            'total_metodo_pagamento' => $metodos,
        ]);
    }

    public function mostrar_pagamentos_admin(Request $request)
    {
        if (! $this->verificar_admin()) {
            return redirect('/login');
        }
        $pesquisar_pagamentos = $request->query('pesquisar_pagamentos') ?? '';
        $pagamentos = Pagamento::select('pagamentos.*', 'paciente.nome as nome_paciente', 'metodos_pagamentos.nome as metodo_pagamento', 'recepcionista.nome as nome_recepcionista')
            ->join('recepcionista', 'pagamentos.id_recepcionista', '=', 'recepcionista.id_recepcionista')
            ->join('paciente', 'pagamentos.id_paciente', '=', 'paciente.id_paciente')
            ->join('metodos_pagamentos', 'pagamentos.id_metodo_pagamento', '=', 'metodos_pagamentos.id_metodo_pagamento')
            ->where(function ($query) use ($pesquisar_pagamentos) {
                $query->where('paciente.nome', 'like', "%$pesquisar_pagamentos%")
                    ->orWhere('pagamentos.data', 'like', "%$pesquisar_pagamentos%")
                    ->orWhere('metodos_pagamentos.nome', 'like', "%$pesquisar_pagamentos%")
                    ->orWhere('recepcionista.nome', 'like', "%$pesquisar_pagamentos%")
                    ->orWhere('pagamentos.total_pago', 'like', "%$pesquisar_pagamentos%")
                    ->orWhere('pagamentos.estado', 'like', "%$pesquisar_pagamentos%");

            })
            ->paginate(10);

        return view('admin.pagamentos', compact('pagamentos'));
    }

   public function mostrar_cadastros_admin(Request $request)
{
    if (!$this->verificar_admin()) {
        return redirect('/login');
    }

    $pesquisar   = $request->query('pesquisar_utilizador') ?? '';
    $tab         = $request->query('tab') ?? '0'; // ← garante valor padrão

    $utilizadores = Utilizador::where('id_util', '<>', session('id_utilizador'))
        ->where(function ($query) use ($pesquisar) {
            $query->where('nome', 'like', "%$pesquisar%")
                  ->orWhere('email', 'like', "%$pesquisar%")
                  ->orWhere('num_telefone', 'like', "%$pesquisar%");
        })->paginate(10, ['*'], 'users_page')->appends(request()->input());

    $pesquisar_especialidade = $request->query('pesquisar_especialidade') ?? '';
    $especialidades = Especialidade::where('nome', 'like', "%$pesquisar_especialidade%")
        ->paginate(10, ['*'], 'especialidades_page')->appends(request()->input());

    $pesquisar_tipo_consulta = $request->query('pesquisar_tipo_consulta') ?? '';
    $tipo_consultas = TipoConsulta::where('nome', 'like', "%$pesquisar_tipo_consulta%")
        ->paginate(10, ['*'], 'consultas_page')->appends(request()->input());

    $pesquisar_servico_clinico = $request->query('pesquisar_servico_clinico') ?? '';
    $servicos_clinicos = ServicoClinico::select('servicos_clinicos.*', 'tipos_consultas.nome as tipo_consulta')
        ->join('tipos_consultas', 'tipos_consultas.id_tipo_consulta', '=', 'servicos_clinicos.id_tipo_consulta')
        ->where('servicos_clinicos.nome', 'like', "%$pesquisar_servico_clinico%")
        ->paginate(10, ['*'], 'servicos_page')->appends(request()->input());

    // ← Adiciona $tab ao compact
    return view('admin.cadastros', compact(
        'utilizadores', 'especialidades', 'tipo_consultas', 'servicos_clinicos', 'tab'
    ));
}

    public function mostrar_consultas_admin(Request $request)
    {
        if (! $this->verificar_admin()) {
            return redirect('/login');
        }
        $pesquisar_consultas = $request->query('pesquisar_consultas') ?? '';
        $consultas = Consulta::select(
            'consultas.id_consulta',
            'tipos_consultas.nome as tipo_consulta',
            'consultas.modalidade',
            'consultas.data',
            'consultas.hora',
            'consultas.estado',
            'paciente.nome as nome_paciente',
            'medico.nome as nome_medico',
            'recepcionista.nome as nome_recepcionista',
            'servicos_clinicos.nome as nome_servico_clinico',
            'servicos_clinicos.preco as preco_servico_clinico'
        )
            ->join('paciente', 'consultas.id_paciente', '=', 'paciente.id_paciente')
            ->join('medico', 'consultas.id_medico', '=', 'medico.id_medico')
            ->join('recepcionista', 'consultas.id_recepcionista', '=', 'recepcionista.id_recepcionista')
            ->leftJoin('servicos_clinicos', 'consultas.id_servico_clinico', '=', 'servicos_clinicos.id_servico_clinico')
            ->leftJoin('tipos_consultas', 'consultas.id_tipo_consulta', '=', 'tipos_consultas.id_tipo_consulta')
            ->whereIn('estado', ['agendada', 'concluida', 'em_andamento', 'confirmada'])
            ->where(function ($query) use ($pesquisar_consultas) {
                $query->where('tipos_consultas.nome', 'like', "%$pesquisar_consultas%")
                    ->orWhere('servicos_clinicos.nome', 'like', "%$pesquisar_consultas%")
                    ->orWhere('paciente.nome', 'like', "%$pesquisar_consultas%")
                    ->orWhere('medico.nome', 'like', "%$pesquisar_consultas%")
                    ->orWhere('recepcionista.nome', 'like', "%$pesquisar_consultas%")
                    ->orWhere('servicos_clinicos.preco', 'like', "%$pesquisar_consultas%")
                    ->orWhere('consultas.data', 'like', "%$pesquisar_consultas%")
                    ->orWhere('consultas.hora', 'like', "%$pesquisar_consultas%")
                    ->orWhere('consultas.estado', 'like', "%$pesquisar_consultas%");

            })
            ->orderBy('data', 'asc')
            ->orderBy('hora', 'asc')
            ->paginate(10);

        return view('admin.consultas', compact('consultas'));
    }

    public function mostrar_prontuarios_admin()
    {
        if (! $this->verificar_admin()) {
            return redirect('/login');
        }

        return view('admin.prontuarios');
    }
}
