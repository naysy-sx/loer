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
        <span class="auth-h text-gradient-light-red" style="font-size: 30px;">Восстановление пароля</span>
        <form id="login-form" class="auth-form">
            <div class="account-window-tab-container">
                <div class="mb-3 row account-window-tab-flex">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-12">
                        <input type="Email" name="login" class="form-control" id="inputPassword"
                               placeholder="name@mail.ru">
                    </div>
                </div>
                <button type="submit" class="btn user-btn auth-btn">
                    Восстановить
                </button>
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
<script type="text/javascript" charset="utf8" src="./js/components/datatables.net/js/jquery.dataTables.js"></script>

<script>

</script>
</body>
</html>