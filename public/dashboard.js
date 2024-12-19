let dashboard = document.querySelector(".dashboard");
let artcile = document.querySelector(".artcile");
let comments = document.querySelector(".comments");

let dashboardSection = document.getElementById("dashboardSection");
let articleSection = document.getElementById("articleSection");
let commentSection = document.getElementById("commentSection");



dashboardSection.addEventListener("click" , ()=>{

  dashboard.classList.remove("hidden"); 
  artcile.classList.add("hidden");
  comments.classList.add("hidden");

});

articleSection.addEventListener("click" , ()=>{

  dashboard.classList.add("hidden"); 
  artcile.classList.remove("hidden");
  comments.classList.add("hidden");

});

commentSection.addEventListener("click" , ()=>{

  dashboard.classList.add("hidden"); 
  artcile.classList.add("hidden");
  comments.classList.remove("hidden");

});


let ajoutModalArticle = document.getElementById("ajoutModalArticle");
let ajoutBtn = document.getElementById("ajoutBtn");
let clsoe1 = document.getElementById("close1");

ajoutBtn.addEventListener("click" , ()=>{

  ajoutModalArticle.classList.remove("hidden");
  ajoutModalArticle.classList.add("flex");

});


close1.addEventListener("click" , ()=>{

  ajoutModalArticle.classList.remove("flex");
  ajoutModalArticle.classList.add("hidden");

});

