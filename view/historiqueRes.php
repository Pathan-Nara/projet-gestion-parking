<link href="_partials/css/historiqueRes.css" rel="stylesheet"></link>
<h1>Historique des réservations</h1>
<div class="container-fluid" id="historiqueResContainer">
    <?php if(empty($reservations)): ?>
        <h2>Aucune réservation trouvée</h2>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Parking</th>
                    <th>Evaluation Parking</th>
                    <th>Type de véhicule</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Prix total</th>
                    <th>Status</th>
                    <th>Archivé ?</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $res): ?>
                    <tr>
                        <td><?php echo $res['nom']; ?></td>
                        <td>
                            <div class="eval" data-eval="<?php echo $res['note'] ?>">
                                <p>Note: </p>
                                <div class="stars" data-eval="<?php echo $res['note'] ?>"></
                            </div>
                        </td>
                        <td><?php echo $res['voiture_id']; ?></td>
                        <td><?php echo date("d/m/Y", $res['arrive']); ?></td>
                        <td><?php echo date("d/m/Y", $res['depart']); ?></td>
                        <td><?php echo $res['prix']; ?> €</td>
                        <td>
                            <?php if($res['status'] == 'annulée'): ?>
                                <span class="badge bg-danger"><?php echo $res['status']; ?></span>
                            <?php elseif($res['is_paid'] == 1): ?>
                                <span class="badge bg-success">Payée</span>
                            <?php else: ?>
                                <span class="badge bg-warning"><?php echo $res['status']; ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($res['archived'] == 1): ?>
                                <span class="badge bg-danger">Archivé</span>
                            <?php else: ?>
                                <span class="badge bg-success">Non archivé</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($res['is_paid'] == 1): ?>
                                <div id="note" data-parking-id="<?php echo $res['id']; ?>" data-user-id="<?php echo $_SESSION['id']; ?>">
                                    <label for="rating_<?php echo $res['id']; ?>">Note (0-5):</label>
                                    <input type="number" id="noteValue" name="rating" min="0" max="5" step="1" class="form-control" style="width: 80px; display: inline-block;">
                                    <button class="btn btn-primary rate-btn" id="notationBtn">Noter</button>
                                </div>
                            <?php else: ?>
                                <p>Vous ne pouvez pas evaluer un parking non payé.</p>
                            <?php endif; ?>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script type="module" src="_partials/js/historiqueRes.js"></script>