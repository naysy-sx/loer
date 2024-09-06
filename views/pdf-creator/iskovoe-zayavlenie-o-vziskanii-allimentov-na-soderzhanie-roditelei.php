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
    <p>о взыскании алиментов в твердой денежной сумме</p>
    <br>
</div>
<div class="main">
    <p><div class="redline"></div>Я являюсь родителем ребенка <?=$data['child_fio']?>, <?=$data['child_birth']?> года рождения, что подтверждается свидетельством о рождении.</p>
    <p><div class="redline"></div>Я нетрудоспособна и нуждаюсь в материальной помощи, мой ежемесячный доход состоит из <?=$data['delo_dohod']?> в размере <?=$data['delo_summa']?> руб. в месяц, других источников дохода я не имею. Мои ежемесячные затраты, которые необходимы и достаточны: <?=$data['delo_zatraty']?>. Таким образом, получаемый мой доход не достаточен для удовлетворения жизненных потребностей с учетом возраста и состояния здоровья.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>Ответчик уклоняется от моего содержания в добровольном порядке. Соглашение об уплате алиментов мы не заключали. Ответчик достаточно обеспечен, имеет постоянное место работы и стабильный доход, имеет возможность участвовать в моем содержании. Родительских прав я не лишалась, в воспитании, заботе и содержании ответчика, пока тот был несовершеннолетним, принимала активное участие.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>В соответствии с п.1 ст. 87 СК РФ Трудоспособные совершеннолетние дети обязаны содержать своих нетрудоспособных нуждающихся в помощи родителей и заботиться о них.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>Согласно п.2 ст. 87 СК РФ При отсутствии соглашения об уплате алиментов алименты на нетрудоспособных нуждающихся в помощи родителей взыскиваются с трудоспособных совершеннолетних детей в судебном порядке.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>На основании изложенного, руководствуясь действующим законодательством,</p>
</div>
<br>
    <p class="uppercase center">ПРОШУ СУД:</p>
    <p><div class="redline"></div>1. Взыскать с <?=$data['otvetchick_fio']?> в пользу <?=$data['istec_fio']?> алименты на содержание в твердой денежной сумме в размере <?=$data['delo_dolya']?> доли прожиточного минимума на территории <?=$data['delo_territoria']?>.</p>
<p><div class="redline"></div></p>
    <p><div class="redline"></div>Приложения:</p>
   <p> <div class="redline"></div> 1.  </p>
  <br>
<br>

<span><?=$data['isk_podpis']?> / <?=$data['isk_shifr']?></span>

</body>
</html>