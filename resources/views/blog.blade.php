@extends("layouts.site")
@section("titulo", "Blog Educativo sobre Saúde")
@section("estilo")

<style>
  
    </style>
</head>
<body>

    <!-- Hero Section -->
    <section class="page-header" id="main-sections">
        <div class="page-header-overlay"></div>
    
        <div class="container">
            <div class="hero-content" style="display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;">
                <div class="hero-text fade-in" style="z-index: 2;">
                    <h1>Centro de Educação em Saúde</h1>
                    <p class="hero-subtitle" style="font-size: 1.45rem;
            color: white;
            margin-bottom: 1rem;
            font-weight: 500;">Informação confiável baseada em orientações médicas internacionais.</p>
                    <p class="hero-description" style="color: white;
            margin-bottom: 2rem;
            line-height: 1.8;
            font-size:19px;">Conteúdos educativos sobre prevenção, doenças comuns, primeiros socorros, nutrição e bem-estar. Acesso à informação de qualidade para cuidar melhor da sua saúde e da sua família.</p>
                    
                   
                </div>
                
                <div class="hero-image fade-in">
                    <img src="imagem/familia.jpg" alt="Profissional de saúde analisando informações médicas">
                </div>
            </div>
        </div>
    </section>

    <!-- Categorias Principais -->
    <section class="main-content">
        <div class="container">
            <h2 class="section-titulo">Categorias Principais</h2>
            <p class="section-subtitle">Explore conteúdos organizados por área para encontrar a informação que você precisa</p>
            
            <div class="categories-grid">
                <div class="category-card">
                    <span class="category-icon"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#e3e3e3"><path d="M694-120.67 552.67-262l47-46.67L694-215l179.33-178.67L920-346 694-120.67Zm-154 40q-110.67 0-185.33-77.66Q280-236 280-344.67v-31q-85.33-12-142.67-77.16Q80-518 80-606.67V-840h120v-40h66.67v146.67H200v-40h-53.33v166.66q0 69.34 48.66 118Q244-440 313.33-440q69.34 0 118-48.67 48.67-48.66 48.67-118v-166.66h-53.33v40H360V-880h66.67v40h120v233.33q0 88.67-57.34 153.84-57.33 65.16-142.66 77.16v31q0 81.67 55.16 139.5Q457-147.33 540-147.33v66.66Z"/></svg></span>
                    <h3>Doenças Comuns</h3>
                    <p>Informações sobre gripe, paludismo, tosse, febre, dor de cabeça e outras condições frequentes.</p>
                </div>
                
                <div class="category-card">
                    <span class="category-icon"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#e3e3e3"><path d="M446.67-806.67V-960h66.66v153.33h-66.66ZM263-752.33 149-867l47-47.67L310.67-800 263-752.33ZM153.33-40q-14.16 0-23.75-9.58Q120-59.17 120-73.33V-396l84-243.1q6-18.23 21.5-29.57Q241-680 260.67-680H370v-76.67h145.67q-23.34 30.67-37.5 66.84-14.17 36.16-16.84 76.5h-198l-59.66 170.66H511q14.33 19.34 32 36.5Q560.67-389 581.33-376H186.67v186.67h586.66V-339q17.67-3.67 34.28-9.1 16.61-5.42 32.39-13.57v288.34q0 14.16-9.58 23.75Q820.83-40 806.67-40h-27.34q-14.16 0-23.75-9.58Q746-59.17 746-73.33v-49.34H213.33v49.34q0 14.16-9.58 23.75Q194.17-40 180-40h-26.67Zm93.34-209.33h120q14.33 0 23.83-9.62 9.5-9.62 9.5-23.83 0-14.22-9.58-23.72-9.59-9.5-23.75-9.5h-120v66.67Zm466.66 0V-316h-120q-14.33 0-23.83 9.62-9.5 9.61-9.5 23.83 0 14.22 9.58 23.72 9.59 9.5 23.75 9.5h120ZM186.67-376v186.67V-376Zm509-134L836-650.67l-32.67-32.66-107.66 107.66-52.34-53L610.67-595l85 85Zm166.5-225.5q57.16 57.17 57.16 138.83 0 81.67-57.16 138.84-57.17 57.16-138.84 57.16-81.66 0-138.83-57.16-57.17-57.17-57.17-138.84 0-81.66 57.17-138.83 57.17-57.17 138.83-57.17 81.67 0 138.84 57.17Z"/></svg></span>
                    <h3>Primeiros Socorros</h3>
                    <p>Como agir em situações de hemorragias, desmaios, queimaduras e engasgamento.</p>
                </div>
                
                <div class="category-card" >
                    <span class="category-icon"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#e3e3e3"><path d="M200-120v-407.33q-33 0-56.5-23.5t-23.5-56.5v-208q0-10 7.33-17.34 7.34-7.33 17.34-7.33t17.66 7.33q7.67 7.34 7.67 17.34v138.66h38.67v-138.66q0-10 7.33-17.34 7.33-7.33 17.33-7.33 10 0 17.34 7.33 7.33 7.34 7.33 17.34v138.66h38.67v-138.66q0-10 7.66-17.34Q312-840 322-840q10 0 17.33 7.33 7.34 7.34 7.34 17.34v208q0 33-23.5 56.5t-56.5 23.5V-120H200Zm280 0v-410q-41.33-22-61.67-62.17Q398-632.33 398-682q0-61 30.83-109.5Q459.67-840 514-840t85.17 48.5Q630-743 630-682q0 49.67-21 89.83Q588-552 546.67-530v410H480Zm209.33 0v-720Q750-836.67 795-794t45 104.67v242.66h-84V-120h-66.67Z"/></svg></span>
                    <h3>Nutrição e Alimentação</h3>
                    <p>Guias sobre alimentação saudável, hidratação adequada e nutrição infantil.</p>
                </div>
                
                <div class="category-card" >
                    <span class="category-icon"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#e3e3e3"><path d="M482.33-275.33ZM120-160v-160q0-83 58.5-141.5T320-520h429q38 0 64.5 26t26.5 64q0 31-19 55.5T773-342l-93 27v174.33q0 17.61-7.87 31.86T651-85.33q-13.43 9.16-29.38 11.25Q605.67-72 589-78.67L382-160H120Zm493.33-133.33H375q-11.67 0-18.83 7.33-7.17 7.33-8.84 16.33-1.66 9 2.96 18.14t15.71 13.2l247.33 97.66v-152.66Zm-426.66 66.66H290q-4.67-8.66-7.33-18.33-2.67-9.67-2.67-20 0-39 28-67t67-28h213l168-46.33q11-3.34 15-10.34t2.33-15.66q-1.66-8.67-7.83-14.84-6.17-6.16-16.5-6.16H320q-55.56 0-94.44 38.89-38.89 38.88-38.89 94.44v93.33ZM287-607q-47-47-47-113t47-113q47-47 113-47t113 47q47 47 47 113t-47 113q-47 47-113 47t-113-47Zm179.17-46.83Q493.33-681 493.33-720t-27.16-66.17Q439-813.33 400-813.33t-66.17 27.16Q306.67-759 306.67-720t27.16 66.17Q361-626.67 400-626.67t66.17-27.16Zm16.16 378.5ZM400-720Z"/></svg></span>
                
                    <h3>Fisioterapia e Corpo</h3>
                    <p>Orientações sobre postura correta, prevenção de dores musculares e reabilitação.</p>
                </div>
                
                <div class="category-card" >
                    <span class="category-icon"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#e3e3e3"><path d="M680-646.67q-21.67 0-37.5-15.83-15.83-15.83-15.83-37.66 0-14.84 14.66-39.84Q656-765 680-790q24 25 38.67 49.93 14.66 24.93 14.66 40.07 0 21.67-15.55 37.5-15.56 15.83-37.78 15.83Zm106.67 280q-38.67 0-66-27.33-27.34-27.33-27.34-66.06 0-32.27 28.67-80.44 28.67-48.17 64.67-89.5Q822-588.67 851-540.65q29 48.02 29 80.65 0 38.67-27.07 66-27.06 27.33-66.26 27.33ZM360-246.67h66.67v-80h80v-66.66h-80v-80H360v80h-80v66.66h80v80ZM226.67-80q-27 0-46.84-19.83Q160-119.67 160-146.67v-340q0-87.33 57-152.12 57-64.8 143-78.54v-96h-86.67V-880h240q30.87 0 58.1 8.83 27.24 8.84 51.24 25.17L574-796.67q-14-8-28.83-12.33-14.84-4.33-31.84-4.33h-86.66v96q86 13.74 143 78.54 57 64.79 57 152.12v340q0 27-19.84 46.84Q587-80 560-80H226.67Zm0-66.67H560v-340q0-69.33-48.67-118-48.66-48.66-117.66-48.66t-118 48.66q-49 48.67-49 118v340Zm0 0H560 226.67Z"/></svg></span>
                    <h3>Higiene e Prevenção</h3>
                    <p>Práticas essenciais de higiene, lavagem das mãos e prevenção de infeções.</p>
                </div>
                
                <div class="category-card" >
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
            <h2 class="section-titulo">Artigos em Destaque</h2>
            <p class="section-subtitle">Conteúdos revisados por profissionais de saúde qualificados</p>
            
            <div class="articles-grid">
                <article class="article-card">
                    <img src="imagem/gripe.jpg" alt="Pessoa com sintomas de gripe" class="article-image">
                    <div class="article-content">
                        <span class="article-label">Doenças Comuns</span>
                        <h3>Gripe: Sintomas, Prevenção e Quando Procurar Atendimento</h3>
                        <p class="article-excerpt">A gripe é uma infeção viral respiratória que afeta milhões de pessoas anualmente. Conheça os sintomas, formas de prevenção e quando é essencial procurar ajuda médica profissional.</p>
                        <div class="verified-badge">
    <span><i class="bi bi-patch-check-fill"></i></span>
    <span>Revisado por profissional de saúde</span>
</div>
                        <div class="article-meta">
                            <span><i class="bi bi-clock"></i> 8 min de leitura</span>
                            <span> Atualizado em 28 Fev 2026</span>
                        </div>
                       <a href="javascript:void(0)" class="btn btn-outline" onclick="showArticle(event, 'gripe')">
    <i class="bi bi-book"></i> Ler artigo
</a>
                    </div>
                </article>
                
                <article class="article-card">
                    <img src="imagem/paludismo.jpg" alt="Prevenção do paludismo" class="article-image">
                    <div class="article-content">
                        <span class="article-label">Doenças Comuns</span>
                        <h3>Paludismo: Como Prevenir e Identificar os Sinais</h3>
                        <p class="article-excerpt">O paludismo (malária) é uma doença grave transmitida por mosquitos. Saiba como se proteger, reconhecer os sintomas iniciais e a importância do diagnóstico precoce.</p>
                        <div class="verified-badge">
    <span><i class="bi bi-patch-check-fill"></i></span>
    <span>Revisado por profissional de saúde</span>
</div>
                        <div class="article-meta">
                          <span><i class="bi bi-clock"></i> 8 min de leitura</span>
                            <span> Atualizado em 25 Fev 2026</span>
                        </div>
                       <a href="javascript:void(0)" class="btn btn-outline" onclick="showArticle(event, 'paludismo')">
    <i class="bi bi-book"></i> Ler artigo
</a>
                    </div>
                </article>
                
                <article class="article-card">
                    <img src="imagem/sangramento.jpg" alt="Primeiros socorros" class="article-image">
                    <div class="article-content">
                        <span class="article-label">Primeiros Socorros</span>
                        <h3>Sangramento Nasal (Epistaxe): O Que Fazer Corretamente</h3>
                        <p class="article-excerpt">O sangramento nasal é comum, mas é importante saber como proceder corretamente. Aprenda as técnicas adequadas e quando buscar atendimento médico de emergência.</p>
                       <div class="verified-badge">
    <span><i class="bi bi-patch-check-fill"></i></span>
    <span>Revisado por profissional de saúde</span>
</div>
                        <div class="article-meta">
                            <span><i class="bi bi-clock"></i> 8 min de leitura</span>
                        <span>Atualizado em 1 Mar 2026</span>
                        </div>
                       <a href="javascript:void(0)" class="btn btn-outline" onclick="showArticle(event, 'epistaxe')">
    <i class="bi bi-book"></i> Ler artigo
</a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- Cards Informativos Educativos -->
    <section style="background: var(--azul-claro);" class="main-content">
        <div class="container">
            <h2 class="section-titulo">Guias Rápidos de Saúde</h2>
            <p class="section-subtitle">Informações práticas e essenciais para o dia a dia</p>
            
            <div class="categories-grid">
                <div class="category-card" onclick="showInfoCard(event, 'lavar-maos')">
                    <span class="category-icon">
                   <img src="imagem/lavar_mao.jpg">     
                    </span>
                    <h3>Importância de Lavar as Mãos</h3>
                    <p>Pequeno gesto, grande proteção. Saiba como a lavagem das mãos previne doenças.</p>
                
                    <h5 class="titulo">Clica neste conteúdo e mantenha-se informado.</h5>
                </div>
                
                <div class="category-card" onclick="showInfoCard(event, 'lavar-alimentos')">
                    <span class="category-icon">
                <img src="imagem/alimentos.jpg">   
                    </span>
                    <h3>Importância de Lavar os Alimentos</h3>
                    <p>Alimentos limpos, saúde protegida. Como higienizar frutas e verduras corretamente.</p>
                    <h5 class="titulo">Clica neste conteúdo e mantenha-se informado.</h5>
                </div>
                
                <div class="category-card" onclick="showInfoCard(event, 'tomar-banho')">
                    <span class="category-icon">
                        <img src="imagem/banho.jpg">   
                    </span>
                    <h3>Importância de Tomar Banho</h3>
                    <p>Higiene corporal é prevenção. Benefícios do banho diário para a saúde.</p>
                    <h5 class="titulo">Clica neste conteúdo e mantenha-se informado.</h5>
                </div>
                
                <div class="category-card" onclick="showInfoCard(event, 'dor-cabeca')">
                    <span class="category-icon">
                        <img src="imagem/cabeca-dor.jpg">   
                    </span>
                    <h3>Dor de Cabeça: O Que Fazer</h3>
                    <p>Cuidados simples antes de medicar. Como aliviar a dor de cabeça naturalmente.</p>
                    <h5 class="titulo">Clica neste conteúdo e mantenha-se informado.</h5>
                </div>
                
                <div class="category-card" onclick="showInfoCard(event, 'ferimentos')">
                    <span class="category-icon">
                        <img src="imagem/socorros.jpg">   
                    </span>
                    <h3>Primeiros Socorros para Ferimentos</h3>
                    <p>Cuidados imediatos evitam complicações. Como tratar cortes e feridas.</p>
                    <h5 class="titulo">Clica neste conteúdo e mantenha-se informado.</h5>
                </div>
                
                <div class="category-card" onclick="showInfoCard(event, 'picada-mosquito')">
                    <span class="category-icon">
                        <img src="imagem/mosquito.jpg">   
                    </span>
                    <h3>Após Picada de Mosquito</h3>
                    <p>Alívio e prevenção de complicações. O que fazer após ser picado.</p>
                    <h5 class="titulo">Clica neste conteúdo e mantenha-se informado.</h5>
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
<script src="{{ asset('blog.js') }}"></script>

</body>
</html>


@endsection