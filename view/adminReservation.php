<link rel="stylesheet" href="_partials/css/adminReservation.css">
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
                        <td><?php echo ($reservation['prenom']); ?></td>
                        <td><?php echo htmlspecialchars($reservation['place_id']); ?></td>
                        <td><?php echo date("d/m/Y", $reservation['arrive']); ?></td>
                        <td><?php echo date("d/m/Y", $reservation['depart']); ?></td>
                        <td><?php echo htmlspecialchars($reservation['status']); ?></td>
                        <td><?php echo htmlspecialchars($reservation['prix']); ?> €</td>
                        <td>
                            <div class="btn-grp">
                                <a href="#" id="delete" class="fa-solid fa-trash delete" data-id="<?php echo $reservation['reservation_id'] ?>"></a>
                            </div>    
                        </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script src="_partials/js/adminReservation.js"></script>