var tick = new Audio("tick.mp3");
function addd(vnumber){
    if(vnumber<10) return ("0"+vnumber);
    else return vnumber;
}
function losuj(min,max){
  var pick = Math.floor(Math.random() * (max - min + 1)) + min;
  var interval=20;
  for(var i=0;i<150;i++){
    interval+=(20*(i*i*i)*0.00001);
    pick = Math.floor(Math.random() * (max - min + 1)) + min;
    
    setTimeout(() => {
      pick = Math.floor(Math.random() * (max - min + 1)) + min;
      document.getElementById('losowanie').innerHTML = "<h1 class='logo-1'>"+pick+"</h1>";
      console.log(pick);
  }, interval);
}

}

function rolldice()
{
var ranNum = Math.floor( 1 + Math.random() * 6 );
document.getElementById("dice").innerHTML = ranNum;

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
      losuj(0,39);
    }
  }, 500);
}
