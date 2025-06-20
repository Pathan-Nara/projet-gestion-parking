import { evaluation } from "../utils/function";

async function notation(userId, parkingId, noteValue) {
    const formData = new URLSearchParams();
    formData.append("userId", userId);
    formData.append("parkingId", parkingId);
    formData.append("noteValue", noteValue);
    try {
        const response = await fetch("index.php?component=historiqueRes&action=notation", {
            method: "POST",
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: formData,
        });
        const data = await response.json();
        if (data.success) {
            alert("Note attribuée avec succès.");
            window.location.reload();
        } else {
            alert("Erreur lors de l'attribution de la note : " + data.message);
        }
    } catch(error){
        console.error("Erreur lors de l'attribution de la note :", error);
        alert("Une erreur s'est produite. Veuillez réessayer plus tard.");
    }
}

document.addEventListener("DOMContentLoaded", () => {

    const divNote = document.querySelectorAll("#note");

    document.querySelectorAll(".stars").forEach((stars ) => {
        console.log("Evaluation de la notation");
        evaluation(stars);
    });

    divNote.forEach(div =>{
        const noteBtn = div.querySelector("#notationBtn");
        const note = div.querySelector("#noteValue");
        noteBtn.addEventListener("click", async (e) => {
            e.preventDefault();
            const userId = div.getAttribute("data-user-id");
            const parkingId = div.getAttribute("data-parking-id");
            let noteValue = note.value;
            console.log("Note pour l'utilisateur avec l'ID :", userId);
            console.log("Note pour le parking avec l'ID :", parkingId);
            console.log("Valeur de la note :", noteValue);
            if (noteValue < 0 || noteValue > 5) {
                alert("La note doit être comprise entre 0 et 5.");
                return;
            }
            if(confirm("Voulez-vous attribuer la note de " + noteValue + " ?")) {
                notation(userId, parkingId, noteValue);
            }
        });

    })  



})