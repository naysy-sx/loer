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
<p>Заявитель: <?=$data['zayavitel_fio']?></p>
    <p>Адрес регистрации: <?=$data['zayavitel_address']?></p>
    <p>Адрес фактического места жительства: <?=$data['zayavitel_fact']?></p>
    <p>Номер: <?=$data['zayavitel_phone']?></p>
    <p>Электронная почта: <?=$data['zayavitel_email']?></p>
    <br>
    <p>Представитель по доверенности: <?=$data['isk_predstavitel']?></p>
    <br>
    <p>Заинтересованное лицо: <?=$data['zainteresovannoelitso_fio']?></p>
    <p>Номер: <?=$data['zainteresovannoelitso_phone']?></p>
    <p>Электронная почта: <?=$data['zainteresovannoelitso_email']?></p>
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
    <p>об установлении факта признания отцовства</p>
    <br>
</div>
<div class="main">
    <p><div class="redline"></div>Я,  <?=$data['zayavitel_fio']?> и <?=$data['otets_fio']?> состояли в фактических брачных отношениях. Встречались и жили вместе с <?=$data['delo_date']?> года, однако брак не регистрировали т.к. не придавали этому значения. Проживали по следующему адресу: <?=$data['delo_address']?>.</p>
    <p><div class="redline"></div>&#171;<?=$data['child_birth_day']?>&#171; <?=$data['child_birth_month']?> <?=$data['child_birth_year']?> года у нас родился ребенок <?=$data['child_fio']?>.</p>
       <p><div class="redline"></div></p>
    <p><div class="redline"></div>По имеющейся у меня информации <?=$data['otets_fio']?> умер. В настоящее время я никаким образом не могу подтвердить его отцовство, что необходимо мне для <?=$data['delo_dlya']?>.</p>
    <p><div class="redline"></div>Факт признания отцовства могут подтвердить: <?=$data['delo_podtverzhdenie']?>.</p>
 <p><div class="redline"></div></p>
    <p><div class="redline"></div>На основании изложенного, руководствуясь действующим законодательством,</p>
</div>
<br>
    <p class="uppercase center">ПРОШУ СУД:</p>
    <p><div class="redline"></div>1. Установить факт признания отцовства за <?=$data['otets_fio']?>, <?=$data['otets_birth']?> года рождения, гражданином РФ, место рождения <?=$data['otets_place']?> в отношении <?=$data['child_fio']?>, <?=$data['child_birth']?> года рождения, место рождения <?=$data['child_place']?>.</p>
        <p><div class="redline"></div>2. Обязать <?=$data['delo_obyazat']?> внести изменения в актовую запись о рождении <?=$data['child_fio']?>, изменив фамилию ребенку на <?=$data['child_new']?>, а также вписать <?=$data['otets_new']?> в качестве отца.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>Приложения:</p>
   <p> <div class="redline"></div>  1.</p>
  <br>
<br>

<span><?=$data['isk_podpis']?> / <?=$data['isk_shifr']?></span>

</body>
</html>