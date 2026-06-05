<?php

namespace App\Models;

class Recette
{
    public static function totalJour()
    {
        return \App\Models\Transaction::whereDate('created_at', today())
            ->sum('montant');
    }

    public static function totalMois()
    {
        return \App\Models\Transaction::whereMonth('created_at', now()->month)
            ->sum('montant');
    }

    public static function totalAnnee()
    {
        return \App\Models\Transaction::whereYear('created_at', now()->year)
            ->sum('montant');
    }
}