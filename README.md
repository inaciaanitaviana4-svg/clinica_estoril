# Clínica Estoril

> Projeto PAP — Sistema de gestão e agendamento de consultas para uma clínica (Trabalho de fim de curso).

Este repositório contém a aplicação web "Clínica Estoril", desenvolvida em PHP (Laravel) para facilitar o registo de pacientes, gestão de utilizadores (administrador, recepcionista, médico) e o agendamento de consultas. O README foi preparado tendo em conta que este projecto é uma Prova de Aptidão Profissional (PAP), pelo que inclui informação para avaliação, execução local e pontos técnicos a destacar na defesa.

## Sumário

- Visão geral
- Funcionalidades principais
- Tecnologias usadas
- Estrutura do projeto (destacando views importantes)
- Instalação e execução (local)
- Rotas / pontos de navegação importantes
- Como apresentar no PAP (o que demonstrar)
- Sugestões de melhorias
- Créditos

---

## Visão geral

Clínica Estoril é uma aplicação web que simula o portal de uma clínica médica: página pública com informações (serviços, especialidades, equipa), registo de pacientes, autenticação de vários tipos de utilizador, e um fluxo de agendamento/gestão de consultas. A interface usa templates Blade e um conjunto de assets (CSS/JS) incluídos em `public/`.

O objetivo do PAP foi construir um sistema funcional que mostre conhecimentos de arquitetura MVC, persistência em base de dados, autenticação/autorização simples por tipo de utilizador, e interface responsiva básica.

## Funcionalidades principais

- Página pública com: Início, Sobre, Serviços, Especialidades, Equipa, Contacto,Blog e chat bot.
- Registo de paciente (formulário com dados pessoais, BI, contacto). 
- Login / sessão para utilizadores (tipos: `admi`, `recepcionista`, `medico`, `paciente`).
- Agendamento de consulta (pacientes) via formulário público ou painel.
- Painéis (layouts/painel) para administração e para médicos/recepcionistas: ver e gerir consultas, pagamentos, cadastros, prontuários.
- Layouts reutilizáveis com `resources/views/layouts`.

## Tecnologias

- PHP 8.x
- Laravel (estrutura de pastas e Blade templates)
- Composer (dependências PHP)
- Front-end: CSS personalizado e Bootstrap (algumas vistas de painel usam bootstrap)
- Banco de dados: MySQL/MariaDB (migrations estão dentro de `database/migrations`).
- Testes: PHPUnit/Pest (configuração básica presente no repositório)

## Estrutura relevante do projeto

- `app/Models/` — modelos principais: `Medico`, `Paciente`, `Consulta`, `Especialidade`, `Pagamento`, `Utilizador`, etc.
- `app/Http/Controllers/` — controladores que recebem as requests (verificar neste diretório para a lista completa).
- `resources/views/` — templates Blade. Páginas importantes:
	- `layouts/site.blade.php` — layout público (header, footer, menu)
	- `layouts/admin.blade.php` / `layouts/painel.blade.php` — layouts do painel administrativo
	- `index.blade.php` / `welcome.blade.php` — homepage e landing
	- `agendar_consulta.blade.php` — formulário de agendamento
	- `criar_conta_paciente.blade.php` — registo de paciente
	- `painel_medico.blade.php`, `painel_recepcionista.blade.php` — entradas para interfaces internas
	- pastas: `especialidades/`, `medicos/`, `pacientes/`, `consultas/`, `recepcionistas/`, `utilizadores/` — views organizadas por módulo

## Instalação e execução (local)

As instruções abaixo assumem um ambiente Windows com PowerShell (pwsh). Tenha PHP, Composer e um servidor de BD (MySQL/MariaDB) instalados.

1. Copiar repositório (já deve estar no seu workspace)

2. Instalar dependências PHP

```powershell
composer install
```

3. Configurar ficheiro de ambiente (.env)

```powershell
copy .env.example .env
php artisan key:generate
# Editar .env e definir DB_CONNECTION, DB_DATABASE, DB_USERNAME, DB_PASSWORD
```

4. Executar migrations e (opcional) seeders

```powershell
php artisan migrate
# php artisan db:seed    # se existirem seeders úteis
```

5. Iniciar servidor local

```powershell
php artisan serve --host=127.0.0.1 --port=8000
# Aceder: http://127.0.0.1:8000
```

6. (Opcional) Executar testes

```powershell
./vendor/bin/pest
# ou
./vendor/bin/phpunit
```

## Rotas / pontos de navegação (úteis para demo)

- `/` — Página inicial
- `/sobre`, `/servicos`, `/especialidades`, `/equipa`, `/contacto` — páginas públicas
- `/login`, `/cadastrar-paciente` — autenticação e registo
- `/agendar-consulta-paciente` — formulário de agendamento
- `/admin/dashboard`, `/admin/consultas`, `/admin/pagamentos` — painel administrativo (requer sessão tipo `admi`)
- `/visualizar-perfil` — perfil do utilizador (após login)
- Rotas de API/ações estão definidas nos controladores (ver `routes/web.php`)

## Como apresentar este projeto no PAP (pontos a demonstrar)

1. Objetivo do projeto: explicar requisitos funcionais propostos e público-alvo (ex.: gestão de consultas em clínica local).
2. Arquitetura: mostrar a separação MVC (Model — Eloquent models; View — Blade; Controller — lógica e rotas).
3. Demonstração funcional: registar um paciente, fazer login, agendar uma consulta e abrir o painel (mostrar permissões por tipo).
4. Código: abrir os templates em `resources/views` para explicar como os layouts e partials são reutilizados.
5. Banco de dados: explicar o modelo das tabelas principais (Consulta, Paciente, Medico, Utilizador). Mostrar migrations em `database/migrations`.
6. Segurança e validação: mostrar validações nos controllers (e CSRF tokens nos formulários Blade).
7. Testes e qualidade: apresentar qualquer teste automatizado existente (ou explicar falta dos mesmos e como adicioná-los).

Dica para a apresentação: prepare 3-5 telas/fluxos prontos (ex.: homepage → registo → agendamento → painel médico) para uma demo fluida.

## Sugestões de melhorias (para mencionar como trabalho futuro)

- Implementar testes automáticos cobrindo fluxos críticos (registo, login, agendamento).
- Melhorar a gestão de permissões com Gates/Policies do Laravel.
- Implementar internacionalização (i18n) se for necessário suporte a várias línguas.
- Separar assets com Vite e otimizar ficheiros CSS/JS.
- Registo de ações (logs) e auditoria de alterações em prontuários/consultas.

## Créditos

- Autor: (colocar aqui o nome do(s) aluno(s) que apresentarão a PAP)
- Orientador: (colocar o nome do professor/orientador)
- Outros: (colocar o nome de outras pessoas que ajudaram directamente ou indirectamente no projecto)
