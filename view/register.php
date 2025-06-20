<link href="_partials/css/register.css" rel="stylesheet">
    <div class="container-fluid">
        <h1>Bienvenue sur Park Ease !</h1>
        <img src="assets/img/iconParkEase.png" alt="Logo">
    </div>
    <div class="container mt-5 p-4">
        <h2 class="text-center">Créer un compte</h2>
        <div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Nom</label>
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Entrez votre nom">
            </div>
            <div class="mb-3">
                <label for="firstName" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Entrez votre prénom">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Adresse e-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre adresse e-mail">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe">
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirmez le mot de passe</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirmez votre mot de passe">
            </div>
            <button href="#" id="register-btn" class="btn btn-primary login-btn w-100">Créer un compte</button>
            <button href="#" id="login-btn" class="btn btn-secondary create-btn w-100 mt-2">Déjà un compte ? Connectez-vous</button>
        </div>
    </div>

<script type="module" import src="_partials/js/register.js"></script>
