<style>
    .result{
        background: #d2a3d054;
        padding: 15px;
        border-radius: 8px;
    }
</style>
<div class="index-window">
    <div class="index-window-panel">
        <span class="index-window-panel-title text-gradient-light-red">
           Калькулятор госпошлины в Арбитражный суд
        </span>
    </div>
    <div class="case-container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">

                <label>Тип истца</label>
                <select class="form-control">
                    <option value="1">Физическое лицо</option>
                    <option value="2">Юридическое лицо</option>
                </select>

                <br>

                <label>Тип заявителя</label>
                <select class="form-control">
                    <option value="1">Заявление имущественного характера</option>
                    <option value="2">Заявление о выдаче судебного приказа</option>
                    <option value="3">Заявление неимущественного характера</option>
                    <option value="4">Надзорная жалоба</option>
                    <option value="5">Апелляционная и (или) кассационная жалоба</option>
                    <option value="6">Прочее</option>
                </select>

                <br>

                <div class="result">
                    Итого: 0 руб.
                </div>

            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end opacity box-edit box-client row" data-bs-backdrop="false" tabindex="-1"
     id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="rm-client-info"></div>
</div>