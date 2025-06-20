const addParking = async(nom, adresse, description, nbPlacesVoitures, nbPlacesMotos, nbPlacesVelos, nbPlacesCamions, horaires, tarifPerHour, tarifPerDay) => {
    const formData = new URLSearchParams();
    formData.append("nom", nom);
    formData.append("adresse", adresse);
    formData.append("description", description);
    formData.append("nb_places_voiture", nbPlacesVoitures);
    formData.append("nb_places_moto", nbPlacesMotos);
    formData.append("nb_places_velo", nbPlacesVelos);
    formData.append("nb_places_camion", nbPlacesCamions);
    formData.append("horaires", horaires);
    formData.append("tarifperhour", tarifPerHour);
    formData.append("tarifperday", tarifPerDay);
    const response = await fetch("index.php?component=addParking", {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
        method: "POST",
        body: formData,
    })
    const data = await response.json();
    if (data.success) {
        alert(data.success);
        window.location.href = "index.php?component=adminParking";
    } else {
        alert(data.error);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("addParkingForm");
    

    form.addEventListener("submit", async(e) => {
        e.preventDefault();
        const nom = document.getElementById("nom");
        const adresse = document.getElementById("adresse");
        const description = document.getElementById("description");
        const nbPlacesVoitures = document.getElementById("nb_places_voiture");
        const nbPlacesMotos = document.getElementById("nb_places_moto");
        const nbPlacesVelos = document.getElementById("nb_places_velo");
        const nbPlacesCamions = document.getElementById("nb_places_camion");
        const horaires = document.getElementById("horaires");
        const tarifPerHour = document.getElementById("tarifperhour");
        const tarifPerDay = document.getElementById("tarifperday");

        addParking(
            nom.value,
            adresse.value,
            description.value,
            nbPlacesVoitures.value,
            nbPlacesMotos.value,
            nbPlacesVelos.value,
            nbPlacesCamions.value,
            horaires.value,
            tarifPerHour.value,
            tarifPerDay.value
        );


    })
});