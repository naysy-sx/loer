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
<p>В <?=$data['sud_name']?> </p>
<p><?=$data['sud_address']?></p>
    <br>
    <p>Заявитель: <?=$data['zayavitel_fio']?></p>
    <p>Адрес регистрации: <?=$data['zayavitel_address']?></p>
    <p>Адрес фактического места жительства: <?=$data['zayavitel_fact']?></p>
    <p>Паспорт серия <?=$data['zayavitel_passport_seria']?> &#8470; <?=$data['zayavitel_passport_number']?></p>
    <p>Выдан: <?=$data['zayavitel_passport_vydan']?> года</p>
    <p>Код подразделения: <?=$data['zayavitel_passport_code']?></p>
    <p>Номер: <?=$data['zayavitel_phone']?></p>
    <p>Электронная почта: <?=$data['zayavitel_email']?></p>
    <br>
    <p>Представитель: <?=$data['predstavitel_fio']?></p>
    <br>
    <p>Защитник: <?=$data['zaschitnick_fio']?></p>
    <br>
    <p>Дело &#8470;: <?=$data['delo_number']?></p>
    <br>
</div>
<div class="date">
    <p>&#171;<?=$data['date_day']?>&#187; <?=$data['date_month']?> <?=$data['date_year']?> года</p>
</div>
<div class="title">
    <br>
    <p>Объяснение</p>
    <p>по делу об административном правонарушении</p>
    <br>

</div>
<div class="main">
    <p><div class="redline"></div>В производстве <?=$data['delo_sud']?> рассматривается дело об административном правонарушении в отношении <?=$data['delo_kto']?>, привлекаемого по <?=$data['delo_privlechenpo']?> КоАП РФ.</p>
    <p><div class="redline"></div>Основанием для привлечения к ответственности послужило <?=$data['delo_osnovanie']?>.</p>
    <p><div class="redline"></div>С вышеуказанным нарушением Заявитель <?=$data['delo_soglasie']?>.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>На основании изложенного, руководствуясь действующим законодательством,</p>
</div>
<br>
<p class="uppercase center">ПРОШУ СУД: </p>
<p><div class="redline"></div>1. Приобщить настоящее объяснение к материалам дела &#8470; <?=$data['delo_number2']?> по делу об административном правонарушении;</p>
<p><div class="redline"></div>2. </p>
<p><div class="redline"></div></p>
<p><div class="redline"></div>Приложения:</p>
<p><div class="redline"></div>1. </p>
<br>
<br>
<span><?=$data['isk_podpis']?> / <?=$data['isk_shifr']?></span>
</body>
</html>