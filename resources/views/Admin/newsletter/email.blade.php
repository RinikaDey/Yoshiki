<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $subject }}</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f4f4; padding:30px;">

<div style="max-width:600px; margin:auto; background:#ffffff; padding:30px; border-radius:8px;">

    <h2 style="color:#333;">{{ $subject }}</h2>

    <hr>

    <p style="font-size:16px; line-height:1.8;">
        {!! nl2br(e($messageBody)) !!}
    </p>

    <br>

    <p>Thank you for being with us.</p>

    <p><strong>Yoshiki x Rini</strong></p>

    <hr>
    <br>
    <div style="text-align:center">

        <a href="{{ route('newsletter.unsubscribe', $subscriber->unsubscribe_token) }}"
        style="
            background:red;
            color:white;
            padding:10px 20px;
            text-decoration:none;
            border-radius:5px;
        ">

            Unsubscribe

        </a>

    </div>


</div>

</body>
</html>
