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
            return response()->json(['erro' => 'Erro ao remover medicamento: ' ], 500);
        }
    }
}
