<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" type="text/css" href="./js/components/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="./js/components/datatables.net-dt/css/jquery.dataTables.css">
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body class="bg-img">

<header>
    <div class="header-container auth-header">
        <nav class="navbar navbar-dark bg-light navbar-expand-md fixed-top header-navbar content">
            <div class="container-fluid">
                <a class="navbar-brand glitch_" data-text="ЮрПортал" href="index.php"  style="font-weight:100;">
                    Lawico
                </a>
            </div>
        </nav>
    </div>
</header>

<main class="auth">
    <div class="auth-container">
        <span class="auth-h text-gradient-light-red">Авторизация</span>
        <form id="login-form" class="auth-form">
            <div class="account-window-tab-container">
                <div class="mb-3 row account-window-tab-flex">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-12">
                        <input type="Email" name="login" class="form-control" id="inputPassword"
                               placeholder="name@mail.ru">
                    </div>
                </div>
                <div class="mb-3 row account-window-tab-flex">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Пароль</label>
                    <div class="col-12">
                        <input type="password" name="pass" class="form-control" id="inputPassword"
                               placeholder="**********">
                    </div>
                </div>
                <button type="submit" class="btn user-btn auth-btn">
                    Войти
                </button>
            </div>
        </form>

        <div class="auth-nav">
            <a href="index.php?r=site/recovery" class="auth-nav-check">Забыли пароль?</a>
            <a href="index.php?r=site/reg" class="auth-nav-check">Регистрация</a>
        </div>
    </div>
</main>

<script type="text/javascript" src="./js/components/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="./js/components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="./js/components/datatables.net/js/jquery.dataTables.js"></script>

<script>
    jQuery(function ($) {
        $('#login-form').submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: 'index.php?r=ajax/login',
                type: 'get',
                data: $('#login-form').serialize(),
                success: function (res) {
                    if (res == 1) {
                        window.location.href = 'index.php?r=user';
                    } else {
                        $('.err').text('Ошибка авторизации');

                        if (res === 'err_login'){
                            $('.err').text('Введите логин');
                        }
                        if (res === 'err_pass'){
                            $('.err').text('Введите пароль');
                        }
                        if (res === 'wrong_pass'){
                            $('.err').text('Вы ввели неверный пароль');
                        }
                    }
                }
            });
        });
    });
</script>
</body>
</html>