var $collectionHolder;

//add new item
var $addNewItem = $('<a href="#" class="btn btn-info">Ajouter ligne</a>');

$(document).ready(function () {

    //get the $collectionHolder
    $collectionHolder = $('#doc_list');

    $collectionHolder.data('index', $collectionHolder.find('.panel').length);

    //append the add new item to the $collectionHolder
    $collectionHolder.append($addNewItem);
    //add Button remove Item

    $collectionHolder.find('.panel').each(function () {
        addRemoveButton($(this));
    });

    //the handle event click for the add new item
    $addNewItem.click(function (e) {
        e.preventDefault();
        //create a new form and append it for the $collectionHolder
        addNewForm();
    });
});

function addNewForm() {
    //getting the prototype
    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');
    var newForm = prototype;
    newForm = newForm.replace(/__name__/g, index);
    $collectionHolder.data('index', index + 1);
    $panel = $('<div class="panel panel-warning"><div class="panel-heading"></div></div>');
    $panelBody = $('<div class="panel-body"></div>').append(newForm);

    $panel.append($panelBody);

    addRemoveButton($panel);

    $addNewItem.before($panel);
}

//remove item
function addRemoveButton($panel) {
    //create remove Button
    $removeButton = $('<a href="#" class="btn btn-danger">Supprimer ligne</a>');

    //appending the $removeButton to the panel footer
    $panelFooter = $('<div class="panel-footer"></div>').append($removeButton);

    // handle the click event of the remove button
    $removeButton.click(function (e) {
        e.preventDefault();
        $(e.target).parents('.panel').slideUp(1000, function () {
            $(this).remove();
        });
    });

    // append the footer to the panel
    $panel.append($panelFooter);
}