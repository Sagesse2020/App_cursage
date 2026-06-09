
<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Contact CURSAGE</title>

<link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{
background:
linear-gradient(rgba(2,6,23,.92),rgba(2,6,23,.92)),
url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3');
background-size:cover;
background-position:center;
min-height:100vh;
display:flex;
justify-content:center;
align-items:center;
padding:20px;
}

.container{
width:100%;
max-width:700px;
background:white;
border-radius:20px;
overflow:hidden;
box-shadow:0 15px 40px rgba(0,0,0,.25);
}

.header{
background:linear-gradient(135deg,#00e6ff,#007cf0);
padding:30px;
text-align:center;
color:white;
}

.header i{
font-size:50px;
margin-bottom:15px;
}

.header h1{
font-size:32px;
}

.content{
padding:35px;
}

.alert{
background:#dcfce7;
color:#166534;
padding:15px;
border-radius:10px;
margin-bottom:20px;
}

.form-group{
margin-bottom:20px;
}

label{
display:block;
margin-bottom:8px;
font-weight:600;
color:#0f172a;
}

input,
textarea{
width:100%;
padding:14px;
border:1px solid #cbd5e1;
border-radius:10px;
outline:none;
transition:.3s;
}

input:focus,
textarea:focus{
border-color:#00e6ff;
box-shadow:0 0 10px rgba(0,230,255,.2);
}

textarea{
resize:none;
}

.btn{
width:100%;
padding:15px;
border:none;
border-radius:12px;
background:linear-gradient(135deg,#00e6ff,#007cf0);
color:white;
font-size:16px;
font-weight:bold;
cursor:pointer;
transition:.3s;
}

.btn:hover{
transform:translateY(-2px);
}

.footer{
text-align:center;
padding:20px;
color:#64748b;
font-size:13px;
border-top:1px solid #e2e8f0;
}

@media(max-width:768px){

.header h1{
font-size:24px;
}

.content{
padding:20px;
}

}

</style>

</head>
<body>

<div class="container">

<div class="header">
<i class="fas fa-envelope-open-text"></i>
<h1>Contactez CURSAGE</h1>
<p>Nous répondons rapidement à toutes vos demandes.</p>
</div>

<div class="content">

@if(session('success'))

<div class="alert">
<i class="fas fa-check-circle"></i>
{{ session('success') }}
</div>

@endif

<form action="{{ route('contact.send') }}" method="POST">

@csrf

<div class="form-group">
<label>Nom complet</label>
<input type="text"
name="nom"
value="{{ old('nom') }}"
required>
</div>

<div class="form-group">
<label>Adresse email</label>
<input type="email"
name="email"
value="{{ old('email') }}"
required>
</div>

<div class="form-group">
<label>Votre message</label>

<textarea
name="message"
rows="6"
required>{{ old('message') }}</textarea>

</div>

<button class="btn" type="submit">
<i class="fas fa-paper-plane"></i>
 Envoyer le message
</button>

</form>

</div>

<div class="footer">
© {{ date('Y') }} CURSAGE SYSTEM
</div>

</div>

</body>
</html>