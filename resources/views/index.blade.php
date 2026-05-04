@extends("layouts.site")
@section("titulo","ínicio")
@section("conteudo")
<!-- HERO SECTION -->
<section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="container">
            <div class="hero-text">
                <h1 class="hero-title">
                    Clínica Estoril<br>
            <span class="highlight">A sua saúde nas melhores mãos</span>
                </h1>
                <p class="hero-subtitle">
                     Clínica Estoril, a sua saúde nas melhores mãos.
                    Dispomos de Médicos qualificados em diversas especialidades e tecnologia moderna para tornar o Atendimento e
                    marcação de consulta mais rápido e eficaz.
                    Explore o nosso site e descubra um cuidado pensado para si.<br>

                </p>
                <div class="hero-buttons">
                    <a href="/agendar-consulta-paciente" class="btn btn-primary">
                        <i class="fas fa-calendar-check"></i>
                        Agendar Consulta
                    </a>
                    <a href="/sobre" class="btn btn-secondary">
                        <i class="fas fa-info-circle"></i>
                        Sobre Nós
                    </a>
                </div>
            </div>

            <!-- Estatísticas -->
            <div class="hero-stats">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-number">{{ $totalPacientes }} </h3>
                        <p class="stat-label">Pacientes Atendidos</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-number">{{ $anosExperiencia }} </h3>
                        <p class="stat-label">Anos de Experiência</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-number">{{ $totalEspecialidades }} </h3>
                        <p class="stat-label">Especialidades</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- DESTAQUES -->
<section class="features">
    <div class="container">
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3>Atendimento 24h</h3>
                <p>Urgências disponíveis todos os dias da semana</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-microscope"></i>
                </div>
                <h3>Tecnologia avançado</h3>
                <p>Equipamentos modernos para diagnósticos precisos</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3>Atendimento Humanizado</h3>
                <p>Cuidado personalizado para cada paciente</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Segurança e Qualidade</h3>
                <p>Protocolos rigorosos de segurança médica</p>
            </div>
        </div>
    </div>
</section>

<!-- ESPECIALIDADES DESTAQUE -->
<section class="other-specialists">
        <div class="container">
            <div class="section-header center">
                <h2 class="section-title">Nossas Especialidades</h2>
                <p class="section-subtitle">Contamos com especialistas em diversas as áreas da medicina</p>
            </div>

            <div class="specialties-list">
                <div class="specialty-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Cardiologia</span>
                </div>
                <div class="specialty-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Oftalmologia</span>
                </div>
                <div class="specialty-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Otorrinolarngologia</span>
                </div>
                <div class="specialty-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Pneumologia</span>
                </div>
                <div class="specialty-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Ginecologia e Obstetrícia</span>
                </div>
                <div class="specialty-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Nutrição</span>
                </div>
                <div class="specialty-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Fisioterapia</span>
                </div>
                <div class="specialty-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Neurologia</span>
                </div>
                <div class="specialty-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Urologia</span>
                </div>
                <div class="specialty-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Endocrinologia</span>
                </div>
                <div class="specialty-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Dermatologia</span>
                </div>
                <div class="specialty-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Ortopedia</span>
                </div>
            </div>

            <div class="section-cta">
                <a href="/especialidades" class="btn btn-primary">
                    Ver Todas as Especialidades
                </a>
            </div>
        </div>
    </section>

<!-- CTA AGENDAR -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <div class="cta-text">
                <h2>Pronto para Cuidar da Sua Saúde?</h2>
                <p>Agende sua consulta online de forma rápida e prática</p>
            </div>
        </div>
    </div>
</section>

@endsection
