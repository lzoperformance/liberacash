<section class="section-2 wf-section step_ref step8">
  <div class="w-layout-blockcontainer container-2 w-container">
    <div id="w-node-_55b004ee-e86c-ae03-31cd-16e8fbfaa1b0-cefcd759" class="w-layout-layout wf-layout-layout">
      <div id="w-node-_55b004ee-e86c-ae03-31cd-16e8fbfaa1b1-cefcd759" class="w-layout-cell cell-left">
        <div class="w-form">
          <form id="lead-data-step8" method="post" class="form">
            <input type="hidden" name="product_id" value="<?= $new_product_id ?>">
            <input type="hidden" name="form_step" value="8">
            <input type="hidden" name="last_step" value="true">

            <input type="hidden" name="work_state_iso" id="work_state_iso" value="">
            <input type="hidden" name="work_state_id" id="work_state_id" value="">
            <input type="hidden" name="work_city_id" id="work_city_id" value="">

            <div class="">
              <div class="box-input">
                <label for="business_same_address"></label>
                <select id="business_same_address" name="business_same_address" class="w-select campos2" required>
                  <option value="">Endereço comercial igual ao residencial?</option>
                  <option value="true">Sim</option>
                  <option value="false">Não</option>
                </select>
              </div>

              <div class="box-input">
                <label for="work_postalcode"></label>
                <input type="tel" id="work_postalcode" name="work_postalcode" class="campos2 w-input" placeholder="CEP" data-type="cep" required>

                <span class="label-busca-cep">
                  <a href="javascript:;" class="link bt_correio" data-address="work">Não sei meu CEP</a>
                </span>
              </div>

              <div class="box-input box-work-street">
                <label for="work_street" class="field-label"></label>
                <input type="text" id="work_street" name="work_street" class="w-input campos2" placeholder="Rua" required>
              </div>

              <div class="box-input">
                <label for="work_number" class="field-label"></label>
                <input type="text" id="work_number" name="work_number" class="w-input campos2" placeholder="Nº">
              </div>

              <div class="box-input">
                <label for="work_complement" class="field-label"></label>
                <input type="text" id="work_complement" name="work_complement" class="w-input campos2" placeholder="Complemento">
              </div>

              <div class="box-input">
                <label for="work_neighborhood" class="field-label"></label>
                <input type="text" id="work_neighborhood" name="work_neighborhood" class="w-input campos2" placeholder="Bairro" required>
              </div>

              <div class="box-input">
                <label for="work_city_name" class="field-label"></label>
                <input type="text" id="work_city_name" name="work_city_name" class="w-input campos2" placeholder="Cidade" required>
              </div>

              <div class="box-input">
                <label for="work_state_name"></label>
                <select class="w-select campos2" name="work_state_name" id="work_state_name" required>
                  <option data-state_iso="" value="">Estado...</option>
                  <option data-state_iso="AC" value="Acre">Acre</option>
                  <option data-state_iso="AL" value="Alagoas">Alagoas</option>
                  <option data-state_iso="AP" value="Amapá">Amapá</option>
                  <option data-state_iso="AM" value="Amazonas">Amazonas</option>
                  <option data-state_iso="BA" value="Bahia">Bahia</option>
                  <option data-state_iso="CE" value="Ceará">Ceará</option>
                  <option data-state_iso="DF" value="Distrito Federal">Distrito Federal</option>
                  <option data-state_iso="ES" value="Espírito Santo">Espírito Santo</option>
                  <option data-state_iso="GO" value="Goiás">Goiás</option>
                  <option data-state_iso="MA" value="Maranhão">Maranhão</option>
                  <option data-state_iso="MT" value="Mato Grosso">Mato Grosso</option>
                  <option data-state_iso="MS" value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                  <option data-state_iso="MG" value="Minas Gerais">Minas Gerais</option>
                  <option data-state_iso="PA" value="Pará">Pará</option>
                  <option data-state_iso="PB" value="Paraíba">Paraíba</option>
                  <option data-state_iso="PR" value="Paraná">Paraná</option>
                  <option data-state_iso="PE" value="Pernambuco">Pernambuco</option>
                  <option data-state_iso="PI" value="Piauí">Piauí</option>
                  <option data-state_iso="RJ" value="Rio de Janeiro">Rio de Janeiro</option>
                  <option data-state_iso="RN" value="Rio Grande do Norte">Rio Grande do Norte</option>
                  <option data-state_iso="RS" value="Rio Grande do Sul">Rio Grande do Sul</option>
                  <option data-state_iso="RO" value="Rondônia">Rondônia</option>
                  <option data-state_iso="RR" value="Roraima">Roraima</option>
                  <option data-state_iso="SC" value="Santa Catarina">Santa Catarina</option>
                  <option data-state_iso="SP" value="São Paulo">São Paulo</option>
                  <option data-state_iso="SE" value="Sergipe">Sergipe</option>
                  <option data-state_iso="TO" value="Tocantins">Tocantins</option>
                </select>
              </div>
            </div>

            <input type="button" value="FINALIZAR" data-wait="Aguarde..." class="submit-button w-button bt-step8">
          </form>
        </div>
      </div>

      <div id="w-node-_55b004ee-e86c-ae03-31cd-16e8fbfaa1cd-cefcd759" class="w-layout-cell">
        <img src="images/mulher.png" loading="lazy" sizes="(max-width: 568px) 100vw, 568px" srcset="images/mulher-p-500.png 500w, images/mulher.png 568w" alt="" class="image-2">
      </div>
    </div>
  </div>
</section>