@extends("layouts.site")
@section("titulo","serviços")
@section("conteudo")
    <!-- PAGE HEADER -->
    <section class="page-header">
        <div class="page-header-overlay"></div>
        <div class="container">
            <div class="page-header-content">
                <h1 class="page-title">Nossos Serviços</h1>
                <p class="page-subtitle">Soluções completas para cuidar da sua saúde</p>
                <nav class="breadcrumb">
                   <!-- <a href="/">Início</a>
                    <span>/</span>
                    <span>Serviços</span>-->
                </nav>
            </div>
        </div>
    </section>

    <!-- INTRODUÇÃO -->
    <section class="services-intro">
        <div class="container">
            <div class="section-header center">
                <div class="section-label">Atendimento Completo</div>
                <h2 class="section-title">Cuidados de Saúde Integrados</h2>
                <p class="section-subtitle">
                    Oferecemos uma ampla gama de serviços médicos com tecnologia avançada,<br>
                    profissionais qualificados e infraestrutura moderna
                </p>
            </div>
        </div>
    </section>

    <!-- SERVIÇOS PRINCIPAIS -->
    <section class="services-main">
        <div class="container">
            <div class="services-grid-detailed">
                <!-- Consultas Médicas -->
                <div class="service-detailed-card">
                    <div class="service-detailed-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <h3>Consultas Médicas</h3>
                    <p class="service-description">
                        Atendimento médico em diversas especialidades com profissionais 
                        experientes e equipamentos de última geração.
                    </p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Consultas agendadas</li>
                        <li><i class="fas fa-check"></i> Atendimento de urgência</li>
                        <li><i class="fas fa-check"></i> Telemedicina disponível</li>
                        <li><i class="fas fa-check"></i> Seguimento personalizado</li>
                    </ul>
                    <a href="/contacto" class="service-btn">
                        Agendar Consulta <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Exames Diagnósticos -->
                <div class="service-detailed-card">
                    <div class="service-detailed-icon">
                        <i class="fas fa-x-ray"></i>
                    </div>
                    <h3>Exames Diagnósticos</h3>
                    <p class="service-description">
                        Diagnóstico por imagem com equipamentos modernos para resultados 
                        rápidos e precisos.
                    </p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Radiologia digital</li>
                        <li><i class="fas fa-check"></i> Ultrassonografia</li>
                        <li><i class="fas fa-check"></i> Tomografia computorizada</li>
                        <li><i class="fas fa-check"></i> Ressonância magnética</li>
                    </ul>
                    <a href="contacto.html" class="service-btn">
                        Mais Informações <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Análises Clínicas -->
                <div class="service-detailed-card">
                    <div class="service-detailed-icon">
                        <i class="fas fa-microscope"></i>
                    </div>
                    <h3>Análises Clínicas</h3>
                    <p class="service-description">
                        Laboratório completo com tecnologia avançada para análises 
                        precisas e resultados rápidos.
                    </p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Análises de sangue</li>
                        <li><i class="fas fa-check"></i> Análises de urina</li>
                        <li><i class="fas fa-check"></i> Testes hormonais</li>
                        <li><i class="fas fa-check"></i> Testes microbiológicos</li>
                    </ul>
                    <a href="contacto.html" class="service-btn">
                        Mais Informações <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Cirurgias -->
                <div class="service-detailed-card">
                    <div class="service-detailed-icon">
                        <i class="fas fa-procedures"></i>
                    </div>
                    <h3>Cirurgias</h3>
                    <p class="service-description">
                        Centro cirúrgico equipado com tecnologia de ponta e equipa 
                        especializada em diversos procedimentos.
                    </p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Cirurgias gerais</li>
                        <li><i class="fas fa-check"></i> Cirurgias minimamente invasivas</li>
                        <li><i class="fas fa-check"></i> Cirurgias ambulatoriais</li>
                        <li><i class="fas fa-check"></i> Cirurgias especializadas</li>
                    </ul>
                    <a href="contacto.html" class="service-btn">
                        Mais Informações <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Internamento -->
                <div class="service-detailed-card">
                    <div class="service-detailed-icon">
                        <i class="fas fa-bed"></i>
                    </div>
                    <h3>Internamento</h3>
                    <p class="service-description">
                        Quartos confortáveis e equipados com monitorização contínua 
                        e cuidados de enfermagem especializados.
                    </p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Quartos individuais</li>
                        <li><i class="fas fa-check"></i> Monitorização 24h</li>
                        <li><i class="fas fa-check"></i> Refeições personalizadas</li>
                        <li><i class="fas fa-check"></i> Acompanhamento familiar</li>
                    </ul>
                    <a href="contacto.html" class="service-btn">
                        Mais Informações <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Pronto-Socorro -->
                <div class="service-detailed-card">
                    <div class="service-detailed-icon">
                        <i class="fas fa-ambulance"></i>
                    </div>
                    <h3>Pronto-Socorro 24h</h3>
                    <p class="service-description">
                        Atendimento de urgência e emergência 24 horas por dia, todos 
                        os dias da semana.
                    </p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Atendimento imediato</li>
                        <li><i class="fas fa-check"></i> Equipa multidisciplinar</li>
                        <li><i class="fas fa-check"></i> Equipamentos de emergência</li>
                        <li><i class="fas fa-check"></i> Observação e estabilização</li>
                    </ul>
                    <a href="contacto.html" class="service-btn">
                        Emergência <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Check-up Completo -->
                <div class="service-detailed-card">
                    <div class="service-detailed-icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h3>Check-up Completo</h3>
                    <p class="service-description">
                        Avaliação médica completa para prevenção e deteção precoce 
                        de doenças.
                    </p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Avaliação clínica geral</li>
                        <li><i class="fas fa-check"></i> Exames laboratoriais</li>
                        <li><i class="fas fa-check"></i> Exames de imagem</li>
                        <li><i class="fas fa-check"></i> Relatório detalhado</li>
                    </ul>
                    <a href="contacto.html" class="service-btn">
                        Agendar Check-up <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Medicina do Trabalho -->
                <div class="service-detailed-card">
                    <div class="service-detailed-icon">
                        <i class="fas fa-briefcase-medical"></i>
                    </div>
                    <h3>Medicina do Trabalho</h3>
                    <p class="service-description">
                        Serviços de saúde ocupacional para empresas e trabalhadores, 
                        garantindo ambientes seguros.
                    </p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Exames admissionais</li>
                        <li><i class="fas fa-check"></i> Exames periódicos</li>
                        <li><i class="fas fa-check"></i> Atestados de saúde ocupacional</li>
                        <li><i class="fas fa-check"></i> Programas de prevenção</li>
                    </ul>
                    <a href="contacto.html" class="service-btn">
                        Solicitar Orçamento <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Vacinação -->
                <div class="service-detailed-card">
                    <div class="service-detailed-icon">
                        <i class="fas fa-syringe"></i>
                    </div>
                    <h3>Vacinação</h3>
                    <p class="service-description">
                        Serviço completo de vacinação para todas as idades, seguindo 
                        calendário vacinal recomendado.
                    </p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Vacinas infantis</li>
                        <li><i class="fas fa-check"></i> Vacinas para adultos</li>
                        <li><i class="fas fa-check"></i> Vacinas para viajantes</li>
                        <li><i class="fas fa-check"></i> Cartão de vacinação digital</li>
                    </ul>
                    <a href="contacto.html" class="service-btn">
                        Consultar Vacinas <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- SERVIÇOS ADICIONAIS -->
    

    <!-- CTA -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <div class="cta-text">
                    <h2>Precisa de Atendimento Médico?</h2>
                    <p>Entre em contacto e agende sua consulta</p>
                </div>
                <div class="cta-buttons">
                    <a href="/" class="btn btn-white">
                        <i class="fas fa-calendar-plus"></i>
                        Agendar Consulta
                    </a>
                    <a href="tel:+244 939 789 797" class="btn btn-outline-white">
                        <i class="fas fa-phone"></i>
                        +244 943 500 700
                    </a>
                </div>
            </div>
        </div>
    </section>

   @endsection