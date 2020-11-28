
var myImage = document.querySelector('img');
var myButton = document.querySelector('button');
var myHeading =document.querySelector('h1');


if(!localStorage.getItem('name')){
    setUserName();
}else{
    let storedName=localStorage.getItem('name');
    myHeading.innerHTML=' Hi '+storedName;
}

myImage.onclick=function(){
    let mySrc =myImage.getAttribute('src');
    if(mySrc==='images/陳BO全.jpg'){
        myImage.setAttribute('src','images/貓咪.jpg');
    }
    else{
        myImage.setAttribute('src','images/陳BO全.jpg');
    }
}

function setUserName(){
    let myName =prompt('Please enter your name.');
    if(!myName||myName===null){
    setUserName();
    }
    else{
    localStorage.setItem('name',myName);
    myHeading.innerHTML=' Hi '+myName;
    }
}

myButton.onclick=function(){
    setUserName();
}
//alert('hello');
