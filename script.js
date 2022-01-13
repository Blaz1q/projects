var tick = new Audio("tick.mp3");
function addd(vnumber){
    if(vnumber<10) return ("0"+vnumber);
    else return vnumber;
}
function losuj(min,max){
  var pick = Math.floor(Math.random() * (max - min + 1)) + min;
  var interval=20;
  var roll=36;
  var j=0;
  for(var i=0;i<150;i++){
    interval+=(20*(i*i*i)*0.00001);
      setTimeout(() => {
      j++;
      pick = Math.floor(Math.random() * (max - min + 1)) + min;
      if(j==150) pick = roll;
      document.getElementById('losowanie').innerHTML = "<h1 class='logo-1'>"+pick+"</h1>";
      }, interval);
}
function preroll(number){
  document.getElementById('losowanie').innerHTML = "<h1 class='logo-1'>"+number+"</h1>";
  }
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
	htext=addd(h);
	dtext=addd(dni);
	if(sek%1==0)tick.play();
	if(dni==0)
	{
		document.getElementById(nazwa).innerHTML = htext+"h "+mintext+"m "+sektext+"s ";
		if(h==0){
			document.getElementById(nazwa).innerHTML = mintext+"m "+sektext+"s ";
				if(min==0) document.getElementById(nazwa).innerHTML = sektext+"s ";
		}
	}
    else document.getElementById(nazwa).innerHTML = dni+"d "+htext+"h "+mintext+"m "+sektext+"s ";
    if (delta < 0) {
      clearInterval(odlicz);
      document.getElementById(nazwa).innerHTML = "Matrix";
      losuj(1,39);
    }
  }, 500);
}
