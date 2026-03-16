<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function mostrar_horarios_medico()
    {
        $utilizador = verificar_medico();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $horarios = Horario::where('id_medico', $utilizador->id_medico)->get();

        return view('medicos.horarios', compact('horarios'));
    }

    public function salvar_horarios_medico(Request $request)
    {
        $utilizador = verificar_medico();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $id_horario = $request->id_horario??null;
        if ($id_horario) {
            $horario = Horario::find($id_horario);
            if (!$horario) {
                return back()->with('erro', 'Horario não encontrado');
            }
            $horario->dia_semana = $request->dia_semana;
            $horario->hora = $request->hora;
            $horario->activo = $request->boolean('activo');
            $horario->save();
        } else {
            Horario::create([
                'id_medico' => $utilizador->id_medico,
                'dia_semana' => $request->dia_semana,
                'hora' => $request->hora,
                'activo' => $request->boolean('activo'),
            ]);
        }

        return redirect(route('mostrar_horarios_medico'));
    }
}
