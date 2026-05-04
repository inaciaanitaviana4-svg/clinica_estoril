<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Especialidade;
use App\Models\Horario;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\ServicoClinico;
use App\Models\TipoConsulta;
use App\Models\Utilizador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PacienteController extends Controller
{
    public function perfil_paciente()
    {
        $utilizadorid = session('id_utilizador');
        if (! session('id_utilizador')) {
            return redirect('/login');
        }
        $utilizador = Utilizador::find(id: $utilizadorid);
        $paciente = Paciente::find(id: $utilizador->id_paciente);

        return view('pacientes.perfil', ['paciente' => $paciente]);
    }

    public function consultas_paciente(Request $request)
    {
        $utilizadorid = session('id_utilizador');
        $utilizador = Utilizador::find($utilizadorid);
        if (! session('id_utilizador')) {
            return redirect('/login');
        }
        if (! $utilizador->id_paciente) {
            return redirect('/login')->with('erro', 'paciente sem permissão');
        }
        $pesquisar_consultas = $request->query('pesquisar_consultas') ?? '';
        $consultas = Consulta::select(
            'consultas.id_consulta',
            'tipos_consultas.nome as tipo_consulta',
            'consultas.modalidade',
            'consultas.data',
            'consultas.hora',
            'consultas.estado',
            'medico.nome as nome_medico',
            'servicos_clinicos.nome as nome_servico_clinico',
            'servicos_clinicos.preco as preco_servico_clinico'
        )
            ->leftJoin('medico', 'consultas.id_medico', '=', 'medico.id_medico')
            ->leftJoin('servicos_clinicos', 'consultas.id_servico_clinico', '=', 'servicos_clinicos.id_servico_clinico')
            ->leftJoin('tipos_consultas', 'consultas.id_tipo_consulta', '=', 'tipos_consultas.id_tipo_consulta')
            ->where('id_paciente', $utilizador->id_paciente)
            ->where(function ($query) use ($pesquisar_consultas) {
                $query->where('consultas.modalidade', 'like', "%$pesquisar_consultas%")
                    ->orWhere('tipos_consultas.nome', 'like', "%$pesquisar_consultas%")
                    ->orWhere('servicos_clinicos.nome', 'like', "%$pesquisar_consultas%")
                    ->orWhere('medico.nome', 'like', "%$pesquisar_consultas%")
                    ->orWhere('servicos_clinicos.preco', 'like', "%$pesquisar_consultas%")
                    ->orWhere('consultas.data', 'like', "%$pesquisar_consultas%")
                    ->orWhere('consultas.hora', 'like', "%$pesquisar_consultas%")
                    ->orWhere('consultas.estado', 'like', "%$pesquisar_consultas%");

            })
            ->orderBy('data')
            ->orderBy('hora')
            ->paginate(10);

        return view('pacientes.consultas', ['consultas' => $consultas]);
    }

    public function agendar_consulta_paciente()
    {
        if (! session('id_utilizador')) {
            return redirect('/login');
        }
        $especialidades = Especialidade::all();
        $medicos = Medico::all();
        $tipos_consultas = TipoConsulta::all();
        $horarios = Horario::where('activo', true)->get();
        $servicos_clinicos = ServicoClinico::where('activo', true)->get();

        return view('pacientes.agendar_consulta', compact('especialidades', 'horarios', 'servicos_clinicos', 'tipos_consultas'));
    }

  

    public function cancelar_consulta_paciente(Request $request, $id_consulta)
    {
        try {

            if (! session('id_utilizador')) {
                return redirect('/login');
            }
            $utilizador = Utilizador::find(session('id_utilizador'));
            $paciente = Paciente::find($utilizador->id_paciente);
            if (! $paciente) {
                return back()->with('erro', 'paciente não encontrado, faça o login novamente... ');
            }
            $consulta = Consulta::find($id_consulta);
            if (! $consulta) {
                return back()->with('erro', 'Consulta não encontrada');
            }
            if ($consulta->estado != 'pendente' && $consulta->estado != 'agendada') {
                return back()->with('erro', 'apenas podes cancelar consultas pendentes ou agendadas');
            }
            $consulta->estado = 'cancelada';
            $consulta->save();

            return redirect('/consultas-paciente');
        } catch (\Throwable $th) {
            return back()->with('erro', 'erro ao cancelar a consulta, tente mais tarde...');
        }
    }

    public function confirmar_consulta_paciente(Request $request, $id_consulta)
    {
        try {

            if (! session('id_utilizador')) {
                return redirect('/login');
            }
            $utilizador = Utilizador::find(session('id_utilizador'));
            $paciente = Paciente::find($utilizador->id_paciente);
            if (! $paciente) {
                return back()->with('erro', 'paciente não encontrado, faça o login novamente... ');
            }
            $consulta = Consulta::find($id_consulta);
            if (! $consulta) {
                return back()->with('erro', 'Consulta não encontrada');
            }
            if ($consulta->estado != 'agendada') {
                return back()->with('erro', 'apenas podes confirmar consultas agendadas');
            }
            $consulta->estado = 'confirmada';
            $consulta->save();

            return redirect('/consultas-paciente');
        } catch (\Throwable $th) {
            return back()->with('erro', 'erro ao cancelar a consulta, tente mais tarde...');
        }
    }

    public function notificacoes_paciente()
    {
        $utilizadorid = session('id_utilizador');
        if (! session('id_utilizador')) {
            return redirect('/login');
        }

        return view('pacientes.notificacoes');
    }

    public function mostrar_pacientes_recepcionista(Request $request)
    {
        $utilizador = verificar_recepcionista();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $pesquisar_pacientes = $request->query('pesquisar_pacientes') ?? '';
        $pacientes = Paciente::where(function ($query) use ($pesquisar_pacientes) {
            $query->where('paciente.nome', 'like', "%$pesquisar_pacientes%")
                ->orWhere('paciente.data_nascimento', 'like', "%$pesquisar_pacientes%")
                ->orWhere('paciente.num_telefone', 'like', "%$pesquisar_pacientes%")
                ->orWhere('paciente.email', 'like', "%$pesquisar_pacientes%")
                ->orWhere('paciente.genero', 'like', "%$pesquisar_pacientes%");

        })
            ->paginate(10);

        return view('pacientes.listar_pacientes_recepcionista', ['pacientes' => $pacientes]);
    }

    public function detalhes_paciente_recepcionista($id_paciente)
    {
        $utilizador = verificar_recepcionista();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }

        $paciente = Paciente::find($id_paciente);
        if (! $paciente) {
            return back()->with('erro', 'Paciente não encontrado');
        }

        return view('pacientes.detalhes_paciente_recepcionista', ['paciente' => $paciente]);
    }

    public function mostrar_cadastro_paciente_recepcionista()
    {
        $utilizador = verificar_recepcionista();
        if (! $utilizador) {

            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }

        return view('pacientes.cadastrar_paciente_recepcionista');
    }

 public function salvar_cadastro_paciente_recepcionista(Request $request)
{
    $utilizador = verificar_recepcionista();
    if (!$utilizador) {
        return back()->with('erro', 'Não tem permissão para acessar esta página');
    }
    if (!$request['nome']) {
        return back()->with('erro', 'Nome é obrigatorio');
    }
    if (!$request['email']) {
        return back()->with('erro', 'Email é obrigatorio');
    }
    if (!$request['num_telefone']) {
        return back()->with('erro', 'Número de telefone é obrigatorio');
    }
    if (!$request['num_bi']) {
        return back()->with('erro', 'Número de BI é obrigatorio');
    }
    try {
        $emailexiste           = Paciente::where('email', $request->email)->first();
        $emailexisteutilizador = Utilizador::where('email', $request->email)->first();
        if ($emailexiste || $emailexisteutilizador) {
            return back()->with('erro', 'Este email já está cadastrado.');
        }

        $num_telefoneexiste           = Paciente::where('num_telefone', $request->num_telefone)->first();
        $num_telefoneexisteutilizador = Utilizador::where('num_telefone', $request->num_telefone)->first();
        if ($num_telefoneexiste || $num_telefoneexisteutilizador) {
            return back()->with('erro', 'Este número de telefone já está registrado.');
        }

        if ($request['senha'] != $request['confirmar_senha']) {
            return back()->with('erro', 'As senhas não coincidem.');
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

        // ── FOTO ──────────────────────────────────────────
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
        // ──────────────────────────────────────────────────

        $utilizadorNovo = Utilizador::create([
            'num_telefone' => $request['num_telefone'],
            'senha'        => Hash::make($request['senha']),
            'nome'         => $request['nome'],
            'genero'       => $request['genero'],
            'email'        => $request['email'],
            'foto'         => $foto,
            'nivel_acesso' => 3,
            'id_paciente'  => $paciente->id_paciente,
        ]);

        if (!$paciente) {
            return back()->with('erro', 'Não foi possível cadastrar o paciente');
        }

    } catch (\Throwable $th) {
        return back()->with('erro', 'Não foi possível cadastrar o paciente: ' . $th->getMessage());
    }

    return redirect()->route('mostrar_pacientes_recepcionista')->with('sucesso', 'Paciente cadastrado com sucesso');
}
public function api_pesquisar_pacientes(Request $request)
{
    $termo = $request->query('termo', '');
    
    if (strlen($termo) < 2) {
        return response()->json([]);
    }

    $pacientes = Paciente::where('nome', 'like', "%$termo%")
        ->orWhere('num_telefone', 'like', "%$termo%")
        ->orWhere('email', 'like', "%$termo%")
        ->select('id_paciente', 'nome', 'num_telefone', 'email')
        ->limit(10)
        ->get();

    return response()->json($pacientes);
}
}
