<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\EspecialidadesController;
use App\Http\Controllers\NotificacoesController;
use App\Http\Controllers\PagamentosController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SiteController;
use App\Http\Controllers\UtilizadoresController;
use App\Http\Controllers\PacienteController;

Route::middleware(["web"])->group(function () {
Route::get('/', [SiteController::class, 'inicio']);
Route::get('/sobre', [SiteController::class, 'sobre']);
Route::get('/servicos', [SiteController::class, 'servicos']);
Route::get('/especialidades', [SiteController::class, 'especialidades']);
Route::get('/equipa', [SiteController::class, 'equipa']);
Route::get('/contacto', [SiteController::class, 'contacto']);
Route::get('/blog', [SiteController::class, 'blog']);
Route::get('/chatbot', [SiteController::class, 'chatbot']);
Route::get('/login', [SiteController::class, 'login']);

//Pacientes
Route::get('/consultas-paciente', [PacienteController::class, 'consultas_paciente']);
Route::get('/perfil-paciente', [PacienteController::class, 'perfil_paciente']);
Route::get('/agendar-consulta-paciente', [PacienteController::class, 'agendar_consulta_paciente']);
Route::post('/agendar-consulta-paciente', [PacienteController::class, 'agendar_consulta_paciente_salvar']);
Route::post('/cancelar-consulta-paciente/{id_consulta}', [PacienteController::class, 'cancelar_consulta_paciente']);
Route::post('/confirmar-consulta-paciente/{id_consulta}', [PacienteController::class, 'confirmar_consulta_paciente']);

//Notificações
Route::get('/listar-minhas-notificacoes', [NotificacoesController::class, 'listar_minhas_notificacoes']);
Route::get('/ler-notificacao/{id_notificacao}', [NotificacoesController::class, 'ler_notificacao']);
Route::get('/ler-todas-notificacoes', [NotificacoesController::class, 'ler_todas_notificacoes']);


//Rotas dos recepcionistas
Route::get('/painel-recepcionista/agendamentos', [ConsultaController::class, 'mostrar_consultas_recepcionista'])->name("mostrar_consultas_recepcionista");
Route::get('/painel-recepcionista/pagamentos', [PagamentosController::class, 'mostrar_pagamentos_recepcionista'])->name("mostrar_pagamentos_recepcionista");
Route::get('/painel-recepcionista/triagens', [ConsultaController::class, 'mostrar_triagens_recepcionista'])->name("mostrar_triagens_recepcionista");
Route::get('/painel-recepcionista/pacientes', [PacienteController::class, 'mostrar_pacientes_recepcionista'])->name("mostrar_pacientes_recepcionista");
Route::get('/painel-recepcionista/atendimento', [ConsultaController::class, 'mostrar_atendimento_recepcionista'])->name("mostrar_atendimento_recepcionista");
Route::post('/painel-recepcionista/atendimento', [ConsultaController::class, 'salvar_atendimento_recepcionista'])->name("salvar_atendimento_recepcionista");
Route::post('/painel-recepcionista/associar-medico/{id_consulta}', [ConsultaController::class, 'associar_medico_consulta_recepcionista'])->name("associar_medico_consulta_recepcionista");
Route::post('/painel-recepcionista/desassociar-medico/{id_consulta}', [ConsultaController::class, 'desassociar_medico_consulta_recepcionista'])->name("desassociar_medico_consulta_recepcionista");
Route::post('/painel-recepcionista/fazer-pagamento/{id_consulta}', [PagamentosController::class, 'fazer_pagamento_consulta_recepcionista'])->name("fazer_pagamento_consulta_recepcionista");
Route::get('/painel-recepcionista/cancelar-pagamento/{id_pagamento}', [PagamentosController::class, 'cancelar_pagamento_consulta_recepcionista'])->name("cancelar_pagamento_consulta_recepcionista");
Route::get('/painel-recepcionista/atendimento/{id_consulta}', [ConsultaController::class, 'detalhes_consulta_recepcionista'])->name("detalhes_consulta_recepcionista");

// rotas dos medicos
Route::get('/painel-medico/consultas', [ConsultaController::class,'mostrar_consultas_medico'])->name('mostrar_consultas_medico');
Route::get('/painel-medico', [ConsultaController::class, 'painelmedico']);

//
Route::post('/login', [UtilizadoresController::class, 'login']);
Route::get('/sair', [UtilizadoresController::class, 'sair']);
Route::post('/cadastrar-paciente', [UtilizadoresController::class, 'cadastrarpaciente']);
Route::get('/criar-conta-paciente', [UtilizadoresController::class, 'criar_conta_paciente']);
Route::get('/visualizar-perfil', [UtilizadoresController::class, 'visualizar_perfil']);
Route::get('/editar-perfil', [UtilizadoresController::class, 'editar_perfil']);
Route::post('/editar-perfil', [UtilizadoresController::class, 'editar_perfil_salvar']);

//painel admin
Route::get('/admin/dashboard', [AdminController::class, 'mostrar_dashboard_admin']);
Route::get('/admin/pagamentos', [AdminController::class, 'mostrar_pagamentos_admin']);
Route::get('/admin/cadastros', [AdminController::class, 'mostrar_cadastros_admin'])->name('mostrar_cadastros_admin');
Route::get('/admin/cadastros/utilizadores/remover/{id_util}', [UtilizadoresController::class, 'remover_utilizador_admin'])->name('remover_utilizador_admin');
Route::get('/admin/cadastros/utilizadores/registro/{id_util?}', [UtilizadoresController::class, 'mostrar_registro_utilizador_admin'])->name("mostrar_registro_utilizador_admin");
Route::post('/admin/cadastros/utilizadores/registro/{id_util?}', [UtilizadoresController::class, 'salvar_registro_utilizador_admin'])->name("salvar_registro_utilizador_admin");
Route::get('/admin/cadastros/especialidades/remover/{id_espec}', [EspecialidadesController::class, 'remover_especialidade_admin'])->name('remover_especialidade_admin');
Route::get('/admin/cadastros/especialidades/registro/{id_espec?}', [EspecialidadesController::class, 'mostrar_registro_especialidade_admin'])->name('mostrar_registro_especialidade_admin');
Route::post('/admin/cadastros/especialidades/registro/{id_espec?}', [EspecialidadesController::class, 'salvar_registro_especialidade_admin'])->name('salvar_registro_especialidade_admin');
Route::get('/admin/consultas', [AdminController::class, 'mostrar_consultas_admin']);
Route::get('/admin/prontuarios', [AdminController::class, 'mostrar_prontuarios_admin']);
Route::get('/admin/exames', [AdminController::class, 'mostrar_exames_admin']);






});




