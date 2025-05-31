<link rel="stylesheet" href="_partials/css/adminCar.css">
<body class="container-fluid" style="background-color:rgb(38, 97, 145); width:100%; margin:0; padding:0; display: flex; justify-content: center; flex-direction:column;" >
    <div class="container" id="dashboard">
        <div class="container-fluid" id="car-list">
            <h1>Gestion des vehicules</h1>
            <div class="container-fluid" style="display: flex; justify-content: end; flex-direction: row;">
                <input class="form-control" style="width:20%" type="search" placeholder="Chercher un vehicule" aria-label="Search">
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Type</th>
                        <th scope="col">Immatriculation</th>
                        <th scope="col">Appartiens a</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cars as $car): ?>
                        <?php $fullName = ($car['nom'] . ' ' . $car['prenom']); ?>
                        <tr>
                            <td><?php echo $car['car_id']; ?></td>
                            <td><?php echo htmlspecialchars($car['model']); ?></td>
                            <td><?php echo htmlspecialchars($car['type']); ?></td>
                            <td><?php echo htmlspecialchars($car['imatriculation']); ?></td>
                            <td><?php echo htmlspecialchars($fullName); ?></td>
                            <td>
                                <div class="btn-grp" style="display:flex; gap: 15px; align-items: center; justify-content: center;">
                                    <a href="#" class="fa-solid fa-pen-to-square edit" data-id="<?php echo $car['car_id'] ?>" id="edit" style="color: yellow;"></a>
                                    <a href="#" class="fa-solid fa-trash delete" data-id="<?php echo $car['car_id'] ?>" style="color: red;"></a>
                                </div>    
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="container-fluid" style="display: flex; justify-content: end; flex-direction: row;">
                <a href="index.php?component=adminAddCar" class="btn btn-primary">Ajouter un vehicule</a>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editCarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editCarModalLabel">Modifier les informations du véhicule</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCarForm">
                        <input type="hidden" id="carId" name="car_id">
                        
                        <div class="mb-3">
                            <label for="editMarque" class="form-label">Marque</label>
                            <input type="text" class="form-control" id="editMarque" name="editMarque" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="editModel" class="form-label">Modèle</label>
                            <input type="text" class="form-control" id="editModel" name="model" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="editType" class="form-label">Type</label>
                            <select class="form-select" id="editType" name="type" required>
                                <option value="voiture">Voiture</option>
                                <option value="moto">Moto</option>
                                <option value="velo">Vélo</option>
                                <option value="camion">Camion</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="editMotorisation" class="form-label">Motorisation</label>
                            <select class="form-select" id="editMotorisation" name="motorisation">
                                <option value="essence">Essence</option>
                                <option value="diesel">Diesel</option>
                                <option value="hybride">Hybride</option>
                                <option value="electrique">Électrique</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="editImatriculation" class="form-label">Immatriculation</label>
                            <input type="text" class="form-control" id="editImatriculation" name="imatriculation" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="editProprio" class="form-label">Propriétaire</label>
                            <select class="form-select" id="editProprio" name="editProprio" required>
                                <?php foreach ($users as $user): ?>
                                    <option value="<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['nom'] . ' ' . $user['prenom']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="modalUpdate">Sauvegarder</button>
                </div>
            </div>
        </div>
    </div></div>
</body>

<script src="_partials/js/adminCar.js"></script>