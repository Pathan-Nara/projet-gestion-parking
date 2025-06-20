import { validateEmail, checkPassword } from "../utils/function.js";

const register = async (firstName, lastName, password, email) => {
    const formData = new URLSearchParams();
    formData.append("firstName", firstName);
    formData.append("lastName", lastName);
    formData.append("password", password);
    formData.append("email", email);

    const response = await fetch("index.php?component=register", {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
        method: "POST",
        body: formData,
    })
    const data = await response.json();
    return data;
}

document.addEventListener('DOMContentLoaded', ()=> {
        const loginBtn = document.getElementById('login-btn');
        const registerBtn = document.getElementById('register-btn');

        loginBtn.addEventListener('click', () => {
            window.location.href = 'index.php';
        });

        registerBtn.addEventListener('click', async ()=>{
            const firstName = document.getElementById('firstName').value;
            const lastName = document.getElementById('lastName').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const email = document.getElementById('email').value;
            if (firstName === "" || lastName === "" || password === "" || confirmPassword === "" || email === "") {
                return alert("Veuillez remplir tous les champs");
            }
            if (validateEmail(email) === false) {
                alert("Invalid email format");
                return;
            }
            if (!(checkPassword(password) === true)) {
                alert(checkPassword(password));
                return;
            } else{
                if(password !== confirmPassword) {
                    alert("Les mots de passe ne correspondent pas");
                    return;
                }
            }
            const response = await register(firstName, lastName, password, email);
            
            if(response.success == 'Inscription réussie') {
                alert(response.success);
                window.location.href = "index.php?component=login";
            }

        })
    })