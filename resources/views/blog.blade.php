@extends("layouts.site")
@section("titulo", "Blog Educativo sobre Saúde")
@section("estilo")
    <style>
        /*
            body {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
                line-height: 1.6;
                color: #333;
                background: linear-gradient(to bottom right, #eff6ff, #ffffff, #eff6ff);
                min-height: 100vh;
            }
            */
        /* Header */
        /*
            .header {
                background: linear-gradient(to right, #2563eb, #1e40af);
                position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background: var(--bg-white);
        box-shadow: var(--shadow-sm);
        z-index: 1000;
        transition: var(--transition);

            }
            .nav-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: var(--spacing-sm) 0;
    }

            .header-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 1rem;
                display: flex;
                align-items: center;
                gap: 1rem;

            }

            .header-icon {
                background: white;
                padding: 0.5rem;
                border-radius: 50%;
                width: 50px;
                height: 1000px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .header-icon svg {
                width: 32px;
                height: 32px;
                fill: #2563eb;
            }

            .header-title h1 {
                font-size: 1.875rem;
                margin-bottom: 0.25rem;
            }

            .header-title p {
                font-size: 0.875rem;
                color: #bfdbfe;
            }
          */
        /* Hero */
        /*
            .hero {
                background: linear-gradient(135deg, rgba(0, 102, 204, 0.95) 0%, rgba(0, 73, 153, 0.95) 100%);
                color: white;
                padding: 4rem 0;
                position: relative;

            }

            .hero-container {
                width: 2000px;
                margin: 0 auto;
                padding: 0 1rem;
            }

            .hero-title {
                text-align: center;
                margin-bottom: 3rem;

            }

            .hero-title h2 {
                font-size: 2.5rem;
                margin-bottom: 1rem;
                position: relative;
                top: 55px;
            }

            .hero-title p {
                font-size: 1.125rem;
                color: #bfdbfe;
                max-width: 2000px;
                margin: 0 auto;
                position: relative;
                top: 45px;
            }

            .hero-features {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 1.5rem;
            }

            .hero-feature {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                padding: 1.5rem;
                border-radius: 0.5rem;
                text-align: center;
                transition: all 0.3s;
            }

            .hero-feature:hover {
                background: rgba(255, 255, 255, 0.2);
            }

            .hero-feature-icon {
                background: rgba(255, 255, 255, 0.2);
                width: 64px;
                height: 64px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1rem;
            }

            .hero-feature h3 {
                margin-bottom: 0.5rem;
                font-size: 1.25rem;
            }

            .hero-feature p {
                font-size: 0.875rem;
                color: #bfdbfe;
            }
              **/
        /* Main Content */
        /*
            .main-content {
                max-width: 1200px;
                margin: 0 auto;
                padding: 3rem 1rem;
            }
                  */
        /* Category Filter */

        .category-filter {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .category-btn {
            padding: 0.5rem 1.5rem;
            border-radius: 9999px;
            border: 2px solid #2563eb;
            background: white;
            color: #2563eb;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 1rem;
            font-weight: 500;
        }

        .category-btn:hover {
            background: #eff6ff;
        }

        .category-btn.active {
            background: #2563eb;
            color: white;
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.3);
        }


        .articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
        }

        .article-card {
            background: white;
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.3s;
        }

        .article-card:hover {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        .article-image {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .article-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .article-card:hover .article-image img {
            transform: scale(1.05);
        }

        .article-category {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: #2563eb;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
        }

        .article-content {
            padding: 1.5rem;
        }

        .article-content h3 {
            margin-bottom: 0.75rem;
            font-size: 1.25rem;
            color: #1f2937;
        }

        .article-excerpt {
            color: #6b7280;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .read-more {
            color: #2563eb;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }


        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 1000;
            padding: 1rem;
            overflow-y: auto;
        }

        .modal-overlay.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: 0.75rem;
            max-width: 900px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
        }

        .modal-header-image {
            position: relative;
            height: 320px;
        }

        .modal-header-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            padding: 0.5rem;
            border-radius: 50%;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s;
        }

        .modal-close:hover {
            background: white;
        }

        .modal-category {
            position: absolute;
            bottom: 1rem;
            left: 1rem;
            background: #2563eb;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
        }

        .modal-body {
            padding: 2rem;
        }

        .modal-body h1 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: #1f2937;
        }

        .modal-article-content h2 {
            color: #1e40af;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #dbeafe;
            font-size: 1.5rem;
        }

        .modal-article-content h3 {
            color: #2563eb;
            margin-top: 1.25rem;
            margin-bottom: 0.75rem;
            font-size: 1.25rem;
        }

        .modal-article-content p {
            margin-bottom: 1rem;
            line-height: 1.7;
            color: #374151;
        }

        .modal-article-content ul {
            margin-bottom: 1rem;
            padding-left: 1.5rem;
        }

        .modal-article-content li {
            margin-bottom: 0.5rem;
            line-height: 1.6;
            color: #4b5563;
        }

        .modal-article-content strong {
            color: #1f2937;
            font-weight: 600;
        }

        .modal-footer {
            border-top: 1px solid #e5e7eb;
            padding: 1.5rem;
            background: #eff6ff;
            text-align: center;
            color: #4b5563;
        }

        .modal-footer strong {
            color: #1f2937;
        }

        * Footer */
        /*
            .alert-text {
                color: #f87171;
            }
             */
        /* Responsive */
        /*
            @media (max-width: 768px) {
                .hero-title h2 {
                    font-size: 1.875rem;
                }

                .header-title h1 {
                    font-size: 1.5rem;
                }

                .modal-body h1 {
                    font-size: 1.5rem;
                }
            }


            .icon {
                width: 24px;
                height: 24px;
            }
            .nav-menu {
        display: flex;
        gap:1rem;
    }

    .nav-link {
        font-weight: 500;
        color: var(--text-dark);
        padding: 8px 16px;
        border-radius: 8px;
        transition: var(--transition);
    }

    .nav-link:hover,
    .nav-link.active {
        color: var(--primary-color);
        background: rgba(0, 102, 204, 0.1);
    } 
        */
    </style>
    </head>

    <body>
        <!-- Header -->
        <header class="header">
            <div class="container">
                <div class="nav-wrapper">
                    <!-- Logo -->
                    <div class="logo">
                        <img src="imagem/logo.jpg" alt="logotipo da clinica">
                        <span>Clínica Estoril</span>
                    </div>

                    <!-- Navegação Desktop -->
                    <nav class="nav-menu">
                        <a href="/" class="nav-link">Início</a>
                        <a href="/sobre" class="nav-link ">Sobre</a>
                        <a href="/servicos" class="nav-link">Serviços</a>
                        <a href="/especialidades" class="nav-link">Especialidades</a>
                        <a href="/equipa" class="nav-link">Equipa</a>
                        <a href="/contacto" class="nav-link">Contacto</a>
                        <a href="/blog" class="nav-link active">Blog</a>
                        <a href="/chatbot" class="nav-link">Chat Bot</a>
                    </nav>
                    <!-- Botão de Login -->
                    <a href="/login" class="btn-login">
                        <i class="fas fa-user"></i>
                        <span>Entrar</span>
                    </a>

                    <!-- Menu Mobile Toggle -->
                    <button class="mobile-menu-toggle" aria-label="Menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>

            </div>
            <!-- Menu Mobile -->
            <div class="mobile-menu">
                <a href="/" class="mobile-link">Início</a>
                <a href="/sobre" class="mobile-link">Sobre</a>
                <a href="/servicos" class="mobile-link">Serviços</a>
                <a href="/especialidades" class="mobile-link">Especialidades</a>
                <a href="/equipa" class="mobile-link">Equipa</a>
                <a href="/contacto" class="mobile-link">Contacto</a>
                <a href="/blog" class="mobile-link active">Blog</a>
                <a href="/chatbot" class="mobile-link">Chat Bot</a>
                <a href="/login" class="mobile-link mobile-login">
                    <i class="fas fa-user"></i> Acesso
                </a>
            </div>
        </header>

        <!-- Hero -->
        <section class="hero">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <div class="container">
                    <div class="hero-text">
                        <h1>
                            <marquee>Transforme a sua Saúde com Conhecimento</marquee>
                        </h1>
                        <p class="hero-subtitle">Conteúdos educativos baseados em evidências científicas para ajudar você e
                            sua comunidade a viver com mais saúde e qualidade de vida</p>
                    </div>
                    <section class="contact-info-section">
                        <div class="container">
                            <div class="contact-info-grid">
                                <div class="contact-info-card">
                                    <div class="contact-info-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                        </svg>
                                    </div>
                                    <h3>Prevenção</h3>
                                    <p>Aprenda a prevenir doenças e proteger sua família</p>
                                </div>


                                <div class="contact-info-card">
                                    <div class="contact-info-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M16 8l-8 8M16 16H8"></path>
                                        </svg>
                                    </div>
                                    <h3>Nutrição</h3>
                                    <p>Descubra os alimentos que fortalecem seu corpo</p>
                                </div>

                                <div class="contact-info-card">
                                    <div class="contact-info-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                        </svg>
                                    </div>
                                    <h3>Exercícios</h3>
                                    <p>Movimento é vida - saiba como se manter ativo</p>
                                </div>

                                <div class="contact-info-card">
                                    <div class="contact-info-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                                            <line x1="9" y1="9" x2="9.01" y2="9"></line>
                                            <line x1="15" y1="9" x2="15.01" y2="9"></line>
                                        </svg>
                                    </div>
                                    <h3>Bem-estar</h3>
                                    <p>Cuide da sua saúde física e mental</p>
                                </div>
                            </div>
                        </div>
                    </section>


                    <!-- Main Content -->
                    <main class="main-content">
                        <!-- Category Filter -->
                        <div class="category-filter" id="categoryFilter"></div>

                        <!-- Articles Grid -->
                        <div class="articles-grid" id="articlesGrid"></div>
                    </main>

                    <!-- Modal -->
                    <div class="modal-overlay" id="modal">
                        <div class="modal-content" id="modalContent">
                            <!-- Modal content will be inserted here -->
                        </div>
                    </div>

                    <script>
                        // Articles Data
                        const articles = [
                            {
                                id: 1,
                                title: "Higiene Pessoal: Hábitos que Transformam sua Saúde",
                                excerpt: "Descubra como práticas simples de higiene podem prevenir doenças e melhorar significativamente sua qualidade de vida.",
                                category: "Higiene",
                                image: "https://images.unsplash.com/photo-1628235172251-6b87dab144b3?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxoYW5kJTIwd2FzaGluZyUyMGh5Z2llbmV8ZW58MXx8fHwxNzY2MTc1MjEyfDA&ixlib=rb-4.1.0&q=80&w=1080",
                                content: `
                        <h2>Por que a Higiene Pessoal é Fundamental?</h2>
                        <p>A higiene pessoal vai muito além da aparência. Ela é uma barreira essencial contra infecções, doenças e problemas de saúde. Práticas adequadas de higiene podem prevenir desde resfriados comuns até infecções mais graves.</p>

                        <h3>Lavagem das Mãos: Sua Primeira Linha de Defesa</h3>
                        <p>As mãos são os principais veículos de transmissão de micro-organismos. Lave suas mãos:</p>
                        <ul>
                            <li>Antes de preparar ou consumir alimentos</li>
                            <li>Após usar o banheiro</li>
                            <li>Ao chegar em casa</li>
                            <li>Antes e após cuidar de feridas</li>
                            <li>Após tossir, espirrar ou assoar o nariz</li>
                        </ul>
                        <p><strong>Técnica correta:</strong> Use água e sabão, esfregando por pelo menos 20 segundos, incluindo palmas, dorso das mãos, entre os dedos e unhas.</p>

                        <h3>Banho Diário</h3>
                        <p>O banho remove células mortas, bactérias e impurezas acumuladas ao longo do dia. Recomenda-se:</p>
                        <ul>
                            <li>Pelo menos um banho por dia</li>
                            <li>Usar sabonete neutro ou específico para seu tipo de pele</li>
                            <li>Secar bem todo o corpo, especialmente entre os dedos e dobras da pele</li>
                            <li>Trocar de toalha regularmente (2-3 vezes por semana)</li>
                        </ul>

                        <h3>Cuidados com Roupas e Calçados</h3>
                        <p>Roupas e calçados limpos previnem problemas de pele e infecções:</p>
                        <ul>
                            <li>Troque de roupa íntima diariamente</li>
                            <li>Lave roupas regularmente, separando por tipo e cor</li>
                            <li>Use calçados adequados e respire os pés</li>
                            <li>Alterne o uso de calçados para permitir ventilação</li>
                        </ul>

                        <h3>Impacto na Saúde Comunitária</h3>
                        <p>Quando todos praticam boa higiene, toda a comunidade se beneficia com:</p>
                        <ul>
                            <li>Redução de surtos de doenças infecciosas</li>
                            <li>Menor absenteísmo escolar e laboral</li>
                            <li>Diminuição de gastos com saúde</li>
                            <li>Melhoria da qualidade de vida geral</li>
                        </ul>
                    `
                            },
                            {
                                id: 2,
                                title: "Alimentação Saudável: O Combustível do seu Corpo",
                                excerpt: "Aprenda quais alimentos fortalecem seu sistema imunológico e promovem uma vida mais longa e saudável.",
                                category: "Nutrição",
                                image: "https://images.unsplash.com/photo-1712873069353-87c44687d345?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxoZWFsdGh5JTIwZm9vZCUyMHZlZ2V0YWJsZXN8ZW58MXx8fHwxNzY2MTMyNDgzfDA&ixlib=rb-4.1.0&q=80&w=1080",
                                content: `
                        <h2>A Base de uma Alimentação Equilibrada</h2>
                        <p>Uma alimentação saudável não é sobre restrições severas, mas sim sobre escolhas inteligentes que nutrem seu corpo e mente.</p>

                        <h3>Os Grupos Alimentares Essenciais</h3>
                        <p><strong>1. Frutas e Vegetais</strong></p>
                        <p>Consuma pelo menos 5 porções por dia. Eles são ricos em vitaminas, minerais, fibras e antioxidantes.</p>
                        <ul>
                            <li>Vegetais verde-escuros: espinafre, brócolis, couve</li>
                            <li>Frutas cítricas: laranja, limão, acerola</li>
                            <li>Vegetais coloridos: cenoura, tomate, pimentão</li>
                            <li>Frutas variadas: banana, maçã, mamão, melancia</li>
                        </ul>

                        <p><strong>2. Cereais Integrais</strong></p>
                        <p>Preferir grãos integrais em vez de refinados:</p>
                        <ul>
                            <li>Arroz integral</li>
                            <li>Aveia</li>
                            <li>Quinoa</li>
                            <li>Pão integral</li>
                            <li>Massas integrais</li>
                        </ul>

                        <p><strong>3. Proteínas Magras</strong></p>
                        <ul>
                            <li>Peixes (sardinha, salmão, atum)</li>
                            <li>Frango sem pele</li>
                            <li>Ovos</li>
                            <li>Leguminosas (feijão, lentilha, grão-de-bico)</li>
                            <li>Tofu e tempeh</li>
                        </ul>

                        <h3>Alimentos para Fortalecer a Imunidade</h3>
                        <ul>
                            <li><strong>Alho e cebola:</strong> propriedades antibacterianas e antivirais</li>
                            <li><strong>Gengibre:</strong> anti-inflamatório natural</li>
                            <li><strong>Frutas cítricas:</strong> ricas em vitamina C</li>
                            <li><strong>Castanhas e amêndoas:</strong> fonte de vitamina E e selênio</li>
                            <li><strong>Iogurte natural:</strong> probióticos para saúde intestinal</li>
                        </ul>

                        <h3>O que Evitar ou Reduzir</h3>
                        <ul>
                            <li>Açúcar refinado e doces em excesso</li>
                            <li>Alimentos ultraprocessados</li>
                            <li>Refrigerantes e bebidas açucaradas</li>
                            <li>Excesso de sal</li>
                            <li>Gorduras trans e saturadas</li>
                            <li>Frituras</li>
                        </ul>

                        <h3>Hidratação: Não Esqueça a Água!</h3>
                        <p>Beba pelo menos 2 litros de água por dia. A água é essencial para:</p>
                        <ul>
                            <li>Regular a temperatura corporal</li>
                            <li>Transportar nutrientes</li>
                            <li>Eliminar toxinas</li>
                            <li>Manter a pele saudável</li>
                            <li>Garantir o funcionamento adequado dos órgãos</li>
                        </ul>
                    `
                            },
                            {
                                id: 3,
                                title: "Saúde Bucal: Seu Sorriso Reflete sua Saúde",
                                excerpt: "A higiene bucal adequada previne não apenas cáries, mas também doenças cardíacas e outras condições sérias.",
                                category: "Higiene Bucal",
                                image: "https://images.unsplash.com/photo-1763886034104-140f5d127102?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxkZW50YWwlMjBoeWdpZW5lJTIwYnJ1c2hpbmd8ZW58MXx8fHwxNzY2MTc1MjEyfDA&ixlib=rb-4.1.0&q=80&w=1080",
                                content: `
                        <h2>Por que a Saúde Bucal é Tão Importante?</h2>
                        <p>A boca é a porta de entrada para muitas bactérias e infecções. Uma higiene bucal inadequada pode levar a problemas que vão muito além dos dentes, afetando coração, pulmões e até a gravidez.</p>

                        <h3>Escovação Correta</h3>
                        <p><strong>Quando escovar:</strong></p>
                        <ul>
                            <li>Ao acordar</li>
                            <li>Após cada refeição</li>
                            <li>Antes de dormir (a mais importante!)</li>
                        </ul>

                        <p><strong>Como escovar corretamente:</strong></p>
                        <ul>
                            <li>Use escova de cerdas macias</li>
                            <li>Faça movimentos circulares suaves</li>
                            <li>Incline a escova em ângulo de 45° em relação à gengiva</li>
                            <li>Escove todas as superfícies: externa, interna e de mastigação</li>
                            <li>Não esqueça da língua!</li>
                            <li>Escove por pelo menos 2 minutos</li>
                        </ul>

                        <h3>Fio Dental: Indispensável!</h3>
                        <p>O fio dental remove resíduos que a escova não alcança, prevenindo cáries interdentais e gengivite.</p>
                        <p><strong>Como usar:</strong></p>
                        <ul>
                            <li>Use diariamente, preferencialmente à noite</li>
                            <li>Corte cerca de 40cm de fio</li>
                            <li>Enrole nas pontas dos dedos médios</li>
                            <li>Passe suavemente entre todos os dentes</li>
                            <li>Faça movimento de "C" ao redor de cada dente</li>
                        </ul>

                        <h3>Visitas ao Dentista</h3>
                        <p>Consulte um dentista pelo menos 2 vezes ao ano para:</p>
                        <ul>
                            <li>Limpeza profissional</li>
                            <li>Detecção precoce de problemas</li>
                            <li>Aplicação de flúor</li>
                            <li>Orientações personalizadas</li>
                        </ul>

                        <h3>Impacto na Saúde Geral</h3>
                        <p>Estudos mostram que problemas bucais estão relacionados a:</p>
                        <ul>
                            <li>Doenças cardíacas</li>
                            <li>Diabetes</li>
                            <li>Problemas respiratórios</li>
                            <li>Complicações na gravidez</li>
                            <li>Demência</li>
                        </ul>
                        <p>Por isso, cuidar da boca é cuidar do corpo todo!</p>
                    `
                            },
                            {
                                id: 4,
                                title: "Prevenção de Doenças: Vacinas e Check-ups",
                                excerpt: "Conheça as medidas preventivas essenciais para proteger você e sua família de doenças evitáveis.",
                                category: "Prevenção",
                                image: "https://images.unsplash.com/photo-1646913508331-5ef3f22ba677?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxkb2N0b3IlMjBoZWFsdGhjYXJlJTIwbWVkaWNhbHxlbnwxfHx8fDE3NjYxNjY2NDN8MA&ixlib=rb-4.1.0&q=80&w=1080",
                                content: `
                        <h2>Prevenir é Melhor que Remediar</h2>
                        <p>A prevenção é a forma mais eficaz e econômica de cuidar da saúde. Investir em medidas preventivas evita sofrimento, complicações e gastos elevados com tratamentos.</p>

                        <h3>Vacinação: Proteção Coletiva e Individual</h3>
                        <p>As vacinas são uma das maiores conquistas da medicina, tendo erradicado ou controlado diversas doenças graves.</p>

                        <p><strong>Vacinas essenciais na infância:</strong></p>
                        <ul>
                            <li>BCG (tuberculose)</li>
                            <li>Hepatite B</li>
                            <li>Tríplice viral (sarampo, caxumba, rubéola)</li>
                            <li>Pentavalente</li>
                            <li>Poliomielite</li>
                            <li>Pneumocócica</li>
                        </ul>

                        <p><strong>Vacinas para adultos:</strong></p>
                        <ul>
                            <li>Influenza (gripe) - anualmente</li>
                            <li>Dupla adulto - reforço a cada 10 anos</li>
                            <li>HPV</li>
                            <li>COVID-19</li>
                        </ul>

                        <h3>Exames Preventivos</h3>
                        <p><strong>Para todos (anualmente):</strong></p>
                        <ul>
                            <li>Pressão arterial</li>
                            <li>Glicemia (diabetes)</li>
                            <li>Colesterol</li>
                            <li>Hemograma completo</li>
                        </ul>

                        <h3>Hábitos que Previnem Doenças</h3>
                        <ul>
                            <li><strong>Não fumar:</strong> previne diversos tipos de câncer</li>
                            <li><strong>Atividade física:</strong> 150 minutos por semana</li>
                            <li><strong>Alimentação saudável:</strong> rica em frutas e vegetais</li>
                            <li><strong>Peso saudável:</strong> IMC entre 18,5 e 24,9</li>
                            <li><strong>Controlar estresse:</strong> técnicas de relaxamento</li>
                            <li><strong>Dormir bem:</strong> 7-9 horas por noite</li>
                        </ul>

                        <h3>Prevenção de Doenças Transmissíveis</h3>
                        <ul>
                            <li>Lavar as mãos frequentemente</li>
                            <li>Cobrir boca ao tossir/espirrar</li>
                            <li>Evitar compartilhar objetos pessoais</li>
                            <li>Manter ambientes ventilados</li>
                            <li>Usar preservativo</li>
                            <li>Consumir água filtrada</li>
                        </ul>
                    `
                            },
                            {
                                id: 5,
                                title: "Exercícios Físicos: Movimento é Vida",
                                excerpt: "Descubra como a atividade física regular pode transformar sua saúde física e mental em qualquer idade.",
                                category: "Atividade Física",
                                image: "https://images.unsplash.com/photo-1634144646738-809a0f8897c4?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxleGVyY2lzZSUyMGZpdG5lc3MlMjBoZWFsdGh8ZW58MXx8fHwxNzY2MTc1MjEzfDA&ixlib=rb-4.1.0&q=80&w=1080",
                                content: `
                        <h2>Os Benefícios da Atividade Física</h2>
                        <p>O exercício físico é um dos pilares fundamentais da saúde. Não é necessário ser atleta para colher seus benefícios!</p>

                        <h3>Benefícios Físicos</h3>
                        <ul>
                            <li><strong>Coração mais forte:</strong> reduz risco cardiovascular em até 35%</li>
                            <li><strong>Controle do peso:</strong> queima calorias e aumenta metabolismo</li>
                            <li><strong>Fortalecimento muscular:</strong> previne osteoporose</li>
                            <li><strong>Controle glicêmico:</strong> previne diabetes</li>
                            <li><strong>Pressão arterial controlada</strong></li>
                            <li><strong>Sistema imunológico fortalecido</strong></li>
                        </ul>

                        <h3>Benefícios Mentais</h3>
                        <ul>
                            <li>Redução de estresse e ansiedade</li>
                            <li>Melhora do humor (endorfinas)</li>
                            <li>Aumento da autoestima</li>
                            <li>Prevenção de depressão</li>
                            <li>Melhora da memória</li>
                        </ul>

                        <h3>Quanto Exercício é Necessário?</h3>
                        <p><strong>Adultos:</strong></p>
                        <ul>
                            <li>150 minutos de atividade moderada por semana, OU</li>
                            <li>75 minutos de atividade vigorosa</li>
                            <li>Fortalecimento muscular 2x por semana</li>
                        </ul>

                        <h3>Tipos de Exercícios</h3>
                        <p><strong>1. Aeróbicos:</strong></p>
                        <ul>
                            <li>Caminhada</li>
                            <li>Corrida</li>
                            <li>Ciclismo</li>
                            <li>Natação</li>
                            <li>Dança</li>
                        </ul>

                        <p><strong>2. Força:</strong></p>
                        <ul>
                            <li>Musculação</li>
                            <li>Exercícios com peso corporal</li>
                            <li>Pilates</li>
                        </ul>

                        <p><strong>3. Flexibilidade:</strong></p>
                        <ul>
                            <li>Alongamentos</li>
                            <li>Yoga</li>
                            <li>Tai Chi</li>
                        </ul>

                        <h3>Como Começar</h3>
                        <ul>
                            <li>Comece devagar - 10 minutos já fazem diferença</li>
                            <li>Escolha atividades que você goste</li>
                            <li>Aumente gradualmente</li>
                            <li>Consulte um médico antes</li>
                            <li>Hidrate-se bem</li>
                        </ul>

                        <h3>Incorporando no Dia a Dia</h3>
                        <ul>
                            <li>Use escadas em vez de elevador</li>
                            <li>Desça do ônibus um ponto antes</li>
                            <li>Caminhe na pausa do trabalho</li>
                            <li>Brinque com crianças</li>
                            <li>Faça jardinagem</li>
                        </ul>
                    `
                            },
                            {
                                id: 6,
                                title: "Saúde Mental: Cuidando da Mente",
                                excerpt: "A saúde mental é tão importante quanto a física. Aprenda a reconhecer sinais e buscar ajuda quando necessário.",
                                category: "Saúde Mental",
                                image: "https://images.unsplash.com/photo-1596773544141-798fc586f31e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxoZWFsdGh5JTIwbGlmZXN0eWxlJTIwd2VsbG5lc3N8ZW58MXx8fHwxNzY2MDk5NjIzfDA&ixlib=rb-4.1.0&q=80&w=1080",
                                content: `
                        <h2>Saúde Mental: Quebrando Tabus</h2>
                        <p>A saúde mental é fundamental para o bem-estar completo. Não há saúde sem saúde mental!</p>

                        <h3>O que é Saúde Mental?</h3>
                        <p>É o estado de bem-estar no qual uma pessoa:</p>
                        <ul>
                            <li>Reconhece suas próprias capacidades</li>
                            <li>Consegue lidar com o estresse</li>
                            <li>Trabalha de forma produtiva</li>
                            <li>Contribui com sua comunidade</li>
                            <li>Mantém relacionamentos saudáveis</li>
                        </ul>

                        <h3>Sinais de Alerta</h3>
                        <ul>
                            <li>Tristeza persistente</li>
                            <li>Afastamento social</li>
                            <li>Falta de energia</li>
                            <li>Alterações no sono</li>
                            <li>Mudanças no apetite</li>
                            <li>Dificuldade de concentração</li>
                            <li>Sentimentos de desesperança</li>
                            <li>Ansiedade excessiva</li>
                        </ul>

                        <h3>Problemas Comuns</h3>
                        <p><strong>Depressão:</strong> Tristeza profunda, perda de interesse. É tratável!</p>
                        <p><strong>Ansiedade:</strong> Preocupação excessiva. Pode incluir ataques de pânico.</p>
                        <p><strong>Estresse Crônico:</strong> Resposta prolongada a pressões.</p>
                        <p><strong>Burnout:</strong> Esgotamento relacionado ao trabalho.</p>

                        <h3>Estratégias de Cuidado</h3>
                        <p><strong>1. Autocuidado:</strong></p>
                        <ul>
                            <li>Reserve tempo para atividades prazerosas</li>
                            <li>Mantenha rotina regular</li>
                            <li>Durma adequadamente</li>
                            <li>Alimente-se bem</li>
                        </ul>

                        <p><strong>2. Exercite-se:</strong> Libera endorfinas e melhora humor</p>
                        <p><strong>3. Conexões Sociais:</strong> Converse com amigos e família</p>
                        <p><strong>4. Mindfulness:</strong> Pratique meditação e respiração</p>
                        <p><strong>5. Gerencie Estresse:</strong> Estabeleça limites saudáveis</p>

                        <h3>Quando Buscar Ajuda</h3>
                        <p>Procure profissional se:</p>
                        <ul>
                            <li>Sintomas interferem na vida diária</li>
                            <li>Sente-se sobrecarregado</li>
                            <li>Tem pensamentos suicidas</li>
                            <li>Não consegue controlar emoções</li>
                        </ul>

                        <h3>Recursos de Emergência</h3>
                        <p><strong>CVV:</strong> 188 (24 horas, gratuito)</p>
                        <p><strong>CAPS:</strong> Procure a unidade mais próxima</p>
                        <p><strong>Emergência:</strong> 192 (SAMU)</p>

                        <p><strong>Lembre-se:</strong> Buscar ajuda é sinal de força, não fraqueza!</p>
                    `
                            }
                        ];

                        // Get unique categories
                        const categories = ['Todos', ...new Set(articles.map(a => a.category))];
                        let selectedCategory = 'Todos';

                        // Initialize
                        function init() {
                            renderCategoryFilter();
                            renderArticles();
                        }

                        // Render category filter
                        function renderCategoryFilter() {
                            const filterContainer = document.getElementById('categoryFilter');
                            filterContainer.innerHTML = categories.map(cat => `
                    <button 
                        class="category-btn ${cat === selectedCategory ? 'active' : ''}" 
                        onclick="filterByCategory('${cat}')"
                    >
                        ${cat}
                    </button>
                `).join('');
                        }

                        // Filter articles by category
                        function filterByCategory(category) {
                            selectedCategory = category;
                            renderCategoryFilter();
                            renderArticles();
                        }

                        // Render articles
                        function renderArticles() {
                            const articlesContainer = document.getElementById('articlesGrid');
                            const filteredArticles = selectedCategory === 'Todos'
                                ? articles
                                : articles.filter(a => a.category === selectedCategory);

                            articlesContainer.innerHTML = filteredArticles.map(article => `
                    <div class="article-card" onclick="openModal(${article.id})">
                        <div class="article-image">
                            <img src="${article.image}" alt="${article.title}" loading="lazy">
                            <div class="article-category">${article.category}</div>
                        </div>
                        <div class="article-content">
                            <h3>${article.title}</h3>
                            <p class="article-excerpt">${article.excerpt}</p>
                            <div class="read-more">
                                Ler mais
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </div>
                        </div>
                    </div>
                `).join('');
                        }

                        // Open modal
                        function openModal(articleId) {
                            const article = articles.find(a => a.id === articleId);
                            if (!article) return;

                            const modal = document.getElementById('modal');
                            const modalContent = document.getElementById('modalContent');

                            modalContent.innerHTML = `
                    <div class="modal-header-image">
                        <img src="${article.image}" alt="${article.title}">
                        <button class="modal-close" onclick="closeModal()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                        <div class="modal-category">${article.category}</div>
                    </div>
                    <div class="modal-body">
                        <h1>${article.title}</h1>
                        <div class="modal-article-content">
                            ${article.content}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <p><strong>Lembre-se:</strong> Este conteúdo é educativo e não substitui consulta médica. Sempre procure um profissional de saúde para orientações personalizadas.</p>
                    </div>
                `;

                            modal.classList.add('active');
                            document.body.style.overflow = 'hidden';
                        }

                        // Close modal
                        function closeModal() {
                            const modal = document.getElementById('modal');
                            modal.classList.remove('active');
                            document.body.style.overflow = 'auto';
                        }

                        // Close modal when clicking outside
                        document.getElementById('modal').addEventListener('click', function (e) {
                            if (e.target === this) {
                                closeModal();
                            }
                        });

                        // Initialize on load
                        window.addEventListener('DOMContentLoaded', init);
                        /* ===================================
                   CLÍNICA ESTORIL - JAVASCRIPT
                   ==================================== */

                        // Aguarda o carregamento do DOM
                        document.addEventListener('DOMContentLoaded', function () {

                            // ===== MENU MOBILE =====
                            initMobileMenu();

                            // ===== BOTÃO VOLTAR AO TOPO =====
                            initBackToTop();

                            // ===== SCROLL SUAVE =====
                            initSmoothScroll();

                            // ===== HEADER FIXO COM SOMBRA =====
                            initHeaderScroll();

                            // ===== FAQ ACCORDION =====
                            initFAQ();

                            // ===== FORMULÁRIO DE CONTACTO =====
                            initContactForm();

                            // ===== ANIMAÇÕES AO SCROLL =====
                            initScrollAnimations();
                        });

                        // ===== MENU MOBILE =====
                        function initMobileMenu() {
                            const menuToggle = document.querySelector('.mobile-menu-toggle');
                            const mobileMenu = document.querySelector('.mobile-menu');

                            if (menuToggle && mobileMenu) {
                                menuToggle.addEventListener('click', function () {
                                    mobileMenu.classList.toggle('active');

                                    // Anima o botão hamburger
                                    const spans = menuToggle.querySelectorAll('span');
                                    if (mobileMenu.classList.contains('active')) {
                                        spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
                                        spans[1].style.opacity = '0';
                                        spans[2].style.transform = 'rotate(-45deg) translate(7px, -6px)';
                                    } else {
                                        spans[0].style.transform = 'none';
                                        spans[1].style.opacity = '1';
                                        spans[2].style.transform = 'none';
                                    }
                                });

                                // Fecha o menu ao clicar em um link
                                const mobileLinks = document.querySelectorAll('.mobile-link');
                                mobileLinks.forEach(link => {
                                    link.addEventListener('click', function () {
                                        mobileMenu.classList.remove('active');
                                        const spans = menuToggle.querySelectorAll('span');
                                        spans[0].style.transform = 'none';
                                        spans[1].style.opacity = '1';
                                        spans[2].style.transform = 'none';
                                    });
                                });

                                // Fecha o menu ao clicar fora
                                document.addEventListener('click', function (e) {
                                    if (!menuToggle.contains(e.target) && !mobileMenu.contains(e.target)) {
                                        mobileMenu.classList.remove('active');
                                        const spans = menuToggle.querySelectorAll('span');
                                        spans[0].style.transform = 'none';
                                        spans[1].style.opacity = '1';
                                        spans[2].style.transform = 'none';
                                    }
                                });
                            }
                        }

                        // ===== BOTÃO VOLTAR AO TOPO =====
                        function initBackToTop() {
                            const backToTopBtn = document.getElementById('backToTop');

                            if (backToTopBtn) {
                                // Mostra/oculta o botão baseado no scroll
                                window.addEventListener('scroll', function () {
                                    if (window.pageYOffset > 300) {
                                        backToTopBtn.classList.add('visible');
                                    } else {
                                        backToTopBtn.classList.remove('visible');
                                    }
                                });

                                // Ação do clique
                                backToTopBtn.addEventListener('click', function () {
                                    window.scrollTo({
                                        top: 0,
                                        behavior: 'smooth'
                                    });
                                });
                            }
                        }

                        // ===== SCROLL SUAVE =====
                        function initSmoothScroll() {
                            // Scroll suave para links âncora
                            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                                anchor.addEventListener('click', function (e) {
                                    const href = this.getAttribute('href');

                                    // Ignora # sozinho
                                    if (href === '#') {
                                        e.preventDefault();
                                        return;
                                    }

                                    const target = document.querySelector(href);

                                    if (target) {
                                        e.preventDefault();

                                        const headerHeight = document.querySelector('.header').offsetHeight;
                                        const targetPosition = target.offsetTop - headerHeight - 20;

                                        window.scrollTo({
                                            top: targetPosition,
                                            behavior: 'smooth'
                                        });
                                    }
                                });
                            });
                        }

                        // ===== HEADER FIXO COM SOMBRA =====
                        function initHeaderScroll() {
                            const header = document.querySelector('.header');

                            if (header && !header.classList.contains('header-simple')) {
                                window.addEventListener('scroll', function () {
                                    if (window.pageYOffset > 100) {
                                        header.style.boxShadow = '0 4px 16px rgba(0, 0, 0, 0.12)';
                                    } else {
                                        header.style.boxShadow = '0 2px 8px rgba(0, 0, 0, 0.08)';
                                    }
                                });
                            }
                        }
                    </script>
@endsection