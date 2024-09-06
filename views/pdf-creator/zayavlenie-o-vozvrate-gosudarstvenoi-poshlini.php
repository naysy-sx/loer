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
    <p>Заявление</p>
    <p>о возврате государственной пошлины</p>
    <br>

</div>
<div class="main">
    <p><div class="redline"></div>При подаче искового заявления в <?=$data['delo_sud']?> Истец оплатил государственную пошлину в размере <?=$data['delo_poshlina']?> рублей. Однако, государственная пошлина подлежит возврату в связи с <?=$data['delo_pricina']?>.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>На основании изложенного, руководствуясь действующим законодательством,</p>
</div>
<br>
<p class="uppercase center">ПРОШУ СУД: </p>
<p><div class="redline"></div>1. Произвести возврат государственной пошлины в размере <?=$data['delo_poshlina']?> рублей, уплаченной Истцом <?=$data['delo_date']?> года.</p>
<p><div class="redline"></div>2. Выдать справку о возврате госпошлины для налогового органа.</p>
<p><div class="redline"></div></p>
<p><div class="redline"></div></p>
<p><div class="redline"></div>Приложения:</p>
<p> <div class="redline"></div> 1. Квитанция от <?=$data['kvitancia_ot']?> № <?=$data['kvitancia_number']?>;</p>
<p> <div class="redline"></div> 2. </p>
<br>
<br>
<span><?=$data['isk_podpis']?> / <?=$data['isk_shifr']?></span>
</body>
</html>