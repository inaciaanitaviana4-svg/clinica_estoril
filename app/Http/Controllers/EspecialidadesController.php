<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use Illuminate\Http\Request;

class EspecialidadesController extends Controller
{
    //
    public function mostrar_registro_especialidade_admin($id_espec = null)
    {
        $especialidade = Especialidade::find($id_espec);
        if ($id_espec && !$especialidade) {
            return redirect()->back()->with("error", "especialidade não encontrada");
        }
        return view("especialidades.registro", compact("especialidade"));
    }
    public function salvar_registro_especialidade_admin(Request $request, $id_especialidade = null)
    {
        $especialidade = Especialidade::find($id_especialidade);
        if ($id_especialidade && !$especialidade) {
            return redirect()->back()->with("error", "especialidade não encontrada");
        }
        try {
            if ($id_especialidade) {
                $especialidade->nome = $request->nome;
                $especialidade->descricao = $request->descricao;
                $especialidade->activo = $request->boolean("activo");
                $especialidade->save();
            } else {
                Especialidade::create([
                    "nome" => $request->nome,
                    "descricao" => $request->descricao,
                    "activo" => $request->boolean("activo")

                ]);

            }

        } catch (\Throwable $th) {
            return redirect()->back()->with("error", $th->getMessage());
        }


        return redirect(route('mostrar_cadastros_admin'));

    }

    public function remover_especialidade_admin($id_espec = null)
    {
        $especialidade = Especialidade::find($id_espec);
        if (!$especialidade) {

            return response()->json(['erro' => 'especialidade nao encontrada'], 404);

        }
        Especialidade::destroy($id_espec);
        return response()->json(['mensagem' => 'especialidade removida com secesso'], 200);

    }
}
