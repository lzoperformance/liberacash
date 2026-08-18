<div class="cepBg"></div>
<div class="show-cep">
  <i class="fas fa-times-circle close-show-cep"></i>

  <form id="checkCep">
    <input id="search_address_type" type="hidden" />
    <div class="campo">
      <label for="uf">Estado</label>
      <select name="uf" id="uf" required>
        <option value=""></option>
        <option value="AC">Acre</option>
        <option value="AL">Alagoas</option>
        <option value="AP">Amapá</option>
        <option value="AM">Amazonas</option>
        <option value="BA">Bahia</option>
        <option value="CE">Ceará</option>
        <option value="DF">Distrito Federal</option>
        <option value="ES">Espírito Santo</option>
        <option value="GO">Goiás</option>
        <option value="MA">Maranhão</option>
        <option value="MT">Mato Grosso</option>
        <option value="MS">Mato Grosso do Sul</option>
        <option value="MG">Minas Gerais</option>
        <option value="PA">Pará</option>
        <option value="PB">Paraíba</option>
        <option value="PR">Paraná</option>
        <option value="PE">Pernambuco</option>
        <option value="PI">Piauí</option>
        <option value="RJ">Rio de Janeiro</option>
        <option value="RN">Rio Grande do Norte</option>
        <option value="RS">Rio Grande do Sul</option>
        <option value="RO">Rondônia</option>
        <option value="RR">Roraima</option>
        <option value="SC">Santa Catarina</option>
        <option value="SP">São Paulo</option>
        <option value="SE">Sergipe</option>
        <option value="TO">Tocantins</option>
      </select>
    </div>

    <div class="campo">
      <label for="cidade">Cidade</label>
      <input type="text" name="cidade" id="cidade" value="" required>
    </div>

    <div class="campo">
      <label for="logradouro">Logradouro</label>
      <input type="text" name="logradouro" id="logradouro" value="" required>
    </div>
    
    <div class="campo">
      <label>&nbsp;</label>
      <a href="javascript:;" class="buscar_cep">Buscar</a>
    </div>
  </form>

  <div style="clear: both;"></div>

  <div id="ceplist"></div>
</div>

<style>
  .cepBg {
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, .8);
    position: fixed;
    z-index: 105;
    display: none;
  }

  .show-cep {
    position: fixed;
    width: 800px;
    height: auto;
    left: 50%;
    top: 50px;
    margin: 0 0 0 -400px;
    background: #EEE;
    padding: 20px;
    box-shadow: rgba(0, 0, 0, .3) 0 0 25px;
    border-radius: 7px;
    z-index: 105;
    display: none;
  }

  .show-cep select,
  .show-cep input {
    width: 100%;
    padding: 10px;
    border: #CCC solid 2px;
    float: left;
    height: 50px;
    border-radius: 5px;
    color: #333;
    font-family: 'Open Sans', sans-serif;
    font-size: 15px;
  }

  .show-cep .campo {
    width: 25%;
    padding: 5px;
    float: left;
    border-style: none;
  }

  .show-cep label {
    font-weight: normal;
    font-family: 'Open Sans', sans-serif;
  }

  .show-cep #ceplist {
    padding: 0;
    overflow: scroll;
    max-height: 600px;
    padding: 10px;
    width: 100%;
    position: relative;
  }

  .show-cep .bloco {
    padding: 10px;
    font-size: 15px;
    font-weight: 300;
    background: #FFF;
    margin-top: 20px;
    float: left;
    width: 100%;
    border-radius: 5px;
    position: relative;
  }

  .show-cep .bloco b {
    padding: 10px;
    font-size: 15px;
    font-weight: 700;
  }

  .show-cep a {
    width: 100%;
    padding: 16px 0 0 0;
    border: none;
    float: left;
    color: #FFF;
    height: 50px;
    background: #00cf75;
    border-radius: 3px;
    font-size: 18px;
    display: block;
    text-align: center;
    text-decoration: none;
  }

  .show-cep .col1 {
    width: 70%;
    padding: 10px;
    float: left;
    position: relative;
    overflow: hidden;
  }

  .show-cep .col3 {
    width: 30%;
    float: left;
    top: 0;
    bottom: 0;
    right: 0;
    position: absolute;
  }

  .show-cep .col3 button {
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    width: 100%;
    display: block;
    color: #FFF;
    background: #00cf75;
    text-align: center;
    text-transform: uppercase;
    position: absolute;
    border-radius: 0 5px 5px 0;
  }

  .close-show-cep {
    position: absolute;
    top: 5px;
    right: 5px;
    font-size: 30px;
    color: #00cf75;
    cursor: pointer;
  }

  @media (max-width: 1440px) {
    .cepBg {
      z-index: 100;
    }

    .show-cep {
      position: fixed;
      width: 600px;
      height: auto;
      left: 45%;
      top: 0;
      bottom: 0;
      margin: 0 0 0 -250px;
      background: #EEE;
      padding: 20px;
      box-shadow: rgba(0, 0, 0, .3) 0 0 25px;
      border-radius: 5px;
      z-index: 100;
      display: none;
      overflow: auto;
    }
  }

  @media (max-width: 1366px) {
    .cepBg {
      z-index: 100;
    }

    .show-cep {
      position: fixed;
      width: 600px;
      height: auto;
      left: 45%;
      top: 40px;
      bottom: 40px;
      margin: 0 0 0 -250px;
      background: #EEE;
      padding: 20px;
      box-shadow: rgba(0, 0, 0, .3) 0 0 25px;
      border-radius: 5px;
      z-index: 100;
      display: none;
      overflow: auto;
    }
  }

  @media(max-width: 479px) {
    .show-cep .bloco {
      font-size: 12px;
    }

    .show-cep .bloco b {
      font-size: 12px;
    }

    .show-cep .col1 {
      padding: 0;
    }

    .cepBg {
      z-index: 9999;
    }

    .show-cep .campo {
      width: 50%;
      padding: 5px;
      float: left;
    }

    .show-cep {
      position: fixed;
      width: auto;
      max-width: 100%;
      height: auto;
      left: 10px;
      right: 10px;
      top: 80px;
      bottom: 80px;
      margin: 0;
      background: #EEE;
      padding: 20px;
      box-shadow: rgba(0, 0, 0, .3) 0 0 25px;
      border-radius: 5px;
      z-index: 9999;
      display: none;
      overflow: auto;
    }
  }
</style>