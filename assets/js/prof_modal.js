'use strict';
const modal = document.getElementById("redModal"); 
const editButtons = document.querySelectorAll(".r"); 
const submitButton = document.querySelector(".but_sub");

function openModal(event) {
    event.preventDefault(); 
    modal.style.display = "block"; 
}

function closeModal() {
    modal.style.display = "none"; 
}

editButtons.forEach(button => {
    button.addEventListener("click", openModal);
});


submitButton.addEventListener("click", function(event) {
    event.preventDefault(); 
    
    const form = document.forms['red'];

    if (form.checkValidity()) {
        form.submit(); 
  
    } else {
        form.reportValidity(); 
        
      
    }
});
