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
    <title>Регистрация</title>
    <style>
        .input {
            margin-bottom: 10px
        }
    </style>
</head>
<body>
<div id="form"
    style="margin:0 auto; margin-top:10px; width: 60%; background-color: #000000; padding: 30px; border-radius: 20px; color:white">
    <h1 style="text-align: center">Регистрация</h1>
    <div class="alert alert-danger errors" style="display:none">
        <ul></ul>
    </div>
    <form action="/" method="POST" id="form_register">
        @csrf
        Имя:
        <input type="text" name="name" placeholder="Введите имя" class="form-control input" required>
        Фамилия:
        <input type="text" name="last_name" placeholder="Введите фамилию" class="form-control input" required>
        Email:
        <input type="text" name="email" placeholder="Введите email" class="form-control input" required>
        Пароль:
        <input type="text" name="password" placeholder="Введите пароль" class="form-control input" required>
        Подтверждение пароля:
        <input type="text" name="confirm_password" placeholder="Подтвердите пароль" class="form-control input" required>
        <button type="submit" class="btn btn-primary" style="margin-top: 20px">Зарегистрироваться</button>
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
                document.getElementById('form').innerHTML = '<div class="alert alert-success"><strong>Регистрация прошла успешно!</strong></div>';

            }
        }
    })
</script>
</body>
</html>
