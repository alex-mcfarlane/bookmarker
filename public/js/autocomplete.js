function Autocomplete(inputId, list, collectionName, selectedItemsContainerId) {
    this.input = document.getElementById(inputId);
    this.list = list;
    this.collectionName = collectionName;

    this.resultsContainer = this.createContainer('autocomplete-results');
    this.selectedContainer = document.getElementById(selectedItemsContainerId);

    // bind event listener for when user types into input
    var self = this;

    this.input.addEventListener("keyup", function(event) {
        self.drawResults(event);
    });
}

Autocomplete.prototype.createContainer = function(id) {
    var container = document.createElement('div');
    container.setAttribute('id', id);

    this.input.parentNode.insertBefore(container, this.input.nextSibling);

    return container;
}

Autocomplete.prototype.drawResults = function(event) {
    var target = event.target;

    this.resultsContainer.innerHTML = "";

    for(var key in this.list) {
        var item = this.list[key];
        var inputVal = target.value;

        if( this.compare(item, inputVal) && inputVal.length > 0 ) {
            var match = new Match(item, key, this.collectionName);

            this.resultsContainer.appendChild(match.domElem);

            match.clickHandler(this);
        }
    }
}

Autocomplete.prototype.compare = function(item, inputVal) {
    return item.toLowerCase().indexOf(inputVal.toLowerCase()) >= 0;
}

Autocomplete.prototype.selectItem = function(selectedItem, itemId) {
    this.selectedContainer.appendChild(selectedItem);

    // clear search input and results container
    this.input.value = "";
    this.resultsContainer.innerHTML = "";
}


function Match(item, id, name) {
    this.item = item;
    this.id = id;
    this.domElem = this.createElem(name);
}

Match.prototype.createElem = function(name) {
    var element = document.createElement('div');

    element.append(this.item);
    element.innerHTML += "<input type='hidden' value='"+ this.id +"' name='"+ name +"[]'/>";

    return element;
}

Match.prototype.getInputElem = function() {
    return this.domElem.getElementsByTagName("input")[0];
}

Match.prototype.clickHandler = function(autocomplete) {
    var that = this;

    this.domElem.addEventListener('click', function() {
        var matchInput = that.getInputElem();

        var selectedItem = document.createElement('div');
        selectedItem.setAttribute('class', 'selected-item');
        selectedItem.innerHTML += "<span>" + autocomplete.list[matchInput.value] + "</span>";
        selectedItem.appendChild(matchInput);

        autocomplete.selectItem(selectedItem, matchInput.value);

    });
}

