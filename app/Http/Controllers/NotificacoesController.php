<?php

namespace App\Http\Controllers;

use App\Models\Notificacao;
use App\Models\Utilizador;
use Illuminate\Http\Request;

class NotificacoesController extends Controller
{
    //
    public function listar_minhas_notificacoes()
    {
        if (!session("id_utilizador")) {
            return redirect("/login");
        }
        $utilizador = Utilizador::find(session("id_utilizador"));
        $notificacoes = Notificacao::where("id_util", session("id_utilizador"))->orderByDesc("data")->get();
        if ($utilizador->id_admi) {
            return view("admin.notificacoes", compact("notificacoes"));
        }
        if ($utilizador->id_medico) {
            return view("medicos.notificacoes", compact("notificacoes"));

        }
        if ($utilizador->id_recepcionista) {
            return view("recepcionistas.notificacoes", compact("notificacoes"));
        }
        return view("pacientes.notificacoes", compact("notificacoes"));
    }

    public function ler_todas_notificacoes()
    {
        if (!session("id_utilizador")) {
            return redirect("/login");
        }

        Notificacao::where("id_util", session("id_utilizador"))->update(["lida" => 1]);

        return redirect("/listar-minhas-notificacoes");
    }

    public function ler_notificacao(Request $request, $id_notificacao)
    {
        if (!session("id_utilizador")) {
            return redirect("/login");
        }
        Notificacao::where("id_util", session("id_utilizador"))
            ->where("id_notificacao", $id_notificacao)->update(["lida" => 1]);

        return redirect("/listar-minhas-notificacoes");
    }
}
