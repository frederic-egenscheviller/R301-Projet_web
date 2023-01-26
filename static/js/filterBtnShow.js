document.getElementById("ingredientsBtn").addEventListener("click", function() {
    toggleVisibility("dropIngredients");
});
document.getElementById("utensilsBtn").addEventListener("click", function() {
    toggleVisibility("dropUtensils");
});

document.getElementById("cookingTypesBtn").addEventListener("click", function() {
    toggleVisibility("dropTypes");
});
document.getElementById("difficultiesBtn").addEventListener("click", function() {
    toggleVisibility("dropDifficulties");
});
document.getElementById("costsBtn").addEventListener("click", function() {
    toggleVisibility("dropCosts");
});
document.getElementById("particularitiesBtn").addEventListener("click", function() {
    toggleVisibility("dropParticularities");
});

function toggleVisibility(id) {
    let element = document.getElementById(id);
    if (element.style.visibility === "visible") {
        element.style.visibility = "hidden";
    } else {
        element.style.visibility = "visible";
    }
}