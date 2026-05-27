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
        if (! session('id_utilizador')) {
            return redirect('/login');
        }
        $utilizador = Utilizador::find(session('id_utilizador'));
        $notificacoes = [];
        if ($utilizador->id_recepcionista) {
            $notificacoes = Notificacao::where(function ($query) use ($utilizador) {
                $query->where('id_util', $utilizador->id_util)->orWhere('id_util', null);
                 })->orderByDesc('data')->get();
        } else {

            $notificacoes = Notificacao::where('id_util', session('id_utilizador'))->orderByDesc('data')->get();
        }

        return view('notificacoes.listagem', compact('notificacoes'));

    }

    public function ler_todas_notificacoes()
    {
        if (! session('id_utilizador')) {
            return redirect('/login');
        }

        Notificacao::where('id_util', session('id_utilizador'))->update(['lida' => 1]);

        return redirect('/listar-minhas-notificacoes');
    }

    public function ler_notificacao(Request $request, $id_notificacao)
    {
        if (! session('id_utilizador')) {
            return redirect('/login');
        }
        Notificacao::where('id_util', session('id_utilizador'))
            ->where('id_notificacao', $id_notificacao)->update(['lida' => 1]);

        return redirect('/listar-minhas-notificacoes');
    }
}
