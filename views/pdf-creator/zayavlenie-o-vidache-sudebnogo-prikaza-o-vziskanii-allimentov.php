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
<p>Взыскатель: <?=$data['vziskatel_fio']?></p>
    <p>Адрес регистрации: <?=$data['vziskatel_address']?></p>
    <p>Адрес фактического места жительства: <?=$data['vziskatel_fact']?></p>
    <p>Номер: <?=$data['vziskatel_phone']?></p>
    <p>Электронная почта: <?=$data['vziskatel_email']?></p>
    <br>
    <p>Представитель по доверенности: <?=$data['isk_predstavitel']?></p>
    <br>
    <p>Должник: <?=$data['dolzhnick_fio']?></p>
    <p>Адрес регистрации: <?=$data['dolzhnick_address']?></p>
    <p>Адрес фактического места жительства: <?=$data['dolzhnick_fact']?></p>
    <p>Дата рождения: <?=$data['dolzhnick_birth_date']?></p>
    <p>Место рождения: <?=$data['dolzhnick_birth_place']?></p>
    <p>Паспорт серия <?=$data['dolzhnick_passport_seria']?> &#8470; <?=$data['dolzhnick_passport_number']?></p>
    <p>Выдан: <?=$data['dolzhnick_passport_vydan']?> года</p>
    <p>Код подразделения: <?=$data['dolzhnick_passport_code']?></p>
    <p>Номер: <?=$data['dolzhnick_phone']?></p>
    <p>Электронная почта: <?=$data['dolzhnick_email']?></p>
    <br>
    <p>Госпошлина: <?=$data['isk_poshlina']?> рублей.</p>
    <br>
</div>
<div class="date">
    <p>&#171;<?=$data['date_day']?>&#187; <?=$data['date_month']?> <?=$data['date_year']?> года</p>
</div>
<div class="title">
    <br>
    <p>Заявление</p>
    <p>о выдаче судебного приказа о взыскании алиментов</p>
    <br>
</div>
<div class="main">
    <p><div class="redline"></div>Между Истцом и Ответчиком &#171;<?=$data['brak_date_day']?>&#171; <?=$data['brak_date_month']?> <?=$data['brak_date_year']?> года был заключен брак, что подтверждается свидетельством о заключении брака серия <?=$data['brak_seria']?> № <?=$data['brak_number']?>, актовая запись № <?=$data['brak_act']?>.</p>
    <p><div class="redline"></div>От брака имеется несовершеннолетний ребенок <?=$data['child_fio']?>. Ребенок в настоящее время проживает со мной. Материально обеспечиваю ребенка сама, Должник помощи никакой не оказывает. Соглашение об уплате алиментов не заключалось.</p>
    <p><div class="redline"></div></p>
    <p> <div class="redline"></div>В соответствии со ст. 80 Семейного кодекса РФ родители обязаны содержать своих несовершеннолетних детей. Родитель, обеспечивающий материальное содержание детей, вправе обратиться в суд с требованием о взыскании алиментов.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>Согласно ст. 81 Семейного кодекса РФ при отсутствии соглашения об уплате алиментов, алименты на несовершеннолетних детей взыскиваются судом с их родителей ежемесячно в размере: на двух детей — одной трети заработка и (или) иного дохода родителей.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>На основании изложенного, руководствуясь действующим законодательством,</p>
</div>
<br>
    <p class="uppercase center">ПРОШУ СУД:</p>
    <p><div class="redline"></div>1. Выдать судебный приказ о взыскании алиментов с <?=$data['dolzhnick_fio']?> в пользу <?=$data['vziskatel_fio']?> на содержание <?=$data['child_fio']?> в размере одной трети заработка и иного дохода, начиная с даты подачи настоящего заявления и до совершеннолетия ребенка.</p>
<p><div class="redline"></div></p>
    <p><div class="redline"></div>Приложения:</p>
   <p> <div class="redline"></div> 1. Квитанция об оплате государственной пошлины;</p>
<p> <div class="redline"></div> 2. Копия паспорта Взыскателя;</p>
<p> <div class="redline"></div> 3. Копия свидетельства о рождении ребенка; </p>
<p> <div class="redline"></div> 4. Справка о регистрации по месту жительства Взыскателя; </p>
<p> <div class="redline"></div> 5. </p>
  <br>
<br>

<span><?=$data['isk_podpis']?> / <?=$data['isk_shifr']?></span>

</body>
</html>