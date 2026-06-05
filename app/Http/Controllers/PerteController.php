<?php

namespace App\Http\Controllers;

use App\Models\Perte;

class PerteController extends Controller
{
    public function index()
    {
        $pertes = Perte::with('user')
            ->latest()
            ->paginate(20);

        $total_pertes = Perte::sum('montant');

        return view(
            'pertes.index',
            compact(
                'pertes',
                'total_pertes'
            )
        );
    }
}