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
        try {
            DB::beginTransaction();
            $pagamento = Pagamento::create([
                'id_consulta' => $id_consulta,
                'id_paciente' => $consulta->id_paciente,
                'id_recepcionista' => $utilizador->id_recepcionista,
                'id_metodo_pagamento' => $request->input('id_metodo_pagamento'),
                'data' => now(),
                'total_pago' => $request->input('valor_pago'),
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

            return redirect()->back()->with('erro', 'Ocorreu um erro ao realizar o pagamento: '.$e->getMessage());
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

            return redirect()->back()->with('erro', 'Ocorreu um erro ao cancelar o pagamento: '.$e->getMessage());
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
        $consultas = Consulta::whereIn('estado', ['confirmada', 'em_espera', 'em_andamento'])->get();

        return view('pagamentos.fazer_pagamento_recepcionista', compact('servicos_clinicos', 'metodos_pagamentos', 'pacientes', 'consultas'));
    }
}
