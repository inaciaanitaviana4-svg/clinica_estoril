<?php

namespace App\Http\Controllers;

use App\Models\Configuracao;
use App\Models\Especialidade;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\ServicoClinico;
use App\Models\TipoConsulta;
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

        return view('sobre', compact('anosExperiencia', 'totalPacientes', 'totalEspecialidades'));

    }

    public function politica_seguranca(): view
    {
        return view('politica_seguranca');
    }
     public function termos_uso()
{
    return view('termos_uso');
}

    public function servicos(): View
    {
        $tipos_consulta = TipoConsulta::get();
        $servicos = $tipos_consulta->map(function ($tipo) {
            $servicos_clinicos = ServicoClinico::select('id_servico_clinico', 'nome')->where('id_tipo_consulta', $tipo->id_tipo_consulta)->limit(5)->get()->toArray();

            return [
                'id' => $tipo->id_tipo_consulta,
                'nome' => $tipo->nome,
                'icone' => $tipo->icone,
                'descricao' => $tipo->descricao,
                'servicos' => $servicos_clinicos,
            ];
        });
         
        return view('servicos', compact('servicos'));
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
