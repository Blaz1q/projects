class Shower{
  constructor(div,time1,time2,x,addrange){
    this.clientHeight = document.documentElement.clientHeight;
    this.div = document.getElementsByClassName(div);
    this.x = x;
    this.sectionY = this.div[x].getBoundingClientRect().top;
    this.sectionH = this.div[x].offsetHeight;
    this.time1 = time1;
    this.time2 = time2;
    this.addrange = addrange;
  }
  checker(){
    if (this.clientHeight/3-this.addrange < this.sectionY +this.sectionH&&this.clientHeight-this.addrange > this.sectionY +(this.sectionH * 2)/3) {
      this.div[this.x].style.transition = this.time1;
		  this.div[this.x].style.opacity = "1";
    }
    else{
      this.div[this.x].style.transition = this.time2;
      this.div[this.x].style.opacity = "0";
    }
  }
}
function showtext(elem){
  let text = document.querySelectorAll('.showcase h2');
  text[elem].style.transition = ".2s";
  text[elem].style.opacity = "1";
}
function hidetext(elem){
  let text = document.querySelectorAll('.showcase h2');
  text[elem].style.transition = ".2s";
  text[elem].style.opacity = "0";
}
function page_load(){
  const slider = document.querySelector('.galeria');
let isDown = false;
let startX;
let scrollLeft;

slider.addEventListener('mousedown', (e) => {
  isDown = true;
  slider.classList.add('active');
  startX = e.pageX - slider.offsetLeft;
  scrollLeft = slider.scrollLeft;
  slider.style = "scroll-snap-type: none";
});
slider.addEventListener('mouseleave', () => {
  isDown = false;
  slider.classList.remove('active');
});
slider.addEventListener('mouseup', () => {
  isDown = false;
  slider.classList.remove('active');
  slider.style = "scroll-snap-type: x manditory";
});
slider.addEventListener('mousemove', (e) => {
  if(!isDown) return;
  e.preventDefault();
  
  const x = e.pageX - slider.offsetLeft;
  const walk = (x - startX) ; //scroll-fast
  slider.scrollLeft = scrollLeft - walk;
});
}
var helper = true;
function oload(){
    let div = new Shower("header",".6s",".4s",0,0);
    let content = new Shower("content","1s",".5s",0,0);
    let content2 = new Shower("content","1s",".5s",1,500);
    let content3 = new Shower("galeria","1s",".5s",0,0);
    div.checker();
    content.checker();
    content2.checker();
    content3.checker();
}
function showitems(){
  if(helper==true){
    document.getElementsByClassName('navbar')[0].innerHTML += "test";
    helper = false;
  }
  else{
    document.getElementsByClassName('navbar')[0].innerHTML += "test2";
    helper = true;
  }
}
