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

        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $path = $request->file('photo')->store('profiles', 'public');

        $user->photo = $path;
        $user->save();

        return response()->json([
            'success' => true,
            'photo_url' => asset('storage/' . $path)
        ]);
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
        return view('users.create');
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
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
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
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return back()->with('success', 'Utilisateur modifié');
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