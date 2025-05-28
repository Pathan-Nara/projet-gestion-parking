

document.addEventListener("DOMContentLoaded", () => {
    const deleteBtn = document.querySelectorAll(".delete");
    const editBtn = document.querySelectorAll(".edit");
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));
    const updateBtn = document.getElementById("modalUpdate");

    deleteBtn.forEach(btn=>{
        btn.addEventListener("click", async (e) =>{
            e.preventDefault();
            const confirmDelete = confirm("Voulez vous vraiment supprimer ce parking ?");
            if (!confirmDelete) {
                return;
            }
            const parkingId = btn.getAttribute("data-id");
            const formData = new URLSearchParams();
            formData.append("parkingId", parkingId);
            const response = await fetch("index.php?component=adminParking&action=delete",{
                method: "POST",
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: formData,
            })
            const data = await response.json();
            if (data.success) {
                alert(data.success);
                window.location.reload();
            } else {
                alert(data.error || "An error occurred while deleting the parking.");
            }
        })
    })

    editBtn.forEach(btn=>{
        btn.addEventListener("click", async (e) =>{
            e.preventDefault();
            const parkingId = btn.getAttribute("data-id");
            const formData = new URLSearchParams();
            formData.append("parkingId", parkingId);
            const response = await fetch("index.php?component=adminParking&action=getParking", {
                method: "POST",
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: formData,
            });
            const data = await response.json();
            const parking = data.parking;
            const tarif = data.tarif;
            console.log(parking);
            console.log(tarif);
            const editForm = document.getElementById("editParkingForm");
            console.log(parking.nom);
            editForm.querySelector("#editNom").value = parking.nom;
            editForm.querySelector("#editAdresse").value = parking.lieu;
            editForm.querySelector("#editDescription").value = parking.description;
            editForm.querySelector("#editNbPlacesVoitures").value = parking.nb_places_voiture;
            editForm.querySelector("#editNbPlacesMotos").value = parking.nb_places_moto;
            editForm.querySelector("#editNbPlacesVelos").value = parking.nb_places_velo;
            editForm.querySelector("#editNbPlacesCamions").value = parking.nb_places_camion;
            editForm.querySelector("#editHoraires").value = parking.horaires;
            editForm.querySelector("#editTarifPerHour").value = tarif.prix_par_heure;
            editForm.querySelector("#editTarifPerDay").value = tarif.prix_par_jour;
            editModal.show();
            updateBtn.addEventListener("click", async (e) => {
                e.preventDefault();
                const name = editForm.querySelector("#editNom").value 
                const adresse = editForm.querySelector("#editAdresse").value
                const desc = editForm.querySelector("#editDescription").value
                const nbVoit = editForm.querySelector("#editNbPlacesVoitures").value
                const nbMoto = editForm.querySelector("#editNbPlacesMotos").value
                const nbVelo = editForm.querySelector("#editNbPlacesVelos").value
                const nbCamion = editForm.querySelector("#editNbPlacesCamions").value
                const horaires = editForm.querySelector("#editHoraires").value
                const tarifHour = editForm.querySelector("#editTarifPerHour").value
                const tarifDay = editForm.querySelector("#editTarifPerDay").value
                const parkingId = btn.getAttribute("data-id");
                const formData = new URLSearchParams();
                formData.append("parkingId", parkingId);
                formData.append("nom", name);
                formData.append("adresse", adresse);
                formData.append("description", desc);
                formData.append("nb_places_voiture", nbVoit);
                formData.append("nb_places_moto", nbMoto);
                formData.append("nb_places_velo", nbVelo);
                formData.append("nb_places_camion", nbCamion);
                formData.append("horaires", horaires);
                formData.append("tarifperhour", tarifHour);
                formData.append("tarifperday", tarifDay);
                const response = await fetch("index.php?component=adminParking&action=edit", {
                    method: "POST",
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: formData,
                });
                const data = await response.json();
                if (data.success) {
                    alert(data.success);
                    editModal.hide();
                    window.location.reload();
                } else {
                    alert(data.error || "An error occurred while updating the parking.");
                }
            });

        })
    })
    
});