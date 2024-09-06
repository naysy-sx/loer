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
    <p>о взыскании дополнительных расходов на ребенка</p>
    <br>
</div>
<div class="main">
    <p><div class="redline"></div>Я и Ответчик являемся родителями несовершеннолетнего ребенка <?=$data['child_fio']?>, <?=$data['child_birth']?> года рождения, что подтверждается свидетельством о рождении.</p>
    <p><div class="redline"></div>&#171;<?=$data['delo_day']?>&#187; <?=$data['delo_month']?> <?=$data['delo_year']?> года <?=$data['delo_kem']?> на основании <?=$data['delo_osnovanie']?> с Ответчика взыскиваются алименты на содержание ребенка в размере <?=$data['child_alim']?>.</p>
    <p><div class="redline"></div>Вышеуказанной суммы недостаточно, поскольку <?=$data['delo_pricina']?>. В связи с этим у меня возникают дополнительные ежемесячные расходы на: <?=$data['delo_doprashod']?>. С учетом сохранения необходимости максимального сохранения ребенку уровня его прежнего обеспечения считаю необходимым взыскать с Ответчика <?=$data['delo_vziskat']?>.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>Согласно п.1 ст. 86 СК РФ При отсутствии соглашения и при наличии исключительных обстоятельств (тяжелая болезнь, увечье несовершеннолетних детей или нетрудоспособных совершеннолетних нуждающихся детей, необходимость оплаты постороннего ухода за ними, отсутствие пригодного для постоянного проживания жилого помещения и другие обстоятельства) каждый из родителей может быть привлечен судом к участию в несении дополнительных расходов, вызванных этими обстоятельствами.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>На основании изложенного, руководствуясь действующим законодательством,</p>
</div>
<br>
    <p class="uppercase center">ПРОШУ СУД:</p>
    <p><div class="redline"></div>1. Взыскать с <?=$data['otvetchick_fio']?> в пользу <?=$data['istec_fio']?> дополнительные расходы на содержание несовершеннолетнего ребенка <?=$data['child_fio']?>, <?=$data['child_birth']?> года рождения, в размере <?=$data['delo_vziskat']?> рублей ежемесячно.</p>
<p><div class="redline"></div></p>
    <p><div class="redline"></div>Приложения:</p>
   <p> <div class="redline"></div> 1.  </p>
  <br>
<br>

<span><?=$data['isk_podpis']?> / <?=$data['isk_shifr']?></span>

</body>
</html>