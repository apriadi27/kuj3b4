function openNav(){
    document.getElementById('sidenav').style.display="block";
}
function closeNav(){
    document.getElementById('sidenav').style.display="none";
}
function kategoriColorWhite(){
    document.getElementById('kategori').classList.add('w3-white');
}
function kategoriColorCyan(){
    document.getElementById('kategori').classList.remove('w3-white');
}
function menuProfilIn(){
    document.getElementById('menuProfil').classList.add('in');
    document.getElementById('menuProfil').classList.remove('out');
}
function menuProfilOut(){
    document.getElementById('menuProfil').classList.remove('in');
    document.getElementById('menuProfil').classList.add('out');
}