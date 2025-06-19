import { validateEmail, checkPassword } from "../utils/function.js";

function addUser(firstName, lastName, password, email, isAdmin, isPremium) {
    const formData = new URLSearchParams();
    formData.append("firstName", firstName);
    formData.append("lastName", lastName);
    formData.append("password", password);
    formData.append("email", email);
    formData.append("is_admin", isAdmin);
    formData.append("is_premium", isPremium);

    return fetch("index.php?component=adminAddUser", {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
        method: "POST",
        body: formData,
    })
}

document.addEventListener('DOMContentLoaded', () => {
    const addBtn = document.getElementById("addUserBtn");

    addBtn.addEventListener("click", async (e) => {
        e.preventDefault();
        const firstName = document.getElementById("firstName").value;
        const lastName = document.getElementById("lastName").value;
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirmPassword").value;
        const email = document.getElementById("email").value;
        const isAdmin = document.getElementById("is_admin").value;
        const isPremium = document.getElementById("is_premium").value;
        console.log(isAdmin, isPremium);
        if (firstName === "" || lastName === "" || password === "" || confirmPassword === "" || email === "") {
            return alert("Veuillez remplir tous les champs");
        }
        if (validateEmail(email) === false) {
            alert("Format d'email invalide");
            return;
        }
        if (!(checkPassword(password) === true)) {
            alert(checkPassword(password));
            return;
        }
        if (password !== confirmPassword) {
            alert("Les mots de passe ne correspondent pas");
            return;
        }

        const response = await addUser(firstName, lastName, password, email, isAdmin, isPremium);
        const data = await response.json();
        if (data.success) {
            alert(data.success);
            window.location.href = "index.php?component=adminUser";
        } else {
            alert(data.error || "Une erreur s'est produite lors de l'ajout de l'utilisateur.");
        }
        
    })
})