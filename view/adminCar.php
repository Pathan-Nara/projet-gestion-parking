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
                <a href="index.php?component=addCar" class="btn btn-primary">Ajouter un vehicule</a>
            </div>
        </div>
    </div>
</body>

<script src="_partials/js/adminCar.js"></script>