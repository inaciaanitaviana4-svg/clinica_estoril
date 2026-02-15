<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * AppServiceProvider - Provider principal do Laravel
 * Responsável por registrar e inicializar serviços da aplicação
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * register - Registra bindings/singletons no service container
     * Execute aqui antes de qualquer serviço ser iniciado
     * Ideal para configurações de injeção de dependência
     */
    public function register(): void
    {
        // Adicione aqui registros de serviços customizados
    }

    /**
     * boot - Método executado após todos os serviços serem registrados
     * Use para inicializar recursos, publicar assets, configurar listeners, etc
     */
    public function boot(): void
    {
        // Adicione aqui inicializações de serviços
        // Exemplo: registrar observadores de modelos, publicar migrações, etc
    }
}
