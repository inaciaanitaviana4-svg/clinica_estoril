// JavaScript Principal - Clínica Estoril

document.addEventListener('DOMContentLoaded', function() {
    // Navegação suave
    setupSmoothScroll();
    
    // Menu responsivo
    setupMobileMenu();
    
    // Modais
    setupModals();
    
    // Formulários
    setupForms();
    
    // Blog
    setupBlog();
    
    // Área Restrita
    setupAreaRestrita();
    
    // Animações ao scroll
    setupScrollAnimations();
});

// Navegação suave
function setupSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            if (href === '#' || href === '#!') {
                return;
            }

            const target = document.querySelector(href);
            
            if (target) {
                e.preventDefault();
                
                const headerOffset = 70;
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });

                // Atualiza link ativo
                updateActiveNavLink(href);
                
                // Fecha menu mobile se estiver aberto
                const navMenu = document.getElementById('navMenu');
                if (navMenu.classList.contains('active')) {
                    navMenu.classList.remove('active');
                }
            }
        });
    });

    // Atualiza link ativo ao fazer scroll
    window.addEventListener('scroll', () => {
        const sections = document.querySelectorAll('.section');
        const scrollPos = window.pageYOffset + 100;

        sections.forEach(section => {
            const top = section.offsetTop;
            const height = section.offsetHeight;
            const id = section.getAttribute('id');

            if (scrollPos >= top && scrollPos < top + height) {
                updateActiveNavLink(`#${id}`);
            }
        });
    });
}

function updateActiveNavLink(href) {
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === href) {
            link.classList.add('active');
        }
    });
}

// Menu responsivo
function setupMobileMenu() {
    const navToggle = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');

    navToggle.addEventListener('click', () => {
        navMenu.classList.toggle('active');
    });

    // Fecha menu ao clicar fora
    document.addEventListener('click', (e) => {
        if (!navToggle.contains(e.target) && !navMenu.contains(e.target)) {
            navMenu.classList.remove('active');
        }
    });
}

// Sistema de Modais
function setupModals() {
    // Modal de Login
    const btnLogin = document.getElementById('btnLogin');
    const modalLogin = document.getElementById('modalLogin');
    const closeLogin = document.getElementById('closeLogin');

    btnLogin.addEventListener('click', (e) => {
        e.preventDefault();
        modalLogin.classList.add('active');
    });

    closeLogin.addEventListener('click', () => {
        modalLogin.classList.remove('active');
    });

    // Modal de Cadastro
    const modalCadastro = document.getElementById('modalCadastro');
    const closeCadastro = document.getElementById('closeCadastro');
    const linkCriarConta = document.getElementById('linkCriarConta');
    const linkFazerLogin = document.getElementById('linkFazerLogin');

    linkCriarConta.addEventListener('click', (e) => {
        e.preventDefault();
        modalLogin.classList.remove('active');
        modalCadastro.classList.add('active');
    });

    linkFazerLogin.addEventListener('click', (e) => {
        e.preventDefault();
        modalCadastro.classList.remove('active');
        modalLogin.classList.add('active');
    });

    closeCadastro.addEventListener('click', () => {
        modalCadastro.classList.remove('active');
    });

    // Modal de Agendamento
    const btnAgendar = document.getElementById('btnAgendar');
    const btnHeroAgendar = document.getElementById('btnHeroAgendar');
    const modalAgendamento = document.getElementById('modalAgendamento');
    const closeAgendamento = document.getElementById('closeAgendamento');

    btnAgendar.addEventListener('click', (e) => {
        e.preventDefault();
        modalAgendamento.classList.add('active');
        
        // Verifica se usuário está logado
        if (authSystem.currentUser && authSystem.currentUser.tipo === 'paciente') {
            showAgendamentoForm();
        }
    });

    btnHeroAgendar.addEventListener('click', (e) => {
        e.preventDefault();
        modalAgendamento.classList.add('active');
        
        if (authSystem.currentUser && authSystem.currentUser.tipo === 'paciente') {
            showAgendamentoForm();
        }
    });

    closeAgendamento.addEventListener('click', () => {
        modalAgendamento.classList.remove('active');
    });

    // Modal de Perfil de Médico
    const closePerfilMedico = document.getElementById('closePerfilMedico');
    closePerfilMedico.addEventListener('click', () => {
        document.getElementById('modalPerfilMedico').classList.remove('active');
    });

    // Modal de Artigo
    const closeArtigo = document.getElementById('closeArtigo');
    closeArtigo.addEventListener('click', () => {
        document.getElementById('modalArtigo').classList.remove('active');
    });

    // Fecha modal ao clicar fora
    window.addEventListener('click', (e) => {
        if (e.target.classList.contains('modal')) {
            e.target.classList.remove('active');
        }
    });
}

// Formulário de Agendamento no Modal
function showAgendamentoForm() {
    const content = document.getElementById('agendamentoContent');
    content.innerHTML = `
        <form id="formAgendamentoModal">
            <div class="form-group">
                <label>🩺 Especialidade</label>
                <select id="modalEspecialidade" required>
                    <option value="">Selecione...</option>
                    <option value="Cardiologia">Cardiologia</option>
                    <option value="Neurologia">Neurologia</option>
                    <option value="Pediatria">Pediatria</option>
                    <option value="Ortopedia">Ortopedia</option>
                    <option value="Oftalmologia">Oftalmologia</option>
                    <option value="Ginecologia">Ginecologia</option>
                    <option value="Dermatologia">Dermatologia</option>
                </select>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>📅 Data</label>
                    <input type="date" id="modalData" required>
                </div>
                <div class="form-group">
                    <label>⏰ Horário</label>
                    <select id="modalHorario" required>
                        <option value="">Selecione...</option>
                        <option value="08:00">08:00</option>
                        <option value="09:00">09:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                        <option value="14:00">14:00</option>
                        <option value="15:00">15:00</option>
                        <option value="16:00">16:00</option>
                        <option value="17:00">17:00</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>💬 Observações (opcional)</label>
                <textarea id="modalObservacoes" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">
                ✓ Confirmar Agendamento
            </button>
        </form>
    `;

    // Define data mínima
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('modalData').setAttribute('min', today);

    // Setup formulário
    const form = document.getElementById('formAgendamentoModal');
    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const dados = {
            especialidade: document.getElementById('modalEspecialidade').value,
            data: document.getElementById('modalData').value,
            horario: document.getElementById('modalHorario').value,
            observacoes: document.getElementById('modalObservacoes').value
        };

        const result = authSystem.agendarConsulta(dados);
        alert(result.message);

        if (result.success) {
            document.getElementById('modalAgendamento').classList.remove('active');
        }
    });
}

// Configuração de Formulários
function setupForms() {
    // Formulário de Login
    const formLogin = document.getElementById('formLogin');
    formLogin.addEventListener('submit', (e) => {
        e.preventDefault();

        const email = document.getElementById('loginEmail').value;
        const senha = document.getElementById('loginSenha').value;

        const result = authSystem.login(email, senha);

        if (result.success) {
            document.getElementById('modalLogin').classList.remove('active');
            authSystem.showPanel();
            alert(`Bem-vindo, ${result.user.nome}!`);
        } else {
            alert(result.message);
        }
    });

    // Formulário de Cadastro de Paciente
    const formCadastro = document.getElementById('formCadastroPaciente');
    formCadastro.addEventListener('submit', (e) => {
        e.preventDefault();

        const senha = document.getElementById('cadastroSenha').value;
        const confirmarSenha = document.getElementById('cadastroConfirmarSenha').value;

        if (senha !== confirmarSenha) {
            alert('As senhas não coincidem');
            return;
        }

        const dados = {
            nome: document.getElementById('cadastroNome').value,
            cpf: document.getElementById('cadastroCPF').value,
            dataNascimento: document.getElementById('cadastroDataNascimento').value,
            telefone: document.getElementById('cadastroTelefone').value,
            sexo: document.getElementById('cadastroSexo').value,
            email: document.getElementById('cadastroEmail').value,
            senha: senha
        };

        const result = authSystem.cadastrarPaciente(dados);
        alert(result.message);

        if (result.success) {
            document.getElementById('modalCadastro').classList.remove('active');
            document.getElementById('modalLogin').classList.add('active');
            formCadastro.reset();
        }
    });

    // Formulário de Contato
    const formContato = document.getElementById('formContato');
    formContato.addEventListener('submit', (e) => {
        e.preventDefault();
        
        alert('Mensagem enviada com sucesso! Entraremos em contato em breve.');
        formContato.reset();
    });

    // Máscaras de CPF e Telefone
    setupInputMasks();

    // Logout
    const btnLogout = document.getElementById('btnLogout');
    btnLogout.addEventListener('click', () => {
        if (confirm('Deseja realmente sair?')) {
            authSystem.logout();
        }
    });
}

// Máscaras de Input
function setupInputMasks() {
    // Máscara de CPF
    const cpfInputs = document.querySelectorAll('#cadastroCPF, #pacienteCPF, #usuarioCPF');
    cpfInputs.forEach(input => {
        input.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            e.target.value = value;
        });
    });

    // Máscara de Telefone
    const telefoneInputs = document.querySelectorAll('#cadastroTelefone, #contatoTelefone, #pacienteTelefone, #usuarioTelefone, #perfilTelefone');
    telefoneInputs.forEach(input => {
        input.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 10) {
                value = value.replace(/(\d{2})(\d)/, '($1) $2');
                value = value.replace(/(\d{4})(\d)/, '$1-$2');
            } else {
                value = value.replace(/(\d{2})(\d)/, '($1) $2');
                value = value.replace(/(\d{5})(\d)/, '$1-$2');
            }
            e.target.value = value;
        });
    });
}

// Blog
function setupBlog() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const blogCards = document.querySelectorAll('.blog-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const filter = btn.dataset.filter;

            // Remove active de todos
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            // Filtra cards
            blogCards.forEach(card => {
                if (filter === 'todos' || card.dataset.category === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
}

// Ver Perfil de Médico
function verPerfilMedico(slug) {
    const perfis = {
        'joao-silva': {
            nome: 'Dr. João Silva',
            especialidade: 'Cardiologista',
            crm: 'CRM: 12345',
            foto: '👨‍⚕️',
            formacao: 'Formado pela USP, com especialização em Cardiologia pelo InCor',
            experiencia: '15 anos de experiência em doenças cardiovasculares',
            areas: ['Hipertensão', 'Insuficiência Cardíaca', 'Arritmias', 'Prevenção Cardiovascular'],
            atendimento: 'Segunda, Quarta e Sexta: 14:00 - 18:00'
        },
        'maria-santos': {
            nome: 'Dra. Maria Santos',
            especialidade: 'Pediatra',
            crm: 'CRM: 23456',
            foto: '👩‍⚕️',
            formacao: 'Formada pela UNIFESP, com residência em Pediatria',
            experiencia: '12 anos dedicados ao cuidado infantil',
            areas: ['Puericultura', 'Vacinação', 'Doenças Respiratórias', 'Alergias Infantis'],
            atendimento: 'Terça e Quinta: 08:00 - 12:00'
        },
        'pedro-costa': {
            nome: 'Dr. Pedro Costa',
            especialidade: 'Neurologista',
            crm: 'CRM: 34567',
            foto: '👨‍⚕️',
            formacao: 'Formado pela UNICAMP, com doutorado em Neurociências',
            experiencia: '18 anos de experiência em Neurologia',
            areas: ['Dor de Cabeça', 'Epilepsia', 'Parkinson', 'AVC'],
            atendimento: 'Segunda a Sexta: 09:00 - 13:00'
        },
        'ana-oliveira': {
            nome: 'Dra. Ana Oliveira',
            especialidade: 'Ginecologista',
            crm: 'CRM: 45678',
            foto: '👩‍⚕️',
            formacao: 'Formada pela UNESP, especialista em Obstetrícia',
            experiencia: '10 anos em saúde da mulher e pré-natal',
            areas: ['Pré-natal', 'Ginecologia Preventiva', 'Climatério', 'Planejamento Familiar'],
            atendimento: 'Terça, Quinta e Sexta: 14:00 - 18:00'
        },
        'carlos-ferreira': {
            nome: 'Dr. Carlos Ferreira',
            especialidade: 'Ortopedista',
            crm: 'CRM: 56789',
            foto: '👨‍⚕️',
            formacao: 'Formado pela USP, com especialização em Cirurgia Ortopédica',
            experiencia: '14 anos em Ortopedia e Medicina Esportiva',
            areas: ['Cirurgia de Joelho', 'Traumatologia', 'Medicina Esportiva', 'Coluna'],
            atendimento: 'Segunda, Quarta e Sexta: 15:00 - 19:00'
        },
        'beatriz-lima': {
            nome: 'Dra. Beatriz Lima',
            especialidade: 'Oftalmologista',
            crm: 'CRM: 67890',
            foto: '👩‍⚕️',
            formacao: 'Formada pela UNIFESP, com fellowship em Glaucoma',
            experiencia: '13 anos em Oftalmologia',
            areas: ['Cirurgia de Catarata', 'Glaucoma', 'Retina', 'Lentes de Contato'],
            atendimento: 'Terça e Quinta: 09:00 - 17:00'
        }
    };

    const perfil = perfis[slug];
    if (!perfil) return;

    const modal = document.getElementById('modalPerfilMedico');
    const content = document.getElementById('perfilMedicoContent');

    content.innerHTML = `
        <div class="modal-header">
            <div class="medico-foto"><span class="medico-avatar">${perfil.foto}</span></div>
            <h2>${perfil.nome}</h2>
            <p style="color: var(--primary-color); font-weight: bold;">${perfil.especialidade}</p>
            <p style="color: #6b7280;">${perfil.crm}</p>
        </div>
        <div style="padding: 2rem;">
            <h3>🎓 Formação</h3>
            <p>${perfil.formacao}</p>
            
            <h3 class="mt-2">💼 Experiência</h3>
            <p>${perfil.experiencia}</p>
            
            <h3 class="mt-2">📋 Áreas de Atuação</h3>
            <ul style="list-style: none; padding-left: 0;">
                ${perfil.areas.map(area => `
                    <li style="padding: 0.3rem 0;">✓ ${area}</li>
                `).join('')}
            </ul>
            
            <h3 class="mt-2">⏰ Horário de Atendimento</h3>
            <p>${perfil.atendimento}</p>
            
            <button class="btn btn-primary btn-block mt-2" onclick="agendarComMedico('${slug}')">
                📅 Agendar Consulta
            </button>
        </div>
    `;

    modal.classList.add('active');
}

function agendarComMedico(slug) {
    document.getElementById('modalPerfilMedico').classList.remove('active');
    document.getElementById('btnAgendar').click();
}

// Ler Artigo do Blog
function lerArtigo(slug) {
    const artigos = {
        'cardiovasculares': {
            titulo: 'Como Prevenir Doenças Cardiovasculares',
            categoria: 'Prevenção',
            data: '02 Jan 2026',
            imagem: '❤️',
            conteudo: `
                <p>As doenças cardiovasculares são uma das principais causas de morte no mundo. No entanto, a maioria delas pode ser prevenida através de mudanças no estilo de vida.</p>
                
                <h3>1. Alimentação Saudável</h3>
                <p>Uma dieta equilibrada, rica em frutas, verduras, grãos integrais e pobre em gorduras saturadas, é fundamental para a saúde do coração.</p>
                
                <h3>2. Exercícios Físicos Regulares</h3>
                <p>Praticar atividades físicas pelo menos 30 minutos por dia, 5 vezes por semana, ajuda a fortalecer o coração e melhorar a circulação.</p>
                
                <h3>3. Controle do Estresse</h3>
                <p>O estresse crônico pode aumentar a pressão arterial. Pratique técnicas de relaxamento como meditação e yoga.</p>
                
                <h3>4. Evite o Tabagismo</h3>
                <p>Fumar danifica os vasos sanguíneos e aumenta significativamente o risco de doenças cardíacas.</p>
                
                <h3>5. Check-ups Regulares</h3>
                <p>Realize exames preventivos regularmente para monitorar pressão arterial, colesterol e outros indicadores.</p>
                
                <p><strong>Agende sua consulta com nosso cardiologista e cuide da saúde do seu coração!</strong></p>
            `
        },
        'sono': {
            titulo: 'A Importância do Sono para a Saúde',
            categoria: 'Dicas',
            data: '30 Dez 2025',
            imagem: '😴',
            conteudo: `
                <p>O sono é essencial para a nossa saúde física e mental. Durante o sono, o corpo realiza processos importantes de reparação e recuperação.</p>
                
                <h3>Benefícios de uma Boa Noite de Sono</h3>
                <ul>
                    <li>Fortalece o sistema imunológico</li>
                    <li>Melhora a memória e concentração</li>
                    <li>Regula o humor e reduz o estresse</li>
                    <li>Auxilia no controle de peso</li>
                    <li>Previne doenças cardiovasculares</li>
                </ul>
                
                <h3>Dicas para Melhorar a Qualidade do Sono</h3>
                <p><strong>1. Mantenha uma rotina:</strong> Vá dormir e acorde sempre no mesmo horário.</p>
                <p><strong>2. Crie um ambiente adequado:</strong> Quarto escuro, silencioso e com temperatura agradável.</p>
                <p><strong>3. Evite eletrônicos antes de dormir:</strong> A luz azul interfere na produção de melatonina.</p>
                <p><strong>4. Evite cafeína à noite:</strong> Estimulantes podem dificultar o sono.</p>
                <p><strong>5. Pratique relaxamento:</strong> Técnicas de respiração e meditação ajudam.</p>
            `
        },
        'alimentacao': {
            titulo: 'Alimentação Balanceada: O Que Comer?',
            categoria: 'Nutrição',
            data: '28 Dez 2025',
            imagem: '🍎',
            conteudo: `
                <p>Uma alimentação balanceada é fundamental para manter a saúde e prevenir doenças. Veja o que não pode faltar no seu prato!</p>
                
                <h3>Grupos Alimentares Essenciais</h3>
                
                <h4>Proteínas</h4>
                <p>Carnes magras, peixes, ovos, leguminosas (feijão, lentilha, grão-de-bico).</p>
                
                <h4>Carboidratos</h4>
                <p>Prefira os integrais: arroz integral, pão integral, aveia, quinoa.</p>
                
                <h4>Frutas e Verduras</h4>
                <p>Consumir pelo menos 5 porções por dia de diferentes cores.</p>
                
                <h4>Gorduras Boas</h4>
                <p>Azeite, abacate, oleaginosas (castanhas, nozes, amêndoas).</p>
                
                <h3>O Que Evitar</h3>
                <ul>
                    <li>Alimentos ultraprocessados</li>
                    <li>Excesso de açúcar</li>
                    <li>Frituras</li>
                    <li>Refrigerantes</li>
                    <li>Excesso de sal</li>
                </ul>
            `
        },
        'vacinacao': {
            titulo: 'Vacinação: Protegendo Você e Sua Família',
            categoria: 'Prevenção',
            data: '25 Dez 2025',
            imagem: '💉',
            conteudo: `
                <p>As vacinas são uma das formas mais eficazes de prevenir doenças. Manter a carteira de vacinação em dia é essencial para toda a família.</p>
                
                <h3>Vacinas Infantis Essenciais</h3>
                <ul>
                    <li>BCG (tuberculose)</li>
                    <li>Hepatite B</li>
                    <li>Tríplice viral (sarampo, caxumba, rubéola)</li>
                    <li>Poliomielite</li>
                    <li>DTP (difteria, tétano, coqueluche)</li>
                </ul>
                
                <h3>Vacinas para Adultos</h3>
                <ul>
                    <li>Gripe (anual)</li>
                    <li>Hepatite B</li>
                    <li>Tétano</li>
                    <li>Febre amarela</li>
                    <li>HPV</li>
                </ul>
                
                <h3>Vacinas para Idosos</h3>
                <ul>
                    <li>Pneumocócica</li>
                    <li>Gripe (anual)</li>
                    <li>Herpes zóster</li>
                </ul>
                
                <p><strong>Procure nossa clínica para atualizar sua carteira de vacinação!</strong></p>
            `
        },
        'exercicios': {
            titulo: 'Exercícios Físicos: Começando do Zero',
            categoria: 'Dicas',
            data: '20 Dez 2025',
            imagem: '🏃',
            conteudo: `
                <p>Começar a praticar exercícios físicos pode parecer desafiador, mas com as orientações certas, você pode transformar sua saúde de forma segura e eficiente.</p>
                
                <h3>Benefícios dos Exercícios</h3>
                <ul>
                    <li>Melhora a saúde cardiovascular</li>
                    <li>Fortalece músculos e ossos</li>
                    <li>Ajuda no controle de peso</li>
                    <li>Reduz estresse e ansiedade</li>
                    <li>Melhora a qualidade do sono</li>
                </ul>
                
                <h3>Como Começar</h3>
                <p><strong>1. Consulte um médico:</strong> Especialmente se você tem mais de 40 anos ou alguma condição de saúde.</p>
                <p><strong>2. Comece devagar:</strong> 10-15 minutos por dia já fazem diferença.</p>
                <p><strong>3. Escolha algo que goste:</strong> Caminhada, natação, dança, ciclismo...</p>
                <p><strong>4. Seja consistente:</strong> É melhor 20 minutos todos os dias do que 2 horas uma vez por semana.</p>
                <p><strong>5. Ouça seu corpo:</strong> Respeite seus limites e progrida gradualmente.</p>
                
                <h3>Exercícios para Iniciantes</h3>
                <ul>
                    <li>Caminhada</li>
                    <li>Alongamento</li>
                    <li>Exercícios com peso corporal</li>
                    <li>Yoga</li>
                    <li>Natação</li>
                </ul>
            `
        },
        'hidratacao': {
            titulo: 'Hidratação: Quanto Água Você Deve Beber?',
            categoria: 'Nutrição',
            data: '18 Dez 2025',
            imagem: '💧',
            conteudo: `
                <p>A água é essencial para o funcionamento adequado do nosso organismo. Mas afinal, quanto devemos beber por dia?</p>
                
                <h3>Por Que a Hidratação é Importante?</h3>
                <ul>
                    <li>Regula a temperatura corporal</li>
                    <li>Transporta nutrientes</li>
                    <li>Elimina toxinas</li>
                    <li>Lubrifica articulações</li>
                    <li>Melhora a função cerebral</li>
                </ul>
                
                <h3>Quanto Beber?</h3>
                <p>A recomendação geral é de 2 a 3 litros de água por dia, mas isso varia de acordo com:</p>
                <ul>
                    <li>Peso corporal</li>
                    <li>Nível de atividade física</li>
                    <li>Clima</li>
                    <li>Estado de saúde</li>
                </ul>
                
                <h3>Sinais de Desidratação</h3>
                <ul>
                    <li>Sede excessiva</li>
                    <li>Urina escura</li>
                    <li>Boca seca</li>
                    <li>Fadiga</li>
                    <li>Dor de cabeça</li>
                </ul>
                
                <h3>Dicas para Beber Mais Água</h3>
                <p><strong>1.</strong> Tenha sempre uma garrafa por perto</p>
                <p><strong>2.</strong> Estabeleça lembretes no celular</p>
                <p><strong>3.</strong> Beba um copo ao acordar</p>
                <p><strong>4.</strong> Consuma alimentos ricos em água (frutas e verduras)</p>
                <p><strong>5.</strong> Beba antes, durante e após exercícios</p>
            `
        }
    };

    const artigo = artigos[slug];
    if (!artigo) return;

    const modal = document.getElementById('modalArtigo');
    const content = document.getElementById('artigoContent');

    content.innerHTML = `
        <div class="blog-image" style="height: 250px;">
            <span class="blog-emoji">${artigo.imagem}</span>
        </div>
        <div style="padding: 2rem;">
            <span class="blog-category">${artigo.categoria}</span>
            <h2 style="margin: 1rem 0;">${artigo.titulo}</h2>
            <p style="color: #6b7280; margin-bottom: 1.5rem;">📅 ${artigo.data}</p>
            <div>${artigo.conteudo}</div>
        </div>
    `;

    modal.classList.add('active');
}

// Área Restrita
function setupAreaRestrita() {
    const btnAreaRestrita = document.getElementById('btnAreaRestrita');
    const modalAreaRestrita = document.getElementById('modalAreaRestrita');
    const closeAreaRestrita = document.getElementById('closeAreaRestrita');

    btnAreaRestrita.addEventListener('click', () => {
        const adminCreated = localStorage.getItem('adminCreated');

        if (adminCreated === 'true') {
            // Se já tem admin, verifica se está logado
            if (authSystem.currentUser && authSystem.currentUser.tipo === 'administrador') {
                authSystem.showPanel();
            } else {
                alert('Acesso negado. Apenas administradores podem acessar esta área.');
            }
        } else {
            // Mostra formulário de cadastro de admin
            showAdminCadastroForm();
            modalAreaRestrita.classList.add('active');
        }
    });

    closeAreaRestrita.addEventListener('click', () => {
        modalAreaRestrita.classList.remove('active');
    });
}

function showAdminCadastroForm() {
    const content = document.getElementById('areaRestritaContent');
    
    content.innerHTML = `
        <div class="modal-header">
            <span class="modal-icon">🔐</span>
            <h2>Cadastro de Administrador</h2>
            <p style="color: #6b7280; font-size: 0.9rem;">Primeiro acesso - Configure o administrador do sistema</p>
        </div>
        <form id="formCadastroAdmin">
            <div class="form-group">
                <label>👤 Nome Completo</label>
                <input type="text" id="adminNome" required>
            </div>
            <div class="form-group">
                <label>✉️ E-mail</label>
                <input type="email" id="adminEmail" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>🔒 Senha</label>
                    <input type="password" id="adminSenha" required minlength="6">
                </div>
                <div class="form-group">
                    <label>🔒 Confirmar Senha</label>
                    <input type="password" id="adminConfirmarSenha" required minlength="6">
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">
                ✓ Criar Administrador
            </button>
        </form>
    `;

    const form = document.getElementById('formCadastroAdmin');
    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const senha = document.getElementById('adminSenha').value;
        const confirmarSenha = document.getElementById('adminConfirmarSenha').value;

        if (senha !== confirmarSenha) {
            alert('As senhas não coincidem');
            return;
        }

        const dados = {
            nome: document.getElementById('adminNome').value,
            email: document.getElementById('adminEmail').value,
            senha: senha
        };

        const result = authSystem.cadastrarAdministrador(dados);
        alert(result.message);

        if (result.success) {
            document.getElementById('modalAreaRestrita').classList.remove('active');
            authSystem.showPanel();
        }
    });
}

// Animações ao scroll
function setupScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observa elementos que devem animar
    document.querySelectorAll('.especialidade-card, .servico-card, .medico-card, .blog-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(el);
    });
}