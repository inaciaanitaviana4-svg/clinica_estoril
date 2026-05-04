
 @extends("layouts.site")
@section("titulo","Nossa Equipa")
@section("conteudo")
    <!-- PAGE HEADER -->
    <section class="page-header">
        <div class="page-header-overlay"></div>
        <div class="container">
            <div class="page-header-content">
                <h1 class="page-title">Nossa Equipa</h1>
                <p class="page-subtitle">Profissionais altamente qualificados ao seu serviço</p>
                <nav class="breadcrumb">
                    <!--<a href="index.html">Início</a>
                    <span>/</span>
                    <span>Equipa</span>-->
                </nav>
            </div>
        </div>
    </section>

    <!-- INTRODUÇÃO -->
    <section class="team-intro">
        <div class="container">
            <div class="section-header center">
                <div class="section-label">Excelência Médica</div>
                <h2 class="section-title">Conheça Nossos Especialistas</h2>
                <p class="section-subtitle">
                    Nossa equipa é composta por mais de 10 médicos especialistas,<br>
                    profissionais de enfermagem e técnicos dedicados ao seu bem-estar
                </p>
            </div>
        </div>
    </section>

    <!-- EQUIPA MÉDICA -->
    <section class="team-section">
        <div class="container">
             <div class="team-grid">
          @forelse($medicos as $medico)
    <div class="team-card">
        <div class="team-photo">
            @php
                $utilizadorDoMedico = \App\Models\Utilizador::where('id_medico', $medico->id_medico)->first();
            @endphp

            @if($utilizadorDoMedico && $utilizadorDoMedico->foto)
                <img src="{{ asset('storage/' . $utilizadorDoMedico->foto) }}"
                     alt="{{ $medico->nome }}">
            @else
                <div class="team-photo-placeholder">
                    <span>
                        {{ strtoupper(substr($medico->nome, 0, 1)) }}
                    </span>
                </div>
            @endif
        </div>

        <div class="team-info">
            <h3>{{ $medico->nome }}</h3>
            <p class="team-specialty">Especialidade:<br>{{ $medico->especialidade }}</p>
            <p class="team-description service-btn">
                {{ $medico->ano_experiencia }} anos de experiência
            </p>
        </div>
    </div>
@empty
    <p>Nenhum profissional cadastrado.</p>
@endforelse
</div>
</div>
                   
        </div>
    </section>

    <!-- OUTRAS ESPECIALIDADES -->
    <section class="other-specialists">
        <div class="container">
            <div class="section-header center">
                <h2 class="section-title">Outras Especialidades Disponíveis</h2>
                <p class="section-subtitle">Contamos com especialistas em todas as áreas da medicina</p>
            </div>

            <div class="specialties-list">
                <div class="specialty-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Psiquiatria</span>
                </div>
                <div class="specialty-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Psicologia</span>
                </div>
                <div class="specialty-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Urologia</span>
                </div>
                <div class="specialty-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Pneumologia</span>
                </div>
                <div class="specialty-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Reumatologia</span>
                </div>
                <div class="specialty-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Oncologia</span>
                </div>
                <div class="specialty-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Fisioterapia</span>
                </div>
                <div class="specialty-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Nutrição</span>
                </div>
                <div class="specialty-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Otorrinolaringologia</span>
                </div>
                <div class="specialty-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Cirurgia Geral</span>
                </div>
                <div class="specialty-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Medicina Interna</span>
                </div>
                <div class="specialty-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Geriatria</span>
                </div>
            </div>

            <div class="section-cta">
                <a href="/especialidades" class="btn btn-primary">
                    Ver Todas as Especialidades
                </a>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <div class="cta-text">
                    <h2>Agende Sua Consulta</h2>
                    <p>Entre em contacto e escolha o especialista ideal para você</p>
                </div>
                <div class="cta-buttons">
                    <a href="/agendar-consulta-paciente" class="btn btn-white">
                        <i class="fas fa-calendar-plus"></i>
                        Marcar Consulta
                    </a>
                    <a href="tel:+244939789797" class="btn btn-outline-white">
                        <i class="fas fa-phone"></i>
                        +244 939 789 797
                    </a>
                </div>
            </div>
        </div>
    </section>

  @endsection


  