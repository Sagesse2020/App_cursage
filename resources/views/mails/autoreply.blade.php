<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>

<body style="font-family:Arial;background:#f9fafb;padding:20px">

<div style="max-width:600px;margin:auto;background:white;padding:25px;border-radius:12px">

    <h2 style="color:#2563eb">Merci pour votre message 🙏</h2>

    <p>Bonjour {{ $contact->nom }},</p>

    <p>
        Nous avons bien reçu votre message et nous vous répondrons rapidement.
    </p>

    <div style="background:#f3f4f6;padding:15px;border-radius:10px;margin-top:20px">
        <strong>Votre message :</strong><br>
        {{ $contact->message }}
    </div>

    <p style="margin-top:20px;color:#64748b">
        — CURSAGE SYSTEM
    </p>

</div>

</body>
</html>