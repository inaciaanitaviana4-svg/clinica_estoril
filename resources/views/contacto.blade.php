@extends('layouts.site')
@section('titulo', 'contacto')
@section('conteudo')
    <!-- PAGE HEADER -->
    <section class="page-header">
        <div class="page-header-overlay"></div>
        <div class="container">
            <div class="page-header-content">
                <h1 class="page-title">Entre em Contacto</h1>
                <p class="page-subtitle">Estamos prontos para atendê-lo</p>
                <nav class="breadcrumb">
                    <!-- <a href="index.html">Início</a>
                        <span>/</span>
                        <span>Contacto</span>-->
                </nav>
            </div>
        </div>
    </section>

    <!-- INFORMAÇÕES DE CONTACTO -->
    <section class="contact-info-section">
        <div class="container">
            <div class="contact-info-grid">
                <div class="contact-info-card">
                    <div class="contact-info-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h3>Telefone</h3>
                    <p><a href="tel:+244939789797">+244 939 789 797</a></p>
                    <p class="contact-info-desc">Seg-Dom: 24 horas</p>
                </div>

                <div class="contact-info-card">
                    <div class="contact-info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3>Email</h3>
                    <p><a href="mailto:geral@clinicaestoril.pt">geral@clinicaestoril.AO</a></p>
                    <p class="contact-info-desc">Resposta em 24h</p>
                </div>

                <div class="contact-info-card">
                    <div class="contact-info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3>Morada</h3>
                    <p>Municipio Kilamba Kiaxi-Luanda</p>
                    <p class="contact-info-desc">Golf2 vila Estoril, Angola</p>
                </div>

                <div class="contact-info-card">
                    <div class="contact-info-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3>Horário</h3>
                    <p>Pronto-socorro: 24h</p>
                    <p class="contact-info-desc">Consultas: 8h-20h</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Informações Adicionais -->
    <div class="contact-sidebar">
        <div class="sidebar-card">
            <div class="sidebar-icon">
                <i class="fas fa-ambulance"></i>
            </div>
            <h3>Urgências 24h</h3>
            <p>Para emergências médicas, dirija-se diretamente ao nosso pronto-socorro ou ligue:</p>
            <a href="tel:+244939789797" class="sidebar-phone">+244 939 789 797</a>
        </div>

        <div class="sidebar-card">
            <div class="sidebar-icon">
                <i class="fas fa-laptop-medical"></i>
            </div>
            <p>Consultas online disponíveis. Faça login na sua área do paciente para agendar.</p>
             @if (session('id_utilizador'))
                    <div style="display:inline-block; align-items: center; gap:8px;">
                        @if (session('tipo_utilizador') == 'admi')
                            <a href="/admin/dashboard" class="btn-login">
                               <i class="fa-solid fa-gauge"></i><span>Dashboard</span>
                            </a>
                        @endif
                        @if (session('tipo_utilizador') == 'recepcionista')
                            <a href="{{ route('mostrar_consultas_recepcionista') }}" class="btn-login">
                                <i class="fa-solid fa-stethoscope"></i><span>Agendamentos</span>
                            </a>
                        @endif
                        @if (session('tipo_utilizador') == 'medico')
                            <a href= "{{ route('mostrar_consultas_medico') }}" class="btn-login">
                                <i class="fa-solid fa-stethoscope"></i><span>Consultas</span>
                            </a>
                        @endif
                        @if (session('tipo_utilizador') == 'paciente')
                            <a href="/painel-paciente/dashboard" class="btn-login">
                                <i class="fa-solid fa-stethoscope"></i><span>Consultas</span>
                            </a>
                        @endif
           </div>
                @else
                    <a style="display:inline-block;" href="/login" class="btn-login">
                        <i class="fas fa-user"></i>
                        <span>Entrar</span>
                    </a>
                @endif

        <div   class="sidebar-card">
            <div class="sidebar-icon">
                <i class="fas fa-file-medical"></i>
            </div>
            <h3>Resultados de Exames</h3>
            <p>Acesse seus resultados de exames através da área do paciente.</p>
            <a href="/login" class="btn btn-outline">Ver Resultados</a>
        </div>

        <div class="sidebar-card sidebar-social">
            <h3>Siga-nos</h3>
            <div class="social-links-large">
                <a href="https://www.facebook.com/c.estoril/" aria-label="Facebook">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="https://www.instagram.com/clinica_estoril?igsh=cXRuMzBwYW5oM2ti" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
    </div>
    </div>
    </div>
    </section>

    <!-- FAQ -->
    <section class="faq-section">
        <div class="container">
            <div class="section-header center">
                <h2 class="section-title">Perguntas Frequentes</h2>
                <p class="section-subtitle">Tire suas dúvidas sobre nossos serviços</p>
            </div>

            <div class="faq-container">
                <div class="faq-item">
                    <button class="faq-question">
                        <span>Como posso agendar uma consulta?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>O agendamento da consulta pode ser feito pelo nosso site. Basta fazer o cadastro, iniciar sessão
                            (login).
                            Caso prefira, também pode agendar por telefone (+244 939 789 797) ou diretamente na recepção.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                        <span>Quais seguros de saúde são aceites?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Trabalhamos com as principais seguradoras do país. Entre em contacto connosco para confirmar se o
                            seu seguro é aceite.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                        <span>Quanto tempo demora para receber resultados de exames?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>O prazo varia conforme o tipo de exame. Exames de sangue geralmente ficam prontos em 24-48h.
                            Exames de imagem podem estar disponíveis no mesmo dia. Você receberá os resultados por email e
                            poderá acessá-los na área do paciente.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                        <span>A clínica oferece atendimento de urgência?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Sim, nosso pronto-socorro funciona 24 horas por dia, 7 dias por semana, incluindo feriados.</p>
                    </div>
                </div>


            </div>
        </div>
    </section>

@endsection
