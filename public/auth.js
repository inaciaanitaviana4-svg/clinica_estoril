// Sistema de Autenticação e Gerenciamento de Usuários

class AuthSystem {
    constructor() {
        this.currentUser = null;
        this.init();
    }

    init() {
        // Verifica se há um usuário logado
        const savedUser = localStorage.getItem('currentUser');
        if (savedUser) {
            this.currentUser = JSON.parse(savedUser);
            this.showPanel();
        }

        // Inicializa o banco de dados se não existir
        if (!localStorage.getItem('users')) {
            localStorage.setItem('users', JSON.stringify([]));
        }
        if (!localStorage.getItem('consultas')) {
            localStorage.setItem('consultas', JSON.stringify([]));
        }
        if (!localStorage.getItem('adminCreated')) {
            localStorage.setItem('adminCreated', 'false');
        }
    }

    // Login
    login(email, senha) {
        const users = JSON.parse(localStorage.getItem('users'));
        const user = users.find(u => u.email === email && u.senha === senha);

        if (user) {
            this.currentUser = user;
            localStorage.setItem('currentUser', JSON.stringify(user));
            return { success: true, user };
        }

        return { success: false, message: 'E-mail ou senha incorretos' };
    }

    // Logout
    logout() {
        this.currentUser = null;
        localStorage.removeItem('currentUser');
        location.reload();
    }

    // Cadastrar Paciente (público)
    cadastrarPaciente(dados) {
        const users = JSON.parse(localStorage.getItem('users'));

        // Verifica se o e-mail ou CPF já existe
        if (users.find(u => u.email === dados.email)) {
            return { success: false, message: 'E-mail já cadastrado' };
        }
        if (users.find(u => u.cpf === dados.cpf)) {
            return { success: false, message: 'CPF já cadastrado' };
        }

        const novoPaciente = {
            id: Date.now().toString(),
            tipo: 'paciente',
            ...dados,
            dataCadastro: new Date().toISOString()
        };

        users.push(novoPaciente);
        localStorage.setItem('users', JSON.stringify(users));

        return { success: true, message: 'Cadastro realizado com sucesso!' };
    }

    // Cadastrar Administrador (primeira vez)
    cadastrarAdministrador(dados) {
        const adminCreated = localStorage.getItem('adminCreated');

        if (adminCreated === 'true') {
            return { success: false, message: 'Acesso negado' };
        }

        const users = JSON.parse(localStorage.getItem('users'));

        const novoAdmin = {
            id: Date.now().toString(),
            tipo: 'administrador',
            nome: dados.nome,
            email: dados.email,
            senha: dados.senha,
            dataCadastro: new Date().toISOString()
        };

        users.push(novoAdmin);
        localStorage.setItem('users', JSON.stringify(users));
        localStorage.setItem('adminCreated', 'true');

        // Faz login automaticamente
        this.currentUser = novoAdmin;
        localStorage.setItem('currentUser', JSON.stringify(novoAdmin));

        return { success: true, message: 'Administrador cadastrado com sucesso!' };
    }

    // Cadastrar usuário (apenas Admin)
    cadastrarUsuario(dados) {
        if (!this.currentUser || this.currentUser.tipo !== 'administrador') {
            return { success: false, message: 'Acesso negado' };
        }

        const users = JSON.parse(localStorage.getItem('users'));

        if (users.find(u => u.email === dados.email)) {
            return { success: false, message: 'E-mail já cadastrado' };
        }

        const novoUsuario = {
            id: Date.now().toString(),
            ...dados,
            dataCadastro: new Date().toISOString()
        };

        users.push(novoUsuario);
        localStorage.setItem('users', JSON.stringify(users));

        return { success: true, message: 'Usuário cadastrado com sucesso!' };
    }

    // Cadastrar Paciente (Recepcionista)
    cadastrarPacienteRecepcionista(dados) {
        if (!this.currentUser || (this.currentUser.tipo !== 'administrador' && this.currentUser.tipo !== 'recepcionista')) {
            return { success: false, message: 'Acesso negado' };
        }

        const users = JSON.parse(localStorage.getItem('users'));

        if (users.find(u => u.email === dados.email)) {
            return { success: false, message: 'E-mail já cadastrado' };
        }

        if (users.find(u => u.cpf === dados.cpf)) {
            return { success: false, message: 'CPF já cadastrado' };
        }

        const novoPaciente = {
            id: Date.now().toString(),
            tipo: 'paciente',
            ...dados,
            dataCadastro: new Date().toISOString()
        };

        users.push(novoPaciente);
        localStorage.setItem('users', JSON.stringify(users));

        return { success: true, message: 'Paciente cadastrado com sucesso!' };
    }

    // Listar usuários
    listarUsuarios(tipo = null) {
        const users = JSON.parse(localStorage.getItem('users'));
        if (tipo) {
            return users.filter(u => u.tipo === tipo);
        }
        return users;
    }

    // Editar perfil
    editarPerfil(dados) {
        const users = JSON.parse(localStorage.getItem('users'));
        const index = users.findIndex(u => u.id === this.currentUser.id);

        if (index !== -1) {
            users[index] = { ...users[index], ...dados };
            localStorage.setItem('users', JSON.stringify(users));
            this.currentUser = users[index];
            localStorage.setItem('currentUser', JSON.stringify(users[index]));
            return { success: true, message: 'Perfil atualizado com sucesso!' };
        }

        return { success: false, message: 'Erro ao atualizar perfil' };
    }

    // Deletar usuário (Admin)
    deletarUsuario(id) {
        if (!this.currentUser || this.currentUser.tipo !== 'administrador') {
            return { success: false, message: 'Acesso negado' };
        }

        const users = JSON.parse(localStorage.getItem('users'));
        const filteredUsers = users.filter(u => u.id !== id);
        localStorage.setItem('users', JSON.stringify(filteredUsers));

        return { success: true, message: 'Usuário deletado com sucesso!' };
    }

    // Gerenciamento de Consultas
    agendarConsulta(dados) {
        if (!this.currentUser || this.currentUser.tipo !== 'paciente') {
            return { success: false, message: 'Apenas pacientes podem agendar consultas' };
        }

        const consultas = JSON.parse(localStorage.getItem('consultas'));

        const novaConsulta = {
            id: Date.now().toString(),
            pacienteId: this.currentUser.id,
            pacienteNome: this.currentUser.nome,
            ...dados,
            status: 'agendada',
            dataCriacao: new Date().toISOString()
        };

        consultas.push(novaConsulta);
        localStorage.setItem('consultas', JSON.stringify(consultas));

        return { success: true, message: 'Consulta agendada com sucesso!', consulta: novaConsulta };
    }

    cancelarConsulta(consultaId) {
        if (!this.currentUser || this.currentUser.tipo !== 'paciente') {
            return { success: false, message: 'Acesso negado' };
        }

        const consultas = JSON.parse(localStorage.getItem('consultas'));
        const consulta = consultas.find(c => c.id === consultaId && c.pacienteId === this.currentUser.id);

        if (!consulta) {
            return { success: false, message: 'Consulta não encontrada' };
        }

        consulta.status = 'cancelada';
        localStorage.setItem('consultas', JSON.stringify(consultas));

        return { success: true, message: 'Consulta cancelada com sucesso!' };
    }

    reagendarConsulta(consultaId, novosdados) {
        if (!this.currentUser || this.currentUser.tipo !== 'paciente') {
            return { success: false, message: 'Acesso negado' };
        }

        const consultas = JSON.parse(localStorage.getItem('consultas'));
        const index = consultas.findIndex(c => c.id === consultaId && c.pacienteId === this.currentUser.id);

        if (index === -1) {
            return { success: false, message: 'Consulta não encontrada' };
        }

        consultas[index] = { ...consultas[index], ...novosData, status: 'reagendada' };
        localStorage.setItem('consultas', JSON.stringify(consultas));

        return { success: true, message: 'Consulta reagendada com sucesso!' };
    }

    listarConsultas(filtro = {}) {
        const consultas = JSON.parse(localStorage.getItem('consultas'));

        if (this.currentUser.tipo === 'paciente') {
            return consultas.filter(c => c.pacienteId === this.currentUser.id);
        }

        if (this.currentUser.tipo === 'medico') {
            return consultas.filter(c => c.medicoId === this.currentUser.id);
        }

        // Admin e Recepcionista veem todas
        return consultas;
    }

    // Realizar consulta (Médico)
    realizarConsulta(consultaId, observacoes) {
        if (!this.currentUser || this.currentUser.tipo !== 'medico') {
            return { success: false, message: 'Apenas médicos podem realizar consultas' };
        }

        const consultas = JSON.parse(localStorage.getItem('consultas'));
        const index = consultas.findIndex(c => c.id === consultaId);

        if (index === -1) {
            return { success: false, message: 'Consulta não encontrada' };
        }

        consultas[index].status = 'realizada';
        consultas[index].observacoes = observacoes;
        consultas[index].dataRealizacao = new Date().toISOString();

        localStorage.setItem('consultas', JSON.stringify(consultas));

        return { success: true, message: 'Consulta realizada com sucesso!' };
    }

    // Gerar relatórios (Admin e Recepcionista)
    gerarRelatorio(tipo) {
        if (!this.currentUser || (this.currentUser.tipo !== 'administrador' && this.currentUser.tipo !== 'recepcionista')) {
            return { success: false, message: 'Acesso negado' };
        }

        const consultas = JSON.parse(localStorage.getItem('consultas'));
        const users = JSON.parse(localStorage.getItem('users'));

        let relatorio = {};

        switch (tipo) {
            case 'consultas':
                relatorio = {
                    total: consultas.length,
                    agendadas: consultas.filter(c => c.status === 'agendada').length,
                    realizadas: consultas.filter(c => c.status === 'realizada').length,
                    canceladas: consultas.filter(c => c.status === 'cancelada').length
                };
                break;

            case 'pacientes':
                const pacientes = users.filter(u => u.tipo === 'paciente');
                relatorio = {
                    total: pacientes.length,
                    lista: pacientes
                };
                break;

            case 'medicos':
                const medicos = users.filter(u => u.tipo === 'medico');
                relatorio = {
                    total: medicos.length,
                    lista: medicos
                };
                break;

            default:
                relatorio = {
                    totalUsuarios: users.length,
                    totalConsultas: consultas.length
                };
        }

        return { success: true, relatorio };
    }

    // Mostrar painel apropriado
    showPanel() {
        document.getElementById('painelAdmin').classList.add('active');
        this.renderPanel();
    }

    // Renderizar painel baseado no tipo de usuário
    renderPanel() {
        const userNameEl = document.getElementById('painelUserName');
        const navEl = document.getElementById('painelNav');
        const contentEl = document.getElementById('painelContentArea');

        userNameEl.textContent = `${this.currentUser.nome} (${this.currentUser.tipo})`;

        // Renderiza navegação baseada no tipo
        const navItems = this.getNavItems();
        navEl.innerHTML = navItems.map(item => `
            <div class="painel-nav-item" data-view="${item.view}">
                <i class="${item.icon}"></i>
                <span>${item.label}</span>
            </div>
        `).join('');

        // Adiciona eventos de clique
        document.querySelectorAll('.painel-nav-item').forEach(item => {
            item.addEventListener('click', () => {
                document.querySelectorAll('.painel-nav-item').forEach(i => i.classList.remove('active'));
                item.classList.add('active');
                this.renderContent(item.dataset.view);
            });
        });

        // Renderiza primeira view
        if (navItems.length > 0) {
            document.querySelector('.painel-nav-item').classList.add('active');
            this.renderContent(navItems[0].view);
        }
    }

    // Obter itens de navegação baseado no tipo
    getNavItems() {
        const tipo = this.currentUser.tipo;

        const navMap = {
            administrador: [
                { view: 'dashboard', label: 'Dashboard', icon: 'fas fa-chart-line' },
                { view: 'cadastrar-usuario', label: 'Cadastrar Usuário', icon: 'fas fa-user-plus' },
                { view: 'listar-usuarios', label: 'Usuários', icon: 'fas fa-users' },
                { view: 'consultas', label: 'Consultas', icon: 'fas fa-calendar-alt' },
                { view: 'relatorios', label: 'Relatórios', icon: 'fas fa-file-alt' }
            ],
            medico: [
                { view: 'dashboard', label: 'Dashboard', icon: 'fas fa-chart-line' },
                { view: 'minhas-consultas', label: 'Minhas Consultas', icon: 'fas fa-calendar-check' },
                { view: 'perfil', label: 'Meu Perfil', icon: 'fas fa-user' }
            ],
            paciente: [
                { view: 'dashboard', label: 'Início', icon: 'fas fa-home' },
                { view: 'agendar-consulta', label: 'Agendar Consulta', icon: 'fas fa-calendar-plus' },
                { view: 'minhas-consultas', label: 'Minhas Consultas', icon: 'fas fa-calendar-alt' },
                { view: 'perfil', label: 'Meu Perfil', icon: 'fas fa-user' }
            ],
            recepcionista: [
                { view: 'dashboard', label: 'Dashboard', icon: 'fas fa-chart-line' },
                { view: 'cadastrar-paciente', label: 'Cadastrar Paciente', icon: 'fas fa-user-plus' },
                { view: 'consultas', label: 'Consultas', icon: 'fas fa-calendar-alt' },
                { view: 'relatorios', label: 'Relatórios', icon: 'fas fa-file-alt' }
            ]
        };

        return navMap[tipo] || [];
    }

    // Renderizar conteúdo
    renderContent(view) {
        const contentEl = document.getElementById('painelContentArea');
        
        switch (view) {
            case 'dashboard':
                contentEl.innerHTML = this.renderDashboard();
                break;
            case 'cadastrar-usuario':
                contentEl.innerHTML = this.renderCadastrarUsuario();
                this.setupCadastrarUsuarioForm();
                break;
            case 'cadastrar-paciente':
                contentEl.innerHTML = this.renderCadastrarPaciente();
                this.setupCadastrarPacienteForm();
                break;
            case 'listar-usuarios':
                contentEl.innerHTML = this.renderListarUsuarios();
                this.setupDeleteUsuarioButtons();
                break;
            case 'consultas':
                contentEl.innerHTML = this.renderConsultas();
                break;
            case 'minhas-consultas':
                contentEl.innerHTML = this.renderMinhasConsultas();
                this.setupConsultaButtons();
                break;
            case 'agendar-consulta':
                contentEl.innerHTML = this.renderAgendarConsulta();
                this.setupAgendarConsultaForm();
                break;
            case 'perfil':
                contentEl.innerHTML = this.renderPerfil();
                this.setupEditarPerfilForm();
                break;
            case 'relatorios':
                contentEl.innerHTML = this.renderRelatorios();
                break;
            default:
                contentEl.innerHTML = '<h2>View não encontrada</h2>';
        }
    }

    // Templates de renderização
    renderDashboard() {
        const consultas = this.listarConsultas();
        const users = JSON.parse(localStorage.getItem('users'));

        if (this.currentUser.tipo === 'paciente') {
            return `
                <h2><i class="fas fa-home"></i> Bem-vindo, ${this.currentUser.nome}!</h2>
                <div class="dashboard-grid mt-2">
                    <div class="dashboard-card">
                        <div class="dashboard-card-header">
                            <div>
                                <div class="dashboard-card-label">Total de Consultas</div>
                                <div class="dashboard-card-value">${consultas.length}</div>
                            </div>
                            <div class="dashboard-card-icon" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-card">
                        <div class="dashboard-card-header">
                            <div>
                                <div class="dashboard-card-label">Consultas Agendadas</div>
                                <div class="dashboard-card-value">${consultas.filter(c => c.status === 'agendada').length}</div>
                            </div>
                            <div class="dashboard-card-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <h3>Próximas Consultas</h3>
                    ${this.renderConsultasTable(consultas.filter(c => c.status === 'agendada').slice(0, 5))}
                </div>
            `;
        }

        return `
            <h2><i class="fas fa-chart-line"></i> Dashboard</h2>
            <div class="dashboard-grid mt-2">
                <div class="dashboard-card">
                    <div class="dashboard-card-header">
                        <div>
                            <div class="dashboard-card-label">Total de Usuários</div>
                            <div class="dashboard-card-value">${users.length}</div>
                        </div>
                        <div class="dashboard-card-icon" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
                <div class="dashboard-card">
                    <div class="dashboard-card-header">
                        <div>
                            <div class="dashboard-card-label">Total de Consultas</div>
                            <div class="dashboard-card-value">${consultas.length}</div>
                        </div>
                        <div class="dashboard-card-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                </div>
                <div class="dashboard-card">
                    <div class="dashboard-card-header">
                        <div>
                            <div class="dashboard-card-label">Pacientes</div>
                            <div class="dashboard-card-value">${users.filter(u => u.tipo === 'paciente').length}</div>
                        </div>
                        <div class="dashboard-card-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                            <i class="fas fa-user-injured"></i>
                        </div>
                    </div>
                </div>
                <div class="dashboard-card">
                    <div class="dashboard-card-header">
                        <div>
                            <div class="dashboard-card-label">Médicos</div>
                            <div class="dashboard-card-value">${users.filter(u => u.tipo === 'medico').length}</div>
                        </div>
                        <div class="dashboard-card-icon" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                            <i class="fas fa-user-md"></i>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    renderCadastrarUsuario() {
        return `
            <h2><i class="fas fa-user-plus"></i> Cadastrar Usuário</h2>
            <div class="table-container mt-2">
                <form id="formCadastrarUsuario">
                    <div class="form-group">
                        <label><i class="fas fa-user-tag"></i> Tipo de Usuário</label>
                        <select id="tipoUsuario" required>
                            <option value="">Selecione...</option>
                            <option value="medico">Médico</option>
                            <option value="recepcionista">Recepcionista</option>
                            <option value="paciente">Paciente</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label><i class="fas fa-user"></i> Nome Completo</label>
                            <input type="text" id="usuarioNome" required>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-envelope"></i> E-mail</label>
                            <input type="email" id="usuarioEmail" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label><i class="fas fa-lock"></i> Senha</label>
                            <input type="password" id="usuarioSenha" required minlength="6">
                        </div>
                        <div class="form-group" id="crmGroup" style="display: none;">
                            <label><i class="fas fa-id-badge"></i> CRM</label>
                            <input type="text" id="usuarioCRM">
                        </div>
                    </div>
                    <div id="camposPaciente" style="display: none;">
                        <div class="form-row">
                            <div class="form-group">
                                <label><i class="fas fa-id-card"></i> CPF</label>
                                <input type="text" id="usuarioCPF">
                            </div>
                            <div class="form-group">
                                <label><i class="fas fa-calendar"></i> Data de Nascimento</label>
                                <input type="date" id="usuarioDataNascimento">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label><i class="fas fa-phone"></i> Telefone</label>
                                <input type="tel" id="usuarioTelefone">
                            </div>
                            <div class="form-group">
                                <label><i class="fas fa-venus-mars"></i> Sexo</label>
                                <select id="usuarioSexo">
                                    <option value="">Selecione...</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Feminino</option>
                                    <option value="O">Outro</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i> Cadastrar Usuário
                    </button>
                </form>
            </div>
        `;
    }

    renderCadastrarPaciente() {
        return `
            <h2><i class="fas fa-user-plus"></i> Cadastrar Paciente</h2>
            <div class="table-container mt-2">
                <form id="formCadastrarPacienteRecp">
                    <div class="form-row">
                        <div class="form-group">
                            <label><i class="fas fa-user"></i> Nome Completo</label>
                            <input type="text" id="pacienteNome" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label><i class="fas fa-id-card"></i> CPF</label>
                            <input type="text" id="pacienteCPF" required>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-calendar"></i> Data de Nascimento</label>
                            <input type="date" id="pacienteDataNascimento" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label><i class="fas fa-phone"></i> Telefone</label>
                            <input type="tel" id="pacienteTelefone" required>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-venus-mars"></i> Sexo</label>
                            <select id="pacienteSexo" required>
                                <option value="">Selecione...</option>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                                <option value="O">Outro</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-envelope"></i> E-mail</label>
                        <input type="email" id="pacienteEmail" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label><i class="fas fa-lock"></i> Senha</label>
                            <input type="password" id="pacienteSenha" required minlength="6">
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-lock"></i> Confirmar Senha</label>
                            <input type="password" id="pacienteConfirmarSenha" required minlength="6">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i> Cadastrar Paciente
                    </button>
                </form>
            </div>
        `;
    }

    renderListarUsuarios() {
        const users = this.listarUsuarios();
        
        return `
            <h2><i class="fas fa-users"></i> Usuários Cadastrados</h2>
            <div class="table-container mt-2">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Tipo</th>
                            <th>Data de Cadastro</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${users.map(user => `
                            <tr>
                                <td>${user.nome}</td>
                                <td>${user.email}</td>
                                <td>${user.tipo}</td>
                                <td>${new Date(user.dataCadastro).toLocaleDateString()}</td>
                                <td class="table-actions">
                                    <button class="btn btn-sm btn-danger btn-delete-user" data-id="${user.id}">
                                        <i class="fas fa-trash"></i> Deletar
                                    </button>
                                </td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            </div>
        `;
    }

    renderConsultas() {
        const consultas = this.listarConsultas();
        
        return `
            <h2><i class="fas fa-calendar-alt"></i> Consultas</h2>
            ${this.renderConsultasTable(consultas)}
        `;
    }

    renderMinhasConsultas() {
        const consultas = this.listarConsultas();
        
        return `
            <h2><i class="fas fa-calendar-alt"></i> Minhas Consultas</h2>
            ${this.renderConsultasTable(consultas, true)}
        `;
    }

    renderConsultasTable(consultas, showActions = false) {
        if (consultas.length === 0) {
            return '<div class="table-container mt-2"><p class="text-center">Nenhuma consulta encontrada.</p></div>';
        }

        return `
            <div class="table-container mt-2">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Paciente</th>
                            <th>Médico</th>
                            <th>Especialidade</th>
                            <th>Data</th>
                            <th>Horário</th>
                            <th>Status</th>
                            ${showActions && this.currentUser.tipo === 'paciente' ? '<th>Ações</th>' : ''}
                        </tr>
                    </thead>
                    <tbody>
                        ${consultas.map(c => `
                            <tr>
                                <td>${c.pacienteNome}</td>
                                <td>${c.medico || 'Não especificado'}</td>
                                <td>${c.especialidade}</td>
                                <td>${c.data}</td>
                                <td>${c.horario}</td>
                                <td>${c.status}</td>
                                ${showActions && this.currentUser.tipo === 'paciente' ? `
                                    <td class="table-actions">
                                        ${c.status === 'agendada' ? `
                                            <button class="btn btn-sm btn-danger btn-cancelar-consulta" data-id="${c.id}">
                                                <i class="fas fa-times"></i> Cancelar
                                            </button>
                                        ` : ''}
                                    </td>
                                ` : ''}
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            </div>
        `;
    }

    renderAgendarConsulta() {
        const medicos = this.listarUsuarios('medico');
        
        return `
            <h2><i class="fas fa-calendar-plus"></i> Agendar Consulta</h2>
            <div class="table-container mt-2">
                <form id="formAgendarConsultaPainel">
                    <div class="form-group">
                        <label><i class="fas fa-stethoscope"></i> Especialidade</label>
                        <select id="consultaEspecialidade" required>
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
                            <label><i class="fas fa-calendar"></i> Data</label>
                            <input type="date" id="consultaData" required>
                        </div>
                        <div class="form-group">
                            <label><i class="fas fa-clock"></i> Horário</label>
                            <select id="consultaHorario" required>
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
                        <label><i class="fas fa-comment"></i> Observações (opcional)</label>
                        <textarea id="consultaObservacoes" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i> Agendar Consulta
                    </button>
                </form>
            </div>
        `;
    }

    renderPerfil() {
        return `
            <h2><i class="fas fa-user"></i> Meu Perfil</h2>
            <div class="table-container mt-2">
                <form id="formEditarPerfil">
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> Nome Completo</label>
                        <input type="text" id="perfilNome" value="${this.currentUser.nome}" required>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-envelope"></i> E-mail</label>
                        <input type="email" id="perfilEmail" value="${this.currentUser.email}" required>
                    </div>
                    ${this.currentUser.telefone ? `
                        <div class="form-group">
                            <label><i class="fas fa-phone"></i> Telefone</label>
                            <input type="tel" id="perfilTelefone" value="${this.currentUser.telefone}">
                        </div>
                    ` : ''}
                    <div class="form-group">
                        <label><i class="fas fa-lock"></i> Nova Senha (deixe em branco para não alterar)</label>
                        <input type="password" id="perfilSenha" minlength="6">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Salvar Alterações
                    </button>
                </form>
            </div>
        `;
    }

    renderRelatorios() {
        const relConsultas = this.gerarRelatorio('consultas');
        const relPacientes = this.gerarRelatorio('pacientes');
        const relMedicos = this.gerarRelatorio('medicos');

        return `
            <h2><i class="fas fa-file-alt"></i> Relatórios</h2>
            <div class="dashboard-grid mt-2">
                <div class="dashboard-card">
                    <h3>Consultas</h3>
                    <p>Total: ${relConsultas.relatorio.total}</p>
                    <p>Agendadas: ${relConsultas.relatorio.agendadas}</p>
                    <p>Realizadas: ${relConsultas.relatorio.realizadas}</p>
                    <p>Canceladas: ${relConsultas.relatorio.canceladas}</p>
                </div>
                <div class="dashboard-card">
                    <h3>Pacientes</h3>
                    <p>Total: ${relPacientes.relatorio.total}</p>
                </div>
                ${this.currentUser.tipo === 'administrador' ? `
                    <div class="dashboard-card">
                        <h3>Médicos</h3>
                        <p>Total: ${relMedicos.relatorio.total}</p>
                    </div>
                ` : ''}
            </div>
        `;
    }

    // Setup de formulários e eventos
    setupCadastrarUsuarioForm() {
        const form = document.getElementById('formCadastrarUsuario');
        const tipoSelect = document.getElementById('tipoUsuario');
        const crmGroup = document.getElementById('crmGroup');
        const camposPaciente = document.getElementById('camposPaciente');

        tipoSelect.addEventListener('change', (e) => {
            if (e.target.value === 'medico') {
                crmGroup.style.display = 'block';
                camposPaciente.style.display = 'none';
            } else if (e.target.value === 'paciente') {
                crmGroup.style.display = 'none';
                camposPaciente.style.display = 'block';
            } else {
                crmGroup.style.display = 'none';
                camposPaciente.style.display = 'none';
            }
        });

        form.addEventListener('submit', (e) => {
            e.preventDefault();

            const dados = {
                tipo: document.getElementById('tipoUsuario').value,
                nome: document.getElementById('usuarioNome').value,
                email: document.getElementById('usuarioEmail').value,
                senha: document.getElementById('usuarioSenha').value
            };

            if (dados.tipo === 'medico') {
                dados.crm = document.getElementById('usuarioCRM').value;
            } else if (dados.tipo === 'paciente') {
                dados.cpf = document.getElementById('usuarioCPF').value;
                dados.dataNascimento = document.getElementById('usuarioDataNascimento').value;
                dados.telefone = document.getElementById('usuarioTelefone').value;
                dados.sexo = document.getElementById('usuarioSexo').value;
            }

            const result = this.cadastrarUsuario(dados);
            alert(result.message);

            if (result.success) {
                form.reset();
                this.renderContent('listar-usuarios');
                document.querySelectorAll('.painel-nav-item').forEach(i => i.classList.remove('active'));
                document.querySelector('[data-view="listar-usuarios"]').classList.add('active');
            }
        });
    }

    setupCadastrarPacienteForm() {
        const form = document.getElementById('formCadastrarPacienteRecp');

        form.addEventListener('submit', (e) => {
            e.preventDefault();

            const senha = document.getElementById('pacienteSenha').value;
            const confirmarSenha = document.getElementById('pacienteConfirmarSenha').value;

            if (senha !== confirmarSenha) {
                alert('As senhas não coincidem');
                return;
            }

            const dados = {
                nome: document.getElementById('pacienteNome').value,
                cpf: document.getElementById('pacienteCPF').value,
                dataNascimento: document.getElementById('pacienteDataNascimento').value,
                telefone: document.getElementById('pacienteTelefone').value,
                sexo: document.getElementById('pacienteSexo').value,
                email: document.getElementById('pacienteEmail').value,
                senha: senha
            };

            const result = this.cadastrarPacienteRecepcionista(dados);
            alert(result.message);

            if (result.success) {
                form.reset();
            }
        });
    }

    setupDeleteUsuarioButtons() {
        document.querySelectorAll('.btn-delete-user').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const id = e.currentTarget.dataset.id;
                if (confirm('Tem certeza que deseja deletar este usuário?')) {
                    const result = this.deletarUsuario(id);
                    alert(result.message);
                    if (result.success) {
                        this.renderContent('listar-usuarios');
                    }
                }
            });
        });
    }

    setupConsultaButtons() {
        document.querySelectorAll('.btn-cancelar-consulta').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const id = e.currentTarget.dataset.id;
                if (confirm('Tem certeza que deseja cancelar esta consulta?')) {
                    const result = this.cancelarConsulta(id);
                    alert(result.message);
                    if (result.success) {
                        this.renderContent('minhas-consultas');
                    }
                }
            });
        });
    }

    setupAgendarConsultaForm() {
        const form = document.getElementById('formAgendarConsultaPainel');

        // Define data mínima como hoje
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('consultaData').setAttribute('min', today);

        form.addEventListener('submit', (e) => {
            e.preventDefault();

            const dados = {
                especialidade: document.getElementById('consultaEspecialidade').value,
                data: document.getElementById('consultaData').value,
                horario: document.getElementById('consultaHorario').value,
                observacoes: document.getElementById('consultaObservacoes').value
            };

            const result = this.agendarConsulta(dados);
            alert(result.message);

            if (result.success) {
                form.reset();
                this.renderContent('minhas-consultas');
                document.querySelectorAll('.painel-nav-item').forEach(i => i.classList.remove('active'));
                document.querySelector('[data-view="minhas-consultas"]').classList.add('active');
            }
        });
    }

    setupEditarPerfilForm() {
        const form = document.getElementById('formEditarPerfil');

        form.addEventListener('submit', (e) => {
            e.preventDefault();

            const dados = {
                nome: document.getElementById('perfilNome').value,
                email: document.getElementById('perfilEmail').value
            };

            const telefoneEl = document.getElementById('perfilTelefone');
            if (telefoneEl) {
                dados.telefone = telefoneEl.value;
            }

            const novaSenha = document.getElementById('perfilSenha').value;
            if (novaSenha) {
                dados.senha = novaSenha;
            }

            const result = this.editarPerfil(dados);
            alert(result.message);

            if (result.success) {
                document.getElementById('painelUserName').textContent = `${this.currentUser.nome} (${this.currentUser.tipo})`;
            }
        });
    }
}

// Inicializar sistema
const authSystem = new AuthSystem();
