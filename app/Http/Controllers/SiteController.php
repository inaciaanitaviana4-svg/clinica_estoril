<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
class SiteController extends Controller
{
    /**
     * Show the profile for a given user.
     */
    public function inicio(): View
    {
        return view("index");
            
        
    }
     public function sobre(): View
    {
        return view("sobre");
            
        
    }
     public function servicos(): View
    {
        return view("servicos");
            
        
    }
     public function especialidades(): View
    {
        return view("especialidades");
            
        
    }
     public function equipa(): View
    {
        return view("equipa");
            
        
    }
     public function contacto(): View
    {
        return view("contacto");
            
        
    }
     public function blog(): View
    {
        return view("blog");
            
        
    }
     public function chatbot(): View
    {
        return view("chat");
            
        
    }
     public function login()
    {
        if(session()->has("id_utilizador")) {
            return redirect("/");
        }
        return view("login");
            
        
    }

    public function paineladmin(){
          $tipo = session("tipo_utilizador");

            if ($tipo !== 'admi') {
                return redirect('/');
            }
        return view("painel_admin");
    }
        public function painelmedico() {
                 $tipo = session("tipo_utilizador");
            if ($tipo !== 'medico') {
                return redirect('/');
            }
        return view("painel_medico");
    }
    public function painelrecepcionista() {
             $tipo = session("tipo_utilizador");
            if ($tipo!== 'recep') {
                return redirect('/');
            }
        return view("painel_recepcionista");
    }
}


