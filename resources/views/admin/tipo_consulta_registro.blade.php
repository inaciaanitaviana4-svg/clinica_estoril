@extends('layouts.admin')
@section('titulo', 'Registro de tipo de consulta')
@section('conteudo')
    <section class="section active ">
        <div class="login-card" id="userTypeCard">
            <h2 style="text-align: center;"><strong>Registro de tipo de consulta</strong> </h2>
            <br><br>
            @if (session('erro'))
                <div style="background-color:red;color:white;text-align:center">
                    {{ session('erro') }}
                </div>
            @endif

            <form method="post"
                action="{{ route('salvar_registro_tipo_consulta_admin', $tipo_consulta->id_tipo_consulta ?? null) }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="nome">
                        Nome
                    </label>
                    <input req value="{{ $tipo_consulta->nome ?? '' }}" type="text" id="nome" name="nome" required
                        placeholder="digite o nome do tipo de consulta">
                </div>
                <div class="form-group">
                    <label for="icone">
                        Ícone
                    </label>
    <select req id="icone" name="icone" class="icon-select">

        <option value="">
            Selecione um ícone da área da saúde
        </option>

        <!-- MÉDICO / HOSPITAL -->
        <!-- ===================== ÍCONES BOOTSTRAP SAÚDE ===================== -->

<option value="bi-hospital">🏥 bi-hospital - Hospital</option>
<option value="bi-hospital-fill">🏥 bi-hospital-fill - Hospital preenchido</option>
<option value="bi-heart">❤️ bi-heart - Coração</option>
<option value="bi-heart-fill">❤️ bi-heart-fill - Coração preenchido</option>
<option value="bi-heart-pulse">💓 bi-heart-pulse - Batimentos cardíacos</option>
<option value="bi-heart-pulse-fill">💓 bi-heart-pulse-fill - Batimentos cardíacos preenchido</option>
<option value="bi-capsule">💊 bi-capsule - Cápsula</option>
<option value="bi-capsule-pill">💊 bi-capsule-pill - Cápsula e comprimido</option>
<option value="bi-prescription">📄 bi-prescription - Prescrição médica</option>
<option value="bi-prescription2">📄 bi-prescription2 - Receita médica</option>
<option value="bi-bandaid">🩹 bi-bandaid - Curativo</option>
<option value="bi-bandaid-fill">🩹 bi-bandaid-fill - Curativo preenchido</option>
<option value="bi-clipboard2-pulse">📋 bi-clipboard2-pulse - Monitoramento médico</option>
<option value="bi-clipboard2-pulse-fill">📋 bi-clipboard2-pulse-fill - Monitoramento preenchido</option>
<option value="bi-lungs">🫁 bi-lungs - Pulmões</option>
<option value="bi-lungs-fill">🫁 bi-lungs-fill - Pulmões preenchido</option>
<option value="bi-virus">🦠 bi-virus - Vírus</option>
<option value="bi-virus2">🦠 bi-virus2 - Vírus alternativo</option>
<option value="bi-shield-plus">🛡️ bi-shield-plus - Proteção médica</option>
<option value="bi-shield-fill-plus">🛡️ bi-shield-fill-plus - Proteção médica preenchida</option>
<option value="bi-activity">📈 bi-activity - Atividade médica</option>
<option value="bi-thermometer">🌡️ bi-thermometer - Termômetro</option>
<option value="bi-thermometer-half">🌡️ bi-thermometer-half - Temperatura média</option>
<option value="bi-eyedropper">👁️ bi-eyedropper - Conta-gotas</option>
<option value="bi-droplet">💧 bi-droplet - Gota</option>
<option value="bi-droplet-fill">💧 bi-droplet-fill - Gota preenchida</option>
<option value="bi-plus-circle">➕ bi-plus-circle - Adicionar</option>
<option value="bi-plus-circle-fill">➕ bi-plus-circle-fill - Adicionar preenchido</option>
<option value="bi-plus-square">➕ bi-plus-square - Cruz médica</option>
<option value="bi-plus-square-fill">➕ bi-plus-square-fill - Cruz médica preenchida</option>
<option value="bi-person-heart">🧑❤️ bi-person-heart - Cuidados pessoais</option>
<option value="bi-person-plus">🧑➕ bi-person-plus - Novo paciente</option>
<option value="bi-people">👥 bi-people - Pacientes</option>
<option value="bi-people-fill">👥 bi-people-fill - Pacientes preenchido</option>
<option value="bi-clipboard-check">✅ bi-clipboard-check - Consulta concluída</option>
<option value="bi-clipboard-check-fill">✅ bi-clipboard-check-fill - Consulta concluída preenchida</option>
<option value="bi-calendar2-check">📅 bi-calendar2-check - Consulta agendada</option>
<option value="bi-calendar2-heart">📅❤️ bi-calendar2-heart - Consulta médica</option>
<option value="bi-file-medical">📄 bi-file-medical - Documento médico</option>
<option value="bi-file-earmark-medical">📄 bi-file-earmark-medical - Ficha médica</option>
<option value="bi-file-earmark-medical-fill">📄 bi-file-earmark-medical-fill - Ficha médica preenchida</option>

<option value="bi-clipboard">📋 bi-clipboard - Área de transferência</option>
<option value="bi-clipboard-fill">📋 bi-clipboard-fill - Área preenchida</option>
<option value="bi-clipboard-data">📊 bi-clipboard-data - Dados clínicos</option>
<option value="bi-clipboard-data-fill">📊 bi-clipboard-data-fill - Dados clínicos preenchido</option>
<option value="bi-clipboard-heart">❤️ bi-clipboard-heart - Saúde cardíaca</option>
<option value="bi-clipboard-heart-fill">❤️ bi-clipboard-heart-fill - Saúde cardíaca preenchido</option>
<option value="bi-clipboard-minus">➖ bi-clipboard-minus - Remover consulta</option>
<option value="bi-clipboard-plus">➕ bi-clipboard-plus - Adicionar consulta</option>
<option value="bi-clipboard-x">❌ bi-clipboard-x - Consulta cancelada</option>
<option value="bi-file-earmark-plus">📄 bi-file-earmark-plus - Novo documento</option>
<option value="bi-file-earmark-check">📄 bi-file-earmark-check - Documento aprovado</option>
<option value="bi-file-earmark-x">📄 bi-file-earmark-x - Documento inválido</option>
<option value="bi-file-earmark-text">📄 bi-file-earmark-text - Relatório médico</option>
<option value="bi-file-earmark-bar-graph">📊 bi-file-earmark-bar-graph - Estatísticas médicas</option>
<option value="bi-file-medical-fill">📄 bi-file-medical-fill - Documento médico preenchido</option>

<option value="bi-person">🧑 bi-person - Pessoa</option>
<option value="bi-person-fill">🧑 bi-person-fill - Pessoa preenchido</option>
<option value="bi-person-check">✅ bi-person-check - Paciente confirmado</option>
<option value="bi-person-check-fill">✅ bi-person-check-fill - Paciente confirmado preenchido</option>
<option value="bi-person-dash">➖ bi-person-dash - Remover paciente</option>
<option value="bi-person-dash-fill">➖ bi-person-dash-fill - Remover paciente preenchido</option>
<option value="bi-person-x">❌ bi-person-x - Paciente bloqueado</option>
<option value="bi-person-x-fill">❌ bi-person-x-fill - Paciente bloqueado preenchido</option>
<option value="bi-person-lines-fill">👤 bi-person-lines-fill - Perfil médico</option>
<option value="bi-person-vcard">🪪 bi-person-vcard - Cartão de paciente</option>
<option value="bi-person-vcard-fill">🪪 bi-person-vcard-fill - Cartão preenchido</option>

<option value="bi-calendar">📅 bi-calendar - Calendário</option>
<option value="bi-calendar-fill">📅 bi-calendar-fill - Calendário preenchido</option>
<option value="bi-calendar-event">📅 bi-calendar-event - Evento médico</option>
<option value="bi-calendar-event-fill">📅 bi-calendar-event-fill - Evento preenchido</option>
<option value="bi-calendar-heart">❤️ bi-calendar-heart - Agenda médica</option>
<option value="bi-calendar-heart-fill">❤️ bi-calendar-heart-fill - Agenda médica preenchida</option>
<option value="bi-calendar-plus">➕ bi-calendar-plus - Nova consulta</option>
<option value="bi-calendar-minus">➖ bi-calendar-minus - Remover consulta</option>
<option value="bi-calendar-x">❌ bi-calendar-x - Consulta cancelada</option>
<option value="bi-calendar-week">📅 bi-calendar-week - Agenda semanal</option>

<option value="bi-alarm">⏰ bi-alarm - Alarme médico</option>
<option value="bi-alarm-fill">⏰ bi-alarm-fill - Alarme preenchido</option>
<option value="bi-stopwatch">⏱️ bi-stopwatch - Cronômetro clínico</option>
<option value="bi-stopwatch-fill">⏱️ bi-stopwatch-fill - Cronômetro preenchido</option>
<option value="bi-clock">🕒 bi-clock - Horário</option>
<option value="bi-clock-fill">🕒 bi-clock-fill - Horário preenchido</option>

<option value="bi-chat-heart">💬❤️ bi-chat-heart - Conversa médica</option>
<option value="bi-chat-heart-fill">💬❤️ bi-chat-heart-fill - Conversa preenchida</option>
<option value="bi-chat-left-heart">💬❤️ bi-chat-left-heart - Atendimento</option>
<option value="bi-chat-left-heart-fill">💬❤️ bi-chat-left-heart-fill - Atendimento preenchido</option>

<option value="bi-emoji-smile">😊 bi-emoji-smile - Bem-estar</option>
<option value="bi-emoji-frown">☹️ bi-emoji-frown - Dor</option>
<option value="bi-emoji-neutral">😐 bi-emoji-neutral - Estado neutro</option>
<option value="bi-emoji-dizzy">😵 bi-emoji-dizzy - Tontura</option>
<option value="bi-emoji-expressionless">😶 bi-emoji-expressionless - Sem expressão</option>

<option value="bi-lightbulb">💡 bi-lightbulb - Ideia clínica</option>
<option value="bi-lightbulb-fill">💡 bi-lightbulb-fill - Ideia clínica preenchida</option>

<option value="bi-search">🔍 bi-search - Procurar paciente</option>
<option value="bi-search-heart">🔍❤️ bi-search-heart - Pesquisa médica</option>

<option value="bi-gear">⚙️ bi-gear - Configurações médicas</option>
<option value="bi-gear-fill">⚙️ bi-gear-fill - Configurações preenchidas</option>

<option value="bi-award">🏆 bi-award - Certificação médica</option>
<option value="bi-award-fill">🏆 bi-award-fill - Certificação preenchida</option>

<option value="bi-book">📘 bi-book - Manual médico</option>
<option value="bi-book-fill">📘 bi-book-fill - Manual preenchido</option>
<option value="bi-book-half">📘 bi-book-half - Livro clínico</option>

<option value="bi-journal-medical">📖 bi-journal-medical - Jornal médico</option>
<option value="bi-journal-check">📖 bi-journal-check - Relatório aprovado</option>
<option value="bi-journal-plus">📖 bi-journal-plus - Novo relatório</option>

<option value="bi-box2-heart">❤️ bi-box2-heart - Kit médico</option>
<option value="bi-box2-heart-fill">❤️ bi-box2-heart-fill - Kit médico preenchido</option>

<option value="bi-bag-plus">👜➕ bi-bag-plus - Bolsa médica</option>
<option value="bi-bag-plus-fill">👜➕ bi-bag-plus-fill - Bolsa médica preenchida</option>

<option value="bi-battery-half">🔋 bi-battery-half - Equipamento médico</option>
<option value="bi-battery-full">🔋 bi-battery-full - Equipamento carregado</option>

<option value="bi-bluetooth">📶 bi-bluetooth - Equipamento bluetooth</option>
<option value="bi-broadcast">📡 bi-broadcast - Monitoramento remoto</option>

<option value="bi-camera-video">📹 bi-camera-video - Telemedicina</option>
<option value="bi-camera-video-fill">📹 bi-camera-video-fill - Telemedicina preenchida</option>

<option value="bi-cpu">🖥️ bi-cpu - Equipamento hospitalar</option>
<option value="bi-database">🗄️ bi-database - Base de pacientes</option>
<option value="bi-database-fill">🗄️ bi-database-fill - Base preenchida</option>

<option value="bi-envelope-heart">✉️❤️ bi-envelope-heart - Mensagem médica</option>
<option value="bi-envelope-heart-fill">✉️❤️ bi-envelope-heart-fill - Mensagem preenchida</option>

<option value="bi-exclamation-circle">⚠️ bi-exclamation-circle - Emergência</option>
<option value="bi-exclamation-circle-fill">⚠️ bi-exclamation-circle-fill - Emergência preenchida</option>

<option value="bi-eye">👁️ bi-eye - Oftalmologia</option>
<option value="bi-eye-fill">👁️ bi-eye-fill - Oftalmologia preenchida</option>
<option value="bi-eye-slash">🙈 bi-eye-slash - Visão bloqueada</option>

<option value="bi-fingerprint">🖐️ bi-fingerprint - Identificação biométrica</option>

<option value="bi-flag">🚩 bi-flag - Alerta médico</option>
<option value="bi-flag-fill">🚩 bi-flag-fill - Alerta preenchido</option>

<option value="bi-globe">🌍 bi-globe - Saúde global</option>

<option value="bi-hand-thumbs-up">👍 bi-hand-thumbs-up - Aprovação médica</option>
<option value="bi-hand-thumbs-up-fill">👍 bi-hand-thumbs-up-fill - Aprovação preenchida</option>

<option value="bi-hand-thumbs-down">👎 bi-hand-thumbs-down - Reprovação médica</option>
<option value="bi-hand-thumbs-down-fill">👎 bi-hand-thumbs-down-fill - Reprovação preenchida</option>

<option value="bi-headphones">🎧 bi-headphones - Atendimento online</option>

<option value="bi-image">🖼️ bi-image - Exame por imagem</option>
<option value="bi-images">🖼️ bi-images - Galeria de exames</option>

<option value="bi-info-circle">ℹ️ bi-info-circle - Informação médica</option>
<option value="bi-info-circle-fill">ℹ️ bi-info-circle-fill - Informação preenchida</option>

<option value="bi-life-preserver">🛟 bi-life-preserver - Suporte de vida</option>

<option value="bi-lock">🔒 bi-lock - Dados protegidos</option>
<option value="bi-lock-fill">🔒 bi-lock-fill - Proteção preenchida</option>

<option value="bi-megaphone">📢 bi-megaphone - Aviso hospitalar</option>
<option value="bi-megaphone-fill">📢 bi-megaphone-fill - Aviso preenchido</option>

<option value="bi-mic">🎤 bi-mic - Atendimento por voz</option>
<option value="bi-mic-fill">🎤 bi-mic-fill - Atendimento preenchido</option>

<option value="bi-moon-stars">🌙 bi-moon-stars - Sono saudável</option>
<option value="bi-moon-stars-fill">🌙 bi-moon-stars-fill - Sono preenchido</option>

<option value="bi-nut">🥜 bi-nut - Nutrição</option>
<option value="bi-nut-fill">🥜 bi-nut-fill - Nutrição preenchida</option>

<option value="bi-patch-check">✅ bi-patch-check - Verificado</option>
<option value="bi-patch-check-fill">✅ bi-patch-check-fill - Verificado preenchido</option>

<option value="bi-patch-exclamation">⚠️ bi-patch-exclamation - Alerta clínico</option>
<option value="bi-patch-exclamation-fill">⚠️ bi-patch-exclamation-fill - Alerta preenchido</option>

<option value="bi-patch-plus">➕ bi-patch-plus - Novo procedimento</option>
<option value="bi-patch-plus-fill">➕ bi-patch-plus-fill - Procedimento preenchido</option>

<option value="bi-shield-check">🛡️ bi-shield-check - Segurança hospitalar</option>
<option value="bi-shield-check-fill">🛡️ bi-shield-check-fill - Segurança preenchida</option>

<option value="bi-suit-heart">❤️ bi-suit-heart - Saúde cardíaca</option>
<option value="bi-suit-heart-fill">❤️ bi-suit-heart-fill - Saúde cardíaca preenchida</option>

<option value="bi-tablet">📱 bi-tablet - Tablet clínico</option>
<option value="bi-tablet-fill">📱 bi-tablet-fill - Tablet preenchido</option>

<option value="bi-trash">🗑️ bi-trash - Remover registro</option>
<option value="bi-trash-fill">🗑️ bi-trash-fill - Remover preenchido</option>

<option value="bi-unlock">🔓 bi-unlock - Acesso médico</option>
<option value="bi-unlock-fill">🔓 bi-unlock-fill - Acesso preenchido</option>

<option value="bi-wallet2">👛 bi-wallet2 - Pagamento consulta</option>
<option value="bi-wifi">📶 bi-wifi - Monitoramento online</option>

    </select>
    <br><br>
<label for="descricao">Pré-visualização do ícone</label>
    <div id="preview-icone" style="
    margin-top: 12px;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 18px;
">
    <i class="bi bi-heart-pulse"></i>
    <span>Pré-visualização do ícone</span>
</div>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao" rows="5" placeholder="Detalhes do tipo de consulta">{{ $tipo_consulta->descricao ?? '' }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-full">
                    Guardar
                </button>
                <a href="{{ route('mostrar_cadastros_admin') }}" class="btn btn-danger btn-full "
                    style="margin-top: 8px;">Cancelar </a>



            </form>
        </div>
    </section>

@endsection
@section('script')
    <script src="/tabs.js"></script>
    <script>

const selectIcone = document.getElementById('icone');
const previewIcone = document.getElementById('preview-icone');

selectIcone.addEventListener('change', function() {

    const valor = this.value;

    if (!valor) return;

    previewIcone.innerHTML = `
        <i class="bi ${valor}" style="font-size: 24px;"></i>
       
    `;
});

</script>
@endsection