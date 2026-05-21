@extends('layouts.site')

@section('titulo', 'serviços')

@section('conteudo')

    <!-- PAGE HEADER -->
    <section class="page-header">
        <div class="page-header-overlay"></div>

        <div class="container">
            <div class="page-header-content">

                <h1 class="page-title">
                    Nossos Serviços
                </h1>

                <p class="page-subtitle">
                    Soluções completas para cuidar da sua saúde
                </p>

            </div>
        </div>
    </section>

    <!-- INTRODUÇÃO -->
    <section class="services-intro">

        <div class="container">

            <div class="section-header center">

                <div class="section-label">
                    Atendimento Completo
                </div>

                <h2 class="section-title">
                    Cuidados de Saúde Integrados
                </h2>

                <p class="section-subtitle">
                    Oferecemos uma ampla gama de serviços médicos com tecnologia avançada,
                    <br>
                    profissionais qualificados e infraestrutura moderna
                </p>

            </div>

        </div>

    </section>

    <!-- SERVIÇOS -->
    <section class="services-main">

        <div class="container">

            <div class="services-grid-detailed">

                @foreach ($servicos as $servico)

                    <div class="service-detailed-card">

                        <!-- TOPO -->
                        <div>

                            <div class="service-detailed-icon">
                                <i class="fas {{ $servico['icone'] }}"></i>
                            </div>

                            <h3>
                                {{ $servico['nome'] }}
                            </h3>

                            <p class="service-description">
                                {{ $servico['descricao'] }}
                            </p>

                            <!-- LISTA -->
                            <div class="service-features-wrapper">

                                <ul class="service-features collapsed">

                                    @foreach ($servico['servicos'] as $servico_clinico)

                                        <li>
                                            <i class="fas fa-check"></i>
                                            {{ $servico_clinico['nome'] }}
                                        </li>

                                    @endforeach

                                </ul>

                                @if(count($servico['servicos']) > 5)

                                    <button
                                        type="button"
                                        class="toggle-services-btn"
                                    >
                                        Ver mais
                                    </button>

                                @endif

                            </div>

                        </div>

                       

                    </div>

                @endforeach

            </div>

        </div>

    </section>

    <!-- CTA -->
    <section class="cta-section">

        <div class="container">

            <div class="cta-content">

                <div class="cta-text">

                    <h2>
                        Precisa de Atendimento Médico?
                    </h2>

                    <p>
                        Entre em contacto e agende sua consulta
                    </p>

                </div>

                <div class="cta-buttons">

                    <a href="tel:+244943500700" class="btn btn-outline-white">
                        <i class="fas fa-phone"></i>
                        +244 943 500 700
                    </a>

                </div>

            </div>

        </div>

    </section>

    <!-- CSS -->
    <style>


    </style>

    <!-- JAVASCRIPT -->
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const buttons = document.querySelectorAll('.toggle-services-btn');

            buttons.forEach(button => {

                button.addEventListener('click', function () {

                    const wrapper = this.closest('.service-features-wrapper');

                    const list = wrapper.querySelector('.service-features');

                    list.classList.toggle('collapsed');

                    const collapsed = list.classList.contains('collapsed');

                    this.textContent = collapsed
                        ? 'Ver mais'
                        : 'Ver menos';

                });

            });

        });

    </script>

@endsection