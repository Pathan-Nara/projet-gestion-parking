
<body class="container-fluid" style="background-color:rgb(38, 97, 145); width:100%; margin:0; padding:0; display: flex; justify-content: center; flex-direction:column;" >

    <div class="card mt-5" style="width: 50%; margin: auto; border-radius: 25px; background-color: #0078d7; padding: 20px; margin-bottom: 50px;">
        <h3 class="card-title text-center" style="color: white;">Enregistrement d'un Véhicule</h3>
        <form id="registerCar">
            <div class="mb-3">
                <label for="marque" class="form-label" style="color: white;">Marque</label>
                <input type="text" class="form-control" id="marque" name="marque" placeholder="Entrez la marque du véhicule" required>
            </div>
            <div class="mb-3">
                <label for="modele" class="form-label" style="color: white;">Modèle</label>
                <input type="text" class="form-control" id="modele" name="modele" placeholder="Entrez le modèle du véhicule" required>
            </div>
            <div class="mb-3">
                <label for="immatriculation" class="form-label" style="color: white;">Immatriculation</label>
                <input type="text" class="form-control" id="immatriculation" name="immatriculation" placeholder="Entrez le numéro d'immatriculation" required>
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
            <div class="d-grid gap-2 mt-3">
                <button type="submit" class="btn btn-primary register-btn" style="border:none;">Enregistrer</button>
            </div>
        </form>
    </div>

</body>

<script src="_partials/js/registerCar.js"></script>

<style>
    .register-btn {
        background-color: #3480eb; 
        color: white; 
        border: none;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .register-btn:hover {
        background-color: #1d4e89; 
        transform: scale(1.02);
        cursor: pointer;
    }
</style>