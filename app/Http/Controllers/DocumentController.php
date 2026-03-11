<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    public function index() {
        $documents = Document::orderBy('created_at','desc')->get();
        return view('documents.index', compact('documents'));
    }

    public function create() {
        return view('documents.create');
    }

    public function store(Request $request) {
        $request->validate([
            'titre'=>'required|string|max:255',
            'description'=>'nullable|string',
            'fichier'=>'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx',
        ]);

        $path = null;
        if($request->hasFile('fichier')){
            $path = $request->file('fichier')->store('documents','public');
        }

        Document::create([
            'titre'=>$request->titre,
            'description'=>$request->description,
            'fichier'=>$path,
        ]);

        return redirect()->route('documents.index')->with('success','Document ajouté.');
    }

    public function show(Document $document){
        return view('documents.show', compact('document'));
    }

    public function edit(Document $document){
        return view('documents.edit', compact('document'));
    }

    public function update(Request $request, Document $document){
        $request->validate([
            'titre'=>'required|string|max:255',
            'description'=>'nullable|string',
            'fichier'=>'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx',
        ]);

        if($request->hasFile('fichier')){
            $document->fichier = $request->file('fichier')->store('documents','public');
        }

        $document->update([
            'titre'=>$request->titre,
            'description'=>$request->description,
            'fichier'=>$document->fichier,
        ]);

        return redirect()->route('documents.index')->with('success','Document modifié.');
    }

    public function destroy(Document $document){
        $document->delete();
        return redirect()->route('documents.index')->with('success','Document supprimé.');
    }
}
