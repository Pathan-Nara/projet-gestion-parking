<link rel="stylesheet" href="_partials/css/profil.css">
<form id="profil-form">
    <div class="container-fluid" id="containerPrincipal">
        <div class="container" id="containerProfil">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Modifier mes informations</h1>
                <a class="btn btn-success" href="index.php?component=registerCar" id="add-vehicle-btn">
                    <i class="fas fa-car"></i> Ajouter un véhicule
                </a>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($_SESSION['nom'] ?? '') ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" value="<?= htmlspecialchars($_SESSION['prenom'] ?? '') ?>">
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>">
            </div>

            <hr class="my-4">
            
            <div class="mb-3">
                <label for="current-password" class="form-label">Mot de passe actuel</label>
                <input type="password" class="form-control" id="current-password" name="current_password">
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="new-password" class="form-label">Nouveau mot de passe</label>
                        <input type="password" class="form-control" id="new-password" name="new_password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="confirm-password" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" id="confirm-password" name="confirm-password">
                    </div>
                </div>
            </div>
                <div>
                    <a class="btn btn-danger me-2" id="delete-account">
                        <i class="fas fa-trash"></i> Supprimer le compte
                    </a>
                    <a class="btn btn-primary" id="update-profile">
                        <i class="fas fa-save"></i> Sauvegarder
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Section des véhicules -->
<div class="container mt-5">
    <h3>Mes véhicules</h3>
    <div class="table" id="vehicles-list">
        <?php if (isset($vehicle) && !empty($vehicle)): ?>
            <div class="table-vehicules">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Marque</th>
                            <th>Modèle</th>
                            <th>Immatriculation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vehicle as $v): ?>
                            <tr>
                                <td><?= htmlspecialchars($v['type'] ?? '') ?></td>
                                <td><?= htmlspecialchars($v['marque'] ?? '') ?></td>
                                <td><?= htmlspecialchars($v['model'] ?? '') ?></td>
                                <td><?= htmlspecialchars($v['imatriculation'] ?? '') ?></td>
                                <td>
                                    <a class="btn btn-primary" id="editCar" data-carId="<?php echo $v['id'] ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a data-carId="<?php echo  $v['id'] ?>" id="deleteCar" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Aucun véhicule enregistré. Cliquez sur "Ajouter un véhicule" pour commencer.
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="modal fade" id="editCarModal" tabindex="-1" aria-labelledby="editVehicleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editVehicleModalLabel">Modifier un véhicule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="edit-car-form">
                    <input type="hidden" id="edit-vehicle-index" name="index">
                    <div class="mb-3">
                        <label for="edit-vehicle-type" class="form-label">Type de véhicule</label>
                        <select class="form-select" id="edit-vehicle-type" name="type" required>
                            <option value="">Choisir un type</option>
                            <option value="voiture">Voiture</option>
                            <option value="moto">Moto</option>
                            <option value="velo">Vélo</option>
                            <option value="camion">Camion</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-vehicle-marque" class="form-label">Marque</label>
                        <input type="text" class="form-control" id="edit-vehicle-marque" name="marque" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-vehicle-modele" class="form-label">Modèle</label>
                        <input type="text" class="form-control" id="edit-vehicle-modele" name="modele" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-vehicle-immatriculation" class="form-label">Immatriculation</label>
                        <input type="text" class="form-control" id="edit-vehicle-immatriculation" name="immatriculation" placeholder="AA-123-BB">
                    </div>
                    <div class="mb-3">
                        <label for="edit-vehicle-motorisation" class="form-label">Motorisation</label>
                        <select class="form-select" id="edit-vehicle-motorisation" name="motorisation" required>
                            <option value="">Choisir une motorisation</option>
                            <option value="essence">Essence</option>
                            <option value="diesel">Diesel</option>
                            <option value="electrique">Électrique</option>
                            <option value="hybride">Hybride</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" id="modalBack" class="btn btn-secondary">Annuler</a>
                <a href="#" id="modalUpdate" class="btn btn-primary">Modifier le véhicule</a>
            </div>
        </div>
    </div>
</div>

<script type="module" src="_partials/js/profil.js"></script>