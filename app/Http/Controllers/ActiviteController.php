<?php
namespace App\Http\Controllers;

use App\Models\Activite;
use Illuminate\Http\Request;

class ActiviteController extends Controller
{
    public function index(Request $request)
{
    $query = Activite::query();

    // FILTRE MODULE
    if ($request->module) {
        $query->where('module', $request->module);
    }

    // FILTRE ACTION
    if ($request->action) {
        $query->where('action', $request->action);
    }

    $activites = $query->latest()->paginate(20);

    return view('activites.index', compact('activites'));
}
}