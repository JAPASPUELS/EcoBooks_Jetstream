let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e)=>{
    let arrowParent = e.target.parentElement.parentElement; // selecting main parent of arrow
    arrowParent.classList.toggle("showMenu");
  });
}

let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");

// Recuperar el estado de la barra lateral de localStorage
if (localStorage.getItem('sidebarState') === 'close') {
  sidebar.classList.add('close');
} else {
  sidebar.classList.remove('close');
}

console.log(sidebarBtn);
sidebarBtn.addEventListener("click", ()=>{
  sidebar.classList.toggle("close");

  // Guardar el estado de la barra lateral en localStorage
  if (sidebar.classList.contains('close')) {
    localStorage.setItem('sidebarState', 'close');
  } else {
    localStorage.setItem('sidebarState', 'open');
  }
});
