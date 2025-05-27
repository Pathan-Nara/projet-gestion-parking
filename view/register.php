<link href="_partials/css/register.css" rel="stylesheet"></link>
<body class="container-fluid" style="background-color:rgb(38, 97, 145); margin: 0; padding: 0;">
    <div class="container-fluid" style="background-color: #0078d7; padding: 5px; display: flex; flex-direction: row; justify-content: space-between; align-items: center; width: 100%">
        <h1 style="color: white; margin-left: 15px;">Bienvenue sur Park Ease !</h1>
        <img src="assets/img/iconParkEase.png" alt="Logo" style="width: 150px; height: 150px; border-radius: 100px; margin-right: 15px;">
    </div>
    <div class="container mt-5 p-4" style="background-color: #0078d7; border-radius: 10px; max-width: 500px; height: 600px; margin-top: 10px!important">
        <h2 class="text-center" style="color: white;">Créer un compte</h2>
        <div>
            <div class="mb-3">
                <label for="lastName" class="form-label" style="color: white;">Nom</label>
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Entrez votre nom">
            </div>
            <div class="mb-3">
                <label for="firstName" class="form-label" style="color: white;">Prénom</label>
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Entrez votre prénom">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label" style="color: white;">Adresse e-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre adresse e-mail">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label" style="color: white;">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe">
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label" style="color: white;">Confirmez le mot de passe</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirmez votre mot de passe">
            </div>
            <button href="#" id="register-btn" class="btn btn-primary login-btn w-100" style="border: none;">Créer un compte</button>
            <button href="#" id="login-btn" class="btn btn-secondary create-btn w-100 mt-2" style="border: none;">Déjà un compte ? Connectez-vous</button>
        </div>
    </div>

</body>

<script import src="_partials/js/register.js"></script>

