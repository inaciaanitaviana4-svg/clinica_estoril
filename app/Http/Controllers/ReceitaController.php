<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Receita;
use App\Models\ReceitaItem;
use Illuminate\Http\Request;

class ReceitaController extends Controller
{
    public function api_adicionar_medicamento_consulta_medico(Request $request, $id_consulta)
    {
        $utilizador = verificar_medico();
        if (! $utilizador) {
            return response()->json(['erro' => 'Não tem permissão para acessar esta API'], 403);
        }
        $consulta = Consulta::find($id_consulta);
        if (! $consulta) {
            return response()->json(['erro' => 'Consulta não encontrada'], 404);
        }
        if ($consulta->id_medico != $utilizador->id_medico) {
            return response()->json(['erro' => 'Não tem permissão para acessar esta consulta'], 403);
        }
        try {
            $receita = Receita::where('id_consulta', $id_consulta)->first();
            if (! $receita) {
                $receita = new Receita;
                $receita->id_consulta = $id_consulta;
                $receita->criado_em = now();
                $receita->actualizado_em = now();
                $receita->save();
            } else {
                $receita->actualizado_em = now();
                $receita->save();
            }
            ReceitaItem::create([
                'id_receita' => $receita->id_receita,
                'medicamento' => $request->input('medicamento'),
                'dosagem' => $request->input('dosagem'),
                'frequencia' => $request->input('frequencia'),
                'duracao' => $request->input('duracao'),
            ]);
        } catch (\Throwable $th) {
            return response()->json(['erro' => 'Erro ao adicionar medicamento: '], 500);
        }

        return response()->json(['sucesso' => 'Medicamento adicionado com sucesso']);
    }

    public function api_listar_medicamentos_consulta_medico($id_consulta)
    {
        $utilizador = verificar_medico();
        if (! $utilizador) {
            return response()->json(['erro' => 'Não tem permissão para acessar esta API'], 403);
        }
        $consulta = Consulta::find($id_consulta);
        if (! $consulta) {
            return response()->json(['erro' => 'Consulta não encontrada'], 404);
        }
        if ($consulta->id_medico != $utilizador->id_medico) {
            return response()->json(['erro' => 'Não tem permissão para acessar esta consulta'], 403);
        }
        $receita = Receita::where('id_consulta', $id_consulta)->first();
        if (! $receita) {
            return response()->json(['erro' => 'Receita não encontrada'], 404);
        }
        $medicamentos = ReceitaItem::where('id_receita', $receita->id_receita)->get();
        return response()->json($medicamentos);
    }

    public function api_remover_medicamento_consulta_medico($id_consulta, $id_medicamento)
    {
        $utilizador = verificar_medico();
        if (! $utilizador) {
            return response()->json(['erro' => 'Não tem permissão para acessar esta API'], 403);
        }
        $consulta = Consulta::find($id_consulta);
        if (! $consulta) {
            return response()->json(['erro' => 'Consulta não encontrada'], 404);
        }
        if ($consulta->id_medico != $utilizador->id_medico) {
            return response()->json(['erro' => 'Não tem permissão para acessar esta consulta'], 403);
        }
        $receita = Receita::where('id_consulta', $id_consulta)->first();
        if (! $receita) {
            return response()->json(['erro' => 'Receita não encontrada'], 404);
        }
        $medicamento = ReceitaItem::find($id_medicamento);
        if (! $medicamento) {
            return response()->json(['erro' => 'Medicamento não encontrado'], 404);
        }
        try {
            $medicamento->delete();
            return response()->json(['sucesso' => 'Medicamento removido com sucesso']);
        } catch (\Throwable $th) {
            return response()->json(['erro' => 'Erro ao remover medicamento: '], 500);
        }
    }

    public function api_salvar_observacoes_receita_consulta_medico(Request $request, $id_consulta)
    {
        $utilizador = verificar_medico();
        if (! $utilizador) {
            return response()->json(['erro' => 'Não tem permissão para acessar esta API'], 403);
        }
        $consulta = Consulta::find($id_consulta);
        if (! $consulta) {
            return response()->json(['erro' => 'Consulta não encontrada'], 404);
        }
        if ($consulta->id_medico != $utilizador->id_medico) {
            return response()->json(['erro' => 'Não tem permissão para acessar esta consulta'], 403);
        }
        $receita = Receita::where('id_consulta', $id_consulta)->first();
        try {
            if (! $receita) {
                $receita = new Receita();
                $receita->id_consulta = $id_consulta;
                $receita->observacoes = $request->input('observacoes');
                $receita->criado_em = now();
                $receita->actualizado_em = now();
                $receita->save();
            } else {
                $receita->observacoes = $request->input('observacoes');
                $receita->actualizado_em = now();
                $receita->save();
            }
            return response()->json(['sucesso' => 'Observações da receita salvas com sucesso']);
        } catch (\Throwable $th) {
            return response()->json(['erro' => 'Erro ao salvar observações da receita: '], 500);
        }
    }

    public function api_buscar_receita_para_imprimir_consulta_medico($id_consulta)
    {
        $utilizador = verificar_medico();
        if (! $utilizador) {
            return response()->json(['erro' => 'Não tem permissão para acessar esta API'], 403);
        }
        $consulta = Consulta::select(
            "consultas.id_consulta",
            "consultas.id_medico",
            "consultas.id_paciente",
            "consultas.data",
            "consultas.hora",
            "medico.nome as nome_medico",
            "paciente.nome as nome_paciente",
            "paciente.data_nascimento as data_nascimento_paciente",
            "paciente.num_telefone as telefone_paciente",
            "servicos_clinicos.nome as nome_servico_clinico",
            "receitas.id_receita",
            "receitas.observacoes as observacoes_receita"
        )
            ->join('receitas', 'consultas.id_consulta', '=', 'receitas.id_consulta')
            ->join('medico', 'consultas.id_medico', '=', 'medico.id_medico')
            ->join('paciente', 'consultas.id_paciente', '=', 'paciente.id_paciente')
            ->join('servicos_clinicos', 'consultas.id_servico_clinico', '=', 'servicos_clinicos.id_servico_clinico')
            ->where('consultas.id_consulta', $id_consulta)
            ->first();
        if (! $consulta) {
            return response()->json(['erro' => 'Consulta não encontrada'], 404);
        }
        if ($consulta->id_medico != $utilizador->id_medico) {
            return response()->json(['erro' => 'Não tem permissão para acessar esta consulta'], 403);
        }

        $receita = Receita::where('id_consulta', $id_consulta)->first();
        if (! $receita) {
            return response()->json(['erro' => 'Receita nao encontrada'], 404);
        }

        $medicamentos = ReceitaItem::where('id_receita', $receita->id_receita)->get();

        return response()->json([
            'consulta' => $consulta,
            'medicamentos' => $medicamentos,
        ]);
    }
}
