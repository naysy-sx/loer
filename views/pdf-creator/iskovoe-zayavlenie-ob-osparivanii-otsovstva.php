<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
     <style type="text/css">
        @font-face {
            font-family: 'Times New Roman';
            src: url('./fonts/times_new_roman.eot'); /* IE 9 Compatibility Mode */
           src: url('./fonts/times_new_roman.eot?#iefix') format('embedded-opentype'), /* IE < 9 */
           url('./fonts/times_new_roman.woff2') format('woff2'), /* Super Modern Browsers */
            url('./fonts/times_new_roman.woff') format('woff'), /* Firefox >= 3.6, any other modern browser */
            url('./fonts/times_new_roman.ttf') format('truetype'); /* Safari, Android, iOS */

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
    <br>
</div>
<div class="date">
    <p>&#171;<?=$data['date_day']?>&#187; <?=$data['date_month']?> <?=$data['date_year']?> года</p>
</div>
<div class="title">
    <br>
    <p>Исковое заявление</p>
    <p>об оспаривании отцовства</p>
    <br>
</div>
<div class="main">
    <p><div class="redline"></div>Я являюсь <?=$data['istec_status']?> несовершеннолетнего ребенка <?=$data['child_fio']?>, <?=$data['child_birth']?> года рождения, что подтверждается свидетельством о рождении.</p>
    <p><div class="redline"></div>Отцом ребенка был записан Ответчик, что не соответствует действительности. Ответчик не мог являться отцом, поскольку <?=$data['otvetchick_status']?>.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>В соответствии с п. 2 ст. 48 Семейного кодекса РФ, Если ребенок родился в течение трехсот дней с момента расторжения брака, признания его недействительным или с момента смерти супруга матери ребенка, отцом ребенка признается супруг (бывший супруг) матери, если не доказано иное (статья 52 настоящего Кодекса). Отцовство супруга матери ребенка удостоверяется записью об их браке.</p>
    <p><div class="redline"></div>Согласно пункту 1 статьи 52 Семейного кодекса Российской Федерации запись родителей в книге записей рождений, произведенная в соответствии с пунктами 1 и 2 статьи 51 Семейного кодекса Российской Федерации, может быть оспорена по требованию лица, записанного в качестве отца или матери ребенка, либо лица, фактически являющегося отцом или матерью ребенка, а также самого ребенка по достижении им совершеннолетия, опекуна (попечителя) ребенка, опекуна родителя, признанного судом недееспособным.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>Таким образом я являюсь одинокой матерью. Неверная запись об отцовстве препятствует в <?=$data['delo_prepyatstvie']?>.</p>
  <p><div class="redline"></div></p>
    <p><div class="redline"></div>На основании изложенного, руководствуясь действующим законодательством,</p>
</div>
<br>
    <p class="uppercase center">ПРОШУ СУД:</p>
    <p><div class="redline"></div>1. Признать недействительной запись в свидетельстве о рождении № <?=$data['svidetelstvo_number']?> выданном <?=$data['svidetelstvo_date']?> года о признании <?=$data['otvetchick_fio']?> отцом ребенка - <?=$data['child_fio']?>, родившегося <?=$data['child_birth']?> года.</p>
<p><div class="redline"></div></p>
    <p><div class="redline"></div>Приложения:</p>
   <p> <div class="redline"></div> 1.  </p>
  <br>
<br>

<span><?=$data['isk_podpis']?> / <?=$data['isk_shifr']?></span>

</body>
</html>