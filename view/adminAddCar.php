<link rel="stylesheet" href="_partials/css/adminAddCar.css">
<div class="container mt-5 p-4">
        <h2 class="text-center">Ajouter un vehicule</h2>
        <div>
            <div class="mb-3">
                <label for="marque" class="form-label" >Marque</label>
                <input type="text" class="form-control" id="marque" name="marque" placeholder="Entrez la marque du véhicule">
            </div>
            <div class="mb-3">
                <label for="model" class="form-label" >Modèle</label>
                <input type="text" class="form-control" id="model" name="model" placeholder="Entrez le modèle du véhicule">
            </div>
            <div class="mb-3">
                <label for="imatriculation" class="form-label" >Immatriculation</label>
                <input type="text" class="form-control" id="imatriculation" name="imatriculation" placeholder="Entrez votre numéro d'immatriculation">
            </div>
            <div class="mb-3">
                <label for="motorisation" class="form-label">Motorisation</label>
                <select class="form-select" id="motorisation" name="motorisation" required>
                    <option value="" disabled selected>Choisissez la motorisation</option>
                    <option value="essence">Essence</option>
                    <option value="diesel">Diesel</option>
                    <option value="electrique">Électrique</option>
                    <option value="hybride">Hybride</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type de véhicule</label>
                <select class="form-select" id="type" name="type" required>
                    <option value="" disabled selected>Choisissez le type de véhicule</option>
                    <option value="voiture">Voiture</option>
                    <option value="moto">Moto</option>
                    <option value="velo">Vélo</option>
                    <option value="camion">Camion</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="proprio" class="form-label" >Propriétaire</label>
                <select class="form-select" id="proprio" name="proprio" required>
                    <option value="" disabled selected>Choisissez le propriétaire du véhicule</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['nom'] . ' ' . $user['prenom']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button href="#" id="addCarBtn" class="btn btn-primary login-btn w-100">Ajouter le vehicule</button>
        </div>
    </div>

<script type="module" src="_partials/js/adminAddCar.js"></script>