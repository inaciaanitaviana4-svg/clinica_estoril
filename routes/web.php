<?php

// Importação dos Controllers
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EspecialidadesController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\NotificacoesController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PagamentosController;
use App\Http\Controllers\ProntuarioController;
use App\Http\Controllers\ReceitaController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\ServicoClinicoController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TipoConsultaController;
use App\Http\Controllers\UtilizadoresController;
use App\Http\Controllers\HistoricoAtividadeController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\MensagemController;
use Illuminate\Support\Facades\Route;

// Middleware obrigatório para web
Route::middleware(['web'])->group(function () {
    // ===== ROTAS PÚBLICAS DO SITE =====
    Route::get('/', [SiteController::class, 'inicio']);
    Route::get('/sobre', [SiteController::class, 'sobre']);
    Route::get('/servicos', [SiteController::class, 'servicos']);
    Route::get('/especialidades', [SiteController::class, 'especialidades']);
    Route::get('/equipa', [SiteController::class, 'equipa']);
    Route::get('/contacto', [SiteController::class, 'contacto']);
    Route::get('/blog', [SiteController::class, 'blog']);
    Route::get('/politica_seguranca', [SiteController::class, 'politica_seguranca'])->name('politica_seguranca');
    Route::get('/termos-uso', [SiteController::class, 'termos_uso'])->name('termos_uso');
    // Rout::get('/chatbot', [SiteController::class, 'chatbot']);
    Route::get('/login', [SiteController::class, 'login']);

    // ===== ROTAS DE AUTENTICAÇÃO =====
    Route::post('/login', [UtilizadoresController::class, 'login']);
    Route::get('/sair', [UtilizadoresController::class, 'sair']);
    Route::post('/cadastrar-paciente', [UtilizadoresController::class, 'cadastrarpaciente']);
    Route::get('/criar-conta-paciente', [UtilizadoresController::class, 'criar_conta_paciente']);

    // Rotas de recuperação de senha
    Route::post('/recuperar-senha/enviar-codigo', [UtilizadoresController::class, 'enviarCodigoRecuperacao']);
    Route::post('/recuperar-senha/re-enviar-codigo', [UtilizadoresController::class, 'reenviarCodigoRecuperacao']);
    Route::post('/recuperar-senha/verificar-codigo', [UtilizadoresController::class, 'verificarCodigoRecuperacao']);
    Route::post('/recuperar-senha/redefinir', [UtilizadoresController::class, 'redefinirSenha']);
    Route::get('/recuperar-senha', function () {
        return view('recuperar_senha');
    })->name('recuperar-senha');

    // ===== ROTAS DE PERFIL (para todos os utilizadores) =====
    Route::get('/visualizar-perfil', [UtilizadoresController::class, 'visualizar_perfil'])->name('visualizar_perfil');
    Route::get('/editar-perfil', [UtilizadoresController::class, 'editar_perfil']);
    Route::post('/editar-perfil', [UtilizadoresController::class, 'editar_perfil_salvar']);
    Route::post('/alterar-senha', [UtilizadoresController::class, 'alterar_senha']);

    // ===== ROTAS DO PACIENTE =====
    Route::get('/consultas-paciente', [PacienteController::class, 'consultas_paciente'])->name('mostrar_consultas_paciente');
    Route::get('/perfil-paciente', [PacienteController::class, 'perfil_paciente']);
    Route::get('/agendar-consulta-paciente', [PacienteController::class, 'agendar_consulta_paciente']);
    Route::post('/agendar-consulta-paciente', [PacienteController::class, 'agendar_consulta_paciente_salvar']);
    Route::post('/cancelar-consulta-paciente/{id_consulta}', [PacienteController::class, 'cancelar_consulta_paciente']);
    Route::post('/confirmar-consulta-paciente/{id_consulta}', [PacienteController::class, 'confirmar_consulta_paciente']);
    Route::get('/painel-paciente/relatorios', [RelatorioController::class, 'mostrar_relatorios_paciente'])->name('mostrar_relatorios_paciente');
    Route::get('/api/pacientes/pesquisar', [PacienteController::class, 'api_pesquisar_pacientes'])->name('api_pesquisar_pacientes');
    Route::get('/painel-paciente/prontuario', [ProntuarioController::class, 'mostrar_prontuario_paciente'])->name('mostrar_prontuario_paciente');
    Route::get('/painel-paciente/prontuario/{id_consulta}', [ProntuarioController::class, 'mostrar_detalhes_consulta_paciente'])->name('mostrar_detalhes_consulta_paciente');
    Route::get('/api/horarios-por-especialidade', [ConsultaController::class, 'api_horarios_por_especialidade']);

    // ===== ROTAS DE NOTIFICAÇÕES =====
    Route::get('/listar-minhas-notificacoes', [NotificacoesController::class, 'listar_minhas_notificacoes'])->name('listar_minhas_notificacoes');
    Route::get('/ler-notificacao/{id_notificacao}', [NotificacoesController::class, 'ler_notificacao']);
    Route::get('/ler-todas-notificacoes', [NotificacoesController::class, 'ler_todas_notificacoes']);
    Route::get('/api/notificacoes-nao-lidas', function () {
        if (!session('id_utilizador')) return response()->json(['total' => 0]);
        $total = \App\Models\Notificacao::where('id_util', session('id_utilizador'))
            ->where('lida', 0)
            ->count();
        return response()->json(['total' => $total]);
    })->name('api_notificacoes_nao_lidas');

    // ===== ROTAS DA RECEPCIONISTA =====
    Route::get('/painel-recepcionista/agendamentos', [ConsultaController::class, 'mostrar_consultas_recepcionista'])->name('mostrar_consultas_recepcionista');
    Route::get('/painel-recepcionista/pagamentos', [PagamentosController::class, 'mostrar_pagamentos_recepcionista'])->name('mostrar_pagamentos_recepcionista');
    Route::get('/painel-recepcionista/pagamentos/fazer', [PagamentosController::class, 'mostrar_fazer_pagamento_recepcionista'])->name('mostrar_fazer_pagamento_recepcionista');
    Route::post('/painel-recepcionista/pagamentos/estado/{id_pagamento}', [PagamentosController::class, 'mudar_estado_pagamento_recepcionista'])->name('mudar_estado_pagamento_recepcionista');
    Route::post('/painel-recepcionista/pagamentos', [PagamentosController::class, 'salvar_registro_pagamento_recepcionista'])->name('salvar_pagamento_recepcionista');
    Route::get('/painel-recepcionista/pagamentos/{id_pagamento}', [PagamentosController::class, 'detalhes_pagamento_recepcionista'])->name('detalhes_pagamento_recepcionista');
    Route::get('/painel-recepcionista/triagens', [ConsultaController::class, 'mostrar_triagens_recepcionista'])->name('mostrar_triagens_recepcionista');
    Route::get('/painel-recepcionista/pacientes/cadastrar', [PacienteController::class, 'mostrar_cadastro_paciente_recepcionista'])->name('mostrar_cadastro_paciente_recepcionista');
    Route::post('/painel-recepcionista/pacientes/cadastrar', [PacienteController::class, 'salvar_cadastro_paciente_recepcionista'])->name('salvar_cadastro_paciente_recepcionista');
    Route::get('/painel-recepcionista/pacientes', [PacienteController::class, 'mostrar_pacientes_recepcionista'])->name('mostrar_pacientes_recepcionista');
    Route::get('/painel-recepcionista/pacientes/{id_paciente}', [PacienteController::class, 'detalhes_paciente_recepcionista'])->name('detalhes_paciente_recepcionista');
    Route::get('/painel-recepcionista/atendimento', [ConsultaController::class, 'mostrar_atendimento_recepcionista'])->name('mostrar_atendimento_recepcionista');
    Route::post('/painel-recepcionista/atendimento', [ConsultaController::class, 'salvar_atendimento_recepcionista'])->name('salvar_atendimento_recepcionista');
    Route::post('/consultas/{id_consulta}/associar-medico/{view?}', [ConsultaController::class, 'associar_medico_consulta'])->name('associar_medico_consulta');
    Route::post('/consultas/{id_consulta}/desassociar-medico/{view?}', [ConsultaController::class, 'desassociar_medico_consulta'])->name('desassociar_medico_consulta');
    Route::post('/painel-recepcionista/fazer-pagamento/{id_consulta}', [PagamentosController::class, 'fazer_pagamento_consulta_recepcionista'])->name('fazer_pagamento_consulta_recepcionista');
    Route::get('/painel-recepcionista/cancelar-pagamento/{id_pagamento}', [PagamentosController::class, 'cancelar_pagamento_consulta_recepcionista'])->name('cancelar_pagamento_consulta_recepcionista');
    Route::get('/painel-recepcionista/atendimento/{id_consulta}', [ConsultaController::class, 'detalhes_consulta_recepcionista'])->name('detalhes_consulta_recepcionista');
    Route::post('/consultas/{id_consulta}/mudar-estado-consulta/{view?}', [ConsultaController::class, 'mudar_estado_consulta'])->name('mudar_estado_consulta');
    Route::post('/consultas/{id_consulta}/mudar-estado-medico', [ConsultaController::class, 'mudar_estado_consulta_medico'])->name('mudar_estado_consulta_medico');
    Route::get('/painel-recepcionista/horarios', [HorarioController::class, 'mostrar_horarios_recepcionista'])->name('mostrar_horarios_recepcionista');
    Route::delete('/painel-recepcionista/remover-horario-medico/{id_horario}', [HorarioController::class, 'remover_horario_medico_recepcionista'])->name('remover_horario_medico_recepcionista');
    Route::get('/painel-recepcionista/relatorios', [RelatorioController::class, 'mostrar_relatorios_recepcionista'])->name('mostrar_relatorios_recepcionista');

    // ===== ROTAS DO MÉDICO =====
    Route::get('/painel-medico/consultas', [ConsultaController::class, 'mostrar_consultas_medico'])->name('mostrar_consultas_medico');
    Route::get('/painel-medico', [ConsultaController::class, 'painelmedico']);
    Route::get('/painel-medico/relatorios', [RelatorioController::class, 'mostrar_relatorios_medico'])->name('mostrar_relatorios_medico');
    Route::get('/painel-medico/horarios', [HorarioController::class, 'mostrar_horarios_medico'])->name('mostrar_horarios_medico');
    Route::post('/painel-medico/horarios', [HorarioController::class, 'salvar_horarios_medico'])->name('salvar_horarios_medico');
    Route::get('/painel-medico/prontuarios', [ProntuarioController::class, 'mostrar_prontuarios_medico'])->name('mostrar_prontuarios_medico');
    Route::get('/painel-medico/prontuarios/{id_paciente}', [ProntuarioController::class, 'mostrar_detalhes_prontuario_medico'])->name('mostrar_detalhes_prontuario_medico');
    Route::get('/painel-medico/consultas/realizar/{id_consulta}', [ConsultaController::class, 'realizar_consulta_medico'])->name('realizar_consulta_medico');
    Route::post('/api/consultas/{id_consulta}/salvar-diagnostico', [ConsultaController::class, 'api_salvar_diagnostico_consulta_medico'])->name('api_salvar_diagnostico_consulta_medico');
    Route::get('/api/consultas/{id_consulta}/listar-diagnostico', [ConsultaController::class, 'api_listar_diagnostico_consulta_medico'])->name('api_listar_diagnostico_consulta_medico');
    Route::post('/api/consultas/{id_consulta}/registro-exame/{id_exame?}', [ConsultaController::class, 'api_registro_exame_consulta_medico'])->name('api_registro_exame_consulta_medico');
    Route::post('/api/consultas/{id_consulta}/salvar-resultado-exame/{id_exame?}', [ConsultaController::class, 'api_salvar_resultado_exame_consulta_medico'])->name('api_salvar_resultado_exame_consulta_medico');
    Route::get('/api/consultas/buscar-exame/{id_exame}', [ConsultaController::class, 'api_buscar_exame_consulta_medico'])->name('api_buscar_exame_consulta_medico');
    Route::get('/api/consultas/{id_consulta}/listar-exames', [ConsultaController::class, 'api_listar_exames_consulta_medico'])->name('api_listar_exames_consulta_medico');
    Route::post('/api/consultas/{id_consulta}/adicionar-medicamento', [ReceitaController::class, 'api_adicionar_medicamento_consulta_medico'])->name('api_adicionar_medicamento_consulta_medico');
    Route::get('/api/consultas/{id_consulta}/listar-medicamentos', [ReceitaController::class, 'api_listar_medicamentos_consulta_medico'])->name('api_listar_medicamentos_consulta_medico');
    Route::get('/api/consultas/{id_consulta}/remover-medicamento/{id_medicamento}', [ReceitaController::class, 'api_remover_medicamento_consulta_medico'])->name('api_remover_medicamento_consulta_medico');
    Route::post('/api/consultas/{id_consulta}/remover-medicamento/{id_medicamento}', [ReceitaController::class, 'api_remover_medicamento_consulta_medico'])->name('api_remover_medicamento_consulta_medico');
    Route::post('/api/consultas/{id_consulta}/salvar-observacoes-receita', [ReceitaController::class, 'api_salvar_observacoes_receita_consulta_medico'])->name('api_salvar_observacoes_receita_consulta_medico');
    Route::get('/api/consultas/{id_consulta}/buscar-receita-imprimir', [ReceitaController::class, 'api_buscar_receita_para_imprimir_consulta_medico'])->name('api_buscar_receita_para_imprimir_consulta_medico');
    Route::get('/api/prontuarios/consultas/{id_consulta}', [ProntuarioController::class, 'api_buscar_consultas_prontuario_medico'])->name('api_buscar_consultas_prontuario_medico');
    Route::get('/api/servicos-clinicos/medicos', [ServicoClinicoController::class, 'api_listar_medicos_servico_clinico'])->name('api_listar_medicos_servico_clinico');
    Route::get('/api/medicos/horarios', [HorarioController::class, 'api_listar_horarios_medico'])->name('api_listar_horarios_medico');

    // ===== ROTAS DO ADMINISTRADOR =====
    Route::get('/admin/dashboard', [AdminController::class, 'mostrar_dashboard_admin']);
    Route::get('/api/dashboard', [AdminController::class, 'api_obter_dados_dashboard'])->name('api_obter_dados_dashboard');
    Route::get('/admin/pagamentos', [AdminController::class, 'mostrar_pagamentos_admin'])->name('mostrar_pagamentos_admin');
    Route::get('/admin/pagamentos/{id_pagamento}', [PagamentosController::class, 'detalhes_pagamentos_admin'])->name('detalhes_pagamentos_admin');
    Route::post('/admin/pagamentos/{id_pagamento}/mudar-estado', [PagamentosController::class, 'mudar_estado_pagamento_admin'])->name('mudar_estado_pagamento_admin');
    Route::get('/admin/pagamentos/{id_pagamento}/remover', [PagamentosController::class, 'remover_pagamento_admin'])->name('remover_pagamento_admin');

    // ── Backup (Admin) ────────────────────────────────────────────
    Route::get('/admin/backup',                              [BackupController::class, 'mostrar_backup_admin'])->name('mostrar_backup_admin');
    Route::get('/admin/backup/banco-dados',                  [BackupController::class, 'download_banco_dados'])->name('backup_banco_dados');
    Route::get('/admin/backup/sistema-completo',             [BackupController::class, 'download_sistema_completo'])->name('backup_sistema_completo');
    Route::get('/api/admin/backup/estatisticas',             [BackupController::class, 'api_estatisticas'])->name('api_backup_estatisticas');
    Route::get('/admin/backup/baixar/{nome}',                [BackupController::class, 'download_backup_guardado'])->name('backup_download_guardado')->where('nome', '.+');
    Route::delete('/admin/backup/apagar/{nome}',             [BackupController::class, 'apagar_backup_guardado'])->name('backup_apagar_guardado')->where('nome', '.+');

    // Gerenciamento de utilizadores
    Route::get('/admin/cadastros', [AdminController::class, 'mostrar_cadastros_admin'])->name('mostrar_cadastros_admin');
    Route::get('/admin/cadastros/utilizadores/remover/{id_util}', [UtilizadoresController::class, 'remover_utilizador_admin'])->name('remover_utilizador_admin');
    Route::get('/admin/cadastros/utilizadores/registro/{id_util?}', [UtilizadoresController::class, 'mostrar_registro_utilizador_admin'])->name('mostrar_registro_utilizador_admin');
    Route::post('/admin/cadastros/utilizadores/registro/{id_util?}', [UtilizadoresController::class, 'salvar_registro_utilizador_admin'])->name('salvar_registro_utilizador_admin');

    // Gerenciamento de especialidades
    Route::get('/admin/cadastros/especialidades/remover/{id_espec}', [EspecialidadesController::class, 'remover_especialidade_admin'])->name('remover_especialidade_admin');
    Route::get('/admin/cadastros/especialidades/registro/{id_espec?}', [EspecialidadesController::class, 'mostrar_registro_especialidade_admin'])->name('mostrar_registro_especialidade_admin');
    Route::post('/admin/cadastros/especialidades/registro/{id_espec?}', [EspecialidadesController::class, 'salvar_registro_especialidade_admin'])->name('salvar_registro_especialidade_admin');

    // Gerenciamento de Tipo de Consulta
    Route::get('/admin/cadastros/tipo_consulta/remover/{id_tipo_consulta}', [TipoConsultaController::class, 'remover_tipo_consulta_admin'])->name('remover_tipo_consulta_admin');
    Route::get('/admin/cadastros/tipo_consulta/registro/{id_tipo_consulta?}', [TipoConsultaController::class, 'mostrar_registro_tipo_consulta_admin'])->name('mostrar_registro_tipo_consulta_admin');
    Route::post('/admin/cadastros/tipo_consulta/registro/{id_tipo_consulta?}', [TipoConsultaController::class, 'salvar_registro_tipo_consulta_admin'])->name('salvar_registro_tipo_consulta_admin');

    // Gerenciamento de servicos clinicos
    Route::get('/admin/cadastros/servicos_clinico/remover/{id_servico_clinico}', [ServicoClinicoController::class, 'remover_servico_clinico_admin'])->name('remover_servico_clinico_admin');
    Route::get('/admin/cadastros/servicos_clinico/registro/{id_servico_clinico?}', [ServicoClinicoController::class, 'mostrar_registro_servico_clinico_admin'])->name('mostrar_registro_servico_clinico_admin');
    Route::post('/admin/cadastros/servicos_clinico/registro/{id_servico_clinico?}', [ServicoClinicoController::class, 'salvar_registro_servico_clinico_admin'])->name('salvar_registro_servico_clinico_admin');
    Route::get('/api/servicos-clinicos', [ServicoClinicoController::class, 'api_obter_servicos_clinicos'])->name('api_obter_servicos_clinicos');
    Route::get('/admin/cadastros/servicos_clinico/remover/{id_servico_clinico}', [ServicoClinicoController::class, 'remover_servico_clinico_admin'])->name('remover_servico_clinico_admin');
    Route::get('/admin/cadastros/servicos_clinico/registro/{id_servico_clinico?}', [ServicoClinicoController::class, 'mostrar_registro_servico_clinico_admin'])->name('mostrar_registro_servico_clinico_admin');
    Route::post('/admin/cadastros/servicos_clinico/registro/{id_servico_clinico?}', [ServicoClinicoController::class, 'salvar_registro_servico_clinico_admin'])->name('salvar_registro_servico_clinico_admin');
    Route::get('/api/servicos-clinicos', [ServicoClinicoController::class, 'api_obter_servicos_clinicos'])->name('api_obter_servicos_clinicos');

    // Visualizações do admin
    Route::get('/admin/consultas', [AdminController::class, 'mostrar_consultas_admin'])->name('mostrar_consultas_admin');
    Route::get('/admin/consultas/{id_consulta}', [ConsultaController::class, 'detalhes_consulta_admin'])->name('detalhes_consulta_admin');
    Route::get('/admin/prontuarios', [ProntuarioController::class, 'mostrar_prontuarios_admin'])->name('mostrar_prontuarios_medico_admin');
    Route::get('/admin/prontuarios/{id_paciente}', [ProntuarioController::class, 'mostrar_detalhes_prontuario_admin'])->name('mostrar_detalhes_prontuario_admin');
    Route::get('/admin/relatorios', [RelatorioController::class, 'mostrar_relatorios_admin'])->name('mostrar_relatorios_admin');
    Route::get('/admin/historico-atividade', [HistoricoAtividadeController::class, 'mostrar_historico_admin'])
        ->name('mostrar_historico_atividade_admin');

    Route::get('/api/admin/historico-atividade', [HistoricoAtividadeController::class, 'api_listar_historico'])
        ->name('api_listar_historico_atividade');

    Route::delete('/api/admin/historico-atividade/limpar', [HistoricoAtividadeController::class, 'limpar_historico_admin'])
        ->name('limpar_historico_atividade_admin');

    // relatorios
    Route::post('/api/relatorios/consultas', [RelatorioController::class, 'api_relatorio_consultas'])->name('api_relatorio_consultas');
    Route::post('/api/relatorios/consultas/recepcionista', [RelatorioController::class, 'api_relatorio_consultas_recepcionista'])->name('api_relatorio_consultas_recepcionista');
    Route::post('/api/relatorios/pagamentos', [RelatorioController::class, 'api_relatorio_pagamentos'])->name('api_relatorio_pagamentos');
    Route::post('/api/relatorios/consultas/{id_consulta}', [RelatorioController::class, 'api_relatorio_consultas_paciente'])->name('api_relatorio_consultas_paciente');
    Route::get('/api/relatorios/prontuario/{id_paciente}', [RelatorioController::class, 'api_relatorio_prontuario_paciente'])->name('api_relatorio_prontuario_paciente');

    // dashboard
    Route::get('/painel-medico/dashboard', [DashboardController::class, 'mostrar_dashboard_medico'])->name('mostrar_dashboard_medico');
    Route::get('/painel-recepcionista/dashboard', [DashboardController::class, 'mostrar_dashboard_recepcionista'])->name('mostrar_dashboard_recepcionista');
    Route::get('/painel-paciente/dashboard', [DashboardController::class, 'mostrar_dashboard_paciente'])->name('mostrar_dashboard_paciente');
    Route::get('/api/dashboard/paciente', [DashboardController::class, 'api_obter_dados_dashboard_paciente'])->name('api_obter_dados_dashboard_paciente');
    Route::get('/api/dashboard/recepcionista', [DashboardController::class, 'api_obter_dados_dashboard_recepcionista'])->name('api_obter_dados_dashboard_recepcionista');
    Route::get('/api/dashboard/medico', [DashboardController::class, 'api_obter_dados_dashboard_medico'])->name('api_obter_dados_dashboard_medico');

    // ── Mensagens — Paciente ──────────────────────────────────────
    Route::get('/painel-paciente/mensagens',  [MensagemController::class, 'mostrar_mensagens_paciente'])->name('mostrar_mensagens_paciente');

    // ── Mensagens — Médico ────────────────────────────────────────
    Route::get('/painel-medico/mensagens',    [MensagemController::class, 'mostrar_mensagens_medico'])->name('mostrar_mensagens_medico');

    // ── API partilhada ────────────────────────────────────────────
    Route::post('/api/mensagens/enviar',       [MensagemController::class, 'api_enviar_mensagem'])->name('api_enviar_mensagem');
    Route::get('/api/mensagens/novas',         [MensagemController::class, 'api_mensagens_novas'])->name('api_mensagens_novas');
    Route::get('/api/mensagens/nao-lidas',     [MensagemController::class, 'api_total_nao_lidas'])->name('api_mensagens_nao_lidas');

    // erros
    Route::get('/', [SiteController::class, 'inicio']);

    Route::fallback(function () {
        return view('errors.404');
    });

    // routs/web.php
    Route::get('/imagem-perfil/{filename}', function ($filename) {
        $path = storage_path('app/public/fotos/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    })->name('imagem_perfil');
});
