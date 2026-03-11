<?php
namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{
    public function index() {
        $publications = Publication::with('user')->orderBy('created_at','desc')->get();
        return view('publications.index', compact('publications'));
    }

    public function create() {
        return view('publications.create');
    }

    public function store(Request $request) {
        $request->validate([
            'titre'=>'required|string|max:255',
            'contenu'=>'nullable|string',
            'image'=>'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $path = null;
        if($request->hasFile('image')){
            $path = $request->file('image')->store('publications','public');
        }

        Publication::create([
            'titre'=>$request->titre,
            'contenu'=>$request->contenu,
            'image'=>$path,
            'user_id'=>Auth::id(), // on relie la publication à l'utilisateur connecté
        ]);

        return redirect()->route('publications.index')->with('success','Publication ajoutée.');
    }

    public function show(Publication $publication){
        return view('publications.show', compact('publication'));
    }

    public function edit(Publication $publication){
        return view('publications.edit', compact('publication'));
    }

    public function update(Request $request, Publication $publication){
        $request->validate([
            'titre'=>'required|string|max:255',
            'contenu'=>'nullable|string',
            'image'=>'nullable|image|mimes:jpg,jpeg,png',
        ]);

        if($request->hasFile('image')){
            $publication->image = $request->file('image')->store('publications','public');
        }

        $publication->update([
            'titre'=>$request->titre,
            'contenu'=>$request->contenu,
            'image'=>$publication->image,
        ]);

        return redirect()->route('publications.index')->with('success','Publication modifiée.');
    }

    public function destroy(Publication $publication){
        $publication->delete();
        return redirect()->route('publications.index')->with('success','Publication supprimée.');
    }
}
