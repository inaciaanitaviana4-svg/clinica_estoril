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

    public function consultas_paciente()
    {
        $utilizadorid = session('id_utilizador');
        $utilizador = Utilizador::find($utilizadorid);
        if (! session('id_utilizador')) {
            return redirect('/login');
        }
        if (! $utilizador->id_paciente) {
            return redirect('/login')->with('erro', 'paciente sem permissão');
        }

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
            ->orderBy('data')
            ->orderBy('hora')
            ->get();

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

    public function agendar_consulta_paciente_salvar(Request $request)
    {
        if (! session('id_utilizador')) {
            return redirect('/login');
        }
        $utilizador = Utilizador::find(session('id_utilizador'));
        $paciente = Paciente::find($utilizador->id_paciente);
        if (! $paciente) {
            return back()->with('erro', 'paciente não encontrado, faça o login novamente... ');
        }
        $tipo_consulta = TipoConsulta::find($request['id_tipo_consulta']);
        if (! $tipo_consulta) {
            return back()->with('erro', 'tipo de consulta não encontrada... ');
        }
        $servico_clinico = ServicoClinico::find($request['id_servico_clinico']);
        if (! $servico_clinico) {
            return back()->with('erro', 'Servico clinico não encontrado... ');
        }
        if (! $request['data']) {
            return back()->with('erro', 'Data obrigatoria');
        }
        if (! $request['hora']) {
            return back()->with('erro', 'hora obrigatoria');
        }
        try {
            $consulta = Consulta::create([
                'id_paciente' => $paciente->id_paciente,
                'id_tipo_consulta' => $request['id_tipo_consulta'],
                'id_servico_clinico' => $request['id_servico_clinico'],
                'data' => $request['data'],
                'hora' => $request['hora'],
                'estado' => 'pendente',
                'modalidade' => 'agendada',
                'observacao' => $request['observacao'],
            ]);
            if (! $consulta) {
                return back()->with('erro', 'não foi posssivel agendar a consulta');
            }
        } catch (\Throwable $th) {
            return back()->with('erro', 'não foi posssivel agendar a consulta');
        }

        return redirect('/consultas-paciente');

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

    public function mostrar_pacientes_recepcionista()
    {
        $utilizador = verificar_recepcionista();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }

        $pacientes = Paciente::all();

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
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        if (! $request['nome']) {
            return back()->with('erro', 'Nome é obrigatorio');
        }
        if (! $request['email']) {
            return back()->with('erro', 'Email é obrigatorio');
        }
        if (! $request['num_telefone']) {
            return back()->with('erro', 'Número de telefone é obrigatorio');
        }
        if (! $request['num_bi']) {
            return back()->with('erro', 'Número de BI é obrigatorio');
        }
        try {
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

            if (! $paciente) {
                return back()->with('erro', 'não foi posssivel cadastrar o paciente');
            }
        } catch (\Throwable $th) {
            return back()->with('erro', 'não foi posssivel cadastrar o paciente');
        }

        return redirect()->route('mostrar_pacientes_recepcionista')->with('sucesso', 'Paciente cadastrado com sucesso');

    }
}
