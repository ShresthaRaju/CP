var sidemenuDrawer = document.getElementById('drawer')

sidemenuDrawer.onclick = function() {
  document.getElementById('sidemenu-drawer-container').classList.toggle('is-drawn');
  document.getElementById('side-menu').classList.toggle('is-active');
  document.getElementById('main-content').classList.toggle('is-shrinked');
}
