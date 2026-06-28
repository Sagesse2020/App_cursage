<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>

<body style="margin:0;padding:0;background:#f3f4f6;font-family:Arial">

<div style="max-width:600px;margin:auto;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 10px 25px rgba(0,0,0,.1)">

    <div style="background:linear-gradient(135deg,#2563eb,#1d4ed8);padding:20px;color:white;text-align:center">
        <h2>Nouveau message reçu 📩</h2>
    </div>

    <div style="padding:25px">

        <p><strong>Nom :</strong> {{ $contact->nom }}</p>
        <p><strong>Email :</strong> {{ $contact->email }}</p>

        <hr>

        <p style="white-space:pre-line;font-size:15px;line-height:1.6">
            {{ $contact->message }}
        </p>

    </div>

</div>

</body>
</html>