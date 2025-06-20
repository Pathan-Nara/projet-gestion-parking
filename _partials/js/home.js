async function getReservations(reservationId) {
    const formData = new URLSearchParams();
    formData.append("id", reservationId);
    try {
        const response = await fetch("index.php?component=home&action=getReservations", {
            method: "POST",
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: formData
        });
        const data = await response.json();
        if (data.success) {
            return data.reservation;
        }
    }
    catch (error) {
        console.error("Erreur lors de la récupération des réservations :", error);
        alert("Une erreur s'est produite. Veuillez réessayer plus tard.");
    }
}

async function initStripePayment(reservationId, prix) {
    const stripe = Stripe(PUBLIC_STRIPE);
    const formData = new URLSearchParams();
    formData.append("id", reservationId);
    formData.append("prix", prix);

    try {
        const response = await fetch("index.php?component=home&action=payment", {
            method: "POST",
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: formData
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
        console.error("Erreur lors de l'initialisation du paiement Stripe :", error);
        alert("Une erreur s'est produite. Veuillez réessayer plus tard.");
    }

}

async function cancelReservation(reservationId, placeId) {
    const formData = new URLSearchParams();
    formData.append("placeId", placeId);
    formData.append("id", reservationId);

    try {
        const response = await fetch("index.php?component=home&action=cancel", {
            method: "POST",
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: formData,
        });
        const data = await response.json();
        if (data.success) {
            alert("Réservation annulée avec succès.");
            window.location.reload();
        } else {
            alert("Erreur lors de l'annulation de la réservation : " + data.message);
        }
    } 
    catch(error){
        console.error("Erreur lors de l'annulation de la réservation :", error);
        alert("Une erreur s'est produite. Veuillez réessayer plus tard.");
    }
}

async function archive(reservationId) {
    const formData = new URLSearchParams();
    formData.append("id", reservationId);
    try {
        const response = await fetch("index.php?component=home&action=archive", {
            method: "POST",
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: formData,
        });
        const data = await response.json();
        if (data.success) {
            alert("Réservation archivée avec succès.");
            window.location.reload();
        } else {
            alert("Erreur lors de l'archivage de la réservation : " + data.message);
        }
    } 
    catch(error){
        console.error("Erreur lors de l'archivage de la réservation :", error);
        alert("Une erreur s'est produite. Veuillez réessayer plus tard.");
    }
}


document.addEventListener("DOMContentLoaded", () => {
    const addReservationBtn = document.getElementById("addReservationBtn");
    const cancelBtn = document.querySelectorAll("#cancel");
    const archiveBtn = document.querySelectorAll("#archived");
    const bookBtn = document.querySelectorAll("#book");

    addReservationBtn.addEventListener("click", () => {
        window.location.href = "?component=booking";
    });

    cancelBtn.forEach(button => {
        button.addEventListener("click", async (e) => {
            e.preventDefault();
            if (confirm("Voulez-vous vraiment annuler cette réservation ?")) {
                const reservationId = button.getAttribute("data-reservation-id");
                const placeId = button.getAttribute("data-place-id");
                console.log("Annulation de la réservation avec l'ID :", reservationId);
                console.log("ID de la place :", placeId);
                cancelReservation(reservationId, placeId);
            }
        });
    });

    archiveBtn.forEach(button => {
        button.addEventListener("click", async (e) => {
            e.preventDefault();
            if (confirm("Voulez-vous vraiment archiver cette réservation ?")) {
                const reservationId = button.getAttribute("data-reservation-id");
                archive(reservationId);
            }
        });
    });

    bookBtn.forEach(button => {
        button.addEventListener("click", async (e) => {
            e.preventDefault();
            const reservationId = button.getAttribute("data-reservation-id");
            reservation = await getReservations(reservationId)
            console.log(reservation);
            const prix = reservation.prix;

            initStripePayment(reservationId, prix)
            
        });
    });
    
});