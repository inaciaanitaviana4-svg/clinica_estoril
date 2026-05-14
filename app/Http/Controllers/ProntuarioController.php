<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Diagnostico;
use App\Models\ExameSolicitado;
use App\Models\Paciente;
use App\Models\Receita;
use App\Models\ReceitaItem;
use Illuminate\Http\Request;

class ProntuarioController extends Controller
{
    public function mostrar_prontuarios_medico(Request $request)
    {
        $medico = verificar_medico();
        if (! $medico) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $pesquisar_prontuarios = $request->query('pesquisar_prontuarios') ?? '';
        $pacientes = $medico ? Paciente::join('consultas', 'paciente.id_paciente', '=', 'consultas.id_paciente')
            ->where('consultas.id_medico', '=', $medico->id_medico)
            ->where(function ($query) use ($pesquisar_prontuarios) {
                $query->where('paciente.nome', 'like', "%$pesquisar_prontuarios%")
                    ->orWhere('paciente.data_nascimento', 'like', "%$pesquisar_prontuarios%")
                    ->orWhere('paciente.num_telefone', 'like', "%$pesquisar_prontuarios%")
                    ->orWhere('paciente.email', 'like', "%$pesquisar_prontuarios%")
                    ->orWhere('paciente.genero', 'like', "%$pesquisar_prontuarios%");
            })
            ->select('paciente.*')
            ->distinct()->paginate(10) : Paciente::join('consultas', 'paciente.id_paciente', '=', 'consultas.id_paciente')
            ->select('paciente.*')
            ->distinct()
           ->paginate(10);

        return view('medicos.prontuarios', compact('pacientes'));
    }

    public function mostrar_prontuarios_admin(Request $request)
    {
        $admin = verificar_admin();
        if (! $admin) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $pesquisar_prontuarios = $request->query('pesquisar_prontuarios') ?? '';
        $pacientes = Paciente::join('consultas', 'paciente.id_paciente', '=', 'consultas.id_paciente')
            ->where(function ($query) use ($pesquisar_prontuarios) {
                $query->where('paciente.nome', 'like', "%$pesquisar_prontuarios%")
                    ->orWhere('paciente.data_nascimento', 'like', "%$pesquisar_prontuarios%")
                    ->orWhere('paciente.num_telefone', 'like', "%$pesquisar_prontuarios%")
                    ->orWhere('paciente.email', 'like', "%$pesquisar_prontuarios%")
                    ->orWhere('paciente.genero', 'like', "%$pesquisar_prontuarios%");

            })
            ->select('paciente.*')
            ->distinct()
            ->paginate(10);

        return view('admin.prontuarios', compact('pacientes'));
    }

    public function mostrar_prontuario_paciente(Request $request)
    {
        $paciente = verificar_paciente();
        if (! $paciente) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
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
            ->where('id_paciente', $paciente->id_paciente)
            ->where('consultas.estado', 'concluida')
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
        return view('pacientes.prontuario', compact('consultas'));
    }

    public function mostrar_detalhes_prontuario_medico($id_paciente)
    {
        $medico = verificar_medico();
        if (! $medico) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $paciente = Paciente::find($id_paciente);
        if (! $paciente) {
            return back()->with('erro', 'Paciente não encontrado');
        }

        $consultas = Consulta::select('consultas.*', 'medico.nome AS nome_medico')
            ->join('medico', 'consultas.id_medico', '=', 'medico.id_medico')
            ->where('id_paciente', $id_paciente)
            ->get();

        $totalConsultas = $consultas->count();

        return view('medicos.detalhes_prontuario', compact('paciente', 'consultas', 'totalConsultas'));
    }
    public function mostrar_detalhes_consulta_paciente($id_consulta)
    {
        $paciente = verificar_paciente();
        if (! $paciente) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $consulta = Consulta::select('consultas.*', 'medico.nome AS nome_medico')
            ->join('medico', 'consultas.id_medico', '=', 'medico.id_medico')
             ->where('id_consulta', $id_consulta)
            ->first();

        return view('pacientes.detalhes_prontuario', compact('paciente', 'consulta'));
    }

    public function mostrar_detalhes_prontuario_admin($id_paciente)
    {
        $medico = verificar_medico();
        $admin = verificar_admin();
        if (! $medico && ! $admin) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $paciente = Paciente::find($id_paciente);
        if (! $paciente) {
            return back()->with('erro', 'Paciente não encontrado');
        }

        $consultas = Consulta::select('consultas.*', 'medico.nome AS nome_medico')
            ->join('medico', 'consultas.id_medico', '=', 'medico.id_medico')
            ->where('id_paciente', $id_paciente)
            ->get();

        $totalConsultas = $consultas->count();
        if ($admin) {
            return view('admin.detalhes_prontuario', compact('paciente', 'consultas', 'totalConsultas'));
        } elseif ($medico) {
            return view('medicos.detalhes_prontuario', compact('paciente', 'consultas', 'totalConsultas'));
        }
    }

    public function api_buscar_consultas_prontuario_medico($id_consulta, $view = null)
    {
        $medico = verificar_medico();
        $admin = verificar_admin();
        $paciente = verificar_paciente();
        if (! $medico && ! $admin && ! $paciente) {
            return response()->json(['erro' => 'Não tem permissão para acessar esta API'], 403);
        }

        $consulta = Consulta::select('consultas.*', 'medico.nome as medico')
            ->join('medico', 'consultas.id_medico', '=', 'medico.id_medico')
            ->where('id_consulta', $id_consulta)
            ->first();

        if (! $consulta) {
            return response()->json(['erro' => 'Consulta não encontrada'], 404);
        }

        $diagnosticos = Diagnostico::where('id_consulta', $id_consulta)
            ->select('descricao')
            ->get()
            ->toArray();

        $exames = ExameSolicitado::where('id_consulta', $id_consulta)
            ->select('exames_solicitados.*', 'servicos_clinicos.nome as servico_clinico')
            ->join('servicos_clinicos', 'exames_solicitados.id_servico_clinico', '=', 'servicos_clinicos.id_servico_clinico')
            ->get()
            ->toArray();

        $receitas = Receita::where('id_consulta', $id_consulta)
            ->select('receitas.*')
            ->get()
            ->toArray();

        $receitas = array_map(function ($receita) {
            $itens = ReceitaItem::where('id_receita', $receita['id_receita'])
                ->select('medicamento', 'dosagem', 'frequencia', 'duracao')
                ->get()
                ->toArray();

            $receita['itens'] = array_map(function ($item) {
                return [
                    'medicamento' => $item['medicamento'],
                    'dosagem' => $item['dosagem'],
                    'frequencia' => $item['frequencia'],
                    'duracao' => $item['duracao'],
                ];
            }, $itens);

            return $receita;
        }, $receitas);

        $resultado = [
            ...$consulta->toArray(),
            'diagnosticos' => $diagnosticos,
            'exames' => $exames,
            'receitas' => $receitas,
        ];

        return response()->json($resultado);
    }
}