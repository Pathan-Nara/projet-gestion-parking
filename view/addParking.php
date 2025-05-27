<link href="_partials/css/addParking.css" rel="stylesheet">

<body class="container-fluid" style="background-color:rgb(38, 97, 145); width:100%; margin:0; padding:0; display: flex; justify-content: center; flex-direction:column;" >
    <div class="container" id="dashboard">
        <div class="container-fluid" id="add-parking">
            <h1>Ajouter un Parking</h1>
            <form id="addParkingForm">
                <div class="mb-3">
                    <label for="nom" class="form-label" style="color: white;">Nom du Parking</label>
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez le nom du parking" required>
                </div>
                <div class="mb-3">
                    <label for="adresse" class="form-label" style="color: white;">Adresse</label>
                    <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Entrez l'adresse du parking" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label" style="color: white;">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Entrez une description du parking" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="nb_places_voiture" class="form-label" style="color: white;">Nombre de places pour voitures</label>
                    <input type="number" class="form-control" id="nb_places_voiture" name="nb_places_voiture" placeholder="Entrez le nombre de places pour voitures" required>
                </div>
                <div class="mb-3">
                    <label for="nb_places_moto" class="form-label" style="color: white;">Nombre de places pour motos</label>
                    <input type="number" class="form-control" id="nb_places_moto" name="nb_places_moto" placeholder="Entrez le nombre de places pour motos" required>
                </div>
                <div class="mb-3">
                    <label for="nb_places_velo" class="form-label" style="color: white;">Nombre de places pour vélos</label>
                    <input type="number" class="form-control" id="nb_places_velo" name="nb_places_velo" placeholder="Entrez le nombre de places pour vélos" required>
                </div>
                <div class="mb-3">
                    <label for="nb_places_camion" class="form-label" style="color: white;">Nombre de places pour camions</label>
                    <input type="number" class="form-control" id="nb_places_camion" name="nb_places_camion" placeholder="Entrez le nombre de places pour camions" required>
                </div>
                <div class="mb-3">
                    <label for="horaires" class="form-label" style="color: white;">Horaires</label>
                    <input type="text" class="form-control" id="horaires" name="horaires" placeholder="Entrez les horaires d'ouverture (ex: 08:00 - 20:00)" required>
                </div>
                <div class="mb-3">
                    <label for="tarifperhour" class="form-label" style="color: white;">Tarif par heure</label>
                    <input type="number" class="form-control" id="tarifperhour" name="tarifperhour" placeholder="Entrez le tarif par heure" required>
                </div>
                <div class="mb-3">
                    <label for="tarifperday" class="form-label" style="color: white;">Tarif par jour</label>
                    <input type="number" class="form-control" id="tarifperday" name="tarifperday" placeholder="Entrez le tarif par jour" required>
                </div>
                <div class="d-grid gap-2 mt-3">
                    <button type="submit" class="btn btn-primary" style="border:none;">Ajouter le Parking</button>
                </div>
            </form>
        </div>
    </div>
</body>
<script src="_partials/js/addParking.js"></script>