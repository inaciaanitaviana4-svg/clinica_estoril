<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <title>agendar consulta</title>
    <style>
         
    </style>
</head>
<body>



   <!-- FORMULÁRIO DE CONTACTO -->
   <header class="header header-simple">
    <div class="container">
        <div class="nav-wrapper">
            <a href="index.html" class="logo">
                <img src="imagem/logo.jpg" alt="logotipo da clínica">
                <span>Clínica Estoril</span>
            </a>

            <a href="/" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                <span>Voltar</span>
            </a>
        </div>
    </div>
</header>
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
            <a href="contacto.html">Contactar Suporte</a>
        </div>
    </div>
</section>
<footer  class="footer">
    <div class="container">
        <div class="footer-content">
            <!-- Info da Clínica -->
            <div class="footer-section">
                <div class="footer-logo">
                    <img src="imagem/preta.jpg" alt="logotipo da clínica estoril" width="50" height="50">
                    <span>Clínica Estoril</span>
                </div>
                <p class="footer-desc">
                    A saúde nas melhores mãos há mais de 10 anos.
                    Cuidamos de você e da sua família.
                </p>
                <div class="social-links">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <!-- Links Rápidos -->
            <div class="footer-section">
                <h4 class="footer-title">Links Rápidos</h4>
                <ul class="footer-links">
                    <li><a href="/">Início</a></li>
                    <li><a href="/sobre">Sobre Nós</a></li>
                    <li><a href="/servicos">Serviços</a></li>
                    <li><a href="/especialidades">Especialidades</a></li>
                    <li><a href="/equipa">Nossa Equipa</a></li>
                </ul>
            </div>

            <!-- Especialidades -->
            <div class="footer-section">
                <h4 class="footer-title">Especialidades</h4>
                <ul class="footer-links">
                    <li><a href="/especialidades">Cardiologia</a></li>
                    <li><a href="/especialidades">Neurologia</a></li>
                    <li><a href="/especialidades">Ortopedia</a></li>
                    <li><a href="/especialidades">Pediatria</a></li>
                    <li><a href="/especialidades">Ginecologia</a></li>
                </ul>
            </div>

            <!-- Contacto -->
            <div class="footer-section">
                <h4 class="footer-title">Contacto</h4>
                <ul class="footer-contact">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Municipio do Kilamba Kiaxi-Luanda<br>Golf2 vila Estoril, Angola</span>
                    </li>
                    <li>
                        <i class="fas fa-phone"></i>
                        <span>+244 939789797</span>
                        <span>+244 943500700</span>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <span>geral@clinicaestoril.pt</span>
                    </li>
                    <li>
                        <i class="fas fa-clock"></i>
                        <span>24h / 7 dias por semana</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 Clínica Estoril. Todos os direitos reservados.</p>
            <div class="footer-bottom-links">
                <a href="#">Política de Privacidade</a>
                <span>|</span>
                <a href="#">Termos de Uso</a>
                <span>|</span>
                <a href="/admin">Acesso Restrito</a>
            </div>
        </div>
    </div>
   
</footer>
<script src="script.js"></script>
</body>
</html>