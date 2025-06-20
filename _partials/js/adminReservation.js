async function deleteReservation(reservationId) {
    const formData = new URLSearchParams();
    formData.append("reservationId", reservationId);
    const response = await fetch("index.php?component=adminReservation&action=delete", {
        method: "POST",
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: formData,
    });
    const data = await response.json();
    if (data.success) {
        alert(data.success);
        window.location.reload();
    } else {
        alert(data.error || "Une erreur s'est produite lors de la suppression de la réservation.");
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const deleteBtn = document.querySelectorAll(".delete");

    deleteBtn.forEach(btn => {
        btn.addEventListener("click", async (e) => {
            e.preventDefault();
            const reservationId = btn.getAttribute("data-id");
            if (confirm("Voulez vous vraiment supprimer cette réservation ?")) {
                deleteReservation(reservationId);
            }
        })
    })

})