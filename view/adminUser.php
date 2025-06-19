<link href="_partials/css/adminUser.css" rel="stylesheet">

    <div class="container" id="dashboard">
        <div class="container-fluid" id="user-list">
            <h1>Gestion des Utilisateurs</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Rôle</th>
                        <th scope="col">Premium ?</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo htmlspecialchars($user['nom']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo ($user['is_admin'] == 1) ? "Admin" : "User"; ?></td>
                            <td><?php echo ($user['is_premium'] == 1) ? "Oui" : "Non"; ?></td>
                            <td>
                                <div class="btn-grp" style="display:flex; gap: 15px; align-items: center; justify-content: center;">
                                    <a href="#" class="fa-solid fa-pen-to-square edit" data-id="<?php echo $user['id'] ?>" id="edit"></a>
                                    <a href="#" class="fa-solid fa-trash delete" data-id="<?php echo $user['id'] ?>"></a>
                                </div>    
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="container-fluid">
                <a href="index.php?component=adminAddUser" class="btn btn-primary">Ajouter un Utilisateur</a>
            </div>
        </div>
    </div>



    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Modifier l'utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="userId" name="userId">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Laisser vide pour ne pas modifier">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="isAdmin" name="isAdmin">
                            <label class="form-check-label" for="isAdmin">Administrateur</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="isPremium" name="isPremium">
                            <label class="form-check-label" for="isPremium">Premium</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="updateUser">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>

<script src="_partials/js/adminUser.js"></script>