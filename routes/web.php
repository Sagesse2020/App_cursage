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
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\AchatController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\MouvementStockController;
use App\Http\Controllers\RecetteController;
use App\Http\Controllers\PerteController;
use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\ReproductionController;
use App\Http\Controllers\TraitementController;
use App\Http\Controllers\NaissanceController;
use App\Http\Controllers\SuiviChienController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\DecesController;
use App\Http\Controllers\BeneficeController;
use App\Http\Controllers\FicheSuiviController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/infos', function () {
    return view('infos');
})->name('infos');

Route::get('/aide', function () {
    return view('aide');
})->name('aide');

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
        Route::post('/userCreate', [UserController::class, 'create'])->name('users.create');
        Route::post('/update', [UserController::class, 'update'])->name('profile-update');
        Route::post('/profile/photo', [UserController::class, 'updatePhoto'])->name('profile.photo');
        Route::get('/usersIndex', [UserController::class, 'index'])->name('users.index');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'updateUser'])->name('users.update');

        
      // Presentation (differents accueils)
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

                })->name('evenements');

        Route::get('/Employeaccueil', function () {
        return view('employees.accueil');
        })->name('employees');

        Route::post('/publications/{publication}/commander',  [CommandeController::class, 'store'])
        ->name('publication.commander');

        Route::get('/VenteAccueil', function () {
        return view('ventes.accueil');
        })->name('ventes');

        Route::get('/TransactionAccueil', function () {
        return view('transactions.accueil');
        })->name('transactions');
        
        Route::get('/VaccinationAccueil', function () {
        return view('vaccinations.accueil');
        })->name('vaccinations');

        Route::get('/ReservationAccueil', function () {
        return view('reservations.accueil');
        })->name('reservations');

        Route::get('/ReproductionAccueil', function () {
        return view('reproductions.accueil');
        })->name('reproductions');

        Route::get('/TraitementAccueil', function () {
        return view('traitements.accueil');
        })->name('traitements');

        Route::get('/ConsultationAccueil', function () {
        return view('consultations.accueil');
        })->name('consultations');

        Route::get('/NaissanceAccueil', function () {
        return view('naissances.accueil');
        })->name('naissances');

        Route::get('/DecesAccueil', function () {
        return view('deces.accueil');
        })->name('deces');

        Route::get('/FicheAccueil', function () {
        return view('fiches_suivi.accueil');
        })->name('fiches_suivi');

        Route::get('/FactureAccueil', function () {
        return view('factures.accueil');
        })->name('factures');

        Route::get('/MouvementStockAccueil', function () {
        return view('mouvements_stock.accueil');
        })->name('mouvements_stock');

        Route::get('/ServiceAccueil', function () {
        return view('services.accueil');
        })->name('services');

        Route::get('/PartenaireAccueil', function () {
        return view('partenaires.accueil');
        })->name('partenaires');

        Route::get('/CategorieAccueil', function () {
        return view('categories.accueil');
        })->name('categories');

        Route::get('/AchatAccueil', function () {
        return view('achats.accueil');
        })->name('achats');

        Route::get('/PaiementAccueil', function () {
        return view('paiements.accueil');
        })->name('paiements');

        Route::get('/DepenseAccueil', function () {
        return view('depenses.accueil');
        })->name('depenses');
         
        Route::get('/MouvementStockAccueil', function () {
        return view('mouvements_stock.accueil');
        })->name('mouvements_stock');

        Route::get('/fournisseurAccueil', function () {
        return view('fournisseurs.accueil');
        })->name('fournisseurs');

        Route::get('/commandeAccueil', function () {
        return view('commandes.accueil');
        })->name('commandes');

        Route::get('/produitAccueil', [ProduitController::class, 'accueil'])
        ->name('produits');
        Route::post('/produits/{produit}/commander', [CommandeController::class, 'store'])
        ->name('produits.commander');

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
  Route::get('/evenements/{evenement}', [EvenementController::class, 'show'])
    ->name('evenements.show');
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

     // -----------------------
    // FOURNISSEURS
    // ------------------------
    Route::resource('fournisseurs',FournisseurController::class);

        // -----------------------
    // PRODUITS
    // ------------------------
    Route::resource('produits',ProduitController::class);

    // -----------------------
    // CATEGORIE
    // ------------------------
    Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategorieController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
    Route::get('/categories/{categorie}', [CategorieController::class, 'show'])->name('categories.show');
    Route::get('/categories/{categorie}/edit', [CategorieController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{categorie}', [CategorieController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{categorie}', [CategorieController::class, 'destroy'])->name('categories.destroy');

    // -----------------------
    // COMMENTS
    // ------------------------
   Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');


    // -----------------------
    // EMPLOYE
    // ------------------------
  Route::resource('employees', EmployeeController::class);

  // -----------------------
    // ACTIVITES
    // ------------------------
  Route::get('/activites', [ ActiviteController::class,'index'])->name('activites.index');

 // -----------------------
    // ACHATS
    // ------------------------
  Route::resource('achats', AchatController::class);
  
   // -----------------------
    // RECETTES
    // ------------------------
  Route::resource('recettes', RecetteController::class);

  Route::resource('vaccinations', VaccinationController::class);

  Route::resource('traitements', TraitementController::class);

  Route::resource('consultations', ConsultationController::class);

  Route::resource('naissances', NaissanceController::class);

  Route::resource('reproductions', ReproductionController::class);

  Route::resource('deces', DecesController::class);

  Route::resource('reservations', ReservationController::class);

  Route::resource('fiches_suivi', FicheSuiviController::class);

  Route::resource('depenses', DepenseController::class);
   // -----------------------
    // BENEFICES
    // ------------------------
  Route::resource('benefices', BeneficeController::class);

     // -----------------------
    // PAIEMENTS
    // ------------------------
  Route::resource('paiements', PaiementController::class);

   // -----------------------
    // PERTES
    // ------------------------
  Route::resource('pertes', PerteController::class);
  
   // -----------------------
    // DEPENSES
    // ------------------------
  Route::resource('depenses',DepenseController::class);

     // -----------------------
    // CONTACTS
    // ------------------------
  Route::get('/contactV',[ContactController::class, 'index'])->name('contact.form');
  Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
   
   // -----------------------
    // MOUVEMENTS STOCKS
    // ------------------------
  Route::resource('mouvements_stock',MouvementStockController::class);

    // COMMANDES
// ================= COMMANDES =================

Route::get(
    '/commandes/create',
    [CommandeController::class, 'create']
)->name('commandes.create');

Route::post(
    '/commandes',
    [CommandeController::class, 'store']
)->name('commandes.store');

Route::get(
    '/commandes',
    [CommandeController::class, 'index']
)->name('commandes.index');

Route::get(
    '/commandes/{commande}',
    [CommandeController::class, 'show']
)->name('commandes.show');

Route::post(
    '/commandes/{commande}/status',
    [CommandeController::class, 'updateStatus']
)->name('commandes.status');

