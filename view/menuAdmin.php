<link rel="stylesheet" href="_partials/css/menuAdmin.css">
<body class="container-fluid" style="background-color:rgb(38, 97, 145); width:100%; margin:0; padding:0; display: flex; justify-content: center; flex-direction:column;" >


    <div class="container-fluid" id="dashboard">
        <div class="container" id="dashboard-menu">
            <h1>Menu Administrateur</h1>
            <div class="container-fluid" id="admin-options">
                <div class="container-fluid" style="display: flex; flex-direction: row; width: 100%; justify-content: space-around;">
                    <a href="index.php?component=adminUsers" class="btn btn-admin btn-primary admin-option">Gestion des utilisateurs</a>
                    <a href="index.php?component=adminCars" class="btn btn-admin btn-primary admin-option">Gestion des véhicules</a>
                </div>
                <div class="container-fluid" style="display: flex; flex-direction: row; width: 100%; justify-content: space-around;">
                    <a href="index.php?component=adminReservations" class="btn btn-admin btn-primary admin-option">Gestion des réservations</a>
                    <a href="index.php?component=adminParking" class="btn btn-admin btn-primary admin-option">Gestion des parkings</a>
                </div>    
            </div>
        </div>
    </div>