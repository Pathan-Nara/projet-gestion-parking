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
    if( action === "edit" ){
        console.log(info);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const deleteCarBtn = document.querySelectorAll(".delete");
    const editCarBtn = document.querySelectorAll(".edit");

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

        });
    })
});