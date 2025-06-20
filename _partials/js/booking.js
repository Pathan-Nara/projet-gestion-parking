import { evaluation } from "../utils/function";

const reservation = {
    parkingId: null,
    name: null,
    vehicule: null,
    place: null,
    type: null,
    heureDebut: null,
    heureFin: null,
    dateDebut: null,
    dateFin: null,
    prix: null,
}

async function initStripePayment(infos){
    const stripe = Stripe(PUBLIC_STRIPE);
    const formData = new URLSearchParams();
    formData.append("parkingId", infos.parkingId),
    formData.append("vehicule", infos.vehicule),
    formData.append("place", infos.place),
    formData.append("type", infos.type),
    formData.append("heureDebut", infos.heureDebut),
    formData.append("heureFin", infos.heureFin),
    formData.append("dateDebut", infos.dateDebut),
    formData.append("dateFin", infos.dateFin),
    formData.append("prix", infos.prix)
    try {
        const response = await fetch('index.php?component=booking&action=payment', {
            method: "POST",
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: formData,
        });
        const data = await response.json();

        if(data.id){
            stripe.redirectToCheckout({
                sessionId: data.id
            })
        } else {
            alert("Erreur lors de la création de session Stripe : " + data.error);
        }
    }
    catch (error) {
        console.error("Erreur lors de la création de session Stripe:", error);
        alert("Erreur lors de la création de session Stripe : " + error.message);
    }
    

}

async function addReservation(parkingId, vehicule, place, type, heureDebut, heureFin, dateDebut, dateFin, prix) {
    const formData = new URLSearchParams();
    formData.append("parkingId", parkingId);
    formData.append("vehicule", vehicule);
    formData.append("place", place);
    formData.append("type", type);
    if (type === "hour") {
        formData.append("heureDebut", heureDebut);
        formData.append("heureFin", heureFin);
    } else if (type === "day") {
        formData.append("dateDebut", dateDebut);
        formData.append("dateFin", dateFin);
    }
    formData.append("prix", prix);

    try{
        const response = await fetch('index.php?component=booking&action=addReservation', {
            method: "POST",
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: formData,
        });

        const data = await response.json();
        if (data.success) {
            alert("Réservation ajoutée avec succès !");
            window.location.reload();
        } else {
            console.error("Erreur:", data.error);
            alert("Erreur lors de l'ajout de la réservation : " + data.error);
        }
    }
    catch (error) {
        console.error("Erreur lors de l'ajout de la réservation:", error);
        alert("Erreur lors de l'ajout de la réservation : " + error.message);
    }

}

    


async function getPlaces(vehicule, parkingId) {
    const formData = new URLSearchParams();
    formData.append("vehicule", vehicule);
    formData.append("parkingId", parkingId);
    try {
        const response = await fetch('index.php?component=booking&action=getPlaces', {
            method: "POST",
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: formData,
        });

        if (!response.ok) {
            throw new Error("Erreur lors de la récupération des places");
        }

        const data = await response.json();
        if (data.success) {
            const placeSelect = document.getElementById("placeSelect");
            placeSelect.innerHTML = `<option value="" selected disabled>Choisissez une place</option>`;
            data.places.forEach(place => {
                placeSelect.innerHTML += `<option value="${place.id}">${place.id}</option>`;
            });
        } else {
            console.error("Erreur:", data.error);
        }
    } catch (error) {
        console.error("Erreur lors de la récupération des places:", error);
        const placeSelect = document.getElementById("placeSelect");
        placeSelect.innerHTML = `<option value="" disabled>Erreur lors de la récupération des places</option>`;
    }
}

async function updatePrice(){
    const parkingId = reservation.parkingId;
    console.log("ID du parking:", parkingId);
    const type = document.querySelector('input[name="type"]:checked').value;
    reservation.type = type;
    const formData = new URLSearchParams();
    formData.append("parkingId", parkingId);

    try{
        if (type === "hour"){
            const heureDebut = document.getElementById("heureDebut").value;
            const heureFin = document.getElementById("heureFin").value;
            
            if (!heureDebut || !heureFin) {
                return
            }
            else if (heureDebut >= heureFin) {
                document.getElementById("calculatedPrice").innerText = "L'heure de début doit être inférieur à l'heure de fin.";
                return;
            }
            
            formData.append("heureDebut", heureDebut);
            formData.append("heureFin", heureFin);
            formData.append("type", type);
            const response = await fetch('index.php?component=booking&action=price',{
                method: "POST",
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: formData,
            })

            const data = await response.json();
            const prix = data.total;
            if (data.success) {
                document.getElementById("calculatedPrice").innerText = prix + " €";
                document.getElementById("calculatedPrice").value = prix;
                reservation.prix = prix;
            } else {
                document.getElementById("calculatedPrice").innerText = "Erreur";
            }
        }

        else if (type === "day"){
            const dateDebut = document.getElementById("dateDebut").value;
            const dateFin = document.getElementById("dateFin").value;
            if (!dateDebut || !dateFin) {
                return
            }
            else if (dateDebut >= dateFin) {
                document.getElementById("calculatedPrice").innerText = "La date de début doit être inférieur à la date de fin.";
                return;
            }
            formData.append("dateDebut", dateDebut);
            formData.append("dateFin", dateFin);
            formData.append("type", type);
            const response = await fetch('index.php?component=booking&action=price',{
                method: "POST",
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: formData,
            })
            const data = await response.json();
            const prix = data.total;
            if (data.success) {
                document.getElementById("calculatedPrice").innerText = prix + " €";
                document.getElementById("calculatedPrice").value = prix;
                reservation.prix = prix;
            } else {
                document.getElementById("calculatedPrice").innerText = "Erreur";
            }
        }
    }
    catch (error) {
        console.error("Erreur lors de la mise à jour du prix:", error);
        document.getElementById("calculatedPrice").innerText = "Erreur";
        return;
    }
}




document.addEventListener("DOMContentLoaded", () => {
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));
    const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
    const editForm = document.getElementById("editForm");
    const reservationBtn = document.querySelectorAll(".reservation");
    const resHeure = document.getElementById("resHeure");
    const resJour = document.getElementById("resJour");
    const vehiculeSelect = document.getElementById('vehicule');
    const choixPlace = document.getElementById("choixPlace");
    const horairesRes = document.getElementById("horairesRes");
    const bookingBtn = document.getElementById("bookingBtn");
    const laterBtn = document.getElementById("register-reservation");
    const paymentBtn = document.getElementById("submit-payment");
    


    document.querySelectorAll(".stars").forEach((stars ) => {
        console.log("Evaluation de la notation");
        evaluation(stars);
    });

    vehiculeSelect.addEventListener("change", (e) => {
        e.preventDefault();

        choixPlace.innerHTML = `<select class="form-select" id="placeSelect" name="placeSelect">
            <option value="" selected disabled>Choisissez une place</option>
        `;
        reservation.vehicule = vehiculeSelect.value;
        console.log("Véhicule sélectionné:", reservation.vehicule);
        console.log(reservation.parkingId);
        getPlaces(reservation.vehicule, reservation.parkingId);
        choixPlace.addEventListener("change", (e) => {
            e.preventDefault();
            console.log("CHANGEMENT DE PLACE");
            reservation.place = document.getElementById("placeSelect").value;
            console.log("Place sélectionnée:", reservation.place);
        });
    });
    
    resHeure.addEventListener("change", (e) => {
        e.preventDefault();
        console.log("CHANGEMENT D'HEURE");
        horairesRes.innerHTML = `<div id="resHeureDiv" style="display:none;"></div>
                            <label for="heureDebut" class="form-label">Heure de début:</label>
                            <input type="time" class="form-control" id="heureDebut" name="heureDebut">
                            
                            <label for="heureFin" class="form-label mt-2">Heure de fin:</label>
                            <input type="time" class="form-control" id="heureFin" name="heureFin">
                        </div>
                        <div class="mb-3 mt-3">
                            <p>Prix estimé: <span id="calculatedPrice">--</span></p>
                        </div>`;
        const heureDebut = document.getElementById("heureDebut");
        const heureFin = document.getElementById("heureFin");
        heureDebut.addEventListener("change", () => {
            reservation.heureDebut = heureDebut.value;
            console.log("Heure de début:", reservation.heureDebut);
            updatePrice();
            console.log("prix:", reservation.prix);
        });
        heureFin.addEventListener("change", () => {
            reservation.heureFin = heureFin.value;
            console.log("Heure de fin:", reservation.heureFin);
            updatePrice();
            console.log("prix:", reservation.prix);
        });
    });
    resJour.addEventListener("change", (e) => {
        e.preventDefault();
        console.log("CHANGEMENT DE JOUR");
        horairesRes.innerHTML = `<div id="resJourDiv" style="display:none;"></div>
                            <label for="dateDebut" class="form-label">Date de début:</label>
                            <input type="date" class="form-control" id="dateDebut" name="dateDebut">
                            
                            <label for="dateFin" class="form-label mt-2">Date de fin:</label>
                            <input type="date" class="form-control" id="dateFin" name="dateFin">
                        </div>
                        <div class="mb-3 mt-3">
                            <p>Prix estimé: <span id="calculatedPrice">--</span></p>
                        </div>`;
        const dateDebut = document.getElementById("dateDebut");
        const dateFin = document.getElementById("dateFin");

        dateDebut.addEventListener("change", () => {
            reservation.dateDebut = dateDebut.value;
            console.log("Date de début:", reservation.dateDebut);
            updatePrice();
        });
        dateFin.addEventListener("change", () => {
            reservation.dateFin = dateFin.value;
            console.log("Date de fin:", reservation.dateFin);
            updatePrice();
        });
    });

    reservationBtn.forEach(btn => {
        btn.addEventListener("click", async (e) => {
            reservation.parkingId = btn.getAttribute("data-pId");
            reservation.name = btn.getAttribute("data-name");
            console.log("ID du parking:", reservation.parkingId);
            e.preventDefault();
            console.log("Réservation en cours");
            horairesRes.innerHTML = "";
            choixPlace.innerHTML = "";
            editForm.reset();
            editModal.show();

        })
    })

    bookingBtn.addEventListener("click", async (e) => {
        e.preventDefault();
        const calculatedPrice = document.getElementById("calculatedPrice");
        console.log(reservation)
            
        if (!calculatedPrice) {
            console.log("Veuillez sélectionner un type de réservation et entrer les dates/heures.");
            return;
        }
        if (!reservation.vehicule || !reservation.place) {
            console.log("Veuillez sélectionner un véhicule et une place.");
            return;
        }
        if (!Number.isInteger(calculatedPrice.value)){
            console.log("non.");
        } else {
            editModal.hide();
            document.getElementById("recap-parking").textContent = reservation.name;
            if(reservation.type === "hour"){
                document.getElementById("recap-dates").textContent = reservation.heureDebut + " - " + reservation.heureFin;
            } else if (reservation.type === "day"){
                document.getElementById("recap-dates").textContent = reservation.dateDebut + " - " + reservation.dateFin;
            }
            document.getElementById("recap-total").textContent = reservation.prix + " €";
            paymentModal.show();
            document.getElementById('backBtn').addEventListener('click', (e) => {
                e.preventDefault();
                paymentModal.hide();
                editModal.show();
            });
        }
        
    });

    paymentBtn.addEventListener("click", async (e) => {
        e.preventDefault();
        console.log("Paiement en cours");
        paymentModal.hide();
        initStripePayment(reservation);

    });
        

    laterBtn.addEventListener("click", async (e) => {
        e.preventDefault();
        console.log("Réservation ultérieure");
        addReservation(
            reservation.parkingId,
            reservation.vehicule,
            reservation.place,
            reservation.type,
            reservation.heureDebut,
            reservation.heureFin,
            reservation.dateDebut,
            reservation.dateFin,
            reservation.prix
        )
    });



})