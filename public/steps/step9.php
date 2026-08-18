<section class="section-2 wf-section step_ref step9">
  <div class="w-layout-blockcontainer container-2 w-container">
    <div id="w-node-_55b004ee-e86c-ae03-31cd-16e8fbfaa1b0-cefcd759" class="w-layout-layout wf-layout-layout">
      <div id="w-node-_55b004ee-e86c-ae03-31cd-16e8fbfaa1b1-cefcd759" class="w-layout-cell cell-left">
        <div class="w-form">
          <form id="lead-data-step9" method="post" class="form">
            <input type="hidden" name="product_id" value="<?= $new_product_id ?>">
            <input type="hidden" name="form_step" value="9">
            <input type="hidden" name="last_step" value="true">

            <div class="">
              <div class="box-input">
                <label for="has_restriction"></label>
                <select id="has_restriction" name="has_restriction" class="w-select campos2" required>
                  <option value="">Possui restrições no nome?</option>
                  <option value="true">Sim</option>
                  <option value="false">Não</option>
                </select>
              </div>

              <div class="box-input">
                <label for="has_credit_card"></label>
                <select id="has_credit_card" name="has_credit_card" class="w-select campos2" required>
                  <option value="">Possui cartão de crédito?</option>
                  <option value="true">Sim</option>
                  <option value="false">Não</option>
                </select>
              </div>

              <div class="box-input possui_cartao">
                <label for="additional_card_primary_registry"></label>
                <input type="tel" class="campos2 w-input" name="additional_card_primary_registry" id="additional_card_primary_registry" placeholder="CPF do cartão adicional" data-type="cpf">
              </div>

              <div class="box-input box-termos-easy">
                <div class="w-col w-col-1 w-col-tiny-1">
                  <input id="termos" name="termos" type="checkbox" checked required>
                </div>

                <div class="w-col w-col-11 w-col-tiny-11">
                  <div class="txt-termos-easy">
                    Aceito os <a href="https://easycredito.net.br/termos-de-uso" target="_blank">Termos de Uso</a>,
                    a <a href="https://easycredito.net.br/politica-de-privacidade" target="_blank">Política de Privacidade</a>
                    e o <a href="https://easycredito.net.br/scr" target="_blank">Termo de Autorização de Consulta</a>
                  </div>

                  <label for="termos" class="field-label termos-easy"></label>
                </div>
              </div>
            </div>

            <input type="button" value="FINALIZAR" data-wait="Aguarde..." class="submit-button w-button bt-step9">
          </form>
        </div>
      </div>

      <div id="w-node-_55b004ee-e86c-ae03-31cd-16e8fbfaa1cd-cefcd759" class="w-layout-cell">
        <img src="images/mulher.png" loading="lazy" sizes="(max-width: 568px) 100vw, 568px" srcset="images/mulher-p-500.png 500w, images/mulher.png 568w" alt="" class="image-2">
      </div>
    </div>
  </div>
</section>