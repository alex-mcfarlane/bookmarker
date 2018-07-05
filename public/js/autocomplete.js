function Autocomplete(inputId, dictionary, collectionName, selectedItemsContainerId) {
    this.input = document.getElementById(inputId);
    this.dictionary = dictionary;
    this.collectionName = collectionName;

    this.resultsContainer = this.createContainer('autocomplete-results');
    this.selectedContainer = document.getElementById(selectedItemsContainerId);


    var self = this;

    // bind event listener for when user types into input
    this.input.addEventListener("keyup", function(event) {
        self.drawResults(event);
    });

    // convert existing dom elements that were created from server to Result objects so it is compatible with the autocompleter
    var results = [];

    for(var i = 0; i < this.selectedContainer.children.length; i++) {
        var domElem = this.selectedContainer.children[i];console.log(domElem.getElementsByTagName('span')[0]);
        results.push(new Result(domElem.getElementsByTagName('input')[0].value, domElem.getElementsByTagName('span')[0].innerHTML, this.collectionName));
    }

    this.selectedContainer.innerHTML = "";

    for(var i = 0; i < results.length; i++) {
        this.selectItem(results[i]);
    }
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

    for(var key in this.dictionary) {
        var item = this.dictionary[key];
        var inputVal = target.value;

        if( this.compare(item, inputVal) && inputVal.length > 0 ) {
            var match = new Match(item, key);
            var that = this;

            match.domElem.addEventListener('click', function() {
                var selectedItem = new Result(match.id, match.item, that.collectionName);

                that.selectItem(selectedItem);
            });

            this.resultsContainer.appendChild(match.domElem);
        }
    }
}

Autocomplete.prototype.compare = function(item, inputVal) {
    return item.toLowerCase().indexOf(inputVal.toLowerCase()) >= 0;
}

Autocomplete.prototype.selectItem = function(selectedItem) {
    var that = this;
    this.selectedContainer.appendChild(selectedItem.domElem);

    // remove item from list
    delete this.dictionary[selectedItem.id];

    // click handler for item
    selectedItem.domElem.addEventListener('click', function(){
        that.removeItem(this, selectedItem);
    });

    // clear search input and results container
    this.input.value = "";
    this.resultsContainer.innerHTML = "";
}

Autocomplete.prototype.removeItem = function(elem, result) {
    // add back to list
    this.dictionary[result.id] = result.item;

    // remove element from DOM
    elem.parentNode.removeChild(elem);
}

function Result(id, item, name) {
    this.id = id;
    this.item = item;
    this.domElem = this.createElem(name);
}

Result.prototype.createElem = function(name) {
    var element = document.createElement('div');

    element.setAttribute('class', 'selected-item');
    element.innerHTML = "<span>" + this.item + "</span>";
    element.innerHTML += "<input type='hidden' value='"+ this.id +"' name='"+ name +"[]'/>";

    return element;
}

function Match(item, id) {
    this.item = item;
    this.id = id;
    this.domElem = this.createElem(name);
}

Match.prototype.createElem = function() {
    var element = document.createElement('div');

    element.append(this.item);

    return element;
}