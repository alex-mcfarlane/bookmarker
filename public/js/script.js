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

var sidebarLinks = document.getElementsByClassName('expandable');

for(var i = 0; i < sidebarLinks.length; i++) {
    var expandLink = sidebarLinks[i];

    expandLink.addEventListener('click', function() {
        for(var nodeIndex = 0; nodeIndex < this.childNodes.length; nodeIndex++) {
            var node = this.childNodes[nodeIndex];

            if(node.classList && node.classList.contains('sub-menu')) {
                node.classList.add('open');
                break;
            }
        }
    });
}