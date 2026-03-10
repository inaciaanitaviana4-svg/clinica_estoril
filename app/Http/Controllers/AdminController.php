<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Especialidade;
use App\Models\Pagamento;
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
        $pagamentos = Pagamento::select('pagamentos.*', 'paciente.nome as nome_paciente', 'metodos_pagamentos.nome as metodo_pagamento', 'recepcionista.nome as nome_recepcionista')
            ->join('recepcionista', 'pagamentos.id_recepcionista', '=', 'recepcionista.id_recepcionista')
            ->join('paciente', 'pagamentos.id_paciente', '=', 'paciente.id_paciente')
            ->join('metodos_pagamentos', 'pagamentos.id_metodo_pagamento', '=', 'metodos_pagamentos.id_metodo_pagamento')
            ->get();

        return view('admin.pagamentos', compact('pagamentos'));
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
         $consultas = Consulta::select(
            'consultas.id_consulta',
            'tipos_consultas.nome as tipo_consulta',
            'consultas.modalidade',
            'consultas.data',
            'consultas.hora',
            'consultas.estado',
            'paciente.nome as nome_paciente',
            'medico.nome as nome_medico',
            'recepcionista.nome as nome_recepcionista',
            'servicos_clinicos.nome as nome_servico_clinico',
            'servicos_clinicos.preco as preco_servico_clinico'
        )
            ->join('paciente', 'consultas.id_paciente', '=', 'paciente.id_paciente')
            ->join('medico', 'consultas.id_medico', '=', 'medico.id_medico')
            ->join('recepcionista', 'consultas.id_recepcionista', '=', 'recepcionista.id_recepcionista')
            ->leftJoin('servicos_clinicos', 'consultas.id_servico_clinico', '=', 'servicos_clinicos.id_servico_clinico')
            ->leftJoin('tipos_consultas', 'consultas.id_tipo_consulta', '=', 'tipos_consultas.id_tipo_consulta')
            ->whereIn('estado', ['agendada', 'concluida', 'em_andamento', 'confirmada'])
            ->orderBy('data', 'asc')
            ->orderBy('hora', 'asc')
            ->get();

        return view('admin.consultas', compact('consultas',));
    }

    public function mostrar_prontuarios_admin()
    {
        if (! $this->verificar_admin()) {
            return redirect('/login');
        }

        return view('admin.prontuarios');
    }
}
