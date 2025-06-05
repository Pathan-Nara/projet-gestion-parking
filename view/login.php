
<link href="_partials/css/login.css"   rel="stylesheet"></link>

<body class="container-fluid" style="background-color:rgb(38, 97, 145); margin: 0; padding: 0;">
    <div class="container-fluid" id="barreHaut" style="">
        <h1 style="">Bienvenue sur Park Ease !</h1>
        <img src="assets/img/iconParkEase.png" alt="Logo" style="">
    </div>
    <form id="login-form">
        <div class="container-fluid" id="containerPrincipal" style="">
            <div class="container" id="containerLogin">
                <h1 style="color: white;">Veuillez vous connecter</h1>
                <div class="mb-3">
                    <label for="username" style="color: white;" class="form-label">Email</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="mb-3">
                    <label for="password" style="color: white;" class="form-label" >Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div style="display: flex; justify-content: space-between;"> 
                    <button type="button" href="#" id="register-btn" class="btn btn-secondary create-btn">Creer un compte</button>
                    <button type="submit" href="#" class="btn btn-primary login-btn" id="login-btn" >Login</button>
                </div>    
            </div>
        </div>
    </form>
</body>

<script src="_partials/js/login.js"></script>