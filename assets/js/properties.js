document.addEventListener("DOMContentLoaded",()=>{

const searchBtn=document.getElementById("searchBtn");

searchBtn.addEventListener("click",()=>{

const keyword=document
.getElementById("searchInput")
.value
.toLowerCase();

const city=document
.getElementById("cityFilter")
.value
.toLowerCase();

const gender=document
.getElementById("genderFilter")
.value
.toLowerCase();

const cards=document.querySelectorAll(".property-card");

cards.forEach(card=>{

const text=card.innerText.toLowerCase();

let show=true;

if(keyword && !text.includes(keyword))
show=false;

if(city!="city" && city!="" && !text.includes(city))
show=false;

if(gender!="gender" && gender!="" && !text.includes(gender))
show=false;

card.parentElement.style.display=show?"":"none";

});

});

});