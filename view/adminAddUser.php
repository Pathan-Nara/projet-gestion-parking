<body class="container-fluid" style="background-color:rgb(38, 97, 145); width:100%; margin:0; padding:0; display: flex; justify-content: center; flex-direction:column;" >
<div class="container mt-5 p-4" style="background-color: #0078d7; border-radius: 10px; max-width: 500px; height: auto; margin-top: 10px!important">
        <h2 class="text-center" style="color: white;">Ajouter un utilisateur</h2>
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
            <div class="mb-3">
                <label for="is_admin" class="form-label" style="color: white;">Rôle</label>
                <select class="form-select" id="is_admin" name="is_admin">
                    <option value="0">Utilisateur</option>
                    <option value="1">Administrateur</option>
                </select>
            <div class="mb-3">
                <label for="is_premium" class="form-label" style="color: white;">Statut Premium</label>
                <select class="form-select" id="is_premium" name="is_premium">
                    <option value="0">Non Premium</option>
                    <option value="1">Premium</option>
                </select>
            </div>
            <button href="#" id="addUserBtn" class="btn btn-primary login-btn w-100" style="border: none; margin-top: 30px;">Ajouter l'utilisateur</button>
        </div>
    </div>
</body>

<script type="module" src="_partials/js/adminAddUser.js"></script>