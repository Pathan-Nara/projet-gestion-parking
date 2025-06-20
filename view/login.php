<link href="_partials/css/login.css" rel="stylesheet">

    <div class="container-fluid" id="barreHaut">
        <h1>Bienvenue sur Park Ease !</h1>
        <img src="assets/img/iconParkEase.png" alt="Logo">
    </div>
    <form id="login-form">
        <div class="container-fluid" id="containerPrincipal">
            <div class="container" id="containerLogin">
                <h1>Veuillez vous connecter</h1>
                <div class="mb-3">
                    <label for="username" class="form-label">Email</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div> 
                    <button type="button" href="#" id="register-btn" class="btn btn-secondary create-btn">Creer un compte</button>
                    <button type="submit" href="#" class="btn btn-primary login-btn" id="login-btn">Login</button>
                </div>    
            </div>
        </div>
    </form>

<script src="_partials/js/login.js"></script>
