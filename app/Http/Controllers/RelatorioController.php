<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function mostrar_relatorios_medico()
    {
        $utilizador = verificar_medico();
        if (! $utilizador) {
            return back()->with('erro', 'não tem permissão para acessar essa pagina ');
        }

        return view('medicos.relatorios');
    }

    public function api_relatorio_consultas(Request $request)
    {
        $medico = verificar_medico();
        $admin = verificar_admin();
        if (! $medico && ! $admin) {
            return response()->json(['erro' => 'Não tem permissão para acessar este relatório'], status: 403);
        }

        $query = Consulta::select('consultas.*');

        // Filtros dinâmicos
        if ($medico || $request->id_medico) {
            $query->where('id_medico', $medico->id_medico ?? $request->id_medico);
        }

        if ($request->id_paciente) {
            $query->where('id_paciente', $request->id_paciente);
        }

        if ($request->estado) {
            $query->where('estado', $request->estado);
        }

        if ($request->id_recepcionista) {
            $query->where('id_recepcionista', $request->id_recepcionista);
        }

        if ($request->id_tipo_consulta) {
            $query->where('id_tipo_consulta', $request->id_tipo_consulta);
        }

        if ($request->id_servico_clinico) {
            $query->where('id_servico_clinico', $request->id_servico_clinico);
        }

        if ($request->data_inicio && $request->data_fim) {
            $query->whereBetween('data', [$request->data_inicio, $request->data_fim]);
        }

        $consultas = $query->orderBy('data', 'desc')->get();

        return response()->json($consultas);
    }
}
