<section class="section-2 wf-section step_ref step4">
  <div class="w-layout-blockcontainer container-2 w-container">
    <div id="w-node-_55b004ee-e86c-ae03-31cd-16e8fbfaa1b0-cefcd759" class="w-layout-layout wf-layout-layout">
      <div id="w-node-_55b004ee-e86c-ae03-31cd-16e8fbfaa1b1-cefcd759" class="w-layout-cell cell-left">
        <div class="w-form">
          <form id="lead-data-step4" method="post" class="form">
            <input type="hidden" name="product_id" value="<?= $new_product_id ?>">
            <input type="hidden" name="form_step" value="4">

            <div class="box-input bigdata-field box_mothers_name">
              <label for="mothers_name"></label>
              <input type="text" class="w-input" name="mothers_name" id="mothers_name" placeholder="Nome completo da mãe" required>
            </div>

            <div class="box-input">
              <label for="bad_credit"></label>
              <select id="bad_credit" name="bad_credit" class="w-select" required>
                <option value="">Você está negativado?</option>
                <option value="sim">Sim, estou!</option>
                <option value="nao">Não estou!</option>
              </select>
            </div>

            <div class="box-input debt_value">
              <label for="debt_value"></label>
              <input type="tel" class="w-input" id="debt_value" name="debt_value" placeholder="Valor da dívida" required>
            </div>

            <div class="box-infos-residencia">
              <div class="box-input">
                <label for="has_own_house"></label>
                <select id="has_own_house" name="has_own_house" class="w-select campos2" required>
                  <option value="">Possui casa própria?</option>
                  <option value="true">Sim</option>
                  <option value="false">Não</option>
                </select>
              </div>

              <div class="box-input">
                <label for="residence_type_id"></label>
                <select id="residence_type_id" name="residence_type_id" class="w-select campos2" required>
                  <option value="">Tipo de residência...</option>
                  <option value="300">Alugada</option>
                  <option value="299">Cônjuge ou Familiares</option>
                  <option value="843">Própria Financiada</option>
                  <option value="298">Própria Quitada</option>
                </select>
              </div>

              <div class="box-input">
                <label for="time_at_address"></label>
                <select id="time_at_address" name="time_at_address" class="w-select campos2" required>
                  <option value="">Tempo de residência...</option>
                  <option value="1">1 mês</option>
                  <option value="2">2 meses</option>
                  <option value="3">3 meses</option>
                  <option value="6">4 a 6 meses</option>
                  <option value="12">7 a 12 meses</option>
                  <option value="24">1 a 2 anos</option>
                  <option value="25">Mais de 2 anos</option>
                </select>
              </div>
            </div>

            <input type="button" value="CONTINUAR" data-wait="Aguarde..." class="submit-button w-button bt-step4">
          </form>
        </div>
      </div>

      <div id="w-node-_55b004ee-e86c-ae03-31cd-16e8fbfaa1cd-cefcd759" class="w-layout-cell">
        <img src="images/mulher.png" loading="lazy" sizes="(max-width: 568px) 100vw, 568px" srcset="images/mulher-p-500.png 500w, images/mulher.png 568w" alt="" class="image-2">
      </div>
    </div>
  </div>
</section>