<!-- iShow W3 Contact Bar -->

<!-- responsive contact bar folding -->
function fold_contact_buttons(){
	var x = document.getElementById("contact-bar");
	if (x.className === "contact-bar") {
		x.className += " responsive";
	} else {
		x.className = "contact-bar";
	}
}

