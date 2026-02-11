<?php

namespace App\Http\Controllers;

use App\Models\Admi;
use App\Models\Especialidade;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\recepcionista;
use App\Models\Utilizador;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private function verificar_admin()
    {
        if (!session("id_utilizador")) {
            return false;
        }
        $utilizador = Utilizador::find(session("id_utilizador"));
        if (!$utilizador) {
            return false;
        }
        if(!$utilizador->id_admi){
            return false;
        }
        if($utilizador->nivel_acesso!=0){
            return false;
        }
        return true;

    }

    public function mostrar_dashboard_admin()
    {
        if (!$this->verificar_admin()) {
            return redirect("/login");
        }
        return view("admin.dashboard");
    }
    public function mostrar_pagamentos_admin()
    {
        if (!$this->verificar_admin()) {
            return redirect("/login");
        }
        return view("admin.pagamentos");
    }
    public function mostrar_cadastros_admin()
    {
        if (!$this->verificar_admin()) {
            return redirect("/login");
        }
        $utilizadores = Utilizador::where('id_util','<>',session('id_utilizador'))->get();
        $especialidades = Especialidade::all();
        return view("admin.cadastros", compact("utilizadores", "especialidades"));
    }
    public function mostrar_consultas_admin()
    {
        if (!$this->verificar_admin()) {
            return redirect("/login");
        }
        return view("admin.consultas");
    }

    public function mostrar_prontuarios_admin()
    {
        if (!$this->verificar_admin()) {
            return redirect("/login");
        }
        return view("admin.prontuarios");
    }
    public function mostrar_exames_admin()
    {
        if (!$this->verificar_admin()) {
            return redirect("/login");
        }
        return view("admin.exames");
    }
    



}
