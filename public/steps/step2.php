<section class="section-2 wf-section step_ref step2">
  <div class="w-layout-blockcontainer container-2 w-container">
    <div id="w-node-_4e090d93-b7ba-4a22-e876-2d37e4be4256-cefcd759" class="w-layout-layout wf-layout-layout">
      <div id="w-node-_4e090d93-b7ba-4a22-e876-2d37e4be4257-cefcd759" class="w-layout-cell cell-left">
        <h1 class="heading-copy">Para continuar, <br>precisamos de um <br><span class="text-span-8">cadastro</span> inicial.</h1>
        <p class="paragraph">Fique tranquilo, <strong>suas informações <br>estão seguras</strong> conosco.</p>
        <div class="w-form">
          <form id="lead-data-step2" method="post" class="form">
            <input type="hidden" name="product_id" value="<?= $product_id ?>">
            <input type="hidden" name="form_step" value="2">
            <input type="hidden" name="last_step" value="true">

            <input type="hidden" name="home_country_id" id="home_country_id" value="">
            <input type="hidden" name="home_country_name" id="home_country_name" value="">
            <input type="hidden" name="home_state_id" id="home_state_id" value="">
            <input type="hidden" name="home_state_iso" id="home_state_iso" value="">
            <input type="hidden" name="home_state_name" id="home_state_name" value="">
            <input type="hidden" name="home_city_id" id="home_city_id" value="">
            <input type="hidden" name="home_city_name" id="home_city_name" value="">

            <input type="hidden" name="consents" value="true">
            <input type="hidden" name="politically_exposed_person" value="false">

            <div class="w-row">
              <div class="box-input w-col w-col-12 bigdata-field box_full_name">
                <label for="full_name"></label>
                <input type="text" class="w-input" name="full_name" id="full_name" placeholder="Nome completo" required>
              </div>

              <div class="box-input w-col w-col-12 bigdata-field box_date_of_birth">
                <label for="date_of_birth"></label>
                <input type="tel" class="w-input" name="date_of_birth" id="date_of_birth" data-validator-gt="18" data-validator-lt="70" data-type="birthday" placeholder="Data de nascimento" required>
              </div>

              <div class="box-input w-col w-col-12 bigdata-field box_marital_status_type_id">
                <label for="marital_status_type_id"></label>
                <select id="marital_status_type_id" name="marital_status_type_id" class="w-select" required>
                  <option value="">Estado civil...</option>
                  <option value="283">Solteiro(a)</option>
                  <option value="284">Casado(a)</option>
                  <option value="285">Divorciado(a)</option>
                  <option value="286">Viúvo(a)</option>
                  <option value="938">União estável</option>
                </select>
              </div>

              <div class="box-renda-profissao">
                <div class="box-input w-col w-col-12">
                  <label for="monthly_income"></label>
                  <input type="tel" class="w-input" id="monthly_income" name="monthly_income" placeholder="Valor da renda bruta mensal" required>
                </div>

                <div class="box-input w-col w-col-12 bigdata-field box_job_type">
                  <label for="income_source_type_id"></label>
                  <select id="income_source_type_id" name="income_source_type_id" class="w-select" required>
                    <option value="">Fonte de renda...</option>
                    <option value="291">Aposentado ou Pensionista</option>
                    <option value="287">Assalariado</option>
                    <option value="288">Autônomo</option>
                    <option value="860">Desempregado</option>
                    <option value="292">Empresário</option>
                    <option value="1380">Militar</option>
                    <option value="1381">Prestador de Serviço</option>
                    <option value="290">Profissional Liberal</option>
                    <option value="1410">Servidor Público Estadual</option>
                    <option value="1411">Servidor Público Federal</option>
                    <option value="1412">Servidor Público Municipal</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="w-row">
              <div class="box-input w-col w-col-12">
                <div class="label-busca-cep">
                  <a href="javascript:;" class="link bt_correio" data-address="home">Não sei meu CEP</a>
                </div>

                <label for="home_postalcode"></label>
                <input type="tel" id="home_postalcode" name="home_postalcode" class="campos2 w-input" placeholder="CEP" data-type="cep" required>
              </div>

              <div class="box-input w-col w-col-6">
                <div class="input-left">
                  <label for="home_number" class="field-label"></label>
                  <input type="text" id="home_number" name="home_number" class="w-input campos2" placeholder="Nº">
                </div>
              </div>

              <div class="box-input w-col w-col-6">
                <div class="input-right">
                  <label for="home_complement" class="field-label"></label>
                  <input type="text" id="home_complement" name="home_complement" class="w-input campos2" placeholder="Complemento">
                </div>
              </div>

              <div class="box-input w-col w-col-12 box_home_street">
                <label for="home_street" class="field-label"></label>
                <input type="text" id="home_street" name="home_street" class="w-input campos2" placeholder="Rua">
              </div>

              <div class="box-input w-col w-col-12 box_home_neighborhood">
                <label for="home_neighborhood" class="field-label"></label>
                <input type="text" id="home_neighborhood" name="home_neighborhood" class="w-input campos2" placeholder="Bairro">
              </div>
            </div>

            <div class="w-row">
              <div class="box-infos-cel">
                <p class="paragraph label-cel-garantia">Sobre o celular que você utilizará como garantia</p>

                <div class="box-input w-col w-col-12">
                  <label for="device_brand"></label>
                  <select id="device_brand" name="device_brand" class="w-select campos2" required>
                    <option value="">Marca do aparelho celular...</option>
                    <option value="Samsung">Samsung</option>
                    <option value="Apple">Apple</option>
                    <option value="Motorola">Motorola</option>
                    <option value="Xiaomi">Xiaomi</option>
                    <option value="LG">LG</option>
                    <option value="Lenovo">Lenovo</option>
                    <option value="Huawei">Huawei</option>
                    <option value="Quantum">Quantum</option>
                    <option value="Outros">Outros</option>
                  </select>
                </div>

                <div class="box-input w-col w-col-12 box_nome_marca_cel">
                  <label for="device_brand_name"></label>
                  <input type="text" class="w-input campos2" name="device_brand_name" id="device_brand_name" placeholder="Nome da marca do aparelho celular" required>
                </div>

                <div class="box-input w-col w-col-12">
                  <label for="device_model"></label>
                  <input type="text" class="w-input campos2" name="device_model" id="device_model" placeholder="Modelo do aparelho" required>
                </div>

                <div class="box-input w-col w-col-12">
                  <label for="device_operating_system"></label>
                  <select id="device_operating_system" name="device_operating_system" class="w-select campos2" required>
                    <option value="">Versão do sistema operacional do celular...</option>
                    <option value="13">Versão 13 ou superior</option>
                    <option value="12">Versão 12</option>
                    <option value="11">Versão 11</option>
                    <option value="10">Versão 10</option>
                    <option value="9">Versão 9 ou inferior</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="w-row termos-uso-politica-privacidade">
              <div class="w-col w-col-1 w-col-tiny-1">
                <input type="checkbox" class="w-checkbox checkbox-termos" id="termos_uso_politica_privacidade" name="termos_uso_politica_privacidade" checked required>
              </div>

              <div class="w-col w-col-11 w-col-tiny-11">
                <div class="txt-termos">
                  Concordo com os <a href="docs/termos-uso.pdf" target="_blank" class="link-modal">Termos de Uso</a> e estou ciente que a Juvo irá tratar os meus dados pessoais nos termos da <a href="docs/politica-privacidade.pdf" target="_blank" class="link-modal">Politica de Privacidade</a>. No caso de contratação de empréstimo com garantia de dispositivo móvel, a Juvo poderá utilizar o serviço de geolocalização e bloqueio de uso do dispositivo, nos termos da Política de Privacidade.
                </div>
                <label class="terms-label" for="termos_uso_politica_privacidade"></label>
              </div>
            </div>

            <div class="w-row declaracao-pep">
              <div class="w-col w-col-1 w-col-tiny-1">
                <input type="checkbox" class="w-checkbox checkbox-termos" id="declaracao_pep" name="declaracao_pep" checked required>
              </div>

              <div class="w-col w-col-11 w-col-tiny-11">
                <div class="txt-termos">
                  Declaro não ser uma pessoa politicamente exposta e autorizo a consulta e o compartilhamento com a Juvo de informações do SCR - Banco Central do Brasil e a consulta em bureaus de crédito, incluindo junto ao cadastro positivo.
                </div>
                <label class="terms-label" for="declaracao_pep"></label>
              </div>
            </div>

            <input type="button" value="FINALIZAR" data-wait="Aguarde..." class="submit-button w-button bt-step2">
          </form>
        </div>
      </div>

      <div id="w-node-_4e090d93-b7ba-4a22-e876-2d37e4be4273-cefcd759" class="w-layout-cell">
        <img src="images/mulher.png" loading="lazy" sizes="(max-width: 568px) 100vw, 568px" srcset="images/mulher-p-500.png 500w, images/mulher.png 568w" alt="" class="image-2">
      </div>
    </div>
  </div>
</section>