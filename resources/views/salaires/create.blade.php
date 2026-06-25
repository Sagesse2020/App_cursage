<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Nouveau salaire</title>

<style>
body{font-family:'Segoe UI';background:#f1f5f9;padding:25px;}
.container{max-width:800px;margin:auto;background:white;padding:30px;border-radius:15px;}
.form-group{margin-bottom:15px;display:flex;flex-direction:column;}
input,select{padding:12px;border-radius:10px;border:1px solid #ccc;}
.btn{background:#2563eb;color:#fff;padding:12px;border:none;border-radius:10px;width:100%;}
</style>
</head>

<body>

<div class="container">

<h1>💼 Nouveau salaire</h1>

<form action="{{ route('salaires.store') }}" method="POST">
@csrf

<div class="form-group">
<label>Employé</label>
<select name="employee_id">
@foreach($employees as $e)
<option value="{{ $e->id }}">{{ $e->nom }}</option>
@endforeach
</select>
</div>

<div class="form-group">
<label>Mois</label>
<input type="text" name="mois">
</div>

<div class="form-group">
<label>Salaire base</label>
<input type="number" name="salaire_base">
</div>

<div class="form-group">
<label>Prime</label>
<input type="number" name="prime">
</div>

<div class="form-group">
<label>Retenue</label>
<input type="number" name="retenue">
</div>

<div class="form-group">
<label>Statut</label>
<select name="statut">
<option value="en_attente">En attente</option>
<option value="paye">Payé</option>
</select>
</div>

<button class="btn">Enregistrer</button>

</form>

</div>

</body>
</html>