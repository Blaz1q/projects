function addd(vnumber){
    if(vnumber<10) return ("0"+vnumber);
    else return vnumber;
}
function iledni(nazwa,data){
    console.log(nazwa);
    console.log(data);
    var dataa = new Date(data).getTime();
    
    var odlicz = setInterval(function() {
    var dzis = new Date().getTime();
  
    var delta = dataa - dzis;
    var dni = Math.floor(delta / (1000 * 60 * 60 * 24));
    var h= Math.floor((delta % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var min = Math.floor((delta % (1000 * 60 * 60)) / (1000 * 60));
    var sek = Math.floor((delta % (1000 * 60)) / 1000);
    var sektext ="";
    sektext=addd(sek);
    mintext=addd(min);

    document.getElementById(nazwa).innerHTML = dni+"d "+h+"h "+mintext+"m "+sektext+"s ";
    if (delta < 0) {
      clearInterval(odlicz);
      document.getElementById(nazwa).innerHTML = "Termin minął";
    }
  }, 500);
}
var stop = false;
function stopp(o){
	if(o==0){
	document.getElementById('stopprosze').innerHTML = "<input type='submit' value='Rozpocznij'  onclick='stopp(1),stoper()' />";
	stop = true;
	}
	else{
		document.getElementById('stopprosze').innerHTML = "<input type='submit' value='Zatrzymaj'  onclick='stopp(0),stoper()' />";
		stop = false;
	}
	console.log(o);
}