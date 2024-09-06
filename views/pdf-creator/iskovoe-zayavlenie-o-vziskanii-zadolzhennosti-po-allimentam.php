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
    <p>о взыскании задолженности по алиментам</p>
    <br>
</div>
<div class="main">
    <p><div class="redline"></div>Решением <?=$data['delo_sud']?> от <?=$data['delo_date']?> года по делу №<?=$data['delo_number']?> с Ответчика в пользу Истца были взысканы алименты на содержание несовершеннолетнего ребенка <?=$data['child_fio']?>, <?=$data['child_birth']?> года рождения, в размере <?=$data['child_aliments']?> рублей до его совершеннолетия.</p>
    <p><div class="redline"></div>Исполнительный лист предъявлен к исполнению в <?=$data['delo_ispolnenie']?> и возбуждено исполнительное производство №<?=$data['delo_proizvodstvo']?>. </p>
    <p><div class="redline"></div>За период с <?=$data['delo_periodot']?> по <?=$data['delo_perioddo']?> Ответчиком алименты на содержание ребенка не выплачивались, в связи с чем образовалась задолженность в размере <?=$data['delo_zadolzhennost']?> рублей, что подтверждается <?=$data['delo_podtverzhdenie']?>. Добровольно погасить задолженность Ответчик отказывается и в настоящее время продолжает уклоняться от уплаты алиментов на содержание несовершеннолетнего ребенка.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>Согласно ст.80 СК РФ родители обязаны содержать своих несовершеннолетних детей. Порядок и форма предоставления содержания несовершеннолетним детям определяются родителями самостоятельно. В случае, если родители не предоставляют содержание своим несовершеннолетним детям, средства на содержание несовершеннолетних детей (алименты) взыскиваются с родителей в судебном порядке.</p>
    <p><div class="redline"></div>В соответствии с п.2 ст.113 СК РФ в тех случаях, когда удержание алиментов на основании исполнительного листа или на основании нотариально удостоверенного соглашения об уплате алиментов не производилось по вине лица, обязанного уплачивать алименты, взыскание алиментов производится за весь период независимо от установленного п.2 ст.107 СК РФ трехлетнего срока.</p>
<p><div class="redline"></div>В силу п.3 ст.113 СК РФ размер задолженности определяется судебным исполнителем исходя из размера алиментов, определенного решением суда или соглашением об уплате алиментов. При этом размер задолженности по алиментам, уплачиваемым на несовершеннолетних детей в соответствии со ст.81 СК РФ, определяется исходя из заработка и иного дохода лица, обязанного уплачивать алименты, за период, в течение которого взыскание алиментов не производилось. В случаях, если лицо, обязанное уплачивать алименты, в этот период не работало или если не будут представлены документы, подтверждающие его заработок и (или) иной доход, задолженность по алиментам определяется исходя из размера средней заработной платы в Российской Федерации на момент взыскания задолженности. Действия, направленные на примирение, сторонами не предпринимались.</p>
    <p><div class="redline"></div></p>
    <p>
    <div class="redline"></div>Таким образом, задолженность Ответчика по уплате алиментов за период с <?=$data['delo_periodot']?> по <?=$data['delo_perioddo']?> составляет <?=$data['delo_zadolzhennost']?> рублей.
    </p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>В связи с обращением в суд Истцом понесены следующие судебные расходы: <?=$data['delo_rashody']?> рублей.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>Согласно ст.94, 98 ГПК РФ стороне, в пользу которой состоялось решение суда, суд присуждает возместить с другой стороны все понесенные по делу судебные расходы.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>На основании изложенного, руководствуясь действующим законодательством,</p>
</div>
<br>
    <p class="uppercase center">ПРОШУ СУД:</p>
    <p><div class="redline"></div>1. Взыскать с <?=$data['otvetchick_fio']?> в пользу <?=$data['istec_fio']?> задолженность по уплате алиментов на содержание несовершеннолетнего ребенка <?=$data['child_fio']?>, <?=$data['child_birth']?> года рождения, за период с <?=$data['delo_periodot']?> по <?=$data['delo_perioddo']?> в размере <?=$data['delo_zadolzhennost']?> рублей.</p>
        <p><div class="redline"></div>2. Взыскать с <?=$data['otvetchick_fio']?> в пользу <?=$data['istec_fio']?> судебные расходы на оплату <?=$data['delo_dop']?> в размере <?=$data['delo_dopsumma']?> рублей.</p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div></p>
    <p><div class="redline"></div>Приложения:</p>
   <p> <div class="redline"></div>  1.</p>
  <br>
<br>

<span><?=$data['isk_podpis']?> / <?=$data['isk_shifr']?></span>

</body>
</html>