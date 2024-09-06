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
    <p>(<?=$data['sud_instancia2']?>)</p>
    <br>
    <p>Через:</p>
    <p><?=$data['sud_name']?></p>
    <p>(<?=$data['sud_instancia1']?>)</p>
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
    <p>Адрес: <?=$data['otvetchick_address']?></p>
    <p>ИНН: <?=$data['otvetchick_inn']?></p>
    <p>Номер: <?=$data['otvetchick_phone']?></p>
    <p>Электронная почта: <?=$data['otvetchick_email']?></p>
    <br>
    <p>Заинтересованное лицо: <?=$data['zainteresovannoe_fio']?></p>
    <p>Адрес: <?=$data['zainteresovannoe_address']?></p>
    <br>
    <p>Третье лицо: <?=$data['tretje_fio']?></p>
    <p>Адрес: <?=$data['tretje_address']?></p>
    <br>
    <p>Дело &#8470;: <?=$data['delo_number']?></p>
    <br>
</div>
<div class="date">
    <p>&#171;<?=$data['date_day']?>&#187; <?=$data['date_month']?> <?=$data['date_year']?> года</p>
</div>
<div class="title">
    <br>
    <p>Возражения</p>
    <p>на апелляционную жалобу</p>
    <br>

</div>
<div class="main">
    <p><div class="redline"></div>&#171;<?=$data['delo_day']?>&#187; <?=$data['delo_month']?> <?=$data['delo_year']?> года <?=$data['delo_sud']?> <?=$data['sud_instancia1']?> было вынесено решение по делу по иску <?=$data['delo_isk']?> к <?=$data['delo_k']?> о <?=$data['delo_o']?>.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>В <?=$data['delo_sud2']?> (<?=$data['sud_instancia2']?>) <?=$data['delo_kto']?> была подана апелляционная жалоба, в которой заявлено <?=$data['delo_zayavleno']?>. С апелляционной жалобой не согласен по следующим основаниям:</p>
   <p><div class="redline"></div>1. Во-первых, <?=$data['delo_osnovania']?> </p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>На основании изложенного, руководствуясь действующим законодательством,</p>
</div>
<br>
<p class="uppercase center">ПРОШУ СУД: </p>
<p><div class="redline"></div>1. Оставить решение <?=$data['delo_sud']?> (<?=$data['sud_instancia1']?>) от &#171;<?=$data['delo_day']?>&#187; <?=$data['delo_month']?> <?=$data['delo_year']?> года по делу &#8470; <?=$data['delo_number2']?> без изменения, апелляционную жалобу без удовлетворения.</p>
<p><div class="redline"></div></p>
<p><div class="redline"></div></p>
<p><div class="redline"></div>Приложения:</p>
<p> <div class="redline"></div> 1. </p>
<br>
<br>
<span><?=$data['isk_podpis']?> / <?=$data['isk_shifr']?></span>
</body>
</html>