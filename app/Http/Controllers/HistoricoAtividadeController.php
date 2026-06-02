<?php

namespace App\Http\Controllers;

use App\Models\HistoricoAtividade;
use App\Models\Utilizador;
use Illuminate\Http\Request;

class HistoricoAtividadeController extends Controller
{
    // ──────────────────────────────────────────────────────────
    // VERIFICAÇÃO DE ACESSO
    // ──────────────────────────────────────────────────────────
    private function verificar_admin(): bool
    {
        if (!session('id_utilizador')) return false;
        $utilizador = Utilizador::find(session('id_utilizador'));
        if (!$utilizador) return false;
        if (!$utilizador->id_admi) return false;
        if ($utilizador->nivel_acesso != 0) return false;
        return true;
    }

    // ──────────────────────────────────────────────────────────
    // VIEW PRINCIPAL
    // ──────────────────────────────────────────────────────────
    public function mostrar_historico_admin(Request $request)
    {
        if (!$this->verificar_admin()) {
            return redirect('/login');
        }

        // Contadores por categoria (para os cards de topo)
        $totalRegistos    = HistoricoAtividade::where('categoria', 'registro')->count();
        $totalConsultas   = HistoricoAtividade::where('categoria', 'consulta')->count();
        $totalAtualizacoes = HistoricoAtividade::where('categoria', 'atualizacao')->count();
        $totalPagamentos  = HistoricoAtividade::where('categoria', 'pagamento')->count();

        return view('admin.historico_atividade', compact(
            'totalRegistos',
            'totalConsultas',
            'totalAtualizacoes',
            'totalPagamentos'
        ));
    }

    // ──────────────────────────────────────────────────────────
    // API — LISTAGEM COM FILTROS E PAGINAÇÃO
    // ──────────────────────────────────────────────────────────
    public function api_listar_historico(Request $request)
    {
        if (!$this->verificar_admin()) {
            return response()->json(['erro' => 'Sem permissão.'], 401);
        }

        $query = HistoricoAtividade::query()->orderByDesc('criado_em');

        // Filtro: categoria
        if ($request->filled('categoria') && $request->categoria !== 'todos') {
            $query->where('categoria', $request->categoria);
        }

        // Filtro: pesquisa por nome do utilizador ou descrição
        if ($request->filled('pesquisar')) {
            $termo = '%' . $request->pesquisar . '%';
            $query->where(function ($q) use ($termo) {
                $q->where('nome_util', 'like', $termo)
                  ->orWhere('descricao', 'like', $termo)
                  ->orWhere('nome_entidade', 'like', $termo)
                  ->orWhere('acao', 'like', $termo);
            });
        }

        // Filtro: data início
        if ($request->filled('data_inicio')) {
            $query->whereDate('criado_em', '>=', $request->data_inicio);
        }

        // Filtro: data fim
        if ($request->filled('data_fim')) {
            $query->whereDate('criado_em', '<=', $request->data_fim);
        }

        // Filtro: tipo de utilizador
        if ($request->filled('tipo_util') && $request->tipo_util !== 'todos') {
            $query->where('tipo_util', $request->tipo_util);
        }

        $porPagina = (int) ($request->por_pagina ?? 20);
        $resultados = $query->paginate($porPagina);

        // Enriquecer com atributos computados do model
        $itens = $resultados->getCollection()->map(function ($item) {
            return [
                'id_historico'    => $item->id_historico,
                'id_util'         => $item->id_util,
                'nome_util'       => $item->nome_util ?? 'Sistema',
                'tipo_util'       => $item->tipo_util,
                'categoria'       => $item->categoria,
                'label_categoria' => $item->label_categoria,
                'acao'            => $item->acao,
                'descricao'       => $item->descricao,
                'entidade'        => $item->entidade,
                'id_entidade'     => $item->id_entidade,
                'nome_entidade'   => $item->nome_entidade,
                'campos_alterados'=> $item->campos_alterados,
                'ip'              => $item->ip,
                'icone'           => $item->icone,
                'cor'             => $item->cor,
                'criado_em'       => $item->criado_em
                    ? $item->criado_em->format('d/m/Y H:i:s')
                    : '—',
                'criado_em_relativo' => $item->criado_em
                    ? $item->criado_em->diffForHumans()
                    : '—',
            ];
        });

        return response()->json([
            'data'         => $itens,
            'total'        => $resultados->total(),
            'por_pagina'   => $resultados->perPage(),
            'pagina_atual' => $resultados->currentPage(),
            'ultima_pagina'=> $resultados->lastPage(),
        ]);
    }

    // ──────────────────────────────────────────────────────────
    // LIMPAR HISTÓRICO (opcional, apenas admin)
    // ──────────────────────────────────────────────────────────
    public function limpar_historico_admin(Request $request)
    {
        if (!$this->verificar_admin()) {
            return response()->json(['erro' => 'Sem permissão.'], 401);
        }

        // Só permite apagar registos com mais de 90 dias por segurança
        HistoricoAtividade::where('criado_em', '<', now()->subDays(90))->delete();

        return response()->json(['mensagem' => 'Registos antigos removidos com sucesso.']);
    }
}