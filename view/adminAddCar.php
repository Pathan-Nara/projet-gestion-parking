<body class="container-fluid" style="background-color:rgb(38, 97, 145); width:100%; margin:0; padding:0; display: flex; justify-content: center; flex-direction:column;" >
<div class="container mt-5 p-4" style="background-color: #0078d7; border-radius: 10px; max-width: 500px; height: auto; margin-top: 10px!important">
        <h2 class="text-center" style="color: white;">Ajouter un vehicule</h2>
        <div>
            <div class="mb-3">
                <label for="marque" class="form-label" style="color: white;">Marque</label>
                <input type="text" class="form-control" id="marque" name="marque" placeholder="Entrez la marque du véhicule">
            </div>
            <div class="mb-3">
                <label for="model" class="form-label" style="color: white;">Modèle</label>
                <input type="text" class="form-control" id="model" name="model" placeholder="Entrez le modèle du véhicule">
            </div>
            <div class="mb-3">
                <label for="imatriculation" class="form-label" style="color: white;">Immatriculation</label>
                <input type="text" class="form-control" id="imatriculation" name="imatriculation" placeholder="Entrez votre numéro d'immatriculation">
            </div>
            <div class="mb-3">
                <label for="motorisation" class="form-label" style="color: white;">Motorisation</label>
                <select class="form-select" id="motorisation" name="motorisation" required>
                    <option value="" disabled selected>Choisissez la motorisation</option>
                    <option value="essence">Essence</option>
                    <option value="diesel">Diesel</option>
                    <option value="electrique">Électrique</option>
                    <option value="hybride">Hybride</option>
                </select>
            </div>
            <div class="mb3">
                <label for="type" class="form-label" style="color: white;">Type de véhicule</label>
                <select class="form-select" id="type" name="type" required>
                    <option value="" disabled selected>Choisissez le type de véhicule</option>
                    <option value="voiture">Voiture</option>
                    <option value="moto">Moto</option>
                    <option value="velo">Vélo</option>
                    <option value="camion">Camion</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="proprio" class="form-label" style="color: white;">Propriétaire</label>
                <select class="form-select" id="proprio" name="proprio" required>
                    <option value="" disabled selected>Choisissez le propriétaire du véhicule</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['nom'] . ' ' . $user['prenom']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button href="#" id="addCarBtn" class="btn btn-primary login-btn w-100" style="border: none; margin-top: 30px;">Ajouter le vehicule</button>
        </div>
    </div>
</body>

<script type="module" src="_partials/js/adminAddCar.js"></script>