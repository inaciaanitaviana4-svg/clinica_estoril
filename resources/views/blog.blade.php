@extends("layouts.site")
@section("titulo", "Blog Educativo sobre Saúde")
@section("estilo")

<style>
        /* Reset e Variáveis CSS */
        :root {
            --azul-hospitalar: #0066cc;
            --primary-color: #0066cc;
            --verde-saude: #2E8B57;
            --cinza-claro: #F9FAFB;
            --branco: #FFFFFF;
            --texto-principal: #1F2937;
            --texto-secundario: #6B7280;
            --amarelo-aviso: #FEF3C7;
            --vermelho-claro: #FEE2E2;
            --sombra-card: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            --sombra-hover: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
           font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
        Oxygen, Ubuntu, Cantarell, sans-serif;
    color: var(--text-dark);
    line-height: 1.6;
    overflow-x: hidden;
        }
        
        h1, h2, h3, h4 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            line-height: 1.2;
        }
        
        h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        
        h3 {
            font-size: 1.5rem;
            margin-bottom: 0.75rem;
        }
        
        /* Container Principal */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--azul-claro) 0%, #E0F2FE 100%);
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }
        
        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }
        
        .hero-text {
            z-index: 2;
        }
        
        .hero h1 {
            color: var(--azul-hospitalar);
            font-size: 3rem;
            margin-bottom: 1.5rem;
        }
        
        .hero-subtitle {
            font-size: 1.25rem;
            color: white;
            margin-bottom: 1rem;
            font-weight: 500;
        }
        
        .hero-description {
            color: white;
            margin-bottom: 2rem;
            line-height: 1.8;
        }
        
        .hero-image {
            position: relative;
            z-index: 1;
        }
        
        .hero-image img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 16px;
            box-shadow: var(--sombra-hover);
        }
        
        /* Barra de Pesquisa */
        .search-bar {
            display: flex;
            max-width: 600px;
            background: var(--branco);
            border-radius: 50px;
            padding: 8px 12px;
            box-shadow: var(--sombra-card);
            transition: all 0.3s ease;
        }
        
        .search-bar:focus-within {
            box-shadow: var(--sombra-hover);
            transform: translateY(-2px);
        }
        
        .search-bar input {
            flex: 1;
            border: none;
            outline: none;
            padding: 12px 20px;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
        }
        
        .search-bar button {
            background: var(--azul-hospitalar);
            color: var(--branco);
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .search-bar button:hover {
            background: #0066cc;
            transform: scale(1.05);
        }
        
        /* Seções */
        section {
            padding: 80px 0;
        }
        
        .section-title {
            text-align: center;
            color: var(--azul-hospitalar);
            margin-bottom: 3rem;
        }
        
        .section-subtitle {
            text-align: center;
            color: var(--texto-secundario);
            max-width: 700px;
            margin: -2rem auto 3rem;
        }
        
        /* Cards de Categorias */
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }
        
        .category-card {
            background: var(--branco);
            border-radius: 16px;
            padding: 40px 30px;
            box-shadow: var(--sombra-card);
            transition: all 0.3s ease;
            cursor: pointer;
            text-align: center;
            border: 2px solid transparent;
        }
        
        .category-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--sombra-hover);
            background: var(--azul-hospitalar);
            color: var(--branco);
            border-color: var(--azul-hospitalar);
        }
        
        .category-card:hover h3,
        .category-card:hover p {
            color: var(--branco);
        }
        
        .category-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            display: block;
        }
        
        .category-card h3 {
            color: var(--azul-hospitalar);
            margin-bottom: 0.75rem;
            transition: color 0.3s ease;
        }
        
        .category-card p {
            color: var(--texto-secundario);
            font-size: 0.95rem;
            line-height: 1.6;
            transition: color 0.3s ease;
        }
        
        /* Cards de Artigos */
        .articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 40px;
        }
        
        .article-card {
            background: var(--branco);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--sombra-card);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        
        .article-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--sombra-hover);
        }
        
        .article-image {
            width: 100%;
            height: 240px;
            object-fit: cover;
        }
        
        .article-content {
            padding: 30px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .article-label {
            display: inline-block;
            background: var(--azul-claro);
            color: var(--azul-hospitalar);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1rem;
            width: fit-content;
        }
        
        .article-card h3 {
            color: var(--azul-hospitalar);
            margin-bottom: 1rem;
            font-size: 1.35rem;
        }
        
        .article-excerpt {
            color: var(--texto-secundario);
            margin-bottom: 1.5rem;
            flex: 1;
        }
        
        .article-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 0.9rem;
            color: var(--texto-secundario);
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }
        
        .article-meta span {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .verified-badge {
            display: flex;
            align-items: center;
            gap: 6px;
            background: #ECFDF5;
            color: var(--verde-saude);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 1rem;
        }
        
        /* Botões */
        .btn {
            display: inline-block;
            padding: 14px 32px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
        }
        
        .btn-primary {
            background: var(--azul-hospitalar);
            color: var(--branco);
        }
        
        .btn-primary:hover {
            background: #0066cc;
            transform: translateY(-2px);
            box-shadow: var(--sombra-hover);
        }
        
        .btn-outline {
            background: transparent;
            color: var(--azul-hospitalar);
            border: 2px solid var(--azul-hospitalar);
        }
        
        .btn-outline:hover {
            background: var(--azul-hospitalar);
            color: var(--branco);
        }
        
        /* Artigo Interno */
        .article-detail {
            background: var(--cinza-claro);
        }
        
        .article-header {
            background: var(--branco);
            padding: 60px 0 40px;
            text-align: center;
        }
        
        .article-header h2 {
            color: var(--azul-hospitalar);
            font-size: 2.5rem;
            max-width: 800px;
            margin: 0 auto 1.5rem;
        }
        
        .article-info {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            color: var(--texto-secundario);
            font-size: 0.95rem;
        }
        
        .article-body {
            max-width: 800px;
            margin: 0 auto;
            background: var(--branco);
            padding: 60px 80px;
            border-radius: 16px;
            box-shadow: var(--sombra-card);
            margin-top: -40px;
            margin-bottom: 60px;
        }
        
        .article-main-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 3rem;
        }
        
        .article-section {
            margin-bottom: 3rem;
        }
        
        .article-section h3 {
            color: var(--azul-hospitalar);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .article-section p {
            color: var(--texto-secundario);
            line-height: 1.8;
            margin-bottom: 1rem;
        }
        
        .article-section ul, 
        .article-section ol {
            margin-left: 1.5rem;
            color: var(--texto-secundario);
            line-height: 1.8;
        }
        
        .article-section li {
            margin-bottom: 0.75rem;
        }
        
        .warning-box {
            background: var(--vermelho-claro);
            border-left: 4px solid #DC2626;
            padding: 20px 25px;
            border-radius: 8px;
            margin: 2rem 0;
        }
        
        .warning-box h4 {
            color: #DC2626;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .warning-box ul {
            margin-left: 1.5rem;
            color: var(--texto-secundario);
        }
        
        .alert-box {
            background: #FEF3C7;
            border-left: 4px solid #F59E0B;
            padding: 20px 25px;
            border-radius: 8px;
            margin: 2rem 0;
        }
        
        .alert-box h4 {
            color: #F59E0B;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .alert-box ul {
            margin-left: 1.5rem;
            color: var(--texto-secundario);
        }
        
        .info-box {
            background: #DBEAFE;
            border-left: 4px solid var(--azul-hospitalar);
            padding: 20px 25px;
            border-radius: 8px;
            margin: 2rem 0;
        }
        
        .info-box h4 {
            color: var(--azul-hospitalar);
            margin-bottom: 0.75rem;
        }

        .info-box p {
            color: var(--texto-secundario);
        }
        
        .steps-list {
            counter-reset: steps;
            list-style: none;
            margin-left: 0;
        }
        
        .steps-list li {
            counter-increment: steps;
            position: relative;
            padding-left: 45px;
            margin-bottom: 1.5rem;
        }
        
        .steps-list li::before {
            content: counter(steps);
            position: absolute;
            left: 0;
            top: 0;
            background: var(--azul-hospitalar);
            color: var(--branco);
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }
        
        /* Disclaimer */
        .disclaimer {
            background: var(--amarelo-aviso);
            border-left: 6px solid #F59E0B;
        }
        
        .disclaimer-content {
            max-width: 1000px;
            margin: 0 auto;
            text-align: center;
            padding: 40px 30px;
        }
        
        .disclaimer-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .disclaimer h3 {
            color: #92400E;
            margin-bottom: 1rem;
        }
        
        .disclaimer p {
            color: #78350F;
            font-size: 1.1rem;
            line-height: 1.8;
        }
        
        /* Call to Action */
        .cta {
            background: linear-gradient(135deg, var(--azul-hospitalar) 0%, #0066cc 100%);
            color: var(--branco);
            text-align: center;
        }
        
        .cta h2 {
            color: var(--branco);
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
        }
        
        .cta p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }
        
        .cta .btn {
            background: var(--branco);
            color: var(--azul-hospitalar);
            font-size: 1.1rem;
            padding: 16px 48px;
        }
        
        .cta .btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);
        }
        
        
        
        /* Responsividade */
        @media (max-width: 968px) {
            .hero-content {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero-image {
                order: -1;
            }
            
            .categories-grid {
                grid-template-columns: 1fr;
            }
            
            .articles-grid {
                grid-template-columns: 1fr;
            }
            
            .footer-content {
                grid-template-columns: 1fr 1fr;
                gap: 40px;
            }
            
            .article-body {
                padding: 40px 30px;
            }
        }
        
        @media (max-width: 640px) {
            h1 {
                font-size: 2rem;
            }
            
            h2 {
                font-size: 1.75rem;
            }
            
            h3 {
                font-size: 1.25rem;
            }
            
            .hero {
                padding: 50px 0;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            section {
                padding: 50px 0;
            }
            
            .search-bar {
                flex-direction: column;
                border-radius: 12px;
            }
            
            .search-bar button {
                width: 100%;
                justify-content: center;
                border-radius: 8px;
            }
            
        
            
            .article-header h2 {
                font-size: 1.75rem;
            }
            
            .article-info {
                flex-direction: column;
                gap: 10px;
            }
            
            .article-body {
                padding: 30px 20px;
            }
            
            .article-main-image {
                height: 250px;
            }
        }
        
        /* Animações */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        
        /* Scroll Suave */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>

    <!-- Hero Section -->
    <section class="page-header" id="main-sections">
        <div class="page-header-overlay"></div>
    
        <div class="container">
            <div class="hero-content">
                <div class="hero-text fade-in">
                    <h1>Centro de Educação em Saúde</h1>
                    <p class="hero-subtitle">Informação confiável baseada em orientações médicas internacionais.</p>
                    <p class="hero-description">Conteúdos educativos sobre prevenção, doenças comuns, primeiros socorros, nutrição e bem-estar. Acesso à informação de qualidade para cuidar melhor da sua saúde e da sua família.</p>
                    
                   
                </div>
                
                <div class="hero-image fade-in">
                    <img src="imagem/close.jpg" alt="Profissional de saúde analisando informações médicas">
                </div>
            </div>
        </div>
    </section>

    <!-- Categorias Principais -->
    <section style="background: var(--cinza-claro);" class="main-content">
        <div class="container">
            <h2 class="section-title">Categorias Principais</h2>
            <p class="section-subtitle">Explore conteúdos organizados por área para encontrar a informação que você precisa</p>
            
            <div class="categories-grid">
                <div class="category-card" onclick="navigateToCategory('doencas-comuns')">
                    <span class="category-icon"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#e3e3e3"><path d="M694-120.67 552.67-262l47-46.67L694-215l179.33-178.67L920-346 694-120.67Zm-154 40q-110.67 0-185.33-77.66Q280-236 280-344.67v-31q-85.33-12-142.67-77.16Q80-518 80-606.67V-840h120v-40h66.67v146.67H200v-40h-53.33v166.66q0 69.34 48.66 118Q244-440 313.33-440q69.34 0 118-48.67 48.67-48.66 48.67-118v-166.66h-53.33v40H360V-880h66.67v40h120v233.33q0 88.67-57.34 153.84-57.33 65.16-142.66 77.16v31q0 81.67 55.16 139.5Q457-147.33 540-147.33v66.66Z"/></svg></span>
                    <h3>Doenças Comuns</h3>
                    <p>Informações sobre gripe, paludismo, tosse, febre, dor de cabeça e outras condições frequentes.</p>
                </div>
                
                <div class="category-card" onclick="navigateToCategory('primeiros-socorros')">
                    <span class="category-icon"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#e3e3e3"><path d="M446.67-806.67V-960h66.66v153.33h-66.66ZM263-752.33 149-867l47-47.67L310.67-800 263-752.33ZM153.33-40q-14.16 0-23.75-9.58Q120-59.17 120-73.33V-396l84-243.1q6-18.23 21.5-29.57Q241-680 260.67-680H370v-76.67h145.67q-23.34 30.67-37.5 66.84-14.17 36.16-16.84 76.5h-198l-59.66 170.66H511q14.33 19.34 32 36.5Q560.67-389 581.33-376H186.67v186.67h586.66V-339q17.67-3.67 34.28-9.1 16.61-5.42 32.39-13.57v288.34q0 14.16-9.58 23.75Q820.83-40 806.67-40h-27.34q-14.16 0-23.75-9.58Q746-59.17 746-73.33v-49.34H213.33v49.34q0 14.16-9.58 23.75Q194.17-40 180-40h-26.67Zm93.34-209.33h120q14.33 0 23.83-9.62 9.5-9.62 9.5-23.83 0-14.22-9.58-23.72-9.59-9.5-23.75-9.5h-120v66.67Zm466.66 0V-316h-120q-14.33 0-23.83 9.62-9.5 9.61-9.5 23.83 0 14.22 9.58 23.72 9.59 9.5 23.75 9.5h120ZM186.67-376v186.67V-376Zm509-134L836-650.67l-32.67-32.66-107.66 107.66-52.34-53L610.67-595l85 85Zm166.5-225.5q57.16 57.17 57.16 138.83 0 81.67-57.16 138.84-57.17 57.16-138.84 57.16-81.66 0-138.83-57.16-57.17-57.17-57.17-138.84 0-81.66 57.17-138.83 57.17-57.17 138.83-57.17 81.67 0 138.84 57.17Z"/></svg></span>
                    <h3>Primeiros Socorros</h3>
                    <p>Como agir em situações de hemorragias, desmaios, queimaduras e engasgamento.</p>
                </div>
                
                <div class="category-card" onclick="navigateToCategory('nutricao')">
                    <span class="category-icon"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#e3e3e3"><path d="M200-120v-407.33q-33 0-56.5-23.5t-23.5-56.5v-208q0-10 7.33-17.34 7.34-7.33 17.34-7.33t17.66 7.33q7.67 7.34 7.67 17.34v138.66h38.67v-138.66q0-10 7.33-17.34 7.33-7.33 17.33-7.33 10 0 17.34 7.33 7.33 7.34 7.33 17.34v138.66h38.67v-138.66q0-10 7.66-17.34Q312-840 322-840q10 0 17.33 7.33 7.34 7.34 7.34 17.34v208q0 33-23.5 56.5t-56.5 23.5V-120H200Zm280 0v-410q-41.33-22-61.67-62.17Q398-632.33 398-682q0-61 30.83-109.5Q459.67-840 514-840t85.17 48.5Q630-743 630-682q0 49.67-21 89.83Q588-552 546.67-530v410H480Zm209.33 0v-720Q750-836.67 795-794t45 104.67v242.66h-84V-120h-66.67Z"/></svg></span>
                    <h3>Nutrição e Alimentação</h3>
                    <p>Guias sobre alimentação saudável, hidratação adequada e nutrição infantil.</p>
                </div>
                
                <div class="category-card" onclick="navigateToCategory('fisioterapia')">
                    <span class="category-icon"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#e3e3e3"><path d="M482.33-275.33ZM120-160v-160q0-83 58.5-141.5T320-520h429q38 0 64.5 26t26.5 64q0 31-19 55.5T773-342l-93 27v174.33q0 17.61-7.87 31.86T651-85.33q-13.43 9.16-29.38 11.25Q605.67-72 589-78.67L382-160H120Zm493.33-133.33H375q-11.67 0-18.83 7.33-7.17 7.33-8.84 16.33-1.66 9 2.96 18.14t15.71 13.2l247.33 97.66v-152.66Zm-426.66 66.66H290q-4.67-8.66-7.33-18.33-2.67-9.67-2.67-20 0-39 28-67t67-28h213l168-46.33q11-3.34 15-10.34t2.33-15.66q-1.66-8.67-7.83-14.84-6.17-6.16-16.5-6.16H320q-55.56 0-94.44 38.89-38.89 38.88-38.89 94.44v93.33ZM287-607q-47-47-47-113t47-113q47-47 113-47t113 47q47 47 47 113t-47 113q-47 47-113 47t-113-47Zm179.17-46.83Q493.33-681 493.33-720t-27.16-66.17Q439-813.33 400-813.33t-66.17 27.16Q306.67-759 306.67-720t27.16 66.17Q361-626.67 400-626.67t66.17-27.16Zm16.16 378.5ZM400-720Z"/></svg></span>
                
                    <h3>Fisioterapia e Corpo</h3>
                    <p>Orientações sobre postura correta, prevenção de dores musculares e reabilitação.</p>
                </div>
                
                <div class="category-card" onclick="navigateToCategory('higiene')">
                    <span class="category-icon"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#e3e3e3"><path d="M680-646.67q-21.67 0-37.5-15.83-15.83-15.83-15.83-37.66 0-14.84 14.66-39.84Q656-765 680-790q24 25 38.67 49.93 14.66 24.93 14.66 40.07 0 21.67-15.55 37.5-15.56 15.83-37.78 15.83Zm106.67 280q-38.67 0-66-27.33-27.34-27.33-27.34-66.06 0-32.27 28.67-80.44 28.67-48.17 64.67-89.5Q822-588.67 851-540.65q29 48.02 29 80.65 0 38.67-27.07 66-27.06 27.33-66.26 27.33ZM360-246.67h66.67v-80h80v-66.66h-80v-80H360v80h-80v66.66h80v80ZM226.67-80q-27 0-46.84-19.83Q160-119.67 160-146.67v-340q0-87.33 57-152.12 57-64.8 143-78.54v-96h-86.67V-880h240q30.87 0 58.1 8.83 27.24 8.84 51.24 25.17L574-796.67q-14-8-28.83-12.33-14.84-4.33-31.84-4.33h-86.66v96q86 13.74 143 78.54 57 64.79 57 152.12v340q0 27-19.84 46.84Q587-80 560-80H226.67Zm0-66.67H560v-340q0-69.33-48.67-118-48.66-48.66-117.66-48.66t-118 48.66q-49 48.67-49 118v340Zm0 0H560 226.67Z"/></svg></span>
                    <h3>Higiene e Prevenção</h3>
                    <p>Práticas essenciais de higiene, lavagem das mãos e prevenção de infeções.</p>
                </div>
                
                <div class="category-card" onclick="navigateToCategory('saude-infantil')">
                    <span class="category-icon"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#e3e3e3"><path d="M549.5-511.5Q536-525 536-544.67q0-19.66 13.5-33.16 13.5-13.5 33.17-13.5 19.66 0 33.16 13.5 13.5 13.5 13.5 33.16 0 19.67-13.5 33.17T582.67-498q-19.67 0-33.17-13.5Zm-206 0Q330-525 330-544.67q0-19.66 13.5-33.16 13.5-13.5 33.17-13.5 19.66 0 33.16 13.5 13.5 13.5 13.5 33.16 0 19.67-13.5 33.17T376.67-498q-19.67 0-33.17-13.5ZM375.83-315Q329-346 304-396.67h352Q631-346 584.17-315 537.33-284 480-284t-104.17-31Zm-35.66 166.5q-65.5-28.5-114.34-77.33Q177-274.67 148.5-340.17T120-480q0-74.33 28.5-139.83 28.5-65.5 77.33-114.34Q274.67-783 340.17-811.5T480-840q74.33 0 139.83 28.5 65.5 28.5 114.34 77.33Q783-685.33 811.5-619.83T840-480q0 74.33-28.5 139.83-28.5 65.5-77.33 114.34Q685.33-177 619.83-148.5T480-120q-74.33 0-139.83-28.5ZM687-272.33q86.33-85.67 86.33-206.34 0-120.66-85.33-209.33-85.33-88.67-209.33-88.67h-16q-6.67 0-16 1.34-3.34 7.33-5 17-1.67 9.66-1.67 17.66 0 23.67 15.83 39.5 15.84 15.84 39.5 15.84 11 0 18.84-2 7.83-2 15.16-2 10.67 0 18 6.33 7.34 6.33 7.34 17 0 18.33-17.17 26.17-17.17 7.83-42.17 7.83-45.66 0-77.16-31.5t-31.5-77.17q0-4.33.33-10.66.33-6.34 2-11.34-88.33 32-145.33 107-57 75-57 174.34 0 120.66 86.33 207.66t207 87q120.67 0 207-85.66Zm-207-209Z"/></svg></span>
                    <h3>Saúde Infantil</h3>
                    <p>Cuidados especiais com a saúde das crianças, vacinação e desenvolvimento infantil.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Artigos em Destaque -->
    <section class="main-content">
        <div class="container">
            <h2 class="section-title">Artigos em Destaque</h2>
            <p class="section-subtitle">Conteúdos revisados por profissionais de saúde qualificados</p>
            
            <div class="articles-grid">
                <article class="article-card">
                    <img src="imagem/gripe.jpg" alt="Pessoa com sintomas de gripe" class="article-image">
                    <div class="article-content">
                        <span class="article-label">Doenças Comuns</span>
                        <h3>Gripe: Sintomas, Prevenção e Quando Procurar Atendimento</h3>
                        <p class="article-excerpt">A gripe é uma infeção viral respiratória que afeta milhões de pessoas anualmente. Conheça os sintomas, formas de prevenção e quando é essencial procurar ajuda médica profissional.</p>
                        <div class="verified-badge">
                            <span>✓</span>
                            <span>Revisado por profissional de saúde</span>
                        </div>
                        <div class="article-meta">
                            <span>⏱ 8 min de leitura</span>
                            <span> Atualizado em 28 Fev 2026</span>
                        </div>
                        <a href="#artigo-gripe" class="btn btn-outline" onclick="showArticle(event, 'gripe')">Ler artigo</a>
                    </div>
                </article>
                
                <article class="article-card">
                    <img src="imagem/paludismo.jpg" alt="Prevenção do paludismo" class="article-image">
                    <div class="article-content">
                        <span class="article-label">Doenças Comuns</span>
                        <h3>Paludismo: Como Prevenir e Identificar os Sinais</h3>
                        <p class="article-excerpt">O paludismo (malária) é uma doença grave transmitida por mosquitos. Saiba como se proteger, reconhecer os sintomas iniciais e a importância do diagnóstico precoce.</p>
                        <div class="verified-badge">
                            <span>✓</span>
                            <span>Revisado por profissional de saúde</span>
                        </div>
                        <div class="article-meta">
                            <span>⏱ 10 min de leitura</span>
                            <span> Atualizado em 25 Fev 2026</span>
                        </div>
                        <a href="#artigo-paludismo" class="btn btn-outline" onclick="showArticle(event, 'paludismo')">Ler artigo</a>
                    </div>
                </article>
                
                <article class="article-card">
                    <img src="imagem/sangramento.jpg" alt="Primeiros socorros" class="article-image">
                    <div class="article-content">
                        <span class="article-label">Primeiros Socorros</span>
                        <h3>Sangramento Nasal (Epistaxe): O Que Fazer Corretamente</h3>
                        <p class="article-excerpt">O sangramento nasal é comum, mas é importante saber como proceder corretamente. Aprenda as técnicas adequadas e quando buscar atendimento médico de emergência.</p>
                        <div class="verified-badge">
                            <span>✓</span>
                            <span>Revisado por profissional de saúde</span>
                        </div>
                        <div class="article-meta">
                            <span>⏱ 6 min de leitura</span>
                        <span>Atualizado em 1 Mar 2026</span>
                        </div>
                        <a href="#artigo-epistaxe" class="btn btn-outline" onclick="showArticle(event, 'epistaxe')">Ler artigo</a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- Cards Informativos Educativos -->
    <section style="background: var(--azul-claro);" class="main-content">
        <div class="container">
            <h2 class="section-title">Guias Rápidos de Saúde</h2>
            <p class="section-subtitle">Informações práticas e essenciais para o dia a dia</p>
            
            <div class="categories-grid">
                <div class="category-card" onclick="showInfoCard(event, 'lavar-maos')">
                    <span class="category-icon">
                   <img src="imagem/lavar_mao.jpg">     
                    </span>
                    <h3>Importância de Lavar as Mãos</h3>
                    <p>Pequeno gesto, grande proteção. Saiba como a lavagem das mãos previne doenças.</p>
                
                    <h5 style="margin-top:20px;">Clica neste conteúdo e mantenha-se informado.</h5>
                </div>
                
                <div class="category-card" onclick="showInfoCard(event, 'lavar-alimentos')">
                    <span class="category-icon">
                <img src="imagem/alimentos.jpg">   
                    </span>
                    <h3>Importância de Lavar os Alimentos</h3>
                    <p>Alimentos limpos, saúde protegida. Como higienizar frutas e verduras corretamente.</p>
                    <h5 style="margin-top:25px;">Clica neste conteúdo e mantenha-se informado.</h5>
                </div>
                
                <div class="category-card" onclick="showInfoCard(event, 'tomar-banho')">
                    <span class="category-icon">
                        <img src="imagem/banho.jpg">   
                    </span>
                    <h3>Importância de Tomar Banho</h3>
                    <p>Higiene corporal é prevenção. Benefícios do banho diário para a saúde.</p>
                    <h5 style="margin-top:25px;">Clica neste conteúdo e mantenha-se informado.</h5>
                </div>
                
                <div class="category-card" onclick="showInfoCard(event, 'dor-cabeca')">
                    <span class="category-icon">
                        <img src="imagem/cabeca-dor.jpg">   
                    </span>
                    <h3>Dor de Cabeça: O Que Fazer</h3>
                    <p>Cuidados simples antes de medicar. Como aliviar a dor de cabeça naturalmente.</p>
                    <h5 style="margin-top:120px;">Clica neste conteúdo e mantenha-se informado.</h5>
                </div>
                
                <div class="category-card" onclick="showInfoCard(event, 'ferimentos')">
                    <span class="category-icon">
                        <img src="imagem/socorros.jpg">   
                    </span>
                    <h3>Primeiros Socorros para Ferimentos</h3>
                    <p>Cuidados imediatos evitam complicações. Como tratar cortes e feridas.</p>
                    <h5 style="margin-top:20px;">Clica neste conteúdo e mantenha-se informado.</h5>
                </div>
                
                <div class="category-card" onclick="showInfoCard(event, 'picada-mosquito')">
                    <span class="category-icon">
                        <img src="imagem/mosquito.jpg">   
                    </span>
                    <h3>Após Picada de Mosquito</h3>
                    <p>Alívio e prevenção de complicações. O que fazer após ser picado.</p>
                    <h5 style="margin-top:46px;">Clica neste conteúdo e mantenha-se informado.</h5>
                </div>
            </div>
        </div>
    </section>

    <!-- Artigo Interno Dinâmico -->
    <section class="article-detail" id="artigo-interno" style="display: none;">
        <div class="article-header">
            <div class="container">
                <h2 id="article-title"></h2>
                <div class="article-info" id="article-meta-header">
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="article-body" id="article-content">
                <!-- Conteúdo será inserido dinamicamente via JavaScript -->
            </div>
        </div>
    </section>

    <!-- Disclaimer -->
    <section class="disclaimer main-content">
        <div class="container">
            <div class="disclaimer-content">
                <div class="disclaimer-icon"></div>
                <h3>Aviso Médico Importante</h3>
                <p>Este conteúdo possui caráter exclusivamente informativo e educativo. As informações aqui apresentadas não substituem consulta, diagnóstico ou tratamento médico presencial. Sempre procure orientação de profissionais de saúde qualificados para questões relacionadas à sua saúde.</p>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta main-content">
        <div class="container">
            <h2>Precisa de Orientação Médica Personalizada?</h2>
            <p>Nossa equipe de profissionais qualificados está pronta para atendê-lo</p>
             <a href="/agendar-consulta-paciente" class="btn btn-primary">Agendar Consulta</a>
        </div>
    </section>

    <script>
        // Base de dados de artigos
        const articlesData = {
            'gripe': {
                title: 'Gripe: Sintomas, Prevenção e Quando Procurar Atendimento',
                date: '28 de Fevereiro de 2026',
                time: '8 minutos de leitura',
                reviewer: 'Dr. João Silva, Clínico Geral',
                image: 'https://images.unsplash.com/photo-1666887359800-60e37f543dbd?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxtZWRpY2FsJTIwc3RldGhvc2NvcGUlMjBoZWFsdGhjYXJlJTIwcHJvZmVzc2lvbmFsfGVufDF8fHx8MTc3MjQ1MDE4MHww&ixlib=rb-4.1.0&q=80&w=1080',
                content: `
                    <img src="https://images.unsplash.com/photo-1666887359800-60e37f543dbd?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxtZWRpY2FsJTIwc3RldGhvc2NvcGUlMjBoZWFsdGhjYXJlJTIwcHJvZmVzc2lvbmFsfGVufDF8fHx8MTc3MjQ1MDE4MHww&ixlib=rb-4.1.0&q=80&w=1080" alt="Exame médico" class="article-main-image">
                    
                    <div class="article-section">
                        <h3>📌 Introdução</h3>
                        <p>A gripe é uma infeção viral aguda do sistema respiratório causada pelo vírus Influenza. É uma das doenças mais comuns em todo o mundo, afetando milhões de pessoas anualmente, especialmente durante os meses mais frios. Embora geralmente seja uma doença autolimitada, a gripe pode levar a complicações graves em grupos de risco.</p>
                    </div>
                    
                    <div class="article-section">
                        <h3>🔬 O que é a Gripe?</h3>
                        <p>A gripe é uma infeção causada pelos vírus Influenza dos tipos A, B e, raramente, C. Ao contrário do resfriado comum, a gripe tende a causar sintomas mais intensos e pode resultar em complicações sérias, especialmente em crianças pequenas, idosos, gestantes e pessoas com condições médicas preexistentes.</p>
                        <p>A transmissão ocorre principalmente através de gotículas respiratórias expelidas ao tossir, espirrar ou falar, e também pelo contato com superfícies contaminadas.</p>
                    </div>
                    
                    <div class="article-section">
                        <h3>🦠 Causas</h3>
                        <p>A gripe é causada exclusivamente pelos vírus Influenza. Os principais fatores que contribuem para a transmissão incluem:</p>
                        <ul>
                            <li><strong>Contato próximo com pessoas infetadas:</strong> Especialmente em ambientes fechados e com pouca ventilação</li>
                            <li><strong>Exposição a gotículas respiratórias:</strong> Liberadas ao tossir, espirrar ou falar</li>
                            <li><strong>Contato com superfícies contaminadas:</strong> O vírus pode sobreviver em superfícies por até 48 horas</li>
                            <li><strong>Sistema imunológico enfraquecido:</strong> Torna o organismo mais suscetível à infeção</li>
                            <li><strong>Aglomerações:</strong> Escolas, transportes públicos e locais com muitas pessoas</li>
                        </ul>
                    </div>
                    
                    <div class="article-section">
                        <h3>🌡️ Sintomas</h3>
                        <p>Os sintomas da gripe geralmente aparecem de forma súbita, entre 1 a 4 dias após a exposição ao vírus:</p>
                        <ul>
                            <li>🤒 Febre alta (geralmente acima de 38°C)</li>
                            <li>😫 Dores musculares e corporais intensas</li>
                            <li>😴 Fadiga e fraqueza extremas</li>
                            <li>🤧 Congestão nasal e coriza</li>
                            <li>😷 Tosse seca persistente</li>
                            <li>🤕 Dor de cabeça</li>
                            <li>❄️ Calafrios</li>
                            <li>😢 Dor de garganta</li>
                            <li>👁️ Lacrimejamento dos olhos</li>
                        </ul>
                        <p><strong>Nota:</strong> Em crianças, também podem ocorrer náuseas, vómitos e diarreia.</p>
                    </div>
                    
                    <div class="article-section">
                        <h3>⚠️ Fatores de Risco</h3>
                        <p>Algumas pessoas têm maior risco de desenvolver complicações graves:</p>
                        <ul>
                            <li>Crianças menores de 5 anos (especialmente menores de 2 anos)</li>
                            <li>Adultos com 65 anos ou mais</li>
                            <li>Gestantes e puérperas (até 2 semanas após o parto)</li>
                            <li>Pessoas com doenças crónicas (asma, diabetes, doenças cardíacas)</li>
                            <li>Indivíduos imunocomprometidos</li>
                            <li>Pessoas com obesidade mórbida</li>
                        </ul>
                    </div>
                    
                    <div class="article-section">
                        <h3>✅ O Que Fazer?</h3>
                        <p>Se suspeitar que está com gripe, siga estas orientações:</p>
                        <ol class="steps-list">
                            <li><strong>Repouso absoluto:</strong> Descanse bastante para permitir que o corpo combata a infeção.</li>
                            <li><strong>Hidratação adequada:</strong> Beba bastante água, sumos naturais e chás para evitar desidratação.</li>
                            <li><strong>Alimentação leve:</strong> Prefira alimentos nutritivos e de fácil digestão.</li>
                            <li><strong>Controlo da febre:</strong> Use medicamentos antitérmicos conforme orientação médica (paracetamol ou ibuprofeno).</li>
                            <li><strong>Isolamento:</strong> Evite contato próximo com outras pessoas para não transmitir o vírus.</li>
                            <li><strong>Higiene respiratória:</strong> Cubra a boca e o nariz ao tossir ou espirrar, preferencialmente com lenço descartável.</li>
                        </ol>
                    </div>
                    
                    <div class="warning-box">
                        <h4>❌ O Que NÃO Fazer</h4>
                        <ul>
                            <li>Não tome antibióticos sem prescrição médica (antibióticos não combatem vírus)</li>
                            <li>Não se automedique com medicamentos antivirais</li>
                            <li>Não force atividades físicas ou trabalho durante o período de doença</li>
                            <li>Não ignore o agravamento dos sintomas</li>
                            <li>Não dê aspirina a crianças e adolescentes com gripe (risco de síndrome de Reye)</li>
                        </ul>
                    </div>
                    
                    <div class="alert-box">
                        <h4>🚨 Quando Procurar Atendimento Médico?</h4>
                        <p>Procure atendimento médico imediatamente se apresentar:</p>
                        <ul>
                            <li>Dificuldade para respirar ou falta de ar</li>
                            <li>Dor ou pressão no peito ou abdómen</li>
                            <li>Tonturas súbitas ou confusão mental</li>
                            <li>Vómitos graves ou persistentes</li>
                            <li>Febre alta que não baixa com medicação</li>
                            <li>Sintomas que melhoram mas depois pioram</li>
                            <li>Convulsões</li>
                            <li>Desidratação (boca seca, urina escassa e escura)</li>
                        </ul>
                        <p><strong>Em crianças:</strong> Respiração acelerada, coloração azulada, irritabilidade extrema ou recusa em se alimentar.</p>
                    </div>
                    
                    <div class="article-section">
                        <h3>🛡️ Prevenção</h3>
                        <p>A prevenção é a melhor estratégia contra a gripe:</p>
                        <ul>
                            <li><strong>Vacinação anual:</strong> A vacina contra a gripe é a forma mais eficaz de prevenção</li>
                            <li><strong>Lavagem frequente das mãos:</strong> Com água e sabão por pelo menos 20 segundos</li>
                            <li><strong>Uso de álcool gel:</strong> Quando não for possível lavar as mãos</li>
                            <li><strong>Evitar tocar o rosto:</strong> Especialmente olhos, nariz e boca</li>
                            <li><strong>Etiqueta respiratória:</strong> Cobrir a boca ao tossir ou espirrar</li>
                            <li><strong>Evitar aglomerações:</strong> Durante períodos de surtos</li>
                            <li><strong>Manter ambientes ventilados:</strong> Abrir janelas para circulação de ar</li>
                            <li><strong>Alimentação saudável:</strong> Fortalecer o sistema imunológico</li>
                            <li><strong>Atividade física regular:</strong> Melhora a resistência do organismo</li>
                        </ul>
                    </div>
                    
                    <div class="info-box">
                        <h4>💡 Informação Importante</h4>
                        <p>A gripe não é a mesma coisa que um resfriado comum. A gripe é geralmente mais grave, com início súbito de sintomas intensos, enquanto o resfriado tem início gradual e sintomas mais leves. A duração da gripe é tipicamente de 5 a 7 dias, embora a fadiga possa persistir por semanas.</p>
                    </div>
                    
                    <div style="margin-top: 3rem; padding-top: 2rem; border-top: 2px solid var(--cinza-claro);">
                        <p style="color: var(--texto-secundario); font-size: 0.9rem;">
                            <strong>Fontes:</strong> Organização Mundial da Saúde (OMS), Centers for Disease Control and Prevention (CDC), Ministério da Saúde.
                        </p>
                        <p style="color: var(--texto-secundario); font-size: 0.9rem; margin-top: 1rem;">
                            <strong>Última atualização:</strong> 28 de Fevereiro de 2026
                        </p>
                    </div>
                `
            },
            'paludismo': {
                title: 'Paludismo: Como Prevenir e Identificar os Sinais',
                date: '25 de Fevereiro de 2026',
                time: '10 minutos de leitura',
                reviewer: 'Dra. Maria Santos, Infectologista',
                image: 'https://images.unsplash.com/photo-1634710664586-fe890319a9fb?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxtYWxhcmlhJTIwbW9zcXVpdG8lMjBwcmV2ZW50aW9uJTIwYWZyaWNhfGVufDF8fHx8MTc3MjQ1MDE3OXww&ixlib=rb-4.1.0&q=80&w=1080',
                content: `
                    <img src="https://images.unsplash.com/photo-1634710664586-fe890319a9fb?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxtYWxhcmlhJTIwbW9zcXVpdG8lMjBwcmV2ZW50aW9uJTIwYWZyaWNhfGVufDF8fHx8MTc3MjQ1MDE3OXww&ixlib=rb-4.1.0&q=80&w=1080" alt="Prevenção do paludismo" class="article-main-image">
                    
                    <div class="article-section">
                        <h3>📌 Introdução</h3>
                        <p>O paludismo, também conhecido como malária, é uma doença infecciosa grave causada por parasitas do género Plasmodium e transmitida através da picada de mosquitos fêmeas infetados do género Anopheles. É uma das principais causas de mortalidade em regiões tropicais e subtropicais, especialmente em África.</p>
                    </div>
                    
                    <div class="article-section">
                        <h3>🔬 O Que é o Paludismo?</h3>
                        <p>O paludismo é causado por parasitas microscópicos que são transmitidos aos humanos através da picada de mosquitos infetados. O parasita multiplica-se no fígado e depois infeta os glóbulos vermelhos do sangue.</p>
                        <p>Existem cinco espécies de parasitas que causam paludismo em humanos, sendo o Plasmodium falciparum o mais perigoso, responsável pela maioria das mortes relacionadas com a malária.</p>
                    </div>
                    
                    <div class="article-section">
                        <h3>🦠 Como se Transmite?</h3>
                        <p>A transmissão ocorre principalmente através de:</p>
                        <ul>
                            <li><strong>Picada de mosquito:</strong> O mosquito Anopheles fêmea infetado transmite o parasita ao picar uma pessoa</li>
                            <li><strong>Transmissão da mãe para o bebé:</strong> Durante a gravidez ou o parto (paludismo congénito)</li>
                            <li><strong>Transfusões de sangue:</strong> Raramente, através de sangue contaminado</li>
                            <li><strong>Partilha de agulhas:</strong> Em casos muito raros</li>
                        </ul>
                        <p><strong>Importante:</strong> O paludismo NÃO é contagioso e não se transmite de pessoa para pessoa através do contacto direto.</p>
                    </div>
                    
                    <div class="article-section">
                        <h3>🌡️ Sintomas Principais</h3>
                        <p>Os sintomas geralmente aparecem entre 10 a 15 dias após a picada do mosquito infetado:</p>
                        <ul>
                            <li>🔥 <strong>Febre alta repentina:</strong> Frequentemente com picos cíclicos</li>
                            <li>❄️ <strong>Calafrios intensos:</strong> Tremores incontroláveis</li>
                            <li>💧 <strong>Suores profusos:</strong> Especialmente à noite</li>
                            <li>🤕 <strong>Dor de cabeça:</strong> Intensa e persistente</li>
                            <li>😫 <strong>Dores musculares e corporais:</strong> Dores generalizadas</li>
                            <li>🤢 <strong>Náuseas e vómitos:</strong> Frequentes</li>
                            <li>😴 <strong>Fraqueza extrema:</strong> Fadiga intensa</li>
                            <li>🟡 <strong>Icterícia:</strong> Coloração amarelada da pele e olhos (em casos graves)</li>
                        </ul>
                    </div>
                    
                    <div class="article-section">
                        <h3>⚠️ Fatores de Risco</h3>
                        <p>Estão em maior risco de complicações graves:</p>
                        <ul>
                            <li>Crianças menores de 5 anos</li>
                            <li>Gestantes e bebés</li>
                            <li>Pessoas com HIV/SIDA</li>
                            <li>Viajantes não imunizados de áreas sem paludismo</li>
                            <li>Pessoas com o sistema imunológico debilitado</li>
                        </ul>
                    </div>
                    
                    <div class="article-section">
                        <h3>✅ O Que Fazer ao Suspeitar de Paludismo?</h3>
                        <ol class="steps-list">
                            <li><strong>Procure atendimento médico imediatamente:</strong> O paludismo é uma emergência médica e requer diagnóstico e tratamento rápidos.</li>
                            <li><strong>Informe sobre exposição a mosquitos:</strong> Mencione se esteve em áreas endémicas.</li>
                            <li><strong>Realize o teste diagnóstico:</strong> O teste de sangue (gota espessa ou teste rápido) confirma a infeção.</li>
                            <li><strong>Inicie o tratamento prescrito:</strong> Tome os medicamentos antimaláricos conforme indicação médica.</li>
                            <li><strong>Mantenha-se hidratado:</strong> Beba bastante líquido.</li>
                            <li><strong>Descanse:</strong> Repouso é essencial para recuperação.</li>
                        </ol>
                    </div>
                    
                    <div class="warning-box">
                        <h4>❌ O Que NÃO Fazer</h4>
                        <ul>
                            <li>Não ignore os sintomas de febre persistente</li>
                            <li>Não se automedique sem confirmação diagnóstica</li>
                            <li>Não interrompa o tratamento antes do prazo indicado pelo médico</li>
                            <li>Não subestime a gravidade da doença</li>
                            <li>Não espere que os sintomas passem sozinhos</li>
                        </ul>
                    </div>
                    
                    <div class="alert-box">
                        <h4>🚨 Sinais de Alarme - Procure Urgência Médica!</h4>
                        <p>Procure atendimento de emergência imediatamente se apresentar:</p>
                        <ul>
                            <li>Dificuldade para respirar</li>
                            <li>Convulsões</li>
                            <li>Confusão mental ou alteração de consciência</li>
                            <li>Incapacidade de beber ou comer</li>
                            <li>Vómitos persistentes</li>
                            <li>Urina escura (cor de coca-cola)</li>
                            <li>Pele ou olhos muito amarelados</li>
                            <li>Sangramento anormal</li>
                            <li>Fraqueza extrema</li>
                        </ul>
                        <p><strong>Em crianças:</strong> Sonolência excessiva, respiração rápida, recusa alimentar, convulsões.</p>
                    </div>
                    
                    <div class="article-section">
                        <h3>🛡️ Prevenção - Como se Proteger</h3>
                        <p>A prevenção é fundamental nas áreas onde o paludismo é comum:</p>
                        
                        <h4 style="color: var(--azul-hospitalar); margin-top: 1.5rem;">Proteção contra Mosquitos:</h4>
                        <ul>
                            <li><strong>Dormir sob rede mosquiteira:</strong> Preferentemente impregnada com inseticida</li>
                            <li><strong>Usar repelente de insetos:</strong> Aplicar nas áreas expostas da pele</li>
                            <li><strong>Vestir roupa protetora:</strong> Mangas compridas e calças, especialmente ao entardecer</li>
                            <li><strong>Instalar redes/telas nas janelas e portas:</strong> Para impedir entrada de mosquitos</li>
                            <li><strong>Usar inseticidas:</strong> Spray ou dispositivos elétricos em ambientes fechados</li>
                        </ul>
                        
                        <h4 style="color: var(--azul-hospitalar); margin-top: 1.5rem;">Eliminação de Criadouros:</h4>
                        <ul>
                            <li>Eliminar água parada</li>
                            <li>Manter recipientes de água cobertos</li>
                            <li>Limpar calhas e ralos</li>
                            <li>Descartar lixo adequadamente</li>
                            <li>Manter o ambiente limpo e organizado</li>
                        </ul>
                        
                        <h4 style="color: var(--azul-hospitalar); margin-top: 1.5rem;">Medicação Preventiva:</h4>
                        <p>Em algumas situações, o médico pode prescrever medicamentos antimaláricos preventivos (quimioprofilaxia), especialmente para:</p>
                        <ul>
                            <li>Gestantes</li>
                            <li>Viajantes para áreas endémicas</li>
                            <li>Pessoas com risco elevado</li>
                        </ul>
                    </div>
                    
                    <div class="info-box">
                        <h4>💡 Informação Importante</h4>
                        <p>O paludismo é tratável e curável quando diagnosticado precocemente. O diagnóstico e tratamento precoces são fundamentais para evitar complicações graves. Se vive ou viajou para uma área onde o paludismo é comum e desenvolver febre, procure atendimento médico imediatamente.</p>
                        <p style="margin-top: 1rem;"><strong>Vacinação:</strong> Existe uma vacina contra o paludismo (RTS,S/AS01) recomendada pela OMS para crianças em áreas de alta transmissão. Consulte as autoridades de saúde locais sobre disponibilidade.</p>
                    </div>
                    
                    <div style="margin-top: 3rem; padding-top: 2rem; border-top: 2px solid var(--cinza-claro);">
                        <p style="color: var(--texto-secundario); font-size: 0.9rem;">
                            <strong>Fontes:</strong> Organização Mundial da Saúde (OMS), Ministério da Saúde de Angola, Centers for Disease Control and Prevention (CDC).
                        </p>
                        <p style="color: var(--texto-secundario); font-size: 0.9rem; margin-top: 1rem;">
                            <strong>Última atualização:</strong> 25 de Fevereiro de 2026
                        </p>
                    </div>
                `
            },
            'epistaxe': {
                title: 'Sangramento Nasal (Epistaxe): O Que Fazer Corretamente',
                date: '1 de Março de 2026',
                time: '6 minutos de leitura',
                reviewer: 'Dr. Carlos Mendes, Otorrinolaringologista',
                image: 'https://images.unsplash.com/photo-1564144573017-8dc932e0039e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxmaXJzdCUyMGFpZCUyMG5vc2VibGVlZCUyMG1lZGljYWwlMjBjYXJlfGVufDF8fHx8MTc3MjQ1MDE4MHww&ixlib=rb-4.1.0&q=80&w=1080',
                content: `
                    <img src="https://images.unsplash.com/photo-1564144573017-8dc932e0039e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxmaXJzdCUyMGFpZCUyMG5vc2VibGVlZCUyMG1lZGljYWwlMjBjYXJlfGVufDF8fHx8MTc3MjQ1MDE4MHww&ixlib=rb-4.1.0&q=80&w=1080" alt="Primeiros socorros" class="article-main-image">
                    
                    <div class="article-section">
                        <h3>📌 Introdução</h3>
                        <p>O sangramento nasal, conhecido cientificamente como epistaxe, é uma ocorrência comum que pode afetar pessoas de todas as idades. Embora na maioria dos casos seja inofensivo e fácil de controlar, é importante saber como agir corretamente para estancar o sangramento e quando procurar ajuda médica.</p>
                    </div>
                    
                    <div class="article-section">
                        <h3>🔬 O Que é o Sangramento Nasal?</h3>
                        <p>O sangramento nasal ocorre quando os vasos sanguíneos delicados no interior do nariz se rompem. A maior parte dos sangramentos nasais acontece na parte anterior do nariz (epistaxe anterior), onde os vasos sanguíneos são mais superficiais e frágeis.</p>
                        <p>O interior do nariz é revestido por uma membrana mucosa rica em vasos sanguíneos, tornando-o particularmente vulnerável a sangramentos.</p>
                    </div>
                    
                    <div class="article-section">
                        <h3>🦠 Causas Comuns</h3>
                        <p>O sangramento nasal pode ser causado por diversos fatores:</p>
                        <ul>
                            <li><strong>Ar seco:</strong> Clima seco ou aquecimento interior ressecam as membranas nasais</li>
                            <li><strong>Trauma nasal:</strong> Pancadas, quedas ou coçar o nariz com força</li>
                            <li><strong>Resfriados e alergias:</strong> Inflamação e irritação da mucosa nasal</li>
                            <li><strong>Uso excessivo de descongestionantes nasais:</strong> Podem ressecar e irritar o nariz</li>
                            <li><strong>Pressão arterial elevada:</strong> Pode causar sangramentos mais intensos</li>
                            <li><strong>Medicamentos anticoagulantes:</strong> Aspirina, varfarina e outros</li>
                            <li><strong>Desvio de septo:</strong> Pode tornar a mucosa mais vulnerável</li>
                            <li><strong>Fragilidade dos vasos sanguíneos:</strong> Especialmente em idosos e crianças</li>
                            <li><strong>Calor excessivo:</strong> Exposição prolongada ao sol</li>
                        </ul>
                    </div>
                    
                    <div class="article-section">
                        <h3>✅ O Que Fazer - Passos Corretos</h3>
                        <ol class="steps-list">
                            <li><strong>Manter a calma:</strong> O nervosismo pode aumentar a pressão arterial e piorar o sangramento.</li>
                            <li><strong>Sentar-se e inclinar levemente a cabeça para frente:</strong> Isso impede que o sangue escorra pela garganta. Nunca incline a cabeça para trás!</li>
                            <li><strong>Apertar o nariz:</strong> Use o polegar e o indicador para apertar firmemente a parte mole do nariz (logo abaixo da ponte óssea). Mantenha por 10 minutos ininterruptos.</li>
                            <li><strong>Respirar pela boca:</strong> Enquanto aperta o nariz.</li>
                            <li><strong>Aplicar compressa fria:</strong> Coloque uma compressa fria ou gelo envolto em pano na ponte do nariz para ajudar a contrair os vasos sanguíneos.</li>
                            <li><strong>Evitar esforços:</strong> Após o sangramento parar, evite esforços físicos, abaixar a cabeça ou assoar o nariz por algumas horas.</li>
                        </ol>
                    </div>
                    
                    <div class="warning-box">
                        <h4>❌ O Que NÃO Fazer</h4>
                        <ul>
                            <li><strong>Não incline a cabeça para trás:</strong> Isso pode fazer o sangue escorrer pela garganta, causando náuseas ou vómitos</li>
                            <li><strong>Não assoe o nariz imediatamente:</strong> Aguarde pelo menos algumas horas após o sangramento parar</li>
                            <li><strong>Não introduza objetos no nariz:</strong> Evite colocar papel, algodão ou qualquer outro material</li>
                            <li><strong>Não deite-se:</strong> Mantenha-se sentado ou em pé</li>
                            <li><strong>Não solte o nariz antes dos 10 minutos:</strong> Soltar antes pode reiniciar o sangramento</li>
                            <li><strong>Não entre em pânico:</strong> Mantenha a calma para controlar melhor a situação</li>
                        </ul>
                    </div>
                    
                    <div class="alert-box">
                        <h4>🚨 Quando Procurar Atendimento Médico?</h4>
                        <p>Procure ajuda médica imediatamente se:</p>
                        <ul>
                            <li>O sangramento durar mais de 20 minutos mesmo com pressão aplicada</li>
                            <li>O sangramento for muito intenso (quantidade abundante)</li>
                            <li>Houver dificuldade para respirar</li>
                            <li>O sangramento ocorrer após trauma ou pancada na cabeça</li>
                            <li>Sentir tonturas, fraqueza ou desmaio</li>
                            <li>Engolir muito sangue (pode causar vómito)</li>
                            <li>Sangramentos nasais frequentes e recorrentes</li>
                            <li>Tomar medicamentos anticoagulantes</li>
                            <li>Ter distúrbios de coagulação</li>
                            <li>Em crianças muito pequenas</li>
                        </ul>
                    </div>
                    
                    <div class="article-section">
                        <h3>🛡️ Prevenção</h3>
                        <p>Para evitar sangramentos nasais frequentes:</p>
                        <ul>
                            <li><strong>Manter o nariz hidratado:</strong> Use soro fisiológico ou pomadas nasais recomendadas pelo médico</li>
                            <li><strong>Usar humidificador:</strong> Especialmente em ambientes com ar seco</li>
                            <li><strong>Beber bastante água:</strong> Manter-se hidratado ajuda a manter as mucosas saudáveis</li>
                            <li><strong>Evitar coçar ou introduzir objetos no nariz:</strong> Especialmente importante em crianças</li>
                            <li><strong>Manter as unhas curtas:</strong> Reduz o risco de lesões ao coçar</li>
                            <li><strong>Evitar exposição excessiva ao sol:</strong> Use proteção adequada</li>
                            <li><strong>Controlar alergias:</strong> Trate adequadamente rinites e alergias</li>
                            <li><strong>Usar descongestionantes com moderação:</strong> Siga sempre a orientação médica</li>
                            <li><strong>Controlar a pressão arterial:</strong> Mantenha acompanhamento médico regular</li>
                        </ul>
                    </div>
                    
                    <div class="info-box">
                        <h4>💡 Informação Importante</h4>
                        <p>A maioria dos sangramentos nasais é benigna e pode ser facilmente controlada em casa seguindo as orientações corretas. No entanto, sangramentos frequentes ou de difícil controlo devem ser avaliados por um médico otorrinolaringologista.</p>
                        <p style="margin-top: 1rem;"><strong>Atenção especial para:</strong> Pessoas que tomam anticoagulantes (como aspirina ou varfarina) devem informar o médico sobre qualquer sangramento nasal, mesmo que aparentemente simples.</p>
                    </div>
                    
                    <div class="article-section">
                        <h3>👶 Cuidados com Crianças</h3>
                        <p>Sangramentos nasais são comuns em crianças. Orientações especiais:</p>
                        <ul>
                            <li>Mantenha a criança calma explicando que vai ficar bem</li>
                            <li>Ajude-a a sentar-se e inclinar a cabeça para frente</li>
                            <li>Aplique pressão suave mas firme no nariz</li>
                            <li>Distraia a criança com uma história ou vídeo</li>
                            <li>Ensine a não coçar ou introduzir objetos no nariz</li>
                            <li>Se sangramentos forem frequentes, consulte um pediatra</li>
                        </ul>
                    </div>
                    
                    <div style="margin-top: 3rem; padding-top: 2rem; border-top: 2px solid var(--cinza-claro);">
                        <p style="color: var(--texto-secundario); font-size: 0.9rem;">
                            <strong>Fontes:</strong> Sociedade Brasileira de Otorrinolaringologia, American Academy of Otolaryngology, Ministério da Saúde.
                        </p>
                        <p style="color: var(--texto-secundario); font-size: 0.9rem; margin-top: 1rem;">
                            <strong>Última atualização:</strong> 1 de Março de 2026
                        </p>
                    </div>
                `
            }
        };

        // Base de dados de cards informativos
        const infoCardsData = {
            'lavar-maos': {
                title: 'Importância de Lavar as Mãos',
                icon: '🧼',
                image: 'https://images.unsplash.com/photo-1584402710722-32f7be5bc98e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHx3YXNoaW5nJTIwaGFuZHMlMjBoeWdpZW5lJTIwc29hcHxlbnwxfHx8fDE3NzI0NTI1MzJ8MA&ixlib=rb-4.1.0&q=80&w=1080',
                subtitle: 'Pequeno gesto, grande proteção',
                content: `
                    <div class="article-section">
                        <h3>Por Que Lavar as Mãos?</h3>
                        <p>Lavar as mãos é uma das formas mais eficazes de prevenir a propagação de germes e doenças. Nossas mãos entram em contato com inúmeras superfícies ao longo do dia, acumulando bactérias, vírus e outros microrganismos.</p>
                    </div>
                    
                    <div class="article-section">
                        <h3>Doenças que Podem Ser Prevenidas</h3>
                        <p>A lavagem adequada das mãos previne:</p>
                        <ul>
                            <li>Diarreia e infeções gastrointestinais</li>
                            <li>Gripe e resfriados</li>
                            <li>Infeções respiratórias</li>
                            <li>Infeções de pele</li>
                            <li>Conjuntivite</li>
                            <li>Hepatite A</li>
                            <li>Parasitoses intestinais</li>
                        </ul>
                    </div>
                    
                    <div class="article-section">
                        <h3>Quando Lavar as Mãos?</h3>
                        <p>Momentos essenciais para lavar as mãos:</p>
                        <ul>
                            <li>Antes de preparar ou comer alimentos</li>
                            <li>Depois de usar o banheiro</li>
                            <li>Após tocar em lixo ou superfícies sujas</li>
                            <li>Depois de tossir, espirrar ou assoar o nariz</li>
                            <li>Antes e depois de cuidar de ferimentos</li>
                            <li>Após tocar em animais</li>
                            <li>Antes e depois de cuidar de pessoas doentes</li>
                            <li>Ao chegar em casa da rua</li>
                        </ul>
                    </div>
                    
                    <div class="info-box">
                        <h4>Como Lavar Corretamente</h4>
                        <ol class="steps-list">
                            <li>Molhe as mãos com água corrente limpa</li>
                            <li>Aplique sabão suficiente para cobrir toda a superfície das mãos</li>
                            <li>Esfregue as palmas das mãos entre si</li>
                            <li>Esfregue o dorso de cada mão</li>
                            <li>Entrelace os dedos e esfregue os espaços entre eles</li>
                            <li>Esfregue as pontas dos dedos e unhas</li>
                            <li>Esfregue os polegares</li>
                            <li>Continue por pelo menos 20 segundos</li>
                            <li>Enxágue bem com água corrente</li>
                            <li>Seque com toalha limpa ou papel descartável</li>
                        </ol>
                    </div>
                `
            },
            'lavar-alimentos': {
                title: 'Importância de Lavar os Alimentos',
                icon: '🥬',
                image: 'https://images.unsplash.com/photo-1700515268323-92e3b3e5377b?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHx3YXNoaW5nJTIwdmVnZXRhYmxlcyUyMGZydWl0cyUyMGtpdGNoZW58ZW58MXx8fHwxNzcyNDUyNTMyfDA&ixlib=rb-4.1.0&q=80&w=1080',
                subtitle: 'Alimentos limpos, saúde protegida',
                content: `
                    <div class="article-section">
                        <h3>Por Que Lavar os Alimentos?</h3>
                        <p>Frutas, verduras e legumes podem conter resíduos de agrotóxicos, terra, bactérias, parasitas e outros contaminantes. A lavagem adequada é essencial para remover esses elementos e prevenir doenças transmitidas por alimentos.</p>
                    </div>
                    
                    <div class="article-section">
                        <h3>Riscos de Não Lavar</h3>
                        <p>Alimentos mal higienizados podem causar:</p>
                        <ul>
                            <li>Intoxicação alimentar</li>
                            <li>Diarreia e vómitos</li>
                            <li>Parasitoses intestinais</li>
                            <li>Infeções bacterianas</li>
                            <li>Hepatite A</li>
                            <li>Febre tifoide</li>
                        </ul>
                    </div>
                    
                    <div class="article-section">
                        <h3>Como Lavar Corretamente</h3>
                        <ol class="steps-list">
                            <li><strong>Lave as mãos primeiro:</strong> Sempre higienize as mãos antes de manipular alimentos</li>
                            <li><strong>Use água corrente:</strong> Lave frutas e verduras em água corrente limpa</li>
                            <li><strong>Esfregue suavemente:</strong> Use as mãos ou uma escova limpa para remover sujidade</li>
                            <li><strong>Prepare solução sanitizante:</strong> Deixe de molho em solução de água sanitária (1 colher de sopa para cada litro de água) por 15 minutos</li>
                            <li><strong>Enxágue bem:</strong> Lave novamente em água corrente para remover resíduos</li>
                            <li><strong>Seque:</strong> Use pano limpo ou deixe secar naturalmente</li>
                        </ol>
                    </div>
                    
                    <div class="info-box">
                        <h4>Dicas Importantes</h4>
                        <ul>
                            <li>Lave mesmo os alimentos que serão descascados</li>
                            <li>Não use sabão ou detergente em alimentos</li>
                            <li>Folhas devem ser lavadas uma a uma</li>
                            <li>Alimentos pré-lavados também devem ser enxaguados</li>
                            <li>Descarte partes danificadas ou mofadas</li>
                        </ul>
                    </div>
                `
            },
            'tomar-banho': {
                title: 'Importância de Tomar Banho',
                icon: '🚿',
                image: 'https://images.unsplash.com/photo-1758448018619-4cbe2250b9ad?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxzaG93ZXIlMjBiYXRocm9vbSUyMGh5Z2llbmV8ZW58MXx8fHwxNzcyNDUyNTMyfDA&ixlib=rb-4.1.0&q=80&w=1080',
                subtitle: 'Higiene corporal é prevenção',
                content: `
                    <div class="article-section">
                        <h3>Por Que o Banho é Importante?</h3>
                        <p>O banho diário é fundamental para remover sujidade, suor, células mortas e microrganismos que se acumulam na pele ao longo do dia. É uma prática essencial de higiene pessoal que vai além da limpeza, contribuindo para a saúde física e mental.</p>
                    </div>
                    
                    <div class="article-section">
                        <h3>Benefícios do Banho Regular</h3>
                        <ul>
                            <li><strong>Previne doenças de pele:</strong> Dermatites, micoses, infeções bacterianas</li>
                            <li><strong>Reduz odores corporais:</strong> Remove suor e bactérias causadoras de mau cheiro</li>
                            <li><strong>Melhora a circulação:</strong> Água morna estimula o fluxo sanguíneo</li>
                            <li><strong>Relaxa músculos:</strong> Alivia tensões e dores musculares</li>
                            <li><strong>Melhora o bem-estar:</strong> Sensação de limpeza e frescor</li>
                            <li><strong>Ajuda no sono:</strong> Banho morno antes de dormir promove relaxamento</li>
                            <li><strong>Estimula a imunidade:</strong> Pele limpa é barreira eficaz contra infeções</li>
                        </ul>
                    </div>
                    
                    <div class="article-section">
                        <h3>Como Tomar Banho Corretamente</h3>
                        <ol class="steps-list">
                            <li><strong>Molhe todo o corpo:</strong> Use água morna, não muito quente</li>
                            <li><strong>Use sabonete adequado:</strong> Aplique em todo o corpo</li>
                            <li><strong>Dê atenção às áreas de dobras:</strong> Axilas, virilha, entre os dedos</li>
                            <li><strong>Lave bem os pés:</strong> Incluindo entre os dedos</li>
                            <li><strong>Lave o cabelo regularmente:</strong> Conforme necessidade do tipo de cabelo</li>
                            <li><strong>Enxágue completamente:</strong> Remova todo o sabão</li>
                            <li><strong>Seque-se bem:</strong> Especialmente nas dobras da pele</li>
                        </ol>
                    </div>
                    
                    <div class="info-box">
                        <h4>Frequência Recomendada</h4>
                        <p>A frequência ideal varia conforme clima, atividade física e características individuais:</p>
                        <ul>
                            <li>Em climas quentes: pelo menos uma vez ao dia</li>
                            <li>Após atividades físicas: sempre</li>
                            <li>Em crianças: diariamente</li>
                            <li>Em idosos: conforme necessidade, mas no mínimo 3 vezes por semana</li>
                        </ul>
                    </div>
                `
            },
            'dor-cabeca': {
                title: 'Dor de Cabeça: O Que Fazer',
                icon: '🤕',
                image: 'https://images.unsplash.com/photo-1573032780225-a67b1b866312?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxoZWFkYWNoZSUyMG1pZ3JhaW5lJTIwc3RyZXNzJTIwd29tYW58ZW58MXx8fHwxNzcyNDUyNTMzfDA&ixlib=rb-4.1.0&q=80&w=1080',
                subtitle: 'Cuidados simples antes de medicar',
                content: `
                    <div class="article-section">
                        <h3>Causas Comuns</h3>
                        <p>A dor de cabeça pode ter várias causas:</p>
                        <ul>
                            <li>Stress e tensão emocional</li>
                            <li>Desidratação</li>
                            <li>Falta de sono ou sono excessivo</li>
                            <li>Jejum prolongado</li>
                            <li>Má postura</li>
                            <li>Exposição prolongada a telas</li>
                            <li>Problemas de visão não corrigidos</li>
                            <li>Tensão muscular no pescoço</li>
                            <li>Consumo excessivo de cafeína</li>
                        </ul>
                    </div>
                    
                    <div class="article-section">
                        <h3>O Que Fazer</h3>
                        <ol class="steps-list">
                            <li><strong>Descanse em local calmo:</strong> Ambiente tranquilo e silencioso</li>
                            <li><strong>Beba água:</strong> Desidratação é causa frequente de dor de cabeça</li>
                            <li><strong>Evite luz forte:</strong> Fique em ambiente com iluminação suave</li>
                            <li><strong>Faça compressa fria:</strong> Na testa ou nuca</li>
                            <li><strong>Massageie suavemente:</strong> Têmporas e base do crânio</li>
                            <li><strong>Respire profundamente:</strong> Técnicas de relaxamento ajudam</li>
                            <li><strong>Alimente-se:</strong> Se estiver em jejum</li>
                        </ol>
                    </div>
                    
                    <div class="alert-box">
                        <h4>Quando Procurar Médico?</h4>
                        <p>Procure atendimento se a dor de cabeça:</p>
                        <ul>
                            <li>For súbita e muito intensa ("pior dor da vida")</li>
                            <li>Vier acompanhada de febre alta, rigidez no pescoço</li>
                            <li>Causar confusão mental ou alteração de consciência</li>
                            <li>For seguida de convulsões</li>
                            <li>Piorar progressivamente</li>
                            <li>For acompanhada de fraqueza ou dormência</li>
                            <li>Ocorrer após trauma craniano</li>
                            <li>For frequente e intensa</li>
                        </ul>
                    </div>
                    
                    <div class="info-box">
                        <h4>Prevenção</h4>
                        <ul>
                            <li>Mantenha hidratação adequada</li>
                            <li>Durma bem (7-8 horas por noite)</li>
                            <li>Faça refeições regulares</li>
                            <li>Pratique atividade física</li>
                            <li>Gerencie o stress</li>
                            <li>Mantenha boa postura</li>
                            <li>Faça pausas durante trabalho em telas</li>
                        </ul>
                    </div>
                `
            },
            'ferimentos': {
                title: 'Primeiros Socorros para Ferimentos',
                icon: '🩹',
                image: 'https://images.unsplash.com/photo-1758204054683-6e3a7d552bd0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxmaXJzdCUyMGFpZCUyMGJhbmRhZ2UlMjB3b3VuZCUyMGNhcmV8ZW58MXx8fHwxNzcyNDUyNTMzfDA&ixlib=rb-4.1.0&q=80&w=1080',
                subtitle: 'Cuidados imediatos evitam complicações',
                content: `
                    <div class="article-section">
                        <h3>Primeiros Cuidados</h3>
                        <p>Em caso de corte ou ferimento, siga estes passos:</p>
                        <ol class="steps-list">
                            <li><strong>Lave as mãos:</strong> Antes de tocar no ferimento</li>
                            <li><strong>Interrompa o sangramento:</strong> Pressione com pano limpo por alguns minutos</li>
                            <li><strong>Lave o ferimento:</strong> Com água corrente limpa e sabão neutro</li>
                            <li><strong>Desinfetar:</strong> Aplique antisséptico (álcool 70% ou água oxigenada)</li>
                            <li><strong>Cubra:</strong> Use gaze estéril ou curativo limpo</li>
                            <li><strong>Fixe com adesivo:</strong> Mantenha o curativo no lugar</li>
                        </ol>
                    </div>
                    
                    <div class="article-section">
                        <h3>Tipos de Ferimentos</h3>
                        <ul>
                            <li><strong>Corte superficial:</strong> Pode ser tratado em casa</li>
                            <li><strong>Corte profundo:</strong> Procure atendimento médico</li>
                            <li><strong>Abrasão (arranhão):</strong> Limpe bem e proteja</li>
                            <li><strong>Perfuração:</strong> Avalie profundidade, pode necessitar médico</li>
                            <li><strong>Laceração:</strong> Geralmente requer pontos</li>
                        </ul>
                    </div>
                    
                    <div class="alert-box">
                        <h4>Quando Procurar Atendimento Médico?</h4>
                        <ul>
                            <li>Ferimento profundo ou extenso</li>
                            <li>Sangramento que não para após 10 minutos de pressão</li>
                            <li>Ferimento causado por objeto enferrujado ou sujo</li>
                            <li>Mordida de animal</li>
                            <li>Sinais de infeção (vermelhidão, calor, pus, febre)</li>
                            <li>Ferimento no rosto ou articulações</li>
                            <li>Vacinação antitetânica desatualizada</li>
                        </ul>
                    </div>
                    
                    <div class="warning-box">
                        <h4>O Que NÃO Fazer</h4>
                        <ul>
                            <li>Não aplique substâncias caseiras (café, açúcar, manteiga)</li>
                            <li>Não sopre sobre o ferimento</li>
                            <li>Não remova objetos grandes empalados</li>
                            <li>Não ignore sinais de infeção</li>
                        </ul>
                    </div>
                    
                    <div class="info-box">
                        <h4>Cuidados Posteriores</h4>
                        <ul>
                            <li>Troque o curativo diariamente</li>
                            <li>Mantenha o ferimento limpo e seco</li>
                            <li>Observe sinais de infeção</li>
                            <li>Evite molhar excessivamente</li>
                            <li>Não coce ou arranhe a cicatriz</li>
                        </ul>
                    </div>
                `
            },
            'picada-mosquito': {
                title: 'Após Picada de Mosquito',
                icon: '🦟',
                image: 'https://images.unsplash.com/photo-1707943768453-7850f916ebde?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxtb3NxdWl0byUyMGJpdGUlMjBza2luJTIwaW5zZWN0fGVufDF8fHx8MTc3MjQ1MjUzM3ww&ixlib=rb-4.1.0&q=80&w=1080',
                subtitle: 'Alívio e prevenção de complicações',
                content: `
                    <div class="article-section">
                        <h3>Por Que Coça?</h3>
                        <p>Quando um mosquito pica, ele injeta saliva que contém substâncias anticoagulantes. O sistema imunológico reage a essas substâncias, causando:</p>
                        <ul>
                            <li>Coceira intensa</li>
                            <li>Vermelhidão</li>
                            <li>Inchaço localizado</li>
                            <li>Sensação de calor</li>
                        </ul>
                    </div>
                    
                    <div class="article-section">
                        <h3>O Que Fazer</h3>
                        <ol class="steps-list">
                            <li><strong>Lave o local:</strong> Com água e sabão neutro</li>
                            <li><strong>Aplique compressa fria:</strong> Para reduzir inchaço e coceira</li>
                            <li><strong>Use pomada anti-histamínica:</strong> Se disponível e recomendada</li>
                            <li><strong>Evite coçar:</strong> Coçar pode causar infeção</li>
                            <li><strong>Mantenha a área limpa:</strong> Para prevenir infeções secundárias</li>
                        </ol>
                    </div>
                    
                    <div class="article-section">
                        <h3>Remédios Naturais</h3>
                        <p>Algumas opções para aliviar a coceira:</p>
                        <ul>
                            <li>Compressa de gelo</li>
                            <li>Pasta de bicarbonato de sódio com água</li>
                            <li>Aloe vera (babosa)</li>
                            <li>Camomila fria</li>
                        </ul>
                    </div>
                    
                    <div class="alert-box">
                        <h4>Quando Procurar Médico?</h4>
                        <p>Procure atendimento se apresentar:</p>
                        <ul>
                            <li>Reação alérgica grave (dificuldade para respirar, inchaço facial)</li>
                            <li>Febre após picadas</li>
                            <li>Dor de cabeça intensa</li>
                            <li>Náuseas ou vómitos</li>
                            <li>Sinais de infeção (pus, vermelhidão crescente, dor intensa)</li>
                            <li>Sintomas de doenças transmitidas (dengue, paludismo)</li>
                        </ul>
                    </div>
                    
                    <div class="info-box">
                        <h4>Prevenção de Novas Picadas</h4>
                        <ul>
                            <li><strong>Use repelente:</strong> Reaplicar conforme instruções</li>
                            <li><strong>Vista roupas claras e compridas:</strong> Especialmente ao entardecer</li>
                            <li><strong>Use mosquiteiros:</strong> Nas janelas e ao dormir</li>
                            <li><strong>Elimine água parada:</strong> Mosquitos se reproduzem em água</li>
                            <li><strong>Use ventiladores:</strong> Mosquitos têm dificuldade de voar com vento</li>
                            <li><strong>Telas nas janelas:</strong> Impedem entrada de mosquitos</li>
                            <li><strong>Inseticidas:</strong> Use conforme orientação</li>
                        </ul>
                    </div>
                    
                    <div class="warning-box">
                        <h4>Atenção Especial</h4>
                        <p>Em áreas com doenças transmitidas por mosquitos (dengue, paludismo, zika, chikungunya), a prevenção é ainda mais importante. Mantenha-se alerta aos sintomas e procure atendimento médico imediatamente se desenvolver febre após picadas.</p>
                    </div>
                `
            }
        };
    
        // Função de pesquisa
        function handleSearch() {
            
            const searchInput = document.getElementById('searchInput');
            const searchTerm = searchInput.value.trim();
            
            if (searchTerm) {
                alert('Pesquisando por: ' + searchTerm + '\n\nEsta é uma demonstração. Em produção, esta função buscaria artigos relacionados no banco de dados.');
                // Aqui você implementaria a lógica de pesquisa real com Laravel
                // window.location.href = '/pesquisa?q=' + encodeURIComponent(searchTerm);
            } else {
                alert('Por favor, digite algo para pesquisar.');
            }
        }
        
        // Permitir pesquisa ao pressionar Enter
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                handleSearch();
            }
        });
        
        // Navegação para categorias
        function navigateToCategory(category) {
            alert('Navegando para: ' + category.replace('-', ' ').toUpperCase() + '\n\nEsta é uma demonstração. Em produção, você seria redirecionado para a página da categoria.');
            // Em Laravel: window.location.href = '/categoria/' + category;
        }
        
        // Mostrar artigo interno
        function showArticle(event, articleId) {
            event.preventDefault();
            
            const article = articlesData[articleId];
            if (!article) {
                alert('Artigo não encontrado!');
                return;
            }
            
            // Atualizar título e metadados
            document.getElementById('article-title').textContent = article.title;
            document.getElementById('article-meta-header').innerHTML = `
                <span>📅 ${article.date}</span>
                <span>⏱️ ${article.time}</span>
                <span>✓ Revisado por ${article.reviewer}</span>
            `;
            
            // Inserir conteúdo
            document.getElementById('article-content').innerHTML = article.content;
            
            // Esconder conteúdo principal e mostrar artigo
            const mainContent = document.querySelectorAll('.main-content');
            mainContent.forEach(section => {
                section.style.display = 'none';
            });
            
            const articleSection = document.getElementById('artigo-interno');
            articleSection.style.display = 'block';
            
            // Scroll para o topo
            window.scrollTo({ top: 0, behavior: 'smooth' });
            
            // Adicionar botão de voltar
            if (!document.getElementById('btn-voltar')) {
                const btnVoltar = document.createElement('button');
                btnVoltar.id = 'btn-voltar';
                btnVoltar.innerHTML = '← Voltar aos Artigos';
                btnVoltar.className = 'btn btn-outline';
                btnVoltar.style.cssText = 'position: fixed; top: 100px; left: 20px; z-index: 1000; background: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1);';
                btnVoltar.onclick = voltarPrincipal;
                document.body.appendChild(btnVoltar);
            }
        }
        
        // Mostrar card informativo
        function showInfoCard(event, cardId) {
            event.preventDefault();
            
            const card = infoCardsData[cardId];
            if (!card) {
                alert('Informação não encontrada!');
                return;
            }
            
            // Atualizar título e metadados
            document.getElementById('article-title').textContent = card.title;
            document.getElementById('article-meta-header').innerHTML = `
                <span>${card.icon} ${card.subtitle}</span>
            `;
            
            // Inserir conteúdo com imagem
            document.getElementById('article-content').innerHTML = `
                <img src="${card.image}" alt="${card.title}" class="article-main-image">
                ${card.content}
            `;
            
            // Esconder conteúdo principal e mostrar artigo
            const mainContent = document.querySelectorAll('.main-content');
            mainContent.forEach(section => {
                section.style.display = 'none';
            });
            
            const articleSection = document.getElementById('artigo-interno');
            articleSection.style.display = 'block';
            
            // Scroll para o topo
            window.scrollTo({ top: 0, behavior: 'smooth' });
            
            // Adicionar botão de voltar
            if (!document.getElementById('btn-voltar')) {
                const btnVoltar = document.createElement('button');
                btnVoltar.id = 'btn-voltar';
                btnVoltar.innerHTML = '← Voltar';
                btnVoltar.className = 'btn btn-outline';
                btnVoltar.style.cssText = 'position: fixed; top: 100px; left: 20px; z-index: 1000; background: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1);';
                btnVoltar.onclick = voltarPrincipal;
                document.body.appendChild(btnVoltar);
            }
        }
        
        // Voltar para página principal
        function voltarPrincipal() {
            const mainContent = document.querySelectorAll('.main-content');
            mainContent.forEach(section => {
                section.style.display = 'block';
            });
            
            document.getElementById('artigo-interno').style.display = 'none';
            
            const btnVoltar = document.getElementById('btn-voltar');
            if (btnVoltar) {
                btnVoltar.remove();
            }
            
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        
        // Agendar consulta
        function handleConsulta() {
            alert('Funcionalidade de Agendamento\n\nEsta é uma demonstração. Em produção com Laravel, você seria redirecionado para um formulário de agendamento ou sistema de marcação de consultas.');
            // Em Laravel: window.location.href = '/agendar-consulta';
        }
        
        // Animação de fade-in ao rolar a página
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        // Observar cards para animação
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.category-card, .article-card');
            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        });
        
        // Compatibilidade com Laravel - Preparado para CSRF token
        // Se estiver usando formulários, adicione o token CSRF do Laravel:
        // <meta name="csrf-token" content="{{ csrf_token() }}">
        
        // Exemplo de como enviar requisições AJAX com Laravel:
        /*
        function enviarDados() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            fetch('/api/endpoint', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    dados: 'exemplo'
                })
            })
            .then(response => response.json())
            .then(data => console.log(data))
            .catch(error => console.error('Erro:', error));
        }
        */
    </script>

</body>
</html>


@endsection