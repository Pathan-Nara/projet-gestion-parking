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