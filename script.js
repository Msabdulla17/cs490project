const canvas=document.getElementById("canvas1");
const ctx=canvas.getContext('2d');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;
let particlesArray;
let mouse = {
  x: null,
  y: null,
  radius: (canvas.height/80) * (canvas.width/80);
}
window.addEventListener('mousemove',
                        function(event) {
                          mouse.x = event.x;
                          mouse.y = event.y;
}
                        );
class Particle{
  constructor(x,y,directx,directy, size, color){
    this.x=x;
    this.y=y;
    this.directx=directx;
    this.directy=directy;
    this.size=size;
    this.color=color;
  }
  draw(){
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.size,0, Math.PI*2, false);
    ctx.fillStyle= '#0c0880';
    ctx.fill();
  }
  update(){
    if (this.x>canvas.width||this.x<0){
      this.directx = -this.directx;
    }
    if (this.y>canvas.height||this.y<0){
      this.directy = -this.directy;
    }
    
  }
}
