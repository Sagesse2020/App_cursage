<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Les commandes Artisan personnalisées
     *
     * @var array
     */
    protected $commands = [
        // Exemple :
        // \App\Console\Commands\CheckHebergements::class,
    ];

    /**
     * Définition du planning des tâches
     */
    protected function schedule(Schedule $schedule): void
    {
        // Vérification quotidienne des hébergements / renouvellements
        $schedule->command('hebergements:check')
                 ->dailyAt('08:00');
    }

    /**
     * Enregistrement des commandes
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    protected $routeMiddleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

    // 👇 MIDDLEWARE partenaire
    'partner.scope' => \App\Http\Middleware\PartnerScope::class,
  ];
}

