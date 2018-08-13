function afficher( ref, type ) {
var region = ref.id.charAt(1);
document.getElementById(region).classList.add("Noir");
}
function masquer( ref, type ) {
var region = ref.id.charAt(1);
document.getElementById(region).classList.remove("Noir");
}