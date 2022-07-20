//Code written by Błażej Czarnecki
#include <iostream>
#include <fstream>
#include <math.h>
#include <cmath>
#include <time.h>
#include <cstdlib>
#include <stdlib.h>
#include <sstream>
using namespace std;
int hue(double delta, double cmin, double cmax, double* color){
double h;
    if (cmax == color[0])      h=     (color[1] - color[2]) /delta;
    else if (cmax == color[1]) h= 2 + (color[2] - color[0]) /delta;
    else                       h= 4 + (color[0] - color[1]) /delta;
    h *= 60;
    if (h < 0) floor(h);
    else floor(360 -h);
    return h;
}
int ctd(string color,int index){
    int values[6];
    int converted[6];
    int converteded[3];
    int holder=0;
    for(int i=0; i<6; i++){
    if(color[i]>='A'&&color[i]<='F'){
        values[i]=(color[i]-55);
    }
    else {values[i]=(color[i]-48);}
    }
    for(int i=0; i<6; i++){
        for(int j=0; j<2; j++){
        holder+=values[j+i] * pow(16,j);
        }
        converted[i]=holder;
        holder=0;
    }
    for(int k=0;k<6;k+=2) {converteded[k/2] = converted[k];}
return converteded[index];
}
double maxx(double a,double b,double c){
    if(a>b){
        if(a>c) return a;
        else return c;
    }
    else{
        if(b>c) return b;
        else return c;
    }
}
double minn(double a,double b,double c){
    if(a<b){
        if(a<c) return a;
        else return c;
        }
    else{
        if(b<c) return b;
        else return c;
    }
}
//working fine
double lightness(double cmin,double cmax){
return (cmax + cmin)/2;
}
//working fine
double saturation(double delta,double cmin,double cmax){
if(delta==0) return 0;
else{
    return (delta/(1-abs(2*lightness(cmin,cmax)-1)));
    }
}
//works fine
int random_hue(int hue1,int hue2){
int a = abs(hue1-hue2);
return rand() % (a+1) + hue1;
}
//works fine
double random_saturation(){
double a = rand() % 100 + 1;
return a/100;
}
//works fine
double random_lightness(){
    double a = rand() % 10 + 1;
    return a/10;
}
//finally working
int hsltorgb(double h,double s,double l,int index){
    int rgb[3];
    double r,g,b;
    double hh;
    double C = (1-abs(2*l-1))*s;
    hh=h/60;
    double x = C *(1-abs(fmod(hh,2)-1));
    if(h>=0&&h<60){r=C;g=x,b=0;}
    if(h>=60&&h<120){r=x;g=C,b=0;}
    if(h>=120&&h<180){r=0;g=C,b=x;}
    if(h>=180&&h<240){r=0;g=x,b=C;}
    if(h>=240&&h<300){r=x;g=0,b=C;}
    if(h>=300&&h<360){r=C;g=0,b=x;}
    double m = l - C/2;
    r+=m;
    g+=m;
    b+=m;
    r*=255;
    g*=255;
    b*=255;
    r = floor(r);
    g = floor(g);
    b = floor(b);
    rgb[0] = r;
    rgb[1] = g;
    rgb[2] = b;
    return rgb[index];
}
//works
char cth(int colorv,int index){
    int value;
    string hex;
    char a=0;
    for(int i=1;i>=0;i--){
    value=colorv%16;
    colorv=colorv/16;
    if(value>=0&&value<=9){
        a = value+48;
    }
    if(value>=10&&value<=15){
        a= 65+value-10;
    }
    hex[i]=a;
    a=0;
    }
return hex[index];
}
string movee(int mov,string text,int sizee){
char last = text[sizee - 1];
for(int j=0; j<mov-1; j++){
for(int i = sizee - 1; i > 0; i--){
text[i] = text[i - 1];

	text[0] = last;
}}
return text;
}
int main()
{
    string DisplayTime,name; //DisplayTime - how long the animation will last
    int FrameCount;    //how many frames
    char random;       //random char
    int table;         //table to char, if 0 - generates chars A-F, if 1 generates chars 0-9
    int RType;         
    srand(time(NULL)); 
    fstream animation; //file
    cout<<"FileName:";cin>>name;cout<<endl;
    cout<<"FrameCount:";cin>>FrameCount;cout<<endl;
    cout<<"DisplayTime:";cin>>DisplayTime;cout<<endl;
    name+=".ckAnimation"; //adds file ending
    animation.open(name.c_str(), ios::out);
    if(!animation.good()) cout<<"ERROR!"<<endl;
    else{
    cout<<"Random type:"<<endl;
    cin>>RType;
    animation<<"<Root>"<<endl;
    animation<<"<Description>ckAnimation:"<<endl;
    animation<<"File Made By Blaz1 :>"<<endl<<"FrameCount:"<<FrameCount<<endl<<"DisplayTime:"<<DisplayTime<<endl;
    animation<<"</Description>"<<endl;
    animation<<"<Time>0</Time>"<<endl;
    animation<<"<BackgroundColor>000000</BackgroundColor>"<<endl;
    animation<<"<FrameCount>"<<FrameCount<<"</FrameCount>"<<endl;
    switch(RType){
    case 1:
    for(int i=1;i<=FrameCount;i++){
    animation<<"<Frame"<<i<<">"<<endl;
    animation<<"<ColorPicture>";
        for(int j=0;j<106;j++){
                for(int k=0;k<6;k++){
                    table = rand() % 2;
                    if(table==0) random = rand() % 6 + 65;
                    else random = rand() % 10 + 48;
                    animation<<random;
                    cout<<random;
            }
            animation<<",";
            cout<<endl;
        }
        animation<<"</ColorPicture>"<<endl;
        animation<<"<DisplayTime>"<<DisplayTime<<"</DisplayTime>"<<endl;
        animation<<"</Frame"<<i<<">"<<endl;
    }

    break;
    case 2:
        double delta1,delta2;
        double cmin1,cmax1,cmin2,cmax2;
        double color1[3],color2[3];
        double hue1,hue2,sat1,sat2;
        int h;
        int colorout[3];
        double s,l;
        for(int l=0; l<3; l++){
        color1[l] = ctd("00FF00",l);
        color1[l] = color1[l]/255;
        color2[l] = ctd("0000FF",l);
        color2[l] = color2[l]/255;
        }
        cmin1 = minn(color1[0],color1[1],color1[2]);
        cmax1 = maxx(color1[0],color1[1],color1[2]);
        cmin2 = minn(color2[0],color2[1],color2[2]);
        cmax2 = maxx(color2[0],color2[1],color2[2]);
        delta1 = cmax1 - cmin1;
        delta2 = cmax2 - cmin2;
        hue1 =  hue(delta1,cmin1,cmax1,color1);
        hue2 =  hue(delta2,cmin2,cmax2,color2);
        string test;

        cout<<hue1<<" "<<hue2<<endl;
        sat1 = saturation(delta1,cmin1,cmax1);
        sat2 = saturation(delta2,cmin2,cmax2);
        h=random_hue(hue1,hue2);
        s=random_saturation();
        l=random_lightness();
        animation<<"<Root>"<<endl;
    for(int i=1;i<=FrameCount;i++){
    animation<<"<Frame"<<i<<">"<<endl;
    animation<<"<ColorPicture>";
        for(int j=0;j<106;j++){
        h=random_hue(hue1,hue2);
        s=random_saturation();
        l=random_lightness();
        /*string hexc[6];
        hexc[0] = cth(tab[0],0);
        hexc[1] = cth(tab[0],1);
        hexc[2] = cth(tab[1],0);
        hexc[3] = cth(tab[1],1);
        hexc[4] = cth(tab[2],0);
        hexc[5] = cth(tab[2],1);*/
        for(int z=0;z<3;z++) {colorout[z] = hsltorgb(h,s,l,z);}
        for(int k=5;k>=0;k--) {animation<<cth(colorout[k%3],k%2); cout<<cth(colorout[k%3],k%2)<<endl;}
        animation<<test;

        cout<<test;
            animation<<",";
            cout<<endl;
        }
        animation<<"</ColorPicture>"<<endl;
        animation<<"<DisplayTime>"<<DisplayTime<<"</DisplayTime>"<<endl;
        animation<<"</Frame"<<i<<">"<<endl;

    break;
	case 3:
for(int i=1;i<=FrameCount;i++){
    animation<<"<Frame"<<i<<">"<<endl;
    animation<<"<ColorPicture>";
        for(int j=0;j<106;j++){
			table = rand() % 3;

			if(table==0) animation<<"FF0000";
            else if(table==1) animation<<"00FF00";
			else animation<<"0000FF";
            cout<<random;

            animation<<",";
            cout<<endl;
        }
        animation<<"</ColorPicture>"<<endl;
        animation<<"<DisplayTime>"<<DisplayTime<<"</DisplayTime>"<<endl;
        animation<<"</Frame"<<i<<">"<<endl;
    }
	break;
    }
    }
    animation<<"</Root>"<<endl;
    animation.close();
    return 0;
    }
}
