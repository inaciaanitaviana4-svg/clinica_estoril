<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Criar conta Paciente</title>


</head>

<body>
    <header class="header header-simple">
        <div class="containe">
            <div class="nav-wrapper">
                <a href="/" class="logo">
                    <img src="imagem/logo.jpg" alt="logotipo da clínica">
                    <span>Clínica Estoril</span>
                </a>

                <a href="/login" class="btn-back">
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


                <div class="container">
                    <div class="photo"></div>

                    <h2 style="text-align: center;"><strong>Registo de Paciente</strong> </h2>
                 @if(session("erro"))
                    <div style="background-color:red;color:white;text-align:center">
                        {{ session("erro") }}
                    </div>
                    @endif
                    <form method="post" action="/cadastrar-paciente">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nome">Nome Completo</label>
                            <input type="text" id="nome" name="nome" placeholder="Ex.: Eugénio Influencer" required>
                        </div>
                        <div class="form-group">
                            <label for="num_telefone">Número de telefone</label>
                            <input type="number" id="num_telefone" name="num_telefone" placeholder="9XXXXXXXX" maxlength="9" min="9" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name="email" placeholder="eugenio@gmail.com" required>
                        </div>
                        <div class="form-group">
                            <label for="senha">senha</label>
                            <input type="password" id="senha" name="senha" placeholder="**********" required>
                        </div>
                        <div class="form-group">
                            <label for="data_nascimento">Data de Nascimento</label>
                            <input type="date" id="data_nascimento" name="data_nascimento" required>
                        </div>
                        <div class="form-group">
                            <label for="num_bi">Número do Bilhete de Identidade</label>
                            <input type="text" id="num_bi" name="num_bi" placeholder="Digite o número do seu B.I"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="genero">Gênero</label>
                            <select id="genero" name="genero">
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="estado_civil">Estado Civil</label>
                            <select id="estado_civil" name="estado_civil">
                                <option value="solteiro">Solteiro/a</option>
                                <option value="casado">Casado/a</option>
                                <option value="divorciado">Divorciado/a</option>
                                <option value="viuvo">Viúvo/a</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cidade">Cidade</label>
                            <input type="text" id="cidade" name="cidade" placeholder="Ex.: Luanda" required>
                        </div>
                        <div class="form-group">
                            <label for="bairro">Bairro</label>
                            <input type="text" id="bairro" name="bairro" placeholder="Ex.: Golf 2" required>
                        </div>
                        <div class="form-group">
                            <label for="morada">morada</label>
                            <input id="morada" name="morada">
                        </div>
                        <div class="form-group">
                            <label for="seguro">Seguro ou Particular</label>
                            <select id="seguro" name="seguro">
                                <option value="sem seguro">sem seguro</option>
                                <option value="particular">Particular</option>
                                <option value="fidelidade">Fidelidade</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-full">
                            <i class="fas fa-sign-in-alt"></i>
                            Concluir Registo
                        </button>
                    </form>
                </div>
            </div>
            <div class="login-help">
                <div class="help-card">
                    <i class="fas fa-question-circle"></i>
                    <h3>Precisa de Ajuda?</h3>
                    <p>Entre em contacto com o nosso suporte</p>
                    <a href="contacto.html">Contactar Suporte</a>
                </div>
    </section>

    <footer class="footer">
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
                        <li><a href="/equipa.">Nossa Equipa</a></li>
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
                            <span>geral@clinicaestoril.Angola</span>
                        </li>
                        <li>
                            <i class="fas fa-clock"></i>
                            <span>24h / 7 dias por semana</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2026 Clínica Estoril. Todos os direitos reservados.</p>
                <div class="footer-bottom-links">
                    <a href="#">Política de Privacidade</a>
                    <span>|</span>
                    <a href="#">Termos de Uso</a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>