<link href="_partials/css/adminParking.css" rel="stylesheet">

    <div class="container" id="dashboard">
        <div class="container-fluid" id="parking-list">
            <h1>Gestion Parking</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Capacité</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($parkings as $parking): ?>
                        <tr>
                            <td><?php echo $parking['id']; ?></td>
                            <td><?php echo htmlspecialchars($parking['nom']); ?></td>
                            <td><?php echo htmlspecialchars($parking['lieu']); ?></td>
                            <td><?php echo ($parking['nb_places_voiture'] + $parking['nb_places_moto'] + $parking['nb_places_velo'] + $parking['nb_places_camion']); ?></td>
                            <td>
                                <div class="btn-grp">
                                    <a href="#" class="fa-solid fa-pen-to-square edit" data-id="<?php echo $parking['id'] ?>" id="edit"></a>
                                    <a href="#" class="fa-solid fa-trash delete" data-id="<?php echo $parking['id'] ?>"></a>
                                </div>    
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="container-fluid">
                <a href="index.php?component=addParking" class="btn btn-primary">Ajouter un Parking</a>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Modifier les informations du parking</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editParkingForm">
                        <input type="hidden" id="parkingId" name="id">
                        
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Nom du parking</label>
                                <input type="text" class="form-control" id="editNom" name="nom" required>
                            </div>
                            <div class="col-md-6">
                                <label for="adresse" class="form-label">Adresse</label>
                                <input type="text" class="form-control" id="editAdresse" name="lieu" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="editDescription" name="editDescription" rows="3"></textarea>
                        </div>
                        
                        <div class="mb-3 row">
                            <h6 class="mb-3">Places disponibles</h6>
                            <div class="col-md-3">
                                <label for="nb_places_voiture" class="form-label">Voitures</label>
                                <input type="number" class="form-control" id="editNbPlacesVoitures" name="nb_places_voiture" min="0" required>
                            </div>
                            <div class="col-md-3">
                                <label for="nb_places_moto" class="form-label">Motos</label>
                                <input type="number" class="form-control" id="editNbPlacesMotos" name="nb_places_moto" min="0" required>
                            </div>
                            <div class="col-md-3">
                                <label for="nb_places_velo" class="form-label">Vélos</label>
                                <input type="number" class="form-control" id="editNbPlacesVelos" name="nb_places_velo" min="0" required>
                            </div>
                            <div class="col-md-3">
                                <label for="nb_places_camion" class="form-label">Camions</label>
                                <input type="number" class="form-control" id="editNbPlacesCamions" name="nb_places_camion" min="0" required>
                            </div>
                        </div>
                        
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="horaires" class="form-label">Horaires</label>
                                <input type="text" class="form-control" id="editHoraires" name="horaires" placeholder="Ex: 8h-20h tous les jours">
                            </div>
                        </div>
                        
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="tarif_heure" class="form-label">Tarif par heure (€)</label>
                                <input type="number" class="form-control" id="editTarifPerHour" name="tarif_heure" min="0" step="0.01" required>
                            </div>
                            <div class="col-md-6">
                                <label for="tarif_jour" class="form-label">Tarif par jour (€)</label>
                                <input type="number" class="form-control" id="editTarifPerDay" name="tarif_jour" min="0" step="0.01" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="modalUpdate">Sauvegarder</button>
                </div>
            </div>
        </div>
    </div>


<script src="_partials/js/adminParking.js"></script>