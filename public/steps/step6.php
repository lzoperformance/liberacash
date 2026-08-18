<section class="section-2 wf-section step_ref step6">
  <div class="w-layout-blockcontainer container-2 w-container">
    <div id="w-node-_55b004ee-e86c-ae03-31cd-16e8fbfaa1b0-cefcd759" class="w-layout-layout wf-layout-layout">
      <div id="w-node-_55b004ee-e86c-ae03-31cd-16e8fbfaa1b1-cefcd759" class="w-layout-cell cell-left">
        <div class="w-form">
          <form id="lead-data-step6" method="post" class="form">
            <input type="hidden" name="product_id" value="<?= $new_product_id ?>">
            <input type="hidden" name="form_step" value="6">

            <div class="">
              <div class="box-input">
                <label for="bank_id"></label>
                <select id="bank_id" name="bank_id" class="campos2 w-select" required>
                  <option value="">Banco...</option>
                  <option value="2">Banco do Brasil S.A.</option>
                  <option value="37">Caixa Econômica Federal</option>
                  <option value="74">Itaú Unibanco S.A.</option>
                  <option value="14">Banco Santander (Brasil) S.A.</option>
                  <option value="59">Banco Bradesco S.A.</option>
                </select>
              </div>

              <div class="box-input">
                <label for="bank_account_type_id"></label>
                <select id="bank_account_type_id" name="bank_account_type_id" class="campos2 w-select" required>
                  <option value="">Tipo de conta...</option>
                  <option value="301">Conta Corrente Individual</option>
                  <option value="302">Conta Poupança Individual</option>
                  <option value="303">Conta Corrente Conjunta</option>
                  <option value="304">Conta Poupança Conjunta</option>
                </select>
              </div>

              <div class="box-input">
                <label for="bank_branch_number"></label>
                <input type="tel" id="bank_branch_number" name="bank_branch_number" class="campos2 w-input" placeholder="Número da agência (sem dígito)" required>
              </div>

              <div class="box-input">
                <label for="bank_account_number"></label>
                <input type="tel" id="bank_account_number" name="bank_account_number" class="campos2 w-input" placeholder="Número da conta" required>
              </div>

              <div class="box-input" style="margin-bottom: 20px;">
                <label id="bank_validation_label" for="bank_validation"></label>
                <input type="checkbox" id="bank_validation" name="bank_validation" title="Número da Agência ou Conta inválidos" required>
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
            </div>

            <input type="button" value="CONTINUAR" data-wait="Aguarde..." class="submit-button w-button bt-step6">
          </form>
        </div>
      </div>

      <div id="w-node-_55b004ee-e86c-ae03-31cd-16e8fbfaa1cd-cefcd759" class="w-layout-cell">
        <img src="images/mulher.png" loading="lazy" sizes="(max-width: 568px) 100vw, 568px" srcset="images/mulher-p-500.png 500w, images/mulher.png 568w" alt="" class="image-2">
      </div>
    </div>
  </div>
</section>