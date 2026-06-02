<?php

namespace App\Http\Controllers;

// Importações de Models
use App\Models\Admi;
use App\Models\HistoricoAtividade;
use App\Models\Especialidade;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\recepcionista;
use App\Models\Utilizador;
// Importações do Laravel
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
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
                return redirect('/admin/dashboard')->with('sucesso', 'Login bem sucedido! Bem-vindo,'.$utilizador->nome);
            }
            if ($utilizador->nivel_acesso == 1) {
                session(['tipo_utilizador' => 'recepcionista']);
                return redirect(route('mostrar_dashboard_recepcionista'))->with("sucesso", "Login bem sucedido! Bem-vindo, ".$utilizador->nome);
            }
            if ($utilizador->nivel_acesso == 2) {
                session(['tipo_utilizador' => 'medico']);
                return redirect(route('mostrar_dashboard_medico'))->with("sucesso", "Login bem sucedido! Bem-vindo, ".$utilizador->nome);
            }

            session(['tipo_utilizador' => 'paciente']);
            return redirect(route('mostrar_dashboard_paciente'))->with("sucesso", "Login bem sucedido! Bem-vindo, ".$utilizador->nome);
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
                if (!file_exists($pastaDestino)) mkdir($pastaDestino, 0775, true);
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
            'foto'         => $foto,
            'nivel_acesso' => 3,
            'id_paciente'  => $paciente->id_paciente,
        ]);
 
        if ($utilizador) {
            session(['id_utilizador'   => $utilizador->id_util]);
            session(['tipo_utilizador' => 'paciente']);
            session(['nome_utilizador' => $utilizador->nome]);
            session(['foto_utilizador' => $utilizador->foto]);
 
            // ✅ CORRIGIDO: registar ANTES do return
            HistoricoAtividade::registar(
                'registro',
                'cadastrou_paciente',
                $utilizador->nome . ' criou conta de paciente no sistema',
                [
                    'entidade'      => 'Utilizador',
                    'id_entidade'   => $utilizador->id_util,
                    'nome_entidade' => $utilizador->nome,
                ]
            );
 
            return redirect(route('mostrar_dashboard_paciente'))
                ->with('sucesso', 'Conta criada com sucesso.');
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

        return view('utilizadores.editar_perfil', compact('dados', 'utilizador'))->with("sucesso", "Dados carregados. Edite seu perfil abaixo.");

    }

    /**
     * Salva as alterações do perfil do utilizador logado
     * Atualiza dados no utilizador e na sua entidade específica (paciente, médico, etc)
     *
     * @param  Request  $request  Dados atualizados do formulário
     */
  public function editar_perfil_salvar(Request $request)
    {
        if (!session('id_utilizador')) return redirect('/login');
 
        $utilizador = Utilizador::find(session('id_utilizador'));
        if (!$utilizador) return back()->with('erro', 'Usuário não encontrado.');
 
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
 
        // ✅ Detectar campos que mudaram ANTES de salvar
        $camposAlterados = [];
        $camposVerificar = ['nome', 'email', 'num_telefone', 'genero', 'morada'];
        foreach ($camposVerificar as $campo) {
            if ($request->has($campo) && $request->$campo != $utilizador->$campo) {
                $camposAlterados[] = $campo;
            }
        }
        if ($request->senha) $camposAlterados[] = 'senha';
 
        $senha = $request->senha ? Hash::make($request->senha) : $utilizador->senha;
 
        // ── FOTO ──────────────────────────────────────────────
        $foto = $utilizador->foto;
        if ($request->hasFile('foto')) {
            $ficheiro = $request->file('foto');
            if ($ficheiro->isValid() && $ficheiro->getSize() > 0) {
                if ($utilizador->foto) {
                    $caminhoAntigo = storage_path('app/public/' . $utilizador->foto);
                    if (file_exists($caminhoAntigo)) unlink($caminhoAntigo);
                }
                $extensao     = $ficheiro->getClientOriginalExtension();
                $nomeUnico    = uniqid('foto_') . '.' . $extensao;
                $pastaDestino = storage_path('app/public/fotos');
                if (!file_exists($pastaDestino)) mkdir($pastaDestino, 0775, true);
                if ($request->has('remover_foto') && $request->remover_foto == '1') {
                    if ($utilizador->foto) {
                        $c = storage_path('app/public/' . $utilizador->foto);
                        if (file_exists($c)) unlink($c);
                        $utilizador->foto = null;
                        session(['foto_utilizador' => null]);
                    }
                }
                $ficheiro->move($pastaDestino, $nomeUnico);
                $foto = 'fotos/' . $nomeUnico;
                $camposAlterados[] = 'foto';
            }
        }
 
        $utilizador->num_telefone = $request['num_telefone'];
        $utilizador->email        = $request['email'];
        $utilizador->genero       = $request['genero'];
        $utilizador->nome         = $request['nome'];
        $utilizador->senha        = $senha;
        $utilizador->foto         = $foto;
        $utilizador->save();
 
        session(['nome_utilizador' => $utilizador->nome]);
        session(['foto_utilizador' => $utilizador->foto]);
 
        if ($admin) {
            $admin->morada = $request['morada']; $admin->num_telefone = $request['num_telefone'];
            $admin->nome = $request['nome']; $admin->genero = $request['genero'];
            $admin->email = $request['email']; $admin->senha = $senha; $admin->save();
        }
        if ($paciente) {
            $paciente->morada = $request['morada']; $paciente->num_telefone = $request['num_telefone'];
            $paciente->nome = $request['nome']; $paciente->genero = $request['genero'];
            $paciente->email = $request['email']; $paciente->data_nascimento = $request['data_nascimento'];
            $paciente->num_bi = $request['num_bi']; $paciente->estado_civil = $request['estado_civil'];
            $paciente->cidade = $request['cidade']; $paciente->bairro = $request['bairro'];
            $paciente->seguro = $request['seguro']; $paciente->senha = $senha; $paciente->save();
        }
        if ($recepcionista) {
            $recepcionista->morada = $request['morada']; $recepcionista->num_telefone = $request['num_telefone'];
            $recepcionista->nome = $request['nome']; $recepcionista->genero = $request['genero'];
            $recepcionista->email = $request['email']; $recepcionista->senha = $senha; $recepcionista->save();
        }
        if ($medico) {
            $medico->morada = $request['morada']; $medico->num_telefone = $request['num_telefone'];
            $medico->nome = $request['nome']; $medico->genero = $request['genero'];
            $medico->email = $request['email']; $medico->especialidade = $request['especialidade'];
            $medico->ano_experiencia = $request['ano_experiencia']; $medico->senha = $senha; $medico->save();
        }
 
        // ✅ ESTAVA CORRETO — melhorado com $camposAlterados dinâmico
        HistoricoAtividade::registar(
            'atualizacao',
            'atualizou_perfil',
            session('nome_utilizador') . ' atualizou o próprio perfil',
            [
                'entidade'         => 'Utilizador',
                'id_entidade'      => $utilizador->id_util,
                'nome_entidade'    => $utilizador->nome,
                'campos_alterados' => $camposAlterados,
            ]
        );
 
        return redirect('/visualizar-perfil')->with('sucesso', 'Perfil atualizado com sucesso.');
    }


   
    /**
     * Remove um utilizador do sistema (apenas admin)
     * Deleta o utilizador e suas entidades relacionadas (paciente, médico, etc)
     *
     * @param  int  $id_util  ID do utilizador a remover
     */
    public function remover_utilizador_admin($id_util)
    {
        if (!$this->verificar_admin()) {
            return response()->json(['erro' => 'Sem permissão.'], 401);
        }
        if (session('id_utilizador') == $id_util) {
            return response()->json(['erro' => 'Não pode remover a própria conta.'], 401);
        }
 
        $utilizador = Utilizador::find($id_util);
        if (!$utilizador) return response()->json(['erro' => 'Usuário não encontrado.'], 404);
 
        $nomeRemovido = $utilizador->nome;
 
        if ($utilizador->id_paciente)      Paciente::destroy($utilizador->id_paciente);
        if ($utilizador->id_admi)          Admi::destroy($utilizador->id_admi);
        if ($utilizador->id_recepcionista) Recepcionista::destroy($utilizador->id_recepcionista);
        if ($utilizador->id_medico)        Medico::destroy($utilizador->id_medico);
 
        Utilizador::destroy($id_util);
 
        // ✅ ADICIONADO
        HistoricoAtividade::registar(
            'registro',
            'removeu_usuario',
            session('nome_utilizador') . ' removeu o utilizador ' . $nomeRemovido . ' do sistema',
            [
                'entidade'      => 'Utilizador',
                'id_entidade'   => $id_util,
                'nome_entidade' => $nomeRemovido,
            ]
        );
 
        return response()->json(['mensagem' => 'Usuário removido com sucesso.'], 200);
    }

    /**
 * Altera apenas a palavra-passe do utilizador logado.
 * Valida a senha atual antes de aceitar a nova.
 */
public function alterar_senha(Request $request)
{
    if (!session('id_utilizador')) return redirect('/login');

    $utilizador = Utilizador::find(session('id_utilizador'));
    if (!$utilizador) return back()->with('erro', 'Utilizador não encontrado.');

    // Verifica senha atual
    if (!Hash::check($request->senha_atual, $utilizador->senha)) {
        return back()->with('erro', 'A palavra-passe atual está incorreta.');
    }

    // Verifica confirmação
    if ($request->nova_senha !== $request->confirmar_nova_senha) {
        return back()->with('erro', 'As novas palavras-passe não coincidem.');
    }

    $novaSenhaHash = Hash::make($request->nova_senha);

    // Atualiza em todas as tabelas relacionadas
    $utilizador->senha = $novaSenhaHash;
    $utilizador->save();

    if ($utilizador->id_paciente)      { $p = Paciente::find($utilizador->id_paciente);      if ($p) { $p->senha = $novaSenhaHash; $p->save(); } }
    if ($utilizador->id_medico)        { $m = Medico::find($utilizador->id_medico);          if ($m) { $m->senha = $novaSenhaHash; $m->save(); } }
    if ($utilizador->id_recepcionista) { $r = Recepcionista::find($utilizador->id_recepcionista); if ($r) { $r->senha = $novaSenhaHash; $r->save(); } }
    if ($utilizador->id_admi)          { $a = Admi::find($utilizador->id_admi);              if ($a) { $a->senha = $novaSenhaHash; $a->save(); } }

    HistoricoAtividade::registar(
        'atualizacao', 'alterou_senha',
        session('nome_utilizador') . ' alterou a própria palavra-passe',
        ['entidade' => 'Utilizador', 'id_entidade' => $utilizador->id_util, 'nome_entidade' => $utilizador->nome]
    );

    return redirect('/visualizar-perfil')->with('sucesso', 'Palavra-passe alterada com sucesso.');
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
        if (!$this->verificar_admin()) return back()->with('erro', 'Não tem permissão.');
        if (session('id_utilizador') == $id_util) return back()->with('erro', 'Não pode editar o seu próprio usuário.');
 
        $eCriacao   = ($id_util === null);
        $utilizador = $id_util ? Utilizador::find($id_util) : null;
        if ($id_util && !$utilizador) return back()->with('erro', 'Usuário não encontrado.');
    

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

      // ✅ ADICIONADO
        HistoricoAtividade::registar(
            'registro',
            $eCriacao ? 'cadastrou_usuario' : 'editou_usuario',
            session('nome_utilizador') . ($eCriacao ? ' cadastrou' : ' editou') . ' o utilizador ' . $request->nome . ' (' . $request->tipo . ')',
            [
                'entidade'      => 'Utilizador',
                'id_entidade'   => $utilizador->id_util ?? null,
                'nome_entidade' => $request->nome,
            ]
        );
 
        return redirect(route('mostrar_cadastros_admin'));
    }

/**
 * Envia código de verificação para recuperação de senha
 */
public function enviarCodigoRecuperacao(Request $request)
{
    $request->validate([
        'contact' => 'required|string'
    ]);

    $contact = trim($request->contact);
    
    // Buscar utilizador por email ou telefone
    $utilizador = Utilizador::where('email', $contact)
                            ->orWhere('num_telefone', $contact)
                            ->first();
    
    if (!$utilizador) {
        return response()->json([
            'success' => false,
            'message' => 'Nenhum usuário encontrado com este email ou telefone.'
        ], 404);
    }
    
    // Gerar código de 6 dígitos
    $codigo = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    $token = Str::random(60);
    
    // Salvar no banco de dados
    PasswordReset::updateOrCreate(
        ['email' => $utilizador->email],
        [
            'token' => $token,
            'codigo_verificacao' => $codigo,
            'created_at' => now(),
            'expires_at' => now()->addMinutes(15)
        ]
    );
    
    // Enviar código por email
    try {
        // Se tiver email configurado
        if (config('mail.default') !== 'log') {
            Mail::send('emails.codigo_recuperacao', [
                'nome' => $utilizador->nome,
                'codigo' => $codigo
            ], function($message) use ($utilizador) {
                $message->to($utilizador->email)
                        ->subject('Código de Recuperação de Senha - Clínica Estoril');
            });
        }
        
        // Se tiver SMS configurado, enviar também
        // Aqui você pode integrar com serviço de SMS
        
        return response()->json([
            'success' => true,
            'message' => 'Código enviado com sucesso!',
            'token' => $token
        ]);
        
    } catch (\Exception $e) {
        // Em desenvolvimento, mostrar o código para teste
        if (app()->environment('local')) {
            return response()->json([
                'success' => true,
                'message' => 'Código gerado (ambiente de teste): ' . $codigo,
                'token' => $token,
                'test_code' => $codigo
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Erro ao enviar código de recuperação. Tente novamente.'
        ], 500);
    }
}

/**
 * Reenvia código de verificação
 */
public function reenviarCodigoRecuperacao(Request $request)
{
    $request->validate([
        'contact' => 'required|string'
    ]);
    
    $contact = trim($request->contact);
    
    $utilizador = Utilizador::where('email', $contact)
                            ->orWhere('num_telefone', $contact)
                            ->first();
    
    if (!$utilizador) {
        return response()->json([
            'success' => false,
            'message' => 'Usuário não encontrado.'
        ], 404);
    }
    
    // Gerar novo código
    $codigo = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    $token = Str::random(60);
    
    PasswordReset::updateOrCreate(
        ['email' => $utilizador->email],
        [
            'token' => $token,
            'codigo_verificacao' => $codigo,
            'created_at' => now(),
            'expires_at' => now()->addMinutes(15)
        ]
    );
    
    // Reenviar código
    try {
        Mail::send('emails.codigo_recuperacao', [
            'nome' => $utilizador->nome,
            'codigo' => $codigo
        ], function($message) use ($utilizador) {
            $message->to($utilizador->email)
                    ->subject('Novo Código de Recuperação - Clínica Estoril');
        });
        
        return response()->json([
            'success' => true,
            'message' => 'Novo código enviado com sucesso!',
            'token' => $token
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Erro ao reenviar código.'
        ], 500);
    }
}

/**
 * Verifica o código de recuperação
 */
public function verificarCodigoRecuperacao(Request $request)
{
    $request->validate([
        'contact' => 'required|string',
        'code' => 'required|string|size:6',
        'token' => 'required|string'
    ]);
    
    $contact = trim($request->contact);
    $code = $request->code;
    $token = $request->token;
    
    $utilizador = Utilizador::where('email', $contact)
                            ->orWhere('num_telefone', $contact)
                            ->first();
    
    if (!$utilizador) {
        return response()->json([
            'success' => false,
            'message' => 'Usuário não encontrado.'
        ], 404);
    }
    
    $resetRecord = PasswordReset::where('email', $utilizador->email)
                                ->where('token', $token)
                                ->first();
    
    if (!$resetRecord) {
        return response()->json([
            'success' => false,
            'message' => 'Token inválido. Solicite um novo código.'
        ], 400);
    }
    
    // Verificar se o código expirou
    if (now()->gt($resetRecord->expires_at)) {
        return response()->json([
            'success' => false,
            'message' => 'Código expirado. Solicite um novo código.'
        ], 400);
    }
    
    // Verificar código
    if ($resetRecord->codigo_verificacao !== $code) {
        return response()->json([
            'success' => false,
            'message' => 'Código inválido. Verifique e tente novamente.'
        ], 400);
    }
    
    // Gerar novo token para reset de senha
    $resetToken = Str::random(60);
    $resetRecord->reset_token = $resetToken;
    $resetRecord->save();
    
    return response()->json([
        'success' => true,
        'message' => 'Código verificado com sucesso!',
        'reset_token' => $resetToken
    ]);
}

/**
 * Redefine a senha do usuário
 */
public function redefinirSenha(Request $request)
{
    $request->validate([
        'contact' => 'required|string',
        'new_password' => 'required|string|min:8',
        'reset_token' => 'required|string'
    ]);
    
    // Validar força da senha
    $password = $request->new_password;
    if (!preg_match('/[A-Z]/', $password) || 
        !preg_match('/[a-z]/', $password) || 
        !preg_match('/[0-9]/', $password)) {
        return response()->json([
            'success' => false,
            'message' => 'A senha deve conter pelo menos 8 caracteres, uma letra maiúscula, uma minúscula e um número.'
        ], 400);
    }
    
    $contact = trim($request->contact);
    $resetToken = $request->reset_token;
    
    $utilizador = Utilizador::where('email', $contact)
                            ->orWhere('num_telefone', $contact)
                            ->first();
    
    if (!$utilizador) {
        return response()->json([
            'success' => false,
            'message' => 'Usuário não encontrado.'
        ], 404);
    }
    
    $resetRecord = PasswordReset::where('email', $utilizador->email)
                                ->where('reset_token', $resetToken)
                                ->first();
    
    if (!$resetRecord) {
        return response()->json([
            'success' => false,
            'message' => 'Token de redefinição inválido.'
        ], 400);
    }
    
    // Verificar se o token de reset não expirou (24 horas)
    if (now()->diffInHours($resetRecord->created_at) > 24) {
        return response()->json([
            'success' => false,
            'message' => 'Tempo de redefinição expirou. Solicite um novo código.'
        ], 400);
    }
    
    // Atualizar senha do usuário
    $utilizador->senha = Hash::make($password);
    $utilizador->save();
    
    // Atualizar senha nas tabelas relacionadas
    if ($utilizador->id_paciente) {
        $paciente = Paciente::find($utilizador->id_paciente);
        if ($paciente) {
            $paciente->senha = Hash::make($password);
            $paciente->save();
        }
    }
    
    if ($utilizador->id_medico) {
        $medico = Medico::find($utilizador->id_medico);
        if ($medico) {
            $medico->senha = Hash::make($password);
            $medico->save();
        }
    }
    
    if ($utilizador->id_recepcionista) {
        $recepcionista = Recepcionista::find($utilizador->id_recepcionista);
        if ($recepcionista) {
            $recepcionista->senha = Hash::make($password);
            $recepcionista->save();
        }
    }
    
    if ($utilizador->id_admi) {
        $admin = Admi::find($utilizador->id_admi);
        if ($admin) {
            $admin->senha = Hash::make($password);
            $admin->save();
        }
    }
    
    // Limpar registros de recuperação
    PasswordReset::where('email', $utilizador->email)->delete();
    
    return response()->json([
        'success' => true,
        'message' => 'Senha redefinida com sucesso!'
    ]);
}
}