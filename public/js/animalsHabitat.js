
function presentation(id, nbAnimal, idAnimal)
{
        let presentation = document.getElementsByClassName(`presentation_animaux`);
        presentation[(id)%nbAnimal].classList.remove("hidden");
        presentation[(id)%nbAnimal].classList.add('visible'); 
        window.location.href = `../click/${idAnimal}`;
        
}

function hiddenPresentation(id, nbAnimal)
{
        let presentation = document.getElementsByClassName("presentation_animaux");
        presentation[(id)%nbAnimal].classList.remove("visible");
        presentation[(id)%nbAnimal].classList.add("hidden");
}

