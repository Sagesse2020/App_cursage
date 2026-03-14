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
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\TresorerieController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\ServiceController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/infos', function () {
    return view('infos');
})->name('infos');


Route::middleware(['auth'])->group(function () {
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

        Route::get('/DocumentAccueil', function () {
        return view('documents.accueil');
        })->name('documents');

        Route::get('/EvenementAccueil', function () {
        return view('evenements.accueil');
        })->name('evenements');

        Route::get('/PublicationAccueil', function () {
        return view('publications.accueil');
        })->name('publications');

        Route::get('/VenteAccueil', function () {
        return view('ventes.accueil');
        })->name('ventes');

        Route::get('/TransactionAccueil', function () {
        return view('transactions.accueil');
        })->name('transactions');

        Route::get('/FactureAccueil', function () {
        return view('factures.accueil');
        })->name('factures');

        Route::get('/ServiceAccueil', function () {
        return view('services.accueil');
        })->name('services');

        Route::get('/PartenaireAccueil', function () {
        return view('partenaires.accueil');
        })->name('partenaires');

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
    Route::resource('clients',ClientController::class);

  // -----------------------
    //  RACES
    // ------------------------
      // vue de creation d'une race
 Route::resource('races',RaceController::class);


  // -----------------------
    //  DOCUMENTS
    // ------------------------
Route::resource('documents', DocumentController::class);
Route::get('/factures/{facture}/print', [FactureController::class,'print'])
    ->name('factures.print');
   // -----------------------
    //  EVENEMENTS
    // ------------------------
      // vue de creation d'un evenement
  Route::get('/createEvenement', [EvenementController::class, 'create'])->name('evenements.create');
  Route::post('/createEvenement', [EvenementController::class, 'store'])->name('evenements.store');
  Route::get('/showEvenement', [EvenementController::class, 'show'])->name('evenements.show');
      // vue d'affichage de la liste des evenements
  Route::get('/indexEvenement', [EvenementController::class, 'index'])->name('evenements.index');

  // Modifier des evenements
  Route::get('/evenement/{id}/edit', [EvenementController::class, 'edit'])->name('evenements.edit');
  Route::put('/evenement/{id}', [EvenementController::class, 'update'])->name('evenements.update');
  // Supprimer des documents
  Route::delete('/evenement/{id}', [EvenementController::class, 'destroy'])->name('evenements.destroy');

// -----------------------
    // PUBLICATIONS
    // ------------------------
Route::get('/publications', [PublicationController::class,'index'])->name('publications.index');
Route::get('/publications/create', [PublicationController::class,'create'])->name('publications.create');
Route::post('/publications', [PublicationController::class,'store'])->name('publications.store');
Route::get('/publications/{publication}', [PublicationController::class,'show'])->name('publications.show');
Route::get('/publications/{publication}/edit', [PublicationController::class,'edit'])->name('publications.edit');
Route::put('/publications/{publication}', [PublicationController::class,'update'])->name('publications.update');
Route::delete('/publications/{publication}', [PublicationController::class,'destroy'])->name('publications.destroy');


  // -----------------------
    //  COMMENTAIRES
    // ------------------------
  Route::get('/commentaires', [CommentaireController::class, 'index'])->name('commentaires.index');
  Route::post('/commentaires', [CommentaireController::class, 'store'])->name('commentaires.store');
  Route::delete('/commentaires/{id}', [CommentaireController::class, 'destroy'])
    ->middleware('auth')
    ->name('commentaires.destroy');

    // -----------------------
    // TRANSACTION
    // ------------------------
    //Cette route genère automatiquement niveau laravel transactions.index,transactions.edit,transaction.update,transaction.create
    Route::resource('transactions', TransactionController::class);

     // -----------------------
    // SERVICES
    // ------------------------
    Route::resource('services',ServiceController::class);

     // -----------------------
    // FACTURES
    // ------------------------
    Route::resource('factures',FactureController::class);

     // -----------------------
    // PARTENAIRES
    // ------------------------
    Route::resource('partenaires',PartenaireController::class);

      // -----------------------
    // VENTES
    // ------------------------
    Route::resource('ventes',VenteController::class);
});

