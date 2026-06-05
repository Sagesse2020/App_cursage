<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Liste produits</title>

<style>
table{
    width:100%;
    border-collapse: collapse;
}

th, td{
    border:1px solid #ccc;
    padding:10px;
    text-align:center;
}

th{
    background:#f2f2f2;
}

a{
    text-decoration:none;
    margin:0 5px;
}

.btn{
    padding:6px 10px;
    border-radius:5px;
}

.show{background:green;color:white;}
.edit{background:orange;color:white;}
.delete{background:red;color:white;}
.add{background:blue;color:white;padding:8px 12px;}
</style>

</head>

<body>
<h1>Rapport Produits</h1>

<table border="1" width="100%">
<tr>
    <th>Nom</th>
    <th>Prix</th>
    <th>Stock</th>
</tr>

@foreach($produits as $p)
<tr>
    <td>{{ $p->nom }}</td>
    <td>{{ $p->prix_vente }}</td>
    <td>{{ $p->stock }}</td>
</tr>
@endforeach
</table>

</body>
</html>