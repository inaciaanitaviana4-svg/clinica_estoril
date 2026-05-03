<?php

namespace App\Http\Controllers;

use App\Models\TipoConsulta;
use Illuminate\Http\Request;

class TipoConsultaController extends Controller
{
    //
    public function mostrar_registro_tipo_consulta_admin($id_tipo_consulta = null)
    {
        $tipo_consulta = TipoConsulta::find($id_tipo_consulta);
        if ($id_tipo_consulta && !$tipo_consulta) {
            return redirect()->back()->with("error", "tipo_consulta não encontrada");
        }
        return view("admin.tipo_consulta_registro", compact("tipo_consulta"));
    }
    public function salvar_registro_tipo_consulta_admin(Request $request, $id_tipo_consulta = null)
    {
        $tipo_consulta = TipoConsulta::find($id_tipo_consulta);
        if ($id_tipo_consulta && !$tipo_consulta) {
            return redirect()->back()->with("error", "tipo_consulta não encontrada");
        }
        try {
            if ($id_tipo_consulta) {
                $tipo_consulta->nome = $request->nome;
                $tipo_consulta->descricao = $request->descricao;
                $tipo_consulta->icone = $request->icone;
                $tipo_consulta->save();
            } else {
                TipoConsulta::create([
                    "nome" => $request->nome,
                    "descricao" => $request->descricao,
                    "icone" => $request->icone
                ]);

            }

        } catch (\Throwable $th) {
            return redirect()->back()->with("error", $th->getMessage());
        }


        return redirect(route('mostrar_cadastros_admin'));

    }

    public function remover_tipo_consulta_admin($id_tipo_consulta = null)
    {
        $tipo_consulta = TipoConsulta::find($id_tipo_consulta);
        if (!$tipo_consulta) {

            return response()->json(['erro' => 'tipo_consulta nao encontrada'], 404);

        }
        TipoConsulta::destroy($id_tipo_consulta);
        return response()->json(['mensagem' => 'tipo_consulta removida com secesso'], 200);

    }
}
