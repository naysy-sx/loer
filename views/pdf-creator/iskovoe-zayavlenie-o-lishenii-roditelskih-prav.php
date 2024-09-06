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
    <p>Третье лицо: <?=$data['tretje_fio']?></p>
    <br>
</div>
<div class="date">
    <p>&#171;<?=$data['date_day']?>&#187; <?=$data['date_month']?> <?=$data['date_year']?> года</p>
</div>
<div class="title">
    <br>
    <p>Исковое заявление</p>
    <p>о лишении родительских прав</p>
    <br>
</div>
<div class="main">
    <p><div class="redline"></div>Ответчик является <?=$data['otvetchick_status']?> несовершеннолетнего ребенка <?=$data['child_fio']?>, <?=$data['child_birth']?> года рождения.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>Продолжительное время Ответчик надлежащим образом не выполняет свои обязанности родителя. Подтвердить это могут следующие факты: <?=$data['otvetchick_facts']?>.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>Согласно ст. 69 СК РФ Родители (один из них) могут быть лишены родительских прав, если они:</p>
    <p><div class="redline"></div>- уклоняются от выполнения обязанностей родителей, в том числе при злостном уклонении от уплаты алиментов;</p>
    <p><div class="redline"></div>- отказываются без уважительных причин взять своего ребенка из родильного дома (отделения) либо из иной медицинской организации, образовательной организации, организации социального обслуживания или из аналогичных организаций;</p>
    <p><div class="redline"></div>- злоупотребляют своими родительскими правами;</p>
    <p><div class="redline"></div>- жестоко обращаются с детьми, в том числе осуществляют физическое или психическое насилие над ними, покушаются на их половую неприкосновенность;</p>
    <p><div class="redline"></div>- являются больными хроническим алкоголизмом или наркоманией;</p>
    <p><div class="redline"></div>- совершили умышленное преступление против жизни или здоровья своих детей, другого родителя детей, супруга, в том числе не являющегося родителем детей, либо против жизни или здоровья иного члена семьи.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>Нарушение прав и интересов нашего ребенка выражается в <?=$data['child_narushenie']?>. В связи с этим считаю необходимым лишить Ответчика родительских прав.</p>
  <p><div class="redline"></div></p>
    <p><div class="redline"></div>На основании изложенного, руководствуясь действующим законодательством,</p>
</div>
<br>
    <p class="uppercase center">ПРОШУ СУД:</p>
    <p><div class="redline"></div>1. Лишить Ответчика родительских прав в отношении ребенка <?=$data['child_fio']?>, &#171;<?=$data['child_birth_day']?>&#187; <?=$data['child_birth_month']?> <?=$data['child_birth_year']?> года рождения, проживающего совместно с <?=$data['child_prozhivaet']?> по адресу: <?=$data['child_address']?>.</p>
<p><div class="redline"></div>2. Передать ребенка  <?=$data['child_fio']?>, &#171;<?=$data['child_birth_day']?>&#187; <?=$data['child_birth_month']?> <?=$data['child_birth_year']?> года рождения, проживающего (проживающих) совместно с <?=$data['child_prozhivaet']?> по адресу: <?=$data['child_address']?>, на воспитание Истцу.</p>
<p><div class="redline"></div></p>
    <p><div class="redline"></div>Приложения:</p>
   <p> <div class="redline"></div> 1.  </p>
  <br>
<br>

<span><?=$data['isk_podpis']?> / <?=$data['isk_shifr']?></span>

</body>
</html>