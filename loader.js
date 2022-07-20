function loader(){
    if (document.readyState === 'complete') {
        console.log('loaded');
        setTimeout(() => style_handler(), 800);
    }
}

function style_handler(){
    let elem = document.getElementsByClassName("loader wrap");
    elem[0].style.opacity = 0;
    setTimeout(() => elem[0].remove(), 1000);
    
}