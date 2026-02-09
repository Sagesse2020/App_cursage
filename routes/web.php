<?php
use App\Http\Controllers\GraphiqueController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChienController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartenaireController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClotureController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\TresorerieController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/infos', function () {
    return view('infos');
})->name('infos');


Route::middleware(['auth'])->group(function () {

    Route::get('/partner/create', function () {
        return view('parternaires.create');
    });

    Route::resource('chiens', ChienController::class);
});

// Mot de passe oublié
Route::prefix('password')->name('password.')->group(function () {
    Route::get('reset', [PasswordResetController::class, 'showResetForm'])->name('request');
    Route::post('email', [PasswordResetController::class, 'sendResetLink'])->name('email');
    Route::get('reset/{token}', [PasswordResetController::class, 'showNewPasswordForm'])->name('reset');
    Route::post('reset', [PasswordResetController::class, 'resetPassword'])->name('update');
});

Route::prefix('gestion')->middleware(['auth'])->group(function () {


    Route::get('/Gestion', [GestionController::class, 'index'])
        ->name('gestion.index');
});

 Route::get('/tresorerie', [TresorerieController::class, 'index'])
        ->name('tresorerie.index');

 Route::get('/journal', [JournalController::class, 'index'])
        ->name('journal.index');


// Authentification
// ==============================
// AUTH (SANS middleware auth)
// ==============================
Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login')
    ->middleware('throttle:5,1');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1');

Route::get('/register', [AuthController::class, 'showRegisterForm'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function(){
    Route::resource('chiens', ChienController::class);
    Route::resource('partenaires', PartenaireController::class)->middleware(''); // simple gate needed
    Route::resource('clients', ClientController::class);
    Route::post('ventes', [VenteController::class,'store'])->name('ventes.store');
    Route::get('ventes', [VenteController::class,'index'])->name('ventes.index');
    Route::get('ventes/{vente}', [VenteController::class,'show'])->name('ventes.show');

      // Profil utilisateur
        Route::get('/profil', [UserController::class, 'profil'])->name('profil');
        Route::get('/edit', [UserController::class, 'profile'])->name('profile');
        Route::post('/userStore', [UserController::class, 'store'])->name('users.store');
        Route::post('/update', [UserController::class, 'update'])->name('profile-update');
        Route::post('/profile/photo', [UserController::class, 'updatePhoto'])->name('profile.photo');
        Route::get('/usersIndex', [UserController::class, 'index'])->name('users.index');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'updateUser'])->name('users.update');

        Route::get('/admin', function () {
        return view('admin');
        })->name('admin');

        Route::get('/home', function () {
        return view('home');
        })->name('home');

        Route::get('/users', function () {
        return view('users');
        })->name('users');

        Route::get('/RaceAccueil', function () {
        return view('races.accueil');
        })->name('races');

        Route::get('/ChienAccueil', function () {
        return view('chiens.accueil');
        })->name('chiens');

        Route::get('/ClientAccueil', function () {
        return view('clients.accueil');
        })->name('clients');

        Route::get('/statistique', [StatistiqueController::class, 'index'])
        ->name('statistiques')
        ->middleware('auth');


    // -----------------------
    // CLOTURE
    // ------------------------
        Route::get('/cloture', [ClotureController::class, 'index'])->name('cloture');
        Route::post('/cloture/valider', [ClotureController::class, 'valider'])->name('cloture.valider');

        Route::get('/graphique', [GraphiqueController::class, 'index'])->name('graphique');

    // -----------------------
    // CLIENTS
    // ------------------------
      // vue de creation d'un client
  Route::get('/createClient', [ClientController::class, 'create'])->name('clients.create');
  Route::post('/createClient', [ClientController::class, 'store'])->name('clients.store');
  // vue d'affichage de la liste des clients
  Route::get('/indexClient', [ClientController::class, 'index'])->name('clients.index');
  // Modifier des clients
  Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
  Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');
  // Supprimer des clients
  Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');

   // -----------------------
    // CHIENS
    // ------------------------
      // vue de creation d'un chien
  Route::get('/createChien', [ChienController::class, 'create'])->name('chiens.create');
  Route::post('/createChien', [ChienController::class, 'store'])->name('chiens.store');
  // vue d'affichage de la liste des chiens
  Route::get('/indexChien', [ChienController::class, 'index'])->name('chiens.index');
  // Modifier des chiens
  Route::get('/chiens/{id}/edit', [ChienController::class, 'edit'])->name('chiens.edit');
  Route::put('/chiens/{id}', [ChienController::class, 'update'])->name('chiens.update');
  // Supprimer des chiens
  Route::delete('/chiens/{id}', [ChienController::class, 'destroy'])->name('chiens.destroy');

  // -----------------------
    //  RACES
    // ------------------------
      // vue de creation d'une race
  Route::get('/createRace', [RaceController::class, 'create'])->name('races.create');
  Route::post('/createRace', [RaceController::class, 'store'])->name('races.store');
  Route::get('/showRace', [RaceController::class, 'show'])->name('races.show');
      // vue d'affichage de la liste des races
  Route::get('/indexRace', [RaceController::class, 'index'])->name('races.index');

  // Modifier des races
  Route::get('/races/{id}/edit', [RaceController::class, 'edit'])->name('races.edit');
  Route::put('/races/{id}', [RaceController::class, 'update'])->name('races.update');
  // Supprimer des chiens
  Route::delete('/races/{id}', [RaceController::class, 'destroy'])->name('races.destroy');

  Route::get('/commentaires', [CommentaireController::class, 'index'])->name('commentaires.index');
  Route::post('/commentaires', [CommentaireController::class, 'store'])->name('commentaires.store');
  Route::delete('/commentaires/{id}', [CommentaireController::class, 'destroy'])
    ->middleware('auth')
    ->name('commentaires.destroy');

});

