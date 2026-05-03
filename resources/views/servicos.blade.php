@extends('layouts.site')
@section('titulo', 'serviços')
@section('conteudo')
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
                @foreach ($servicos as $servico)
                    <div class="service-detailed-card">
                        <div class="service-detailed-icon">
                            <i class="fas {{ $servico['icone'] }}"></i>
                        </div>
                        <h3>{{ $servico['nome'] }}</h3>
                        <p class="service-description">
                            {{ $servico['descricao'] }}
                        </p>
                        <ul class="service-features">
                            @foreach ($servico['servicos'] as $servico_clinico)
                                <li><i class="fas fa-check"></i>{{ $servico_clinico['nome']}}</li>
                            @endforeach
                        </ul>
                        <a href="/login" class="service-btn">
                            Agendar Consulta <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                @endforeach


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
