namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();

        if ($request->filled('search')) {
            $query->where('nom', 'like', '%'.$request->search.'%');
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $services = $query->latest()->paginate(10);

        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'prix_vente' => 'required|numeric|min:0',
            'statut' => 'required|in:en_cours,termine'
        ]);

        $service = Service::create($data);

        // 🔔 NOTIFICATION CREATE
        Notification::create([
            'titre' => 'Nouveau service',
            'message' => 'Service "' . $service->nom . '" ajouté avec succès',
            'type' => 'success',
            'lu' => false,
            'user_id' => Auth::id()
        ]);

        return redirect()
            ->route('services.index')
            ->with('success', 'Service enregistré avec succès');
    }

    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'prix_vente' => 'required|numeric|min:0',
            'statut' => 'required|in:en_cours,termine'
        ]);

        $service->update($data);

        // 🔔 NOTIFICATION UPDATE
        Notification::create([
            'titre' => 'Service modifié',
            'message' => 'Service "' . $service->nom . '" a été mis à jour',
            'type' => 'info',
            'lu' => false,
            'user_id' => Auth::id()
        ]);

        return redirect()
            ->route('services.index')
            ->with('success', 'Service modifié avec succès');
    }

    public function destroy(Service $service)
    {
        $nom = $service->nom;

        $service->delete();

        // 🔔 NOTIFICATION DELETE
        Notification::create([
            'titre' => 'Service supprimé',
            'message' => 'Service "' . $nom . '" a été supprimé',
            'type' => 'danger',
            'lu' => false,
            'user_id' => Auth::id()
        ]);

        return back()
            ->with('success', 'Service supprimé');
    }
}