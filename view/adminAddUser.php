<link rel="stylesheet" href="_partials/css/adminAddUser.css">
    <div class="container mt-5 p-4">
        <h2 class="text-center">Ajouter un utilisateur</h2>
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
            <div class="mb-3">
                <label for="is_admin" class="form-label">Rôle</label>
                <select class="form-select" id="is_admin" name="is_admin">
                    <option value="0">Utilisateur</option>
                    <option value="1">Administrateur</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="is_premium" class="form-label">Statut Premium</label>
                <select class="form-select" id="is_premium" name="is_premium">
                    <option value="0">Non Premium</option>
                    <option value="1">Premium</option>
                </select>
            </div>
            <button href="#" id="addUserBtn" class="btn btn-primary login-btn w-100">Ajouter l'utilisateur</button>
        </div>
    </div>


<script type="module" src="_partials/js/adminAddUser.js"></script>