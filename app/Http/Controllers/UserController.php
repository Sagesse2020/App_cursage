<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Traits\LogsVisits;

class UserController extends Controller
{
    use LogsVisits;

    // =========================
    // PROFIL PAGE
    // =========================
    public function profile()
    {
        $this->logVisit('profile');
        return view('profile');
    }

    public function profil()
    {
        $this->logVisit('profil');
        return view('profil');
    }

    // =========================
    // UPDATE PROFIL (TEXT + PASSWORD)
    // =========================
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // password optionnel
        if ($request->filled('new-password')) {

            if (!Hash::check($request->input('old-password'), $user->password)) {
                return back()->with('error', 'Ancien mot de passe incorrect');
            }

            if ($request->input('new-password') !== $request->input('new-password_confirmation')) {
                return back()->with('error', 'Les mots de passe ne correspondent pas');
            }

            $user->password = Hash::make($request->input('new-password'));
        }

        $user->save();

        return back()->with('success', 'Profil mis à jour');
    }

    // =========================
    // UPDATE PHOTO (IMPORTANT)
    // =========================
    public function updatePhoto(Request $request)
{
    $request->validate([
        'photo' => 'required|image|max:2048'
    ]);

    $user = Auth::user();

    // supprimer ancienne photo
    if ($user->photo && Storage::disk('public')->exists($user->photo)) {
        Storage::disk('public')->delete($user->photo);
    }

    // upload nouvelle
    $path = $request->file('photo')->store('profiles', 'public');

    $user->photo = $path;
    $user->save();

    return redirect()
        ->route('profil')
        ->with('success', 'Photo de profil mise à jour avec succès');
}

    // =========================
    // USERS LIST (ADMIN)
    // =========================
    public function index()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'admin' || (int)$user->niveau_admin !== 3) {
            abort(403);
        }

        return view('users.index', [
            'users' => User::latest()->get()
        ]);
    }

    // =========================
    // CREATE USER FORM
    // =========================
    public function createUser()
    {
        return view('users');
    }

    // =========================
    // STORE USER
    // =========================
      public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:8',
        'role' => 'required',
        'niveau_admin' => 'nullable|integer|min:1|max:3'
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => $request->role,
        'niveau_admin' => $request->niveau_admin, // 🔥 IMPORTANT
    ]);

    return redirect()->route('users.index')->with('success', 'Utilisateur créé');
    }
    // =========================
    // EDIT USER
    // =========================
    public function edit($id)
    {
        return view('users.edit', [
            'user' => User::findOrFail($id)
        ]);
    }

    // =========================
    // UPDATE USER (ADMIN)
    // =========================
       public function updateUser(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $id,
        'role' => 'required',
        'niveau_admin' => 'nullable|integer|min:1|max:3',
        'password' => 'nullable|min:8|confirmed',
    ]);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'niveau_admin' => $request->role === 'admin'
            ? (int) $request->niveau_admin
            : null,
    ];

    // 🔥 password seulement si rempli
    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->password);
    }

    $user->update($data);

    return back()->with('success', 'Utilisateur modifié avec succès');
   }

    // =========================
    // DELETE USER
    // =========================
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return back()->with('error', 'Action interdite');
        }

        $user->delete();

        return back()->with('success', 'Utilisateur supprimé');
    }
}