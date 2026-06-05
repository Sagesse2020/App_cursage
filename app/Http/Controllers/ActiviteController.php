<?php
namespace App\Http\Controllers;

use App\Models\Activite;

class ActiviteController extends Controller
{
    public function index()
    {
        $activites = Activite::with('user')
            ->latest()
            ->paginate(20);

        return view(
            'activites.index',
            compact('activites')
        );
    }
}