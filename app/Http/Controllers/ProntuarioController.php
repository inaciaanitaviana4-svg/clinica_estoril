<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use App\Models\Paciente;

class ProntuarioController extends Controller
{
    public function mostrar_prontuarios_medico()
    {
        $utilizador = verificar_medico();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $pacientes = Paciente::join('consultas', 'paciente.id_paciente', '=', 'consultas.id_paciente')
            ->where('consultas.id_medico', '=', $utilizador->id_medico)
            ->select('paciente.*')
            ->distinct()->get();

        return view('medicos.prontuarios', compact('pacientes'));
    }

    public function mostrar_detalhes_prontuario_medico($id_paciente)
    {
        $paciente = Especialidade::find($id_paciente);

        return view('medicos.detalhes_prontuario', compact('paciente'));
    }
}
