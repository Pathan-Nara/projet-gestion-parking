const action = async(id, action, info = null) =>{
    if (action == "delete") {
        const formData = new URLSearchParams();
        formData.append("carId", id);
        const response = await fetch("index.php?component=adminCar&action=delete", {
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
            alert(data.error || "Erreur lors de la suppression de la voiture.");
        }
    }

    if (action === "getCar") {
        const formData = new URLSearchParams();
        formData.append("carId", id);
        const response = await fetch("index.php?component=adminCar&action=getCar", {
            method: "POST",
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: formData,
        });
        const data = await response.json();
        return data.car;
    }

    if( action === "edit" ){
        const formData = new URLSearchParams();
        formData.append("carId", id);
        formData.append("model", info.model);
        formData.append("marque", info.marque);
        formData.append("type", info.type);
        formData.append("imatriculation", info.imatriculation);
        formData.append("motorisation", info.motorisation);
        formData.append("user_id", info.user_id);

        const response = await fetch("index.php?component=adminCar&action=edit", {
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
            alert(data.error || "Erreur lors de la modification de la voiture.");
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const deleteCarBtn = document.querySelectorAll(".delete");
    const editCarBtn = document.querySelectorAll(".edit");
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));

    deleteCarBtn.forEach(btn => {
        btn.addEventListener("click", async (e) => {
            e.preventDefault();
            const confirmDelete = confirm("Voulez-vous vraiment supprimer cette voiture ?");
            if (!confirmDelete) {
                return;
            }
            const carId = btn.getAttribute("data-id");
            action(carId, "delete");
        });
    })
    editCarBtn.forEach(btn => {
        btn.addEventListener("click", async (e) => {
            e.preventDefault();
            const carId = btn.getAttribute("data-id");
            const editBtn = document.getElementById("modalUpdate");
            car = (await action(carId, "getCar"))[0];
            console.log(car);
            editModal.show();
            const editForm = document.getElementById("editCarForm");
            const model = editForm.querySelector("#editModel");
            const marque = editForm.querySelector("#editMarque");
            const type = editForm.querySelector("#editType");
            const immatriculation = editForm.querySelector("#editImatriculation");
            const motorisation = editForm.querySelector("#editMotorisation");
            const proprio = editForm.querySelector("#editProprio");
            model.value = car.model;
            marque.value = car.marque;
            type.value = car.type;
            immatriculation.value = car.imatriculation;
            motorisation.value = car.motorisation;
            proprio.value = car.user_id;

            editBtn.addEventListener("click", async (e) => {
                e.preventDefault();
                const formData = new URLSearchParams();
                formData.append("carId", carId);
                formData.append("model", model.value);
                formData.append("marque", marque.value);
                formData.append("type", type.value);
                formData.append("imatriculation", immatriculation.value);
                formData.append("motorisation", motorisation.value);
                const info = {
                    model: model.value,
                    marque: marque.value,
                    type: type.value,
                    imatriculation: immatriculation.value,
                    motorisation: motorisation.value,
                    user_id: proprio.value
                };
                action(carId, "edit", info);
            })
        });
    })
});