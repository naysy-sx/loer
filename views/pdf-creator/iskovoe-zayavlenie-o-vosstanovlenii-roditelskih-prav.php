<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
     <style type="text/css">
         @font-face {
             font-family: 'Source Serif Pro';
             src: url('./fonts/SourceSerifPro-regular.eot'); /* IE 9 Compatibility Mode */
             src: url('./fonts/SourceSerifPro-regular.eot?#iefix') format('embedded-opentype'), /* IE < 9 */
             url('./fonts/SourceSerifPro-regular.woff2') format('woff2'), /* Super Modern Browsers */
             url('./fonts/SourceSerifPro-regular.woff') format('woff'), /* Firefox >= 3.6, any other modern browser */
             url('./fonts/SourceSerifPro-regular.ttf') format('truetype'); /* Safari, Android, iOS */

         }
        * {
            margin:0;
            padding:0;
        }
        body{
            font-family: 'Source Serif Pro', serif;
            padding:75px 57px 75px 113px;
            text-align: justify;
            font-size: 15px;
            line-height: 100%;
        }
        .column{
            margin-left: 294px;
            text-align:left;
        }
        .date{
            text-align: left;
        }
.title{
    text-align: center;
}
.center{
    text-align: center;
}
.uppercase{
    text-transform: uppercase;
}
ul{
    list-style-type: decimal;
    margin-left:20px;
}

.redline {
    display: inline-block;
    width:34px;
}

    </style>
</head>
<body>
<div class="column">
<p>В <?=$data['sud_name']?></p>
<p><?=$data['sud_address']?></p>
    <br>
<p>Истец: <?=$data['istec_fio']?></p>
    <p>Адрес регистрации: <?=$data['istec_address']?></p>
    <p>Адрес фактического места жительства: <?=$data['istec_fact']?></p>
    <p>Номер: <?=$data['istec_phone']?></p>
    <p>Электронная почта: <?=$data['istec_email']?></p>
    <br>
    <p>Представитель по доверенности: <?=$data['isk_predstavitel']?></p>
    <br>
    <p>Ответчик: <?=$data['otvetchick_fio']?></p>
    <p>Адрес регистрации: <?=$data['otvetchick_address']?></p>
    <p>Адрес фактического места жительства: <?=$data['otvetchick_fact']?></p>
    <p>Дата рождения: <?=$data['otvetchick_birth_date']?></p>
    <p>Место рождения: <?=$data['otvetchick_birth_place']?></p>
    <p>Паспорт серия <?=$data['otvetchick_passport_seria']?> &#8470; <?=$data['otvetchick_passport_number']?></p>
    <p>Выдан: <?=$data['otvetchick_passport_vydan']?> года</p>
    <p>Код подразделения: <?=$data['otvetchick_passport_code']?></p>
    <p>Номер: <?=$data['otvetchick_phone']?></p>
    <p>Электронная почта: <?=$data['otvetchick_email']?></p>

    <br>
</div>
<div class="date">
    <p>&#171;<?=$data['date_day']?>&#187; <?=$data['date_month']?> <?=$data['date_year']?> года</p>
</div>
<div class="title">
    <br>
    <p>Исковое заявление</p>
    <p>о восстановлении родительских прав</p>
    <br>
</div>
<div class="main">
    <p><div class="redline"></div>Решением <?=$data['delo_sud']?> от <?=$data['delo_date']?> года, я лишен родительских прав в отношении <?=$data['child_fio']?>, <?=$data['child_birth']?> года рождения. Лишение прав связано с неисполнением мною родительских прав по воспитанию ребенка, в связи с <?=$data['delo_prichina']?>.</p>
    <p><div class="redline"></div>В настоящее время мое поведение, образ жизни и отношение к воспитанию детей изменилось, а именно: <?=$data['delo_izmenenie']?>.</p>
    <p> <div class="redline"></div>На сегодняшний день я хочу содержать и воспитывать ребенка, считаю, что могу создать необходимые условия для его развития и воспитания.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>На основании изложенного, руководствуясь действующим законодательством,</p>
</div>
<br>
    <p class="uppercase center">ПРОШУ СУД:</p>
    <p><div class="redline"></div>1. Восстановить <?=$data['istec_fio']?>, <?=$data['istec_birth']?> года рождения, место рождения <?=$data['istec_place']?> в родительских правах в отношении <?=$data['child_fio']?>, <?=$data['child_birth']?> года рождения.</p>
<p><div class="redline"></div></p>
    <p><div class="redline"></div>Приложения:</p>
   <p> <div class="redline"></div> 1. </p>
  <br>
<br>

<span><?=$data['isk_podpis']?> / <?=$data['isk_shifr']?></span>

</body>
</html>