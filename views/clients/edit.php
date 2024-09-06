<div class="form-row">
							<div class="col">
								<label for="doc_name">Название документа</label>
								<input type="text" id="doc_name" name="doc_name" class="form-control form-control-sm" placeholder="Например Аппеляция по делу Иванова" aria-label="Название документа" style="height: auto;">
							</div>
							<div class="col">
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
							<div class="col">
								<label for="doc_category">Право</label>
								<input list="doc_category_list" id="doc_category" name="doc_category" class="form-control form-control-sm mb-3" style="height: auto;" />
								<datalist id="doc_category_list">
									<?php
									foreach ($uniquePravos as $pravo_item) {
										echo '<option value="' . $pravo_item . '">' . $pravo_item . '</option>';
									}
									?>
								</datalist>
							</div>
							<div class="col">
								<label for="doc_category">Папка</label>
								<input list="doc_folders_list" id="doc_folders" name="doc_folders" class="form-control form-control-sm mb-3" style="height: auto;" />
								<datalist id="doc_folders_list">
									<?php
									foreach ($folders as $folder) {
										echo '<option value="' . $folder['title'] . '">' . $folder['title'] . '</option>';
									}
									?>
								</datalist>
							</div>
						</div>