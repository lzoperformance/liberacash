<section class="section-2 wf-section step_ref step5">
  <div class="w-layout-blockcontainer container-2 w-container">
    <div id="w-node-_55b004ee-e86c-ae03-31cd-16e8fbfaa1b0-cefcd759" class="w-layout-layout wf-layout-layout">
      <div id="w-node-_55b004ee-e86c-ae03-31cd-16e8fbfaa1b1-cefcd759" class="w-layout-cell cell-left">
        <div class="w-form">
          <form id="lead-data-step5" method="post" class="form">
            <input type="hidden" name="product_id" value="<?= $new_product_id ?>">
            <input type="hidden" name="form_step" value="5">

            <input type="hidden" name="secondary_registry_emission_date" id="secondary_registry_emission_date" value="" />

            <div class="">
              <div class="box-input">
                <label for="place_of_birth_state_id"></label>
                <select name="place_of_birth_state_id" id="place_of_birth_state_id" class="w-select campos2" style="width: 100%" required>
                  <option value="" disabled selected>Estado de nascimento...</option>
                  <option value="1">Acre (AC)</option>
                  <option value="2">Alagoas (AL)</option>
                  <option value="3">Amazonas (AM)</option>
                  <option value="4">Amapá (AP)</option>
                  <option value="5">Bahia (BA)</option>
                  <option value="6">Ceara (CE)</option>
                  <option value="7">Distrito Federal (DF)</option>
                  <option value="8">Espírito Santo (ES)</option>
                  <option value="9">Goiás (GO)</option>
                  <option value="10">Maranhão (MA)</option>
                  <option value="11">Minas Gerais (MG)</option>
                  <option value="12">Mato Grosso do Sul (MS)</option>
                  <option value="13">Mato Grosso (MT)</option>
                  <option value="14">Pará (PA)</option>
                  <option value="15">Paraíba (PB)</option>
                  <option value="16">Pernambuco (PE)</option>
                  <option value="17">Piauí (PI)</option>
                  <option value="18">Paraná (PR)</option>
                  <option value="19">Rio de Janeiro(RJ)</option>
                  <option value="20">Rio Grande do Norte(RN)</option>
                  <option value="21">Rondônia (RO)</option>
                  <option value="22">Roraima (RR)</option>
                  <option value="23">Rio Grande do Sul (RS)</option>
                  <option value="24">Santa Catarina (SC)</option>
                  <option value="25">Sergipe (SE)</option>
                  <option value="26">São Paulo (SP)</option>
                  <option value="27">Tocantins (TO)</option>
                </select>
              </div>

              <div class="box-input">
                <label for="place_of_birth_city_id"></label>
                <select id="place_of_birth_city_id" name="place_of_birth_city_id" class="w-select campos2" style="width:100%" required>
                  <option value="">Cidade de nascimento...</option>
                </select>
              </div>

              <div class="box-input">
                <label for="secondary_registry_organization_type_id"></label>
                <select id="secondary_registry_organization_type_id" name="secondary_registry_organization_type_id" class="w-select campos2" required>
                  <option value="">Emissor do documento...</option>
                  <option value="272">SSP - Secretaria da Segurança Pública (RG)</option>
                  <option value="273">IIFP - Instituto de Identificação Félix Pacheco (RG)</option>
                  <option value="274">DETRAN (CNH)</option>
                  <option value="275">Documento Militar ou da Polícia Federal (Passaporte)</option>
                  <option value="277">RNE - Registro Nacional Estrangeiro (RG)</option>
                </select>
              </div>

              <div class="box-input">
                <label for="secondary_registry_type_id"></label>
                <select id="secondary_registry_type_id" name="secondary_registry_type_id" class="w-select campos2" required>
                  <option value="">Documento de identificação...</option>
                  <option value="1490">RG</option>
                  <option value="1492">CNH</option>
                  <option value="1493">Passaporte</option>
                </select>
              </div>

              <div class="box-input">
                <label for="secondary_registry_number"></label>
                <input type="tel" id="secondary_registry_number" name="secondary_registry_number" class="w-input campos2" placeholder="N° do documento" required>
              </div>

              <div class="box-input">
                <label for="secondary_registry_emission_state_id" class="field-label"></label>
                <select name="secondary_registry_emission_state_id" id="secondary_registry_emission_state_id" class="w-select campos2" style="width:100%" required>
                  <option value="" disabled selected>UF do documento...</option>
                  <option value="1">Acre (AC)</option>
                  <option value="2">Alagoas (AL)</option>
                  <option value="3">Amazonas (AM)</option>
                  <option value="4">Amapá (AP)</option>
                  <option value="5">Bahia (BA)</option>
                  <option value="6">Ceará (CE)</option>
                  <option value="7">Distrito Federal (DF)</option>
                  <option value="8">Espírito Santo (ES)</option>
                  <option value="9">Goiás (GO)</option>
                  <option value="10">Maranhão (MA)</option>
                  <option value="11">Minas Gerais (MG)</option>
                  <option value="12">Mato Grosso do Sul (MS)</option>
                  <option value="13">Mato Grosso (MT)</option>
                  <option value="14">Pará (PA)</option>
                  <option value="15">Paraíba (PB)</option>
                  <option value="16">Pernambuco (PE)</option>
                  <option value="17">Piauí (PI)</option>
                  <option value="18">Paraná (PR)</option>
                  <option value="19">Rio de Janeiro (RJ)</option>
                  <option value="20">Rio Grande do Norte (RN)</option>
                  <option value="21">Rondônia (RO)</option>
                  <option value="22">Roraima (RR)</option>
                  <option value="23">Rio Grande do Sul (RS)</option>
                  <option value="24">Santa Catarina (SC)</option>
                  <option value="25">Sergipe (SE)</option>
                  <option value="26">São Paulo (SP)</option>
                  <option value="27">Tocantins (TO)</option>
                </select>
              </div>

              <div class="box-input">
                <label for="date_secondary_registry"></label>
                <input type="tel" class="w-input campos2" placeholder="Data de expedição" id="date_secondary_registry" name="date_secondary_registry" data-type="birthday" required>
              </div>

              <div class="box-input">
                <label for="education_level_type_id"></label>
                <select id="education_level_type_id" name="education_level_type_id" class="w-select campos2" required>
                  <option value="">Escolaridade...</option>
                  <option value="279">1º Grau Completo</option>
                  <option value="280">2º Grau Completo</option>
                  <option value="282">Superior Completo</option>
                </select>
              </div>
            </div>

            <input type="button" value="CONTINUAR" data-wait="Aguarde..." class="submit-button w-button bt-step5">
          </form>
        </div>
      </div>

      <div id="w-node-_55b004ee-e86c-ae03-31cd-16e8fbfaa1cd-cefcd759" class="w-layout-cell">
        <img src="images/mulher.png" loading="lazy" sizes="(max-width: 568px) 100vw, 568px" srcset="images/mulher-p-500.png 500w, images/mulher.png 568w" alt="" class="image-2">
      </div>
    </div>
  </div>
</section>