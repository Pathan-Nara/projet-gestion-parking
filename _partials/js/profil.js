import { validateEmail, checkPassword } from "../utils/function.js";

async function updateAccount(nom, prenom, email, password){
    const formData = new URLSearchParams();
    formData.append("nom", nom);
    formData.append("prenom", prenom);
    formData.append("email", email);
    formData.append("currentPassword", password);

    const response = await fetch("index.php?component=profil&action=updateProfile", {
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
        alert(data.error || "Une erreur s'est produite lors de la mise à jour du profil.");
    }
    return data;
}

async function updatePassword(currentPassword, newPassword) {
    const formData = new URLSearchParams();
    formData.append("currentPassword", currentPassword);
    formData.append("newPassword", newPassword);

    const response = await fetch("index.php?component=profil&action=updatePassword", {
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
        alert(data.error || "Une erreur s'est produite lors de la mise à jour du mot de passe.");
    }
}

async function getCar(carId) {
    const formData = new URLSearchParams();
    formData.append("carId", carId);
    const response = await fetch("index.php?component=profil&action=getCar", {
        method: "POST",
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: formData,
    });
    const data = await response.json();
    if (data.success) {
        return data.car;
    }
    else {
        alert(data.error || "Une erreur s'est produite lors de la récupération des informations de la voiture.");
        return null;
    }
}

async function deleteAccount(password) {
    const formData = new URLSearchParams();
    formData.append("password", password);

    const response = await fetch("index.php?component=profil&action=deleteAccount", {
        method: "POST",
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: formData,
    });
    const data = await response.json();
    if (data.success) {
        alert(data.success);
        window.location.href = "index.php?deconnect";;
    } else {
        alert(data.error || "Une erreur s'est produite lors de la suppression du compte.");
    }
    return data;
}

async function deleteCar(carId) {
    const formData = new URLSearchParams();
    formData.append("carId", carId);

    const response = await fetch("index.php?component=profil&action=deleteCar", {
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
        alert(data.error || "Une erreur s'est produite lors de la suppression de la voiture.");
    }
}

async function updateCar(carId, type, marque, model, immatriculation, motorisation) {
    const formData = new URLSearchParams();
    formData.append("carId", carId);
    formData.append("type", type);
    formData.append("marque", marque);
    formData.append("model", model);
    formData.append("immatriculation", immatriculation);
    formData.append("motorisation", motorisation);
    const response = await fetch("index.php?component=profil&action=updateCar", {
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
        alert(data.error || "Une erreur s'est produite lors de la mise à jour de la voiture.");
    }
    return data;
}

document.addEventListener("DOMContentLoaded", () => {

    const nom = document.getElementById("nom");
    const prenom = document.getElementById("prenom");
    const email = document.getElementById("email");
    const password = document.getElementById("current-password");
    const newPassword = document.getElementById("new-password");
    const confirmPassword = document.getElementById("confirm-password");
    const deleteAccountBtn = document.getElementById("delete-account");
    const updateProfileBtn = document.getElementById("update-profile");
    const editCarBtn = document.querySelectorAll("#editCar");
    const deleteCarBtn = document.querySelectorAll("#deleteCar");
    const editModal = new bootstrap.Modal(document.getElementById("editCarModal"));
    const updateBtn = document.querySelector("#modalUpdate");
    const backBtn = document.querySelector("#modalBack");

    let carId = null;

    updateProfileBtn.addEventListener("click", async (e) => {
        e.preventDefault();
        if (nom.value === "" || prenom.value === "" || email.value === "") {
            alert("Veuillez remplir tous les champs.");
            return;
        }
        else if(!checkPassword(newPassword.value)){
            alert(checkPassword(newPassword.value));
            return;
        }
        else if (!validateEmail(email.value)) {
            alert("Format d'email invalide.");
            return;
        }
        else if (password.value === "" && newPassword.value == "" && confirmPassword.value == "") {
            alert("Veuillez entrer votre mot de passe actuel pour mettre à jour votre profil.");
            return;
        }
        else if( password.value !== "" && newPassword.value === "" && confirmPassword.value === "") {
            updateAccount(nom.value, prenom.value, email.value, password.value);
            return;
        }
        else if (checkPassword(newPassword.value) === false) {
            alert(checkPassword(newPassword.value));
            return;
        }

        else if (newPassword.value !== confirmPassword.value) {
            alert("Les mots de passe ne correspondent pas.");
            return;
        }

        else{
            // updateAccount(nom.value, prenom.value, email.value, password.value);
            updatePassword(password.value, newPassword.value)
        }

        
    })

    deleteAccountBtn.addEventListener("click", async (e) => {
        e.preventDefault();
        if( password.value === "") {
            alert("Veuillez entrer votre mot de passe actuel pour supprimer votre compte.");
            return;
        }
        if (confirm("Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.")) {
            deleteAccount(password.value);
        }
    });

    editCarBtn.forEach(btn => {
        btn.addEventListener("click", async (e) => {
            e.preventDefault();
            carId = btn.getAttribute("data-carId");
            console.log(carId);
            const carData = await getCar(carId);
            console.log(carData);
            editModal.show();
            const editForm = document.getElementById("edit-car-form");
            const type = editForm.querySelector("#edit-vehicle-type");
            const marque = editForm.querySelector("#edit-vehicle-marque");
            const model = editForm.querySelector("#edit-vehicle-modele");
            const immatriculation = editForm.querySelector("#edit-vehicle-immatriculation");
            const motorisation = editForm.querySelector("#edit-vehicle-motorisation");
            
            type.value = carData.type;
            marque.value = carData.marque;
            model.value = carData.model;
            immatriculation.value = carData.imatriculation;
            motorisation.value = carData.motorisation;
            
        });
    });

    updateBtn.addEventListener("click", async (e) => {
        e.preventDefault();
        console.log("Update button clicked");
        const editForm = document.getElementById("edit-car-form");
        const type = editForm.querySelector("#edit-vehicle-type");
        const marque = editForm.querySelector("#edit-vehicle-marque");
        const model = editForm.querySelector("#edit-vehicle-modele");
        const immatriculation = editForm.querySelector("#edit-vehicle-immatriculation");
        const motorisation = editForm.querySelector("#edit-vehicle-motorisation");
        if (type.value === "" || marque.value === "" || model.value === "" || immatriculation.value === "" || motorisation.value === "") {
            alert("Veuillez remplir tous les champs.");
            return;
        }
        updateCar(carId, type.value, marque.value, model.value, immatriculation.value, motorisation.value);
        editModal.hide();
    });

    deleteCarBtn.forEach(btn => {
        btn.addEventListener("click", async (e) => {
            e.preventDefault();
            const carId = btn.getAttribute("data-carId");
            if (confirm("Êtes-vous sûr de vouloir supprimer cette voiture ?")) {
                deleteCar(carId);
            }
        });
    });

    backBtn.addEventListener("click", (e) => {
        e.preventDefault();
        editModal.hide();
    });

});