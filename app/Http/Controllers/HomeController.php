<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chien;
use App\Models\Vente;
use App\Models\Service;
use App\Models\User;
use App\Models\Race;
use App\Models\Produit;

class HomeController extends Controller
{
public function index()
{
    return view('home', [

        // USERS
        'totalUsers' => User::count(),

        // CHIENS
        'chiensVendus' => Chien::where('statut', 'vendu')->count(),
        'chiensDisponibles' => Chien::where('statut', 'disponible')->count(),

        // RACES
        'totalRaces' => Race::count(),

        // PRODUITS
        'totalProduits' => Produit::count(),

        // SERVICES
        'totalServices' => Service::count(),

        // VENTES
        'totalVentes' => Vente::count(),
    ]);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
