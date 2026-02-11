@extends("layouts.site")
@section("titulo","Agendar Consulta")
@section("conteudo")

<section class="login-section">
    <div class="login-container">
        <!-- Seleção de Tipo de Usuário -->
        <div class="login-card" id="userTypeCard">
            <h2 style="text-align: center;"><strong>Agendamento de consulta</strong> </h2>
            <br><br>
                    <form method="post" action="#">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Nome Completo </label>
                                <input type="text" id="name" placeholder="Digite o seu nome completo" name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">Número de Telefone</label>
    <input type="number" id="phone" maxlength="9" placeholder="Digite o seu número de telefone" name="phone" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" placeholder="Digite o seu email" id="email" name="email" required>
                            </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="date">Data da consulta</label>
                                <input type="date" id="date" name="date"
                                min="2025-01-01"
                                max="2026-06-20">

                            </div>
                        </div>
                            <div class="form-group">
                                <label for="time">Horário Preferencial</label>
                                <select id="time" name="time">
                                    <option value="">Selecione um horário</option>
                                    <option value="manha">Manhã (8h-12h)</option>
                                    <option value="tarde">Tarde (14h-18h)</option>
                                    <option value="noite">Noite (18h-20h)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message">Mensagem</label>
                            <textarea id="message" name="message" rows="5" placeholder="Descreva brevemente o motivo da consulta ou dúvidas"></textarea>
                        </div>

                          <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" required>
                                <span>Aceito a <a style="text-decoration: none;" href="#">Política de Privacidade</a> e o tratamento de dados pessoais</span>
                            </label>
                        </div>
                       <div>
                        <button type="submit" class="btn btn-primary btn-full">
                            <i class="fas fa-paper-plane"></i>
                            Enviar Pedido de Agendamento
                        </button>

                        <p class="form-note">
                            Entraremos em contacto para confirmar o agendamento.
                        </p>
                       </div>
                    </form>
    </div>
    <div class="login-help">
        <div class="help-card">
            <i class="fas fa-question-circle"></i>
            <h3>Precisa de Ajuda?</h3>
            <p>Entre em contacto com o nosso suporte</p>
            <a href="/contacto">Contactar Suporte</a>
        </div>
    </div>
</section>

@endsection
