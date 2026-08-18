function executeStep1() {
  wForm
    .validate("lead-data")
    .then(() => {
      showSpinner();

      wForm
        .create(wForm.getFormPayload("lead-data", this.device))
        .then((response) => {
          executeAutofill(response.autofill);
          goToStep(2);
        })
        .catch(() => {
          showError();
        });
    })
    .catch(() => {
      showFormError();
    });
}

function executeStep2() {
  wForm
    .validate("lead-data-step2")
    .then(() => {
      showSpinner();
      showTxtLoader('validate');

      wForm
        .update(wForm.getFormPayload("lead-data-step2"))
        .then((response) => {
          const customerRedirectUrl = response.customer_redirect_url || null;

          if (!customerRedirectUrl) {
            goToStep(3);

            return;
          }
          
          showTxtLoader('juvo');

          setTimeout(() => {
            location.href = customerRedirectUrl.includes("http")
              ? customerRedirectUrl
              : atob(customerRedirectUrl);
          }, 3000);
        })
        .catch(() => {
          showError();
        });
    })
    .catch(() => {
      showFormError();
    });
}

function executeStep4() {
  wForm
    .validate("lead-data-step4")
    .then(() => {
      showSpinner();

      wForm
        .update(wForm.getFormPayload("lead-data-step4"))
        .then(() => {
          goToStep(5);
        })
        .catch(() => {
          showError();
        });
    })
    .catch(() => {
      showFormError();
    });
}

function executeStep5() {
  wForm
    .validate("lead-data-step5")
    .then(() => {
      showSpinner();

      wForm
        .update(wForm.getFormPayload("lead-data-step5"))
        .then(() => {
          goToStep(6);
        })
        .catch(() => {
          showError();
        });
    })
    .catch(() => {
      showFormError();
    });
}

function executeStep6() {
  wForm
    .validate("lead-data-step6")
    .then(() => {
      showSpinner();

      wForm
        .update(wForm.getFormPayload("lead-data-step6"))
        .then(() => {
          goToStep(7);
        })
        .catch(() => {
          showError();
        });
    })
    .catch(() => {
      showFormError();
    });
}

function executeStep7() {
  wForm
    .validate("lead-data-step7")
    .then(() => {
      showSpinner();

      wForm
        .update(wForm.getFormPayload("lead-data-step7"))
        .then(() => {
          goToStep(8);
        })
        .catch(() => {
          showError();
        });
    })
    .catch(() => {
      showFormError();
    });
}

function executeStep8() {
  wForm
    .validate("lead-data-step8")
    .then(() => {
      showSpinner();
      showTxtLoader("validate");

      wForm
        .update(wForm.getFormPayload("lead-data-step8"))
        .then((response) => {
          let customerRedirectUrl = response.customer_redirect_url || null;

          if (!customerRedirectUrl) {
            location.href = "/sucesso.php";

            return;
          }

          customerRedirectUrl = customerRedirectUrl.includes("http")
            ? customerRedirectUrl
            : atob(customerRedirectUrl);

          setTimeout(() => checkOffers(customerRedirectUrl, 0), 10000);
        })
        .catch(() => {
          showError();
        });
    })
    .catch(() => {
      showFormError();
    });
}

function checkOffers(customerRedirectUrl, count) {

  count = count || 0;

  count++;

  if (count > 3) {
    location.href = "/sucesso.php";

    return;
  }

  wForm
    .hasOffers()
    .then((offerFound) => {
      if (offerFound) {
        location.href = customerRedirectUrl;
      } else if(count === 3) {
        location.href = "/sucesso.php";
      } else {
        setTimeout(() => checkOffers(customerRedirectUrl, count), 10000);
      }
    });
}

