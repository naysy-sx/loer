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
    <p>об ограничении родительских прав</p>
    <br>
</div>
<div class="main">
    <p><div class="redline"></div>Истцу стало известно, что права и интересы <?=$data['child_fio']?> <?=$data['child_birth']?> года рождения нарушаются Ответчиком, а именно: <?=$data['child_narushenie']?>.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>Ответчик в нарушение ст. 65 Семейного кодекса не выполняет своих родительских обязанностей по обеспечению физического и нравственного, духовного развития.</p>
<p><div class="redline"></div></p>

    <p><div class="redline"></div>Согласно п. 2 ст. 73 Семейного кодекса Российской Федерации ограничение родительских прав допускается, если оставление ребенка с родителями (одним из них) опасно для ребенка по обстоятельствам, от родителей (одного из них) не зависящим (психическое расстройство или иное хроническое заболевание, стечение тяжелых обстоятельств и другие). Ограничение родительских прав допускается также в случаях, если оставление ребенка с родителями (одним из них) вследствие их поведения является опасным для ребенка, но не установлены достаточные основания для лишения родителей (одного из них) родительских прав. Если родители (один из них) не изменят своего поведения, орган опеки и попечительства по истечении шести месяцев после вынесения судом решения об ограничении родительских прав обязан предъявить иск о лишении родительских прав. В интересах ребенка орган опеки и попечительства вправе предъявить иск о лишении родителей (одного из них) родительских прав до истечения этого срока.</p>
    <p><div class="redline"></div>В соответствии с ч. 5 ст. 73, п. 2 ст. 74 Семейного кодекса РФ ограничение родительских прав предполагает также взыскание алиментов на содержание ребенка и не освобождает от такой обязанности. В связи с этим Истец считает, что с Ответчика подлежит взыскание алиментов в размере <?=$data['child_alim']?>.</p>
    <p><div class="redline"></div>В силу п. 1 ст. 74 Семейного кодекса Российской Федерации родители, родительские права которых ограничены судом, утрачивают право на личное воспитание ребенка, а также право на льготы и государственные пособия, установленные для граждан, имеющих детей.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>На основании изложенного, руководствуясь действующим законодательством,</p>
</div>
<br>
    <p class="uppercase center">ПРОШУ СУД:</p>
    <p><div class="redline"></div>1. Ограничить родительские права <?=$data['otvetchick_fio']?> в отношении <?=$data['child_fio']?>, <?=$data['child_birth']?> года рождения;</p>
<p><div class="redline"></div>2. Передать <?=$data['child_fio']?>, <?=$data['child_birth']?> года рождения на попечение органа опеки и попечительства.</p>
<p><div class="redline"></div>3. Лишить Ответчика прав на льготы и государственные пособия, установленные для граждан, имеющих детей.</p>
<p><div class="redline"></div>4. Взыскать с Ответчика алименты на содержание ребенка <?=$data['child_fio']?> в размере <?=$data['child_alim']?>.</p>
<p><div class="redline"></div>5. Сохранить за ребенком право собственности на жилое помещение, расположенное по адресу: <?=$data['child_address']?>, имущественные права, основанные на факте родства с родителями и другими родственниками, в том числе право на получение наследства, а именно: <?=$data['child_nasledstvo']?>.</p>
<p><div class="redline"></div>6. Разрешить контакты Ответчика с ребенком в следующем порядке: <?=$data['child_contact']?>.</p>
<p><div class="redline"></div></p>
    <p><div class="redline"></div>Приложения:</p>
   <p> <div class="redline"></div> 1.  </p>
  <br>
<br>

<span><?=$data['isk_podpis']?> / <?=$data['isk_shifr']?></span>

</body>
</html>