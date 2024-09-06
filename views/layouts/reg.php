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
                <a class="navbar-brand glitch_" data-text="Lawico" href="index.php" style="font-weight:100;">
                    Lawico
                </a>
            </div>
        </nav>
    </div>
</header>

<main class="auth">
    <div class="auth-container">
        <span class="auth-h text-gradient-light-red">Регистрация</span>
        <form id="reg-form" class="auth-form">
            <div class="account-window-tab-container">
                <div class="mb-3 row account-window-tab-flex">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-12">
                        <input type="Email" name="login" class="form-control" id="inputPassword"
                               placeholder="name@mail.ru">
                    </div>
                </div>
                <div class="mb-3 row account-window-tab-flex">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Имя</label>
                    <div class="col-12">
                        <input type="text" name="name" class="form-control" id="inputPassword" placeholder="Ольга">
                    </div>
                </div>
                <div class="mb-3 row account-window-tab-flex">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Пароль</label>
                    <div class="col-12">
                        <input type="password" name="password" class="form-control" id="inputPassword"
                               placeholder="**********">
                    </div>
                </div>

                <div class="btn-group  w-100 mt-3" role="group" aria-label="Basic radio toggle button group">

                    <div class="col-6">
                        <input type="radio" class="btn-check " name="role" id="btnradio1" autocomplete="off" checked
                               value="1">
                        <label class="btn btn-outline-secondary w-100" for="btnradio1"
                               style="border-radius: 10px 0 0 10px;">Один пользователь</label>
                    </div>
                    <div class="col-6">
                        <input type="radio" class="btn-check " name="role" id="btnradio2" autocomplete="off" value="2">
                        <label class="btn btn-outline-secondary w-100" for="btnradio2"
                               style="border-radius: 0 10px 10px 0;">Компания</label>
                    </div>
                </div>

                <div class="col-12 error" style="margin-top: 15px; margin-bottom: -15px">

                </div>

                <div class="col-12 mt-5" style="text-align: center;">
                    <input type="submit"
                           class="btn user-btn"
                           value="Зарегистрироваться">
                </div>

                <div class="col-2"></div>
                <div class="col-8 mt-5 text-center mx-auto">
                    Нажимая на кнопку "Зарегистрироваться", вы соглашаетесь с Офертой и
                    <a href="#!" class="link-primary"> Политикой конфиденцальности</a>
                </div>
                <!-- const selected = document.querySelector('input[name="fruit"]:checked').value; -->

                <!-- <input type="submit" class="btn btn-primary index-window-panel-add-button custom-btn btn-8"></input> -->
            </div>
        </form>

        <div class="auth-nav">
            <a href="index.php?r=site/recovery" class="auth-nav-check">Забыли пароль?</a>
            <a href="index.php?r=site/login" class="auth-nav-check">Войти</a>
        </div>
    </div>
</main>

<script type="text/javascript" src="./js/components/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="./js/components/jquery/dist/jquery.min.js"></script>

<script>
    jQuery(function ($) {
        $('#reg-form').submit(function (e) {
            e.preventDefault();
            let res = $('#reg-form').serialize();
            //    console.log(res);
            //    return 1;
            $.ajax({
                url: 'index.php?r=ajax/register',
                type: 'get',
                data: $('#reg-form').serialize(),
                success: function (res) {
                    if (res == 'user_already_exists'){
                        $('.error').text('Такой пользователь уже существует');
                    }
                    if (res == 'err_name'){
                        $('.error').text('Введите имя');
                    }
                    if (res == 'err_login'){
                        $('.error').text('Введите логин');
                    }
                    if (res == 'err_pass'){
                        $('.error').text('Введите пароль');
                    }
                    if (res == 1) {
                        window.location.href = 'index.php?r=site/login';
                    }
                }
            });
        });
    });
</script>
</body>

</html>