@extends('layouts.painel')
@section('titulo', 'Realizar Consulta')
@section('conteudo')
    <section id="medico" class="section active painel ">

        <div class="card">
            <h2 class="text-primary-color">{{ $paciente->nome }}</h2>
            <div class="row">
                <span class="col"><i class="fa-regular fa-calendar"></i>
                    {{ date('Y') - date('Y', strtotime($paciente->data_nascimento)) }} ano(s) </span>
                <span class="col"><i class="fa-solid fa-venus"></i> {{ $paciente->genero }}</span>
                <span class="col"><i class="fa-solid fa-mobile-screen"></i> {{ $paciente->num_telefone }}</span>
                <span class="col"><i class="fa-regular fa-envelope"></i> {{ $paciente->email }}</span>
            </div>
            <div class="row mt-4 p-4" style="background-color: var(--bg-light)">
                <div class="col rc-container">
                    <span class="rc-label">Consulta N.º</span>
                    <span class="rc-valor">{{ $consulta->id_consulta }}</span>

                </div>
                <div class="col rc-container">
                    <span class="rc-label">Data da Consulta</span>
                    <span class="rc-valor">{{ $consulta->data }} - {{ $consulta->hora }}</span>

                </div>
                <div class="col rc-container">
                    <span class="rc-label">Tipo</span>
                    <span class="rc-valor">{{ $consulta->nome_tipo_consulta }}</span>

                </div>
            </div>

        </div>
        <div class="card mt-4">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fa-regular fa-clipboard"></i> Diagnóstico</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fa-solid fa-file-waveform"></i> Exames</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                        type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fa-solid fa-capsules"></i> Receita</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                    tabindex="0">...</div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                    tabindex="0">...</div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"
                    tabindex="0">...</div>
            </div>
            
        </div>
    </section>
@endsection
