function validateEmail(email) {
    if (email.includes('@') && email.includes('.')) {
        return true;
    } else {
        return false;
    }
}

function checkPassword(password) {
    if (password.length < 8) {
        return "Le mot de passe doit contenir au moins 8 caractères";
    }
    if (!/[A-Z]/.test(password)) {
        return "Le mot de passe doit contenir au moins une lettre majuscule";
    }
    if (!/[a-z]/.test(password)) {
        return "Le mot de passe doit contenir au moins une lettre minuscule";
    }
    if (!/[0-9]/.test(password)) {
        return "Le mot de passe doit contenir au moins un chiffre";
    }
    if (!/[!@#$%^&*]/.test(password)) {
        return "Le mot de passe doit contenir au moins un caractère spécial";
    }
    return true;
}

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
    data = await response.json();
    alert(data['success'] || data['error'] || "An error occurred");
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
                return;
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