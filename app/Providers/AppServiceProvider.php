<?php

namespace App\Providers;

use App\Models\Chien;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Produit;
use App\Models\Transaction;
use App\Models\Vente;
use App\Models\Facture;
use App\Models\Commande;
use App\Models\Service;
use App\Models\Document;
use App\Observers\GlobalActivityObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    Client::observe(GlobalActivityObserver::class);

    Employee::observe(GlobalActivityObserver::class);

    Produit::observe(GlobalActivityObserver::class);

    Transaction::observe(GlobalActivityObserver::class);

    Vente::observe(GlobalActivityObserver::class);

    Facture::observe(GlobalActivityObserver::class);

    Commande::observe(GlobalActivityObserver::class);

    Chien::observe(GlobalActivityObserver::class);

    Service::observe(GlobalActivityObserver::class);

    Document::observe(GlobalActivityObserver::class);
    }
}
