<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau message CURSAGE</title>

    <style>
        body{
            font-family:Segoe UI, sans-serif;
            background:#f1f5f9;
            padding:20px;
        }

        .container{
            max-width:600px;
            margin:auto;
            background:white;
            border-radius:12px;
            overflow:hidden;
            box-shadow:0 10px 30px rgba(0,0,0,.1);
        }

        .header{
            background:linear-gradient(135deg,#00e6ff,#007cf0);
            padding:20px;
            color:white;
            text-align:center;
        }

        .content{
            padding:25px;
        }

        .box{
            margin-bottom:15px;
            padding:12px;
            background:#f8fafc;
            border-left:4px solid #00e6ff;
            border-radius:8px;
        }

        .label{
            font-weight:bold;
            color:#0f172a;
        }

        .footer{
            text-align:center;
            font-size:12px;
            color:#64748b;
            padding:15px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h2>📩 Nouveau message CURSAGE</h2>
    </div>

    <div class="content">

        <div class="box">
            <span class="label">👤 Nom :</span><br>
            {{ $contact->nom }}
        </div>

        <div class="box">
            <span class="label">📧 Email :</span><br>
            {{ $contact->email }}
        </div>

        <div class="box">
            <span class="label">💬 Message :</span><br>
            {{ $contact->message }}
        </div>

    </div>

    <div class="footer">
        CURSAGE SYSTEM • Message automatique
    </div>

</div>

</body>
</html>