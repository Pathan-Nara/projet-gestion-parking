
document.addEventListener("DOMContentLoaded", () => {
    const deleteBtn = document.querySelectorAll(".delete");
    const editBtn = document.querySelectorAll(".edit");
    // const editModal = new bootstrap.Modal(document.getElementById('editModal'));

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
});