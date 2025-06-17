<nav class="navbar navbar-expand-lg bg-light" style="width:100%; height: 130px; padding:0;">
    <div class="container-fluid" style="background-color: #0078d7; width:100%; height:100%; display:flex; justify-content: space-between;">
        <div class="navbar-brand" style=" display: flex; flex-direction: row; justify-content: center; align-items: center;">
            <img src="assets/img/iconParkEase.png" alt="Logo" style="width: 90px; height: 90px; border-radius: 100px;">
            <h2 class="navbar-brand" style="color: white !important; margin-left: 20px;" href="#">Bienvenue <?php echo $_SESSION['prenom'] ?>  prêt à trouver votre place idéale ?</h2>
            <input class="form-control me-2" style="margin-left:20px; width: 100%;" type="search" placeholder="Chercher un parking" aria-label="Search">
        </div>
        <div id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="gap:10px">
        <li class="nav-item">
                <a href="index.php?component=home" class=" btn btn-outline-secondary btn-nav" style="color:yellow; border-color:yellow; width: 100%; height: 100%; align-items: center; text-align: center; align-content: center;">Tableau de bord</a>
            </li>
            <!-- <li class="nav-item">
                <button type="button" class=" btn btn-outline-secondary btn-nav" style="color:yellow; border-color:yellow">Parking a Proximité</button>
            </li> -->
            <li class="nav-item">
                <button type="button" class=" btn btn-outline-secondary btn-nav" style="color:yellow; border-color:yellow; width: 100%; height: 100%; align-items: center; text-align: center; align-content: center;">Historiques des reservations</button>
            </li>
            <!-- <li class="nav-item">
                <button type="button" class=" btn btn-outline-secondary btn-nav" style="color:yellow; border-color:yellow">ParkEase Gold</button>
            </li> -->
            <li class="nav-item">
                <a class="nav-link a-nav" href="#" id="profil">
                    <i class="nav-link fa-solid fa-user"></i>
                </a>
            </li>
            <?php if ($_SESSION['is_admin']): ?>
            <li class="nav-item">
                <a class="nav-link a-nav" href="index.php?component=menuAdmin" id="admin">
                    <i class="nav-link fa-solid fa-user-shield"></i>
                </a>
            </li>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link a-nav" href="?deconnect" id="deconnect">
                    <i class="nav-link fa-solid fa-power-off"></i>
                </a>
            </li>
            <!-- <li class="nav-item dropdown" style="margin-right: 50px;">
                <a class="nav-link a-nav dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="nav-link fa-solid fa-bars"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Historique</a></li>
                    <li><a class="dropdown-item" href="#">Parametres</a></li>
                    <li><a class="dropdown-item" href="#">Aide/FAQ</a></li>
                    <li><a class="dropdown-item" href="?deconnect">Deconnexion</a></li>
                </ul>
            </li> -->
        </ul>
        </div>
    </div>
    </nav>