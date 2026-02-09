<?php
namespace App\Http\Controllers;
use App\Models\Partenaire;
use Illuminate\Http\Request;

class PartenaireController extends Controller
{
    public function index()
    { 
        $partenaires = Partenaire::paginate(20); return view('partenaires.index', compact('partenaires'));
    }
    public function create()
    { 
        return view('partenaires.create'); 
    }
       public function store(Request $request){
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'nullable|email',
            'telephone'=>'nullable|string|max:20',
            'adresse'=>'nullable|string|max:255',
            'commission_percent'=>'nullable|numeric|min:0|max:100',
            'status'=>'required|in:actif,inactif'
        ]);

        Partenaire::create($validated);

        return redirect()->route('partenaires.create')->with('success', 'Partenaire ajouté !');
    }
}
