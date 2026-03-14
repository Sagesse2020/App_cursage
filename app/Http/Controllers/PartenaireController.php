<?php

namespace App\Http\Controllers;

use App\Models\Partenaire;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartenaireController extends Controller
{

public function index()
{

$partenaires = Partenaire::latest()->get();

return view('partenaires.index',compact('partenaires'));

}

public function create()
{
     $users = User::all();
     $partenaires = Partenaire::all();
return view('partenaires.create', compact('users'));
}

public function store(Request $request)
{
$data = $request->validate([

'nom'=>'required',
'telephone'=>'nullable',
'email'=>'nullable',
'adresse'=>'nullable',
'pourcentage_commission'=>'nullable',
'notes'=>'nullable'

]);

$data['user_id'] = Auth::id();

Partenaire::create($data);

return redirect()->route('partenaires.index');

}

public function edit(Partenaire $partenaire)
{

return view('partenaires.edit',compact('partenaire'));

}

public function update(Request $request, Partenaire $partenaire)
{

$partenaire->update($request->all());

return redirect()->route('partenaires.index');

}

public function destroy(Partenaire $partenaire)
{

$partenaire->delete();

return back();

}

}
