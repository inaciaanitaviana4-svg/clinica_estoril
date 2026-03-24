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
        if (! $medico && ! $admin) {
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
