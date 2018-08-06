var toggle = document.getElementById('nav-icon');
var sidebar = document.getElementById('main-sidebar');

toggle.addEventListener('click', function(){
    if(this.classList.contains('expand')) {
        this.classList.remove('expand');
        sidebar.classList.remove('open');
        closeOpenMenus();
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
        // if the sidebar is closed don't even process this click
        if(sidebar.classList.contains('open')) {
            for(var nodeIndex = 0; nodeIndex < this.childNodes.length; nodeIndex++) {
                var node = this.childNodes[nodeIndex];

                // DOM manipulation on the ul sub-menu
                if(node.classList && node.classList.contains('sub-menu')) {
                    // close open sub menu's
                    closeOpenMenus();

                    node.classList.add('open');

                    break;
                }
            }
        }
    });
}

function closeOpenMenus()
{
    var openMenus = document.getElementsByClassName('open');

    for(var menuIndex = 0; menuIndex < openMenus.length; menuIndex++) {
        var sibling = openMenus[menuIndex];

        if(sibling.classList.contains('sub-menu')) {
            sibling.classList.remove('open');
        }
    }
}

// toggle access
document.getElementById('visibility_id').addEventListener('change', toggleAccessControl);

function toggleAccessControl() {
    if(this.value == 1) {
        document.getElementById('access-container').classList.remove('hidden');
        document.getElementById('access-container').classList.add('show');
    } else {
        document.getElementById('access-container').classList.add('hidden');
    }

}

/*
 Autocomplete
 */
// Add a keyup event listener to our input element

var xhttp = new XMLHttpRequest();

xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var data = JSON.parse(this.responseText);

        var usersMap = data.reduce(function(usersMap, user){
            usersMap[user.id] = user.name;

            return usersMap;
        }, {});

        var autocomplete = new Autocomplete('autocomplete', usersMap, 'access', 'selected-items');
    }
};

xhttp.open("GET", "/api/v1/users", true);
xhttp.send();