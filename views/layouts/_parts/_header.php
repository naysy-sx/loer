<?php

use app\models\CheckOverdueTask;

CheckOverdueTask::start();
?>
<style>
    /*main, .index-container{*/
    /*    height: calc(100vh - 90px) !important;*/
    /*}*/
    .header-container{
        background: #b09da0 !important;
    }
</style>
<header>
    <div class="header-container">
        <nav class="navbar navbar-dark bg-light navbar-expand-md fixed-top header-navbar content">
            <div class="container-fluid">
                <a class="navbar-brand glitch_" data-text="Lawico" href="index.php?r=user" style="font-weight:100;">
                    Lawico
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

                    <style>
                        .secondNav {
                            position: absolute;
                            margin-top: 23px;
                            margin-left: 25px;
                            color: #e7e7e7;
                            display: flex;
                            flex-direction: row;
                            flex-wrap: nowrap;
                            align-content: center;
                            justify-content: space-between;
                            width: calc(100% - 640px);
                        }

                        .secondNav a {
                            width: 100%;
                            text-align: center;
                        }
                    </style>

                    <div class="secondNav">
                        <a href="index.php?r=user">Главная</a>
                        <a href="index.php?r=calendar">Задачи</a>
                        <a href="index.php?r=crm">CRM</a>
                        <a href="index.php?r=clients">Дела</a>
                        <a href="index.php?r=court-cases" hidden>Таблица дел</a>
                        <a href="index.php?r=services">Сервисы</a>
                        <a href="index.php?r=my-company">Компания</a>
                    </div>

                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title glitch glitch-dark" data-text="Logo" id="offcanvasNavbarLabel">
                            Logo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="header-sos">
                            <div class="dropdown">
                                <style>
                                   .dropdown-menu {
                                        max-height: 350px;
                                        overflow-y: auto;
                                    }
                                </style>
                                <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" onclick="window.location.href='index.php?r=help'">
                                    <img src="./img/help.png" alt="notification">
                                </button>

                                <!--                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">-->
                                <!--                                    <form class="account-window-tab-company row">-->
                                <!--                                        <span class="account-window-tab-company-title ">Сообщение в поддержку</span>-->
                                <!--                                        <div class=" account-window-tab-company-variable">-->
                                <!--                                          <textarea type="text" class="form-control" value="-->
                                <!--                                          " id="exampleFormControlInput1" placeholder="Опишите проблему"-->
                                <!--                                                    rows="5"></textarea>-->
                                <!--                                        </div>-->
                                <!--                                    </form>-->
                                <!--                                    <button type="button"-->
                                <!--                                            class="btn btn-primary index-window-panel-add-button custom-btn btn-8">-->
                                <!--                                        <span>Отправить</span></button>-->
                                <!--                                </div>-->
                            </div>
                        </div>
                        <div class="header-notification">
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="header-notification-count bg-success">4</span>
                                    <img src="./img/notification.png" alt="notification" id="notification_icon">

                                </button>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <?php
                                    $res = app\models\Notifications::find()->where(['user_id' => Yii::$app->user->id])->orderBy(['id' => SORT_DESC])->all();
                                    $html = '';
                                    foreach ($res as $row) {
                                        $html .= '<li>
                                                <a class="dropdown-item" href="#">
                                                    <div class="header-notification-container">
                                                       <span class="header-notification-message">
                                                          ' . $row['title'] . '
                                                            </span>
                                                         <span class="header-notification-date">' . $row['datetime'] . '</span>
                                                    </div>
                                                </a>
                                              </li>';
                                    }
                                    echo $html;
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="d-flex offcanvas-footer header-account">
                            <div class="dropdown">
                                <a class="btn dropdown-toggle header-navbar-icon" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    <!-- <img src="./img//20182807105210.jpg" alt="icon"> -->
                                    <style>
                                        #dropdownMenuLink {
                                            background-image: url(./img//20182807105210.jpg);
                                            background-position: center;
                                            background-size: cover;
                                        }
                                    </style>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li class="header-account-top">
                                        <div class="header-account-top-info">
                                            <span class="header-account-top-info-name">
                                                <?php echo Yii::$app->user->identity->username ?>
                                            </span>
                                            <span class="header-account-top-info-surname" style="font-size: 14px">
                                                id: 00000<?php echo Yii::$app->user->identity->id ?>
                                            </span>
                                            <span class="header-account-top-info-status">Адвокат</span>
                                            <br>
                                            <a href="index.php?r=site/logout" style="color: #343434">Выйти</a>
                                        </div>
                                        <a class="dropdown-item header-account-top-link" href="index.php?r=user/account-settings"><img src="./img/settings.png" alt="settings"></a>
                                    </li>
                                    <li class="header-account-bottom"><a class="dropdown-item header-account-bottom-tariff" href="./account.html">
                                            <span class="header-account-bottom-tariff-span">Тариф:</span>
                                            <span class="header-account-bottom-tariff-name">Базовый</span>
                                        </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>