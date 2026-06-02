<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Medico;
use App\Models\Mensagem;
use App\Models\Notificacao;
use App\Models\Paciente;
use App\Models\Utilizador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MensagemController extends Controller
{
    // ═══════════════════════════════════════════════════════════
    //  PAINEL DO PACIENTE
    // ═══════════════════════════════════════════════════════════

    /**
     * Lista as consultas concluídas do paciente e permite seleccionar uma
     * para ver/enviar mensagens ao médico responsável.
     */
    public function mostrar_mensagens_paciente(Request $request)
    {
        $utilizador = verificar_paciente();
        if (! $utilizador) return redirect('/login');

        $paciente = Paciente::find($utilizador->id_paciente);

        // Consultas concluídas com médico associado (podem ter mensagens)
        $consultas = Consulta::select(
                'consultas.id_consulta',
                'consultas.data',
                'consultas.hora',
                'consultas.estado',
                'medico.id_medico',
                'medico.nome as nome_medico',
                'medico.especialidade',
                'tipos_consultas.nome as tipo_consulta',
                'servicos_clinicos.nome as servico',
                'util_medico.foto as foto_medico',
            )
            ->join('medico', 'consultas.id_medico', '=', 'medico.id_medico')
            ->leftJoin('utilizadores as util_medico', 'util_medico.id_medico', '=', 'medico.id_medico')
            ->leftJoin('tipos_consultas', 'consultas.id_tipo_consulta', '=', 'tipos_consultas.id_tipo_consulta')
            ->leftJoin('servicos_clinicos', 'consultas.id_servico_clinico', '=', 'servicos_clinicos.id_servico_clinico')
            ->where('consultas.id_paciente', $paciente->id_paciente)
            ->whereIn('consultas.estado', ['concluida', 'em_andamento', 'confirmada'])
            ->whereNotNull('consultas.id_medico')
            ->orderByDesc('consultas.data')
            ->get();

        // Para cada consulta, conta mensagens não lidas
        $id_util = $utilizador->id_util;
        $consultas = $consultas->map(function ($c) use ($id_util) {
            $c->nao_lidas = Mensagem::where('id_consulta', $c->id_consulta)
                ->where('id_destinatario', $id_util)
                ->where('lida', false)
                ->count();
            return $c;
        });

        $total_nao_lidas = $consultas->sum('nao_lidas');

        // Consulta seleccionada
        $id_consulta_sel = $request->query('consulta');
        $consulta_sel    = null;
        $mensagens       = collect();
        $medico_sel      = null;
        $id_util_medico  = null;

        if ($id_consulta_sel) {
            $consulta_sel = $consultas->firstWhere('id_consulta', (int) $id_consulta_sel);

            if ($consulta_sel) {
                // Utilizador do médico desta consulta
                $util_medico   = Utilizador::where('id_medico', $consulta_sel->id_medico)->first();
                $id_util_medico = $util_medico?->id_util;

                if ($id_util_medico) {
                    // Foto do médico (pelo utilizador)
                    $consulta_sel->foto_medico = $util_medico?->foto ?? $consulta_sel->foto_medico ?? null;

                    // Carrega conversa
                    $mensagens = Mensagem::conversa($id_consulta_sel, $id_util, $id_util_medico)
                        ->orderBy('created_at')
                        ->get();

                    // Marca como lidas
                    Mensagem::where('id_consulta', $id_consulta_sel)
                        ->where('id_destinatario', $id_util)
                        ->where('lida', false)
                        ->update(['lida' => true, 'lida_em' => now()]);

                    // Recalcula badge desta consulta
                    $consulta_sel->nao_lidas = 0;
                }
            }
        }

        // Fotos para os avatares
        $foto_eu    = session('foto_utilizador'); // foto do paciente logado
        $foto_outro = isset($util_medico) ? $util_medico->foto : null; // foto do médico

        return view('mensagens.pacientes_mensagens', compact(
            'consultas', 'consulta_sel', 'mensagens',
            'id_util', 'id_util_medico', 'total_nao_lidas', 'paciente',
            'foto_eu', 'foto_outro'
        ));
    }

    // ═══════════════════════════════════════════════════════════
    //  PAINEL DO MÉDICO
    // ═══════════════════════════════════════════════════════════

    /**
     * Lista os pacientes/consultas do médico com quem pode trocar mensagens.
     */
    public function mostrar_mensagens_medico(Request $request)
    {
        $utilizador = verificar_medico();
        if (! $utilizador) return redirect('/login');

        $id_util = $utilizador->id_util;
        $medico  = Medico::find($utilizador->id_medico);

        // Consultas concluídas/em andamento deste médico
        $consultas = Consulta::select(
                'consultas.id_consulta',
                'consultas.data',
                'consultas.hora',
                'consultas.estado',
                'paciente.id_paciente',
                'paciente.nome as nome_paciente',
                'tipos_consultas.nome as tipo_consulta',
                'servicos_clinicos.nome as servico',
                'util_paciente.foto as foto_paciente',
            )
            ->join('paciente', 'consultas.id_paciente', '=', 'paciente.id_paciente')
            ->leftJoin('utilizadores as util_paciente', 'util_paciente.id_paciente', '=', 'paciente.id_paciente')
            ->leftJoin('tipos_consultas', 'consultas.id_tipo_consulta', '=', 'tipos_consultas.id_tipo_consulta')
            ->leftJoin('servicos_clinicos', 'consultas.id_servico_clinico', '=', 'servicos_clinicos.id_servico_clinico')
            ->where('consultas.id_medico', $medico->id_medico)
            ->whereIn('consultas.estado', ['concluida', 'em_andamento', 'confirmada'])
            ->orderByDesc('consultas.data')
            ->get();

        $consultas = $consultas->map(function ($c) use ($id_util) {
            $c->nao_lidas = Mensagem::where('id_consulta', $c->id_consulta)
                ->where('id_destinatario', $id_util)
                ->where('lida', false)
                ->count();
            return $c;
        });

        $total_nao_lidas = $consultas->sum('nao_lidas');

        $id_consulta_sel  = $request->query('consulta');
        $consulta_sel     = null;
        $mensagens        = collect();
        $id_util_paciente = null;

        if ($id_consulta_sel) {
            $consulta_sel = $consultas->firstWhere('id_consulta', (int) $id_consulta_sel);

            if ($consulta_sel) {
                $util_paciente    = Utilizador::where('id_paciente', $consulta_sel->id_paciente)->first();
                $id_util_paciente = $util_paciente?->id_util;

                if ($id_util_paciente) {
                    $consulta_sel->foto_paciente = $util_paciente?->foto ?? $consulta_sel->foto_paciente ?? null;

                    $mensagens = Mensagem::conversa($id_consulta_sel, $id_util, $id_util_paciente)
                        ->orderBy('created_at')
                        ->get();

                    Mensagem::where('id_consulta', $id_consulta_sel)
                        ->where('id_destinatario', $id_util)
                        ->where('lida', false)
                        ->update(['lida' => true, 'lida_em' => now()]);

                    $consulta_sel->nao_lidas = 0;
                }
            }
        }

        // Fotos para os avatares
        $foto_eu    = session('foto_utilizador'); // foto do médico logado
        $foto_outro = isset($util_paciente) ? $util_paciente->foto : null; // foto do paciente

        return view('mensagens.medicos_mensagens', compact(
            'consultas', 'consulta_sel', 'mensagens',
            'id_util', 'id_util_paciente', 'total_nao_lidas', 'medico',
            'foto_eu', 'foto_outro'
        ));
    }

    // ═══════════════════════════════════════════════════════════
    //  API — ENVIAR MENSAGEM
    // ═══════════════════════════════════════════════════════════

    public function api_enviar_mensagem(Request $request)
    {
        $utilizador = $this->utilizador_autenticado();
        if (! $utilizador) return response()->json(['erro' => 'Não autenticado.'], 401);

        $request->validate([
            'id_consulta'     => 'required|integer',
            'id_destinatario' => 'required|integer',
            'conteudo'        => 'required|string|max:2000',
        ]);

        $id_consulta     = (int) $request->id_consulta;
        $id_destinatario = (int) $request->id_destinatario;
        $id_remetente    = $utilizador->id_util;

        // ── Segurança: valida que o par utilizador/consulta é legítimo ──
        if (! $this->par_autorizado($id_remetente, $id_destinatario, $id_consulta)) {
            return response()->json(['erro' => 'Não tem permissão para enviar mensagens nesta consulta.'], 403);
        }

        $mensagem = Mensagem::create([
            'id_consulta'     => $id_consulta,
            'id_remetente'    => $id_remetente,
            'id_destinatario' => $id_destinatario,
            'conteudo'        => trim($request->conteudo),
            'lida'            => false,
        ]);

        // ── Notificação ───────────────────────────────────────
        $tipoRemetente = $utilizador->nivel_acesso == 2 ? 'médico' : 'paciente';
        Notificacao::create([
            'titulo'   => ucfirst($tipoRemetente) . ' enviou uma mensagem',
            'mensagem' => 'O ' . $tipoRemetente . ' ' . $utilizador->nome . ' enviou uma mensagem referente à consulta #' . $id_consulta . '.',
            'id_util'  => $id_destinatario,
            'lida'     => false,
            'data'     => now()->format('Y-m-d H:i:s'),
        ]);

        return response()->json([
            'ok'         => true,
            'id_mensagem'=> $mensagem->id_mensagem,
            'created_at' => $mensagem->created_at->format('H:i'),
            'conteudo'   => $mensagem->conteudo,
        ]);
    }

    // ═══════════════════════════════════════════════════════════
    //  API — POLLING: mensagens novas (para auto-refresh do chat)
    // ═══════════════════════════════════════════════════════════

    public function api_mensagens_novas(Request $request)
    {
        $utilizador = $this->utilizador_autenticado();
        if (! $utilizador) return response()->json(['erro' => 'Não autenticado.'], 401);

        $id_consulta     = (int) $request->query('id_consulta');
        $id_interlocutor = (int) $request->query('id_interlocutor');
        $ultima_id       = (int) $request->query('ultima_id', 0);
        $id_util         = $utilizador->id_util;

        if (! $this->par_autorizado($id_util, $id_interlocutor, $id_consulta)) {
            return response()->json(['erro' => 'Sem permissão.'], 403);
        }

        $novas = Mensagem::conversa($id_consulta, $id_util, $id_interlocutor)
            ->where('id_mensagem', '>', $ultima_id)
            ->orderBy('created_at')
            ->get()
            ->map(fn($m) => [
                'id_mensagem'  => $m->id_mensagem,
                'id_remetente' => $m->id_remetente,
                'conteudo'     => $m->conteudo,
                'hora'         => $m->created_at->format('H:i'),
                'minha'        => $m->id_remetente === $id_util,
            ]);

        // Marca como lidas as que vieram do interlocutor
        Mensagem::where('id_consulta', $id_consulta)
            ->where('id_remetente', $id_interlocutor)
            ->where('id_destinatario', $id_util)
            ->where('lida', false)
            ->update(['lida' => true, 'lida_em' => now()]);

        return response()->json(['mensagens' => $novas]);
    }

    // ═══════════════════════════════════════════════════════════
    //  API — Total de não lidas (badge global)
    // ═══════════════════════════════════════════════════════════

    public function api_total_nao_lidas()
    {
        $utilizador = $this->utilizador_autenticado();
        if (! $utilizador) return response()->json(['total' => 0]);

        $total = Mensagem::where('id_destinatario', $utilizador->id_util)
            ->where('lida', false)
            ->count();

        return response()->json(['total' => $total]);
    }

    // ═══════════════════════════════════════════════════════════
    //  HELPERS PRIVADOS
    // ═══════════════════════════════════════════════════════════

    private function utilizador_autenticado(): ?Utilizador
    {
        if (! session('id_utilizador')) return null;
        return Utilizador::find(session('id_utilizador'));
    }

    /**
     * Garante que os dois utilizadores (remetente e destinatário) estão
     * ligados à mesma consulta — um como médico, outro como paciente.
     */
    private function par_autorizado(int $idA, int $idB, int $idConsulta): bool
    {
        $consulta = Consulta::find($idConsulta);
        if (! $consulta) return false;

        $utilA = Utilizador::find($idA);
        $utilB = Utilizador::find($idB);
        if (! $utilA || ! $utilB) return false;

        // idA é o paciente desta consulta e idB é o médico, ou vice-versa
        $pacienteOk = (
            ($utilA->id_paciente && $consulta->id_paciente == $utilA->id_paciente) ||
            ($utilB->id_paciente && $consulta->id_paciente == $utilB->id_paciente)
        );

        $medicoOk = (
            ($utilA->id_medico && $consulta->id_medico == $utilA->id_medico) ||
            ($utilB->id_medico && $consulta->id_medico == $utilB->id_medico)
        );

        return $pacienteOk && $medicoOk;
    }
}