<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

use App\Traits\LogsVisits;
use App\Helpers\ActivityHelper;

class AuthController extends Controller
{
    use LogsVisits;

    /*
    |--------------------------------------------------------------------------
    | FORMULAIRES
    |--------------------------------------------------------------------------
    */

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        $request->validate([

            'email' => 'required|email',

            'password' => 'required|min:6',

        ], [

            'email.required' =>
                'Veuillez entrer votre adresse email.',

            'email.email' =>
                'L’adresse email n’est pas valide.',

            'password.required' =>
                'Veuillez entrer votre mot de passe.',

            'password.min' =>
                'Le mot de passe doit contenir au moins 6 caractères.',

        ]);

        /*
        |--------------------------------------------------------------------------
        | Vérification utilisateur
        |--------------------------------------------------------------------------
        */

        $user = User::where(
            'email',
            $request->email
        )->first();

        if (!$user) {

            ActivityHelper::log(
                'LOGIN_FAILED',
                'AUTH',
                null,
                'danger'
            );

            return back()->withErrors([

                'email' =>
                    "Aucun compte trouvé avec cette adresse email."

            ])->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | Vérification mot de passe
        |--------------------------------------------------------------------------
        */

        if (!Hash::check(
            $request->password,
            $user->password
        )) {

            ActivityHelper::log(
                'PASSWORD_FAILED',
                'AUTH',
                $user,
                'danger'
            );

            return back()->withErrors([

                'password' =>
                    "Le mot de passe est incorrect."

            ])->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | Connexion
        |--------------------------------------------------------------------------
        */

        Auth::login(
            $user,
            $request->has('remember')
        );

        $request->session()->regenerate();

        /*
        |--------------------------------------------------------------------------
        | Historique connexion
        |--------------------------------------------------------------------------
        */

        DB::table('logins_temp')->insert([

            'user_id' => $user->id,

            'logged_in_at' => now(),

        ]);

        /*
        |--------------------------------------------------------------------------
        | LOG ACTIVITÉ
        |--------------------------------------------------------------------------
        */

        ActivityHelper::log(

            'LOGIN',

            'AUTH',

            $user,

            'info'

        );

        /*
        |--------------------------------------------------------------------------
        | Visites système
        |--------------------------------------------------------------------------
        */

        $this->logVisit('login');

        /*
        |--------------------------------------------------------------------------
        | Redirection
        |--------------------------------------------------------------------------
        */

        return $user->role === 'admin'

            ? redirect()
                ->route('admin')
                ->with(
                    'success',
                    'Bienvenue, '.$user->name.' !'
                )

            : redirect()
                ->route('home')
                ->with(
                    'success',
                    'Bienvenue, '.$user->name.' !'
                );
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    */

    public function register(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\pL\s\-]+$/u'
            ],

            'email' =>
                'required|email|unique:users,email',

            'password' =>
                'required|string|confirmed|min:8',

        ], [

            'name.required' =>
                'Le nom est obligatoire.',

            'name.regex' =>
                'Le nom ne peut contenir que des lettres.',

            'email.required' =>
                'L’email est obligatoire.',

            'email.email' =>
                'Adresse email invalide.',

            'email.unique' =>
                'Cet email existe déjà.',

            'password.required' =>
                'Mot de passe obligatoire.',

            'password.min' =>
                'Minimum 8 caractères.',

            'password.confirmed' =>
                'Les mots de passe ne correspondent pas.',

        ]);

        /*
        |--------------------------------------------------------------------------
        | Premier admin automatique
        |--------------------------------------------------------------------------
        */

        $isFirstAdmin =
            User::where('role', 'admin')->count() === 0;

        $role =
            $isFirstAdmin ? 'admin' : 'user';

        $niveau =
            $isFirstAdmin ? 3 : null;

        /*
        |--------------------------------------------------------------------------
        | Création utilisateur
        |--------------------------------------------------------------------------
        */

        $user = User::create([

            'name' =>
                $validated['name'],

            'email' =>
                $validated['email'],

            'password' =>
                bcrypt($validated['password']),

            'role' =>
                $role,

            'niveau_admin' =>
                $niveau,

        ]);

        /*
        |--------------------------------------------------------------------------
        | Log activité
        |--------------------------------------------------------------------------
        */

        ActivityHelper::log(

            'REGISTER',

            'USERS',

            $user,

            'info'

        );

        Auth::login($user);

        return $role === 'admin'

            ? redirect()
                ->route('admin')
                ->with(
                    'success',
                    'Compte administrateur créé !'
                )

            : redirect()
                ->route('home')
                ->with(
                    'success',
                    'Compte créé avec succès !'
                );
    }

    /*
    |--------------------------------------------------------------------------
    | FORMULAIRE ADMIN CREATE USER
    |--------------------------------------------------------------------------
    */

    public function createUser()
    {
        return view('users');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE USER
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $this->logVisit('user_store');

        try {

            $validated = $request->validate([

                'name' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[\pL\s\-]+$/u'
                ],

                'email' =>
                    'required|email|unique:users,email',

                'password' =>
                    'required|string|confirmed|min:8',

                'role' =>
                    'required|in:user,admin',

                'niveau_admin' =>
                    'nullable|integer|min:1|max:3',

            ]);

            $niveau =
                $validated['role'] === 'admin'
                    ? ($validated['niveau_admin'] ?? 1)
                    : null;

            $user = User::create([

                'name' =>
                    $validated['name'],

                'email' =>
                    $validated['email'],

                'password' =>
                    bcrypt($validated['password']),

                'role' =>
                    $validated['role'],

                'niveau_admin' =>
                    $niveau,

            ]);

            /*
            |--------------------------------------------------------------------------
            | Log activité
            |--------------------------------------------------------------------------
            */

            ActivityHelper::log(

                'CREATE_USER',

                'USERS',

                $user,

                'warning'

            );

            return redirect()
                ->route('users.index')
                ->with(
                    'success',
                    'Utilisateur créé avec succès.'
                );

        } catch (\Exception $e) {

            ActivityHelper::log(

                'ERROR_CREATE_USER',

                'USERS',

                null,

                'danger'

            );

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        ActivityHelper::log(

            'LOGOUT',

            'AUTH',

            auth()->user(),

            'warning'

        );

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')
            ->with(
                'success',
                'Vous avez été déconnecté.'
            );
    }
}