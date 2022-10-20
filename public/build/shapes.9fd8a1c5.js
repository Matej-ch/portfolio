"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[501],{7364:function(){function t(){return"#"+Math.floor(16777215*Math.random()).toString(16)}function i(t,i){return t+Math.random()*(i-t)}var h=class{constructor({x:i=0,y:h=0,width:s=10,height:e=20,fillColor:l=t()}={}){this.x=i,this.y=h,this.width=s,this.height=e,this.fillColor=l}draw(t,i){t.beginPath(),t.fillStyle=t.strokeStyle=this.fillColor,t.rect(this.x,this.y,this.width,this.height),i?t.fill():t.stroke()}init(h){this.x=i(0,h.width),this.y=i(0,h.height),this.width=i(18,90),this.height=i(18,90),this.fillColor=t()}};var s=class{constructor({x:i=0,y:h=0,radius:s=1,rotation:e=45*Math.PI/180,startAngle:l=0,endAngle:o=2*Math.PI,fillColor:r=t()}={}){this.x=i,this.y=h,this.radius=s,this.rotation=e,this.startAngle=l,this.endAngle=o,this.fillColor=r}draw(t,i){t.beginPath(),t.fillStyle=t.strokeStyle=this.fillColor,t.ellipse(this.x,this.y,this.radius,this.radius,this.rotation,this.startAngle,this.endAngle),i?t.fill():t.stroke()}init(h){this.x=i(0,h.width),this.y=i(0,h.height),this.radius=i(18,90),this.fillColor=t()}};var e=class{constructor({x:i,y:h,lineWidth:s=2,fillColor:e=t()}={}){this.x=i,this.y=h,this.lineWidth=s,this.fillColor=e}draw(t,i){t.fillStyle=t.strokeStyle=this.fillColor,this.drawCurve(t,this.x-50,this.y,this.x-50,this.y+30,this.x,this.y+35,this.x,this.y+60,this.fillColor),this.drawCurve(t,this.x,this.y,this.x,this.y-30,this.x-50,this.y-30,this.x-50,this.y,this.fillColor),this.drawCurve(t,this.x,this.y+60,this.x,this.y+35,this.x+50,this.y+30,this.x+50,this.y,this.fillColor),this.drawCurve(t,this.x+50,this.y,this.x+50,this.y-30,this.x,this.y-30,this.x,this.y,this.fillColor)}init(h){this.x=Math.floor(i(0,h.width))+.5,this.y=Math.floor(i(0,h.height))+.5,this.fillColor=t()}drawCurve(t,i,h,s,e,l,o,r,n,a){t.save(),t.beginPath(),t.moveTo(i,h),t.bezierCurveTo(s,e,l,o,r,n),t.strokeStyle=a,t.lineWidth=this.lineWidth,t.stroke(),t.restore()}};var l=class{constructor({x:i=0,y:h=0,dirX:s=10,dirY:e=10,fillColor:l=t()}={}){this.x=i,this.y=h,this.dirX=s,this.dirY=e,this.fillColor=l}draw(t,i){t.beginPath(),t.fillStyle=t.strokeStyle=this.fillColor,t.moveTo(this.x,this.y),t.lineTo(this.dirX,this.dirY),t.stroke()}init(h){this.x=i(0,h.width),this.y=i(0,h.height),this.dirX=i(0,h.width),this.dirY=i(0,h.height),this.fillColor=t()}};var o=class{constructor({x:i=0,y:h=0,lineWidth:s=2,fillColor:e=t()}={}){this.fillColor=e,this.lineWidth=s,this.x=i,this.y=h,this.controlPoint1={x:100,y:200},this.controlPoint2={x:200,y:200},this.endPoint={x:200,y:100}}draw(t,i){t.beginPath(),t.fillStyle=t.strokeStyle=this.fillColor,t.lineWidth=this.lineWidth,t.moveTo(this.x,this.y),t.bezierCurveTo(this.controlPoint1.x,this.controlPoint1.y,this.controlPoint2.x,this.controlPoint2.y,this.endPoint.x,this.endPoint.y),t.stroke()}init(t){this.x=i(0,t.width),this.y=i(0,t.height),this.controlPoint1={x:i(0,t.width),y:i(0,t.width)},this.controlPoint2={x:i(0,t.width),y:i(0,t.width)},this.lineWidth=Math.floor(i(1,6)),this.endPoint={x:i(0,t.width),y:i(0,t.height)}}};var r=class{constructor({x:i,y:h,z:s,fillColor:e=t()}={}){this.x=i,this.y=h,this.z=s,this.fillColor=e}draw(t,i){t.beginPath(),t.fillStyle=t.strokeStyle=this.fillColor,t.moveTo(this.x,this.x),t.lineTo(this.y,this.x),t.lineTo(this.y,this.z),i?t.fill():t.stroke()}init(h){this.x=i(0,h.width),this.y=i(0,h.height),this.z=i(0,h.height),this.fillColor=t()}};var n=class extends s{constructor({x:t,y:i,radius:h,fillColor:s,startAngle:e,endAngle:l,rotation:o}={}){super({x:t,y:i,radius:h,rotation:o,startAngle:e,endAngle:l,fillColor:s})}init(h){this.x=i(0,h.width),this.y=i(0,h.height),this.radius=i(18,90),this.fillColor=t(),this.startAngle=0,this.endAngle=Math.random()*(2*Math.PI),this.rotation=Math.random()*(2*Math.PI)}};var a=class extends h{constructor({x:i=0,y:h=0,width:s=10,fillColor:e=t()}={}){super({x:i,y:h,width:s,height:s,fillColor:e})}draw(t,i){t.beginPath(),t.fillStyle=t.strokeStyle=this.fillColor,t.rect(this.x,this.y,this.width,this.width),i?t.fill():t.stroke()}init(h){this.x=i(0,h.width),this.y=i(0,h.height),this.width=i(18,90),this.fillColor=t()}};var d=class{constructor(t,{fillShape:i=!0,numShapes:h=10,alpha:s=!0,bgColor:e="black",globalCompositeOperation:l="multiply"}={}){this.canvasEl=t,this.alpha=s,this.ctx=this.canvasEl.getContext("2d",{alpha:this.alpha}),this.fillShape=i,this.numShapes=h,this.globalCompositeOperation=l,this.canvasW=window.innerWidth,this.canvasH=window.innerHeight,this.canvasEl.style.cssText=`background:${e}`,this.initListeners(),this.potentialShapes=["Rectangle","Circle","Cube","Line","Triangle","Wave","Heart","SemiCircle"]}init(){this.shapes=[];for(let t=0;t<this.numShapes;t++){const t=this.potentialShapes[Math.round(Math.random()*(this.potentialShapes.length-1))];let i=new s;switch(t){case"Rectangle":i=new h;break;case"Circle":i=new s;break;case"Heart":i=new e;break;case"Line":i=new l;break;case"Wave":i=new o;break;case"Triangle":i=new r;break;case"SemiCircle":i=new n;break;case"Cube":i=new a}i.init(this.canvasEl),this.shapes.push(i)}}initListeners(){window.addEventListener("resize",(t=>{this.canvasEl.width>window.innerWidth?this.canvasEl.width=window.innerWidth:this.canvasEl.width=this.canvasW,this.canvasEl.height>window.innerHeight?this.canvasEl.height=window.innerHeight:this.canvasEl.height=this.canvasH,this.init()}))}draw(){this.ctx.clearRect(0,0,this.canvasW,this.canvasH),this.ctx.globalCompositeOperation=this.globalCompositeOperation;for(let t=0;t<this.shapes.length;t++){this.shapes[t].draw(this.ctx,this.fillShape)}}deactivateShapes(t){this.potentialShapes=this.potentialShapes.filter((i=>!t.includes(i)))}};window.onload=function(){const t=document.getElementById("canvas"),i=t.parentElement;t.width=i.offsetWidth,t.height=i.offsetHeight;const h=new d(t,{fillShape:!0,numShapes:8,bgColor:"rgba(243, 244, 246, 1)"});h.deactivateShapes(["Heart","Triangle","Line","Wave"]),h.init(),h.draw()}}},function(t){var i;i=7364,t(t.s=i)}]);