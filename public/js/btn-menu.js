function showAndHideLink(){
    let link = document.getElementsByClassName("link");
    if(link[0].style.display == "none"){
        link[0].style.display = "flex";
    }
    else{
        link[0].style.display = "none";
    }
}