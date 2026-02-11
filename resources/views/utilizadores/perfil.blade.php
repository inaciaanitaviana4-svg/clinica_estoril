
@extends(Session::get('tipo_utilizador')=="admi"?"layouts.admin":"layouts.painel")
@section("titulo", "Perfil")
@section("conteudo")
	<section class="section active {{ Session::get('tipo_utilizador')=="admi"?"":"painel" }}">
		<div class="perfil-container">
			<!-- Header com foto e botão editar -->
			<div class="perfil-header">
				<div class="perfil-header-info">
					<div class="perfil-header-text">
						<h1 class="perfil-nome">{{ $utilizador->nome }}</h1>
						@if($dados["medico"])
							<p class="perfil-cargo">{{ $dados["medico"]->especialidade }}|
								{{ $dados["medico"]->anos_experiência }} anos de experiência</p>
						@endif
					</div>
				</div>
				<a href="/editar-perfil" class="perfil-btn-edit">Editar Perfil</a>
			</div>

			<!-- Conteúdo do perfil -->
			<div class="perfil-content">
				<!-- Informações Pessoais -->
				<div class="perfil-section">
					<h2 class="perfil-section-title">
						<span class="perfil-section-icon"></span>
						Informações Pessoais
					</h2>
					<div class="perfil-grid">
						<div class="perfil-field">
							<label class="perfil-field-label">Nome Completo</label>
							<div class="perfil-field-value">{{$utilizador->nome}}</div>
						</div>
						@if($utilizador->genero)
							<div class="perfil-field">
								<label class="perfil-field-label">Gênero</label>
								<div class="perfil-field-value">{{$utilizador->genero}}</div>
							</div>
						@endif
						@if($dados["paciente"])
							<div class="perfil-field">
								<label class="perfil-field-label">Data de Nascimento</label>
								<div class="perfil-field-value">{{$dados["paciente"]->data_nascimento}}</div>
							</div>
							<div class="perfil-field">
								<label class="perfil-field-label">Estado Civil</label>
								<div class="perfil-field-value">{{$dados["paciente"]->estado_civil}}</div>
							</div>
							<div class="perfil-field">
								<label class="perfil-field-label">Número do BI</label>
								<div class="perfil-field-value perfil-field-value--highlight">{{$dados["paciente"]->num_bi}}
								</div>
							</div>
						@endif
					</div>
				</div>

				<!-- Informações de Contato -->
				<div class="perfil-section">
					<h2 class="perfil-section-title">
						<span class="perfil-section-icon"></span>
						Contato
					</h2>
					<div class="perfil-grid">
						<div class="perfil-field">
							<label class="perfil-field-label">Email</label>
							<div class="perfil-field-value">{{$utilizador->email}}</div>
						</div>
						<div class="perfil-field">
							<label class="perfil-field-label">Número de Telefone</label>
							<div class="perfil-field-value">{{$utilizador->num_telefone}}</div>
						</div>
					</div>
				</div>

				<!-- Endereço -->
				<div class="perfil-section">
					<h2 class="perfil-section-title">
						<span class="perfil-section-icon"></span>
						Endereço
					</h2>
					<div class="perfil-grid">
						<div class="perfil-field">
							<label class="perfil-field-label">Morada</label>
							<div class="perfil-field-value">{{$dados["paciente"]->morada??$dados["admin"]->morada??$dados["recepcionista"]->morada??$dados["medico"]->morada}}</div>
						</div>
						@if($dados["paciente"])
							<div class="perfil-field">
								<label class="perfil-field-label">Cidade</label>
								<div class="perfil-field-value">{{$dados["paciente"]->cidade}}</div>
							</div>
							<div class="perfil-field">
								<label class="perfil-field-label">Bairro</label>
								<div class="perfil-field-value">{{$dados["paciente"]->bairro}}</div>
							</div>
							<div class="perfil-field">
								<label class="perfil-field-label">Seguro</label>
								<div class="perfil-field-value">{{$dados["paciente"]->seguro}}</div>
							</div>
						@endif
					</div>
				</div>
				@if(!$dados["paciente"])
					<!-- Informações Profissionais -->
					<div class="perfil-section">
						<h2 class="perfil-section-title">
							<span class="perfil-section-icon"></span>
							Informações Profissionais
						</h2>
						<div class="perfil-grid">
							@if($dados["medico"])
								<div class="perfil-field">
									<label class="perfil-field-label">Especialidade</label>
									<div class="perfil-field-value">{{$dados["medico"]->especialidade}}</div>
								</div>
								<div class="perfil-field">
									<label class="perfil-field-label">Anos de Experiência</label>
									<div class="perfil-field-value">{{$dados["medico"]->ano_experiencia}} anos</div>
								</div>
							@endif
							<!--<div class="perfil-field">
						<label class="perfil-field-label">Nível de Acesso</label>
						<div class="perfil-field-value">
							<span class="perfil-badge perfil-badge--admin">Administrador</span>
						</div>
					</div>-->
						</div>
					</div>
				@endif
			</div>
		</div>
	</section>

@endsection