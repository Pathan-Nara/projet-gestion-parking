    <div class="container" id="dashboard">
        <div class="container-fluid" id="parking-list">
            <h1>Gestion Reservations</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Client</th>
                        <th scope="col">Id de la place</th>
                        <th scope="col">arrivée</th>
                        <th scope="col">départ</th>
                        <th scope="col">status</th>
                        <th scope="col">prix</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $reservation): ?>
                        <tr>
                            <td><?php echo $reservation['id']; ?></td>
                            <td><?php echo htmlspecialchars($reservation['client']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['place_id']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['arrivee']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['depart']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['status']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['prix']); ?> €</td>
                            <td>
                                <div class="btn-grp">
                                    <a href="#" class="fa-solid fa-pen-to-square edit" data-id="<?php echo $reservation['id'] ?>" id="edit"></a>
                                    <a href="#" class="fa-solid fa-trash delete" data-id="<?php echo $reservation['id'] ?>"></a>
                                </div>    
                            </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="container-fluid">
                <a href="index.php?component=adminAddReserv" class="btn btn-primary">Ajouter une Réservation</a>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Réserver une place</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="parkingId" name="parkingId">
                        <div class="mb-3">
                            <label for="vehicule" class="form-label">Quel vehicule souhaitez-vous garer ?</label>
                            <select class="form-select" id="vehicule" name="vehicule" required>
                                <option value="" selected disabled>Choisir un vehicule</option>
                                <?php foreach ($voiture as $v): ?>
                                    <option value="<?php echo $v['id']; ?>"> <?php echo $v['model'] ?>  </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3" id="choixPlace">
                        </div>
                        <div class="mb-3">
                            <container class="row">
                                <radio class="col-md-3">
                                    <input type="radio" class="form-check-input" name="type" id="resHeure" value="hour">
                                    <label class="form-check-label" for="resHeure">Reserver a l'heure</label>
                                </radio>
                                <radio class="col-md-3">
                                    <input type="radio" class="form-check-input" name="type" id="resJour" value="day">
                                    <label class="form-check-label" for="resJour">Reserver a la journée</label>
                                </radio>
                            </container>
                        </div>
                        <div class="mb-3" id="horairesRes"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary" id="save">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
        