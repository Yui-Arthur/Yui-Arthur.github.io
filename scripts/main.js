var a=document.querySelector('h1');
a.textContent = 'Hello world!';

var myImage =document.querySelector('img')

myImage.onclick=function(){
    let mySrc =myImage.getAttribute('src');
    if(mySrc==='images/陳BO全.jpg'){
        myImage.setAttribute('src','images/貓咪.jpg');
    }
    else{
        myImage.setAttribute('src','images/陳BO全.jpg');
    }
}