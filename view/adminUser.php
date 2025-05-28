<link href="_partials/css/adminUser.css" rel="stylesheet">

<body class="container-fluid" style="background-color:rgb(38, 97, 145); width:100%; margin:0; padding:0; display: flex; justify-content: center; flex-direction:column;" >
    <div class="container" id="dashboard">
        <div class="container-fluid" id="user-list">
            <h1>Gestion des Utilisateurs</h1>
            <div class="container-fluid" style="display: flex; justify-content: end; flex-direction: row;">
                <input class="form-control" style="width:20%" type="search" placeholder="Chercher un utilisateur" aria-label="Search">
            </div>
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
                                    <a href="#" class="fa-solid fa-pen-to-square edit" data-id="<?php echo $user['id'] ?>" id="edit" style="color: yellow;"></a>
                                    <a href="#" class="fa-solid fa-trash delete" data-id="<?php echo $user['id'] ?>" style="color: red;"></a>
                                </div>    
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="container-fluid" style="display: flex; justify-content: end; flex-direction: row;">
                <a href="#" class="btn btn-primary">Ajouter un Utilisateur</a>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Modifier l'utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        <input type="hidden" id="edit_user_id" name="user_id">
                        <div class="mb-3">
                            <label for="edit_nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="edit_nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_role" class="form-label">Rôle</label>
                            <select class="form-select" id="edit_role" name="role" required>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_password" class="form-label">Nouveau mot de passe (laisser vide pour ne pas modifier)</label>
                            <input type="password" class="form-control" id="edit_password" name="password">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="saveUserChanges">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="_partials/js/adminUser.js"></script>