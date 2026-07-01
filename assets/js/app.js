(function () {
  'use strict'

  const forms = document.querySelectorAll('.needs-validation')

  Array.from(forms).forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    }, false)
  })

  setTimeout(function () {
    var alerts = document.querySelectorAll('.alert-dismissible')
    Array.from(alerts).forEach(function (alert) {
      var bsAlert = new bootstrap.Alert(alert)
      setTimeout(function () { bsAlert.close() }, 5000)
    })
  }, 2000)
})()
