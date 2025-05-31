

document.addEventListener("DOMContentLoaded", () => {
    const model = document.getElementById("model");
    const marque = document.getElementById("marque");
    const type = document.getElementById("type");
    const imatriculation = document.getElementById("imatriculation");
    const motorisation = document.getElementById("motorisation");
    const userId = document.getElementById("proprio");
    const addCarBtn = document.getElementById("addCarBtn");
    

    addCarBtn.addEventListener("click", async (e) => {
        e.preventDefault();
        const formData = new URLSearchParams();
        formData.append("model", model.value);
        formData.append("marque", marque.value);
        formData.append("type", type.value);
        formData.append("imatriculation", imatriculation.value);
        formData.append("motorisation", motorisation.value);
        formData.append("userId", userId.value);
        const response = await fetch("index.php?component=adminAddCar", {
            method: "POST",
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: formData,
        });
        const data = await response.json();
        if (data.success) {
            alert(data.success);
            window.location.href = "index.php?component=adminCar";
        } else {
            alert(data.error || "Une erreur s'est produite lors de l'ajout de la voiture.");
        }
    });
})