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
use Illuminate\Support\Facades\Storage;
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
    $request->validate([
        'email'    => ['required'],
        'password' => ['required'],
    ]);

    $input = trim($request->email);

    // Tenta encontrar por email ou por número de telefone
    $utilizador = Utilizador::where('email', $input)
                            ->orWhere('num_telefone', $input)
                            ->first();

    if ($utilizador) {
        $senhValida = Hash::check($request->password, $utilizador->senha);

        if ($senhValida) {
            session(['id_utilizador'   => $utilizador->id_util]);
            session(['nome_utilizador' => $utilizador->nome]);
            session(['foto_utilizador' => $utilizador->foto]);

            if ($utilizador->nivel_acesso == 0) {
                session(['tipo_utilizador' => 'admi']);
                return redirect('/admin/dashboard');
            }
            if ($utilizador->nivel_acesso == 1) {
                session(['tipo_utilizador' => 'recepcionista']);
                return redirect(route('mostrar_dashboard_recepcionista'));
            }
            if ($utilizador->nivel_acesso == 2) {
                session(['tipo_utilizador' => 'medico']);
                return redirect(route('mostrar_dashboard_medico'));
            }

            session(['tipo_utilizador' => 'paciente']);
            return redirect(route('mostrar_dashboard_paciente'));
        }
    }

    return back()->with('erro', 'Credenciais incorretas. Verifique o email/telefone e a senha.');
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
    $emailexiste           = Paciente::where('email', $request->email)->first();
    $emailexisteutilizador = Utilizador::where('email', $request->email)->first();
    if ($emailexiste || $emailexisteutilizador) {
        return back()->with('erro', 'Este email já está cadastrado. Use outro ou faça login.');
    }

    $num_telefoneexiste           = Paciente::where('num_telefone', $request->num_telefone)->first();
    $num_telefoneexisteutilizador = Utilizador::where('num_telefone', $request->num_telefone)->first();
    if ($num_telefoneexiste || $num_telefoneexisteutilizador) {
        return back()->with('erro', 'Este número de telefone já está registrado.');
    }

    if ($request->senha != $request->confirmar_senha) {
        return back()->with('erro', 'As senhas não correspondem.');
    }

 

    $paciente = Paciente::create([
        'nome'            => $request['nome'],
        'email'           => $request['email'],
        'num_telefone'    => $request['num_telefone'],
        'genero'          => $request['genero'],
        'morada'          => $request['morada'],
        'senha'           => Hash::make($request['senha']),
        'data_nascimento' => $request['data_nascimento'],
        'num_bi'          => $request['num_bi'],
        'estado_civil'    => $request['estado_civil'],
        'cidade'          => $request['cidade'],
        'bairro'          => $request['bairro'],
        'seguro'          => $request['seguro'],
        'id_clinica'      => 1,
    ]);

$foto = null;
        if ($request->hasFile('foto')) {
            $ficheiro = $request->file('foto');
            if ($ficheiro->isValid() && $ficheiro->getSize() > 0) {
                $pastaDestino = storage_path('app/public/fotos');
                if (!file_exists($pastaDestino)) {
                    mkdir($pastaDestino, 0775, true);
                }
                $extensao  = $ficheiro->getClientOriginalExtension();
                $nomeUnico = uniqid('foto_') . '.' . $extensao;
                $ficheiro->move($pastaDestino, $nomeUnico);
                $foto = 'fotos/' . $nomeUnico;
            }
        }

$utilizador = Utilizador::create([
    'num_telefone' => $request['num_telefone'],
    'senha'        => Hash::make($request['senha']),
    'nome'         => $request['nome'],
    'genero'       => $request['genero'],
    'email'        => $request['email'],
    'foto'         => $foto,         // ← LINHA NOVA
    'nivel_acesso' => 3,
    'id_paciente'  => $paciente->id_paciente,
]);

   if ($utilizador) {
    session(['id_utilizador'   => $utilizador->id_util]);
    session(['tipo_utilizador' => 'paciente']);
    session(['nome_utilizador' => $utilizador->nome]);
    session(['foto_utilizador' => $utilizador->foto]);

    // ANTES: return redirect('/');
    // DEPOIS — redireciona para o dashboard do paciente:
    return redirect(route('mostrar_dashboard_paciente'));
}
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
    if (!session('id_utilizador')) {
        return redirect('/login');
    }

    $utilizador = Utilizador::find(session('id_utilizador'));
    if (!$utilizador) {
        return back()->with('erro', 'Usuário não encontrado.');
    }

    $paciente      = null;
    $admin         = null;
    $medico        = null;
    $recepcionista = null;

    if ($utilizador->id_admi)          $admin         = Admi::find($utilizador->id_admi);
    if ($utilizador->id_medico)        $medico        = Medico::find($utilizador->id_medico);
    if ($utilizador->id_recepcionista) $recepcionista = Recepcionista::find($utilizador->id_recepcionista);
    if ($utilizador->id_paciente)      $paciente      = Paciente::find($utilizador->id_paciente);

    if ($request->senha && $request->senha != $request->confirmar_senha) {
        return back()->with('erro', 'As senhas não correspondem.');
    }

    $senha = $request->senha ? Hash::make($request->senha) : $utilizador->senha;

    // ── FOTO ─────────────────────────────────────────────
  $foto = $utilizador->foto;

if ($request->hasFile('foto')) {
    $ficheiro = $request->file('foto');

    if ($ficheiro->isValid() && $ficheiro->getSize() > 0) {
        // Apaga foto antiga
        if ($utilizador->foto) {
            $caminhoAntigo = storage_path('app/public/' . $utilizador->foto);
            if (file_exists($caminhoAntigo)) {
                unlink($caminhoAntigo);
            }
        }
         // Gera nome único para o ficheiro
        $extensao  = $ficheiro->getClientOriginalExtension();
        $nomeUnico = uniqid('foto_') . '.' . $extensao;
        
        // Caminho absoluto da pasta destino
        $pastaDestino = storage_path('app/public/fotos');
        
        // Cria a pasta se não existir
        if (!file_exists($pastaDestino)) {
            mkdir($pastaDestino, 0775, true);
        }

        // Move o ficheiro manualmente
        $ficheiro->move($pastaDestino, $nomeUnico);
        
        // Guarda o caminho relativo (como o store() guardaria)
        $foto = 'fotos/' . $nomeUnico;
    }
}
$utilizador->foto = $foto;
    // ─────────────────────────────────────────────────────

    // Atualiza utilizador
    $utilizador->num_telefone = $request['num_telefone'];
    $utilizador->email        = $request['email'];
    $utilizador->genero       = $request['genero'];
    $utilizador->nome         = $request['nome'];
    $utilizador->senha        = $senha;
    $utilizador->foto         = $foto;  // ← guarda a foto
    $utilizador->save();

    // Atualiza session
    session(['nome_utilizador' => $utilizador->nome]);
    session(['foto_utilizador' => $utilizador->foto]);

    // Atualiza admin se aplicável
    if ($admin) {
        $admin->morada       = $request['morada'];
        $admin->num_telefone = $request['num_telefone'];
        $admin->nome         = $request['nome'];
        $admin->genero       = $request['genero'];
        $admin->email        = $request['email'];
        $admin->senha        = $senha;
        $admin->save();
    }

    // Atualiza paciente se aplicável
    if ($paciente) {
        $paciente->morada          = $request['morada'];
        $paciente->num_telefone    = $request['num_telefone'];
        $paciente->nome            = $request['nome'];
        $paciente->genero          = $request['genero'];
        $paciente->email           = $request['email'];
        $paciente->data_nascimento = $request['data_nascimento'];
        $paciente->num_bi          = $request['num_bi'];
        $paciente->estado_civil    = $request['estado_civil'];
        $paciente->cidade          = $request['cidade'];
        $paciente->bairro          = $request['bairro'];
        $paciente->seguro          = $request['seguro'];
        $paciente->senha           = $senha;
        $paciente->save();
    }

    // Atualiza recepcionista se aplicável
    if ($recepcionista) {
        $recepcionista->morada       = $request['morada'];
        $recepcionista->num_telefone = $request['num_telefone'];
        $recepcionista->nome         = $request['nome'];
        $recepcionista->genero       = $request['genero'];
        $recepcionista->email        = $request['email'];
        $recepcionista->senha        = $senha;
        $recepcionista->save();
    }

    // Atualiza médico se aplicável
    if ($medico) {
        $medico->morada          = $request['morada'];
        $medico->num_telefone    = $request['num_telefone'];
        $medico->nome            = $request['nome'];
        $medico->genero          = $request['genero'];
        $medico->email           = $request['email'];
        $medico->especialidade   = $request['especialidade'];
        $medico->ano_experiencia = $request['ano_experiencia'];
        $medico->senha           = $senha;
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
    if (!$this->verificar_admin()) {
        return back()->with('erro', 'Não tem permissão para acessar esta página');
    }
    if (session('id_utilizador') == $id_util) {
        return back()->with('erro', 'Não pode editar o seu próprio usuário');
    }

    $utilizador = $id_util ? Utilizador::find($id_util) : null;
    if ($id_util && !$utilizador) {
        return back()->with('erro', 'Usuário não encontrado.');
    }

    $paciente      = null;
    $admin         = null;
    $medico        = null;
    $recepcionista = null;

    $emailexisteutilizador = Utilizador::where('email', $request->email)->first();
    if (($id_util && $emailexisteutilizador && $emailexisteutilizador->id_util != $id_util) || (!$id_util && $emailexisteutilizador)) {
        return back()->with('erro', 'Este email já está cadastrado. Use um email diferente.');
    }

    $num_telefoneexisteutilizador = Utilizador::where('num_telefone', $request->num_telefone)->first();
    if (($id_util && $num_telefoneexisteutilizador && $num_telefoneexisteutilizador->id_util != $id_util) || (!$id_util && $num_telefoneexisteutilizador)) {
        return back()->with('erro', 'Este número de telefone já está registrado. Use um número diferente.');
    }

    if ($utilizador->id_admi ?? null)          $admin         = Admi::find($utilizador->id_admi);
    if ($utilizador->id_medico ?? null)        $medico        = Medico::find($utilizador->id_medico);
    if ($utilizador->id_recepcionista ?? null) $recepcionista = Recepcionista::find($utilizador->id_recepcionista);
    if ($utilizador->id_paciente ?? null)      $paciente      = Paciente::find($utilizador->id_paciente);

    $senha = ($id_util && !$request->senha)
        ? $utilizador->senha
        : Hash::make($request->senha);

    // ── FOTO — único bloco, sem duplicação ────────────────
    $foto = $utilizador->foto ?? null;

    if ($request->hasFile('foto')) {
        $ficheiro = $request->file('foto');

        if ($ficheiro->isValid() && $ficheiro->getSize() > 0) {
            // Apaga foto antiga se existir
            if ($foto) {
                $caminhoAntigo = storage_path('app/public/' . $foto);
                if (file_exists($caminhoAntigo)) {
                    unlink($caminhoAntigo);
                }
            }
            // Cria pasta se não existir
            $pastaDestino = storage_path('app/public/fotos');
            if (!file_exists($pastaDestino)) {
                mkdir($pastaDestino, 0775, true);
            }
            // Move o ficheiro
            $extensao  = $ficheiro->getClientOriginalExtension();
            $nomeUnico = uniqid('foto_') . '.' . $extensao;
            $ficheiro->move($pastaDestino, $nomeUnico);
            $foto = 'fotos/' . $nomeUnico;
        }
    }
    // ──────────────────────────────────────────────────────

    $tipo         = $request->tipo;
    $nivel_acesso = 0;

    $admin = ($utilizador->id_admi ?? null) ? $admin : new Admi;
    if ($tipo == 'administrador') {
        $admin->morada       = $request['morada'];
        $admin->num_telefone = $request['num_telefone'];
        $admin->nome         = $request['nome'];
        $admin->genero       = $request['genero'];
        $admin->email        = $request['email'];
        $admin->senha        = $senha;
        $admin->save();
    }

    $paciente = ($utilizador->id_paciente ?? null) ? $paciente : new Paciente;
    if ($tipo == 'paciente') {
        $nivel_acesso            = 3;
        $paciente->morada        = $request['morada'];
        $paciente->num_telefone  = $request['num_telefone'];
        $paciente->nome          = $request['nome'];
        $paciente->genero        = $request['genero'];
        $paciente->email         = $request['email'];
        $paciente->data_nascimento = $request['data_nascimento'];
        $paciente->num_bi        = $request['num_bi'];
        $paciente->estado_civil  = $request['estado_civil'];
        $paciente->cidade        = $request['cidade'];
        $paciente->bairro        = $request['bairro'];
        $paciente->seguro        = $request['seguro'];
        $paciente->senha         = $senha;
        $paciente->id_clinica    = 1;
        $paciente->save();
    }

    $recepcionista = ($utilizador->id_recepcionista ?? null) ? $recepcionista : new Recepcionista;
    if ($tipo == 'recepcionista') {
        $nivel_acesso                = 1;
        $recepcionista->morada       = $request['morada'];
        $recepcionista->num_telefone = $request['num_telefone'];
        $recepcionista->nome         = $request['nome'];
        $recepcionista->genero       = $request['genero'];
        $recepcionista->email        = $request['email'];
        $recepcionista->senha        = $senha;
        $recepcionista->id_clinica   = 1;
        $recepcionista->save();
    }

    $medico = ($utilizador->id_medico ?? null) ? $medico : new Medico;
    if ($tipo == 'medico') {
        $nivel_acesso            = 2;
        $medico->morada          = $request['morada'];
        $medico->num_telefone    = $request['num_telefone'];
        $medico->nome            = $request['nome'];
        $medico->genero          = $request['genero'];
        $medico->email           = $request['email'];
        $medico->especialidade   = $request['especialidade'];
        $medico->ano_experiencia = $request['ano_experiencia'] ?? 0;
        $medico->senha           = $senha;
        $medico->id_clinica      = 1;
        $medico->save();
    }

    // Cria ou atualiza o utilizador
    $utilizador                   = $id_util ? $utilizador : new Utilizador;
    $utilizador->num_telefone     = $request['num_telefone'];
    $utilizador->email            = $request['email'];
    $utilizador->genero           = $request['genero'];
    $utilizador->nome             = $request['nome'];
    $utilizador->senha            = $senha;
    $utilizador->foto             = $foto; // ← único lugar onde a foto é atribuída
    $utilizador->id_admi          = $admin->id_admi ?? null;
    $utilizador->id_medico        = $medico->id_medico ?? null;
    $utilizador->id_recepcionista = $recepcionista->id_recepcionista ?? null;
    $utilizador->id_paciente      = $paciente->id_paciente ?? null;
    $utilizador->nivel_acesso     = $nivel_acesso;
    $utilizador->save();

    return redirect(route('mostrar_cadastros_admin'));
}
}
