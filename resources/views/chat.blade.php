@extends("layouts.site")
@section("titulo","chat bot de saúde")
@section("estilo")
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(to bottom, #e6e8eb, #f1f2f8);
            height: 100vh;
            overflow: hidden;
        }

        .chat-container {
            max-width: 900px;
            margin: 0 auto;
            height: 100vh;
            display: flex;
            flex-direction: column;
            background: white;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
        }

        /* Header */
        .chat-header {
            background: linear-gradient(to right, #2563eb, #1d4ed8);
            color: white;
            padding: 100px;
            height: 5vh;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .bot-avatar {
            background: white;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
        }

        .header-info h1 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .header-info p {
            font-size: 14px;
            color: #bfdbfe;
        }

        /* Quick Options */
        .quick-options {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 16px;
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .quick-btn {
            padding: 8px 16px;
            border: 1px solid #d1d5db;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .quick-btn:hover {
            background: #f3f4f6;
            border-color: #2563eb;
        }

        /* Messages Area */
        .messages-container {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .message-wrapper {
            display: flex;
            gap: 12px;
            max-width: 80%;
        }

        .message-wrapper.user {
            align-self: flex-end;
            flex-direction: row-reverse;
        }

        .message-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            flex-shrink: 0;
        }

        .message-avatar.bot {
            background: linear-gradient(to bottom right, #10b981, #059669);
        }

        .message-avatar.user {
            background: #2563eb;
        }

        .message-content {
            display: flex;
            flex-direction: column;
        }

        .message-bubble {
            padding: 16px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .message-bubble.bot {
            background: white;
            border: 1px solid #e5e7eb;
        }

        .message-bubble.user {
            background: #2563eb;
            color: white;
        }

        .message-text {
            font-size: 14px;
            line-height: 1.6;
            white-space: pre-wrap;
        }

        .message-text strong {
            font-weight: 600;
        }

        .message-text ul {
            margin: 8px 0;
            padding-left: 20px;
        }

        .message-text li {
            margin: 4px 0;
        }

        .message-time {
            font-size: 12px;
            color: #9ca3af;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .message-wrapper.user .message-time {
            justify-content: flex-end;
        }

        /* Typing Indicator */
        .typing-indicator {
            display: none;
            align-items: center;
            gap: 12px;
            max-width: 80%;
        }

        .typing-indicator.active {
            display: flex;
        }

        .typing-dots {
            background: white;
            border: 1px solid #e5e7eb;
            padding: 16px;
            border-radius: 12px;
            display: flex;
            gap: 4px;
        }

        .dot {
            width: 8px;
            height: 8px;
            background: #9ca3af;
            border-radius: 50%;
            animation: bounce 1.4s infinite;
        }

        .dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        .dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes bounce {
            0%, 60%, 100% {
                transform: translateY(0);
            }
            30% {
                transform: translateY(-10px);
            }
        }

        /* Input Area */
        .input-area {
            background: white;
            border-top: 1px solid #e5e7eb;
            padding: 16px;
        }

        .input-wrapper {
            display: flex;
            gap: 8px;
        }

        .message-input {
            flex: 1;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            outline: none;
            transition: border-color 0.2s;
        }

        .message-input:focus {
            border-color: #2563eb;
        }

        .send-btn {
            padding: 12px 24px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .send-btn:hover {
            background: #1d4ed8;
        }

        .send-btn:disabled {
            background: #9ca3af;
            cursor: not-allowed;
        }

        .disclaimer {
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            margin-top: 8px;
        }

        /* Scrollbar */
        .messages-container::-webkit-scrollbar {
            width: 8px;
        }

        .messages-container::-webkit-scrollbar-track {
            background: #f3f4f6;
        }

        .messages-container::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 4px;
        }

        .messages-container::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
    </style>
@endsection
@section("conteudo")
    <div class="chat-container">
        <!-- Header -->
        <div class="chat-header">
            <div class="bot-avatar">🤖</div>
            <div class="header-info">
                <h1>Assistente de Saúde</h1>
                <p>Online • Sempre disponível para ajudar</p>
            </div>
        </div>

        <!-- Quick Options -->
        <div class="quick-options">
            <button class="quick-btn" onclick="sendQuickMessage('horários médicos')">
                 Horários
            </button>
            <button class="quick-btn" onclick="sendQuickMessage('dicas de saúde')">
                Dicas de Saúde
            </button>
            
        </div>

        <!-- Messages -->
        <div class="messages-container" id="messagesContainer">
            <!-- Initial bot message -->
            <div class="message-wrapper bot">
                <div class="message-avatar bot"></div>
                <div class="message-content">
                    <div class="message-bubble bot">
                        <div class="message-text">Olá! 👋Sou seu assistente de saúde. Posso ajudá-lo com informações sobre saúde, horários médicos e dicas de bem-estar. Como posso ajudá-lo hoje?</div>
                    </div>
                    <div class="message-time">
                         <span id="initialTime"></span>
                    </div>
                </div>
            </div>

            <!-- Typing Indicator -->
            <div class="typing-indicator" id="typingIndicator">
                <div class="message-avatar bot"></div>
                <div class="typing-dots">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="input-area">
            <div class="input-wrapper">
                <input 
                    type="text" 
                    class="message-input" 
                    id="messageInput" 
                    placeholder="Digite sua pergunta sobre saúde..."
                    onkeypress="handleKeyPress(event)"
                >
                <button class="send-btn" id="sendBtn" onclick="sendMessage()">
                    ✉️ Enviar
                </button>
            </div>
            <p class="disclaimer">⚠️ Este chatbot fornece informações gerais. Em caso de emergência, ligue 192.</p>
        </div>
    </div>
@endsection
@section("script")
    <script>
        // Initialize
        document.getElementById('initialTime').textContent = getCurrentTime();

        function getCurrentTime() {
            return new Date().toLocaleTimeString('pt-BR', {
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        function scrollToBottom() {
            const container = document.getElementById('messagesContainer');
            container.scrollTop = container.scrollHeight;
        }

        function handleKeyPress(event) {
            if (event.key === 'Enter') {
                sendMessage();
            }
        }

        function sendQuickMessage(message) {
            document.getElementById('messageInput').value = message;
            sendMessage();
        }

        function sendMessage() {
            const input = document.getElementById('messageInput');
            const message = input.value.trim();
            
            if (!message) return;

            // Add user message
            addMessage(message, 'user');
            input.value = '';

            // Show typing indicator
            document.getElementById('typingIndicator').classList.add('active');
            scrollToBottom();

            // Get bot response after delay
            setTimeout(() => {
                document.getElementById('typingIndicator').classList.remove('active');
                const response = getBotResponse(message);
                addMessage(response, 'bot');
            }, 1000 + Math.random() * 1000);
        }

        function addMessage(text, sender) {
            const container = document.getElementById('messagesContainer');
            const messageWrapper = document.createElement('div');
            messageWrapper.className = `message-wrapper ${sender}`;

            const avatar = document.createElement('div');
            avatar.className = `message-avatar ${sender}`;
            avatar.textContent = sender === 'user' ? '👤' : '🤖';

            const content = document.createElement('div');
            content.className = 'message-content';

            const bubble = document.createElement('div');
            bubble.className = `message-bubble ${sender}`;

            const messageText = document.createElement('div');
            messageText.className = 'message-text';
            messageText.innerHTML = formatMessage(text);

            const time = document.createElement('div');
            time.className = 'message-time';
            time.innerHTML = `🕐 ${getCurrentTime()}`;

            bubble.appendChild(messageText);
            content.appendChild(bubble);
            content.appendChild(time);
            messageWrapper.appendChild(avatar);
            messageWrapper.appendChild(content);

            // Insert before typing indicator
            const typingIndicator = document.getElementById('typingIndicator');
            container.insertBefore(messageWrapper, typingIndicator);

            scrollToBottom();
        }

        function formatMessage(text) {
            let formatted = text;
            
            // Bold text
            formatted = formatted.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
            
            // Line breaks
            formatted = formatted.replace(/\n/g, '<br>');
            
            return formatted;
        }

        function getBotResponse(userMessage) {
            const lowerMessage = userMessage.toLowerCase();

            // Horários médicos
            if (lowerMessage.includes('horário') || lowerMessage.includes('horario') || lowerMessage.includes('consulta') || lowerMessage.includes('atendimento')) {
                return `📅 **Horários de Atendimento:**

🏥 **Clínica Geral**
Segunda a Sexta: 8h às 18h
Sábado: 8h às 12h

👨‍⚕️ **Especialidades**
Cardiologia: Terças e Quintas (14h-17h)
Pediatria: Segundas, Quartas e Sextas (8h-12h)
Ortopedia: Quartas (13h-18h)

 Para agendar: (11) 3456-7890`;
            }
            if (lowerMessage.includes('Okay') || lowerMessage.includes('ok') || lowerMessage.includes('Ok') || lowerMessage.includes('obrigado') || lowerMessage.includes('obrigada')|| lowerMessage.includes('valeu')) {
                return ` **Fico Feliz por ter ajudado.**
 Estou aqui para esclarecer qualquer dúvida sobre:
            Horários de atendimento
             Dicas de saúde e bem-estar
            Informações sobre especialidades
             Como agendar consultas `;
               }
            // Dicas de saúde
            if (lowerMessage.includes('dica') || lowerMessage.includes('conselho') || lowerMessage.includes('saúde') || lowerMessage.includes('saude')) {
                return ` **Dicas de Saúde Importantes:**

💧 Beba pelo menos 2 litros de água por dia
🥗 Mantenha uma alimentação balanceada rica em frutas e vegetais
🏃‍♂️ Pratique exercícios físicos 30min, 3x por semana
😴 Durma de 7-8 horas por noite
🧘‍♀️ Reserve tempo para cuidar da saúde mental
🩺 Faça check-ups médicos regularmente

Qual área específica você gostaria de saber mais?`;
            }

            // Especialidades
            if (lowerMessage.includes('especialidades') || lowerMessage.includes('especialidades') ||  lowerMessage.includes('especialista') || lowerMessage.includes('médico') || lowerMessage.includes('medico')) {
                return `👨‍⚕️ **Nossas Especialidades médicas:**

❤️ Cardiologia - Doenças do coração
🦴 Ortopedia - Problemas ósseos e articulares
👶 Pediatria - Saúde infantil
🧠 Neurologia - Sistema nervoso
👁️ Oftalmologia - Saúde dos olhos
🦷 Odontologia - Saúde bucal
💊 Clínica Geral - Atendimento geral

Precisa agendar com algum especialista?`;
            }

            // Cardiologia
            if (lowerMessage.includes('coração') || lowerMessage.includes('coracao') || lowerMessage.includes('cardio') || lowerMessage.includes('pressão') || lowerMessage.includes('pressao')) {
                return `❤️ **Saúde Cardíaca:**

⚠️ Sinais de alerta:
• Dor no peito
• Falta de ar
• Palpitações
• Inchaço nas pernas

✅ Prevenção:
• Evite fumar
• Controle o colesterol
• Pratique exercícios
• Reduza sal e gorduras
• Gerencie o estresse

📅 Cardiologista disponível: Terças e Quintas, 14h-17h`;
            }

            // Alimentação
            if (lowerMessage.includes('aliment') || lowerMessage.includes('comida') || lowerMessage.includes('dieta') || lowerMessage.includes('nutrição') || lowerMessage.includes('nutricao')) {
                return `🥗 **Dicas de Alimentação Saudável:**

✅ Inclua no seu prato:
• Frutas variadas (3-5 porções/dia)
• Vegetais coloridos
• Proteínas magras (peixe, frango, leguminosas)
• Grãos integrais
• Castanhas e sementes

❌ Evite:
• Açúcar refinado em excesso
• Alimentos ultraprocessados
• Gorduras trans
• Excesso de sódio

💡 Dica: Monte um prato colorido - quanto mais cores, mais nutrientes!`;
            }

            // Exercícios
            if (lowerMessage.includes('exercício') || lowerMessage.includes('exercicio') || lowerMessage.includes('atividade') || lowerMessage.includes('ginástica') || lowerMessage.includes('ginastica')) {
                return `🏃‍♂️ **Atividade Física e Exercícios:**

🎯 Recomendação da OMS:
• 150min de exercícios moderados por semana
• Ou 75min de exercícios intensos
• Alongamento 2-3x por semana

💪 Benefícios:
• Fortalece o coração
• Melhora o humor
• Controla o peso
• Reduz estresse
• Melhora a qualidade do sono

⚠️ Antes de iniciar atividades intensas, consulte um médico!`;
            }

            // Sono
            if (lowerMessage.includes('sono') || lowerMessage.includes('dormir') || lowerMessage.includes('insônia') || lowerMessage.includes('insonia') || lowerMessage.includes('cansaço') || lowerMessage.includes('cansaco')) {
                return `😴 **Saúde do Sono:**

⏰ Dicas para dormir melhor:
• Mantenha horários regulares
• Evite telas 1h antes de dormir
• Deixe o quarto escuro e silencioso
• Temperatura ambiente fresca (18-22°C)
• Evite café após 15h
• Pratique técnicas de relaxamento

✅ Adultos precisam de 7-9h de sono por noite

⚠️ Insônia persistente? Consulte um médico!`;
            }

            // Vacinação
            if (lowerMessage.includes('vacina') || lowerMessage.includes('imunização') || lowerMessage.includes('imunizacao')) {
                return `💉 **Vacinação:**

📋 Vacinas importantes para adultos:
• Gripe (anual)
• COVID-19 (conforme recomendação)
• Tétano (10 em 10 anos)
• Hepatite B
• Febre Amarela

👶 Para crianças, siga o calendário nacional de vacinação

📍 Posto de vacinação: Segunda a Sexta, 8h-17h
📞 Informações: (11) 3456-7890`;
            }

            // Emergência
            if (lowerMessage.includes('emergência') || lowerMessage.includes('emergencia') || lowerMessage.includes('urgência') || lowerMessage.includes('urgencia') || lowerMessage.includes('socorro')) {
                return `🚨 **EM CASO DE EMERGÊNCIA:**

📞 SAMU: 192
📞 Bombeiros: 193
📞 Ambulância: 192

⚠️ Procure atendimento imediato se:
• Dor no peito intensa
• Dificuldade para respirar
• Sangramento intenso
• Perda de consciência
• Convulsões
• Sinais de AVC (rosto caído, fala arrastada, fraqueza)

🏥 Pronto Socorro 24h: Rua da Saúde, 123`;
            }

            // Agendar
            if (lowerMessage.includes('agendar') || lowerMessage.includes('marcar')) {
                return `📅 **Agendar Consulta:**

Você pode agendar pelos seguintes canais:

📞 Telefone: (11) 3456-7890
💬 WhatsApp: (11) 98765-4321
🌐 Site: www.clinicasaude.com.br
📱 App: Baixe nosso aplicativo

⏰ Atendimento: Segunda a Sexta, 8h-18h

💡 Tenha em mãos: RG, CPF e carteirinha do convênio`;
            }

            // COVID
            if (lowerMessage.includes('covid') || lowerMessage.includes('corona')) {
                return `😷 **Informações sobre COVID-19:**

⚠️ Sintomas:
• Febre
• Tosse
• Dificuldade para respirar
• Perda de olfato/paladar
• Fadiga

🛡️ Prevenção:
• Use máscara em locais fechados
• Higienize as mãos frequentemente
• Mantenha ambientes ventilados
• Mantenha vacinação em dia

🧪 Teste COVID disponível: Segunda a Sexta, 8h-16h`;
            }

            // Resposta padrão
            const defaultResponses = [
                `Informção interessante, mas no momento só posso ajudar com:

📅 Horários de atendimento
💡 Dicas de saúde e bem-estar
👨‍⚕️ Informações sobre especialidades
📞 Como agendar consultas

Sobre o que você gostaria de saber?`,
                `Estou aqui para ajudar! Posso fornecer informações sobre:

• Horários médicos
• Dicas de alimentação saudável
• Exercícios físicos
• Sono e descanso
• Vacinação

Qual assunto te interessa?`,
                `Informção interessante, mas no momento ainda não possuo capacidade para dar a resposta. Você pode perguntar sobre:

🏥 Horários e agendamentos
❤️ Saúde cardiovascular
🥗 Nutrição
🏃‍♂️ Atividades físicas
😴 Qualidade do sono

Como posso te ajudar?`
            ];

            return defaultResponses[Math.floor(Math.random() * defaultResponses.length)];
        }

        // Update send button state
        document.getElementById('messageInput').addEventListener('input', function() {
            const btn = document.getElementById('sendBtn');
            btn.disabled = !this.value.trim();
        });
    </script>
@endsection