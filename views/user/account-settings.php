<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="index-window-panel">
    <span class="index-window-panel-title text-gradient-light-red">Настройки</span>
</div>
<div class="welcome-container">
    <div class="city-form row">
        <div class="col-6" hidden>

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

            <div class="form-group" style="margin-top: 15px">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>


        <div class="col-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Введите свое имя</label>
                <input type="email" class="form-control" id="user_name" aria-describedby="emailHelp" placeholder="Ваше имя" value="<?= $model['username'] ?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="exampleFormControlFile1">Загрузите аватар</label>
                <input type="file" class="form-control-file" id="user_avatar">
            </div>
        </div>
        <div class="col-6">
            <button class="btn btn-success save-user-settings"> Сохранить</button>
        </div>
    </div>
</div>

<script>
    // $(document).on("click", ".save-user-settings", function() {
    //     $url = '/index.php?r=user/ajax-user-change'
    //     let is_change = false;
    //     let username = $('#user_name').val();
    //     let user_avatar = $('#user_avatar').val();
    //     // alert(user_name);
    //     if(is_change){
    //         $.get($url, {
    //             username
    //         }, function(res) {
    //             //$('.action-area').text('Задача сохранена');
    //             window.location.reload();
    //         });
    //     }
    // })

    let btn_save_user_change = document.querySelector('.save-user-settings');
    btn_save_user_change.addEventListener('click', () => {
        $url = '/index.php?r=user/ajax-user-change';
        let username = document.querySelector('#user_name').value;
        username = `&username=${username}`;
        fetch($url + username).then(i => i.json()).then(i => {});
    })
</script>



<div class="index-window-panel" style="margin-top: 50px">
    <span class="index-window-panel-title text-gradient-light-red">Тарифы</span>
</div>
<div class="welcome-container">

    <style>
        .price-card {
            border: 1px solid gainsboro;
            text-align: center;
            border-radius: 6px;
            padding: 15px;
        }

        .price-card:hover {
            background-color: #eeeeee;
        }

        .pc-title {
            border-bottom: 1px solid gainsboro;
            font-weight: 700;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }
    </style>

    <div class="row">
        <div class="col-md-4">
            <div class="price-card">
                <div class="pc-title">Юристу/Адвокату</div>
                - преимущества<br>
                - преимущества<br>
                - преимущества<br>
                - преимущества<br>
                - преимущества<br>
                - преимущества<br>
                <br>
                <button class="btn btn-outline-dark" disabled>тариф активен</button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="price-card">
                <div class="pc-title">Юридической компании/Адвокатскому кабинету</div>
                - преимущества<br>
                - преимущества<br>
                - преимущества<br>
                - преимущества<br>
                - преимущества<br>
                - преимущества<br>
                <br>
                <button class="btn btn-success">Подключить</button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="price-card">
                <div class="pc-title">Персональное предложение</div>
                - преимущества<br>
                - преимущества<br>
                - преимущества<br>
                - преимущества<br>
                - преимущества<br>
                - преимущества<br>
                <br>
                <button class="btn btn-success">Подключить</button>
            </div>
        </div>
    </div>

</div>