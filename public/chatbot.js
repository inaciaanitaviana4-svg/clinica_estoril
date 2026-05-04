// ═══════════════════════════════════════════════
//  BASE DE CONHECIMENTO
// ═══════════════════════════════════════════════
const KB = {
  localizacao:{
    keys:['localiz','onde fica','endereço','morada','bairro','golf','estoril','como chegar'],
    reply:`<strong><i class="bi bi-geo-alt-fill"></i> Localização da Clínica Estoril</strong><br><br>
Estamos no <strong>Bairro Golf 2, Vila Estoril, Luanda, Angola</strong>.<br><br>
Pode chegar de táxi, Yango ou transporte próprio. Ficamos numa zona de fácil acesso.<br><br>
<i class="bi bi-question-circle"></i> Precisa de indicações a partir da sua localização?`,
    follow:{q:'O que mais posso ajudá-lo(a)?',opts:[
      {l:'Ver Horários',i:'bi-clock-fill',a:'horarios'},
      {l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'},
    ]}
  },
  horarios:{
    keys:['horário','hora','funciona','abre','fecha','atendimento','quando','aberto','expediente'],
    reply:`<strong><i class="bi bi-clock-fill"></i> Horários de Atendimento</strong><br><br>
<i class="bi bi-calendar-week"></i> <strong>Segunda a Sexta:</strong> 08h00 – 18h00<br>
<i class="bi bi-calendar2-day"></i> <strong>Sábado:</strong> 08h00 – 14h00<br>
<i class="bi bi-moon-stars-fill"></i> <strong>Domingo e Feriados:</strong> Urgências apenas<br><br>
Recomendamos agendamento prévio para garantir atendimento.`,
    follow:{q:'Deseja agendar uma consulta?',opts:[
      {l:'Sim, agendar',i:'bi-calendar-plus-fill',a:'agendamento'},
      {l:'Ver Especialidades',i:'bi-heart-pulse-fill',a:'especialidades'},
    ]}
  },
  agendamento:{
    keys:['agend','marcar','consulta','reservar','marcação','appointment','quero consultar','quero uma consulta'],
    reply:`<strong><i class="bi bi-calendar-check-fill"></i> Agendamento de Consulta</strong><br><br>
Pode agendar de 2 formas:<br><br>
<i class="bi bi-person-lines-fill"></i> <strong>Presencialmente</strong> — Recepção da clínica<br>
<i class="bi bi-pc-display-horizontal"></i> <strong>Sistema online</strong> — Neste sistema de gestão<br><br>
<strong>Documentos necessários:</strong><br>
<ul><li>Nome completo e BI</li><li>Data de nascimento</li><li>Tipo de consulta</li></ul>`,
    follow:{q:'Qual especialidade pretende agendar?',opts:[
      {l:'Clínica Geral',i:'bi-person-heart',a:'esp_geral'},
      {l:'Pediatria',i:'bi-emoji-smile-fill',a:'esp_pediatria'},
      {l:'Ginecologia',i:'bi-gender-female',a:'esp_gineco'},
      {l:'Ver todas',i:'bi-grid-fill',a:'especialidades'},
    ]}
  },
  especialidades:{
    keys:['especialidade','médico','doutor','serviço','área','departamento'],
    reply:`<strong><i class="bi bi-heart-pulse-fill"></i> Especialidades Disponíveis</strong><br><br>
<ul>
<li><i class="bi bi-person-heart"></i> Clínica Geral</li>
<li><i class="bi bi-emoji-smile-fill"></i> Pediatria</li>
<li><i class="bi bi-gender-female"></i> Ginecologia e Obstetrícia</li>
<li><i class="bi bi-heart-fill"></i> Cardiologia</li>
<li><i class="bi bi-bandaid-fill"></i> Ortopedia</li>
<li><i class="bi bi-eye-fill"></i> Oftalmologia</li>
<li><i class="fas fa-spa"></i> Dermalogia</li>
<li><i class="fas fa-dna"></i> Endocrinologia</li>
<li><i class="bi bi-lungs-fill"></i> Pneumologia</li>
<li><i class="bi bi-heart-fill"></i> Gastroenterologia</li>
<li><i class="fas fa-ear-listen"></i> Otorrinolaringologia</li>
<li><i class="fas fa-head-side-virus"></i> Psiquiatria</li>
<li><i class="fas fa-brain"></i> Neurologia</li>
</ul>`,
    follow:{q:'Qual especialidade deseja agendar?',opts:[
      {l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'},
      {l:'Horários',i:'bi-clock-fill',a:'horarios'},
    ]}
  },
  urgencias:{
    keys:['urgência','urgente','emergência','socorro','grave','acidente','inconsciente','sangramento'],
    reply:`<strong><i class="bi bi-exclamation-triangle-fill" style="color:var(--danger)"></i> Serviço de Urgências</strong><br><br>
A Clínica Estoril dispõe de atendimento de urgência.<br><br>
<strong>Em caso de emergência:</strong><br>
<ul>
<li>Dirija-se imediatamente à clínica</li>
<li>Peça ajuda a alguém próximo</li>
<li>Para risco de vida: hospital mais próximo ou urgência hospitalar</li>
</ul>
<strong>Não conduza em estado grave!</strong>`,
    follow:{q:'É uma emergência agora?',opts:[
      {l:'Sim, é urgente',i:'bi-exclamation-triangle-fill',a:'emergencia_agora'},
      {l:'Não, só informação',i:'bi-info-circle-fill',a:'ok'},
    ]}
  },
  exames:{
    keys:['exame','análise','laborat','sangue','urina','raio','ecografia','ultrassom','resultado','biópsia'],
    reply:`<strong><i class="bi bi-clipboard2-pulse-fill"></i> Exames e Análises</strong><br><br>
<i class="bi bi-droplet-fill"></i> Análises ao sangue e urina<br>
<i class="bi bi-soundwave"></i> Ecografia / Ultrassonografia<br>
<i class="bi bi-radioactive"></i> Raio-X<br>
<i class="bi bi-clipboard2-data-fill"></i> Bioquímica e microbiologia<br><br>
<strong>Resultados:</strong> entre 2h e 48h conforme o exame.`,
    follow:{q:'Deseja agendar um exame?',opts:[
      {l:'Agendar exame',i:'bi-calendar-plus-fill',a:'agendamento'},
      {l:'Outros serviços',i:'bi-grid-fill',a:'especialidades'},
    ]}
  },
  pagamentos:{
    keys:['seguro','plano','convênio','preço','custo','valor','pagar','pagamento','kwanza','factura'],
    reply:`<strong><i class="bi bi-credit-card-fill"></i> Pagamentos e Seguros</strong><br><br>
<i class="bi bi-cash-stack"></i> <strong>Dinheiro</strong> (Kwanza — AOA)<br>
<i class="bi bi-bank"></i> <strong>Transferência bancária</strong><br>
<i class="bi bi-shield-check-fill"></i> <strong>Seguros de saúde</strong> (confirme cobertura na recepção)<br><br>
Para valores específicos, contacte a recepção.`,
    follow:{q:'Posso ajudá-lo(a) com mais algo?',opts:[
      {l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'},
      {l:'Contactos',i:'bi-telephone-fill',a:'contactos'},
    ]}
  },
  contactos:{
    keys:['contact','telefone','email','whatsapp','ligar','número','falar','recepção'],
    reply:`<strong><i class="bi bi-telephone-fill"></i> Contactos da Clínica Estoril</strong><br><br>
<i class="bi bi-geo-alt-fill"></i> Bairro Golf 2, Vila Estoril, Luanda<br>
<i class="bi bi-clock-fill"></i> Recepção disponível no horário de atendimento<br><br>
Para contactos directos (telefone/email), consulte a recepção ou a administração da clínica.`,
    follow:{q:'O que mais posso fazer?',opts:[
      {l:'Localização',i:'bi-geo-alt-fill',a:'localizacao'},
      {l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'},
    ]}
  },
  vacinas:{
    keys:['vacin','imunização','imunizar'],
    reply:`<strong><i class="bi bi-bandaid-fill"></i> Vacinação</strong><br><br>
<i class="bi bi-emoji-smile-fill"></i> Calendário vacinal infantil<br>
<i class="bi bi-person-fill"></i> Vacinação de adultos<br>
<i class="bi bi-airplane-fill"></i> Vacinas para viagens internacionais<br>
<i class="bi bi-shield-fill-check"></i> Vacinas sazonais (gripe, etc.)<br><br>
Agende com antecedência para garantir disponibilidade.`,
    follow:{q:'Deseja agendar a vacinação?',opts:[
      {l:'Agendar Vacinação',i:'bi-calendar-plus-fill',a:'agendamento'},
    ]}
  },

  // ── DOENÇAS ──────────────────────────────────
  paludismo:{
    keys:['paludismo','malária','malaria','plasmodium','anopheles','malárico'],
    reply:`<strong><i class="bi bi-bug-fill"></i> Paludismo (Malária)</strong><br><br>
Doença parasitária transmitida pelo mosquito <em>Anopheles</em> — muito prevalente em Angola.<br><br>
<strong>Sintomas:</strong><br>
<ul>
<li>Febre alta com calafrios e suores</li>
<li>Dores de cabeça intensas</li>
<li>Dores musculares e articulares</li>
<li>Náuseas, vómitos, fraqueza extrema</li>
<li>Casos graves: confusão mental, convulsões, icterícia</li>
</ul>
<strong>Prevenção:</strong><br>
<ul>
<li>Repelente e mosquiteiro</li>
<li>Eliminar água parada</li>
<li>Profilaxia antipalúdica (quando indicada)</li>
</ul>
<i class="bi bi-exclamation-triangle-fill" style="color:var(--danger)"></i> <strong>Paludismo não tratado pode ser fatal. Consulte urgentemente!</strong>`,
    follow:{q:'Está com sintomas agora?',opts:[
      {l:'Sim, tenho sintomas',i:'bi-thermometer-high',a:'paludismo_sintomas'},
      {l:'Só quero informação',i:'bi-info-circle-fill',a:'ok'},
      {l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'},
    ]}
  },
  febre:{
    keys:['febre','temperatura alta','febril','arrepio','calafrio','corpo quente'],
    reply:`<strong><i class="bi bi-thermometer-high"></i> Febre</strong><br><br>
Considera-se febre acima de <strong>37,5°C</strong>.<br><br>
<strong>O que fazer:</strong><br>
<ul>
<li>Repouso e hidratação abundante</li>
<li>Paracetamol (conforme bula)</li>
<li>Roupas leves e ambiente fresco</li>
<li>Monitorizar temperatura a cada 2h</li>
</ul>
<strong>Procure médico se:</strong><br>
<ul>
<li>Temperatura acima de 39,5°C</li>
<li>Febre há mais de 3 dias</li>
<li>Rigidez no pescoço ou confusão mental</li>
<li>Dificuldade respiratória</li>
<li>Criança com menos de 3 meses</li>
</ul>`,
    follow:{q:'Há quanto tempo tem febre?',opts:[
      {l:'Menos de 1 dia',i:'bi-clock',a:'febre_recente'},
      {l:'2 a 3 dias',i:'bi-calendar2',a:'febre_media'},
      {l:'Mais de 3 dias',i:'bi-exclamation-triangle-fill',a:'febre_longa'},
    ]}
  },
  hipertensao:{
    keys:['pressão','hipertens','pressão alta','tensão alta','tension alta','pa alta'],
    reply:`<strong><i class="bi bi-heart-fill"></i> Hipertensão Arterial</strong><br><br>
Normal: ~<strong>120/80 mmHg</strong> | Hipertensão: acima de <strong>140/90 mmHg</strong>.<br><br>
<strong>Sintomas (quando presentes):</strong><br>
<ul>
<li>Dor de cabeça intensa (nuca)</li>
<li>Tontura e visão turva</li>
<li>Zumbido nos ouvidos</li>
<li>Sangramento nasal</li>
</ul>
<strong>Controlo:</strong><br>
<ul>
<li>Reduzir sal na alimentação</li>
<li>Exercício regular (30 min/dia)</li>
<li>Evitar tabaco e álcool</li>
<li>Tomar medicação prescrita</li>
<li>Monitorizar a pressão regularmente</li>
</ul>`,
    follow:{q:'Tem hipertensão diagnosticada?',opts:[
      {l:'Sim, já diagnosticada',i:'bi-check-circle-fill',a:'hta_sim'},
      {l:'Nunca medi',i:'bi-question-circle-fill',a:'hta_medir'},
      {l:'Agendar Cardiologia',i:'bi-calendar-plus-fill',a:'agendamento'},
    ]}
  },
  diabetes:{
    keys:['diabetes','açúcar','glicemia','insulina','diabético','glicose','hiperglicemia'],
    reply:`<strong><i class="bi bi-droplet-fill"></i> Diabetes</strong><br><br>
<strong>Tipos:</strong><br>
<ul>
<li><strong>Tipo 1:</strong> produção insuficiente de insulina</li>
<li><strong>Tipo 2:</strong> resistência à insulina (mais comum)</li>
<li><strong>Gestacional:</strong> surge durante a gravidez</li>
</ul>
<strong>Sinais de alerta:</strong><br>
<ul>
<li>Sede excessiva e boca seca</li>
<li>Urinar frequentemente</li>
<li>Fadiga e visão turva</li>
<li>Feridas que demoram a cicatrizar</li>
</ul>
<strong>Controlo:</strong> alimentação saudável, exercício, medicação e monitorização da glicemia.`,
    follow:{q:'Tem diabetes diagnosticada?',opts:[
      {l:'Sim',i:'bi-check-circle-fill',a:'diabetes_sim'},
      {l:'Nunca fiz análises',i:'bi-question-circle-fill',a:'diabetes_rastreio'},
      {l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'},
    ]}
  },
  gripe:{
    keys:['gripe','constip','resfri','influenza','coriza','espirr','nariz entupido','faringite'],
    reply:`<strong><i class="bi bi-wind"></i> Gripe e Constipação</strong><br><br>
<strong>Sintomas:</strong> tosse, coriza, febre ligeira, dores musculares, cansaço.<br><br>
<strong>O que fazer:</strong><br>
<ul>
<li>Repouso e boa hidratação</li>
<li>Paracetamol para febre/dores</li>
<li>Evitar contacto próximo com outras pessoas</li>
<li>Vitamina C e zinco podem ajudar</li>
</ul>
<i class="bi bi-exclamation-triangle-fill" style="color:var(--danger)"></i> Procure médico se: dificuldade respiratória, febre >39°C ou sintomas após 7 dias.`,
    follow:{q:'Os sintomas estão a melhorar?',opts:[
      {l:'Estão a piorar',i:'bi-arrow-down-circle-fill',a:'gripe_piora'},
      {l:'Persistem há dias',i:'bi-dash-circle-fill',a:'gripe_persistente'},
      {l:'Estou bem, obrigado',i:'bi-emoji-smile-fill',a:'ok'},
    ]}
  },
  dorCabeca:{
    keys:['dor de cabe','cefaleia','enxaqueca','migran','cabeça a doer','dor cabeça'],
    reply:`<strong><i class="bi bi-emoji-dizzy-fill"></i> Dor de Cabeça / Cefaleia</strong><br><br>
<strong>Causas comuns:</strong> stress, desidratação, privação de sono, tensão muscular, enxaqueca.<br><br>
<strong>O que fazer:</strong><br>
<ul>
<li>Beber água (desidratação é causa frequente)</li>
<li>Descansar em ambiente tranquilo e escuro</li>
<li>Compressa fria na testa</li>
<li>Analgésico simples (paracetamol)</li>
</ul>
<i class="bi bi-exclamation-triangle-fill" style="color:var(--danger)"></i> <strong>Urgência se:</strong> dor súbita intensa, febre alta, rigidez do pescoço, fraqueza num lado do corpo.`,
    follow:{q:'Como descreve a dor?',opts:[
      {l:'Latejante (um lado)',i:'bi-activity',a:'enxaqueca_info'},
      {l:'Pressão na nuca',i:'bi-arrow-down-circle',a:'cefaleia_tensao'},
      {l:'Muito intensa e súbita',i:'bi-exclamation-triangle-fill',a:'cefaleia_urgente'},
    ]}
  },
  gravidez:{
    keys:['gravidez','grávida','prenatal','pré-natal','gestação','obstetric','esperando bebé'],
    reply:`<strong><i class="bi bi-person-heart"></i> Gravidez e Pré-Natal</strong><br><br>
O acompanhamento pré-natal deve iniciar nas semanas 6–10.<br><br>
<strong>Na Clínica Estoril oferecemos:</strong><br>
<ul>
<li>Consultas de Ginecologia e Obstetrícia</li>
<li>Ecografias obstétricas (1.º, 2.º e 3.º trimestres)</li>
<li>Análises de rotina e rastreio de diabetes gestacional</li>
<li>Vacinação durante a gravidez</li>
</ul>`,
    follow:{q:'Em que trimestre está?',opts:[
      {l:'1.º Trimestre (0–12 sem)',i:'bi-1-circle-fill',a:'grav_t1'},
      {l:'2.º Trimestre (13–26 sem)',i:'bi-2-circle-fill',a:'grav_t2'},
      {l:'3.º Trimestre (27–40 sem)',i:'bi-3-circle-fill',a:'grav_t3'},
    ]}
  },
  pediatria:{
    keys:['criança','pediatr','bebé','infan','recém-nasc','filho','filha','neonato'],
    reply:`<strong><i class="bi bi-emoji-smile-fill"></i> Pediatria</strong><br><br>
Especialistas em saúde infantil em todas as fases:<br><br>
<ul>
<li>Consultas de crescimento e desenvolvimento</li>
<li>Vacinação infantil (calendário nacional)</li>
<li>Doenças infecciosas infantis</li>
<li>Neonatologia e acompanhamento nutricional</li>
</ul>`,
    follow:{q:'Qual é a idade do seu filho/filha?',opts:[
      {l:'Recém-nascido (0–1 mês)',i:'bi-asterisk',a:'pediatria_neo'},
      {l:'Bebé (1–12 meses)',i:'bi-emoji-smile',a:'pediatria_bebe'},
      {l:'Criança (1–12 anos)',i:'bi-person-fill',a:'pediatria_crianca'},
    ]}
  },


      cardiologia:{
    keys:['coração','Card','cardio','pressão','agendar','colestorel','cardíaca','Cardiologia'],
    reply:`<i class="bi bi-heart-fill"></i> Cardiologia</strong><br><br>
Cuidamos da sua saúde cardíaca, garantindo melhor funcionamento do seu coração e vasos sanguíneos<br><br>
O que o cardiologista trata:<br><br>
<ul>
<li><strong> Doença do coração</strong></li>
<li><strong>Pressão Alta</strong></li>
<li><strong> Check-up do coração</strong></li>
<li><strong> Cirurgia</strong></li>
</ul>`,
    follow:{q:'Gostaria de agendar uma consulta?',opts:[
       {l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'},
      {l:'Horários',i:'bi-clock-fill',a:'horarios'},
    ]}
  },

  tuberculose:{
    keys:['tuberculose','tb','bacilo','koch','tosse com sangue','hemoptise'],
    reply:`<strong><i class="bi bi-lungs-fill"></i> Tuberculose (TB)</strong><br><br>
Doença infecciosa pulmonar causada pelo <em>Mycobacterium tuberculosis</em>.<br><br>
<strong>Sintomas:</strong><br>
<ul>
<li>Tosse persistente há mais de 3 semanas</li>
<li>Tosse com sangue (hemoptise)</li>
<li>Perda de peso inexplicável</li>
<li>Suores nocturnos e febre vespertina</li>
<li>Fadiga extrema</li>
</ul>
<strong>Transmissão:</strong> ar (tosse/espirro de pessoa infectada).<br>
<strong>Tratamento:</strong> antibióticos por 6 meses (curável!). Gratuito em Angola.`,
    follow:{q:'Tem tosse persistente há mais de 3 semanas?',opts:[
      {l:'Sim',i:'bi-check-circle-fill',a:'tb_suspeita'},
      {l:'Não',i:'bi-x-circle-fill',a:'ok'},
      {l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'},
    ]}
  },
  covid:{
    keys:['covid','corona','coronavirus','sars'],
    reply:`<strong><i class="bi bi-virus2"></i> COVID-19</strong><br><br>
<strong>Sintomas comuns:</strong><br>
<ul>
<li>Febre, tosse seca, cansaço</li>
<li>Perda de olfacto e/ou paladar</li>
<li>Dores musculares</li>
<li>Dificuldade respiratória (casos moderados/graves)</li>
</ul>
<strong>O que fazer:</strong><br>
<ul>
<li>Isolar-se e contactar o médico</li>
<li>Repouso e boa hidratação</li>
<li>Urgência se dificuldade respiratória grave</li>
</ul>
<strong>Prevenção:</strong> vacinação, higiene das mãos, ventilação dos espaços.`,
    follow:{q:'Tem sintomas activos de COVID-19?',opts:[
      {l:'Sim, tenho sintomas',i:'bi-thermometer-high',a:'covid_activo'},
      {l:'Só informação',i:'bi-info-circle-fill',a:'ok'},
    ]}
  },
  hiv:{
    keys:['hiv','sida','aids','imunodeficiência','vih'],
    reply:`<strong><i class="bi bi-shield-exclamation"></i> VIH/SIDA</strong><br><br>
O VIH afecta o sistema imunitário. Sem tratamento, evolui para SIDA.<br><br>
<strong>Transmissão:</strong><br>
<ul>
<li>Relações sexuais desprotegidas</li>
<li>Sangue contaminado</li>
<li>Mãe para filho (gravidez/parto/amamentação)</li>
</ul>
<strong>Não se transmite por:</strong> abraços, apertos de mão, ar, tosse.<br><br>
<strong>Tratamento:</strong> TARV — controla o vírus e permite vida normal.<br>
<strong>Prevenção:</strong> preservativo, rastreio regular, PrEP se indicado.`,
    follow:{q:'Deseja saber mais?',opts:[
      {l:'Fazer rastreio',i:'bi-search-heart-fill',a:'hiv_rastreio'},
      {l:'Sobre TARV',i:'bi-capsule',a:'hiv_tarv'},
      {l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'},
    ]}
  },
  anemia:{
    keys:['anemia','hemoglobin','sangue fraco','pálido','pálida','palidez','drepanocitose','falciforme'],
    reply:`<strong><i class="bi bi-droplet-half"></i> Anemia</strong><br><br>
Redução dos glóbulos vermelhos ou hemoglobina no sangue.<br><br>
<strong>Tipos comuns em Angola:</strong><br>
<ul>
<li>Anemia ferropénica (falta de ferro)</li>
<li>Anemia falciforme / Drepanocitose (hereditária)</li>
<li>Anemia por deficiência de vitamina B12</li>
</ul>
<strong>Sintomas:</strong> palidez, cansaço, falta de ar, tonturas, palpitações.<br>
<strong>Diagnóstico:</strong> hemograma completo.`,
    follow:{q:'Tem historial de anemia falciforme?',opts:[
      {l:'Sim',i:'bi-check-circle-fill',a:'falciforme_info'},
      {l:'Não sei',i:'bi-question-circle-fill',a:'anemia_rastreio'},
      {l:'Não',i:'bi-x-circle-fill',a:'ok'},
    ]}
  },
  dorCostas:{
    keys:['dor costas','lombar','coluna','hérnia','dorsal','lombalgia','ciática','cervical'],
    reply:`<strong><i class="bi bi-person-arms-up"></i> Dor nas Costas / Lombalgia</strong><br><br>
<strong>Causas frequentes:</strong><br>
<ul>
<li>Postura incorrecta e trabalho sedentário</li>
<li>Esforço físico excessivo</li>
<li>Hérnia discal e ciática</li>
<li>Contractura muscular</li>
</ul>
<strong>O que ajuda:</strong><br>
<ul>
<li>Calor local (almofada térmica)</li>
<li>Anti-inflamatórios (orientação médica)</li>
<li>Fisioterapia e exercício regular</li>
<li>Postura correta ao sentar</li>
</ul>`,
    follow:{q:'A dor irradia para as pernas?',opts:[
      {l:'Sim, desce pela perna',i:'bi-arrow-down',a:'ciatica_info'},
      {l:'Só nas costas',i:'bi-dash',a:'lombalgia_info'},
      {l:'Agendar Ortopedia',i:'bi-calendar-plus-fill',a:'agendamento'},
    ]}
  },
  asma:{
    keys:['asma','bronquite','falta de ar','respirar','dificuldade respirat','sibilo','pieira'],
    reply:`<strong><i class="bi bi-lungs-fill"></i> Asma e Dificuldade Respiratória</strong><br><br>
Doença inflamatória crónica das vias aéreas.<br><br>
<strong>Sintomas:</strong><br>
<ul>
<li>Pieira (apito no peito)</li>
<li>Falta de ar (especialmente à noite ou no exercício)</li>
<li>Tosse noturna persistente</li>
<li>Aperto no peito</li>
</ul>
<strong>Desencadeantes:</strong> pó, pólenes, pelo de animais, fumo, ar frio.<br>
<strong>Tratamento:</strong> inaladores de alívio e manutenção, sob prescrição médica.<br><br>
<i class="bi bi-exclamation-triangle-fill" style="color:var(--danger)"></i> Crise respiratória grave = emergência médica.`,
    follow:{q:'Tem asma diagnosticada?',opts:[
      {l:'Sim, tenho inalador',i:'bi-check-circle-fill',a:'asma_sim'},
      {l:'Nunca diagnosticada',i:'bi-question-circle-fill',a:'asma_avaliar'},
      {l:'Crise agora!',i:'bi-exclamation-triangle-fill',a:'emergencia_agora'},
    ]}
  },
  diarreia:{
    keys:['diarreia','desinteria','fezes','gastroenterite','vómito','vomitar','náusea','enjoo'],
    reply:`<strong><i class="bi bi-droplet-half"></i> Diarreia e Gastroenterite</strong><br><br>
<strong>O que fazer:</strong><br>
<ul>
<li>Hidratação intensa — soro oral (SRO) + água</li>
<li>Dieta leve (arroz, banana, torrada, frango cozido)</li>
<li>Evitar laticínios e alimentos gordurosos</li>
<li>Higiene das mãos rigorosa</li>
</ul>
<strong>Procure médico se:</strong><br>
<ul>
<li>Diarreia com sangue</li>
<li>Febre alta associada</li>
<li>Mais de 6 episódios em 24h</li>
<li>Sinais de desidratação (boca seca, urina escura, tonturas)</li>
</ul>`,
    follow:{q:'Há sinais de desidratação?',opts:[
      {l:'Sim (boca seca, tontura)',i:'bi-exclamation-triangle-fill',a:'desidratacao_urgente'},
      {l:'Não, bebo bem',i:'bi-check-circle-fill',a:'diarreia_leve'},
    ]}
  },
  dorEstomago:{
    keys:['dor estomago','gastrite','úlcera','ulcera','refluxo','azia','barriga','cólica','abdomen','epigastric'],
    reply:`<strong><i class="bi bi-emoji-frown-fill"></i> Dor Abdominal / Gastrite</strong><br><br>
<strong>Causas comuns:</strong><br>
<ul>
<li>Gastrite e úlcera péptica</li>
<li>Refluxo gastroesofágico (DRGE)</li>
<li>Infecção por <em>H. pylori</em></li>
<li>Colite e síndrome do intestino irritável</li>
</ul>
<strong>O que evitar:</strong> anti-inflamatórios sem protecção gástrica, café, álcool, alimentos picantes, tabaco.`,
    follow:{q:'A dor é constante ou em crises?',opts:[
      {l:'Constante e forte',i:'bi-exclamation-triangle-fill',a:'dor_urgente'},
      {l:'Em crises / passa',i:'bi-arrow-repeat',a:'gastrite_cronica'},
      {l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'},
    ]}
  },
  saudeMental:{
    keys:['depressão','ansiedade','stress','saúde mental','triste','psicolog','psiquiatr','pânico','insônia','insonia','dormir'],
    reply:`<strong><i class="bi bi-brain"></i> Saúde Mental</strong><br><br>
A saúde mental é tão importante quanto a física.<br><br>
<strong>Sinais de depressão:</strong><br>
<ul>
<li>Tristeza persistente há mais de 2 semanas</li>
<li>Perda de interesse em actividades</li>
<li>Insónia ou sono excessivo</li>
<li>Fadiga e dificuldade de concentração</li>
</ul>
<strong>Sinais de ansiedade:</strong><br>
<ul>
<li>Preocupação excessiva e incontrolável</li>
<li>Palpitações, sudorese, tremores</li>
<li>Ataques de pânico</li>
</ul>
Procure ajuda — o tratamento é eficaz!`,
    follow:{q:'Há quanto tempo sente estes sintomas?',opts:[
      {l:'Algumas semanas',i:'bi-calendar2',a:'mental_medio'},
      {l:'Meses ou mais',i:'bi-calendar-range-fill',a:'mental_longo'},
      {l:'Preciso de ajuda agora',i:'bi-exclamation-circle-fill',a:'mental_urgente'},
    ]}
  },
  dst:{
    keys:['ist','dst','gonorreia','sífilis','clamídia','herpes','sexualmente transmiss','hpv'],
    reply:`<strong><i class="bi bi-shield-exclamation"></i> Infecções Sexualmente Transmissíveis (IST)</strong><br><br>
<strong>IST comuns:</strong> Sífilis, Gonorreia, Clamídia, Herpes genital, HPV, VIH.<br><br>
<strong>Sinais de alerta:</strong><br>
<ul>
<li>Secreção incomum</li>
<li>Feridas ou úlceras nos genitais</li>
<li>Ardor ao urinar</li>
<li>Dor pélvica ou testicular</li>
<li><strong>Atenção:</strong> muitas IST são assintomáticas!</li>
</ul>
<strong>Prevenção:</strong> preservativo, rastreio regular, vacina HPV.<br>
<strong>Tratamento:</strong> eficaz se iniciado cedo.`,
    follow:{q:'Deseja agendar consulta confidencial?',opts:[
      {l:'Sim, agendar',i:'bi-calendar-plus-fill',a:'agendamento'},
      {l:'Mais informações',i:'bi-info-circle-fill',a:'ok'},
    ]}
  },
  pressaoBaixa:{
    keys:['pressão baixa','hipotens','tensão baixa','tontura ao levantar','desmaio','lipotimia'],
    reply:`<strong><i class="bi bi-arrow-down-circle-fill"></i> Hipotensão (Pressão Baixa)</strong><br><br>
Considera-se hipotensão abaixo de <strong>90/60 mmHg</strong>.<br><br>
<strong>Sintomas:</strong> tontura ao levantar, visão turva momentânea, desmaio, cansaço.<br><br>
<strong>O que fazer:</strong><br>
<ul>
<li>Levantar-se devagar da cama</li>
<li>Aumentar ingestão de água e sal (com orientação)</li>
<li>Meias de compressão se indicado</li>
<li>Refeições pequenas e frequentes</li>
</ul>`,
    follow:{q:'Tem tonturas frequentes?',opts:[
      {l:'Sim, frequentemente',i:'bi-exclamation-circle-fill',a:'tontura_avaliacao'},
      {l:'Às vezes',i:'bi-dash-circle',a:'ok'},
      {l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'},
    ]}
  },
  nutricao:{
    keys:['nutrição','alimentação','dieta','obesidade','peso','emagrecer','nutricionista'],
    reply:`<strong><i class="bi bi-egg-fried"></i> Nutrição e Alimentação Saudável</strong><br><br>
<strong>Princípios básicos:</strong><br>
<ul>
<li>Frutas e vegetais diariamente</li>
<li>Preferir cereais integrais</li>
<li>Reduzir sal, açúcar e gorduras saturadas</li>
<li>Beber 1,5–2 litros de água por dia</li>
<li>Evitar ultraprocessados e refrigerantes</li>
<li>Fazer 5–6 refeições pequenas ao dia</li>
</ul>`,
    follow:{q:'Tem algum objectivo específico?',opts:[
      {l:'Perder peso',i:'bi-arrow-down-circle',a:'nutricao_peso'},
      {l:'Controlar diabetes',i:'bi-droplet-fill',a:'nutricao_diabetes'},
      {l:'Consulta nutricional',i:'bi-calendar-plus-fill',a:'agendamento'},
    ]}
  },
  hipercolesterolemia:{
    keys:['colesterol','triglicérid','dislipidemia','gordura sangue'],
    reply:`<strong><i class="bi bi-droplet-fill"></i> Colesterol e Dislipidemia</strong><br><br>
Colesterol LDL elevado aumenta o risco cardiovascular.<br><br>
<strong>Valores de referência:</strong><br>
<ul>
<li>Colesterol total: abaixo de 200 mg/dL</li>
<li>LDL ("mau"): abaixo de 130 mg/dL</li>
<li>HDL ("bom"): acima de 40 mg/dL (homens) / 50 mg/dL (mulheres)</li>
<li>Triglicéridos: abaixo de 150 mg/dL</li>
</ul>
<strong>Controlo:</strong> alimentação pobre em gorduras saturadas, exercício físico, medicação se indicada (estatinas).`,
    follow:{q:'Já fez análises de colesterol?',opts:[
      {l:'Sim, estão altos',i:'bi-exclamation-circle-fill',a:'agendamento'},
      {l:'Nunca fiz',i:'bi-question-circle-fill',a:'agendamento'},
    ]}
  },
  alzheimer:{
    keys:['alzheimer','demência','demencia','esquecimento','memória','mem'],
    reply:`<strong><i class="bi bi-brain"></i> Alzheimer e Demências</strong><br><br>
O Alzheimer é a forma mais comum de demência, caracterizada pela perda progressiva de memória e função cognitiva.<br><br>
<strong>Sinais precoces:</strong><br>
<ul>
<li>Esquecimento frequente de eventos recentes</li>
<li>Dificuldade em encontrar palavras</li>
<li>Desorientação em locais conhecidos</li>
<li>Mudanças de personalidade e humor</li>
</ul>
O diagnóstico precoce é fundamental. Consulte um neurologista.`,
    follow:{q:'Deseja agendar consulta de neurologia?',opts:[
      {l:'Sim, agendar',i:'bi-calendar-plus-fill',a:'agendamento'},
      {l:'Mais informação',i:'bi-info-circle-fill',a:'ok'},
    ]}
  },
  saudacao:{
    keys:['olá','ola','bom dia','boa tarde','boa noite','hello','hi','oi','hey'],
    reply:`Olá! Bem-vindo(a) ao Assistente Virtual da <strong>Clínica Estoril</strong>!<br><br>
Estou aqui para ajudá-lo(a) com:<br>
<ul>
<li><i class="bi bi-hospital-fill"></i> Informações sobre a Clínica Estoril</li>
<li><i class="bi bi-calendar-check-fill"></i> Agendamento de consultas</li>
<li><i class="bi bi-heart-pulse-fill"></i> Questões e orientações de saúde</li>
</ul>
Como posso ajudá-lo(a) hoje?`,
    follow:{q:null,opts:[
      {l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'},
      {l:'Localização',i:'bi-geo-alt-fill',a:'localizacao'},
      {l:'Horários',i:'bi-clock-fill',a:'horarios'},
      {l:'Questão de Saúde',i:'bi-heart-pulse-fill',a:'triagem'},
    ]}
  },
  obrigado:{
    keys:['obrigad','obg','grato','grata','thank','muito obrigado'],
    reply:`De nada! É um prazer ajudá-lo(a).<br><br>
Se tiver mais alguma questão, estarei sempre disponível. Cuide bem da sua saúde! <i class="bi bi-heart-fill" style="color:var(--primary-light)"></i>`,
    follow:null
  },
  despedida:{
    keys:['tchau','adeus','até logo','bye','xau','até amanhã'],
    reply:`Até logo! Obrigado por contactar a <strong>Clínica Estoril</strong>.<br><br>
Cuide-se bem. A sua saúde é a nossa prioridade! <i class="bi bi-heart-fill" style="color:var(--primary-light)"></i>`,
    follow:null
  },
};

// Respostas de acções/follow-up
const ACTIONS = {
  triagem:{r:`<i class="bi bi-heart-pulse-fill"></i> Vou ajudá-lo(a). Qual é a sua preocupação de saúde?`,opts:[
    {l:'Febre / Paludismo',i:'bi-thermometer-high',a:'febre'},
    {l:'Dores',i:'bi-emoji-frown-fill',a:'dor_menu'},
    {l:'Respiratório',i:'bi-lungs-fill',a:'asma'},
    {l:'Digestivo',i:'bi-droplet-half',a:'diarreia'},
    {l:'Pressão / Diabetes',i:'bi-heart-fill',a:'hipertensao'},
    {l:'Saúde Mental',i:'bi-brain',a:'saudeMental'},
  ]},
  dor_menu:{r:`Em que parte do corpo sente dor?`,opts:[
    {l:'Cabeça',i:'bi-emoji-dizzy-fill',a:'dorCabeca'},
    {l:'Costas / Coluna',i:'bi-person-arms-up',a:'dorCostas'},
    {l:'Estômago / Barriga',i:'bi-emoji-frown-fill',a:'dorEstomago'},
    {l:'Peito / Coração',i:'bi-heart-fill',a:'dor_peito'},
    {l:'Outro',i:'bi-three-dots',a:'dor_outro'},
  ]},
  dor_peito:{r:`<i class="bi bi-exclamation-triangle-fill" style="color:var(--danger)"></i> <strong>Dor no peito pode ser sinal de urgência cardíaca.</strong><br><br>
Se a dor é intensa, irradia para o braço esquerdo ou mandíbula, com sudorese e dificuldade respiratória — procure urgência IMEDIATAMENTE!`,opts:[
    {l:'É urgente, ir agora',i:'bi-exclamation-triangle-fill',a:'emergencia_agora'},
    {l:'Dor leve / crónica',i:'bi-dash-circle',a:'agendamento'},
  ]},
  dor_outro:{r:`Para dores noutras partes do corpo, agende uma consulta de Clínica Geral. O médico avaliará e encaminhará se necessário.`,opts:[
    {l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'},
  ]},
  emergencia_agora:{r:`<i class="bi bi-exclamation-octagon-fill" style="color:var(--danger); font-size:20px"></i> <strong>EMERGÊNCIA</strong><br><br>
Dirija-se IMEDIATAMENTE à:<br>
<strong>Clínica Estoril — Bairro Golf 2, Vila Estoril, Luanda.</strong><br><br>
Se não conseguir deslocar-se, peça ajuda a alguém próximo!`,opts:[]},
  paludismo_sintomas:{r:`Com sintomas de paludismo, vá à Clínica Estoril o mais rápido possível.<br><br>
<strong>Enquanto espera:</strong><br>
<ul><li>Beba bastante água</li><li>Não tome antipalúdicos sem prescrição</li><li>Descanse</li></ul>
O diagnóstico é feito por análise de gota espessa ao sangue.`,opts:[{l:'Ver Localização',i:'bi-geo-alt-fill',a:'localizacao'}]},
  febre_recente:{r:`Febre com menos de 24h: monitorize, hidrate-se e tome paracetamol. Se desenvolver calafrios intensos, suores e dores musculares, suspeite de paludismo e consulte médico.`,opts:[{l:'Sintomas de Paludismo',i:'bi-bug-fill',a:'paludismo'}]},
  febre_media:{r:`Febre há 2–3 dias requer avaliação médica. Pode ser paludismo, infecção bacteriana ou viral. O diagnóstico laboratorial é essencial.`,opts:[{l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  febre_longa:{r:`<i class="bi bi-exclamation-triangle-fill" style="color:var(--danger)"></i> Febre há mais de 3 dias é sinal de alarme. Consulte médico <strong>hoje</strong> na Clínica Estoril.`,opts:[{l:'Ver Localização',i:'bi-geo-alt-fill',a:'localizacao'}]},
  hta_sim:{r:`Com hipertensão diagnosticada, mantenha o acompanhamento regular. Reveja a medicação e os valores de pressão com o seu cardiologista na Clínica Estoril.`,opts:[{l:'Agendar Cardiologia',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  hta_medir:{r:`Se nunca mediu a pressão arterial, faça-o! A hipertensão muitas vezes não dá sintomas. Pode vir à Clínica Estoril durante o horário de atendimento.`,opts:[{l:'Ver Horários',i:'bi-clock-fill',a:'horarios'}]},
  gripe_piora:{r:`Se os sintomas de gripe estão a piorar (especialmente dificuldade respiratória ou febre muito alta), procure atendimento médico hoje.`,opts:[{l:'Agendar Urgência',i:'bi-exclamation-triangle-fill',a:'urgencias'}]},
  gripe_persistente:{r:`Sintomas persistentes há mais de 7 dias devem ser avaliados — pode ser infecção bacteriana secundária que requer antibióticos.`,opts:[{l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  enxaqueca_info:{r:`Dor latejante num lado da cabeça é típica de enxaqueca. Ambiente escuro, silencioso e compressa fria podem ajudar. Para crises frequentes, consulte um neurologista.`,opts:[{l:'Agendar Neurologia',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  cefaleia_tensao:{r:`Dor em pressão na nuca é típica de cefaleia tensional (stress, postura). Stretching do pescoço, calor local e relaxamento ajudam. Se frequente, consulte o médico.`,opts:[]},
  cefaleia_urgente:{r:`<i class="bi bi-exclamation-triangle-fill" style="color:var(--danger)"></i> Dor de cabeça súbita e muito intensa pode ser emergência neurológica. Procure atendimento IMEDIATAMENTE!`,opts:[{l:'Urgências',i:'bi-exclamation-triangle-fill',a:'urgencias'}]},
  grav_t1:{r:`1.º trimestre: confirme a gravidez por ecografia, inicie ácido fólico, faça análises de rastreio e evite medicamentos sem prescrição. Agende já a sua consulta de obstetrícia!`,opts:[{l:'Agendar Obstetrícia',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  grav_t2:{r:`2.º trimestre: ecografia morfológica (semanas 20–22), rastreio de diabetes gestacional e análises de rotina. Cuide-se bem!`,opts:[{l:'Agendar Obstetrícia',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  grav_t3:{r:`3.º trimestre: consultas mais frequentes, monitorização do bebé e preparação para o parto. Não falte a nenhuma consulta!`,opts:[{l:'Agendar Obstetrícia',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  tb_suspeita:{r:`Com tosse persistente há mais de 3 semanas, faça avaliação médica urgente. O diagnóstico inclui baciloscopias, cultura e Raio-X torácico. Tratamento gratuito em Angola!`,opts:[{l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  covid_activo:{r:`Com sintomas de COVID-19: isole-se, use máscara e hidrate-se. Contacte o médico para orientação terapêutica. Urgência se dificuldade respiratória grave.`,opts:[{l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  hiv_rastreio:{r:`O rastreio de VIH é simples, rápido e confidencial — feito por análise ao sangue. Recomenda-se a todas as pessoas em situações de risco. Resultado precoce salva vidas!`,opts:[{l:'Agendar Análises',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  hiv_tarv:{r:`A TARV controla o VIH a níveis indetectáveis, protegendo a saúde e impedindo a transmissão. Deve ser tomada diariamente, sem falhar. Consulte o médico para o regime adequado.`,opts:[]},
  falciforme_info:{r:`A drepanocitose é hereditária e comum em Angola. As crises vaso-oclusivas precisam de atendimento médico urgente. Acompanhamento regular por hematologista é essencial.`,opts:[{l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  anemia_rastreio:{r:`Para saber se tem anemia, basta um hemograma completo. Rápido e acessível na Clínica Estoril!`,opts:[{l:'Agendar Análises',i:'bi-clipboard2-pulse-fill',a:'agendamento'}]},
  ciatica_info:{r:`Dor que desce pela perna pode ser ciática. Fisioterapia e anti-inflamatórios ajudam. Evite ficar muito tempo sentado(a). Consulte ortopedia se persistir.`,opts:[{l:'Agendar Ortopedia',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  lombalgia_info:{r:`Para dor nas costas localizada: calor local, postura correcta e exercício (natação, caminhada) são os melhores aliados. Se não melhorar em 2 semanas, consulte um ortopedista.`,opts:[]},
  desidratacao_urgente:{r:`<i class="bi bi-exclamation-triangle-fill" style="color:var(--danger)"></i> Desidratação requer atenção médica urgente, especialmente em crianças e idosos. Vá à Clínica Estoril imediatamente e continue a tentar beber soro oral.`,opts:[{l:'Ver Localização',i:'bi-geo-alt-fill',a:'localizacao'}]},
  diarreia_leve:{r:`Continue com hidratação abundante (soro oral + água) e dieta leve. Normalmente melhora em 2–3 dias. Se piorar, consulte médico.`,opts:[]},
  asma_sim:{r:`Continue a usar os inaladores conforme prescrito e evite os desencadeantes. Se as crises forem mais frequentes, reveja a medicação com o seu médico.`,opts:[]},
  asma_avaliar:{r:`Pieira, falta de ar ou tosse noturna precisam de avaliação médica. O diagnóstico de asma é feito com espirometria. Não adie a consulta!`,opts:[{l:'Agendar Pneumologia',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  dor_urgente:{r:`<i class="bi bi-exclamation-triangle-fill" style="color:var(--danger)"></i> Dor abdominal intensa e constante pode ser apendicite ou outro problema cirúrgico. Procure urgência AGORA!`,opts:[{l:'Urgências',i:'bi-exclamation-triangle-fill',a:'urgencias'}]},
  gastrite_cronica:{r:`Gastrite em crises recorrentes deve ser investigada (possível H. pylori ou úlcera). O médico pode pedir endoscopia e análises. Evite anti-inflamatórios sem protecção gástrica.`,opts:[{l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  mental_medio:{r:`Sintomas há algumas semanas já merecem atenção profissional. Uma consulta de clínica geral é o primeiro passo.`,opts:[{l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  mental_longo:{r:`Sintomas persistentes há meses precisam de acompanhamento especializado. Não sofra em silêncio — a saúde mental é tratável!`,opts:[{l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  mental_urgente:{r:`Se está a passar por um momento muito difícil: procure um familiar, amigo de confiança ou vá à Clínica Estoril. Não está sozinho(a)! A ajuda profissional faz toda a diferença.`,opts:[{l:'Ver Localização',i:'bi-geo-alt-fill',a:'localizacao'}]},
  diabetes_sim:{r:`Com diabetes diagnosticada, é fundamental manter o controlo regular da glicemia, HbA1c e acompanhamento médico. Nunca falhe a medicação!`,opts:[{l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  diabetes_rastreio:{r:`Uma análise de glicemia em jejum pode detectar diabetes ou pré-diabetes. Recomendado para quem tem histórico familiar, obesidade, é sedentário ou maior de 45 anos.`,opts:[{l:'Agendar Análises',i:'bi-clipboard2-pulse-fill',a:'agendamento'}]},
  esp_geral:{r:`Clínica Geral é a porta de entrada para qualquer problema de saúde. O médico avalia, trata ou encaminha para o especialista. Disponível na Clínica Estoril!`,opts:[{l:'Agendar',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  esp_pediatria:{r:`Pediatria na Clínica Estoril para crianças de 0 a 14 anos: crescimento, vacinação e doenças infantis.`,opts:[{l:'Agendar',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  esp_gineco:{r:`Ginecologia e Obstetrícia: consultas ginecológicas, pré-natal, ecografias e rastreios oncológicos. Cuide da sua saúde feminina!`,opts:[{l:'Agendar',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  pediatria_neo:{r:`Recém-nascidos precisam de consulta de neonatologia na primeira semana de vida. Avaliamos peso, amamentação, icterícia e rastreio neonatal.`,opts:[{l:'Agendar Neonatologia',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  pediatria_bebe:{r:`Bebés entre 1–12 meses: consultas mensais para crescimento, desenvolvimento e calendário vacinal. Essencial para detectar problemas precocemente!`,opts:[{l:'Agendar Pediatria',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  pediatria_crianca:{r:`Para crianças de 1 a 12 anos: consultas anuais ou conforme necessidade, vacinação de reforço e tratamento de doenças comuns.`,opts:[{l:'Agendar Pediatria',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  tontura_avaliacao:{r:`Tonturas frequentes merecem avaliação médica — podem ter origem cardiovascular, neurológica ou otorrinolaringológica.`,opts:[{l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  nutricao_peso:{r:`Para perda de peso saudável: défice calórico moderado, exercício aeróbico (4–5x/semana) e proteína adequada. Evite dietas extremas. Acompanhamento nutricional acelera os resultados!`,opts:[{l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  nutricao_diabetes:{r:`Para controlar diabetes com alimentação: reduza carboidratos simples, prefira integrais, coma a cada 3h e inclua vegetais em todas as refeições.`,opts:[{l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'}]},
  ok:{r:null,opts:[]},
};

const FALLBACKS = [
  `<i class="bi bi-question-circle-fill"></i> Não compreendi totalmente, mas posso ajudá-lo(a) com informações sobre a <strong>Clínica Estoril</strong> ou orientações de saúde. Pode reformular?`,
  `Essa questão está fora do meu âmbito directo. Tente perguntar sobre <strong>consultas, horários, localização</strong> ou uma condição de saúde específica.`,
  `Não tenho uma resposta específica para isso. Escolha uma opção abaixo para eu ajudá-lo(a) melhor.`,
];

// ═══════════════════════════════════════════════
//  DOM
// ═══════════════════════════════════════════════
const fab     = document.getElementById('chat-fab');
const win     = document.getElementById('chat-window');
const closeBtn= document.getElementById('close-chat');
const msgs    = document.getElementById('chat-messages');
const optWrap = document.getElementById('options-wrap');
const inp     = document.getElementById('chat-input');
const sendBtn = document.getElementById('send-btn');
const badge   = fab.querySelector('.fab-badge');
let isOpen = false, fbIdx = 0;

function t(){ return new Date().toLocaleTimeString('pt-PT',{hour:'2-digit',minute:'2-digit'}); }

function addDateSep(){
  const s=document.createElement('div'); s.className='date-sep';
  s.textContent=new Date().toLocaleDateString('pt-PT',{weekday:'long',day:'numeric',month:'long'});
  msgs.appendChild(s);
}

function addMsg(html, sender){
  const row=document.createElement('div'); row.className=`msg-row ${sender}`;
  const bubble=document.createElement('div'); bubble.className=`msg-bubble ${sender}`;
  bubble.innerHTML=html;
  const meta=document.createElement('div'); meta.className='msg-meta';
  meta.innerHTML= sender==='bot'
    ? `<i class="bi bi-robot"></i> ${t()}`
    : `${t()} <i class="bi bi-check2-all"></i>`;
  row.appendChild(bubble); row.appendChild(meta);
  msgs.appendChild(row); msgs.scrollTop=msgs.scrollHeight;
}

function clearOpts(){ optWrap.innerHTML=''; }

function showOpts(opts){
  clearOpts();
  if(!opts||!opts.length) return;
  opts.forEach(o=>{
    const btn=document.createElement('button'); btn.className='opt-btn';
    btn.innerHTML=`<i class="bi ${o.i}"></i> ${o.l}`;
    btn.addEventListener('click',()=>{
      addMsg(`<i class="bi ${o.i}"></i> ${o.l}`,'user');
      clearOpts();
      handleAction(o.a);
    });
    optWrap.appendChild(btn);
  });
}

function showTyping(cb){
  const row=document.createElement('div'); row.className='msg-row bot'; row.id='typing-row';
  const b=document.createElement('div'); b.className='typing-bubble';
  b.innerHTML='<span></span><span></span><span></span>';
  row.appendChild(b); msgs.appendChild(row); msgs.scrollTop=msgs.scrollHeight;
  setTimeout(()=>{ const r=document.getElementById('typing-row'); if(r)r.remove(); cb(); }, 800+Math.random()*600);
}

function botRespond(html, follow){
  showTyping(()=>{
    addMsg(html,'bot');
    if(follow){
      if(follow.q){
        setTimeout(()=>{
          showTyping(()=>{ addMsg(follow.q,'bot'); showOpts(follow.opts); });
        },350);
      } else { showOpts(follow.opts); }
    }
  });
}

function handleAction(a){
  // KB directo
  if(KB[a]){ const d=KB[a]; botRespond(d.reply, d.follow); return; }
  // ACTIONS
  if(ACTIONS[a]){
    const ar=ACTIONS[a];
    if(ar.r) botRespond(ar.r, ar.opts&&ar.opts.length?{q:null,opts:ar.opts}:null);
    return;
  }
}

function findKB(text){
  const norm=t=>t.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g,'');
  const l=norm(text);
  for(const [,d] of Object.entries(KB)){
    if(d.keys&&d.keys.some(k=>l.includes(norm(k)))) return d;
  }
  return null;
}

function sendMessage(){
  const text=inp.value.trim(); if(!text) return;
  inp.value=''; clearOpts();
  addMsg(text,'user');
  const found=findKB(text);
  if(found){ botRespond(found.reply, found.follow); }
  else {
    const fb=FALLBACKS[fbIdx++%FALLBACKS.length];
    botRespond(fb,{q:'Como posso ajudá-lo(a)?',opts:[
      {l:'Agendar Consulta',i:'bi-calendar-plus-fill',a:'agendamento'},
      {l:'Questão de Saúde',i:'bi-heart-pulse-fill',a:'triagem'},
      {l:'Localização',i:'bi-geo-alt-fill',a:'localizacao'},
      {l:'Horários',i:'bi-clock-fill',a:'horarios'},
    ]});
  }
}

fab.addEventListener('click',()=>{
  isOpen=!isOpen;
  win.classList.toggle('open',isOpen);
  badge.style.display=isOpen?'none':'block';
  if(isOpen&&msgs.children.length===0){
    addDateSep();
    setTimeout(()=>{ const s=KB.saudacao; botRespond(s.reply,s.follow); },350);
  }
});
closeBtn.addEventListener('click',()=>{ isOpen=false; win.classList.remove('open'); });
sendBtn.addEventListener('click',sendMessage);
inp.addEventListener('keydown',e=>{ if(e.key==='Enter') sendMessage(); });