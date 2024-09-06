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
    <p>о взыскании расходов на оплату услуг представителя</p>
    <br>

</div>
<div class="main">
    <p><div class="redline"></div>&#171;<?=$data['delo_day']?>&#187; <?=$data['delo_month']?> <?=$data['delo_year']?> года <?=$data['delo_sud']?> было вынесено решение по делу по иску <?=$data['delo_isk']?> к <?=$data['delo_k']?> о <?=$data['delo_o']?>.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>В связи с необладанием юридических знаний Заявитель был вынужден обратиться за помощью к <?=$data['delo_obrasheniek']?>. &#171;<?=$data['dogovor_day']?>&#187; <?=$data['dogovor_month']?> <?=$data['dogovor_year']?> года с представителем был заключен Договор № <?=$data['dogovor_number']?>, по условиям которого Заявителю оказывались следующие услуги: <?=$data['dogovor_uslugi']?>.</p>
    <p><div class="redline"></div>В рамках рассмотрения дела № <?=$data['delo_number2']?> представителем была проделана следующая работа: <?=$data['delo_rabota']?>.
    </p>
    <p><div class="redline"></div>Сумма судебных расходов по оплате услуг представителя составляет <?=$data['delo_summa']?> рублей, что подтверждается <?=$data['delo_podtverzhdenie']?>.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>На основании изложенного, руководствуясь действующим законодательством,</p>
</div>
<br>
<p class="uppercase center">ПРОШУ СУД: </p>
<p><div class="redline"></div>1. Взыскать с <?=$data['vziskat_s']?> в пользу <?=$data['vziskat_k']?> расходы на оплату услуг представителя в размере <?=$data['delo_summa']?> рублей.</p>
<p><div class="redline"></div></p>
<p><div class="redline"></div></p>
<p><div class="redline"></div>Приложения:</p>
<p><div class="redline"></div> 1. Договор № <?=$data['delo_number2']?> от <?=$data['delo_date']?> года;</p>
<p><div class="redline"></div> 2. Квитанция об оплате;</p>
<p><div class="redline"></div> 3. Копия почтовых документов, подтверждающих направление настоящего заявления сторонам.</p>
<p><div class="redline"></div> 4. </p>
<br>
<br>
<span><?=$data['isk_podpis']?> / <?=$data['isk_shifr']?></span>
</body>
</html>