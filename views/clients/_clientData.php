<?php

/** @var \app\models\db\Clients $data */

use app\models\db\CourtsAddresses;
use app\models\db\TemplatesDocs;
use app\models\db\Clients;
use app\models\db\ClientFolders;
use app\models\db\ClientDocuments;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


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
		'creator_id' => $data->id,
		'publish_status' => 1,
	])
	->asArray()
	->all();


$docs = ClientDocuments::find()
	->where([
		'creator_id' => $data->id,
		'publish_status' => 1,
	])
	->asArray()
	->all();

?>



<input type="hidden" class="id" value="<?= $data->id ?>">
<input type="hidden" class="client-id" value="<?= $data->id ?>">
<input type="hidden" class="add-f-client_id" value="<?= $data->id ?>">
<style>
	.accordion .accordion-item .accordion-button::after {
		display: none;
		<?php // @todo: потом открыть заменив на карандашик для редактирования категории 
		?>
	}
</style>



<div class="row">
	<div class="left-panel col-7">
		<div class="offcanvas-header">
			<h5 class="offcanvas-title text-gradient-light-red form-title" id="offcanvasRightLabel">
				<?php
				if ($data['category_id'] == 3) {
					echo 'ИП ';
				}
				?>
				<?= $data->family ?> <?= $data->first_name ?> <?= $data->middle_name ?>
			</h5>
			<button class="window-buttons-add add custom-btn btn-8" data-bs-toggle="modal" data-bs-target="#docsSent">
				<span><img src="./img/sent.png" alt="sent"></span></button>
		</div>

		<div class="docs-manager px-3" id="docs-manager">
			<ul class="docs-actions">
				<li class="docs-actions-item mb-3">
					<details class="docs-actions-details">
						<summary>Создать папку</summary>
						<div class="input-group my-3">
							<input type="text" id="folder_name" class="form-control form-control-sm" placeholder="Название папки" aria-label="Название папки">
							<div class="input-group-append">
								<button class="btn btn-outline-secondary" id="create-folder">Создать</button>
							</div>
						</div>
					</details>
				</li>
				<li class="docs-actions-item mb-3">
					<?= Html::a('Создать документ', ['clients/new-document', 'user_id' => $data->id], ['class' => 'btn btn-primary']) ?>
				</li>
				<li class="docs-actions-item mb-3">
				<details class="pdf-block" open>
						<summary>Создать документ на основе шаблона</summary>
						<ul class="types-list -base">
								<?php
								foreach ($types as $type) {
										echo '<li>' . $type . '</li>';
								}
								?>
						</ul>
						<ul class="types-list -pravo">
								<?php
								foreach ($uniquePravos as $pravo_item) {
										echo '<li>' . $pravo_item . '</li>';
								}
								?>
						</ul>
						<ul class="pdf-block-list">
								<?php echo $this->render('//templates/index', [
										'data' => $data,
								]); ?>
						</ul>
						<label id="drop-filter">Отобразить всё</label>
					</details>
				</li>
			</ul>


			<style>

				.folder-list,
				.docs-list{
					padding-top: 1rem;
				}

				.folder-list-item + .folder-list-item,
				.docs-list-item + .docs-list-item{
					margin-top: 0.4rem;
				}

				.folder-list span,
				.docs-list span{
					position: relative;
				}

				.folder-list span a,
				.docs-list span a{
					font-size: 14px;
				}

				.delete-document,
				.rename-folder,
				.delete-folder{
					font-size: 14px;
				}

				.rename-folder{
					color: #ff9f47 !important;
				}

				.delete-document,
				.delete-folder{
					color: red !important;
				}

				.folder-list span a:before,
				.docs-list span a:before{
					content: '';
					display: block;
					position: absolute;
					bottom: 0;
					right: 0;
					left: 1.2rem;
					border-bottom: 2px solid transparent;
					background-image: radial-gradient(circle, #ced5e3 1px, transparent 1px);
					background-size: 4px 4px; 
					background-repeat: repeat-x;
				}
			</style>

			<strong>Папки</strong>
			<ul class="docs-area" id="docs-area">
				<li class="docs-area-section mb-5">
					<ul class="folder-list">

						<?php
							$folderDocCount = array_count_values(array_column($docs, 'folder_id'));
						?>

						<?php foreach ($folders as $folder) : ?>
							<li class="folder-list-item">
								<span>
									<b>🖿</b>
									<a data-id="<?= $folder['id'] ?>" class="folder" <?php if (isset($folderDocCount[$folder['id']]) && $folderDocCount[$folder['id']] > 0) : ?>data-existing<?php endif; ?>>
										<?= Html::encode($folder['title']) ?>
									</a>
									<?php if (isset($folderDocCount[$folder['id']]) && $folderDocCount[$folder['id']] > 0) : ?>
                    <sup><small><?= $folderDocCount[$folder['id']] ?></small></sup>
                  <?php endif; ?>
								</span>
								<div>
									<a class="rename-folder" data-id="<?= $folder['id'] ?>" data-type="folder">переименовать</a> | 
									<a class="delete-folder" data-id="<?= $folder['id'] ?>" data-type="folder">удалить</a>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				</li>


				<li class="docs-area-section">
					<strong>Документы</strong> <a class="show-all-docs" href="#">[показать все]</a>
					<ul class="docs-list">
						<?php foreach ($docs as $doc) : ?>
							<li class="docs-list-item">
								<span>
									<b>🖹</b>
									<?= Html::a(Html::encode($doc['title']), 
										[
											'clients/document', 
											'id' => $doc['id'],
											'user_id' => $data->id											
										], 
										[
											'class' => 'document',
											'data-folder' => $doc['folder_id']
										]) 
									?>
								</span>
								<div>
									<a href="#" class="delete-document" data-id="<?= $doc['id'] ?>" data-type="document">удалить</a>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				</li>
			</ul>
		</div>

		<script>
			// Функция для получения текущей даты и времени в формате YYYY-MM-DD HH:MM:SS
			function getCurrentDateTime() {
				var now = new Date();

				var year = now.getFullYear();
				var month = ('0' + (now.getMonth() + 1)).slice(-2); // Месяцы начинаются с 0
				var day = ('0' + now.getDate()).slice(-2);
				var hours = ('0' + now.getHours()).slice(-2);
				var minutes = ('0' + now.getMinutes()).slice(-2);
				var seconds = ('0' + now.getSeconds()).slice(-2);

				return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
			}
			$(function() {

				// СОЗДАНИЕ ПАПКИ
				$('#create-folder').on('click', function() {
					let folderName = $('#folder_name').val();
					let user_id = $('.client-data-id').val();
					$.ajax({
						url: '<?= Yii::$app->urlManager->createUrl(['folders/create']) ?>',
						method: 'GET',
						data: {
							folder_name: folderName,
							user_id: user_id,
						},
						success: function(res) {
							console.log(res);
							if (res.success) {
								$('.folder-list').html(res.folderListHtml);
								$('#folder_name').val('');
							} else {
								console.log('Ошибка при создании папки: ' + res.message);
							}
						}
					});
				});
				// ПЕРЕИМЕНОВАНИЕ ПАПКИ
				$(document).on('click', '.rename-folder' ,function() {
					
					let folderID = $(this).attr('data-id');
					
					let currentTitle = $(this).closest('.folder-list-item').find('a.folder').text().trim();
					let newTitle = prompt('Введите новое название папки:', currentTitle);
					let user_id = $('.client-data-id').val();


					if (newTitle !== null && newTitle.trim() !== '') {
							$.ajax({
									url: '<?= Yii::$app->urlManager->createUrl(['folders/update']) ?>',
									method: 'GET',
									data: {
											folderID: folderID,
											newTitle: newTitle,
											user_id: user_id,
									},
									success: function(res) {
											if (res.success) {
												console.log('УСПЕШНО');
												$('.folder-list').html(res.renamedFolderListHtml);
											} else {
													alert('Ошибка: ' + res.message);
											}
									},
									error: function(res) {
										console.log(res.message);
									}
							});
					} else if (newTitle !== null) {
							alert('Название папки не может быть пустым.');
					}
			});
			// УДАЛЕНИЕ ПАПКИ
			$(document).on('click', '.delete-folder', function() {
					let folderID = $(this).attr('data-id');
					let userID = $('.client-data-id').val();
					console.log('DEL');

					$(this).closest('.folder-list-item').remove();
					$('.document[data-folder="' + folderID + '"]').closest('.docs-list-item').remove();

					$.ajax({
							url: '<?= Yii::$app->urlManager->createUrl(['folders/remove']) ?>',
							method: 'GET',
							data: {
									folderID: folderID,
									userID: userID,
							},
							success: function(res) {
									if (res.success) {
										console.log('УСПЕШНО');
										$('.folder-list').html(res.updatedFolderListHtml);
										$('.docs-list').html(res.updatedDocsListHtml);
									} else {
										console.log('success q: ' + res.success);
										console.log('message q: ' + res.message);
										console.log('errors q: ' + res.errors);
									}
							},
							error: function(res) {
								console.log('success e: ' + res.success);
								console.log('message e: ' + res.message);
								console.log('errors e: ' + res.errors);
							}
					});
			});

			// УДАЛЕНИЕ ДОКУМЕНТА
			$(document).on('click', '.delete-document', function() {
					let documentID = $(this).attr('data-id');
					let userID = $('.client-data-id').val();
					console.log('DEL');
					$(this).closest('.docs-list-item').remove();

					$.ajax({
							url: '<?= Yii::$app->urlManager->createUrl(['documents/remove']) ?>',
							method: 'GET',
							data: {
									documentID: documentID,
									userID: userID,
							},
							success: function(res) {
									if (res.success) {
										console.log('УСПЕШНО');
										$('.docs-list').html(res.documentsListHtml);
									} else {
										console.log('success q: ' + res.success);
										console.log('message q: ' + res.message);
										console.log('errors q: ' + res.errors);
									}
							},
							error: function(res) {
								console.log('success e: ' + res.success);
								console.log('message e: ' + res.message);
								console.log('errors e: ' + res.errors);
							}
					});
			});

			// КЛИК ПО ПАПКЕ

			$('.folder-list .folder[data-existing]').on('click', function(e) {
					e.preventDefault();
					let folderId = $(this).data('id');

					console.log(folderId);

					$('.docs-list .docs-list-item').each(function() {
							let documentFolderId = $(this).find('.document').data('folder');
							if (documentFolderId == folderId) {
									$(this).show();
							} else {
									$(this).hide();
							}
					});
			});

			// ПОКАЗАТЬ ВСЕ ДОКУМЕНТЫ

			$('.show-all-docs').on('click', function(e) {
					e.preventDefault();
					$('.docs-list .docs-list-item').each(function() {
						$(this).show();
					});
			});


			$('.types-list li').click(function () {
					$('.pdf-block-item').removeClass('hidden');
					var text = $(this).text().toLowerCase();
					$('.pdf-block-item').each(function () {
							var pdfText = $(this).find('.pdf-block-link').text().toLowerCase();
							if (pdfText.indexOf(text) === -1) {
									console.log('Найден')
									$(this).addClass('hidden');
							} else {
									console.log('No')
							}
					});
			});
			$('#drop-filter').click(function () {
					$('.pdf-block-item').removeClass('hidden');
			});




	})



		</script>

	</div>
	<div class="right-panel col-5">
		<div class="client-params">

			<script src="/js/parsley.js"></script>

			<form class="client-params-fields" id="client-data-form" data-parsley-validate="">
				<strong>Данные клиента:</strong>
				<input type="hidden" class="form-control client-data-id" name="id" value="<?= $data->id ?>">
				<input type="hidden" class="form-control client-data-category_id" name="category_id" value="<?= $data->category_id ?>">

				<div class="client-params-swither">
					<?php if ($data['category_id'] == 1) : ?>
						<label class="badge badge-pill badge-primary">Физическое лицо</label>
					<?php endif; ?>
					<?php if ($data['category_id'] == 3) : ?>
						<label class="badge badge-pill badge-primary">Индивидуальный предприниматель</label>
					<?php endif; ?>
					<?php if ($data['category_id'] == 2) : ?>
						<label class="badge badge-pill badge-primary">Юридическое лицо</label>
					<?php endif; ?>
					<?php
					echo 'id клиента: ' . $data['id'];
					?>
				</div>

				<!-- Не скрытое под спойлером -->

				<ul class="client-params-list">

					<li class="client-params-item form-group">
						<label>Регионы</label>
						<?php
						$courtRegionExisting = !empty($data['court_region']);
						$existingSudId = !empty($data['court_name']) ? $data['court_name'] : null;

						var_dump($courtRegionExisting);
						?>
						<select class="form-control client-data-courts_addresses" name="court_region">
							<?php
							$sourceCourtAdressess = CourtsAddresses::find()
								->select('region')
								->distinct()
								->column();

							$courtAdressess = array_unique(array_map('trim', $sourceCourtAdressess));

							foreach ($courtAdressess as $region) {
								echo '<optgroup label="' . htmlspecialchars($region) . '">';

								$districts = CourtsAddresses::find()
									->select('district')
									->where(['region' => $region])
									->distinct()
									->column();

								foreach ($districts as $district) {
									$trimmedDistrict = trim($district);
									$selected = ($courtRegionExisting && $trimmedDistrict === $data['court_region']) ? ' selected' : '';
									echo '<option value="' . htmlspecialchars($trimmedDistrict) . '"' . $selected . '>' . htmlspecialchars($trimmedDistrict) . '</option>';
								}

								echo '</optgroup>';
							}
							?>
						</select>
					</li>

					<li class="client-params-item form-group">
						<label>Суд</label>
						<select name="court_name" id="client-data-sud" class="form-control client-data-sud">
							<!-- Здесь будут опции, полученные через AJAX -->
						</select>
					</li>

					<script>
						$(document).ready(function() {
							var existingSudId = <?= json_encode($existingSudId) ?>; // Передаем ID существующего суда в JavaScript

							console.log('existingSudId');

							function loadCourts(district) {
								$.ajax({
									url: '<?= Yii::$app->urlManager->createUrl(['clients/get-courts-by-region']) ?>',
									type: 'GET',
									data: {
										district: district
									},
									success: function(data) {
										$('#client-data-sud').empty();
										$.each(data, function(index, titleCourt) {
											var selected = (existingSudId && existingSudId == titleCourt.name) ? ' selected' : '';
											$('#client-data-sud').append('<option value="' + titleCourt.name + '"' + selected + '>' + titleCourt.name + '</option>');
										});
									}
								});
							}

							// Загрузка судов при инициализации страницы
							var initialDistrict = $('.client-data-courts_addresses').val();
							if (initialDistrict) {
								loadCourts(initialDistrict);
							}

							// Обработчик изменения выбора района
							$('.client-data-courts_addresses').change(function() {
								var district = $(this).val();
								loadCourts(district);
							});
						});
					</script>


					<li class="client-params-item form-group">
						<label>Процессуальный статус</label>
						<select class="form-control client-data-status" name="status" data-parsley-trigger="change" required="" data-parsley-error-message="Заполните поле">
							<optgroup label="Участники судебного процесса">
								<option value="Истец" <?= $data->status == 'Истец' ? 'selected' : '' ?>>Истец</option>
								<option value="Заявитель" <?= $data->status == 'Заявитель' ? 'selected' : '' ?>>Заявитель</option>
								<option value="Ответчик" <?= $data->status == 'Ответчик' ? 'selected' : '' ?>>Ответчик</option>
								<option value="Прокурор" <?= $data->status == 'Прокурор' ? 'selected' : '' ?>>Прокурор</option>
								<option value="Третье лицо" <?= $data->status == 'Третье лицо' ? 'selected' : '' ?>>Третье лицо</option>
								<option value="Адвокат" <?= $data->status == 'Адвокат' ? 'selected' : '' ?>>Адвокат</option>
								<option value="Представитель" <?= $data->status == 'Представитель' ? 'selected' : '' ?>>Представитель</option>
								<option value="Свидетель" <?= $data->status == 'Свидетель' ? 'selected' : '' ?>>Свидетель</option>
								<option value="Специалист" <?= $data->status == 'Специалист' ? 'selected' : '' ?>>Специалист</option>
								<option value="Эксперт" <?= $data->status == 'Эксперт' ? 'selected' : '' ?>>Эксперт</option>
								<option value="Переводчик" <?= $data->status == 'Переводчик' ? 'selected' : '' ?>>Переводчик</option>
								<option value="Заинтересованное лицо" <?= $data->status == 'Заинтересованное лицо' ? 'selected' : '' ?>>Заинтересованное лицо</option>
								<option value="Медиатор" <?= $data->status == 'Медиатор' ? 'selected' : '' ?>>Медиатор</option>
								<option value="Следователь" <?= $data->status == 'Следователь' ? 'selected' : '' ?>>Следователь</option>
								<option value="Руководитель следственного органа" <?= $data->status == 'Руководитель следственного органа' ? 'selected' : '' ?>>Руководитель следственного органа</option>
								<option value="Орган дознания" <?= $data->status == 'Орган дознания' ? 'selected' : '' ?>>Орган дознания</option>
								<option value="Начальник подразделения дознания" <?= $data->status == 'Начальник подразделения дознания' ? 'selected' : '' ?>>Начальник подразделения дознания</option>
								<option value="Начальник органа дознания" <?= $data->status == 'Начальник органа дознания' ? 'selected' : '' ?>>Начальник органа дознания</option>
								<option value="Дознаватель" <?= $data->status == 'Дознаватель' ? 'selected' : '' ?>>Дознаватель</option>
								<option value="Потерпевший" <?= $data->status == 'Потерпевший' ? 'selected' : '' ?>>Потерпевший</option>
								<option value="Частный обвинитель" <?= $data->status == 'Частный обвинитель' ? 'selected' : '' ?>>Частный обвинитель</option>
								<option value="Гражданский истец" <?= $data->status == 'Гражданский истец' ? 'selected' : '' ?>>Гражданский истец</option>
								<option value="Представители потерпевшего, гражданского истца и частного обвинителя" <?= $data->status == 'Представители потерпевшего, гражданского истца и частного обвинителя' ? 'selected' : '' ?>>Представители потерпевшего, гражданского истца и частного обвинителя</option>
								<option value="Подозреваемый" <?= $data->status == 'Подозреваемый' ? 'selected' : '' ?>>Подозреваемый</option>
								<option value="Обвиняемый" <?= $data->status == 'Обвиняемый' ? 'selected' : '' ?>>Обвиняемый</option>
								<option value="Законные представители несовершеннолетнего подозреваемого и обвиняемого" <?= $data->status == 'Законные представители несовершеннолетнего подозреваемого и обвиняемого' ? 'selected' : '' ?>>Законные представители несовершеннолетнего подозреваемого и обвиняемого</option>
								<option value="Защитник" <?= $data->status == 'Защитник' ? 'selected' : '' ?>>Защитник</option>
								<option value="Гражданский ответчик" <?= $data->status == 'Гражданский ответчик' ? 'selected' : '' ?>>Гражданский ответчик</option>
								<option value="Представитель гражданского ответчика" <?= $data->status == 'Представитель гражданского ответчика' ? 'selected' : '' ?>>Представитель гражданского ответчика</option>
								<option value="Лицо, в отношении которого уголовное дело выделено в отдельное производство в связи с заключением с ним досудебного соглашения о сотрудничестве" <?= $data->status == 'Лицо, в отношении которого уголовное дело выделено в отдельное производство в связи с заключением с ним досудебного соглашения о сотрудничестве' ? 'selected' : '' ?>>Лицо, в отношении которого уголовное дело выделено в отдельное производство в связи с заключением с ним досудебного соглашения о сотрудничестве</option>
								<option value="Понятой" <?= $data->status == 'Понятой' ? 'selected' : '' ?>>Понятой</option>
							</optgroup>
							<optgroup label="Административные участники">
								<option value="Административный истец" <?= $data->status == 'Административный истец' ? 'selected' : '' ?>>Административный истец</option>
								<option value="Административный ответчик" <?= $data->status == 'Административный ответчик' ? 'selected' : '' ?>>Административный ответчик</option>
								<option value="Лицо, в отношении которого ведется производство по делу об административном правонарушении" <?= $data->status == 'Лицо, в отношении которого ведется производство по делу об административном правонарушении' ? 'selected' : '' ?>>Лицо, в отношении которого ведется производство по делу об административном правонарушении</option>
							</optgroup>
							<optgroup label="Представители">
								<option value="Законный представитель физического лица" <?= $data->status == 'Законный представитель физического лица' ? 'selected' : '' ?>>Законный представитель физического лица</option>
								<option value="Законный представитель юридического лица" <?= $data->status == 'Законный представитель юридического лица' ? 'selected' : '' ?>>Законный представитель юридического лица</option>
								<option value="Защитник и представитель" <?= $data->status == 'Защитник и представитель' ? 'selected' : '' ?>>Защитник и представитель</option>
							</optgroup>
							<optgroup label="Предприниматели">
								<option value="Уполномоченный при Президенте Российской Федерации по защите прав предпринимателей" <?= $data->status == 'Уполномоченный при Президенте Российской Федерации по защите прав предпринимателей' ? 'selected' : '' ?>>Уполномоченный при Президенте Российской Федерации по защите прав предпринимателей</option>
								<option value="Уполномоченный по защите прав предпринимателей в субъекте Российской Федерации" <?= $data->status == 'Уполномоченный по защите прав предпринимателей в субъекте Российской Федерации' ? 'selected' : '' ?>>Уполномоченный по защите прав предпринимателей в субъекте Российской Федерации</option>
							</optgroup>
							<optgroup label="Арбитраж и банкротство">
								<option value="Кредитор" <?= $data->status == 'Кредитор' ? 'selected' : '' ?>>Кредитор</option>
								<option value="Арбитражный управляющий" <?= $data->status == 'Арбитражный управляющий' ? 'selected' : '' ?>>Арбитражный управляющий</option>
								<option value="Финансовый управляющий" <?= $data->status == 'Финансовый управляющий' ? 'selected' : '' ?>>Финансовый управляющий</option>
								<option value="Должник" <?= $data->status == 'Должник' ? 'selected' : '' ?>>Должник</option>
							</optgroup>
						</select>
					</li>

					<?php if ($data['category_id'] == 1) : ?>
						<li class="client-params-item form-group">
							<label>ФИО</label>
							<div class="three-fields">
								<input type="text" class="form-control client-data-family" name="family" placeholder="Фамилия" value="<?= $data->family ?>" data-parsley-trigger="change" required="" data-parsley-error-message="Заполните поле">
								<input type="text" class="form-control client-data-name" name="first_name" placeholder="Имя" value="<?= $data->first_name ?>" data-parsley-trigger="change" required="" data-parsley-error-message="Заполните поле">
								<input type="text" class="form-control client-data-middle-name" name="middle_name" placeholder="Отчество" value="<?= $data->middle_name ?>" data-parsley-trigger="change" required="" data-parsley-error-message="Заполните поле">
							</div>
						</li>
					<?php endif; ?>

					<?php if ($data['category_id'] == 2) : ?>
						<li class="client-params-item form-group">
							<label>Наименование</label>
							<input type="text" class="form-control client-data-company_title" name="company_title" value="<?= $data->company_title ?>" data-parsley-trigger="change" required="" data-parsley-error-message="Заполните поле">
						</li>
					<?php endif; ?>


					<?php if ($data['category_id'] == 3) : ?>
						<li class="client-params-item form-group">
							<label>Наименование</label>
							<input type="text" class="form-control client-data-" name="company_title" value="<?= $data->company_title ?>" data-parsley-trigger="change" required="" data-parsley-error-message="Заполните поле">
						</li>
					<?php endif; ?>

				</ul>


				<!-- / -->

				<!-- Раскрывающиеся списки -->

				<!-- Физическое лицо -->
				<?php if ($data['category_id'] == 1) : ?>
					<details class="client-params-detail">
						<summary class="client-params-summary">Полная информация</summary>
						<ul class="client-params-list">
							<li class="client-params-item form-group">
								<label>Дата рождения</label>
								<input type="date" class="form-control client-data-birth_date" name="birth_date" value="<?= $data->birth_date ?>">
							</li>
							<li class="client-params-item form-group">
								<label>Пол</label>
								<select name="gender" class="form-control client-data-gender">
									<option value="male" <?= $data->gender == 'male' ? 'selected' : ''; ?>>муж.</option>
									<option value="female" <?= $data->gender == 'female' ? 'selected' : ''; ?>>жен.</option>
								</select>
							</li>
							<li class="client-params-item form-group">
								<label>Место рождения</label>
								<input type="text" class="form-control client-data-birth_place" name="birth_place" value="<?= $data->birth_place ?>">
							</li>
							<li class="client-params-item form-group">
								<label>Адрес регистрации</label>
								<input type="text" class="form-control client-data-jur_address" name="jur_address" value="<?= $data->jur_address ?>">
							</li>
							<li class="client-params-item form-group">
								<label>Адрес фактического места жительства</label>
								<input type="text" class="form-control client-data-fact_address" name="fact_address" value="<?= $data->fact_address ?>">
							</li>
							<li class="client-params-item form-group">
								<label>ИНН</label>
								<input type="text" class="form-control client-data-inn" value="<?= $data->inn ?>" name="inn">
							</li>
							<li class="client-params-item form-group">
								<label>СНИЛС</label>
								<input type="text" class="form-control client-data-snils" name="snils" value="<?= $data->snils ?>">
							</li>
							<li class="client-params-item form-group">
								<label>Серия, номер и дата выдачи паспорта</label>
								<div class="three-fields">
									<input type="text" class="form-control client-data-pasport_serial" name="pasport_serial" placeholder="Серия" value="<?= $data->pasport_serial ?>">
									<input type="text" class="form-control client-data-pasport_number" name="pasport_number" placeholder="Номер" value="<?= $data->pasport_number ?>">
									<input type="date" class="form-control client-data-passport_issue_date" name="passport_issue_date" placeholder="Дата выдачи" value="<?= $data->passport_issue_date ?>">

								</div>

							</li>
							<li class="client-params-item form-group">
								<label>Кем выдан паспорт</label>
								<input type="text" class="form-control client-data-passport_issuing_authority" name="passport_issuing_authority" value="<?= $data->passport_issuing_authority ?>">
							</li>

							<li class="client-params-item form-group">
								<label>Код подразделения</label>
								<input type="text" class="form-control client-data-passport_issuing_authority_code" name="passport_issuing_authority_code" value="<?= $data->passport_issuing_authority_code ?>">
							</li>
							<li class="client-params-item form-group">
								<label>Телефон</label>
								<input type="text" class="form-control client-data-phone" name="phone" value="<?= $data->phone ?>">
							</li>
							<li class="client-params-item form-group">
								<label>Email</label>
								<input type="text" class="form-control client-data-email" name="email" value="<?= $data->email ?>">
							</li>
						</ul>
					</details>

				<?php endif; ?>

				<!-- Индивидуальный предприниматель  -->
				<?php if ($data['category_id'] == 3) : ?>
					<details class="client-params-detail">
						<summary class="client-params-summary">Полная информация</summary>
						<ul class="client-params-list">
							<li class="client-params-item form-group">
								<label>ИНН</label>
								<input type="text" class="form-control client-data-inn" name="inn" value="<?= $data->inn ?>">
							</li>
							<li class="client-params-item form-group">
								<label>ОГРНИП</label>
								<input type="text" class="form-control client-data-" name="ogrnip" value="<?= $data->ogrnip ?>">
							</li>
							<li class="client-params-item form-group">
								<label>Адрес регистрации</label>
								<input type="text" class="form-control client-data-jur_address" name="jur_address" value="<?= $data->jur_address ?>">
							</li>
							<li class="client-params-item form-group">
								<label>Адрес фактического места жительства</label>
								<input type="text" class="form-control client-data-fact_address" name="fact_address" value="<?= $data->fact_address ?>">
							</li>
							<li class="client-params-item form-group">
								<label>Email</label>
								<input type="text" class="form-control client-data-email" name="email" value="<?= $data->email ?>">
							</li>
							<li class="client-params-item form-group">
								<label>Телефон</label>
								<input type="text" class="form-control client-data-phone" name="phone" value="<?= $data->phone ?>">
							</li>
						</ul>
					</details>
				<?php endif; ?>

				<!-- Юридическое лицо (ООО)  -->
				<?php if ($data['category_id'] == 2) : ?>
					<details class="client-params-detail">
						<summary class="client-params-summary">Полная информация</summary>

						<ul class="client-params-list">
							<li class="client-params-item form-group">
								<label>ИНН</label>
								<input type="text" class="form-control client-data-inn" name="inn" value="<?= $data->inn ?>">
							</li>
							<li class="client-params-item form-group">
								<label>ОГРН</label>
								<input type="text" class="form-control client-data-ogrn" name="ogrn" value="<?= $data->ogrn ?>">
							</li>
							<li class="client-params-item form-group">
								<label>КПП</label>
								<input type="text" class="form-control client-data-kpp" name="kpp" value="<?= $data->kpp ?>">
							</li>
							<li class="client-params-item form-group">
								<label>Юридический адрес</label>
								<input type="text" class="form-control client-data-jur_address" name="jur_address" value="<?= $data->jur_address ?>">
							</li>
							<li class="client-params-item form-group">
								<label>Адрес фактического места нахождения</label>
								<input type="text" class="form-control client-data-fact_address" name="fact_address" value="<?= $data->fact_address ?>">
							</li>
							<li class="client-params-item form-group">
								<label>Email</label>
								<input type="text" class="form-control client-data-email" name="email" value="<?= $data->email ?>">
							</li>
							<li class="client-params-item form-group">
								<label>Телефон</label>
								<input type="text" class="form-control client-data-phone" name="phone" value="<?= $data->phone ?>">
							</li>
						</ul>
					</details>
				<?php endif; ?>

				<ul class="client-params-list">
					<li class="client-params-item form-group">
						<label>Комментарий</label>
						<input type="text" class="form-control client-data-comment" value="<?= $data->comment ?>">
					</li>
					<li class="client-params-item form-group">
						<label>Колонка</label>
						<select class="form-control client-data-status_position">
							<option value="1" <?php if ($data->status_position == 1) {
																	echo " selected ";
																} ?>>Новое обращение
							</option>
							<option value="2" <?php if ($data->status_position == 2) {
																	echo " selected ";
																} ?>>Запрос документов
							</option>
							<option value="3" <?php if ($data->status_position == 3) {
																	echo " selected ";
																} ?>>Встреча
							</option>
							<option value="4" <?php if ($data->status_position == 4) {
																	echo " selected ";
																} ?>>Консультация
							</option>
							<option value="5" <?php if ($data->status_position == 5) {
																	echo " selected ";
																} ?>>Не целевой лид
							</option>
							<option value="6" <?php if ($data->status_position == 6) {
																	echo " selected ";
																} ?>>Договор подписан
							</option>
							<option value="7" <?php if ($data->status_position == 7) {
																	echo " selected ";
																} ?>>Сделка сорвалась
							</option>
						</select>
					</li>
				</ul>

				<!--<a class="btn btn-success cd-save-form">Сохранить</a>-->

				<!-- Тестовая кнопка -->
				<a id="send-form" class="btn btn-primary">Сохранить</a>

				<div class="alert alert-danger" role="alert" style="display: none;">
					Заполните все необходимые поля!
				</div>
				<div class="alert alert-success " role="alert" style="display: none;">
					Данные клиента успешно обновлены
				</div>

			</form>


			<script>
				$(function() {

					/* Телефон*/
					const phoneInputs = document.querySelectorAll('input[name*="phone"]');
					const maskPhone = {
						mask: '+{7}(000)000-00-00'
					};
					phoneInputs.forEach(input => {
						IMask(input, maskPhone);
					});

					/* Серия паспорта*/
					const serialPassportInputs = document.querySelectorAll('input[name*="pasport_serial"]');
					const maskSerial = {
						mask: '0000'
					};
					serialPassportInputs.forEach(input => {
						IMask(input, maskSerial);
					});

					/* Номер паспорта*/
					const numPassportInputs = document.querySelectorAll('input[name*="passport_issue_date"]');
					const maskNumPassport = {
						mask: '000000'
					};
					numPassportInputs.forEach(input => {
						IMask(input, maskNumPassport);
					});

					/* Код подразделения */
					const authCodePassportInputs = document.querySelectorAll('input[name*="passport_issuing_authority_code"]');
					const authCodePassport = {
						mask: '000-000'
					};
					authCodePassportInputs.forEach(input => {
						IMask(input, authCodePassport);
					});

					/* СНИЛС */
					const snilsInputs = document.querySelectorAll('input[name*="snils"]');
					const snilsMask = {
						mask: '000-000-000 00'
					};
					snilsInputs.forEach(input => {
						IMask(input, snilsMask);
					});

					/* ИНН */
					const innInputs = document.querySelectorAll('input[name="inn"]');
					const innMask = {
						mask: '000000000000'
					};
					innInputs.forEach(input => {
						IMask(input, innMask);
					});


					var serializeForm = function(form) {
						var obj = {};
						var formData = new FormData(form);
						for (var key of formData.keys()) {
							obj[key] = formData.get(key);
						}
						return obj;
					};


					$('#send-form').on("click", function(e) {
						e.preventDefault();
						console.log('Клик');
						$('#client-data-form').parsley();
						$('#client-data-form').trigger('submit');
					});
					$('#send-form').on("click", function(e) {
						e.preventDefault();
						console.log('Клик');
						const form = $('#client-data-form');
						form.parsley();

						// Проверка валидности формы
						if (form.parsley().validate()) {
							form.trigger('submit');
						} else {
							$('.alert-danger').show();
							setTimeout(function() {
								$('.alert-danger').hide();
							}, 2500);
						}
					});


					$('#client-data-form').submit(function(e) {
						e.preventDefault();
						const modalForm = document.querySelector('#client-data-form');
						console.log('Триггер');
						const formData = new FormData(modalForm);
						console.log(serializeForm(modalForm));
						var data = serializeForm(modalForm);
						$.get("index.php?r=clients/save-modal-form-test", {
							data
						}, function(res) {
							console.log(res);
							$('.alert-success').show();
							setTimeout(function() {
								$('.alert-success').hide();
								window.location.reload();
							}, 2500);
						});
					});
				});

			</script>



			<div class="client-tasks">
				<strong>Задачи по клиенту:</strong>
				<ul class="client-tasks-list">
					<?php
					$tasks_by_current_client =
						\app\models\db\Tasks::find()->where(['client_id' => $data->id])->asArray()->all();
					foreach ($tasks_by_current_client as $task) { ?>
						<li class="client-tasks-item">
							<b><?= $task['title'] ?></b>
							<small><?= date('d.m.Y', $task['datetime']) ?></small>
							<p><?= $task['description'] ?></p>
						</li>
					<?php } ?>
				</ul>
			</div>

			<div class="client-persons">
				<strong>Участники по делу:</strong>

				<?php
				if (mb_strlen($data->persons) > 1) {
					$persons = json_decode($data->persons);

					foreach ($persons as $person) {
						$rand   = rand(10000, 999999);
						$person = (array)$person;

						echo '<a class="" data-bs-toggle="collapse" href="#spoiler' . $rand . '"
 role="button" aria-expanded="false" aria-controls="collapseExample">';
						echo "- {$person['client_f']} {$person['client_i']} {$person['client_o']}<br>";
						echo '</a>';

						echo "<div class='collapse' id='spoiler{$rand}'>";
						echo "<div class='card card-body' style='padding: 15px 7px'>";

						echo "Фамилия";
						echo "<input type='text' class='form-control mb-2' value='{$person['client_f']}'>";

						echo "Имя";
						echo "<input type='text' class='form-control mb-2' value='{$person['client_i']}'>";

						echo "Отчество";
						echo "<input type='text' class='form-control mb-2' value='{$person['client_o']}'>";

						echo "Дата рождения";
						echo "<input type='text' class='form-control mb-2' value='{$person['bday']}'>";

						echo "Пол";
						echo "<input type='text' class='form-control mb-2' value='{$person['sex']}'>";

						echo "Адрес регистрации - индекс";
						echo "<input type='text' class='form-control mb-2' value='{$person['reg_addr_index']}'>";

						echo "Адрес регистрации";
						echo "<input type='text' class='form-control mb-2' value='{$person['reg_addr']}'>";

						echo "Фактический адрес";
						echo "<input type='text' class='form-control mb-2' value='{$person['fact_addr']}'>";

						echo "СНИЛС";
						echo "<input type='text' class='form-control mb-2' value='{$person['snils']}'>";

						echo "ИНН";
						echo "<input type='text' class='form-control mb-2' value='{$person['inn']}'>";

						echo "Тип документа";
						echo "<input type='text' class='form-control mb-2' value='{$person['doc_type']}'>";

						echo "Серия документа";
						echo "<input type='text' class='form-control mb-2' value='{$person['doc_serial']}'>";

						echo "Номер документа";
						echo "<input type='text' class='form-control mb-2' value='{$person['doc_num']}'>";

						echo "E-mail";
						echo "<input type='text' class='form-control mb-2' value='{$person['email']}'>";

						echo "Телефон";
						echo "<input type='text' class='form-control mb-2' value='{$person['phone']}'>";

						echo "Коммент";
						echo "<input type='text' class='form-control mb-2' value='{$person['comment']}'>";

						echo "</div>";
						echo "</div>";
					}
				}

				?>
				<div class="persons-add">
					<p>
						<a href="#!" data-bs-toggle="modal" data-bs-target="#personsAdd" class="add-person-get-modal" data-id="<?= $data->id ?>">
							Добавить еще участника дела
						</a>
					</p>
				</div>

				<div class="persons-list">
					<?php
					// место для js
					// вывод списка из базы
					?>
				</div>
			</div>

			<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Закрыть">
				<a href="#!" style="color: transparent;" onclick="window.location.reload()">
					#!
				</a>
			</button>
		</div>
	</div>
</div>

<!-- ОТСУТСТВУЮЩАЯ МОДАЛКА  -->

<div class="modal fade modal-add persons-add" id="personsAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Добавить участника дела</h5>
				<a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
			</div>
			<div class="modal-body">
				<div class="account-window-tab-container">
					<div class="form-button-group">
					</div>

					<div style="display: flex">
						<button class="form-control change-type-form ctf-first" data-type="f">Физ. лицо</button>
						<button class="form-control change-type-form" data-type="j">Юр. лицо</button>
						<button class="form-control change-type-form" data-type="i">ИП</button>
					</div>

					<form id="person-form">
						<input type="hidden" name="page-refer" value="<?= $_SERVER['REQUEST_URI'] ?>">
						<input type="hidden" class="client-id" name="id" value="0">

						<div class="mb-3 row account-window-tab-flex">
							<label for="inputTitle" class="col-sm-2 col-form-label"></label>
							<div class="modal-padding">
								<label>Процессуальный статус</label>
								<select class="form-control" name="proc_status">
									<option value="1">Истец</option>
									<option value="2">Заявитель</option>
								</select>
							</div>
						</div>

						<div class="group-inputs inp-fiz">

							<div class="row min-mb-20">
								<div class="col-md-4">
									<div class="mb-3 row account-window-tab-flex">
										<label for="inputTitle" class="col-sm-2 col-form-label"></label>
										<div class="modal-padding">
											<label class="col-form-label">Фамилия</label>
											<input type="text" class="form-control add_c_f" placeholder="Фамилия" name="client_f" required>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="mb-3 row account-window-tab-flex">
										<label for="inputTitle" class="col-sm-2 col-form-label"></label>
										<div class="modal-padding">
											<label class="col-form-label">Имя</label>
											<input type="text" class="form-control add_c_i" placeholder="Имя" name="client_i">
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="mb-3 row account-window-tab-flex">
										<label for="inputTitle" class="col-sm-2 col-form-label"></label>
										<div class="modal-padding">
											<label class="col-form-label">Отчество</label>
											<input type="text" class="form-control add_c_o" placeholder="Отчество" name="client_o">
										</div>
									</div>
								</div>
							</div>

							<div class="row min-mb-40">
								<div class="col-md-5">
									<div class="mb-5 row account-window-tab-flex">
										<label for="inputTitle" class="col-sm-2 col-form-label"></label>
										<div class="modal-padding">
											<label class="col-form-label">Адрес регистрации</label>
											<input type="text" class="form-control add_c_index" placeholder="Индекс" name="reg_addr_index">
										</div>
									</div>
								</div>
								<div class="col-md-7">
									<div class="mb-5 row account-window-tab-flex">
										<label for="inputTitle" class="col-sm-2 col-form-label"></label>
										<div class="modal-padding">
											<label class="col-form-label">&nbsp;</label>
											<input type="text" class="form-control add_c_address" placeholder="Адрес" name="reg_addr">
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="group-inputs inp-jur">
							<div class="form-button-group">
								<div class="input-container">
									<label for="inputINN" class=" col-form-label">Именование организации</label>
									<input type="text" class="form-control add_c_orgname" name="orgname" placeholder="Именование организации">
								</div>
							</div>
							<div class="form-button-group">
								<div class="input-container">
									<label for="inputINN" class=" col-form-label">ИНН</label>
									<input type="text" class="form-control add_c_inn" placeholder="ИНН" name="orginn">
								</div>
								<div class="input-container">
									<label for="inputOGRN" class=" col-form-label">ОГРН</label>
									<input type="text" class="form-control add_c_ogrn" id="inputOGRN" placeholder="ОГРН" name="orgogrn">
								</div>
								<div class="input-container">
									<label for="inputKPP" class="col-sm-2 col-form-label">КПП</label>
									<input type="text" class="form-control form-date add_c_kpp" id="inputKPP" placeholder="КПП" name="orgkpp">
								</div>
							</div>
						</div>

						<div class="group-inputs inp-ip">
							<div class="form-button-group">
								<div class="input-container">
									<label for="inputINN" class=" col-form-label">ОГРНИП</label>
									<input type="text" class="form-control add_c_orgname" placeholder="ОГРНИП" name="ogrnip">
								</div>
							</div>
						</div>

						<div class="form-button-group">
							<div class="input-container">
								<label for="inputEmail" class=" col-form-label">Email</label>
								<input type="email" class="form-control " id="inputEmail" placeholder="Email" name="email">
							</div>
							<div class="input-container">
								<label for="inputPhone" class=" col-form-label">Телефон</label>
								<input type="phone" class="form-control " id="inputPhone" placeholder="Телефон" name="phone">
							</div>
						</div>

						<div class="row" style="margin-top: 25px">
							<div class="col-md-12">
								<textarea class="form-control" placeholder="Комментарий"></textarea>
							</div>
						</div>

				</div>
			</div>
			<div class="modal-footer">
				<input type="submit" class="window-buttons-add add custom-btn btn-8" value="Добавить">
			</div>
		</div>
	</div>
</div>



<style>
	.right-panel {
		height: 100vh !important;
		overflow: auto;
	}

	.offcanvas-header {
		height: 70vh;
		padding-bottom: 5%;
	}

	.pdf-block {
		margin-bottom: 2rem;
	}

	.pdf-block summary {
		font-size: 1rem;
		font-weight: bold;
		padding: 1rem 0;
	}

	.pdf-block-list {
		margin: 1rem 0;
    padding: 1rem;
    max-height: 200px;
    overflow-x: hidden;
    overflow-y: auto;
    border: 1px solid #9ecaf1;
    background-color: aliceblue;
    border-radius: 1rem 0 0 1rem;
    overflow-x: hidden;
}


	.pdf-block-item {
		display: flex;
		font-size: 15px;
		line-height: 1.2;
		list-style-type: none;
		font-family: math;
		gap: 0.5rem;
		align-items: center;
	}

	.pdf-block-item:before {
		font-size: 24px;
		flex-basis: 16px;
		content: '\01F5CE';
	}

	.pdf-block-link {
		color: dodgerblue;
		font-weight: 600;
	}

	.types-list {
		display: flex;
		flex-flow: row wrap;
		gap: 0.25rem;
	}

	.types-list li {
		font-size: 12px;
		padding: 2px 4px 3px;
		border-radius: 6px;
		background-color: lightblue;
		cursor: pointer;
	}

	.pdf-block-item.hidden {
		display: none;
	}

	.types-list.-base li {
		background-color: lightblue;
	}

	.types-list.-pravo li {
		background-color: lightcyan;
	}

	#drop-filter {
		font-size: 14px;
		color: dodgerblue;
	}

	.docs-actions-details[open] {
		background-color: #edf8ff;
		padding: 1rem 1rem 0rem 1rem;
		border: 1px solid #d1edff;
		border-radius: 0.5rem;
	}

	.docs-actions-details label {
		font-size: 12px;
	}

	.docs-actions-details select {
		height: auto;
	}

	.folder-list-item,
	.docs-list-item {
		display: grid;
		grid-template-columns: 1fr auto;
		grid-gap: 1rem;
		align-items: center;
	}

	.folder-list-item:has(.folder[data-existing]) > span{
		color: cornflowerblue;
	}

	.client-params {
		display: flex;
		flex-direction: column;
		gap: 2rem;
		padding: 1rem 1rem 1rem 0;
	}

	.client-params .btn-close.text-reset {
		position: absolute;
		right: 1.5rem;
		top: 0.5rem;
	}

	.client-params-item.form-group label {
		font-size: 13px;
		font-weight: bold;
		color: rgba(0, 0, 0, 0.6);
		margin-bottom: 0.2rem;
	}

	.client-params-item.form-group {
		margin-bottom: 0.5rem;
	}

	.client-params-item.form-group .form-control {
		height: 40px;
		line-height: 1.2;
		font-size: 15px;
	}

	.client-tasks-list {
		display: flex;
		flex-direction: column;
		gap: 1rem;
	}

	.client-tasks-item {
		display: grid;
		grid-template-columns: 1fr auto;
		grid-column-gap: 1rem;
		grid-row-gap: 0.5rem;
		border-radius: 7px;
		border: 1px solid #ececec;
		padding: 0.7rem;
	}

	.client-tasks-item small {
		color: darkgray;
	}

	.client-tasks-item p {
		grid-column: 1 / 3;
		margin: 0;
	}

	.three-fields {
		display: flex;
		flex-direction: column;
		gap: 1rem;
		padding: 1rem;
		border: 1px solid #ced4da;
		background-color: #f1f8ff;
	}

	.client-params-detail {
		font-size: 14px;
		margin-bottom: 1rem;
	}

	.client-params-summary {
		font-weight: bold;
		color: firebrick;
		margin-bottom: 1rem;
	}

	.parsley-custom-error-message {
		font-size: 10px;
		color: red;
	}

	#send-form {
		color: #fff;
		font-weight: bold;
		margin-bottom: 1rem;
	}
</style>