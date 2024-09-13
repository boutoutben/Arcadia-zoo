function showAndHideLink(){
    let link = document.getElementsByClassName("link");
    if(link[0].classList.contains("visible") ){
        link[0].classList.remove("visible");
    }
    else{
        link[0].classList.add("visible");
    }
}