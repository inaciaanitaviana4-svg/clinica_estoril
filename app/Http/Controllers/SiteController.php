<?php

namespace App\Http\Controllers;

use App\Models\Configuracao;
use App\Models\Paciente;
use App\Models\Especialidade;
use App\Models\Medico;

use Carbon\Carbon;
use Illuminate\View\View;

class SiteController extends Controller
{
    /**
     * Show the profile for a given user.
     */
    public function inicio(): View
    {
        $config = Configuracao::first();
        $anoAtual = Carbon::now()->year;

        $anosExperiencia = $anoAtual - ($config ? $config->ano_fundacao : 0);

        $totalPacientes = Paciente::count();
        $totalEspecialidades = Especialidade::count();
        $especialidades = Especialidade::all();

        return view('index', compact('anosExperiencia', 'totalPacientes', 'totalEspecialidades', 'especialidades'));
    }

    public function sobre(): View
    {
        $config = Configuracao::first();
        $anoAtual = Carbon::now()->year;
        $totalPacientes = Paciente::count();
        $totalEspecialidades = Especialidade::count();

        $anosExperiencia = $anoAtual - ($config ? $config->ano_fundacao : 0);

        return view('sobre', compact('anosExperiencia','totalPacientes','totalEspecialidades'));

    }
    
    public function politica_seguranca():view
    {
        return view('politica_seguranca');
    }
    public function servicos(): View
    {
        return view('servicos');
    }

   public function especialidades(): View
{
    $especialidades = Especialidade::where('activo', 1)->get();

    return view('especialidades', compact('especialidades'));
}

   public function equipa(): View
{
    $medicos = Medico::all();

    return view('equipa', compact('medicos'));
}

    public function contacto(): View
    {
        return view('contacto');
    }

    public function blog(): View
    {
        return view('blog');
    }

    public function chatbot(): View
    {
        return view('chat');
    }

    public function login()
    {
        if (session()->has('id_utilizador')) {
            return redirect('/');
        }

        return view('login');
    }

    public function paineladmin()
    {
        $tipo = session('tipo_utilizador');

        if ($tipo !== 'admi') {
            return redirect('/');
        }

        return view('painel_admin');
    }

    public function painelmedico()
    {
        $tipo = session('tipo_utilizador');
        if ($tipo !== 'medico') {
            return redirect('/');
        }

        return view('painel_medico');
    }

    public function painelrecepcionista()
    {
        $tipo = session('tipo_utilizador');
        if ($tipo !== 'recep') {
            return redirect('/');
        }

        return view('painel_recepcionista');
     }
}
