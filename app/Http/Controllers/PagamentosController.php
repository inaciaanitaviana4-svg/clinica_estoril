<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\ItemPagamento;
use App\Models\MetodoPagamento;
use App\Models\Paciente;
use App\Models\Pagamento;
use App\Models\ServicoClinico;
use DB;
use Illuminate\Http\Request;

class PagamentosController extends Controller
{
    public function fazer_pagamento_consulta_recepcionista(Request $request, $id_consulta)
    {
        $utilizador = verificar_recepcionista();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $consulta = Consulta::find($id_consulta);
        if (! $consulta) {
            return redirect()->back()->with('erro', 'Consulta não encontrada.');
        }
        if ($consulta->estado == 'cancelada') {
            return redirect()->back()->with('erro', 'Não é possível realizar pagamento para uma consulta cancelada.');
        }
        if ($consulta->estado == 'pendente') {
            return redirect()->back()->with('erro', 'Não é possível realizar pagamento para uma consulta pendente. Por favor, confirme a consulta primeiro.');
        }
        $servico_clinico = ServicoClinico::where('id_servico_clinico', $request->input('id_servico_clinico'))->where('activo', true)->first();
        if (! $servico_clinico) {
            return redirect()->back()->with('erro', 'Serviço clínico não encontrado.');
        }
        $metodo_pagamento = MetodoPagamento::find($request->input('id_metodo_pagamento'));
        if (! $metodo_pagamento) {
            return redirect()->back()->with('erro', 'Método de pagamento não encontrado.');
        }
        $valor_pago = $request->input('id_metodo_pagamento') == 1 ? $request->input('valor_pago') : $servico_clinico->preco;
        if (! $valor_pago || $valor_pago <= 0) {
            return back()->with('erro', 'Para pagamentos em dinheiro, o valor pago deve ser maior que zero.');
        }
        if ($valor_pago < $servico_clinico->preco) {
            return back()->with('erro', 'Para pagamentos em dinheiro, o valor pago deve ser maior ou igual ao preço do serviço clínico.');
        }
        try {
            DB::beginTransaction();
            $pagamento = Pagamento::create([
                'id_consulta' => $id_consulta,
                'id_paciente' => $consulta->id_paciente,
                'id_recepcionista' => $utilizador->id_recepcionista,
                'id_metodo_pagamento' => $request->input('id_metodo_pagamento'),
                'data' => now(),
                'total_pago' => $valor_pago,
                'estado' => 'sucesso',
            ]);
            $items_pagamento = ItemPagamento::create([
                'id_pagamento' => $pagamento->id_pagamento,
                'id_servico_clinico' => $servico_clinico->id_servico_clinico,
                'quantidade' => 1,
                'valor' => $servico_clinico->preco,
                'total' => $servico_clinico->preco,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('erro', 'Ocorreu um erro ao realizar o pagamento: ');
        }

        return redirect()->route('detalhes_consulta_recepcionista', ['id_consulta' => $id_consulta])->with('success', 'Pagamento realizado com sucesso.');
    }

    public function cancelar_pagamento_consulta_recepcionista($id_pagamento)
    {
        $utilizador = verificar_recepcionista();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $pagamento = Pagamento::find($id_pagamento);
        if (! $pagamento) {
            return redirect()->back()->with('erro', 'Pagamento não encontrado.');
        }
        if ($pagamento->estado == 'cancelado') {
            return redirect()->back()->with('erro', 'Este pagamento já está cancelado.');
        }
        try {
            DB::beginTransaction();
            $pagamento->estado = 'cancelado';
            $pagamento->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('erro', 'Ocorreu um erro ao cancelar o pagamento: ');
        }

        return redirect()->route('detalhes_consulta_recepcionista', ['id_consulta' => $pagamento->id_consulta])->with('success', 'Pagamento cancelado com sucesso.');
    }

    public function mostrar_pagamentos_recepcionista()
    {
        $utilizador = verificar_recepcionista();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $pagamentos = Pagamento::select('pagamentos.*', 'paciente.nome as nome_paciente', 'metodos_pagamentos.nome as metodo_pagamento')
            ->where('id_recepcionista', $utilizador->id_recepcionista)
            ->join('paciente', 'pagamentos.id_paciente', '=', 'paciente.id_paciente')
            ->join('metodos_pagamentos', 'pagamentos.id_metodo_pagamento', '=', 'metodos_pagamentos.id_metodo_pagamento')
            ->get();

        return view('pagamentos.listar_pagamentos_recepcionista', compact('pagamentos'));
    }

    public function mostrar_fazer_pagamento_recepcionista()
    {
        $utilizador = verificar_recepcionista();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $servicos_clinicos = ServicoClinico::where('activo', true)->get();
        $metodos_pagamentos = MetodoPagamento::all();
        $pacientes = Paciente::all();
        $consultas = Consulta::select('consultas.*', 'paciente.nome as nome_paciente', 'tipos_consultas.nome as tipo_consulta')
            ->join('paciente', 'consultas.id_paciente', '=', 'paciente.id_paciente')
            ->join('tipos_consultas', 'consultas.id_tipo_consulta', '=', 'tipos_consultas.id_tipo_consulta')
            ->whereIn('estado', ['confirmada', 'em_espera', 'em_andamento'])->get();

        return view('pagamentos.fazer_pagamento_recepcionista', compact('servicos_clinicos', 'metodos_pagamentos', 'pacientes', 'consultas'));
    }

    public function salvar_registro_pagamento_recepcionista(Request $request)
    {

        $utilizador = verificar_recepcionista();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $id_paciente = $request->input('id_paciente');
        $id_consulta = $request->input('id_consulta');
        $data = $request->input('data');
        $id_metodo_pagamento = $request->input('id_metodo_pagamento');
        $itens_pagamento = $request->input('itens_pagamento');
        try {
            if (! $id_paciente && ! $id_consulta) {
                return back()->with('erro', 'selecione um paciente ou uma consulta para associar o pagamento');
            }
            if ($id_consulta) {
                $consulta = Consulta::find($id_consulta);
                if (! $consulta) {
                    return back()->with('erro', 'Consulta não encontrada.');
                }
                $id_paciente = $consulta->id_paciente;
            }
            if ($id_paciente) {
                $paciente = Paciente::find($id_paciente);
                if (! $paciente) {
                    return back()->with('erro', 'Paciente não encontrado.');
                }
            }
            if (! $id_metodo_pagamento) {
                return back()->with('erro', 'Selecione um método de pagamento.');
            }
            if ($id_metodo_pagamento) {
                $metodo_pagamento = MetodoPagamento::find($id_metodo_pagamento);
                if (! $metodo_pagamento) {
                    return back()->with('erro', 'Método de pagamento não encontrado.');
                }
            }

            DB::beginTransaction();
            $pagamento = Pagamento::create([
                'id_consulta' => $id_consulta,
                'id_paciente' => $id_paciente,
                'id_recepcionista' => $utilizador->id_recepcionista,
                'id_metodo_pagamento' => $id_metodo_pagamento,
                'data' => $data,
                'total_pago' => 0,
                'estado' => 'sucesso',
            ]);
            $itens = [];
            $total_itens = 0;
            foreach ($itens_pagamento as $item) {
                if (! isset($item['id_servico_clinico']) || ! isset($item['quantidade'])) {
                    return back()->with('erro', 'Todos os itens de pagamento devem conter servico clínico e quantidade .');
                }
                $servico_clinico = ServicoClinico::find($item['id_servico_clinico']);
                if (! $servico_clinico) {
                    return back()->with('erro', 'Serviço clínico com ID '.$item['id_servico_clinico'].' não encontrado.');
                }
                $total = $servico_clinico->preco * $item['quantidade'];
                if ($id_metodo_pagamento != 1) {
                    $total_itens += $total;
                }
                $itens[] = [
                    'id_pagamento' => $pagamento->id_pagamento,
                    'id_servico_clinico' => $item['id_servico_clinico'],
                    'quantidade' => $item['quantidade'],
                    'valor' => $servico_clinico->preco,
                    'total' => $total,
                ];
            }
            if (empty($itens)) {
                return back()->with('erro', 'Adicione pelo menos um item de pagamento.');
            }
            $valor_pago = $id_metodo_pagamento == 1 ? $request->input('valor_pago') : $total_itens;
            if (! $valor_pago || $valor_pago <= 0) {
                return back()->with('erro', 'Para pagamentos em dinheiro, o valor pago deve ser maior que zero.');
            }
            if ($valor_pago < $total_itens) {
                return back()->with('erro', 'Para pagamentos em dinheiro, o valor pago deve ser maior ou igual ao total do pagamento.');
            }
            ItemPagamento::insert($itens);
            $pagamento->total_pago = $valor_pago;
            $pagamento->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            return back()->with('erro', 'Ocorreu um erro ao salvar o pagamento: ');
        }

        return redirect(route('mostrar_pagamentos_recepcionista'));
    }

    public function detalhes_pagamento_recepcionista($id_pagamento)
    {
        $utilizador = verificar_recepcionista();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $pagamento = Pagamento::select('pagamentos.*', 'paciente.nome as nome_paciente', 'metodos_pagamentos.nome as metodo_pagamento')
            ->where('id_pagamento', $id_pagamento)
            ->join('paciente', 'pagamentos.id_paciente', '=', 'paciente.id_paciente')
            ->join('metodos_pagamentos', 'pagamentos.id_metodo_pagamento', '=', 'metodos_pagamentos.id_metodo_pagamento')
            ->first();
        if (! $pagamento) {
            return redirect()->back()->with('erro', 'Pagamento não encontrado.');
        }
        $itens_pagamento = ItemPagamento::select('items_pagamentos.*', 'servicos_clinicos.nome as nome_servico_clinico')
            ->where('id_pagamento', $id_pagamento)
            ->join('servicos_clinicos', 'items_pagamentos.id_servico_clinico', '=', 'servicos_clinicos.id_servico_clinico')
            ->get();

        return view('pagamentos.detalhes_pagamento_recepcionista', compact('pagamento', 'itens_pagamento'));
    }

    public function mudar_estado_pagamento_recepcionista(Request $request, $id_pagamento)
    {
        $utilizador = verificar_recepcionista();
        if (! $utilizador) {
            return back()->with('erro', 'Não tem permissão para acessar esta página');
        }
        $pagamento = Pagamento::find($id_pagamento);
        if (! $pagamento) {
            return redirect()->back()->with('erro', 'Pagamento não encontrado.');
        }
        $novo_estado = $request->input('estado');
        if (! in_array($novo_estado, ['sucesso', 'cancelado'])) {
            return redirect()->back()->with('erro', 'Estado de pagamento inválido.');
        }
        try {
            DB::beginTransaction();
            $pagamento->estado = $novo_estado;
            $pagamento->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('erro', 'Ocorreu um erro ao atualizar o estado do pagamento: ');
        }

        return redirect()->route('detalhes_pagamento_recepcionista', ['id_pagamento' => $id_pagamento])->with('success', 'Estado do pagamento atualizado com sucesso.');
    }
}
