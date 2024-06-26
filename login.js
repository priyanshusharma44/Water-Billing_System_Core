document.addEventListener("DOMContentLoaded", function () {
  const container = document.getElementById("container");
  const registerBtn = document.getElementById("register");
  const loginBtn = document.getElementById("login");

  registerBtn.addEventListener("click", () => {
    container.classList.add("active");
  });

  loginBtn.addEventListener("click", () => {
    container.classList.remove("active");
  });

  document
    .getElementById("signin-form")
    .addEventListener("submit", function (event) {
      event.preventDefault();

      // Clear previous errors
      clearErrors();

      // Get form values
      var email = document.getElementById("signin-email").value.trim();
      var password = document.getElementById("signin-password").value.trim();

      console.log("Email:", email);
      console.log("Password:", password);

      var hasError = false;

      // Validate form fields
      if (!email || !validateEmail(email)) {
        showError("signin-email", "Valid email is required");
        hasError = true;
      }
      if (!password) {
        showError("signin-password", "Password is required");
        hasError = true;
      }

      if (!hasError) {
        // Perform AJAX request to validate login
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "connection/session.php", true);
        xhr.setRequestHeader(
          "Content-Type",
          "application/x-www-form-urlencoded"
        );
        xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
            console.log("Response:", xhr.responseText);
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              window.location.href = response.redirect; // Redirect to the  page like admin user or reader
            } else {
              showError("signin", response.message);
            }
          }
        };
        xhr.send(
          "email=" +
            encodeURIComponent(email) +
            "&password=" +
            encodeURIComponent(password)
        );
      }
    });

  function validateEmail(email) {
    var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return re.test(email);
  }

  function showError(fieldId, message) {
    var errorSpan = document.getElementById(fieldId + "-error");
    if (errorSpan) {
      errorSpan.textContent = message;
      errorSpan.style.color = "red";
      console.log("Error displayed for:", fieldId);
    } else {
      console.log("Error span not found for:", fieldId + "-error");
    }
  }

  function clearErrors() {
    var errorSpans = document.querySelectorAll(".error");
    errorSpans.forEach(function (span) {
      span.textContent = "";
    });
  }
});
