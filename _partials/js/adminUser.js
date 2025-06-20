
document.addEventListener("DOMContentLoaded", () => {
    const deleteBtn = document.querySelectorAll(".delete");
    const editBtn = document.querySelectorAll(".edit");
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));

    deleteBtn.forEach(btn => {
        btn.addEventListener("click", async (e) => {
            e.preventDefault();
            const confirmDelete = confirm("Voulez-vous vraiment supprimer cet utilisateur ?");
            if (!confirmDelete) {
                return;
            }
            const userId = btn.getAttribute("data-id");
            const formData = new URLSearchParams();
            formData.append("userId", userId);
            const response = await fetch("index.php?component=adminUser&action=delete", {
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
                alert(data.error || "Une erreur s'est produite lors de la suppression de l'utilisateur.");
            }
        });
    });
    editBtn.forEach(btn => {
        btn.addEventListener("click", async (e) => {
            e.preventDefault();
            const userId = btn.getAttribute("data-id");
            const formData = new URLSearchParams();
            formData.append("userId", userId);
            const response = await fetch("index.php?component=adminUser&action=getUser", {
                method: "POST",
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: formData,
            });
            const data = await response.json();
            const user = data.user;
            editModal.show();
            const editForm = document.getElementById("editForm");
            editForm.querySelector("#nom").value = user.nom;
            editForm.querySelector("#prenom").value = user.prenom;
            editForm.querySelector("#email").value = user.email;
            editForm.querySelector("#isAdmin").checked = user.is_admin === 1;
            editForm.querySelector("#isPremium").checked = user.is_premium === 1;

            const updateUser = document.getElementById("updateUser");
            updateUser.addEventListener("click", async (e) => {
                e.preventDefault();
                const formData = new URLSearchParams();
                formData.append("userId", userId);
                formData.append("nom", editForm.querySelector("#nom").value);
                formData.append("prenom", editForm.querySelector("#prenom").value);
                formData.append("email", editForm.querySelector("#email").value);
                formData.append("isAdmin", editForm.querySelector("#isAdmin").checked ? 1 : 0);
                formData.append("isPremium", editForm.querySelector("#isPremium").checked ? 1 : 0);
                formData.append("password", editForm.querySelector("#password").value);
                const updateResponse = await fetch("index.php?component=adminUser&action=update", {
                    method: "POST",
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: formData,
                });
                const updateData = await updateResponse.json();
                console.log(updateData);
                if (updateData.success) {
                    alert(updateData.success);
                    window.location.reload();
                } else {
                    alert(updateData.error || "Une erreur s'est produite lors de la mise à jour de l'utilisateur.");
                }
            });
        })
    });
});