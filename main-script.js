var helper;
window.addEventListener("scroll", function() {
    if(helper){
        var elementTarget = document.getElementsByClassName("header")[0];
        var elemT2 = document.getElementsByClassName("trigger")[0];
        var showelem = document.getElementsByClassName("container")[0];
        if (window.scrollY+200 > (elementTarget.offsetTop + elementTarget.offsetHeight)) {
            document.getElementsByClassName("menu")[0].classList.remove("transparent");
            document.getElementsByClassName("menu")[0].style = null;
        }
        else if(window.scrollY+400 > (elemT2.offsetTop + elemT2.offsetHeight)){
            document.getElementsByClassName("menu")[0].style.opacity = 0;
        }
        else{
            document.getElementsByClassName("menu")[0].classList.add("transparent");
            document.getElementsByClassName("menu")[0].style = null;
        }
        if(window.scrollY+200*3 > (showelem.offsetTop + showelem.offsetHeight)){
            var x = document.getElementsByClassName("before_shown");
            for(var i=0;i<x.length;i++){
                x[i].classList.remove("before_shown");
            }
        }
    }
});