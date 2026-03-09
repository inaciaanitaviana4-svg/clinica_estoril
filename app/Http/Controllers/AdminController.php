<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use App\Models\ServicoClinico;
use App\Models\TipoConsulta;
use App\Models\Utilizador;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private function verificar_admin()
    {
        if (! session('id_utilizador')) {
            return false;
        }
        $utilizador = Utilizador::find(session('id_utilizador'));
        if (! $utilizador) {
            return false;
        }
        if (! $utilizador->id_admi) {
            return false;
        }
        if ($utilizador->nivel_acesso != 0) {
            return false;
        }

        return true;

    }

    public function mostrar_dashboard_admin()
    {
        if (! $this->verificar_admin()) {
            return redirect('/login');
        }

        return view('admin.dashboard');
    }

    public function mostrar_pagamentos_admin()
    {
        if (! $this->verificar_admin()) {
            return redirect('/login');
        }

        return view('admin.pagamentos');
    }

    public function mostrar_cadastros_admin(Request $request)
    {
        if (! $this->verificar_admin()) {
            return redirect('/login');
        }
        $pesquisar = $request->query('pesquisar_utilizador') ?? '';
        $utilizadores = Utilizador::where('id_util', '<>', session('id_utilizador'))
            ->where(function ($query) use ($pesquisar) {
                $query->where('nome', 'like', "%$pesquisar%")->orWhere('email', 'like', "%$pesquisar%")->orWhere('num_telefone', 'like', "%$pesquisar%");
            })->paginate(10);
        $pesquisar_especialidade = $request->query('pesquisar_especialidade') ?? '';
        $especialidades = Especialidade::where('nome', 'like', "%$pesquisar_especialidade%")->paginate(10);
        $pesquisar_tipo_consulta = $request->query('pesquisar_tipo_consulta') ?? '';
        $tipo_consultas = TipoConsulta::where('nome', 'like', "%$pesquisar_tipo_consulta%")->paginate(10);
        $pesquisar_servico_clinico = $request->query('pesquisar_servico_clinico') ?? '';
        $servicos_clinicos = ServicoClinico::select('servicos_clinicos.*', 'tipos_consultas.nome as tipo_consulta')
            ->join('tipos_consultas', 'tipos_consultas.id_tipo_consulta', '=', 'servicos_clinicos.id_tipo_consulta')
            ->where('servicos_clinicos.nome', 'like', "%$pesquisar_servico_clinico%")->paginate(10);

        return view('admin.cadastros', compact('utilizadores', 'especialidades', 'tipo_consultas', 'servicos_clinicos'));
    }

    public function mostrar_consultas_admin()
    {
        if (! $this->verificar_admin()) {
            return redirect('/login');
        }

        return view('admin.consultas');
    }

    public function mostrar_prontuarios_admin()
    {
        if (! $this->verificar_admin()) {
            return redirect('/login');
        }

        return view('admin.prontuarios');
    }

    public function mostrar_exames_admin()
    {
        if (! $this->verificar_admin()) {
            return redirect('/login');
        }

        return view('admin.exames');
    }
}
