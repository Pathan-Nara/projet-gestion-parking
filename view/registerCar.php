<link rel="stylesheet" href="_partials/css/registerCar.css">
    <div class="card mt-5">
        <h3 class="card-title text-center">Enregistrement d'un Véhicule</h3>
        <form id="registerCar">
            <div class="mb-3">
                <label for="marque" class="form-label">Marque</label>
                <input type="text" class="form-control" id="marque" name="marque" placeholder="Entrez la marque du véhicule" required>
            </div>
            <div class="mb-3">
                <label for="modele" class="form-label">Modèle</label>
                <input type="text" class="form-control" id="modele" name="modele" placeholder="Entrez le modèle du véhicule" required>
            </div>
            <div class="mb-3">
                <label for="immatriculation" class="form-label">Immatriculation</label>
                <input type="text" class="form-control" id="immatriculation" name="immatriculation" placeholder="Entrez le numéro d'immatriculation" required>
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
            <div class="mb3">
                <label for="type" class="form-label">Type de véhicule</label>
                <select class="form-select" id="type" name="type" required>
                    <option value="" disabled selected>Choisissez le type de véhicule</option>
                    <option value="voiture">Voiture</option>
                    <option value="moto">Moto</option>
                    <option value="velo">Vélo</option>
                    <option value="camion">Camion</option>
                    
                </select>
            </div>
            <div class="d-grid gap-2 mt-3">
                <button type="submit" class="btn btn-primary register-btn">Enregistrer</button>
            </div>
        </form>
    </div>

<script src="_partials/js/registerCar.js"></script>

