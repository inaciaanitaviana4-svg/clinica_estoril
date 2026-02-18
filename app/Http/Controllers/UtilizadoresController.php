<?php

namespace App\Http\Controllers;

// Importações de Models
use App\Models\Admi;
use App\Models\Especialidade;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\recepcionista;
use App\Models\Utilizador;
// Importações do Laravel
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Controlador responsável por autenticação, registro e gerenciamento de usuários
 */
class UtilizadoresController extends Controller
{
    /**
     * Converte código numérico de tipo de utilizador para string
     *
     * @param  int  $tipo  Código: 0=admin, 1=recepcionista, 2=médico, 3=paciente
     */
    private function obter_tipo_utilizador($tipo)
    {
        if ($tipo == 0) {
            return 'administrador';
        }
        if ($tipo == 1) {
            return 'recepcionista';
        }
        if ($tipo == 2) {
            return 'medico';
        }
        if ($tipo == 3) {
            return 'paciente';
        }
    }

    /**
     * Verifica se o utilizador atual é administrador
     *
     * @return bool true se for admin, false caso contrário
     */
    private function verificar_admin()
    {
        // Verifica se existe ID de utilizador na sessão
        if (! session('id_utilizador')) {
            return false;
        }
        // Busca o utilizador no banco de dados
        $utilizador = Utilizador::find(session('id_utilizador'));
        if (! $utilizador) {
            return false;
        }
        // Verifica se possui perfil de administrador
        if (! $utilizador->id_admi) {
            return false;
        }
        // Verifica se nível de acesso é 0 (administrador)
        if ($utilizador->nivel_acesso != 0) {
            return false;
        }

        return true;

    }

    /**
     * Autentica um utilizador no sistema
     * Valida email e senha, cria sessão e redireciona conforme nível de acesso
     *
     * @param  Request  $request  Contém 'email' e 'password' do formulário
     */
    public function login(Request $request)
    {
        // Valida que email é obrigatório e válido, e senha é obrigatória
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Busca utilizador pelo email
        $utilizador = Utilizador::where('email', $credentials['email'])->first();
        if ($utilizador) {
            // Verifica se a senha corresponde (comparação com hash)
            $senhValida = Hash::check($credentials['password'], $utilizador->senha);
            if ($senhValida) {
                // Cria sessão do utilizador
                session(['id_utilizador' => $utilizador->id_util]);

                // Redireciona conforme o nível de acesso
                if ($utilizador->nivel_acesso == 0) {
                    session(['tipo_utilizador' => 'admi']);

                    return redirect('/admin/dashboard');
                }
                if ($utilizador->nivel_acesso == 1) {
                    session(['tipo_utilizador' => 'recepcionista']);

                    return redirect(route('mostrar_consultas_recepcionista'));
                }
                if ($utilizador->nivel_acesso == 2) {
                    session(['tipo_utilizador' => 'medico']);

                    return redirect(route('mostrar_consultas_medico'));

                }
                session(['tipo_utilizador' => 'paciente']);

                return redirect('/consultas-paciente');
            }

        }

        // Retorna erro se email/senha inválidos
        return back()->with(
            'erro',
            'Email ou senha incorretos. Verifique suas credenciais e tente novamente.',
        );
    }

    /**
     * Faz logout do utilizador, destruindo a sessão
     *
     * @param  Request  $request  Requisição HTTP
     */
    public function sair(Request $request)
    {
        // Invalida toda a sessão do utilizador
        $request->session()->invalidate();
        // Remove dados da sessão
        $request->session()->forget(['id_utilizador', 'tipo_utilizador']);
        // Regenera token CSRF para segurança
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Registra um novo paciente no sistema
     * Valida dados únicos (email/telefone) e cria registros em Paciente e Utilizador
     *
     * @param  Request  $request  Dados do formulário de cadastro
     */
    public function cadastrarpaciente(Request $request)
    {
        // Valida email únicos em ambos os modelos
        $emailexiste = Paciente::where('email', $request->email)->first();
        $emailexisteutilizador = Utilizador::where('email', $request->email)->first();
        if ($emailexiste || $emailexisteutilizador) {
            return back()->with('erro', 'Este email já está cadastrado no sistema. Use um email diferente ou faça login se já possui uma conta.');
        }

        // Valida telefone único em ambos os modelos
        $num_telefoneexiste = Paciente::where('num_telefone', $request->num_telefone)->first();
        $num_telefoneexisteutilizador = Utilizador::where('num_telefone', $request->num_telefone)->first();
        if ($num_telefoneexiste || $num_telefoneexisteutilizador) {
            return back()->with('erro', 'Este número de telefone já está registrado no sistema. Use um número diferente.');
        }

        // Cria novo registro de paciente
        $paciente = Paciente::create([
            'nome' => $request['nome'],
            'email' => $request['email'],
            'num_telefone' => $request['num_telefone'],
            'genero' => $request['genero'],
            'morada' => $request['morada'],
            'senha' => Hash::make($request['senha']),
            'data_nascimento' => $request['data_nascimento'],
            'num_bi' => $request['num_bi'],
            'estado_civil' => $request['estado_civil'],
            'cidade' => $request['cidade'],
            'bairro' => $request['bairro'],
            'seguro' => $request['seguro'],
            'id_clinica' => 1,
        ]);

        // Cria utilizador associado ao paciente
        $utilizador = Utilizador::create([
            'num_telefone' => $request['num_telefone'],
            'senha' => Hash::make($request['senha']),
            'nome' => $request['nome'],
            'genero' => $request['genero'],
            'email' => $request['email'],
            'nivel_acesso' => 3, // 3 = paciente
            'id_paciente' => $paciente->id_paciente,
        ]);

        if ($utilizador) {
            // Cria sessão e redireciona para home
            session(['id_utilizador' => $utilizador->id]);
            session(['tipo_utilizador' => 'paciente']);

            return redirect('/');
        }

        return back()->with('erro', 'Desculpe, não foi possível completar o cadastro. Tente novamente mais tarde ou contate o suporte.');
    }

    /**
     * Retorna a view para criar conta de paciente
     */
    public function criar_conta_paciente()
    {
        return view('criar_conta_paciente');
    }

    /**
     * Exibe o perfil do utilizador logado
     * Busca dados do utilizador e seus dados específicos por tipo (paciente, médico, etc)
     */
    public function visualizar_perfil()
    {
        // Verifica se utilizador está logado
        if (! session('id_utilizador')) {
            return redirect('/login');
        }

        // Busca utilizador na sessão
        $utilizador = Utilizador::find(session('id_utilizador'));
        $paciente = null;
        $admin = null;
        $medico = null;
        $recepcionista = null;

        // Carrega dados específicos conforme tipo do utilizador
        if ($utilizador->id_admi) {
            $admin = Admi::find($utilizador->id_admi);
        }
        if ($utilizador->id_medico) {
            $medico = Medico::find($utilizador->id_medico);
        }
        if ($utilizador->id_recepcionista) {
            $recepcionista = Recepcionista::find($utilizador->id_recepcionista);
        }
        if ($utilizador->id_paciente) {
            $paciente = Paciente::find($utilizador->id_paciente);
        }

        // Passa todos os dados para a view
        $dados = [
            'utilizador' => $utilizador,
            'paciente' => $paciente,
            'admin' => $admin,
            'medico' => $medico,
            'recepcionista' => $recepcionista,
        ];

        return view('utilizadores.perfil', compact('dados', 'utilizador'));

    }

    /**
     * Retorna a view para editar o perfil do utilizador logado
     */
    public function editar_perfil()
    {
        // Verifica autenticação
        if (! session('id_utilizador')) {
            return redirect('/login');
        }

        // Busca utilizador e carrega seus dados específicos
        $utilizador = Utilizador::find(session('id_utilizador'));
        $paciente = null;
        $admin = null;
        $medico = null;
        $recepcionista = null;

        if ($utilizador->id_admi) {
            $admin = Admi::find($utilizador->id_admi);
        }
        if ($utilizador->id_medico) {
            $medico = Medico::find($utilizador->id_medico);
        }
        if ($utilizador->id_recepcionista) {
            $recepcionista = Recepcionista::find($utilizador->id_recepcionista);
        }
        if ($utilizador->id_paciente) {
            $paciente = Paciente::find($utilizador->id_paciente);
        }

        $dados = [
            'utilizador' => $utilizador,
            'paciente' => $paciente,
            'admin' => $admin,
            'medico' => $medico,
            'recepcionista' => $recepcionista,
        ];

        return view('utilizadores.editar_perfil', compact('dados', 'utilizador'));

    }

    /**
     * Salva as alterações do perfil do utilizador logado
     * Atualiza dados no utilizador e na sua entidade específica (paciente, médico, etc)
     *
     * @param  Request  $request  Dados atualizados do formulário
     */
    public function editar_perfil_salvar(Request $request)
    {
        // Verifica autenticação
        if (! session('id_utilizador')) {
            return redirect('/login');
        }

        // Busca utilizador
        $utilizador = Utilizador::find(session('id_utilizador'));
        if (! $utilizador) {
            return back()->with('erro', 'Usuário não encontrado. Verifique o ID e tente novamente.');
        }

        // Carrega dados específicos do utilizador
        $paciente = null;
        $admin = null;
        $medico = null;
        $recepcionista = null;

        if ($utilizador->id_admi) {
            $admin = Admi::find($utilizador->id_admi);
        }
        if ($utilizador->id_medico) {
            $medico = Medico::find($utilizador->id_medico);
        }
        if ($utilizador->id_recepcionista) {
            $recepcionista = Recepcionista::find($utilizador->id_recepcionista);
        }
        if ($utilizador->id_paciente) {
            $paciente = Paciente::find($utilizador->id_paciente);
        }

        // Define senha: mantém antiga se não informada em edição, cria hash se nova
       $senha = null;
        if ( ! $request->senha) {
            $senha = $utilizador->senha;
        } else {
            $senha = Hash::make($request->senha);
        }
        // Atualiza dados gerais do utilizador
        $utilizador->num_telefone = $request['num_telefone'];
        $utilizador->email = $request['email'];
        $utilizador->genero = $request['genero'];
        $utilizador->nome = $request['nome'];
        $utilizador->senha = $senha;
        $utilizador->save();

        // Atualiza dados do admin se aplicável
        if ($admin) {
            $admin->morada = $request['morada'];
            $admin->num_telefone = $request['num_telefone'];
            $admin->nome = $request['nome'];
            $admin->genero = $request['genero'];
            $admin->email = $request['email'];
            $admin->senha = $senha;
            $admin->save();
        }

        // Atualiza dados do paciente se aplicável
        if ($paciente) {
            $paciente->morada = $request['morada'];
            $paciente->num_telefone = $request['num_telefone'];
            $paciente->nome = $request['nome'];
            $paciente->genero = $request['genero'];
            $paciente->email = $request['email'];
            $paciente->data_nascimento = $request['data_nascimento'];
            $paciente->num_bi = $request['num_bi'];
            $paciente->estado_civil = $request['estado_civil'];
            $paciente->cidade = $request['cidade'];
            $paciente->bairro = $request['bairro'];
            $paciente->seguro = $request['seguro'];
            $paciente->senha = $senha;
            $paciente->save();
        }

        // Atualiza dados da recepcionista se aplicável
        if ($recepcionista) {
            $recepcionista->morada = $request['morada'];
            $recepcionista->num_telefone = $request['num_telefone'];
            $recepcionista->nome = $request['nome'];
            $recepcionista->genero = $request['genero'];
            $recepcionista->email = $request['email'];
            $recepcionista->senha = $senha;
            $recepcionista->save();
        }

        // Atualiza dados do médico se aplicável
        if ($medico) {
            $medico->morada = $request['morada'];
            $medico->num_telefone = $request['num_telefone'];
            $medico->nome = $request['nome'];
            $medico->genero = $request['genero'];
            $medico->email = $request['email'];
            $medico->especialidade = $request['especialidade'];
            $medico->ano_experiencia = $request['ano_experiencia'];
            $medico->senha = $senha;
            $medico->save();
        }

        return redirect('/visualizar-perfil');
    }

    /**
     * Remove um utilizador do sistema (apenas admin)
     * Deleta o utilizador e suas entidades relacionadas (paciente, médico, etc)
     *
     * @param  int  $id_util  ID do utilizador a remover
     */
    public function remover_utilizador_admin($id_util)
    {
        // Verifica se é administrador
        if (! $this->verificar_admin()) {
            return response()->json(['erro' => 'Você não tem permissão para remover usuários. Apenas administradores podem realizar esta ação.'], 401);

        }

        // Impede que admin remova a si mesmo
        if (session('id_utilizador') == $id_util) {
            return response()->json(['erro' => 'Você não pode remover sua própria conta. Contacte outro administrador para esta ação.'], 401);
        }

        // Busca o utilizador a remover
        $utilizador = Utilizador::find($id_util);
        if (! $utilizador) {
            return response()->json(['erro' => 'Usuário não encontrado. Verifique o ID e tente novamente.'], 404);
        }

        // Remove entidades relacionadas antes de remover o utilizador
        if ($utilizador->id_paciente) {
            Paciente::destroy($utilizador->id_paciente);
        }
        if ($utilizador->id_admi) {
            Admi::destroy($utilizador->id_admi);
        }
        if ($utilizador->id_recepcionista) {
            Recepcionista::destroy($utilizador->id_recepcionista);
        }
        if ($utilizador->id_medico) {
            Medico::destroy($utilizador->id_medico);
        }

        // Remove o utilizador
        Utilizador::destroy($id_util);

        return response()->json(['mensagem' => 'Usuário removido com sucesso do sistema.'], 200);
    }

    /**
     * Exibe o formulário para registrar/editar um utilizador (apenas admin)
     *
     * @param  int|null  $id_util  ID do utilizador a editar, null para criar novo
     */
    public function mostrar_registro_utilizador_admin($id_util = null)
    {
        // Verifica permissão de admin
        if (! $this->verificar_admin()) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }

        // Impede edição do próprio admin
        if (session('id_utilizador') == $id_util) {
            return back()->with('erro', 'Não pode editar o seu próprio usuário');
        }

        // Busca utilizador se for edição
        $utilizador = $id_util ? Utilizador::find($id_util) : null;
        $paciente = null;
        $admin = null;
        $medico = null;
        $recepcionista = null;

        // Converte nível de acesso para texto legível
        $tipo_utilizador = $this->obter_tipo_utilizador($utilizador->nivel_acesso ?? '');

        // Carrega dados específicos do utilizador
        if ($utilizador->id_admi ?? null) {
            $admin = Admi::find($utilizador->id_admi);
        }
        if ($utilizador->id_medico ?? null) {
            $medico = Medico::find($utilizador->id_medico);
        }
        if ($utilizador->id_recepcionista ?? null) {
            $recepcionista = Recepcionista::find($utilizador->id_recepcionista);
        }
        if ($utilizador->id_paciente ?? null) {
            $paciente = Paciente::find($utilizador->id_paciente);
        }

        // Busca especialidades para dropdown
        $especialidades = Especialidade::all();

        $dados = [
            'utilizador' => $utilizador,
            'paciente' => $paciente,
            'admin' => $admin,
            'medico' => $medico,
            'recepcionista' => $recepcionista,
        ];

        return view('utilizadores.registro', compact('dados', 'utilizador', 'especialidades', 'tipo_utilizador'));

    }

    /**
     * Salva novo registro ou edita utilizador existente (apenas admin)
     * Valida dados únicos, cria/atualiza utilizador e sua entidade específica
     *
     * @param  Request  $request  Dados do formulário
     * @param  int|null  $id_util  ID do utilizador a editar, null para criar novo
     */
    public function salvar_registro_utilizador_admin(Request $request, $id_util = null)
    {
        // Verifica permissão de admin
        if (! $this->verificar_admin()) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        // Impede edição do próprio admin
        if (session('id_utilizador') == $id_util) {
            return back()->with('erro', 'Não pode editar o seu próprio usuário');
        }
        // Busca utilizador se for edição
        $utilizador = $id_util ? Utilizador::find($id_util) : null;
        if ($id_util && ! $utilizador) {
            return back()->with('erro', 'Usuário não encontrado. Verifique o ID e tente novamente.');
        }

        // Inicializa entidades específicas
        $paciente = null;
        $admin = null;
        $medico = null;
        $recepcionista = null;

        // Valida email único (permitindo edição do próprio email)
        $emailexisteutilizador = Utilizador::where('email', $request->email)->first();
        if (($id_util && $emailexisteutilizador && $emailexisteutilizador->id_util != $id_util) || (! $id_util && $emailexisteutilizador)) {
            return back()->with('erro', 'Este email já está cadastrado no sistema. Use um email diferente.');
        }
        // Valida telefone único (permitindo edição do próprio telefone)
        $num_telefoneexisteutilizador = Utilizador::where('num_telefone', $request->num_telefone)->first();
        if (($id_util && $num_telefoneexisteutilizador && $num_telefoneexisteutilizador->id_util != $id_util) || (! $id_util && $num_telefoneexisteutilizador)) {
            return back()->with('erro', 'Este número de telefone já está registrado. Use um número diferente.');
        }

        // Carrega entidades se for edição
        if ($utilizador->id_admi ?? null) {
            $admin = Admi::find($utilizador->id_admi);
        }
        if ($utilizador->id_medico ?? null) {
            $medico = Medico::find($utilizador->id_medico);
        }
        if ($utilizador->id_recepcionista ?? null) {
            $recepcionista = Recepcionista::find($utilizador->id_recepcionista);
        }
        if ($utilizador->id_paciente ?? null) {
            $paciente = Paciente::find($utilizador->id_paciente);
        }

        // Define senha: mantém antiga se não informada em edição, cria hash se nova
        if ($id_util && ! $request->senha) {
            $senha = $utilizador->senha;
        } else {
            $senha = Hash::make($request->senha);
        }

        // Processa dados conforme tipo de utilizador
        $tipo = $request->tipo;
        $nivel_acesso = 0; // Padrão = admin

        // Processa tipo administrador
        $admin = $id_util ? $admin : new Admi;
        if ($tipo == 'administrador') {
            $admin->morada = $request['morada'];
            $admin->num_telefone = $request['num_telefone'];
            $admin->nome = $request['nome'];
            $admin->genero = $request['genero'];
            $admin->email = $request['email'];
            $admin->senha = $senha;
            $admin->save();
        }

        // Processa tipo paciente
        $paciente = $id_util ? $paciente : new Paciente;
        if ($tipo == 'paciente') {
            $nivel_acesso = 3; // Código 3 = paciente
            $paciente->morada = $request['morada'];
            $paciente->num_telefone = $request['num_telefone'];
            $paciente->nome = $request['nome'];
            $paciente->genero = $request['genero'];
            $paciente->email = $request['email'];
            $paciente->data_nascimento = $request['data_nascimento'];
            $paciente->num_bi = $request['num_bi'];
            $paciente->estado_civil = $request['estado_civil'];
            $paciente->cidade = $request['cidade'];
            $paciente->bairro = $request['bairro'];
            $paciente->seguro = $request['seguro'];
            $paciente->senha = $senha;
            $paciente->id_clinica = 1;
            $paciente->save();
        }

        // Processa tipo recepcionista
        $recepcionista = $id_util ? $recepcionista : new Recepcionista;
        if ($tipo == 'recepcionista') {
            $nivel_acesso = 1; // Código 1 = recepcionista
            $recepcionista->morada = $request['morada'];
            $recepcionista->num_telefone = $request['num_telefone'];
            $recepcionista->nome = $request['nome'];
            $recepcionista->genero = $request['genero'];
            $recepcionista->email = $request['email'];
            $recepcionista->senha = $senha;
            $recepcionista->id_clinica = 1;
            $recepcionista->save();
        }

        // Processa tipo médico
        $medico = $id_util ? $medico : new Medico;
        if ($tipo == 'medico') {
            $nivel_acesso = 2; // Código 2 = médico
            $medico->morada = $request['morada'];
            $medico->num_telefone = $request['num_telefone'];
            $medico->nome = $request['nome'];
            $medico->genero = $request['genero'];
            $medico->email = $request['email'];
            $medico->especialidade = $request['especialidade'];
            $medico->ano_experiencia = $request['ano_experiencia'];
            $medico->senha = $senha;
            $medico->id_clinica = 1;
            $medico->save();
        }

        // Cria ou atualiza registro do utilizador
        $utilizador = $id_util ? $utilizador : new Utilizador;
        $utilizador->num_telefone = $request['num_telefone'];
        $utilizador->email = $request['email'];
        $utilizador->genero = $request['genero'];
        $utilizador->nome = $request['nome'];
        $utilizador->senha = $senha;
        $utilizador->id_admi = $admin->id_admi ?? null;
        $utilizador->id_medico = $medico->id_medico ?? null;
        $utilizador->id_recepcionista = $recepcionista->id_recepcionista ?? null;
        $utilizador->id_paciente = $paciente->id_paciente ?? null;
        $utilizador->nivel_acesso = $nivel_acesso;
        $utilizador->save();

        return redirect(route('mostrar_cadastros_admin'));
    }
}
