export function validateEmail(email) {
    if (email.includes('@') && email.includes('.')) {
        return true;
    } else {
        return false;
    }
}

export function checkPassword(password) {
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

export function evaluation(div){

    const note = parseFloat(div.getAttribute("data-eval"));
    const full = Math.floor(note);
    const half = note % 1 >= 0.5 ? 1 : 0;
    const stars = []

    for (let i = 0; i < 5; i++){
        if (i<full){
            stars.push('<i class="fa-solid fa-star"></i>');
        } else if( i === full && half) {
            stars.push('<i class="fa-solid fa-star-half-stroke"></i>');
        } else {
            stars.push('<i class="fa-regular fa-star"></i>');
        }
    }
    div.innerHTML = stars.join('');   
}