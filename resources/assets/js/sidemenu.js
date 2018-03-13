// var sidemenuDrawer = document.getElementById('sidemenu-drawer')
// sidemenuDrawer.onclick = function() {
//   document.getElementById('side-menu').classList.toggle('is-active');
//   document.getElementById('main-content').classList.toggle('is-shrinked');
// }

var sidemenuDrawer = document.getElementById('drawer')

sidemenuDrawer.onclick = function() {
  document.getElementById('sidemenu-drawer-container').classList.toggle('is-drawn');
  document.getElementById('side-menu').classList.toggle('is-active');
  document.getElementById('main-content').classList.toggle('is-shrinked');
}


// var sidemenuDrawer = document.getElementById('drawer')
//
// sidemenuDrawer.onclick = function() {
//   document.getElementById('sidemenu-drawer-container').classList.toggle('is-drawn');
//   document.getElementById("side-menu").style.width = "250px";
//   document.getElementById("main-content").style.marginLeft = "250px";
// }
//
// function openNav() {
//     document.getElementById("mySidenav").style.width = "250px";
//     document.getElementById("main").style.marginLeft = "250px";
// }
//
// function closeNav() {
//     document.getElementById("mySidenav").style.width = "0";
//     document.getElementById("main").style.marginLeft= "0";
// }
