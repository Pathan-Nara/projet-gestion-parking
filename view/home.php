<link href="_partials/css/home.css" rel="stylesheet"></link>
    
    <div class="container-fluid" id="dashboard">
        <h1>Mon Dashboard</h1>
            <?php if(empty($car)):?>
                <div class="container-fluid">
                    <h2>Vous n'avez pas de vehicule enregistrée</h2>
                    <a href="index.php?component=registerCar" class="btn btn-primary" id="addCarBtn">Ajouter un vehicule</a>
                </div>
            <?php endif; ?>
            <?php if(!empty($car) && empty($reservation) ): ?>
                <div class="container-fluid">
                    <h2>Vous n'avez pas de reservation</h2>
                    <a href="index.php?component=booking" class="btn btn-primary" id="addReservationBtn">Ajouter une reservation</a>
                </div>
            <?php endif; ?>
            <?php if(!empty($car) && !empty($reservation)): ?>
                <div class="container-fluid" id="reservation-table">
                    <h2>Vos reservations</h2>
                    <button class="btn btn-primary" id="addReservationBtn">Ajouter une reservation</button>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Parking</th>
                                <th>Type de véhicule</th>
                                <th>Date de début</th>
                                <th>Date de fin</th>
                                <th>Prix total</th>
                                <th>Status</th>
                                <th>Payé ?</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservation as $res): ?>
                                <tr>
                                    <td><?php echo $res['nom']; ?></td>
                                    <td><?php echo $res['voiture_id']; ?></td>
                                    <td><?php echo date("d/m/Y", $res['arrive']); ?></td>
                                    <td><?php echo date("d/m/Y", $res['depart']); ?></td>
                                    <td><?php echo $res['prix']; ?> €</td>
                                    <td><span class="badge bg-warning"><?php echo $res['status'] ?></span></td>
                                    <?php if($res['is_paid'] == 0): ?>
                                        <td> <span class="badge bg-warning">Non payé</span></td>
                                    <?php else: ?>
                                        <td> <span class="badge bg-success">Payée</span></td>
                                    <?php endif; ?>
                                    <td>
                                        <?php if($res['status'] == 'annulée'): ?>
                                            <a href="#" id="archived" data-reservation-id="<?php echo $res['reservation_id'] ?>" class="btn btn-danger">Archiver</a>
                                        <?php elseif($res['is_paid'] == 1): ?>
                                            <span class="badge bg-success">Réservation payée</span>
                                            <a href="#" id="archived" data-reservation-id="<?php echo $res['reservation_id'] ?>" class="btn btn-danger">Archiver</a>
                                        <?php else: ?>
                                            <a href="#" id="book" data-reservation-id="<?php echo $res['reservation_id'] ?>" class="btn btn-success">Payer</a>
                                            <a href="#" id="cancel" data-place-id="<?php echo $res["place_id"] ?>" data-reservation-id="<?php echo $res['reservation_id'] ?>" class="btn btn-danger">Annuler</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
    </div>

<script>
    const PRIVATE_STRIPE = "<?php echo $_ENV['PRIVATE_STRIPE']; ?>";
    const PUBLIC_STRIPE = "<?php echo $_ENV['PUBLIC_STRIPE']; ?>";
</script>
<script src="https://js.stripe.com/v3/"></script>
<script src="_partials/js/home.js"></script>