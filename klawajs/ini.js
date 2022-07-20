/* 
---------Functions i use---------
Math.random()
Math.floor()
Number().toString()
parseInt()


---------TO DO---------
array working - Y
-calc hue - Y
-random hue - Y
-random s - Y
-random l - Y
-hsl to rgb - Y
-rgb to hex - Y
-letters to uppercase (probably can to that in style) - N
-figure out save to file - N
-why files don't work corectly - N
-use *CLASSES*
*/
//disable every console.log; use this instead console.log
const conlog = true;
console.log("console.log?: "+conlog);
function conslog(text){
    if(conlog) console.log(text);
}
//move text
function movepls(text,num){
    text = text.substr(num) + text.substr(0, num);
    return text;
}
//max value
function selectmax(tab){
    var maxval = 0;
    for(var i=0;i<tab.length;i++){
        if(tab[i]>maxval) maxval = tab[i];
    }
    return maxval;
}
//min value
function selectmin(tab){
    var minval = 255;
    for(var i=0;i<tab.length;i++){
        if(tab[i]<minval) minval = tab[i];
    }
    return minval;
}
//hsl to rgb conversion
function hsl_rgb(hsl){
    var C = (1-Math.abs(2*hsl[2]-1))*hsl[1];
    var x = C *(1-(Math.abs((hsl[0]/60)%2-1)));
    var m = hsl[2] - C/2;
    var r,g,b;
    if(hsl[0]>=0&&hsl[0]<60){r=C;g=x;b=0;}
    if(hsl[0]>=60&&hsl[0]<120){r=x;g=C;b=0;}
    if(hsl[0]>=120&&hsl[0]<180){r=0;g=C;b=x;}
    if(hsl[0]>=180&&hsl[0]<240){r=0;g=x;b=C;}
    if(hsl[0]>=240&&hsl[0]<300){r=x;g=0;b=C;}
    if(hsl[0]>=300&&hsl[0]<360){r=C;g=0;b=x;}
    r+=m;
    g+=m;
    b+=m;
    r= Math.floor(r*255);
    g= Math.floor(g*255);
    b= Math.floor(b*255);
    var tab = [r,g,b];
    return tab;
}
//hex to rgb conversion
function hex_rgb(string){
    var skipchar = 0;
    if(string.length==7) skipchar=1;
    rgb = [];
    for(var i=0;i<3;i++){
        rgb[i] = parseInt(string.slice(i*2+skipchar,i*2+2+skipchar), 16);
    }
    return rgb;
}
//calc hue
function calchueradius(interval,hue){
    var x=0;//range of hue
	var y=0;
    conslog("hue"+hue);
    conslog("interval"+interval);
    if((hue-interval)<0){
        x=hue;
		conslog("1");
    }
    else x=hue-interval;
    if((hue+interval)>360){
        y=hue;
		conslog("2");
    }
    else y=hue+interval;

    var tab = [x,y];

	conslog("??"+tab);
    return tab;
}
function randhsl(radius){
    var h = Math.floor(Math.random() * (radius[1] - radius[0])) + radius[0];
    var s = Math.random()*0.2+0.8;
    var l = Math.random()*0.7+0.3;
    var tab = [h,s,l];
    return tab;
}
function hue(color,delta,maxvalue){
    var h;
    if(delta==0) return 0;
    if (maxvalue == color[0])      h=     (color[1] - color[2]) /delta;
    else if (maxvalue == color[1]) h= 2 + (color[2] - color[0]) /delta;
    else                           h= 4 + (color[0] - color[1]) /delta;
    h *= 60;
    conslog(h);
    if (h < 0) h+=360; 
    h = Math.floor(h);
    return h;
}
//generate color values
function randgen(){
    strr = "";
    for(var k=0;k<3;k++){
        randomm=Math.floor(Math.random()*256);
        strr += Number(randomm).toString(16);
    }
    while(strr.length<6){
        conslog("//"+strr);
        strr = "";
        for(var k=0;k<3;k++){
            randomm=Math.floor(Math.random()*256);
            strr += Number(randomm).toString(16);
        }
    }
    conslog(strr);
    return strr;
}
function randgenhsl(values){
    strr="";
    strr1="";
    strr2="";
    strr3="";
    strr1 += Number(values[0]).toString(16);
    strr2 += Number(values[1]).toString(16);
    strr3 += Number(values[2]).toString(16);
    if(strr1.length==1){strr1+='0'; strr1=movepls(strr1,1);}
    if(strr2.length==1){strr2+='0'; strr2=movepls(strr2,1);}
    if(strr3.length==1){strr3+='0'; strr3=movepls(strr3,1);}
    strr=strr1+strr2+strr3;
    return strr;
}
//file start
function funstart(filename,frames,duration){
    document.getElementById('right-2').innerHTML += addc("ins","&ltRoot&gt")+"</br>";
    document.getElementById('right-2').innerHTML += addc("ins","&ltDescription&gtckAnimation:")+"</br>";
    document.getElementById('right-2').innerHTML += addc("ins","File '"+filename+"' Made By Blaz1")+"</br>";
    document.getElementById('right-2').innerHTML += addc("ins","FrameCount:"+frames+" Displaytime:"+duration)+"</br>";
    document.getElementById('right-2').innerHTML += addc("ins","&lt/Description&gt")+"</br>";
    document.getElementById('right-2').innerHTML += addc("ins","&ltTime&gt0&lt/Time&gt")+"</br>";
    document.getElementById('right-2').innerHTML += addc("ins","&ltBackgroundColor&gt000000&lt/BackgroundColor&gt")+"</br>";
    document.getElementById('right-2').innerHTML += addc("ins","&ltFrameCount&gt"+frames+"&lt/FrameCount&gt")+"</br>";
}
function addc(znak,text){
    return "<"+znak+">"+text+"</"+znak+">";
}
function addcc(znak,clasa){
    return "<"+znak+clasa+"></"+znak+">";
}
//checks if every input is filled
function checkifgood(){
    var x = document.getElementById('frames').value;
    var y = document.getElementById('duration').value;
    var z = document.getElementById('filename').value;
    if(x==""||y==""||z=="") {conslog('error'); return false; }
    else {conslog('good'); return true;}
}
function generate(){
    if(checkifgood()){
        //all variables
        var frames = parseInt(document.getElementById('frames').value);
        var duration = document.getElementById('duration').value;
        var filename = document.getElementById('filename').value;
        var select = document.getElementById('select').value;
        var strr = "";
        var tab = [];
        //------------------------------------------------
        document.getElementById('right-2').innerHTML = "";
        document.getElementById('right-1').innerHTML = "";
        funstart(filename,frames,duration);
        switch(select){
            case 'default':
			
                for(var i=0; i<=frames; i++){
                    document.getElementById('right-2').innerHTML += addc("ins","&ltFrame"+i+"&gt")+"</br>";
                    document.getElementById('right-2').innerHTML += addc("ins","&ltColorPicture&gt")+"</br>";
                    tab[i] = [];
                    strr="";
                    for(var j=0;j<106;j++){
                        strr = randgen();
                        tab[i][j] = strr;
                        document.getElementById('right-1').innerHTML += "<div class='color' title='"+tab[i][j]+"' style='background-color:#"+tab[i][j]+"'></div>";
                        document.getElementById('right-2').innerHTML += addc("ins",movepls(strr,2))+", ";
                    }//for-keys
                    conslog(tab);
                    document.getElementById('right-1').innerHTML += "<br/><br/><br/><br/>";
                    document.getElementById('right-2').innerHTML += addc("ins","&lt/ColorPicture&gt")+"</br>";
                    document.getElementById('right-2').innerHTML += addc("ins","&ltDisplayTime&gt"+duration+"&lt/DisplayTime&gt")+"</br>";
                    document.getElementById('right-2').innerHTML += addc("ins","&lt/Frame"+i+"&gt")+"</br>";
                }//for-frames
            break;
            case 'hue':
                document.getElementById('right-1').innerHTML = "";
                var hueval = document.getElementById('huevalue').value; //get value from input
                //setup
                var tabb = [];
                if(hueval=="") break;
                tabb = hex_rgb(hueval); //get values to rgb
                var delta = selectmax(tabb) - selectmin(tabb); //delta
                var HUE = hue(tabb,delta,selectmax(tabb)); //calc hue
                var radius = calchueradius(50,HUE);  //calc radius
				if(HUE==50){
					var radius = calchueradius(0,50);
				}
                conslog(radius);
                //var hsll = randhsl(radius); //get random hue, output as ARRAY
                //---------------------------------------
                for(var i=0; i<=frames; i++){
                    document.getElementById('right-2').innerHTML += addc("ins","&ltFrame"+i+"&gt")+"</br>";
                    document.getElementById('right-2').innerHTML += addc("ins","&ltColorPicture&gt")+"</br>";
                    tab[i] = [];
                    strr="";
                    for(var j=0;j<106;j++){
                    hsll = randhsl(radius);
                    hsll = hsl_rgb(hsll);
                    conslog("rgb "+hsll);
                    strr = randgenhsl(hsll);
                    strr=strr.toUpperCase();
                    tab[i][j] = strr;
                    document.getElementById('right-1').innerHTML += "<div class='color' title='"+tab[i][j]+"' style='background-color:#"+tab[i][j]+"'></div>";
                    document.getElementById('right-2').innerHTML += addc("ins",tab[i][j])+",";
                    }//for-keys
                    conslog(tab);
                    document.getElementById('right-1').innerHTML += "<br/><br/><br/><br/>";
                    document.getElementById('right-2').innerHTML += addc("ins","&lt/ColorPicture&gt")+"</br>";
                    document.getElementById('right-2').innerHTML += addc("ins","&ltDisplayTime&gt"+duration+"&lt/DisplayTime&gt")+"</br>";
                    document.getElementById('right-2').innerHTML += addc("ins","&lt/Frame"+i+"&gt")+"</br>";
                }//for-frames
            break;
        }//switch
    document.getElementById('right-2').innerHTML += addc("ins","&lt/Root&gt")+"</br>";
    }//if
}
function selectinput(){
    var x = document.getElementById('select').value;
    if(x=="hue"){
        document.getElementById('newbutton').innerHTML = "<input type='color' id='huevalue' />";
    }
    else document.getElementById('newbutton').innerHTML = "";
    conslog(x);
}