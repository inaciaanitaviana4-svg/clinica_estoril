<?php

namespace App\Http\Controllers;

use App\Models\Admi;
use App\Models\Consulta;
use App\Models\Especialidade;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\recepcionista;
use App\Models\Utilizador;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UtilizadoresController extends Controller
{

    private function obter_tipo_utilizador($tipo)
    {
        if ($tipo == 0)
            return "administrador";
        if ($tipo == 1)
            return "recepcionista";
        if ($tipo == 2)
            return "medico";
        if ($tipo == 3)
            return "paciente";
    }
    private function verificar_admin()
    {
        if (!session("id_utilizador")) {
            return false;
        }
        $utilizador = Utilizador::find(session("id_utilizador"));
        if (!$utilizador) {
            return false;
        }
        if (!$utilizador->id_admi) {
            return false;
        }
        if ($utilizador->nivel_acesso != 0) {
            return false;
        }
        return true;

    }
    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $utilizador = Utilizador::where('email', $credentials['email'])->first();
        if ($utilizador) {
            $senhValida = Hash::check($credentials["password"], $utilizador->senha);
            if ($senhValida) {
                session(["id_utilizador" => $utilizador->id_util]);
                //  flash()->success('login efectuado com sucesso');
                if ($utilizador->nivel_acesso==0) {
                    session(["tipo_utilizador" => "admi"]);
                    return redirect('/admin/dashboard');
                }
                if ($utilizador->nivel_acesso== 1) {
                    session(["tipo_utilizador" => "recepcionista"]);
                    return redirect(route('mostrar_consultas_recepcionista'));
                }
                if ($utilizador->nivel_acesso== 2) {
                    session(["tipo_utilizador" => "medico"]);
                    return redirect(route('mostrar_consultas_medico'));

                }
                session(["tipo_utilizador" => "paciente"]);
                return redirect("/consultas-paciente");
            }

        }


        // flash()->error('Credenciais inválidas');
        return back()->with(
            'erro',
            'Email ou senha incorretos. Verifique suas credenciais e tente novamente.',
        );
    }

    public function sair(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->forget(["id_utilizador", "tipo_utilizador"]);
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function cadastrarpaciente(Request $request)
    {
        $emailexiste = Paciente::where('email', $request->email)->first();
        $emailexisteutilizador = Utilizador::where('email', $request->email)->first();
        if ($emailexiste || $emailexisteutilizador) {
            return back()->with('erro', 'Este email já está cadastrado no sistema. Use um email diferente ou faça login se já possui uma conta.');
        }
        $num_telefoneexiste = Paciente::where('num_telefone', $request->num_telefone)->first();
        $num_telefoneexisteutilizador = Utilizador::where('num_telefone', $request->num_telefone)->first();
        if ($num_telefoneexiste || $num_telefoneexisteutilizador) {
            return back()->with('erro', 'Este número de telefone já está registrado no sistema. Use um número diferente.');
        }
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
            'id_clinica' => 1
        ]);
        $utilizador = Utilizador::create([
            "num_telefone" => $request["num_telefone"],
            "senha" => Hash::make($request["senha"]),
            'nome' => $request["nome"],
            'genero' => $request["genero"],
            'email' => $request["email"],
            "nivel_acesso" => 3,
            'id_paciente' => $paciente->id_paciente,
        ]);
        if ($utilizador) {
            session(["id_utilizador" => $utilizador->id]);
            session(["tipo_utilizador" => "paciente"]);
            return redirect("/");
        }
        return back()->with("erro", "Desculpe, não foi possível completar o cadastro. Tente novamente mais tarde ou contate o suporte.");
    }
    public function criar_conta_paciente()
    {
        return view("criar_conta_paciente");
    }

    public function visualizar_perfil()
    {
        if (!session("id_utilizador")) {
            return redirect("/login");
        }
        $utilizador = Utilizador::find(session("id_utilizador"));
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
            "utilizador" => $utilizador,
            "paciente" => $paciente,
            "admin" => $admin,
            "medico" => $medico,
            "recepcionista" => $recepcionista
        ];
        return view("utilizadores.perfil", compact("dados", "utilizador"));

    }
    public function editar_perfil()
    {
        if (!session("id_utilizador")) {
            return redirect("/login");
        }
        $utilizador = Utilizador::find(session("id_utilizador"));
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
            "utilizador" => $utilizador,
            "paciente" => $paciente,
            "admin" => $admin,
            "medico" => $medico,
            "recepcionista" => $recepcionista
        ];
        return view("utilizadores.editar_perfil", compact("dados", "utilizador"));

    }
    public function editar_perfil_salvar(Request $request, )
    {
        if (!session("id_utilizador")) {
            return redirect("/login");
        }
        $utilizador = Utilizador::find(session("id_utilizador"));
        if (!$utilizador) {
            return back()->with("erro", "Usuário não encontrado. Verifique o ID e tente novamente.");
        }

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
        $utilizador->num_telefone = $request["num_telefone"];
        $utilizador->email = $request["email"];
        $utilizador->genero = $request["genero"];
        $utilizador->nome = $request["nome"];
        $utilizador->save();
        if ($admin) {
            $admin->morada = $request["morada"];
            $admin->num_telefone = $request["num_telefone"];
            $admin->nome = $request["nome"];
            $admin->genero = $request["genero"];
            $admin->email = $request["email"];
            $admin->save();
        }
        if ($paciente) {
            $paciente->morada = $request["morada"];
            $paciente->num_telefone = $request["num_telefone"];
            $paciente->nome = $request["nome"];
            $paciente->genero = $request["genero"];
            $paciente->email = $request["email"];
            $paciente->data_nascimento = $request["data_nascimento"];
            $paciente->num_bi = $request["num_bi"];
            $paciente->estado_civil = $request["estado_civil"];
            $paciente->cidade = $request["cidade"];
            $paciente->bairro = $request["bairro"];
            $paciente->seguro = $request["seguro"];
            $paciente->save();
        }
        if ($recepcionista) {
            $recepcionista->morada = $request["morada"];
            $recepcionista->num_telefone = $request["num_telefone"];
            $recepcionista->nome = $request["nome"];
            $recepcionista->genero = $request["genero"];
            $recepcionista->email = $request["email"];
            $recepcionista->save();
        }
        if ($medico) {
            $medico->morada = $request["morada"];
            $medico->num_telefone = $request["num_telefone"];
            $medico->nome = $request["nome"];
            $medico->genero = $request["genero"];
            $medico->email = $request["email"];
            $medico->especialidade = $request["especialidade"];
            $medico->ano_experiencia = $request["ano_experiencia"];
            $medico->save();
        }
        return redirect("/visualizar-perfil");
    }
    public function remover_utilizador_admin($id_util)
    {
        if (!$this->verificar_admin()) {
            return response()->json(["erro" => "Você não tem permissão para remover usuários. Apenas administradores podem realizar esta ação.",], 401);

        }
        if (session("id_utilizador") == $id_util) {
            return response()->json(["erro" => "Você não pode remover sua própria conta. Contacte outro administrador para esta ação.",], 401);
        }
        $utilizador = Utilizador::find($id_util);
        if (!$utilizador) {
            return response()->json(["erro" => "Usuário não encontrado. Verifique o ID e tente novamente.",], 404);
        }
        if ($utilizador->id_paciente)
            Paciente::destroy($utilizador->id_paciente);
        if ($utilizador->id_admi)
            Admi::destroy($utilizador->id_admi);
        if ($utilizador->id_recepcionista)
            Recepcionista::destroy($utilizador->id_recepcionista);
        if ($utilizador->id_medico)
            Medico::destroy($utilizador->id_medico);

        Utilizador::destroy($id_util);

        return response()->json(["mensagem" => "Usuário removido com sucesso do sistema.",], 200);
    }
    public function mostrar_registro_utilizador_admin($id_util = null)
    {
        if (!$this->verificar_admin()) {
            return back()->with("erro", "Não tem permissão para acessar esta página");
        }
        if (session("id_utilizador") == $id_util) {
            return back()->with("erro", "Não pode editar o seu próprio usuário", );
        }
        $utilizador = $id_util ? Utilizador::find($id_util) : null;
        $paciente = null;
        $admin = null;
        $medico = null;
        $recepcionista = null;
        $tipo_utilizador = $this->obter_tipo_utilizador($utilizador->nivel_acesso ??'');
    
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
        $especialidades = Especialidade::all();
        $dados = [
            "utilizador" => $utilizador,
            "paciente" => $paciente,
            "admin" => $admin,
            "medico" => $medico,
            "recepcionista" => $recepcionista
        ];
        return view("utilizadores.registro", compact("dados", "utilizador", "especialidades","tipo_utilizador"));

    }
    // Essa é parte de fazer o cadastramento dos utilizadores de acordo com o seu nivel de acesso.
    public function salvar_registro_utilizador_admin(Request $request, $id_util = null)
    {
        if (!$this->verificar_admin()) {
            return back()->with("erro", "Não tem permissão para acessar esta página");
        }
        if (session("id_utilizador") == $id_util) {
            return back()->with("erro", "Não pode editar o seu próprio usuário", );
        }
        $utilizador = $id_util ? Utilizador::find($id_util) : null;
        if ($id_util && !$utilizador) {
            return back()->with("erro", "utilizador não encontrado");
        }

        $paciente = null;
        $admin = null;
        $medico = null;
        $recepcionista = null;

        $emailexisteutilizador = Utilizador::where('email', $request->email)->first();
        if (($id_util && $emailexisteutilizador && $emailexisteutilizador->id_util != $id_util) || (!$id_util && $emailexisteutilizador)) {
            return back()->with('erro', 'Este email já está cadastrado no sistema. Use um email diferente.');
        }
        $num_telefoneexisteutilizador = Utilizador::where('num_telefone', $request->num_telefone)->first();
        if (($id_util && $num_telefoneexisteutilizador && $num_telefoneexisteutilizador->id_util != $id_util) || (!$id_util && $num_telefoneexisteutilizador)) {
            return back()->with('erro', 'Este número de telefone já está registrado. Use um número diferente.');
        }
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
        if ($id_util && !$request->senha) {
            $senha = $utilizador->senha;
        } else {
            $senha = Hash::make($request->senha);
        }
    
        $tipo = $request->tipo;
        $nivel_acesso = 0;
        $admin = $id_util ? $admin : new Admi();
        if ($tipo == 'administrador') {
            $admin->morada = $request["morada"];
            $admin->num_telefone = $request["num_telefone"];
            $admin->nome = $request["nome"];
            $admin->genero = $request["genero"];
            $admin->email = $request["email"];
            $admin->senha = $senha;
            $admin->save();
        }
        $paciente = $id_util ? $paciente : new Paciente();
        if ($tipo == 'paciente') {
            $nivel_acesso = 3;
            $paciente->morada = $request["morada"];
            $paciente->num_telefone = $request["num_telefone"];
            $paciente->nome = $request["nome"];
            $paciente->genero = $request["genero"];
            $paciente->email = $request["email"];
            $paciente->data_nascimento = $request["data_nascimento"];
            $paciente->num_bi = $request["num_bi"];
            $paciente->estado_civil = $request["estado_civil"];
            $paciente->cidade = $request["cidade"];
            $paciente->bairro = $request["bairro"];
            $paciente->seguro = $request["seguro"];
            $paciente->senha = $senha;
            $paciente->id_clinica = 1;
            $paciente->save();
        }
        $recepcionista = $id_util ? $recepcionista : new Recepcionista();
        if ($tipo == 'recepcionista') {
            $nivel_acesso = 1;
            $recepcionista->morada = $request["morada"];
            $recepcionista->num_telefone = $request["num_telefone"];
            $recepcionista->nome = $request["nome"];
            $recepcionista->genero = $request["genero"];
            $recepcionista->email = $request["email"];
            $recepcionista->senha = $senha;
            $recepcionista->id_clinica = 1;
            $recepcionista->save();
        }
        $medico = $id_util ? $medico : new Medico();
        if ($tipo == "medico") {
            $nivel_acesso = 2;
            $medico->morada = $request["morada"];
            $medico->num_telefone = $request["num_telefone"];
            $medico->nome = $request["nome"];
            $medico->genero = $request["genero"];
            $medico->email = $request["email"];
            $medico->especialidade = $request["especialidade"];
            $medico->ano_experiencia = $request["ano_experiencia"];
            $medico->senha = $senha;
            $medico->id_clinica = 1;
            $medico->save();
        }
        $utilizador = $id_util ? $utilizador : new Utilizador();
        $utilizador->num_telefone = $request["num_telefone"];
        $utilizador->email = $request["email"];
        $utilizador->genero = $request["genero"];
        $utilizador->nome = $request["nome"];
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

