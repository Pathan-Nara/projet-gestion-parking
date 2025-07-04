
<link href="_partials/css/booking.css" rel="stylesheet"></link>

    <div class="container" id="bookingContainer">
        <h1>Voici la liste des Parking disponibles</h1>
        <div class="container-fluid" id="parkingList">
            <?php if(empty($parkings)): ?>
                <h2>Aucun parking disponibles</h2>
            <?php else: ?>
                <div class="container-fluid" id="parkingListContainer">
                    <?php foreach($parkings as $parking): ?>
                        <div class="container" id="parkingCard">
                            <h2><?php echo cleanString($parking['nom']); ?></h2>
                            <div id="infoParking">
                                <p>Adresse: <?php echo cleanString($parking['lieu']); ?></p>
                                <p>Description: <?php echo cleanString($parking['description']) ?></p>
                                <div id="eval">
                                    <p>Note: </p>
                                    <div class="stars" data-eval="<?php echo $parking['note'] ?>"></div> 
                                </div>
                            </div>
                            <div id="nbPlaces">
                                <p>Places de voiture: <?php echo cleanString($parking['nb_places_voiture']) ?> Disponibles: <?php echo($parking['nb_places_voiture'] - $reservation[$parking['id']]['voiture'])  ?></p>
                                <p>Places de velo: <?php echo cleanString($parking['nb_places_velo']) ?> Disponibles: <?php echo($parking['nb_places_velo'] - $reservation[$parking['id']]['velo'])  ?></p>
                                <p>Places de moto: <?php echo cleanString($parking['nb_places_moto']) ?> Disponibles: <?php echo($parking['nb_places_moto'] - $reservation[$parking['id']]['moto'])  ?></p>
                                <p>Places de camion: <?php echo cleanString($parking['nb_places_camion']) ?> Disponibles: <?php echo($parking['nb_places_camion'] - $reservation[$parking['id']]['camion'])  ?></p>
                                <p>Total: <?php echo cleanString($parking['nb_places_voiture'] + $parking['nb_places_velo'] + $parking['nb_places_moto'] + $parking['nb_places_camion']) ?> Disponibles: <?php echo cleanString(($parking['nb_places_voiture'] + $parking['nb_places_velo'] + $parking['nb_places_moto'] + $parking['nb_places_camion']) - $reservation[$parking['id']]['total']) ?></p>
                            </div>
                            <div id="parking-tarifs">
                                <p>Tarif a l'heure: <?php echo cleanString($parking['prix_par_heure']); ?> €</p>
                                <p>Tarif a la journée: <?php echo cleanString($parking['prix_par_jour']); ?> €</p>
                            </div>
                            <button class="btn btn-primary reservation" data-name="<?php echo $parking['nom'] ?>" data-pId="<?php echo $parking['parking_id'] ?>">Réserver</button>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
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
                <button type="submit" class="btn btn-primary" id="bookingBtn">Réserver</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Paiement</h5>
        <a id="backBtn" href="#">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
      </div>
      <div class="modal-body">
        <div class="mb-4">
          <h6>Récapitulatif</h6>
          <p>Parking: <span id="recap-parking"></span></p>
          <p>Dates: <span id="recap-dates"></span></p>
          <p>Total: <span id="recap-total"></span></p>
        </div>

        <form id="payment-form">
          <button id="submit-payment" class="btn btn-primary w-100">Payer maintenant</button>
          <button id="register-reservation" class="btn btn-secondary w-100 mt-2">Payer plus tard</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
    const PRIVATE_STRIPE = "<?php echo $_ENV['PRIVATE_STRIPE']; ?>";
    const PUBLIC_STRIPE = "<?php echo $_ENV['PUBLIC_STRIPE']; ?>";
</script>

<script type="module" src="_partials/js/booking.js"></script>
<script src="https://js.stripe.com/v3/"></script>