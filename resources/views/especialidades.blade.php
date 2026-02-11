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
                <h2 class="section-title">Mais de 30 Áreas de Atuação</h2>
                <p class="section-subtitle">Profissionais qualificados para cuidar da sua saúde em todas as fases da vida</p>
            </div>

            <div class="specialties-full-grid">
                <!-- Cardiologia -->
                <div class="specialty-full-card">
                    <div class="specialty-full-icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h3>Cardiologia</h3>
                    <p>Prevenção, diagnóstico e tratamento de doenças cardiovasculares. Equipamentos modernos para exames como ECG, ecocardiograma e teste ergométrico.</p>
                    <a href="/agendar-consulta-paciente" class="specialty-full-btn">Agendar Consulta</a>
                </div>

                <!-- Neurologia -->
                <div class="specialty-full-card">
                    <div class="specialty-full-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3>Neurologia</h3>
                    <p>Diagnóstico e tratamento de doenças do sistema nervoso central e periférico, incluindo dores de cabeça, epilepsia e AVC.</p>
                    <a href="/agendar-consulta-paciente" class="specialty-full-btn">Agendar Consulta</a>
                </div>

                <!-- Ortopedia -->
                <div class="specialty-full-card">
                    <div class="specialty-full-icon">
                        <i class="fas fa-bone"></i>
                    </div>
                    <h3>Ortopedia</h3>
                    <p>Tratamento de lesões, doenças ósseas e problemas do sistema musculoesquelético. Cirurgias e tratamentos conservadores.</p>
                    <a href="/agendar-consulta-paciente" class="specialty-full-btn">Agendar Consulta</a>
                </div>

                <!-- Pediatria -->
                <div class="specialty-full-card">
                    <div class="specialty-full-icon">
                        <i class="fas fa-baby"></i>
                    </div>
                    <h3>Pediatria</h3>
                    <p>Cuidado especializado para bebés, crianças e adolescentes. Acompanhamento do crescimento, vacinação e tratamento de doenças infantis.</p>
                    <a href="/agendar-consulta-paciente" class="specialty-full-btn">Agendar Consulta</a>
                </div>

                <!-- Ginecologia -->
                <div class="specialty-full-card">
                    <div class="specialty-full-icon">
                        <i class="fas fa-female"></i>
                    </div>
                    <h3>Ginecologia e Obstetrícia</h3>
                    <p>Saúde integral da mulher, desde o planeamento familiar até o parto. Acompanhamento de gestação e tratamentos ginecológicos.</p>
                    <a href="/agendar-consulta-paciente" class="specialty-full-btn">Agendar Consulta</a>
                </div>

                <!-- Oftalmologia -->
                <div class="specialty-full-card">
                    <div class="specialty-full-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3>Oftalmologia</h3>
                    <p>Cuidados completos para a saúde ocular. Exames de visão, tratamento de doenças oculares e cirurgias oftalmológicas.</p>
                    <a href="/agendar-consulta-paciente" class="specialty-full-btn">Agendar Consulta</a>
                </div>

                <!-- Dermatologia -->
                <div class="specialty-full-card">
                    <div class="specialty-full-icon">
                        <i class="fas fa-spa"></i>
                    </div>
                    <h3>Dermatologia</h3>
                    <p>Diagnóstico e tratamento de doenças de pele, cabelo e unhas. Procedimentos estéticos e cirurgias dermatológicas.</p>
                    <a href="/agendar-consulta-paciente" class="specialty-full-btn">Agendar Consulta</a>
                </div>

                <!-- Endocrinologia -->
                <div class="specialty-full-card">
                    <div class="specialty-full-icon">
                        <i class="fas fa-dna"></i>
                    </div>
                    <h3>Endocrinologia</h3>
                    <p>Tratamento de distúrbios hormonais, diabetes, doenças da tireoide e problemas metabólicos com acompanhamento especializado.</p>
                    <a href="/agendar-consulta-paciente" class="specialty-full-btn">Agendar Consulta</a>
                </div>

                <!-- Gastroenterologia -->
                <div class="specialty-full-card">
                    <div class="specialty-full-icon">
                        <i class="fas fa-stomach"></i>
                    </div>
                    <h3>Gastroenterologia</h3>
                    <p>Diagnóstico e tratamento de doenças do aparelho digestivo. Endoscopia digestiva e acompanhamento de doenças crónicas.</p>
                    <a href="/agendar-consulta-paciente" class="specialty-full-btn">Agendar Consulta</a>
                </div>

                <!-- Urologia -->
                <div class="specialty-full-card">
                    <div class="specialty-full-icon">
                        <i class="fas fa-male"></i>
                    </div>
                    <h3>Urologia</h3>
                    <p>Tratamento de doenças do sistema urinário masculino e feminino e do sistema reprodutor masculino.</p>
                    <a href="/agendar-consulta-paciente" class="specialty-full-btn">Agendar Consulta</a>
                </div>

                <!-- Pneumologia -->
                <div class="specialty-full-card">
                    <div class="specialty-full-icon">
                        <i class="fas fa-lungs"></i>
                    </div>
                    <h3>Pneumologia</h3>
                    <p>Diagnóstico e tratamento de doenças respiratórias, incluindo asma, DPOC e doenças pulmonares.</p>
                    <a href="/agendar-consulta-paciente" class="specialty-full-btn">Agendar Consulta</a>
                </div>

                <!-- Psiquiatria -->
                <div class="specialty-full-card">
                    <div class="specialty-full-icon">
                        <i class="fas fa-head-side-virus"></i>
                    </div>
                    <h3>Psiquiatria</h3>
                    <p>Avaliação e tratamento de transtornos mentais e emocionais com abordagem humanizada e personalizada.</p>
                    <a href="/agendar-consulta-paciente" class="specialty-full-btn">Agendar Consulta</a>
                </div>

                <!-- Psicologia -->
                <div class="specialty-full-card">
                    <div class="specialty-full-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <h3>Psicologia</h3>
                    <p>Psicoterapia individual, familiar e de casal. Acompanhamento psicológico para crianças, adolescentes e adultos.</p>
                    <a href="/agendar-consulta-paciente" class="specialty-full-btn">Agendar Consulta</a>
                </div>

                <!-- Fisioterapia -->
                <div class="specialty-full-card">
                    <div class="specialty-full-icon">
                        <i class="fas fa-walking"></i>
                    </div>
                    <h3>Fisioterapia</h3>
                    <p>Reabilitação física e tratamento de lesões. Fisioterapia ortopédica, neurológica, respiratória e desportiva.</p>
                    <a href="/agendar-consulta-paciente" class="specialty-full-btn">Agendar Consulta</a>
                </div>

                <!-- Nutrição -->
                <div class="specialty-full-card">
                    <div class="specialty-full-icon">
                        <i class="fas fa-apple-alt"></i>
                    </div>
                    <h3>Nutrição</h3>
                    <p>Planeamento alimentar personalizado para emagrecimento, ganho de massa muscular e tratamento de doenças crónicas.</p>
                    <a href="/agendar-consulta-paciente" class="specialty-full-btn">Agendar Consulta</a>
                </div>

                <!-- Otorrinolaringologia -->
                <div class="specialty-full-card">
                    <div class="specialty-full-icon">
                        <i class="fas fa-ear-listen"></i>
                    </div>
                    <h3>Otorrinolaringologia</h3>
                    <p>Tratamento de doenças do ouvido, nariz e garganta. Audiometria e cirurgias especializadas.</p>
                    <a href="/agendar-consulta-paciente" class="specialty-full-btn">Agendar Consulta</a>
                </div>

                <!-- Reumatologia -->
                <div class="specialty-full-card">
                    <div class="specialty-full-icon">
                        <i class="fas fa-hand-holding-medical"></i>
                    </div>
                    <h3>Reumatologia</h3>
                    <p>Diagnóstico e tratamento de doenças reumáticas, artrite, osteoporose e doenças autoimunes.</p>
                    <a href="/agendar-consulta-paciente" class="specialty-full-btn">Agendar Consulta</a>
                </div>

                <!-- Oncologia -->
                <div class="specialty-full-card">
                    <div class="specialty-full-icon">
                        <i class="fas fa-ribbon"></i>
                    </div>
                    <h3>Oncologia</h3>
                    <p>Prevenção, diagnóstico e tratamento do cancro com equipa multidisciplinar e tecnologia avançada.</p>
                    <a href="/agendar-consulta-paciente" class="specialty-full-btn">Agendar Consulta</a>
                </div>

                <!-- Angiologia -->
                <div class="specialty-full-card">
                    <div class="specialty-full-icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h3>Angiologia</h3>
                    <p>Tratamento de doenças vasculares, varizes e problemas de circulação sanguínea.</p>
                    <a href="/agendar-consulta-paciente" class="specialty-full-btn">Agendar Consulta</a>
                </div>

                <!-- Cirurgia Geral -->
                <div class="specialty-full-card">
                    <div class="specialty-full-icon">
                        <i class="fas fa-procedures"></i>
                    </div>
                    <h3>Cirurgia Geral</h3>
                    <p>Cirurgias do aparelho digestivo, hérnias, vesícula e outros procedimentos cirúrgicos gerais.</p>
                    <a href="/agendar-consulta-paciente" class="specialty-full-btn">Agendar Consulta</a>
                </div>

                <!-- Medicina Interna -->
                <div class="specialty-full-card">
                    <div class="specialty-full-icon">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <h3>Medicina Interna</h3>
                    <p>Diagnóstico e tratamento de doenças complexas em adultos. Gestão de múltiplas patologias.</p>
                    <a href="/agendar-consulta-paciente" class="specialty-full-btn">Agendar Consulta</a>
                </div>

                <!-- Geriatria -->
                <div class="specialty-full-card">
                    <div class="specialty-full-icon">
                        <i class="fas fa-user-clock"></i>
                    </div>
                    <h3>Geriatria</h3>
                    <p>Cuidados especializados para idosos, prevenção e tratamento de doenças relacionadas ao envelhecimento.</p>
                    <a href="/agendar-consulta-paciente" class="specialty-full-btn">Agendar Consulta</a>
                </div>

                <!-- Alergologia -->
                <div class="specialty-full-card">
                    <div class="specialty-full-icon">
                        <i class="fas fa-allergies"></i>
                    </div>
                    <h3>Alergologia</h3>
                    <p>Diagnóstico e tratamento de alergias respiratórias, alimentares e cutâneas. Testes alérgicos especializados.</p>
                    <a href="/agendar-consulta-paciente" class="specialty-full-btn">Agendar Consulta</a>
                </div>

                <!-- Nefrologia -->
                <div class="specialty-full-card">
                    <div class="specialty-full-icon">
                        <i class="fas fa-kidneys"></i>
                    </div>
                    <h3>Nefrologia</h3>
                    <p>Tratamento de doenças renais, incluindo insuficiência renal, cálculos e infecções urinárias.</p>
                    <a href="/agendar-consulta-paciente" class="specialty-full-btn">Agendar Consulta</a>
                </div>
            </div>
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