<?php
namespace App\Http\Controllers;

use App\Models\Chien;
use Illuminate\Http\Request;

class ChienController extends Controller
{
    public function index()
    {
        $chiens = Chien::latest()->paginate(10);
        return view('chiens.index', compact('chiens'));
    }

    public function create()
    {
        return view('chiens.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'race' => 'required',
            'age' => 'required|numeric',
            'prix' => 'required|numeric',
            'image' => 'image|nullable'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('chiens', 'public');
        }

        Chien::create($data);

        return redirect()->route('chiens.index')->with('success','Chien ajouté');
    }

    public function edit(Chien $chien)
    {
        return view('chiens.edit', compact('chien'));
    }

    public function update(Request $request, Chien $chien)
    {
        $chien->update($request->all());

        return redirect()->route('chiens.index')->with('success','Chien modifié');
    }

    public function destroy(Chien $chien)
    {
        $chien->delete();

        return back()->with('success','Chien supprimé');
    }
}
