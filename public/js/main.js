const manufacturer_list = [
  "Samsung",
  "LG",
  "Xiaomi",
  "Motorola",
  "Lenovo",
  "Quantum",
  "Apple",
  "Huawei",
];

const address_field = [
  "postalcode",
  "state_iso",
  "state_id",
  "state_name",
  "city_id",
  "city_name",
  "neighborhood",
  "street",
  "number",
  "complement",
];

/* UTIL */
function showError() {
  $(".page-spinner").hide("fade", 300);
  $(".txt-loader").hide("fade", 300);

  alert("Erro ao processar seus dados, atualize a página e tente novamente");
}

function showFormError() {
  $(".page-spinner").hide("fade", 300);
  $(".txt-loader").hide("fade", 300);

  // alert("Formulário inválido, verifique os campos e tente novamente");
}

function executeAutofill(autofill) {
  autofill.forEach(function (item) {
    $(".box_" + item).hide();
    $("#" + item).attr("disabled", true);
  });
}

function showTxtLoader(msg) {
  if (msg == "juvo") {
    $(".txt-loader").html(
      "Aguarde um instante, estamos te direcionando para a melhor oferta no seu perfil"
    );
  } else {
    $(".txt-loader").html(
      "Estamos validando seus dados, por favor aguarde, esse processo pode levar alguns segundos"
    );
  }

  $(".txt-loader").fadeIn();
}

/* DEVICE */

function handleDevice() {
  if (!wForm.device.model) {
    return;
  }

  setDeviceManufacturer(wForm.device.manufacturer);
  setDeviceModel(wForm.device.model);
  setDeviceOsVersion(wForm.device.os.version);
  // hideLabelDevice(manufacturer, product, family, version);

  // $("#box_nome_marca_cel").fadeOut();

  if (
    $("#device_brand").val() &&
    $("#device_model").val() &&
    $("#device_operating_system").val()
  ) {
    $(".box-infos-cel").hide();
  }
}

function setDeviceManufacturer(manufacturer) {
  if (manufacturer == null) {
    return;
  }

  if (manufacturer_list.includes(manufacturer)) {
    $("#device_brand").hide();
    $("#device_brand").val(manufacturer);
  } else {
    $("#device_brand").val("Outros");
  }

  $("#device_brand").change();
  // $("#device_brand_name").val(manufacturer);
}

function setDeviceModel(model) {
  if (model == null) {
    return;
  }

  $("#device_model").hide();
  $("#device_model").val(model);
}

function setDeviceOsVersion(version) {
  if (version == null) {
    return;
  }

  let os_version = parseInt(version.split(".")[0]);

  $("#device_operating_system").hide();

  if (os_version <= 9) {
    $("#device_operating_system").val(9);
  } else if (os_version >= 13) {
    $("#device_operating_system").val(13);
  } else {
    $("#device_operating_system").val(os_version);
  }

  $("#device_operating_system").change();
}

function hideLabelDevice(manufacturer, product, family, version) {
  if (
    manufacturer != null &&
    product != null &&
    family != null &&
    version != null
  ) {
    $(".label-cel-garantia").hide();
  }
}

function fillPlaceOfBirthSelect(cities) {
  $("#place_of_birth_city_id").select2("destroy");

  $("#place_of_birth_city_id").html(
    `<option value="">Cidade de nascimento...</option>`
  );

  $.each(cities, function (i, c) {
    $("#place_of_birth_city_id").append(
      `<option value="${c.id}">${c.name}</option>`
    );
  });

  $("#place_of_birth_city_id").select2({
    containerCssClass: "w-select campos2",
  });
}

/* BUSINESS ADDRESS */

function clearBusinessAddress() {
  address_field.forEach(function (field) {
    $(`#work_${field}`).val("");
  });
}

function getBusinessSameAddress() {
  address_field.forEach(function (field) {
    $(`#work_${field}`).val($(`#home_${field}`).val());
  });
}

function wFormReadyCallback() {
  handleDevice();

  $("#bad_credit").change(function () {
    if ($(this).val() == "sim") {
      $(".debt_value").show();
    } else {
      $(".debt_value").hide();
    }
  });

  $("#monthly_income, #debt_value").maskMoney({
    prefix: "R$ ",
    thousands: ".",
    decimal: ",",
    affixesStay: true,
  });

  $("#device_brand").change(function () {
    let marca_cel = $(this).val();

    $(".txt_cel").hide();

    switch (marca_cel) {
      case "Apple":
        $(".txt_cel_apple").show("block");
        break;

      case "Huawei":
        $(".txt_cel_huawei").show("block");
        break;

      case "Outros":
        $(".box_nome_marca_cel").fadeIn();
        break;

      default:
        $(".box_nome_marca_cel").hide();
        $(".txt_cel").hide();
        break;
    }

    if (marca_cel != "Outros") {
      $("#device_brand_name").val(marca_cel);
    }
  });

  $("body").on("keyup blur", "#date_secondary_registry", function () {
    let date = $("#date_secondary_registry").val();

    if (date.length > 9) {
      let n = date.split("/");

      $("#secondary_registry_emission_date").val(
        n[2] + "-" + n[1] + "-" + n[0]
      );
    }
  });

  $("#place_of_birth_state_id").change(function () {
    let stateCode = $(this).val();

    if (stateCode == "") {
      $("#place_of_birth_city_id").html(
        '<option value="">Selecione...</option>'
      );
      $("#place_of_birth_city_id").val("");

      return;
    }

    getCities(stateCode)
      .then((response) => {
        fillPlaceOfBirthSelect(response);
      })
      .catch(() => {
        //
      });
  });

  $("#income_source_type_id").change(function () {
    let fonte = $(this).val();

    if (fonte == 291) {
      $(".aposentado_funcionario").show("fade", 300);
      $(".beneficios").show("fade", 300);
    } else if (fonte == 289) {
      $(".aposentado_funcionario").show("fade", 300);
      $(".beneficios").hide("fade", 300);
    } else {
      $(".aposentado_funcionario").hide("fade", 300);
      $(".beneficios").hide("fade", 300);
    }
  });

  $("#business_same_address").change(function () {
    let mesmo_endereco = $(this).val();

    if (mesmo_endereco == "true") {
      getBusinessSameAddress();
    } else {
      clearBusinessAddress();

      $("#work_postalcode").focus();
    }
  });

  $("#has_credit_card").change(function () {
    let possui_cartao = $(this).val();

    if (possui_cartao == "true") {
      $(".possui_cartao").show("fade", 300);
    } else {
      $(".possui_cartao").hide("fade", 300);
    }
  });

  $("#has_own_house").change(function () {
    let possui_casa = $(this).val();

    $("#residence_type_id").val("");

    if (possui_casa == "true") {
      $('#residence_type_id option[value="299"]').attr("disabled", true);
      $('#residence_type_id option[value="300"]').attr("disabled", true);

      $('#residence_type_id option[value="843"]').removeAttr("disabled");
      $('#residence_type_id option[value="298"]').removeAttr("disabled");
    } else {
      $('#residence_type_id option[value="843"]').attr("disabled", true);
      $('#residence_type_id option[value="298"]').attr("disabled", true);

      $('#residence_type_id option[value="299"]').removeAttr("disabled");
      $('#residence_type_id option[value="300"]').removeAttr("disabled");
    }
  });

  $("#secondary_registry_organization_type_id").change(function () {
    let emissor = $(this).val();
    let doc = $("#secondary_registry_type_id");

    $('#secondary_registry_type_id option[value="1490"]').removeAttr(
      "disabled"
    );
    $('#secondary_registry_type_id option[value="1492"]').removeAttr(
      "disabled"
    );
    $('#secondary_registry_type_id option[value="1493"]').removeAttr(
      "disabled"
    );
    $('#secondary_registry_type_id option[value="1494"]').removeAttr(
      "disabled"
    );

    $("#secondary_registry_number").val("");

    switch (emissor) {
      case "272":
      case "273":
      case "277":
        doc.val("1490");

        $("#secondary_registry_number").unmask();

        $('#secondary_registry_type_id option[value="1492"]').attr(
          "disabled",
          true
        );
        $('#secondary_registry_type_id option[value="1493"]').attr(
          "disabled",
          true
        );
        $('#secondary_registry_type_id option[value="1494"]').attr(
          "disabled",
          true
        );
        break;

      case "274":
        doc.val("1492");

        $("#secondary_registry_number").mask("00000000000");

        $('#secondary_registry_type_id option[value="1490"]').attr(
          "disabled",
          true
        );
        $('#secondary_registry_type_id option[value="1493"]').attr(
          "disabled",
          true
        );
        $('#secondary_registry_type_id option[value="1494"]').attr(
          "disabled",
          true
        );
        break;

      case "275":
        doc.val("1493");

        $("#secondary_registry_number").mask("SS000000");

        $('#secondary_registry_type_id option[value="1490"]').attr(
          "disabled",
          true
        );
        $('#secondary_registry_type_id option[value="1492"]').attr(
          "disabled",
          true
        );
        $('#secondary_registry_type_id option[value="1494"]').attr(
          "disabled",
          true
        );
        break;

      case "276":
        doc.val("1494");

        $('#secondary_registry_type_id option[value="1490"]').attr(
          "disabled",
          true
        );
        $('#secondary_registry_type_id option[value="1492"]').attr(
          "disabled",
          true
        );
        $('#secondary_registry_type_id option[value="1493"]').attr(
          "disabled",
          true
        );
        break;

      default:
        doc.val("");

        $("#secondary_registry_number").unmask();
        break;
    }
  });

  /* SELECT2 */

  $("#place_of_birth_city_id").select2({
    containerCssClass: "w-select campos2",
    language: "pt-BR",
  });
  $("#job_title").select2({
    containerCssClass: "w-select campos2",
    language: "pt-BR",
  });

  /* STEP BUTTON */

  $(".bt-step1").click(function () {
    executeStep1();
  });

  $(".bt-step2").click(function () {
    executeStep2();
  });

  $(".bt-step3").click(function () {
    goToStep(4);
  });

  $(".bt-step4").click(function () {
    executeStep4();
  });

  $(".bt-step5").click(function () {
    executeStep5();
  });

  $(".bt-step6").click(function () {
    executeStep6();
  });

  $(".bt-step7").click(function () {
    executeStep7();
  });

  $(".bt-step8").click(function () {
    executeStep8();
  });
}
