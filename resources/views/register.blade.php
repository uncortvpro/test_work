<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Registration</title>
    <style>
        .input {
            margin-bottom: 10px
        }
    </style>
</head>
<body>
<div id="form"
    style="margin:0 auto; margin-top:10px; width: 60%; background-color: #000000; padding: 30px; border-radius: 20px; color:white">
    <h1 style="text-align: center">Registration</h1>
    <div class="alert alert-danger errors" style="display:none">
        <ul></ul>
    </div>
    <form action="/" method="POST" id="form_register">
        @csrf
        Name:
        <input type="text" name="name" placeholder="Enter name" class="form-control input" required>
        Last name:
        <input type="text" name="last_name" placeholder="Enter last name" class="form-control input" required>
        Email:
        <input type="text" name="email" placeholder="Enter email" class="form-control input" required>
        Password:
        <input type="text" name="password" placeholder="Enter password" class="form-control input" required>
        Confirm password:
        <input type="text" name="confirm_password" placeholder="Confirm password" class="form-control input" required>
        <button type="submit" class="btn btn-primary" style="margin-top: 20px">Create account</button>
    </form>
</div>

<script>

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#form_register").on('submit', function (e) {

            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: '/',
                type: 'post',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.success) {
                        printMsg(data.success,'success');
                    }
                    else if (data.error_email) {
                        printMsg(data.error_email, 'error_email');
                    } else {
                        printMsg(data.error, 'errors');
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        })

        function printMsg(msg, type_message) {
            if (type_message == 'errors') {
                $(".errors").find("ul").html('');
                $(".errors").css('display', 'block');
                $.each(msg, function (key, value) {
                    $(".errors").find("ul").append('<li>' + value + '</li>');
                });
            } else if (type_message == 'error_email') {
                $(".errors").find("ul").html('');
                $(".errors").css('display', 'block');
                $(".errors").find("ul").append('<li>' + msg + '</li>');
            }else if(type_message == 'success'){
                document.getElementById('form').innerHTML = '<div class="alert alert-success"><strong>'+msg+'</strong></div>';

            }
        }
    })
</script>
</body>
</html>
