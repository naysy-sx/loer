<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style type="text/css">
        * {
            font-family: arial;
            font-size: 14px;
            line-height: 14px;
        }

        table {
            margin: 0 0 15px 0;
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        table td {
            padding: 5px;
        }

        table th {
            padding: 5px;
            font-weight: bold;
        }

        .header {
            margin: 0 0 0 0;
            padding: 0 0 15px 0;
            font-size: 12px;
            line-height: 12px;
            text-align: center;
        }

        /* Реквизиты банка */
        .details td {
            padding: 3px 2px;
            border: 1px solid #000000;
            font-size: 12px;
            line-height: 12px;
            vertical-align: top;
        }

        h1 {
            margin: 0 0 10px 0;
            padding: 10px 0 10px 0;
            border-bottom: 2px solid #000;
            font-weight: bold;
            font-size: 20px;
        }

        /* Поставщик/Покупатель */
        .contract th {
            padding: 3px 0;
            vertical-align: top;
            text-align: left;
            font-size: 13px;
            line-height: 15px;
        }

        .contract td {
            padding: 3px 0;
        }

        /* Наименование товара, работ, услуг */
        .list thead, .list tbody {
            border: 2px solid #000;
        }

        .list thead th {
            padding: 4px 0;
            border: 1px solid #000;
            vertical-align: middle;
            text-align: center;
        }

        .list tbody td {
            padding: 0 2px;
            border: 1px solid #000;
            vertical-align: middle;
            font-size: 11px;
            line-height: 13px;
        }

        .list tfoot th {
            padding: 3px 2px;
            border: none;
            text-align: right;
        }

        /* Сумма */
        .total {
            margin: 0 0 20px 0;
            padding: 0 0 10px 0;
            border-bottom: 2px solid #000;
        }

        .total p {
            margin: 0;
            padding: 0;
        }

        /* Руководитель, бухгалтер */
        .sign {
            position: relative;
        }

        .sign table {
            width: 60%;
        }

        .sign th {
            padding: 40px 0 0 0;
            text-align: left;
        }

        .sign td {
            padding: 40px 0 0 0;
            border-bottom: 1px solid #000;
            text-align: right;
            font-size: 12px;
        }

        .sign-1 {
            position: absolute;
            left: 149px;
            top: -44px;
        }

        .sign-2 {
            position: absolute;
            left: 149px;
            top: 0;
        }

        .printing {
            position: absolute;
            left: 271px;
            top: -15px;
        }
    </style>
</head>
<body>
<p class="header">

</p>

<h1><?=$data['docName'] /** номер документа */?> от <?=$data['datetime_current'] /** документ от */?></h1>

<br>
<br><br>

<table class="list">
    <tbody>
    <tr>
        <td style="width: 20%;">Исполнитель</td>
        <td></td>
    </tr>
    </tbody>
</table>


<table class="list">
    <thead>
    <tr>
        <th width="5%">№</th>
        <th width="54%">Описание</th>
        <th width="8%">Коли-<br>чество</th>
        <th width="5%">Ед.<br>изм.</th>
        <th width="14%">Цена</th>
        <th width="14%">Сумма</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
    <tr>
        <th colspan="5">Итого:</th>
        <th>123 руб.</th>
    </tr>
    </tfoot>
</table>

<div style="text-align: right; margin-top: -15px; font-size: 11px"></div>

<div class="total"></div>

<table>
    <tbody>
    <tr>
        <td style="width: 20%;">Исполнитель</td>
        <td>______________________________________________</td>
    </tr>
    <tr>
        <td>Заказчик</td>
        <td>______________________________________________</td>
    </tr>
    </tbody>
</table>

</body>
</html>