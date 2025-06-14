function showPaymentFields() {
      var selectedPaymentMethod = document.getElementById("payment-method").value;
      var specificForms = document.querySelectorAll(".specific-form");

      specificForms.forEach(function(form) {
        form.classList.remove("active");
      });

      var activeForm = document.getElementById(selectedPaymentMethod + "-form");
      if (activeForm) {
        activeForm.classList.add("active");
      }
    }