<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Especialidade;
use App\Models\Horario;
use App\Models\ItemPagamento;
use App\Models\Medico;
use App\Models\MetodoPagamento;
use App\Models\Notificacao;
use App\Models\Paciente;
use App\Models\ServicoClinico;
use App\Models\TipoConsulta;
use App\Models\Utilizador;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    //
    public function agendarconsulta()
    {
        if (! session('id_utilizador')) {
            return redirect('/login');
        }

        return view('agendar_consulta');
    }

    public function mostrar_consultas_medico()
    {
        $utilizador = verificar_medico();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $consultas = Consulta::select(
            'consultas.id_consulta',
            'tipos_consultas.nome as tipo_consulta',
            'consultas.modalidade',
            'consultas.data',
            'consultas.hora',
            'consultas.estado',
            'paciente.nome as nome_paciente',
            'servicos_clinicos.nome as nome_servico_clinico',
            'servicos_clinicos.preco as preco_servico_clinico'
        )
            ->join('paciente', 'consultas.id_paciente', '=', 'paciente.id_paciente')
            ->leftJoin('servicos_clinicos', 'consultas.id_servico_clinico', '=', 'servicos_clinicos.id_servico_clinico')
            ->leftJoin('tipos_consultas', 'consultas.id_tipo_consulta', '=', 'tipos_consultas.id_tipo_consulta')
            ->whereIn('estado', ['agendada', 'concluida', 'em_andamento', 'confirmada'])
            ->where('consultas.id_medico', $utilizador->id_medico)
            ->orderBy('data', 'asc')
            ->orderBy('hora', 'asc')
            ->get();

        return view('consultas.medico', compact('consultas'));
    }

    public function mostrar_consultas_recepcionista()
    {
        $utilizador = verificar_recepcionista();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $consultas = Consulta::select(
            'consultas.id_consulta',
            'tipos_consultas.nome as tipo_consulta',
            'consultas.modalidade',
            'consultas.data',
            'consultas.hora',
            'consultas.estado',
            'medico.nome as nome_medico',
            'paciente.nome as nome_paciente',
            'servicos_clinicos.nome as nome_servico_clinico',
            'servicos_clinicos.preco as preco_servico_clinico'
        )

            ->leftJoin('medico', 'consultas.id_medico', '=', 'medico.id_medico')
            ->join('paciente', 'consultas.id_paciente', '=', 'paciente.id_paciente')
            ->leftJoin('servicos_clinicos', 'consultas.id_servico_clinico', '=', 'servicos_clinicos.id_servico_clinico')
            ->leftJoin('tipos_consultas', 'consultas.id_tipo_consulta', '=', 'tipos_consultas.id_tipo_consulta')
            ->where(function ($query) use ($utilizador) {
                $query->where('id_recepcionista', null)
                    ->orWhere('id_recepcionista', $utilizador->id_recepcionista);
            })
            ->orderBy('data')
            ->orderBy('hora')
            ->get();

        return view('consultas.recepcionista', compact('consultas'));
    }

    public function mostrar_atendimento_recepcionista()
    {
        $utilizador = verificar_recepcionista();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $especialidades = Especialidade::all();
        $medicos = Medico::all();
        $horarios = Horario::where('activo', true)->get();
        $servicos_clinicos = ServicoClinico::where('activo', true)->get();
        $tipos_consultas = TipoConsulta::all();
        $pacientes = Paciente::all();

        return view('consultas.atendimento', compact('especialidades', 'medicos', 'horarios', 'servicos_clinicos', 'tipos_consultas', 'pacientes'));
    }

    public function salvar_atendimento_recepcionista(Request $request)
    {
        $utilizador = verificar_recepcionista();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $medico = Medico::find($request->id_medico);
        if (! $medico) {
            return back()->with('erro', 'Médico não encontrado');
        }
        $paciente = Paciente::find($request->id_paciente);
        if (! $paciente) {
            return back()->with('erro', 'Paciente não encontrado');
        }
        $tipo_consulta = TipoConsulta::find($request->id_tipo_consulta);
        if (! $tipo_consulta) {
            return back()->with('erro', 'Tipo de consulta não encontrado');
        }
        $servico_clinico = ServicoClinico::find($request->id_servico_clinico);
        if (! $servico_clinico) {
            return back()->with('erro', 'Serviço clinico não encontrado');
        }
        $dados = validator($request->all(), [
            'id_medico' => 'requied',
            'id_paciente' => 'requied',
            'id_tipo_consulta' => 'requied',
            'id_servico_clinico' => 'requied',
            'data' => 'requied',
            'hora' => 'requied',
            'modalidade' => 'requied',
            'observacao' => 'nullable',
        ]);
        $consulta = Consulta::create([
            ...$request->all(),
            'id_recepcionista' => $utilizador->id_recepcionista,
            'estado' => $request->modalidade == 'imediata' ? 'em_espera' : 'agendada',
        ]);
        Notificacao::create([
            'titulo' => $request->modalidade == 'imediata' ? 'Consulta em espera' : 'Consulta agendada',
            'mensagem' => $request->modalidade == 'imediata' ? 'Aguarde a sua vez' : 'A sua consulta foi agendada com sucesso, aguardamos a sua confirmação',
            'id_util' => Utilizador::where('id_paciente', $request->id_paciente)->first()->id_util ?? '',
            'lida' => false,
            'data' => date('Y-m-d H:i:s'),
        ]);

        return redirect(route('detalhes_consulta_recepcionista', $consulta->id_consulta));
    }

    public function detalhes_consulta_recepcionista($id_consulta)
    {
        $utilizador = verificar_recepcionista();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $consulta = Consulta::select(
            'consultas.*',
            'tipos_consultas.nome as nome_tipo_consulta',
            'servicos_clinicos.nome as nome_servico_clinico',
            'servicos_clinicos.preco as preco_servico_clinico',
            'recepcionista.nome as nome_recepcionista'
        )
            ->leftJoin('servicos_clinicos', 'consultas.id_servico_clinico', '=', 'servicos_clinicos.id_servico_clinico')
            ->leftJoin('tipos_consultas', 'consultas.id_tipo_consulta', '=', 'tipos_consultas.id_tipo_consulta')
            ->leftJoin('recepcionista', 'consultas.id_recepcionista', '=', 'recepcionista.id_recepcionista')
            ->where('id_consulta', $id_consulta)->first();
        if (! $consulta) {
            return back()->with('erro', 'consulta não encontrado');
        }
        $paciente = Paciente::find($consulta->id_paciente);
        $medico = $consulta->id_medico ? Medico::select('medico.nome', 'medico.email', 'medico.num_telefone', 'medico.especialidade')
            ->where('id_medico', $consulta->id_medico)->first() : null;
        $medicos = ! $consulta->id_medico ? Medico::select('id_medico', 'nome', 'especialidade')->get() : [];
        $metodos_pagamento = MetodoPagamento::select('id_metodo_pagamento', 'nome')->get();
        $servicos_clinicos = ServicoClinico::where('activo', true)->get();
        $pagamentos = ItemPagamento::select(
            'items_pagamentos.*',
            'pagamentos.total_pago',
            'pagamentos.estado',
            'servicos_clinicos.nome as nome_servico_clinico',
            'servicos_clinicos.preco as preco_servico_clinico',
            'metodos_pagamentos.nome as nome_metodo_pagamento'
        )
            ->leftJoin('pagamentos', 'items_pagamentos.id_pagamento', '=', 'pagamentos.id_pagamento')
            ->leftJoin('servicos_clinicos', 'items_pagamentos.id_servico_clinico', '=', 'servicos_clinicos.id_servico_clinico')
            ->leftJoin('metodos_pagamentos', 'pagamentos.id_metodo_pagamento', '=', 'metodos_pagamentos.id_metodo_pagamento')
            ->where('pagamentos.id_consulta', $id_consulta)
            ->get();
        $total_pago= 0;
        $total_servicos = 0;
        foreach($pagamentos as $pagamento){
            if($pagamento->estado == 'sucesso'){
                $total_pago += $pagamento->total_pago;
                $total_servicos += $pagamento->total;
            }
        }
        $saldo_total = $total_servicos - $total_pago;
        $resumo = [
            'total_pago' => $total_pago,
            'total_servicos' => $total_servicos,
            'saldo_total' => $saldo_total,
        ];

        return view('consultas.detalhes_recepcionista', compact('consulta', 'paciente', 'medico', 'pagamentos', 'medicos', 'metodos_pagamento', 'servicos_clinicos', 'resumo'));
    }

    public function associar_medico_consulta_recepcionista(Request $request, $id_consulta)
    {
        $utilizador = verificar_recepcionista();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $consulta = Consulta::find($id_consulta);
        if (! $consulta) {
            return back()->with('erro', 'Consulta não encontrada');
        }
        $medico = Medico::find($request->id_medico);
        if (! $medico) {
            return back()->with('erro', 'Médico não encontrado');
        }
        $consulta->id_medico = $request->id_medico;
        $consulta->save();

        return redirect(route('detalhes_consulta_recepcionista', $consulta->id_consulta));
    }

    public function desassociar_medico_consulta_recepcionista(Request $request, $id_consulta)
    {
        $utilizador = verificar_recepcionista();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $consulta = Consulta::find($id_consulta);
        if (! $consulta) {
            return back()->with('erro', 'Consulta não encontrada');
        }

        $consulta->id_medico = null;
        $consulta->save();

        return redirect(route('detalhes_consulta_recepcionista', $consulta->id_consulta));
    }
    public function mudar_estado_consulta_recepcionista(Request $request, $id_consulta)
    {
        $utilizador = verificar_recepcionista();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $consulta = Consulta::find($id_consulta);
        if (! $consulta) {
            return back()->with('erro', 'Consulta não encontrada');
        }
        $consulta->estado = $request->estado;
        $consulta->save();

        return redirect(route('detalhes_consulta_recepcionista', $consulta->id_consulta));
    }
}
