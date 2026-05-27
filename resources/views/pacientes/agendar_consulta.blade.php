@extends('layouts.painel')
@section('titulo', 'Agendar Consulta')
@section('conteudo')

    <section>
        <div class="login-container">
            <!-- Seleção de Tipo de Usuário -->
            <div class="login-card" id="userTypeCard">
                <h2 style="text-align: center;"><strong>Agendamento de consulta</strong> </h2>
                <br><br>
                @if (session('erro'))
                    <div style="background-color:red;color:white;text-align:center">
                        {{ session('erro') }}
                    </div>
                @endif

                <form method="post" action="/agendar-consulta-paciente" id="formAgendamento">
                    {{ csrf_field() }}
                    <div>
                        <div class="col form-group">
                            <label for="data">Data da consulta</label>
                            <input class="w-100" type="date" id="data" name="data" required>
                            <small class="erro" id="erro-data"></small>
                        </div>

                        <div>
                            <div class=" col form-group ">
                                <label for="id_tipo_consulta">Tipo de consulta</label>
                                <select class="w-100 tipo_consulta_auto_select" id="id_tipo_consulta"
                                    name="id_tipo_consulta">
                                    <option value="">Selecione</option>
                                    @foreach ($tipos_consultas as $tipo)
                                        <option value="{{ $tipo->id_tipo_consulta }}">{{ $tipo->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=" col form-group ">
                                <label for="id_servico_clinico">Serviço clinico</label>
                                <select class="w-100 servico_clinico_auto_select" id="id_servico_clinico"
                                    name="id_servico_clinico">

                                </select>
                            </div>
                        </div>

                        <div class="col form-group">
                            <label for="hora">Horário Preferencial</label>
                            <select class="w-100 horario_auto_select" id="hora" name="hora">
                                <option value="">Selecione um horário</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="observacao">observação</label>
                            <textarea id="observacao" name="observacao" rows="5"
                                placeholder="Descreva brevemente o motivo da consulta ou dúvidas"></textarea>
                            
                        </div>

                        <div class=" d-flex justify-content-center flex-column align-items-center">
                            <button type="submit" class="btn btn-primary w-50">
                                <i class="fas fa-paper-plane"></i>
                                Agendar
                            </button>

                            <p class="form-note">
                                Entraremos em contacto para confirmar o agendamento.
                            </p>
                        </div>
                </form>
            </div>
            <script>
                const dataInput = document.getElementById("data");


                // ================= FUNÇÃO LIMITE DE DATA =================
                function obterLimiteMaximo() {
                    const hoje = new Date();
                    const limite = new Date();

                    limite.setMonth(hoje.getMonth() + 2); // +2 meses

                    return limite.toISOString().split("T")[0];
                }

                // ================= DATA =================
                dataInput.addEventListener("input", function() {

                    const hoje = new Date().toISOString().split("T")[0];
                    const limiteMax = obterLimiteMaximo();
                    const erro = document.getElementById("erro-data");

                    if (this.value < hoje) {
                        erro.textContent = "Não pode escolher uma data passada";
                        erro.className = "erro";

                        this.classList.add("input-erro");
                        this.classList.remove("input-sucesso");

                    } else if (this.value > limiteMax) {
                        erro.textContent = "Só pode agendar até 2 meses à frente";
                        erro.className = "erro";

                        this.classList.add("input-erro");
                        this.classList.remove("input-sucesso");

                    } else {
                        erro.textContent = "";
                        this.classList.remove("input-erro");
                        this.classList.add("input-sucesso");
                    }
                });




                // ================= SUBMIT =================
                function mostrarAlert(mensagem) {
                    const box = document.getElementById("custom-alert");
                    const text = document.getElementById("custom-alert-text");

                    text.textContent = mensagem;
                    box.classList.remove("hidden");
                }

                function fecharAlert() {
                    document.getElementById("custom-alert").classList.add("hidden");
                }
                document.getElementById("formAgendamento")
                    .addEventListener("submit", function(e) {

                        const hoje = new Date().toISOString().split("T")[0];
                        const limiteMax = obterLimiteMaximo();

                        const data = dataInput.value;
                        

                        let valido = true;

                        if (data < hoje || data > limiteMax) {
                            valido = false;
                        }


                        if (!valido) {
                            e.preventDefault();
                            mostrarAlert("Corrija os erros antes de enviar!");
                        }

                    });
            </script>
    </section>
@endsection
@section('script')
    <script src="/auto-select.js"></script>
@endsection
