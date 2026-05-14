<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Recuperar Senha - Clínica Estoril">
    <title>Recuperar Senha - Clínica Estoril</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <link rel="stylesheet" href="{{ asset('recuperarSenha.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('toastify.min.css') }}" />
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />
    <style>
      
    </style>
</head>
<body class="recovery-page">
    <!-- HEADER SIMPLIFICADO -->
    <header class="header header-simple">
        <div class="container">
            <div class="nav-wrapper">
                <a href="/" class="logo">
                    <img src="imagem/logo.jpg" alt="logotipo da clínica">
                    <span>Clínica Estoril</span>
                </a>

                <a href="/login" class="btn-back">
                    <i class="fas fa-arrow-left"></i>
                    <span>Voltar ao Login</span>
                </a>
            </div>
        </div>
    </header>

    <!-- ÁREA DE RECUPERAÇÃO DE SENHA -->
    <section class="recovery-section">
        <div class="recovery-container">
            <div class="recovery-card">
                <div class="recovery-header">
                    <h1>Recuperar Senha</h1>
                    <p>Recupere o acesso à sua conta em 3 passos simples</p>
                </div>

                <!-- Indicador de Passos -->
                <div class="step-indicator">
                    <div class="step" id="step1Indicator">
                        <div class="step-circle">1</div>
                        <div class="step-label">Verificar Identidade</div>
                    </div>
                    <div class="step" id="step2Indicator">
                        <div class="step-circle">2</div>
                        <div class="step-label">Código de Verificação</div>
                    </div>
                    <div class="step" id="step3Indicator">
                        <div class="step-circle">3</div>
                        <div class="step-label">Nova Senha</div>
                    </div>
                </div>

                <!-- PASSO 1: Verificar Identidade -->
                <div class="form-step active-step" id="step1">
                    <form id="verifyIdentityForm">
                        @csrf
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            <span>Informe seu email ou número de telefone para recuperar o acesso.</span>
                        </div>

                        <div class="form-group">
                            <label>
                                <i class="fas fa-envelope"></i>
                                Email ou Número de Telefone
                            </label>
                            <input type="text" id="contact" name="contact" required 
                                   placeholder="Digite seu email ou telefone">
                        </div>

                        <button type="submit" class="btn btn-primary" id="sendCodeBtn">
                            <i class="fas fa-paper-plane"></i> Enviar Código
                        </button>
                    </form>
                </div>

                <!-- PASSO 2: Código de Verificação -->
                <div class="form-step" id="step2">
                    <form id="verifyCodeForm">
                        @csrf
                        <div class="alert alert-info">
                            <i class="fas fa-envelope"></i>
                            <span>Enviamos um código de verificação para <strong id="contactDisplay"></strong></span>
                        </div>

                        <div class="form-group">
                            <label>
                                <i class="fas fa-key"></i>
                                Código de Verificação
                            </label>
                            <input type="text" id="verification_code" name="verification_code" required 
                                   placeholder="Digite o código de 6 dígitos" maxlength="6">
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-check-circle"></i> Verificar Código
                        </button>
                        
                        <div class="resend-timer">
                            <span id="timerText"></span>
                            <button type="button" class="resend-button" id="resendCodeBtn" style="display: none;">
                                Reenviar Código
                            </button>
                        </div>
                    </form>
                </div>

                <!-- PASSO 3: Nova Senha -->
                <div class="form-step" id="step3">
                    <form id="resetPasswordForm">
                        @csrf
                        <div class="alert alert-info">
                            <i class="fas fa-lock"></i>
                            <span>Crie uma nova senha forte para sua conta.</span>
                        </div>

                        <div class="form-group">
                            <label>
                                <i class="fas fa-lock"></i>
                                Nova Senha
                            </label>
                            <div class="password-input">
                                <input type="password" id="new_password" name="new_password" required 
                                       placeholder="Digite sua nova senha">
                                <button type="button" class="toggle-password" onclick="togglePassword('new_password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="password-requirements">
                                <ul>
                                    <li id="req-length">✓ Mínimo 6 caracteres</li>
                                    <li id="req-upper">✓ Letra maiúscula</li>
                                    <li id="req-lower">✓ Letra minúscula</li>
                                    <li id="req-number">✓ Número</li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>
                                <i class="fas fa-lock"></i>
                                Confirmar Nova Senha
                            </label>
                            <div class="password-input">
                                <input type="password" id="confirm_password" name="confirm_password" required 
                                       placeholder="Confirme sua nova senha">
                                <button type="button" class="toggle-password" onclick="togglePassword('confirm_password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Redefinir Senha
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER SIMPLIFICADO -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
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
                        <a href="https://www.facebook.com/c.estoril/" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="https://www.instagram.com/clinica_estoril?igsh=cXRuMzBwYW5oM2ti" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

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
                            <span>geral@clinicaestoril.AO</span>
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
                    <a href="/politica_seguranca">Política de Privacidade</a>
                    <span>|</span>
                    <a href="/termos-uso">Termos de Uso</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let currentContact = '';
        let resetToken = '';
        let countdownInterval = null;

        // Função para mostrar alertas
        function showAlert(message, type = 'error') {
            Swal.fire({
                icon: type,
                title: type === 'success' ? 'Sucesso!' : type === 'error' ? 'Erro!' : 'Informação',
                text: message,
                confirmButtonColor: '#3498db',
                timer: type === 'success' ? 2000 : undefined,
                showConfirmButton: type !== 'success'
            });
        }

        // Função para mostrar mensagens de erro no formulário
        function showFormError(formId, message) {
            const form = document.getElementById(formId);
            let errorDiv = form.querySelector('.form-error');
            if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.className = 'alert alert-error form-error';
                form.insertBefore(errorDiv, form.firstChild);
            }
            errorDiv.innerHTML = `<i class="fas fa-exclamation-triangle"></i><span>${message}</span>`;
            setTimeout(() => {
                if (errorDiv) errorDiv.remove();
            }, 5000);
        }

        // Função para mudar de passo
        function changeStep(step) {
            // Esconder todos os steps
            document.getElementById('step1').classList.remove('active-step');
            document.getElementById('step2').classList.remove('active-step');
            document.getElementById('step3').classList.remove('active-step');
            
            // Mostrar o step atual
            document.getElementById(`step${step}`).classList.add('active-step');
            
            // Atualizar indicadores
            for (let i = 1; i <= 3; i++) {
                const indicator = document.getElementById(`step${i}Indicator`);
                if (i < step) {
                    indicator.classList.add('completed');
                    indicator.classList.remove('active');
                } else if (i === step) {
                    indicator.classList.add('active');
                    indicator.classList.remove('completed');
                } else {
                    indicator.classList.remove('active', 'completed');
                }
            }
        }

        // Validação de senha
        function validatePassword(password) {
            const requirements = {
                length: password.length >= 6,
                upper: /[A-Z]/.test(password),
                lower: /[a-z]/.test(password),
                number: /[0-9]/.test(password)
            };
            
            document.getElementById('req-length').className = requirements.length ? 'valid' : 'invalid';
            document.getElementById('req-upper').className = requirements.upper ? 'valid' : 'invalid';
            document.getElementById('req-lower').className = requirements.lower ? 'valid' : 'invalid';
            document.getElementById('req-number').className = requirements.number ? 'valid' : 'invalid';
            
            return requirements.length && requirements.upper && requirements.lower && requirements.number;
        }

        // Timer para reenvio de código
        function startResendTimer(seconds = 60) {
            let timeLeft = seconds;
            const timerText = document.getElementById('timerText');
            const resendBtn = document.getElementById('resendCodeBtn');
            
            if (countdownInterval) clearInterval(countdownInterval);
            
            countdownInterval = setInterval(() => {
                if (timeLeft <= 0) {
                    clearInterval(countdownInterval);
                    timerText.textContent = '';
                    resendBtn.style.display = 'inline-block';
                } else {
                    timerText.textContent = `Reenviar código em ${timeLeft} segundos`;
                    resendBtn.style.display = 'none';
                    timeLeft--;
                }
            }, 1000);
        }

        // PASSO 1: Verificar identidade
        document.getElementById('verifyIdentityForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const contact = document.getElementById('contact').value;
            const submitBtn = document.getElementById('sendCodeBtn');
            
            if (!contact) {
                showFormError('verifyIdentityForm', 'Por favor, informe seu email ou telefone.');
                return;
            }
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';
            
            try {
                const response = await fetch('/recuperar-senha/enviar-codigo', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({ contact: contact })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    currentContact = contact;
                    resetToken = data.token;
                    document.getElementById('contactDisplay').textContent = contact;
                    changeStep(2);
                    startResendTimer(60);
                    showAlert('Código enviado com sucesso! Verifique seu email ou telefone.', 'success');
                } else {
                    showFormError('verifyIdentityForm', data.message || 'Usuário não encontrado.');
                }
            } catch (error) {
                console.error('Error:', error);
                showFormError('verifyIdentityForm', 'Erro ao enviar código. Tente novamente.');
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Enviar Código';
            }
        });
        
        // Reenviar código
        document.getElementById('resendCodeBtn').addEventListener('click', async () => {
            if (!currentContact) return;
            
            const resendBtn = document.getElementById('resendCodeBtn');
            resendBtn.disabled = true;
            resendBtn.textContent = 'Enviando...';
            
            try {
                const response = await fetch('/recuperar-senha/re-enviar-codigo', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({ contact: currentContact })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    startResendTimer(60);
                    showAlert('Novo código enviado com sucesso!', 'success');
                } else {
                    showAlert(data.message || 'Erro ao reenviar código.', 'error');
                }
            } catch (error) {
                showAlert('Erro ao reenviar código. Tente novamente.', 'error');
            } finally {
                resendBtn.disabled = false;
                resendBtn.textContent = 'Reenviar Código';
            }
        });
        
        // PASSO 2: Verificar código
        document.getElementById('verifyCodeForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const code = document.getElementById('verification_code').value;
            
            if (!code || code.length !== 6) {
                showFormError('verifyCodeForm', 'Por favor, insira o código de 6 dígitos.');
                return;
            }
            
            try {
                const response = await fetch('/recuperar-senha/verificar-codigo', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({ 
                        contact: currentContact,
                        code: code,
                        token: resetToken
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    resetToken = data.reset_token;
                    changeStep(3);
                    showAlert('Código verificado! Agora crie sua nova senha.', 'success');
                } else {
                    showFormError('verifyCodeForm', data.message || 'Código inválido ou expirado.');
                }
            } catch (error) {
                showFormError('verifyCodeForm', 'Erro ao verificar código. Tente novamente.');
            }
        });
        
        // PASSO 3: Redefinir senha
        document.getElementById('resetPasswordForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (!validatePassword(newPassword)) {
                showFormError('resetPasswordForm', 'A senha não atende aos requisitos de segurança.');
                return;
            }
            
            if (newPassword !== confirmPassword) {
                showFormError('resetPasswordForm', 'As senhas não coincidem.');
                return;
            }
            
            try {
                const response = await fetch('/recuperar-senha/redefinir', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        contact: currentContact,
                        new_password: newPassword,
                        reset_token: resetToken
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    showAlert('Senha redefinida com sucesso! Redirecionando para o login...', 'success');
                    setTimeout(() => {
                        window.location.href = '/login';
                    }, 2000);
                } else {
                    showFormError('resetPasswordForm', data.message || 'Erro ao redefinir senha.');
                }
            } catch (error) {
                showFormError('resetPasswordForm', 'Erro ao redefinir senha. Tente novamente.');
            }
        });
        
        // Validação de senha em tempo real
        document.getElementById('new_password').addEventListener('input', (e) => {
            validatePassword(e.target.value);
        });
        
        // Toggle password visibility
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.parentElement.querySelector('.toggle-password i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
        
        // Limpar timer ao sair da página
        window.addEventListener('beforeunload', () => {
            if (countdownInterval) clearInterval(countdownInterval);
        });
    </script>
</body>
</html>