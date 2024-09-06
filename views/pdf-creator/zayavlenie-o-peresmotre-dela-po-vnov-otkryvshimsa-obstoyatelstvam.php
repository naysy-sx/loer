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
    <p>о пересмотре дела по вновь открывшимся обстоятельствам</p>
    <br>
</div>
<div class="main">
    <p><div class="redline"></div>&#171;<?=$data['delo_day']?>&#187; <?=$data['delo_month']?> <?=$data['delo_year']?> года <?=$data['delo_sud']?> вынесено <?=$data['delo_vineseno']?> по делу № <?=$data['delo_number2']?> согласно которому <?=$data['delo_soglasnokotoromy']?>.</p>
    <p><div class="redline"></div>Истец считает, что <?=$data['delo_vineseno']?> подлежит пересмотру по вновь открывшимся обстоятельствам:</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>Согласно п. 2 ст. 392 ГПК РФ Основаниями для пересмотра вступивших в законную силу судебных постановлений являются:</p>
    <p><div class="redline"></div>1) вновь открывшиеся обстоятельства - указанные в части третьей настоящей статьи и существовавшие на момент принятия судебного постановления существенные для дела обстоятельства;</p>
    <p><div class="redline"></div>2) новые обстоятельства - указанные в части четвертой настоящей статьи, возникшие после принятия судебного постановления и имеющие существенное значение для правильного разрешения дела обстоятельства.</p>
<p><div class="redline"></div>В соответствии с п.3. ст. 392 ГПК РФ, к вновь открывшимся обстоятельствам относятся:</p>
    <p><div class="redline"></div>1) существенные для дела обстоятельства, которые не были и не могли быть известны заявителю;</p>
    <p><div class="redline"></div>2) заведомо ложные показания свидетеля, заведомо ложное заключение эксперта, заведомо неправильный перевод, фальсификация доказательств, повлекшие за собой принятие незаконного или необоснованного судебного постановления и установленные вступившим в законную силу приговором суда;</p>
    <p><div class="redline"></div>3) преступления сторон, других лиц, участвующих в деле, их представителей, преступления судей, совершенные при рассмотрении и разрешении данного дела и установленные вступившим в законную силу приговором суда.</p>
  <p><div class="redline"></div></p>
    <p><div class="redline"></div>На основании изложенного, руководствуясь действующим законодательством,</p>
</div>
<br>
    <p class="uppercase center">ПРОШУ СУД:</p>
    <p><div class="redline"></div>1. Пересмотреть <?=$data['delo_peresmotret']?> по делу № <?=$data['delo_number2']?> по иску <?=$data['delo_isk']?> к <?=$data['istec_fio']?> о <?=$data['delo_o']?> по вновь открывшимся обстоятельствам.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>Приложения:</p>
   <p> <div class="redline"></div>  1.</p>
  <br>
<br>

<span><?=$data['isk_podpis']?> / <?=$data['isk_shifr']?></span>

</body>
</html>