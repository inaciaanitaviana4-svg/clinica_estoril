<?php

// Importação dos Controllers
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\EspecialidadesController;
use App\Http\Controllers\NotificacoesController;
use App\Http\Controllers\PagamentosController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SiteController;
use App\Http\Controllers\UtilizadoresController;
use App\Http\Controllers\PacienteController;

// Middleware obrigatório para web
Route::middleware(["web"])->group(function () {

    // ===== ROTAS PÚBLICAS DO SITE =====
    Route::get('/', [SiteController::class, 'inicio']);
    Route::get('/sobre', [SiteController::class, 'sobre']);
    Route::get('/servicos', [SiteController::class, 'servicos']);
    Route::get('/especialidades', [SiteController::class, 'especialidades']);
    Route::get('/equipa', [SiteController::class, 'equipa']);
    Route::get('/contacto', [SiteController::class, 'contacto']);
    Route::get('/blog', [SiteController::class, 'blog']);
    Route::get('/chatbot', [SiteController::class, 'chatbot']);
    Route::get('/login', [SiteController::class, 'login']);

    // ===== ROTAS DE AUTENTICAÇÃO =====
    Route::post('/login', [UtilizadoresController::class, 'login']);
    Route::get('/sair', [UtilizadoresController::class, 'sair']);
    Route::post('/cadastrar-paciente', [UtilizadoresController::class, 'cadastrarpaciente']);
    Route::get('/criar-conta-paciente', [UtilizadoresController::class, 'criar_conta_paciente']);

    // ===== ROTAS DE PERFIL (para todos os utilizadores) =====
    Route::get('/visualizar-perfil', [UtilizadoresController::class, 'visualizar_perfil'])->name('visualizar_perfil');
    Route::get('/editar-perfil', [UtilizadoresController::class, 'editar_perfil']);
    Route::post('/editar-perfil', [UtilizadoresController::class, 'editar_perfil_salvar']);

    // ===== ROTAS DO PACIENTE =====
    Route::get('/consultas-paciente', [PacienteController::class, 'consultas_paciente']);
    Route::get('/perfil-paciente', [PacienteController::class, 'perfil_paciente']);
    Route::get('/agendar-consulta-paciente', [PacienteController::class, 'agendar_consulta_paciente']);
    Route::post('/agendar-consulta-paciente', [PacienteController::class, 'agendar_consulta_paciente_salvar']);
    Route::post('/cancelar-consulta-paciente/{id_consulta}', [PacienteController::class, 'cancelar_consulta_paciente']);
    Route::post('/confirmar-consulta-paciente/{id_consulta}', [PacienteController::class, 'confirmar_consulta_paciente']);

    // ===== ROTAS DE NOTIFICAÇÕES =====
    Route::get('/listar-minhas-notificacoes', [NotificacoesController::class, 'listar_minhas_notificacoes']);
    Route::get('/ler-notificacao/{id_notificacao}', [NotificacoesController::class, 'ler_notificacao']);
    Route::get('/ler-todas-notificacoes', [NotificacoesController::class, 'ler_todas_notificacoes']);

    // ===== ROTAS DA RECEPCIONISTA =====
    Route::get('/painel-recepcionista/agendamentos', [ConsultaController::class, 'mostrar_consultas_recepcionista'])->name("mostrar_consultas_recepcionista");
    Route::get('/painel-recepcionista/pagamentos', [PagamentosController::class, 'mostrar_pagamentos_recepcionista'])->name("mostrar_pagamentos_recepcionista");
    Route::get('/painel-recepcionista/pagamentos/fazer', [PagamentosController::class, 'mostrar_fazer_pagamento_recepcionista'])->name("mostrar_fazer_pagamento_recepcionista");
    Route::post('/painel-recepcionista/pagamentos/estado/{id_pagamento}', [PagamentosController::class, 'mudar_estado_pagamento_recepcionista'])->name("mudar_estado_pagamento_recepcionista");
    Route::post('/painel-recepcionista/pagamentos', [PagamentosController::class, 'salvar_registro_pagamento_recepcionista'])->name("salvar_pagamento_recepcionista");
    Route::get('/painel-recepcionista/pagamentos/{id_pagamento}', [PagamentosController::class, 'detalhes_pagamento_recepcionista'])->name("detalhes_pagamento_recepcionista");
    Route::get('/painel-recepcionista/triagens', [ConsultaController::class, 'mostrar_triagens_recepcionista'])->name("mostrar_triagens_recepcionista");
    Route::get('/painel-recepcionista/pacientes/cadastrar', [PacienteController::class, 'mostrar_cadastro_paciente_recepcionista'])->name("mostrar_cadastro_paciente_recepcionista");
    Route::post('/painel-recepcionista/pacientes/cadastrar', [PacienteController::class, 'salvar_cadastro_paciente_recepcionista'])->name("salvar_cadastro_paciente_recepcionista");
    Route::get('/painel-recepcionista/pacientes', [PacienteController::class, 'mostrar_pacientes_recepcionista'])->name("mostrar_pacientes_recepcionista");
    Route::get('/painel-recepcionista/pacientes/{id_paciente}', [PacienteController::class, 'detalhes_paciente_recepcionista'])->name("detalhes_paciente_recepcionista");
    Route::get('/painel-recepcionista/atendimento', [ConsultaController::class, 'mostrar_atendimento_recepcionista'])->name("mostrar_atendimento_recepcionista");
    Route::post('/painel-recepcionista/atendimento', [ConsultaController::class, 'salvar_atendimento_recepcionista'])->name("salvar_atendimento_recepcionista");
    Route::post('/painel-recepcionista/associar-medico/{id_consulta}', [ConsultaController::class, 'associar_medico_consulta_recepcionista'])->name("associar_medico_consulta_recepcionista");
    Route::post('/painel-recepcionista/desassociar-medico/{id_consulta}', [ConsultaController::class, 'desassociar_medico_consulta_recepcionista'])->name("desassociar_medico_consulta_recepcionista");
    Route::post('/painel-recepcionista/fazer-pagamento/{id_consulta}', [PagamentosController::class, 'fazer_pagamento_consulta_recepcionista'])->name("fazer_pagamento_consulta_recepcionista");
    Route::get('/painel-recepcionista/cancelar-pagamento/{id_pagamento}', [PagamentosController::class, 'cancelar_pagamento_consulta_recepcionista'])->name("cancelar_pagamento_consulta_recepcionista");
    Route::get('/painel-recepcionista/atendimento/{id_consulta}', [ConsultaController::class, 'detalhes_consulta_recepcionista'])->name("detalhes_consulta_recepcionista");
    Route::post('/painel-recepcionista/estado-consulta/{id_consulta}', [ConsultaController::class, 'mudar_estado_consulta_recepcionista'])->name("mudar_estado_consulta_recepcionista");

    // ===== ROTAS DO MÉDICO =====
    Route::get('/painel-medico/consultas', [ConsultaController::class, 'mostrar_consultas_medico'])->name('mostrar_consultas_medico');
    Route::get('/painel-medico', [ConsultaController::class, 'painelmedico']);
    Route::get('/painel-medico/consultas/realizar/{id_consulta}', [ConsultaController::class, 'realizar_consulta_medico'])->name('realizar_consulta_medico');
    Route::post('/api/consultas/{id_consulta}/salvar-diagnostico', [ConsultaController::class, 'api_salvar_diagnostico_consulta_medico'])->name('api_salvar_diagnostico_consulta_medico');
    Route::get('/api/consultas/{id_consulta}/listar-diagnostico', [ConsultaController::class, 'api_listar_diagnostico_consulta_medico'])->name('api_listar_diagnostico_consulta_medico');
    Route::post('/api/consultas/{id_consulta}/registro-exame/{id_exame?}', [ConsultaController::class, 'api_registro_exame_consulta_medico'])->name('api_registro_exame_consulta_medico');
    Route::get('/api/consultas/{id_consulta}/buscar-exame/{id_exame?}', [ConsultaController::class, 'api_buscar_exame_consulta_medico'])->name('api_buscar_exame_consulta_medico');
    Route::get('/api/consultas/{id_consulta}/listar-exames', [ConsultaController::class, 'api_listar_exames_consulta_medico'])->name('api_listar_exames_consulta_medico');
    Route::post('/api/consultas/{id_consulta}/adicionar-receita', [ConsultaController::class, 'api_adicionar_receita_consulta_medico'])->name('api_adicionar_receita_consulta_medico');
    Route::post('/api/consultas/{id_consulta}/listar-receitas', [ConsultaController::class, 'api_listar_receitas_consulta_medico'])->name('api_listar_receitas_consulta_medico');
    Route::delete('/api/consultas/{id_consulta}/remover-receita/{id_receita}', [ConsultaController::class, 'api_remover_receita_consulta_medico'])->name('api_remover_receita_consulta_medico');

    // ===== ROTAS DO ADMINISTRADOR =====
    Route::get('/admin/dashboard', [AdminController::class, 'mostrar_dashboard_admin']);
    Route::get('/admin/pagamentos', [AdminController::class, 'mostrar_pagamentos_admin']);

    // Gerenciamento de utilizadores
    Route::get('/admin/cadastros', [AdminController::class, 'mostrar_cadastros_admin'])->name('mostrar_cadastros_admin');
    Route::get('/admin/cadastros/utilizadores/remover/{id_util}', [UtilizadoresController::class, 'remover_utilizador_admin'])->name('remover_utilizador_admin');
    Route::get('/admin/cadastros/utilizadores/registro/{id_util?}', [UtilizadoresController::class, 'mostrar_registro_utilizador_admin'])->name("mostrar_registro_utilizador_admin");
    Route::post('/admin/cadastros/utilizadores/registro/{id_util?}', [UtilizadoresController::class, 'salvar_registro_utilizador_admin'])->name("salvar_registro_utilizador_admin");

    // Gerenciamento de especialidades
    Route::get('/admin/cadastros/especialidades/remover/{id_espec}', [EspecialidadesController::class, 'remover_especialidade_admin'])->name('remover_especialidade_admin');
    Route::get('/admin/cadastros/especialidades/registro/{id_espec?}', [EspecialidadesController::class, 'mostrar_registro_especialidade_admin'])->name('mostrar_registro_especialidade_admin');
    Route::post('/admin/cadastros/especialidades/registro/{id_espec?}', [EspecialidadesController::class, 'salvar_registro_especialidade_admin'])->name('salvar_registro_especialidade_admin');

    // Visualizações do admin
    Route::get('/admin/consultas', [AdminController::class, 'mostrar_consultas_admin']);
    Route::get('/admin/prontuarios', [AdminController::class, 'mostrar_prontuarios_admin']);
    Route::get('/admin/exames', [AdminController::class, 'mostrar_exames_admin']);
});
