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
                        <h3><i class="bi bi-bookmark-fill"></i> Introdução</h3>
                        <p>A gripe é uma infeção viral aguda do sistema respiratório causada pelo vírus Influenza. É uma das doenças mais comuns em todo o mundo, afetando milhões de pessoas anualmente, especialmente durante os meses mais frios. Embora geralmente seja uma doença autolimitada, a gripe pode levar a complicações graves em grupos de risco.</p>
                    </div>
                    
                    <div class="article-section">
                        <h3><i class="fas fa-lungs-virus"></i> O que é a Gripe?</h3>
                        <p>A gripe é uma infeção causada pelos vírus Influenza dos tipos A, B e, raramente, C. Ao contrário do resfriado comum, a gripe tende a causar sintomas mais intensos e pode resultar em complicações sérias, especialmente em crianças pequenas, idosos, gestantes e pessoas com condições médicas preexistentes.</p>
                        <p>A transmissão ocorre principalmente através de gotículas respiratórias expelidas ao tossir, espirrar ou falar, e também pelo contato com superfícies contaminadas.</p>
                    </div>
                    
                    <div class="article-section">
                        <h3><i class="fas fa-microscope"></i> Causas</h3>
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
                        <h3><i class="fas fa-thermometer-half"></i> Sintomas</h3>
                        <p>Os sintomas da gripe geralmente aparecem de forma súbita, entre 1 a 4 dias após a exposição ao vírus:</p>
                        <ul>
                            <li><i class="fas fa-thermometer-full"></i> Febre alta (geralmente acima de 38°C)</li>
                            <li><i class="fas fa-dumbbell"></i> Dores musculares e corporais intensas</li>
                            <li><i class="fas fa-battery-quarter"></i> Fadiga e fraqueza extremas</li>
                            <li><i class="fas fa-head-side-mask"></i> Congestão nasal e coriza</li>
                            <li><i class="fas fa-head-side-cough"></i> Tosse seca persistente</li>
                            <li><i class="fas fa-head-side-virus"></i> Dor de cabeça</li>
                            <li><i class="fas fa-fa-snowflake"></i> Calafrios</li>
                            <li><i class="fas fa-head-side-cough-slash"></i> Dor de garganta</li>
                            <li><i class="fas fa-fa-eye"></i> Lacrimejamento dos olhos</li>
                        </ul>
                        <p><strong>Nota:</strong> Em crianças, também podem ocorrer náuseas, vómitos e diarreia.</p>
                    </div>
                    
                    <div class="article-section">
                        <h3><i class="fas fa-exclamation-triangle"></i> Fatores de Risco</h3>
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
                        <h3><i class="fas fa-check-circle"></i> O Que Fazer?</h3>
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
                        <h4><i class="fas fa-times-circle"></i> O Que NÃO Fazer</h4>
                        <ul>
                            <li>Não tome antibióticos sem prescrição médica (antibióticos não combatem vírus)</li>
                            <li>Não se automedique com medicamentos antivirais</li>
                            <li>Não force atividades físicas ou trabalho durante o período de doença</li>
                            <li>Não ignore o agravamento dos sintomas</li>
                            <li>Não dê aspirina a crianças e adolescentes com gripe (risco de síndrome de Reye)</li>
                        </ul>
                    </div>
                    
                    <div class="alert-box">
                        <h4><i class="fas fa-user-md"></i> Quando Procurar Atendimento Médico?</h4>
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
                        <h3><i class="fas fa-shield-virus"></i> Prevenção</h3>
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
                        <h4><i class="fas fa-info-circle"></i> Informação Importante</h4>
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
                       <h3><i class="bi bi-bookmark-fill"></i> Introdução</h3>
                        <p>O paludismo, também conhecido como malária, é uma doença infecciosa grave causada por parasitas do género Plasmodium e transmitida através da picada de mosquitos fêmeas infetados do género Anopheles. É uma das principais causas de mortalidade em regiões tropicais e subtropicais, especialmente em África.</p>
                    </div>
                    
                    <div class="article-section">
                       <h3><i class="bi bi-virus"></i> O Que é o Paludismo?</h3>
                        <p>O paludismo é causado por parasitas microscópicos que são transmitidos aos humanos através da picada de mosquitos infetados. O parasita multiplica-se no fígado e depois infeta os glóbulos vermelhos do sangue.</p>
                        <p>Existem cinco espécies de parasitas que causam paludismo em humanos, sendo o Plasmodium falciparum o mais perigoso, responsável pela maioria das mortes relacionadas com a malária.</p>
                    </div>
                    
                    <div class="article-section">
                        <h3><i class="bi bi-arrow-right-circle-fill"></i> Como se Transmite?</h3>
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
                        <h3><i class="bi bi-thermometer-high"></i> Sintomas Principais</h3>
                        <p>Os sintomas geralmente aparecem entre 10 a 15 dias após a picada do mosquito infetado:</p>
                        <ul>
    <li>
        <i class="bi bi-thermometer-high"></i>
        <strong>Febre alta repentina:</strong>
        Frequentemente com picos cíclicos
    </li>

    <li>
        <i class="bi bi-snow"></i>
        <strong>Calafrios intensos:</strong>
        Tremores incontroláveis
    </li>

    <li>
        <i class="bi bi-droplet-fill"></i>
        <strong>Suores profusos:</strong>
        Especialmente à noite
    </li>

    <li>
        <i class="bi bi-headset-vr"></i>
        <strong>Dor de cabeça:</strong>
        Intensa e persistente
    </li>

    <li>
        <i class="bi bi-person-standing"></i>
        <strong>Dores musculares e corporais:</strong>
        Dores generalizadas
    </li>

    <li>
        <i class="bi bi-emoji-dizzy-fill"></i>
        <strong>Náuseas e vómitos:</strong>
        Frequentes
    </li>

    <li>
        <i class="bi bi-battery-half"></i>
        <strong>Fraqueza extrema:</strong>
        Fadiga intensa
    </li>

    <li>
        <i class="bi bi-circle-fill" style="color: #d4b000;"></i>
        <strong>Icterícia:</strong>
        Coloração amarelada da pele e olhos (em casos graves)
    </li>
</ul>
                    </div>
                    
                    <div class="article-section">
                        <h3><i class="bi bi-exclamation-triangle-fill"></i> Fatores de Risco</h3>
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
                        <h3><i class="bi bi-question-circle-fill"></i> O Que Fazer ao Suspeitar de Paludismo?</h3>
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
                        <h4><i class="bi bi-x-circle-fill"></i> O Que NÃO Fazer</h4>
                        <ul>
                            <li>Não ignore os sintomas de febre persistente</li>
                            <li>Não se automedique sem confirmação diagnóstica</li>
                            <li>Não interrompa o tratamento antes do prazo indicado pelo médico</li>
                            <li>Não subestime a gravidade da doença</li>
                            <li>Não espere que os sintomas passem sozinhos</li>
                        </ul>
                    </div>
                    
                    <div class="alert-box">
                        <h4><i class="bi bi-exclamation-octagon-fill"></i> Sinais de Alarme - Procure Urgência Médica!</h4>
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
                        <h3><i class="bi bi-shield-check"></i> Prevenção - Como se Proteger</h3>
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
                        <h4><i class="bi bi-info-circle-fill"></i> Informação Importante</h4>
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
                       <h3><i class="bi bi-bookmark-fill"></i> Introdução</h3>
                        <p>O sangramento nasal, conhecido cientificamente como epistaxe, é uma ocorrência comum que pode afetar pessoas de todas as idades. Embora na maioria dos casos seja inofensivo e fácil de controlar, é importante saber como agir corretamente para estancar o sangramento e quando procurar ajuda médica.</p>
                    </div>
                    
                    <div class="article-section">
                        <h3><i class="bi bi-question-circle-fill"></i> O Que é o Sangramento Nasal?</h3>
                        <p>O sangramento nasal ocorre quando os vasos sanguíneos delicados no interior do nariz se rompem. A maior parte dos sangramentos nasais acontece na parte anterior do nariz (epistaxe anterior), onde os vasos sanguíneos são mais superficiais e frágeis.</p>
                        <p>O interior do nariz é revestido por uma membrana mucosa rica em vasos sanguíneos, tornando-o particularmente vulnerável a sangramentos.</p>
                    </div>
                    
                    <div class="article-section">
                        <h3><i class="bi bi-exclamation-triangle-fill"></i> Causas Comuns</h3>
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
                        <h3><i class="bi bi-check-circle-fill"></i> O Que Fazer - Passos Corretos</h3>
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
                        <h4><i class="bi bi-x-circle-fill"></i>  O Que NÃO Fazer</h4>
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
                        <h4><i class="bi bi-exclamation-triangle-fill"></i> Quando Procurar Atendimento Médico?</h4>
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
                        <h3><i class="bi bi-shield-check"></i> Prevenção</h3>
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
                        <h4><i class="bi bi-info-circle-fill"></i> Informação Importante</h4>
                        <p>A maioria dos sangramentos nasais é benigna e pode ser facilmente controlada em casa seguindo as orientações corretas. No entanto, sangramentos frequentes ou de difícil controlo devem ser avaliados por um médico otorrinolaringologista.</p>
                        <p style="margin-top: 1rem;"><strong>Atenção especial para:</strong> Pessoas que tomam anticoagulantes (como aspirina ou varfarina) devem informar o médico sobre qualquer sangramento nasal, mesmo que aparentemente simples.</p>
                    </div>
                    
                    <div class="article-section">
                        <h3><i class="bi bi-child"></i> Cuidados com Crianças</h3>
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
                icon: '<i class="fas fa-hand-sparkles"></i>',
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
                icon: '<i class="fas fa-apple-alt"></i>',
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
                icon: '🛁',
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

    // Atualizar título
    document.getElementById('article-title').textContent = article.title;

         // Atualizar metadados
    document.getElementById('article-meta-header').innerHTML = `
        <span><i class="bi bi-calendar-event"></i> ${article.date}</span>
        <span><i class="bi bi-clock"></i> ${article.time}</span>
        <span><i class="bi bi-patch-check-fill"></i> Revisado por ${article.reviewer}</span>
    `;

    // Inserir conteúdo
    document.getElementById('article-content').innerHTML = article.content;

    // Esconder conteúdo principal
    const mainContent = document.querySelectorAll('.main-content');

    mainContent.forEach(section => {
        section.style.display = 'none';
    });

     // Mostrar artigo
    const articleSection = document.getElementById('artigo-interno');

    articleSection.style.display = 'block';

    // Scroll correto
    setTimeout(() => {
        articleSection.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }, 50);

     // Botão voltar
    if (!document.getElementById('btn-voltar')) {

        const btnVoltar = document.createElement('button');

        btnVoltar.id = 'btn-voltar';

        btnVoltar.innerHTML = `
            <i class="bi bi-arrow-left"></i> Voltar aos Artigos
        `;

        btnVoltar.className = 'btn btn-outline';
         btnVoltar.style.cssText = `
            position: fixed;
            top: 100px;
            left: 20px;
            z-index: 1000;
            background: white;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        `;

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

    // Atualizar título
    document.getElementById('article-title').textContent = card.title;
           
    // Metadados
    document.getElementById('article-meta-header').innerHTML = `
        <span>
            <i class="bi bi-info-circle-fill"></i>
            ${card.subtitle}
        </span>
    `;

    // Inserir conteúdo
    document.getElementById('article-content').innerHTML = `
        <img src="${card.image}" alt="${card.title}" class="article-main-image">
        ${card.content}
    `;

    // Esconder conteúdo principal
    const mainContent = document.querySelectorAll('.main-content');
 mainContent.forEach(section => {
        section.style.display = 'none';
    });

    // Mostrar conteúdo
    const articleSection = document.getElementById('artigo-interno');

    articleSection.style.display = 'block';

    // Scroll correto
    setTimeout(() => {
        articleSection.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }, 50);
    // Botão voltar
    if (!document.getElementById('btn-voltar')) {

        const btnVoltar = document.createElement('button');

        btnVoltar.id = 'btn-voltar';

        btnVoltar.innerHTML = `
            <i class="bi bi-arrow-left"></i> Voltar
        `;

        btnVoltar.className = 'btn btn-outline';
         btnVoltar.style.cssText = `
            position: fixed;
            top: 100px;
            left: 20px;
            z-index: 1000;
            background: white;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        `;

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

    // Voltar ao topo da página
    document.getElementById('main-sections').scrollIntoView({
        behavior: 'smooth'
    });
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