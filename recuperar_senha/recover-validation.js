document.addEventListener("DOMContentLoaded", function () {
    const recoverForm = document.getElementById("recoverForm");
    const emailInput = document.getElementById("email");
    const errorMessages = document.getElementById("errorMessages");

    function showError(message) {
        errorMessages.innerHTML = `<p>${message}</p>`;
        errorMessages.style.display = "block";
    }

    function clearErrors() {
        errorMessages.innerHTML = "";
        errorMessages.style.display = "none";
    }

    function validateEmail(email) {
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return emailPattern.test(email);
    }

    recoverForm.addEventListener("submit", function (event) {
        clearErrors();

        const emailValue = emailInput.value.trim();

        if (!validateEmail(emailValue)) {
            event.preventDefault();
            showError("Por favor, insira um endereço de e-mail válido.");
            return;
        }
    });
});

document.getElementById("recoverForm").addEventListener("submit", function(event) {
    event.preventDefault();
    const formData = new FormData(this);

    fetch("recover.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.message);
        console.log("Link de redefinição: ", data.link);
    })
    .catch(error => console.error("Erro:", error));
});

