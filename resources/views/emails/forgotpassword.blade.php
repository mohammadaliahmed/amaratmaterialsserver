<html>
<head>

</head>
<body>

<div style="background-color: #ececec;width: 400px;padding: 10px;margin: 20px;border-radius: 20px">

    <center><h2>Forgot your password?</h2>


        Dear <strong>{{$customer->name}}</strong>, <br>

        If you've lost your password or wish to reset it,<br>

        use the link below to get started

        <br>
        <a href="{{url('/').'/reset/'.$customer->reset_token}}">
            <button style="background: #0b90a8;border-radius: 5px;
            color: #fff;height: 40px;width: 200px;margin: 20px">
                Reset your password
            </button>
        </a>

        <hr>
        If you did not request a password reset you can safely ignore this email.
        Only a person with access to your email can reset your password

    </center>



</div>

</body>
</html>
