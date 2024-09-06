<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Редактор документа</title>
</head>
<body>


<div style="height: 90vh; margin: auto; box-shadow: 0 0 7px -3px #b0b0b0; padding: 25px 30px;  border: 3px dotted red;" contenteditable="true">
<?php
echo $this->render($doc_name, [
    'data' => $data,
]);
?>
</div>



<div style="height: 90vh; margin: auto; box-shadow: 0 0 7px -3px #b0b0b0; padding: 25px 30px;" contenteditable="true">
    <textarea id="htmleditor">
    <?php
    echo $this->render($doc_name, [
        'data' => $data,
    ]);
    ?></textarea>
</div>
<script src="https://cdn.tiny.cloud/1/ez5bv8v1pb1d82ecl5oixxs4216oev3en2m128q3ufzoyu3w/tinymce/6/tinymce.min.js"></script>





<script>
    tinymce.init({
        language: 'ru',
        selector: '#htmleditor',
        plugins: 'inlinecss accordion anchor lists advlist code anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | anchor code accordion inlinecss numlist bullist indent outdent | emoticons charmap | removeformat',
    });

    function hideAdv() {
        $('.tox-notifications-container').hide();
    }

    let timerId = setInterval(() => hideAdv(), 30);
    setTimeout(() => {
        clearInterval(timerId);
    }, 3000);
</script>
</body>
</html>