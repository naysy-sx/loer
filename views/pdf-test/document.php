
<?php
/* @var $this yii\web\View */
/* @var $id int */

use app\models\db\Clients;
use app\models\db\CourtsAddresses;
use yii\helpers\Html;
use app\models\db\TemplatesDocs;
use app\models\db\ClientFolders;
use app\models\db\ClientDocuments;


$docs = TemplatesDocs::find()->asArray()->all();

$current_doc = ClientDocuments::find()
	->where(['id' => $id])
	->asArray()
	->one();


$types = TemplatesDocs::find()
	->select('type')
	->distinct()
	->column();

$pravos = TemplatesDocs::find()
	->select('pravo')
	->distinct()
	->column();

$uniquePravos = [];

foreach ($pravos as $pravo) {
	$pravosArray = explode('|', $pravo);
	foreach ($pravosArray as $item) {
		$trimmedItem = trim($item);
		if (!in_array($trimmedItem, $uniquePravos)) {
			$uniquePravos[] = $trimmedItem;
		}
	}
}

$folders = ClientFolders::find()
	->where([
		'creator_id' => $_GET['client_id'],
		'publish_status' => 1,
	])
	->asArray()
	->all();
/*
echo '<pre>';

var_dump($folders);

echo '</pre>';
*/

$documents = ClientDocuments::find()
	->where([
		'creator_id' => $data->creator_id,
		'publish_status' => 1
	])
	->asArray()
	->all();





$js = <<< ZZZZZ
(function ($) {
	$(document).on("click", ".print", function() {
	var doc = $('.doc').html();
	console.log(doc)

	$.get( "index.php?r=pdf-creator/save-doc", {doc}, function( data ) {
	console.log(res);
	 });
	 });
  })(jQuery);
ZZZZZ;

$this->registerJs($js, yii\web\View::POS_READY);

if (isset($_GET['client_id'])) {
	$client_id = htmlspecialchars($_GET['client_id']);
	$client = Clients::find()->where(['id' => $client_id])->asArray()->one();
}
if (isset($_GET['sud_id'])) {
	$sud_id = htmlspecialchars($_GET['sud_id']);
	$sud = CourtsAddresses::find()->where(['id' => $sud_id])->asArray()->one();
}
?>


<style>
	body {
		background: #a6c8ff88;
	}

	#editor {
		position: fixed;
		bottom: 0;
		left: 0;
		right: 0;
		background-color: #fff;
		padding: 0.75rem 1rem;
		display: flex;
		gap: 2rem;
		justify-content: space-between;
		align-items: center;
		border-radius: 0 0 0 0;
		box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.1);
		z-index: 10000;
	}

	@media (max-width: 1500px) {
		#editor {
			flex-direction: column;
			justify-content: space-between;
			gap: 1rem;
		}
	}

	#editor input[type="checkbox"] {
		display: none;
	}


	#editor svg {
		width: 24px;
		height: 24px;
	}

	#editor a:hover path {
		fill: dodgerblue !important;
	}

	.editor-list {
		display: flex;
		justify-content: center;
		flex-flow: row wrap;
		gap: 0.6rem;
	}

	.document hr {
		border-top: 1px solid rgba(0, 0, 0, .7);
	}

	.document-header-line ul,
	.document-content ul {
		padding-left: 1rem;
	}

	.document-header-line ul li,
	.document-content ul li {
		list-style-type: disc;
	}

	.page-line {
		position: absolute;
		left: 0;
		bottom: 0;
		right: 0;
		top: 43rem;
		height: 3px;
		border-top: 2px dashed lightblue;
	}

	.buttons-wrapper {
		display: flex;
		text-align: center;
		flex-direction: column;
		align-items: center;
		gap: 0.5rem;
	}

	@media print {

		body header,
		.attention,
		.btn.btn-success.print,
		#editor,
		#nav {
			display: none !important;
		}

		.container {
			max-width: 100% !important;
		}

		.document {
			border: none;
			box-shadow: none;
			padding: 0rem;
		}

		.index-window {
			background-color: white;
			border: 0 !important;
		}
	}
</style>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


<form id='save-form'>

<input type="hidden" name="doc_name" id="hidden_doc_name">
<input type="hidden" name="doc_type" id="hidden_doc_type">
<input type="hidden" name="doc_pravo" id="hidden_doc_pravo">
<input type="hidden" name="doc_folders" id="hidden_doc_folders">
<input type="hidden" name="creator_id" id="creator_id" value="<?= Html::encode($client_id) ?>">
<div id="editor">
	<div class="editor-commands">
		<ul class="editor-list">
			<li>
				<a data-command="undo" class="editor-button" title="Отменить">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
						<path fill="currentColor" d="M7 19v-2h7.1q1.575 0 2.738-1T18 13.5T16.838 11T14.1 10H7.8l2.6 2.6L9 14L4 9l5-5l1.4 1.4L7.8 8h6.3q2.425 0 4.163 1.575T20 13.5t-1.737 3.925T14.1 19z" />
					</svg>
				</a>
			</li>
			<li>
				<a data-command="redo" title="Повторить">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
						<path fill="currentColor" d="M9.9 19q-2.425 0-4.163-1.575T4 13.5t1.738-3.925T9.9 8h6.3l-2.6-2.6L15 4l5 5l-5 5l-1.4-1.4l2.6-2.6H9.9q-1.575 0-2.738 1T6 13.5T7.163 16T9.9 17H17v2z" />
					</svg>
				</a>
			</li>
			<li>
				<a data-command="insertHorizontalRule" title="Вставить горизонтальную линию">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256">
						<path fill="currentColor" d="M228 128a12 12 0 0 1-12 12H40a12 12 0 0 1 0-24h176a12 12 0 0 1 12 12" />
					</svg>
				</a>
			</li>
			<li>
				<a data-command="bold" title="Жирный">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
						<path fill="currentColor" d="M6.8 19V5h5.525q1.625 0 3 1T16.7 8.775q0 1.275-.575 1.963t-1.075.987q.625.275 1.388 1.025T17.2 15q0 2.225-1.625 3.113t-3.05.887zm3.025-2.8h2.6q1.2 0 1.463-.612t.262-.888t-.262-.887t-1.538-.613H9.825zm0-5.7h2.325q.825 0 1.2-.425t.375-.95q0-.6-.425-.975t-1.1-.375H9.825z" />
					</svg>
				</a>
			</li>
			<li>
				<a data-command="italic" title="Курсив">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
						<path fill="currentColor" d="M5 19v-2.5h4l3-9H8V5h10v2.5h-3.5l-3 9H15V19z" />
					</svg>
				</a>
			</li>
			<li>
				<a data-command="underline" title="Подчёркнутый">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
						<path fill="currentColor" d="M5 21v-2h14v2zm7-4q-2.525 0-3.925-1.575t-1.4-4.175V3H9.25v8.4q0 1.4.7 2.275t2.05.875t2.05-.875t.7-2.275V3h2.575v8.25q0 2.6-1.4 4.175T12 17" />
					</svg>
				</a>
			</li>
			<li>
				<a data-command="justifyLeft" title="Влево">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
						<path fill="currentColor" d="M3 21v-2h18v2zm0-4v-2h12v2zm0-4v-2h18v2zm0-4V7h12v2zm0-4V3h18v2z" />
					</svg>
				</a>
			</li>
			<li>
				<a data-command="justifyCenter" title="По центру">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
						<path fill="currentColor" d="M4 21q-.425 0-.712-.288T3 20t.288-.712T4 19h16q.425 0 .713.288T21 20t-.288.713T20 21zm4-4q-.425 0-.712-.288T7 16t.288-.712T8 15h8q.425 0 .713.288T17 16t-.288.713T16 17zm-4-4q-.425 0-.712-.288T3 12t.288-.712T4 11h16q.425 0 .713.288T21 12t-.288.713T20 13zm4-4q-.425 0-.712-.288T7 8t.288-.712T8 7h8q.425 0 .713.288T17 8t-.288.713T16 9zM4 5q-.425 0-.712-.288T3 4t.288-.712T4 3h16q.425 0 .713.288T21 4t-.288.713T20 5z" />
					</svg>
				</a>
			</li>
			<li>
				<a data-command="justifyRight" title="Вправо">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
						<path fill="currentColor" d="M3 5V3h18v2zm6 4V7h12v2zm-6 4v-2h18v2zm6 4v-2h12v2zm-6 4v-2h18v2z" />
					</svg>
				</a>
			</li>
			<li>
				<a data-command="justifyFull" title="Растянуть">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
						<path fill="currentColor" d="M3 21v-2h18v2zm0-4v-2h18v2zm0-4v-2h18v2zm0-4V7h18v2zm0-4V3h18v2z" />
					</svg>
				</a>
			</li>
			<li>
				<a data-command="insertUnorderedList" title="Маркированый список">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
						<path fill="currentColor" d="M9 19v-2h12v2zm0-6v-2h12v2zm0-6V5h12v2zM5 20q-.825 0-1.412-.587T3 18t.588-1.412T5 16t1.413.588T7 18t-.587 1.413T5 20m0-6q-.825 0-1.412-.587T3 12t.588-1.412T5 10t1.413.588T7 12t-.587 1.413T5 14m0-6q-.825 0-1.412-.587T3 6t.588-1.412T5 4t1.413.588T7 6t-.587 1.413T5 8" />
					</svg>
				</a>
			</li>
			<li>
				<a data-command="insertOrderedList" title="Нумерованный список">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
						<path fill="currentColor" d="M3 22v-1.5h2.5v-.75H4v-1.5h1.5v-.75H3V16h3q.425 0 .713.288T7 17v1q0 .425-.288.713T6 19q.425 0 .713.288T7 20v1q0 .425-.288.713T6 22zm0-7v-2.75q0-.425.288-.712T4 11.25h1.5v-.75H3V9h3q.425 0 .713.288T7 10v1.75q0 .425-.288.713T6 12.75H4.5v.75H7V15zm1.5-7V3.5H3V2h3v6zM9 19v-2h12v2zm0-6v-2h12v2zm0-6V5h12v2z" />
					</svg>
				</a>
			</li>
			<li>
				<a data-command="html" data-command-argument="h1" title="Заголовок H1">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 16 16">
						<path fill="currentColor" fill-rule="evenodd" d="M14 4.25a.75.75 0 0 0-1.248-.56l-2.25 2a.75.75 0 0 0 .996 1.12l1.002-.89v5.83a.75.75 0 0 0 1.5 0zm-11.5 0a.75.75 0 0 0-1.5 0v7.496a.75.75 0 0 0 1.5 0V8.75h4v2.996a.75.75 0 0 0 1.5 0V4.25a.75.75 0 0 0-1.5 0v3h-4z" clip-rule="evenodd" />
					</svg>
				</a>
			</li>
			<li>
				<a data-command="html" data-command-argument="h2" title="Заголовок H2">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 16 16">
						<path fill="currentColor" fill-rule="evenodd" d="M2.5 4.25a.75.75 0 0 0-1.5 0v7.496a.75.75 0 0 0 1.5 0V8.75h4v2.996a.75.75 0 0 0 1.5 0V4.25a.75.75 0 0 0-1.5 0v3h-4zm8.403 1.783A1.364 1.364 0 0 1 12.226 5h.226a1.071 1.071 0 0 1 .672 1.906l-3.61 2.906a1.51 1.51 0 0 0 .947 2.688h3.789a.75.75 0 0 0 0-1.5h-3.793l-.003-.003l-.003-.004v-.004a.01.01 0 0 1 .004-.008l3.61-2.907A2.571 2.571 0 0 0 12.452 3.5h-.226c-1.314 0-2.46.894-2.778 2.17l-.038.148a.75.75 0 1 0 1.456.364z" clip-rule="evenodd" />
					</svg>
				</a>
			</li>
			<li>
				<a data-command="html" data-command-argument="h3" title="Заголовок H3">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 16 16">
						<path fill="currentColor" fill-rule="evenodd" d="M2.5 4.25a.75.75 0 0 0-1.5 0v7.496a.75.75 0 0 0 1.5 0V8.75h4v2.996a.75.75 0 0 0 1.5 0V4.25a.75.75 0 0 0-1.5 0v3h-4zm8.114 1.496c.202-.504.69-.834 1.232-.834h.28a.94.94 0 0 1 .929.796l.027.18a1.15 1.15 0 0 1-.911 1.303l-.8.16a.662.662 0 0 0 .129 1.31h1.21a.89.89 0 0 1 .882 1.017a1.67 1.67 0 0 1-1.414 1.414l-.103.015a1.81 1.81 0 0 1-1.828-.9l-.018-.033a.662.662 0 0 0-1.152.652l.018.032a3.13 3.13 0 0 0 3.167 1.559l.103-.015a2.99 2.99 0 0 0 2.537-2.537a2.21 2.21 0 0 0-1.058-2.216a2.47 2.47 0 0 0 .546-1.963l-.027-.179a2.26 2.26 0 0 0-2.237-1.919h-.28a2.65 2.65 0 0 0-2.46 1.666a.662.662 0 1 0 1.228.492" clip-rule="evenodd" />
					</svg>
				</a>
			</li>
			<li>
				<a data-command="html" data-command-argument="p" title="Параграф">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
						<path fill="currentColor" d="M13 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4h-2v6H9V4zm0 6a2 2 0 0 0 2-2a2 2 0 0 0-2-2h-2v4z" />
					</svg>
				</a>
			</li>
			<li>
				<a data-command="subscript" title="Нижний индекс">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256">
						<path fill="currentColor" d="M252 208a12 12 0 0 1-12 12h-48a12 12 0 0 1-9.6-19.2l43.17-57.56a12 12 0 0 0-2.35-16.82a12 12 0 0 0-18.54 5.58a12 12 0 0 1-22.63-8a36.3 36.3 0 0 1 5.2-9.67a36 36 0 0 1 57.5 43.34L216 196h24a12 12 0 0 1 12 12M151.86 46.93a12 12 0 0 0-16.93 1.21L92 97.68L49.07 48.14a12 12 0 0 0-18.14 15.72L76.12 116l-45.19 52.14a12 12 0 0 0 18.14 15.72L92 134.32l42.93 49.54a12 12 0 1 0 18.14-15.72L107.88 116l45.19-52.14a12 12 0 0 0-1.21-16.93" />
					</svg>
				</a>
			</li>
			<li>
				<a data-command="superscript" title="Верхний индекс">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 14 14">
						<path fill="currentColor" d="M1.708 5.29L4.54 8.098L7.37 5.29a1.007 1.007 0 0 1 1.416 0a.986.986 0 0 1 0 1.403L5.955 9.5l2.83 2.806a.986.986 0 0 1 0 1.403a1.007 1.007 0 0 1-1.415 0l-2.83-2.806l-2.832 2.806a1.007 1.007 0 0 1-1.415 0a.986.986 0 0 1 0-1.403L3.123 9.5L.294 6.694a.986.986 0 0 1 0-1.403a1.007 1.007 0 0 1 1.415 0ZM11.686 0c.427 0 .812.091 1.149.275c.34.186.612.455.814.8c.2.343.301.7.301 1.063c0 .416-.231.849-.46 1.307c-.223.45-.538.876-1.072 1.555l-.118.123l-.255.229H14V7H9.078V5.986l.101-.246l1.801-1.913c.433-.435.8-.77.93-1.011c.125-.23.184-.427.184-.587a.424.424 0 0 0-.128-.327a.475.475 0 0 0-.355-.127a.448.448 0 0 0-.357.158c-.106.117-.167.288-.175.525l-.012.338h-1.84l.017-.366c.034-.735.274-1.33.723-1.77c.45-.44 1.03-.66 1.719-.66" />
					</svg>
				</a>
			</li>
			<li>
				<a data-command="superscript" title="Верхний индекс">ПОДПИСЬ</a>
			</li>
		</ul>
	</div>

	<div class="buttons-wrapper">
		<a class="btn btn-success" id="save-doc" style="display: block; max-width: 120px;">Сохранить</a>
		<a href="https://lawico.ru/index.php?r=crm">Вернутся без сохранения</a>
	</div>

	<div class="form-row">
		<div class="col col-12 col-sm-6 col-md-3">
			<label for="doc_name">Название документа</label>
			<input type="text" id="doc_name" name="doc_name" class="form-control form-control-sm" placeholder="Например Аппеляция по делу Иванова" aria-label="Название документа" style="height: auto;">
		</div>
		<div class="col col-12 col-sm-6 col-md-3">
			<label for="doc_type">Категория</label>
			<input list="doc_type_list" id="doc_type" name="doc_type" class="form-control form-control-sm mb-3" style="height: auto;" />
			<datalist id="doc_type_list">
				<?php
				foreach ($types as $type) {
					echo '<option value="' . $type . '">' . $type . '</option>';
				}
				?>
			</datalist>
		</div>
		<div class="col col-12 col-sm-6 col-md-3">
			<label for="doc_pravo">Право</label>
			<input list="doc_pravos_list" id="doc_pravo" name="doc_pravo" class="form-control form-control-sm mb-3" style="height: auto;" />
			<datalist id="doc_pravos_list">
				<?php
				foreach ($uniquePravos as $pravo_item) {
					echo '<option value="' . $pravo_item . '">' . $pravo_item . '</option>';
				}
				?>
			</datalist>
		</div>
		<div class="col col-12 col-sm-6 col-md-2">
			<label for="doc_category">Папка</label>
			<input 
				list="doc_folders_list" 
				id="doc_folders" 
				name="doc_folders" 
				class="form-control form-control-sm mb-3" 
				style="height: auto;" 
				autocomplete="off"
			/>
			<datalist id="doc_folders_list">
				<?php
				foreach ($folders as $folder) {
					echo '<option value="' . $folder['title'] . '" data-id="' . $folder['id'] . '">' . $folder['title'] . '</option>';
				}
				?>
			</datalist>

			<script>
				$(document).ready(function() {
					$('#doc_folders').on('input', function() {
						var input = $(this);
						var selectedValue = input.val();
						var selectedOption = $('#doc_folders_list option').filter(function() {
							return this.value === selectedValue;
						});

						if (selectedOption.length > 0) {
							var folderId = selectedOption.data('id');
							input.attr('data-folder', folderId);
						} else {
							input.removeAttr('data-folder');
						}
					});
				});
			</script>

		</div>
	</div>
</div>



	<div class="container -relative">
		<p class="attention text-center"><strong>Внимание! Используйте <kbd>ctrl+enter</kbd> для переноса на следующую строку</strong></p>
		<div class="doc document <?= Html::encode($current_doc['translit_type']) ?>-wrapper" id="content" contenteditable>


			<style>
				.document{
					background-image: url(./img/stamp.png);
					background-repeat: no-repeat;
					background-position: right 2rem bottom 2rem;
					background-size: 300px;
				}

				.index-container{
					height: auto !important;
				}
				.index-window{
					background-color: ghostwhite;
				}
				.document{
					display: grid;
					grid-template-columns: 1fr auto;
					grid-template-rows: auto auto auto auto auto auto;
					grid-template-areas: '. header' 'subtitle subtitle' 'title title' 'content content' 'attachments attachments' 'footer footer';
						grid-gap: 2rem;
						padding: 2rem 4rem;
						font-family: serif;
						font-size: 14pt;
						max-width: 700pt;
						margin: 0 auto;
						background-color: #fff;
						border: 1px solid lightgray;
						box-shadow: 0 0 15px 0px rgba(0, 0, 0, 0.2);
				}


				.document-header{
					grid-area: header;
				}

				.document-header-list{
					display: flex;
					flex-direction: column;
					gap: 1rem;
					max-width: 320px;
					margin-left: auto;
				}

				.document-header-line{
					font-size: 16px;
					line-height: 1.2;
				}

				.document-subtitle{
					grid-area: subtitle;
					text-align: center;
					display: flex;
						justify-content: space-between;
						flex-direction: row-reverse;
				}

				.document-title{
					grid-area: title;
					text-align: center;
				}

				.document-date{
					text-align: left;
					margin: 0;
				}

				.document-content{
					grid-area: content;
				}

				.document-attachments{
					grid-area: attachments;
				}

				.document-footer{
					grid-area: footer;
				}

				.document-subtitle h2{
					font-size: 1.2rem;
					text-align: right;
					font-weight: bold;
					margin: 0;
				}

				.statement,
				.reply,
				.petition,
				.appeal,
				.objections{
					display: none;
				}

				.statement-wrapper .statement,
				.reply-wrapper .reply,
				.petition-wrapper .petition,
				.appeal-wrapper .appeal,
				.objections-wrapper .objections{
					display: flex;
				}

			</style>

			<!-- Шапка -->
			<div class="document-header">

				<!-- Заявление/отзыв/возражение -->
				<div class="document-header-list">

					<?php 



	/*
									echo '<pre>';
									var_dump($client["family"]);
									var_dump($sud);
									var_dump($client);
									echo '</pre>';*/

					if (strpos($current_doc['type'], 'Объяснение') !== false) { 
							echo '
						<div class="document-header-block">
							<div class="document-header-line">В <span>'. $sud['id'] . '</span></div>
							<div class="document-header-line">Адрес суда: <span>'. $sud["region"] . ' ' . $sud["district"] . ' ' . $sud["name"] . '</span></div>
							<div class="document-header-line">Заявитель: <span>'. $client["family"] . ' ' . $client["first_name"]  . ' ' . $client["middle_name"] . '</span></div>
							<div class="document-header-line">Адрес регистрации: <span>'. $client["jur_address"] . '</span></div>
							<div class="document-header-line">Адрес фактического места жительства:<br><span>'. $client["fact_address"] . '</span></div>
							<div class="document-header-line">Паспорт серия <span>'. $client["pasport_serial"] . '</span> №<span>'. $client["pasport_number"] . '</span</div>
							<div class="document-header-line">Выдан: <span'. $client['passport_issue_date'] . '</span> года</div>
							<div class="document-header-line">Код подразделения: <span>'. $client['passport_issuing_authority_code'] . '</span></div>
							<div class="document-header-line">Номер: <span>'. $client["phone"] . '</span></div>
							<div class="document-header-line">Электронная почта: <span>'. $client['email'] . '</span></div>
						</div>
						<div class="document-header-block">
							<div class="document-header-line">Представитель: <br><span>___________</span></div>
							<div class="document-header-line">Защитник: <br><span>____________</span></div>
						</div>
							';
					} else if ((stripos($current_doc['type'], 'Заявление') !== false) || 
							(stripos($current_doc['type'], 'Отзыв') !== false) || 
							(stripos($current_doc['type'], 'Уточнение') !== false) || 
							(stripos($current_doc['type'], 'Возражения') !== false) || 
							(stripos($current_doc['type'], 'Возражение') !== false)) {
							echo '


						<div class="document-header-block">
							<div class="document-header-line">В <span>'. $sud['id'] . '</span></div>
							<div class="document-header-line">Адрес суда: <span>'. $sud["region"] . ' ' . $sud["district"] . ' ' . $sud["name"] . '</span></div>
							<div class="document-header-line">Истец: <span>'. $client["family"] . ' ' . $client["first_name"]  . ' ' . $client["middle_name"] . '</span></div>
							<div class="document-header-line">Юридический адрес: <span>'. $client["jur_address"] . '</span></div>
							<div class="document-header-line">Адрес фактического места нахождения:<br><span>'. $client["fact_address"] . '</span></div>
							<div class="document-header-line">ИНН: <span>'. $client["inn"] . '</span></div>
							<div class="document-header-line">Номер: <span>'. $client['phone'] . '</span></div>
							<div class="document-header-line">Электронная почта: <span>'. $client['email'] . '</span></div>
							<div class="document-header-line">Представитель по доверенности: <br><span>________</span></div>
							<div class="document-header-line"></div>
						</div>
						<div class="document-header-block">
							<div class="document-header-line">Ответчик:<span>_____</span></div>
							<div class="document-header-line">Адрес: <span>_____</span></div>
							<div class="document-header-line">Истец: <span>_____</span></div>
							<div class="document-header-line">ИНН: <span>_____</span></div>
							<div class="document-header-line">Номер: <span>______</span></div>
							<div class="document-header-line">Электронная почта: <span>______</span></div>
						</div>

							';
					} else if  (strpos($current_doc['type'], 'Ходатайство') !== false) { 
							echo '
						<div class="document-header-block">
							<div class="document-header-line">В <span>'. $sud['id'] . '</span></div>
							<div class="document-header-line">Адрес суда: <span>'. $sud["region"] . ' ' . $sud["district"] . ' ' . $sud["name"] . '</span></div>
						</div>
						<div class="document-header-block">
							<div class="document-header-line">От подсудимого:<span>'. $client["family"] . ' ' . $client["first_name"]  . ' ' . $client["middle_name"] . '</span></div>
							<div class="document-header-line">Адрес регистрации: <span><br>'. $client["jur_address"] . '</span></div>
							<div class="document-header-line">Адрес фактического места жительства: <br><span>'. $client["fact_address"] . '</span></div>
							<div class="document-header-line">Номер: <span>'. $client["phone"] . '</span></div>
							<div class="document-header-line">Электронная почта: <span>'. $client["email"] . '</span></div>
						</div>
						<div class="document-header-block">
							<div class="document-header-line">Адвокат: <span>_____</span></div>
							<div class="document-header-line">Адрес: <span>_____</span></div>
							<div class="document-header-line">Номер: <span>_____</span></div>
						</div>
							';
					} else if  (strpos($current_doc['type'], 'Жалоба') !== false) { 
							echo '
						<div class="document-header-block">
							<div class="document-header-line">В <span>'. $sud['id'] . '</span> <br>(ВТОРАЯ ИНСТАНЦИЯ)</div>
							<div class="document-header-line">Адрес суда: <span>'. $sud["region"] . ' ' . $sud["district"] . ' ' . $sud["name"] . '</span></div>
						</div>
						<div class="document-header-block">
							<div class="document-header-line">Истец:<span>'. $client["family"] . ' ' . $client["first_name"]  . ' ' . $client["middle_name"] . '</span></div>
							<div class="document-header-line">Адрес: <span>'. $client['fact_address'] . '</span></div>
							<div class="document-header-line">ИНН: <span>'. $client['inn'] . '</span></div>
							<div class="document-header-line">Номер: <span>'. $client['phone'] . '</span></div>
							<div class="document-header-line">Электронная почта: <span>'. $client['email'] . '</span></div>
						</div>
							';
					} else {
							echo '
							<div class="document-header-block">
								<div class="document-header-line">В <span>'. $sud['id'] . '</span></div>
								<div class="document-header-line">Адрес суда: <span>'. $sud["region"] . ' ' . $sud["district"] . ' ' . $sud["name"] . '</span></div>
								<div class="document-header-line">Истец: <span>'. $client["family"] . ' ' . $client["first_name"]  . ' ' . $client["middle_name"] . '</span></div>
								<div class="document-header-line">Юридический адрес: <span>'. $client['jur_address'] . '</span></div>
								<div class="document-header-line">Адрес фактического места нахождения:<br><span>'. $client['fact_address'] . '</span></div>
								<div class="document-header-line">ИНН: <span>'. $client['inn'] . '</span></div>
								<div class="document-header-line">Номер: <span>'. $client['phone'] . '</span></div>
								<div class="document-header-line">Электронная почта: <span>'. $client['email'] . '</span></div>
								<div class="document-header-line">Представитель по доверенности: <br><span>_____</span></div>
							</div>
							<div class="document-header-block">
								<div class="document-header-line">Ответчик:<span>_____</span></div>
								<div class="document-header-line">Адрес: <span>_____</span></div>
								<div class="document-header-line">Истец: <span>_____</span></div>
								<div class="document-header-line">ИНН: <span>_____</span></div>
								<div class="document-header-line">Номер: <span>______</span></div>
								<div class="document-header-line">Электронная почта: <span>_____</span></div>
							</div>

							';
					}
				?>
				</div>


			</div>
			<!-- /Шапка -->


			<!-- Дело -->
			<div class="document-subtitle">
				<h2>Дело № <span><?= Html::encode($current_doc['id']) ?></span></h2>
				<p class="document-date">&laquo;<span>10</span>&raquo;<span>декабря 2024</span> года</p>
			</div>
			<!-- /Дело -->


			<!-- Заголовок -->
			<div class="document-title">
				<h1><?= Html::encode($current_doc['type']) ?></h1>
				<p><?= Html::encode($current_doc['title']) ?></p>
			</div>
			<!-- /Заголовок -->


			<!-- С О Д Е Р Ж А Н И Е -->
			<div class="document-content">
				<?= $current_doc['content'] ?>
			</div>
			<!-- /// С О Д Е Р Ж А Н И Е -->


			<!-- Приложения -->
			<div class="document-attachments">
				<p><strong>Приложения:</strong></p>
				<p>1. Договор №______ от _______________года;</p>
				<p>2. </p>
			</div>
			<!-- /Приложения -->


			<!-- Подвал -->
			<div class="document-footer">
				<p>___________________/___________________</p>
			</div>
			<!-- /Подвал -->
			<!--<div class="page-line"></div>-->
		</div>

	</div>
</form>

<script>
	var commandButtons = document.querySelectorAll(".editor-commands a");
	for (var i = 0; i < commandButtons.length; i++) {
		commandButtons[i].addEventListener("mousedown", function(e) {
			e.preventDefault();

			var button = e.target.closest('a[data-command]');
			var commandName = button.getAttribute("data-command");
			if (commandName === "html") {
				var commandArgument = button.getAttribute("data-command-argument");
				document.execCommand('formatBlock', false, commandArgument);
			} else {
				document.execCommand(commandName, false);
			}
		});
	}
	/*
		document.getElementById("PreviewButton").addEventListener("click", function(e) {
			e.preventDefault();
			document.getElementById("Preview").innerText = document.getElementById("Editor").innerHTML;
		});
	*/


	$('#save-doc').on('click', function(e) {
    e.preventDefault(); 

    let data = {
				creator_id: $('#creator_id').val(),
        title: $('#doc_name').val(),
        type: $('#doc_type').val(),
        pravo: $('#doc_pravo').val(),
        folder_id: $('#doc_folders').attr('data-folder'),
        content: $('#content').html()
    };

		console.log(data);

    $.ajax({
        url: 'index.php?r=documents/create',
        type: 'POST',
        data: data,
        success: function(response) {
            console.log('Документ сохранен', response);
						window.location.href = 'https://lawico.ru/index.php?r=crm';
        },
        error: function(xhr, status, error) {
            console.error('Ошибка при сохранении документа:', error);
        }
    });
    console.log('3');
});


/*
document.getElementById('save-doc').addEventListener('click', function(e) {
    e.preventDefault();
    console.log('0');

    const saveForm = document.getElementById('save-form');
    const formData = new FormData(saveForm);

    formData.append('content', document.getElementById('content').innerHTML);
    console.log('2');

    fetch('index.php?r=documents/create', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            console.log('Документ сохранен');
            console.log(response);
        } else {
            return response.text().then(text => { throw new Error(text); });
        }
    })
    .catch(error => {
        console.error('Ошибка при сохранении документа:', error);
    });

    console.log('3');
});
*/
</script>