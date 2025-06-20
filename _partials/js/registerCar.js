const registerCar = async (modele, marque, immatruculation, motorisation, type) => {
    const formData = new URLSearchParams();
    formData.append("modele", modele);
    formData.append("marque", marque);
    formData.append("immatriculation", immatruculation);
    formData.append("motorisation", motorisation);
    formData.append("type", type);

    const response = await fetch("index.php?component=registerCar", {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
        method: "POST",
        body: formData,
    });
    const data = await response.json();
    alert(data['success'] || data['error'] || "An error occurred");
    return data;
}


document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("registerCar");
    const modele = document.getElementById("modele");
    const marque = document.getElementById("marque");
    const immatriculation = document.getElementById("immatriculation");
    const motorisation = document.getElementById("motorisation");
    const type = document.getElementById("type");

    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        registerCar(modele.value, marque.value, immatriculation.value, motorisation.value, type.value)
        window.location.href = "index.php?component=home";
    })
});