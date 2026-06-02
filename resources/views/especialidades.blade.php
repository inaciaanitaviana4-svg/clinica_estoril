@extends("layouts.site")
@section("titulo","Especialidades")
@section("conteudo")
    
    <!-- PAGE HEADER -->
    <section class="page-header">
        <div class="page-header-overlay"></div>
        <div class="container">
            <div class="page-header-content">
                <h1 class="page-title">Especialidades Médicas</h1>
                <p class="page-subtitle">Atendimento multidisciplinar com profissionais especializados</p>
                <nav class="breadcrumb">
                    <!--<a href="index.html">Início</a>
                    <span>/</span>
                    <span>Especialidades</span>-->
                </nav>
            </div>
        </div>
    </section>

    <!-- ESPECIALIDADES -->
    <section class="specialties-section">
        <div class="container">
            <div class="section-header center">
                <div class="section-label">Nossas Especialidades</div>
                <h2 class="section-title">Mais de 10 Áreas de Atuação</h2>
                <p class="section-subtitle">Profissionais qualificados para cuidar da sua saúde em todas as fases da vida</p>
            </div>

           <div class="specialties-full-grid">
    @forelse($especialidades as $esp)
        <div class="specialty-full-card">
            <div class="specialty-full-icon">
                <i class="fas fa-stethoscope"></i>
            </div>

            <h3>{{ $esp->nome }}</h3>
            <p style="font-size:17px;">{{ $esp->descricao }}</p>

            <a href="/agendar-consulta-paciente" class="specialty-full-btn">
                Agendar Consulta
            </a>
        </div>
    @empty
        <p>Nenhuma especialidade cadastrada.</p>
    @endforelse
</div>
    </section>

    <!-- CTA -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <div class="cta-text">
                    <h2>Não Encontrou a Especialidade?</h2>
                    <p>Entre em contacto e fale com nossa equipa</p>
                </div>
                <div class="cta-buttons">
                    <a href="/contacto" class="btn btn-white">
                        <i class="fas fa-phone"></i>
                        Entrar em Contacto
                    </a>
                    <a href="/equipa" class="btn btn-outline-white">
                        <i class="fas fa-user-md"></i>
                        Conhecer a Equipa
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
