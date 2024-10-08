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
    <p>Госпошлина: <?=$data['isk_poshlina']?> рублей.</p>
    <p>Цена иска: <?=$data['isk_price']?> рублей.</p>
    <br>
</div>
<div class="date">
    <p>&#171;<?=$data['date_day']?>&#187; <?=$data['date_month']?> <?=$data['date_year']?> года</p>
</div>
<div class="title">
    <br>
    <p>Исковое заявление</p>
    <p>о расторжении брака и разделе имущества</p>
    <br>
</div>
<div class="main">
    <p><div class="redline"></div>Между Истцом и Ответчиком &#171;<?=$data['brak_date_day']?>&#171; <?=$data['brak_date_month']?> <?=$data['brak_date_year']?> года был заключен брак, что подтверждается свидетельством о заключении брака серия <?=$data['brak_seria']?> № <?=$data['brak_number']?>, актовая запись № <?=$data['brak_act']?>.</p>
    <p><div class="redline"></div>Проживали и вели совместное хозяйство с <?=$data['brak_start']?> года. С <?=$data['brak_end']?> года в связи с <?=$data['brak_prichina']?> Ответчик переехал на другое место жительства, по адресу: <?=$data['brak_address']?>. Дальнейшая совместная жизнь между нами невозможна. </p>
    <p><div class="redline"></div>За период брака нами совместно было приобретено следующее имущество:</p>
    <p> <div class="redline"></div> 1.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>В добровольном порядке Ответчик отказался разделить имущества.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>На основании изложенного, руководствуясь действующим законодательством,</p>
</div>
<br>
    <p class="uppercase center">ПРОШУ СУД:</p>
    <p><div class="redline"></div>1. Расторгнуть зарегистрированный <?=$data['brak_date']?> между <?=$data['istec_fio']?>, <?=$data['istec_birth']?> года рождения и <?=$data['otvetchick_fio']?>, <?=$data['otvetchick_birth_date']?> года рождения, брак;</p>
        <p><div class="redline"></div>2. В собственность Истца выделить: <?=$data['istec_videlyt']?> общей стоимостью <?=$data['istec_price']?> рублей.</p>
    <p><div class="redline"></div>3. В собственность Ответчика выделить <?=$data['otvetchick_videlyt']?> общей стоимостью <?=$data['otvetchick_price']?> рублей.</p>
    <p><div class="redline"></div></p>
<p><div class="redline"></div></p>
    <p><div class="redline"></div>Приложения:</p>
   <p> <div class="redline"></div> 1. Квитанция об оплате государственной пошлины;</p>
<p> <div class="redline"></div> 2. Копия паспорта Истца;</p>
<p> <div class="redline"></div> 3. Оригинал свидетельства о браке;</p>
<p> <div class="redline"></div> 4. </p>
  <br>
<br>

<span><?=$data['isk_podpis']?> / <?=$data['isk_shifr']?></span>

</body>
</html>