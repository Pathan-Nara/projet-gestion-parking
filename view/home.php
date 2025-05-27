
<link href="_partials/css/home.css" rel="stylesheet"></link>
<body class="container-fluid" style="background-color:rgb(38, 97, 145); width:100%; margin:0; padding:0; display: flex; justify-content: center; flex-direction:column;" >
    
    <div class="container-fluid" id="dashboard" class="container">
        <h1>Mon Dashboard</h1>
            <?php if(empty($car)):?>
                <div class="container-fluid" style="display: flex; justify-content: center; align-items: center; flex-direction: column; height:100%;">
                    <h2 style="color: white;">Vous n'avez pas de vehicule enregistrée</h2>
                    <a href="index.php?component=registerCar" class="btn btn-primary" id="addCarBtn">Ajouter un vehicule</a>
                </div>
            <?php endif; ?>
            <?php if(!empty($car) && empty($reservation) ): ?>
                <div class="container-fluid" style="display: flex; justify-content: center; align-items: center; flex-direction: column; height:100%;">
                    <h2 style="color: white;">Vous n'avez pas de reservation</h2>
                    <button type="button" class="btn btn-primary" id="addReservationBtn">Ajouter une reservation</button>
                </div>
            <?php endif; ?>
            <?php if(!empty($car) && !empty($reservation)): ?>
                
            <?php endif; ?>
    </div>

</body>

<script src="_partials/js/home.js"></script>