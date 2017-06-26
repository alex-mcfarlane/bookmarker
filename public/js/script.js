var toggle = document.getElementById('nav-icon');
var sidebar = document.getElementById('main-sidebar');

toggle.addEventListener('click', function(){
    if(this.classList.contains('expand')) {
        this.classList.remove('expand');
        sidebar.classList.remove('open');
    }
    else {
        this.classList.add('expand');
        sidebar.classList.add('open');
    }
});