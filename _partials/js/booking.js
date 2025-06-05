import { evaluation } from "../utils/function";

document.addEventListener("DOMContentLoaded", () => {
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));
    const editForm = document.getElementById("editForm");
    const reservationBtn = document.querySelectorAll(".reservation");
    const resHeure = document.getElementById("resHeure");
    const resJour = document.getElementById("resJour");
    const horairesRes = document.getElementById("horairesRes");

    document.querySelectorAll(".stars").forEach((stars ) => {
        console.log("Evaluation de la notation");
        evaluation(stars );
    });

    
    resHeure.addEventListener("change", (e) => {
        e.preventDefault();
        console.log("CHANGEMENT D'HEURE");
        horairesRes.innerHTML = `<div id="resHeureDiv" style="display:none;"></div>
                            <label for="heureDebut" class="form-label">Heure de début:</label>
                            <input type="time" class="form-control" id="heureDebut" name="heureDebut">
                            
                            <label for="heureFin" class="form-label mt-2">Heure de fin:</label>
                            <input type="time" class="form-control" id="heureFin" name="heureFin">
                        </div>`;
    });
    resJour.addEventListener("change", (e) => {
        e.preventDefault();
        console.log("CHANGEMENT DE JOUR");
        horairesRes.innerHTML = `<div id="resJourDiv" style="display:none;"></div>
                            <label for="dateDebut" class="form-label">Date de début:</label>
                            <input type="date" class="form-control" id="dateDebut" name="dateDebut">
                            
                            <label for="dateFin" class="form-label mt-2">Date de fin:</label>
                            <input type="date" class="form-control" id="dateFin" name="dateFin">
                        </div>`;
    });

    reservationBtn.forEach(btn => {
        btn.addEventListener("click", async (e) => {
            e.preventDefault();
            console.log("Réservation en cours");
            horairesRes.innerHTML = "";
            editForm.reset();
            editModal.show();

        })
    })

});