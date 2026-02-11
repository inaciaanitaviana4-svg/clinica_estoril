// Sistema de Chatbot para Clínica Estoril

class ChatBot {
    constructor() {
        this.responses = {
            // Saudações
            'ola': 'Olá! Bem-vindo à Clínica Estoril. Como posso ajudá-lo?',
            'oi': 'Oi! Como posso ajudá-lo hoje?',
            'bom dia': 'Bom dia! Em que posso ser útil?',
            'boa tarde': 'Boa tarde! Como posso ajudá-lo?',
            'boa noite': 'Boa noite! Estou à disposição para ajudar.',

            // Horários
            'horarios': 'Nossos horários de atendimento são: Segunda a Sexta: 07:00 - 22:00, Sábado: 08:00 - 18:00. Emergências funcionam 24 horas!',
            'horario': 'Nossos horários de atendimento são: Segunda a Sexta: 07:00 - 22:00, Sábado: 08:00 - 18:00. Emergências funcionam 24 horas!',
            'que horas': 'Nossos horários de atendimento são: Segunda a Sexta: 07:00 - 22:00, Sábado: 08:00 - 18:00. Emergências funcionam 24 horas!',
            'aberto': 'Estamos abertos de Segunda a Sexta: 07:00 - 22:00 e Sábado: 08:00 - 18:00. Emergências 24h!',

            // Especialidades
            'especialidades': 'Oferecemos diversas especialidades: Cardiologia, Neurologia, Pediatria, Ortopedia, Oftalmologia, Odontologia, Ginecologia e Pneumologia. Qual especialidade você procura?',
            'especialidade': 'Temos as seguintes especialidades: Cardiologia, Neurologia, Pediatria, Ortopedia, Oftalmologia, Odontologia, Ginecologia e Pneumologia.',
            'cardiologia': 'Nossa equipe de cardiologia cuida da saúde do seu coração com equipamentos modernos e profissionais experientes.',
            'pediatria': 'Temos pediatras dedicados ao cuidado infantil com abordagem humanizada.',
            'neurologia': 'Nossos neurologistas são especialistas em doenças do sistema nervoso.',
            'ortopedia': 'Oferecemos tratamento completo para ossos e articulações.',
            'oftalmologia': 'Cuidamos da sua saúde visual com tecnologia de ponta.',
            'ginecologia': 'Especialistas em saúde da mulher e pré-natal.',

            // Localização
            'localizacao': 'Estamos localizados na Av. Estoril, 1000 - Centro, São Paulo, SP - CEP: 01000-000',
            'endereco': 'Nosso endereço é: Av. Estoril, 1000 - Centro, São Paulo, SP - CEP: 01000-000',
            'onde fica': 'Ficamos na Av. Estoril, 1000 - Centro, São Paulo, SP - CEP: 01000-000',
            'como chegar': 'Estamos na Av. Estoril, 1000 - Centro, São Paulo. Você pode vir de metrô, ônibus ou carro. Temos estacionamento!',

            // Contato
            'telefone': 'Nossos telefones são: (11) 3000-0000 e (11) 98000-0000',
            'contato': 'Entre em contato conosco: Telefone: (11) 3000-0000, WhatsApp: (11) 98000-0000, E-mail: contato@clinicaestoril.com.br',
            'email': 'Nosso e-mail é: contato@clinicaestoril.com.br',
            'whatsapp': 'Nosso WhatsApp é: (11) 98000-0000',

            // Agendamento
            'agendar': 'Para agendar uma consulta, você precisa fazer login no sistema. Clique no botão "Login" no menu e depois em "Agendar Consulta".',
            'consulta': 'Para marcar uma consulta, faça login no sistema e acesse a área de agendamento.',
            'marcar consulta': 'Faça login e acesse "Agendar Consulta" para marcar sua consulta.',

            // Serviços
            'servicos': 'Oferecemos: Exames de Imagem, Laboratório, Pronto Socorro 24h, Internação, Vacinação e Farmácia.',
            'exames': 'Realizamos diversos exames: Raio-X, Tomografia, Ressonância Magnética, Ultrassonografia e Análises Clínicas.',
            'laboratorio': 'Nosso laboratório realiza exames de sangue, análises hormonais e testes genéticos com resultados rápidos.',
            'pronto socorro': 'Nosso Pronto Socorro funciona 24 horas por dia com equipe sempre disponível.',
            'emergencia': 'Atendemos emergências 24 horas. Nosso Pronto Socorro está sempre disponível!',
            'vacina': 'Oferecemos vacinação para todas as idades: vacinas infantis, adultas e para viagens.',

            // Valores e convênios
            'preco': 'Para informações sobre valores, entre em contato pelo telefone (11) 3000-0000.',
            'valor': 'Para saber valores, ligue para (11) 3000-0000 ou envie e-mail para atendimento@clinicaestoril.com.br',
            'convenio': 'Trabalhamos com diversos convênios. Entre em contato para verificar se aceitamos o seu.',
            'plano de saude': 'Aceitamos diversos planos de saúde. Ligue para (11) 3000-0000 para confirmar.',

            // Equipe
            'medicos': 'Contamos com uma equipe de médicos altamente qualificados em diversas especialidades. Veja nossa equipe completa na seção "Equipe".',
            'equipe': 'Nossa equipe é composta por profissionais experientes e dedicados. Conheça nossos médicos na seção "Equipe".',

            // Agradecimento
            'obrigado': 'De nada! Estamos sempre à disposição.',
            'obrigada': 'De nada! Conte conosco sempre que precisar.',
            'valeu': 'Por nada! Qualquer dúvida, estou aqui!',

            // Despedida
            'tchau': 'Até logo! Cuide-se e volte sempre que precisar!',
            'ate logo': 'Até mais! Tenha um ótimo dia!',
            'adeus': 'Até breve! Estamos sempre aqui para ajudar.'
        };

        this.keywords = {
            horarios: ['horario', 'horários', 'que horas', 'funciona', 'aberto', 'abre', 'fecha'],
            especialidades: ['especialidade', 'especialidades', 'medico de', 'doutor', 'cardiologia', 'pediatria', 'neurologia', 'ortopedia', 'oftalmologia', 'ginecologia'],
            localizacao: ['localizacao', 'localização', 'endereco', 'endereço', 'onde fica', 'como chegar', 'avenida'],
            contato: ['telefone', 'contato', 'email', 'e-mail', 'whatsapp', 'ligar'],
            agendar: ['agendar', 'marcar', 'consulta', 'agendamento'],
            servicos: ['servico', 'serviços', 'serviço', 'exame', 'laboratorio', 'laboratório', 'pronto socorro', 'emergencia', 'emergência', 'vacina', 'internacao', 'internação'],
            valores: ['preco', 'preço', 'valor', 'quanto custa', 'convenio', 'convênio', 'plano']
        };

        this.init();
    }

    init() {
        this.setupEventListeners();
        this.addBotMessage('Olá! Sou o assistente virtual da Clínica Estoril. Como posso ajudá-lo?');
    }

    setupEventListeners() {
        const chatbotToggle = document.getElementById('chatbotToggle');
        const chatbotClose = document.getElementById('chatbotClose');
        const chatbotSend = document.getElementById('chatbotSend');
        const chatbotInput = document.getElementById('chatbotInputField');
        const quickReplies = document.querySelectorAll('.quick-reply');

        chatbotToggle.addEventListener('click', () => {
            this.toggleChatbot();
        });

        chatbotClose.addEventListener('click', () => {
            this.toggleChatbot();
        });

        chatbotSend.addEventListener('click', () => {
            this.sendMessage();
        });

        chatbotInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                this.sendMessage();
            }
        });

        quickReplies.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const question = e.target.dataset.question;
                this.handleQuickReply(question);
            });
        });
    }

    toggleChatbot() {
        const container = document.getElementById('chatbotContainer');
        const badge = document.getElementById('chatbotBadge');
        
        container.classList.toggle('active');
        
        if (container.classList.contains('active')) {
            badge.style.display = 'none';
            document.getElementById('chatbotInputField').focus();
        }
    }

    sendMessage() {
        const input = document.getElementById('chatbotInputField');
        const message = input.value.trim();

        if (message === '') return;

        this.addUserMessage(message);
        input.value = '';

        // Processa resposta
        setTimeout(() => {
            const response = this.processMessage(message);
            this.addBotMessage(response);
        }, 500);
    }

    handleQuickReply(question) {
        const questions = {
            'horarios': 'Quais são os horários de atendimento?',
            'especialidades': 'Quais especialidades vocês têm?',
            'localizacao': 'Onde fica a clínica?'
        };

        const questionText = questions[question];
        this.addUserMessage(questionText);

        setTimeout(() => {
            const response = this.processMessage(question);
            this.addBotMessage(response);
        }, 500);
    }

    processMessage(message) {
        const lowerMessage = message.toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, ''); // Remove acentos

        // Verifica respostas diretas
        for (const [key, response] of Object.entries(this.responses)) {
            if (lowerMessage.includes(key)) {
                return response;
            }
        }

        // Verifica por palavras-chave
        for (const [category, keywords] of Object.entries(this.keywords)) {
            for (const keyword of keywords) {
                if (lowerMessage.includes(keyword)) {
                    return this.responses[category] || this.getDefaultResponse();
                }
            }
        }

        // Resposta padrão para perguntas não relacionadas à clínica
        if (this.isClinicRelated(lowerMessage)) {
            return 'Desculpe, não entendi sua pergunta. Você pode perguntar sobre horários, especialidades, localização, serviços ou agendamento de consultas.';
        } else {
            return 'Desculpe, só posso responder perguntas relacionadas à Clínica Estoril e nossos serviços. Como posso ajudá-lo com informações sobre a clínica?';
        }
    }

    isClinicRelated(message) {
        const clinicKeywords = [
            'clinica', 'hospital', 'consulta', 'medico', 'doutor', 'exame',
            'saude', 'atendimento', 'horario', 'especialidade', 'servico',
            'agendar', 'marcar', 'telefone', 'endereco', 'localizacao'
        ];

        return clinicKeywords.some(keyword => message.includes(keyword));
    }

    getDefaultResponse() {
        return 'Desculpe, não entendi. Você pode perguntar sobre horários, especialidades, localização, serviços ou agendamento de consultas.';
    }

    addUserMessage(message) {
        const messagesContainer = document.getElementById('chatbotMessages');
        const time = this.getTime();

        const messageEl = document.createElement('div');
        messageEl.className = 'chatbot-message user-message';
        messageEl.innerHTML = `
            <span class="msg-icon">👤</span>
            <div class="message-content">
                <p>${message}</p>
                <span class="message-time">${time}</span>
            </div>
        `;

        messagesContainer.appendChild(messageEl);
        this.scrollToBottom();
    }

    addBotMessage(message) {
        const messagesContainer = document.getElementById('chatbotMessages');
        const time = this.getTime();

        const messageEl = document.createElement('div');
        messageEl.className = 'chatbot-message bot-message';
        messageEl.innerHTML = `
            <span class="msg-icon">🤖</span>
            <div class="message-content">
                <p>${message}</p>
                <span class="message-time">${time}</span>
            </div>
        `;

        messagesContainer.appendChild(messageEl);
        this.scrollToBottom();
    }

    scrollToBottom() {
        const messagesContainer = document.getElementById('chatbotMessages');
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    getTime() {
        const now = new Date();
        return `${now.getHours().toString().padStart(2, '0')}:${now.getMinutes().toString().padStart(2, '0')}`;
    }
}

// Inicializar chatbot
const chatbot = new ChatBot();