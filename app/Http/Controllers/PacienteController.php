<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Especialidade;
use App\Models\Horario;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\ServicoClinico;
use App\Models\TipoConsulta;
use App\Models\User;
use App\Models\Utilizador;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class PacienteController extends Controller
{
    public function perfil_paciente()
    {
        $utilizadorid = session("id_utilizador");
        if (!session("id_utilizador")) {
            return redirect("/login");
        }
        $utilizador = Utilizador::find(id: $utilizadorid);
        $paciente = Paciente::find(id: $utilizador->id_paciente);
        return view("pacientes.perfil", ["paciente" => $paciente]);
    }
    public function consultas_paciente()
    {
        print_r(Session::all());
        exit;
        $utilizadorid = session("id_utilizador");
        $utilizador = Utilizador::find($utilizadorid);
        if (!session("id_utilizador")) {
            return redirect("/login");
        }
        if (!$utilizador->id_paciente) {
            return redirect("/login")->with("erro", "paciente sem permissão");
        }

        $consultas = Consulta::select(
            "consultas.id_consulta",
            "tipos_consultas.nome as tipo_consulta",
            "consultas.modalidade",
            "consultas.data",
            "consultas.hora",
            "consultas.estado",
            "medico.nome as nome_medico",
            "servicos_clinicos.nome as nome_servico_clinico",
            "servicos_clinicos.preco as preco_servico_clinico"
        )
            ->leftJoin("medico", "consultas.id_medico", "=", "medico.id_medico")
            ->leftJoin("servicos_clinicos", "consultas.id_servico_clinico", "=", "servicos_clinicos.id_servico_clinico")
            ->leftJoin("tipos_consultas", "consultas.id_tipo_consulta", "=", "tipos_consultas.id_tipo_consulta")
            ->where("id_paciente", $utilizador->id_paciente)
            ->orderBy("data")
            ->orderBy("hora")
            ->get();


        return view("pacientes.consultas", ["consultas" => $consultas]);
    }
    public function agendar_consulta_paciente()
    {
        if (!session("id_utilizador")) {
            return redirect("/login");
        }
        $especialidades = Especialidade::all();
        $medicos = Medico::all();
        $tipos_consultas = TipoConsulta::all();
        $horarios = Horario::where("activo", true)->get();
        $servicos_clinicos = ServicoClinico::where("activo", true)->get();
        return view("pacientes.agendar_consulta", compact('especialidades', 'horarios', 'servicos_clinicos', 'tipos_consultas'));
    }
    public function agendar_consulta_paciente_salvar(Request $request)
    {
        if (!session("id_utilizador")) {
            return redirect("/login");
        }
        $utilizador = Utilizador::find(session("id_utilizador"));
        $paciente = Paciente::find($utilizador->id_paciente);
        if (!$paciente) {
            return back()->with("erro", "paciente não encontrado, faça o login novamente... ");
        }
        $tipo_consulta = TipoConsulta::find($request["id_tipo_consulta"]);
        if (!$tipo_consulta) {
            return back()->with("erro", "tipo de consulta não encontrada... ");
        }
        $servico_clinico = ServicoClinico::find($request["id_servico_clinico"]);
        if (!$servico_clinico) {
            return back()->with("erro", "Servico clinico não encontrado... ");
        }
        if (!$request["data"]) {
            return back()->with("erro", "Data obrigatoria");
        }
        if (!$request["hora"]) {
            return back()->with("erro", "hora obrigatoria");
        }
        try {
            $consulta = Consulta::create([
                "id_paciente" => $paciente->id_paciente,
                "id_tipo_consulta" => $request["id_tipo_consulta"],
                "id_servico_clinico" => $request["id_servico_clinico"],
                "data" => $request["data"],
                "hora" => $request["hora"],
                "estado" => "pendente",
                "modalidade" => "agendada",
                "observacao" => $request["observacao"]
            ]);
            if (!$consulta) {
                return back()->with("erro", "não foi posssivel agendar a consulta");
            }
        } catch (\Throwable $th) {
            return back()->with("erro", "não foi posssivel agendar a consulta");
        }

        return redirect("/consultas-paciente");

    }
    public function cancelar_consulta_paciente(Request $request, $id_consulta)
    {
        try {

            if (!session("id_utilizador")) {
                return redirect("/login");
            }
            $utilizador = Utilizador::find(session("id_utilizador"));
            $paciente = Paciente::find($utilizador->id_paciente);
            if (!$paciente) {
                return back()->with("erro", "paciente não encontrado, faça o login novamente... ");
            }
            $consulta = Consulta::find($id_consulta);
            if (!$consulta) {
                return back()->with("erro", "Consulta não encontrada");
            }
            if ($consulta->estado != "pendente" && $consulta->estado != "agendada") {
                return back()->with("erro", "apenas podes cancelar consultas pendentes ou agendadas");
            }
            $consulta->estado = "cancelada";
            $consulta->save();
            return redirect("/consultas-paciente");
        } catch (\Throwable $th) {
            return back()->with("erro", "erro ao cancelar a consulta, tente mais tarde...");
        }
    }

    public function confirmar_consulta_paciente(Request $request, $id_consulta)
    {
        try {

            if (!session("id_utilizador")) {
                return redirect("/login");
            }
            $utilizador = Utilizador::find(session("id_utilizador"));
            $paciente = Paciente::find($utilizador->id_paciente);
            if (!$paciente) {
                return back()->with("erro", "paciente não encontrado, faça o login novamente... ");
            }
            $consulta = Consulta::find($id_consulta);
            if (!$consulta) {
                return back()->with("erro", "Consulta não encontrada");
            }
            if ($consulta->estado != "agendada") {
                return back()->with("erro", "apenas podes confirmar consultas agendadas");
            }
            $consulta->estado = "confirmada";
            $consulta->save();
            return redirect("/consultas-paciente");
        } catch (\Throwable $th) {
            return back()->with("erro", "erro ao cancelar a consulta, tente mais tarde...");
        }
    }
    public function notificacoes_paciente()
    {
        $utilizadorid = session("id_utilizador");
        if (!session("id_utilizador")) {
            return redirect("/login");
        }
        return view("pacientes.notificacoes");
    }
}


