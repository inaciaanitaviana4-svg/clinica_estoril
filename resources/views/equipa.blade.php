
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
                    Nossa equipa é composta por mais de 50 médicos especialistas,<br>
                    profissionais de enfermagem e técnicos dedicados ao seu bem-estar
                </p>
            </div>
        </div>
    </section>

    <!-- EQUIPA MÉDICA -->
    <section class="team-section">
        <div class="container">
            <div class="team-grid">
                <!-- INSTRUÇÃO: Substitua as imagens dos médicos -->
                
                <!-- Médico 1 -->
                <div class="team-card">
                    <div class="team-photo">
                        <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&h=400&fit=crop" alt="Dr. João Silva">
                        <div class="team-overlay">
                            <div class="team-social">
                                <a href="#" aria-label="Email"><i class="fas fa-envelope"></i></a>
                                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="team-info">
                        <h3>Dr. João Silva</h3>
                        <p class="team-specialty">Cardiologia</p>
                        <p class="team-description">
                            Especialista em Cardiologia com mais de 15 anos de experiência. 
                            Doutorado pela Universidade de Lisboa.
                        </p>
                        <a href="login.html" class="team-btn">Agendar Consulta</a>
                    </div>
                </div>

                <!-- Médico 2 -->
                <div class="team-card">
                    <div class="team-photo">
                        <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop" alt="Dra. Maria Santos">
                        <div class="team-overlay">
                            <div class="team-social">
                                <a href="#" aria-label="Email"><i class="fas fa-envelope"></i></a>
                                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="team-info">
                        <h3>Dra. Maria Santos</h3>
                        <p class="team-specialty">Pediatria</p>
                        <p class="team-description">
                            Pediatra com formação internacional. Especializada em 
                            neonatologia e cuidados pediátricos gerais.
                        </p>
                        <a href="Consulta.html" class="team-btn">Agendar Consulta</a>
                    </div>
                </div>

                <!-- Médico 3 -->
                <div class="team-card">
                    <div class="team-photo">
                        <img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=400&h=400&fit=crop" alt="Dr. Pedro Costa">
                        <div class="team-overlay">
                            <div class="team-social">
                                <a href="#" aria-label="Email"><i class="fas fa-envelope"></i></a>
                                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="team-info">
                        <h3>Dr. Pedro Costa</h3>
                        <p class="team-specialty">Ortopedia</p>
                        <p class="team-description">
                            Cirurgião ortopédico especializado em cirurgias do joelho 
                            e ombro. Mestrado em Medicina Desportiva.
                        </p>
                        <a href="Consulta.html" class="team-btn">Agendar Consulta</a>
                    </div>
                </div>

                <!-- Médico 4 -->
                <div class="team-card">
                    <div class="team-photo">
                        <img src="https://images.unsplash.com/photo-1594824476967-48c8b964273f?w=400&h=400&fit=crop" alt="Dra. Ana Ferreira">
                        <div class="team-overlay">
                            <div class="team-social">
                                <a href="#" aria-label="Email"><i class="fas fa-envelope"></i></a>
                                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="team-info">
                        <h3>Dra. Ana Ferreira</h3>
                        <p class="team-specialty">Ginecologia</p>
                        <p class="team-description">
                            Ginecologista e obstetra com vasta experiência em 
                            gestações de alto risco e cirurgias ginecológicas.
                        </p>
                        <a href="Consulta.html" class="team-btn">Agendar Consulta</a>
                    </div>
                </div>

                <!-- Médico 5 -->
                <div class="team-card">
                    <div class="team-photo">
                        <img src="https://images.unsplash.com/photo-1537368910025-700350fe46c7?w=400&h=400&fit=crop" alt="Dr. Ricardo Alves">
                        <div class="team-overlay">
                            <div class="team-social">
                                <a href="#" aria-label="Email"><i class="fas fa-envelope"></i></a>
                                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="team-info">
                        <h3>Dr. Ricardo Alves</h3>
                        <p class="team-specialty">Neurologia</p>
                        <p class="team-description">
                            Neurologista especializado em doenças neurodegenerativas 
                            e distúrbios do movimento.
                        </p>
                        <a href="Consulta.html" class="team-btn">Agendar Consulta</a>
                    </div>
                </div>

                <!-- Médico 6 -->
                <div class="team-card">
                    <div class="team-photo">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&h=400&fit=crop" alt="Dra. Sofia Oliveira">
                        <div class="team-overlay">
                            <div class="team-social">
                                <a href="#" aria-label="Email"><i class="fas fa-envelope"></i></a>
                                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="team-info">
                        <h3>Dra. Sofia Oliveira</h3>
                        <p class="team-specialty">Dermatologia</p>
                        <p class="team-description">
                            Dermatologista com especialização em dermatologia 
                            estética e tratamento de doenças de pele.
                        </p>
                        <a href="Consulta.html" class="team-btn">Agendar Consulta</a>
                    </div>
                </div>

                <!-- Médico 7 -->
                <div class="team-card">
                    <div class="team-photo">
                        <img src="https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=400&h=400&fit=crop" alt="Dr. Miguel Rodrigues">
                        <div class="team-overlay">
                            <div class="team-social">
                                <a href="#" aria-label="Email"><i class="fas fa-envelope"></i></a>
                                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="team-info">
                        <h3>Dr. Miguel Rodrigues</h3>
                        <p class="team-specialty">Oftalmologia</p>
                        <p class="team-description">
                            Oftalmologista especializado em cirurgias refrativas 
                            e tratamento de catarata.
                        </p>
                        <a href="/Consulta" class="team-btn">Agendar Consulta</a>
                    </div>
                </div>

                <!-- Médico 8 -->
                <div class="team-card">
                    <div class="team-photo">
                        <img src="https://images.unsplash.com/photo-1551601651-09e1b49d12ae?w=400&h=400&fit=crop" alt="Dra. Carla Mendes">
                        <div class="team-overlay">
                            <div class="team-social">
                                <a href="#" aria-label="Email"><i class="fas fa-envelope"></i></a>
                                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="team-info">
                        <h3>Dra. Carla Mendes</h3>
                        <p class="team-specialty">Endocrinologia</p>
                        <p class="team-description">
                            Endocrinologista com foco em diabetes, tireoide e 
                            distúrbios hormonais complexos.
                        </p>
                        <a href="/Consulta" class="team-btn">Agendar Consulta</a>
                    </div>
                </div>

                <!-- Médico 9 -->
                <div class="team-card">
                    <div class="team-photo">
                        <img src="https://images.unsplash.com/photo-1651008376811-b90baee60c1f?w=400&h=400&fit=crop" alt="Dr. Tiago Pereira">
                        <div class="team-overlay">
                            <div class="team-social">
                                <a href="#" aria-label="Email"><i class="fas fa-envelope"></i></a>
                                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="team-info">
                        <h3>Dr. Tiago Pereira</h3>
                        <p class="team-specialty">Gastroenterologia</p>
                        <p class="team-description">
                            Gastroenterologista especializado em endoscopia 
                            digestiva e doenças inflamatórias intestinais.
                        </p>
                        <a href="Consulta.html" class="team-btn">Agendar Consulta</a>
                    </div>
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
                    <a href="Consulta.html" class="btn btn-white">
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


  