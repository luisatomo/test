var $collectionHolder;

// setup an "add a autor" link
var $addAutorButton = $('<button type="button" class="add_autor_link">Add a autor</button>');
var $newLinkLi = $('<li></li>').append($addAutorButton);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of autores
    $collectionHolder = $('ul.autores');

    // add the "add a autor" anchor and li to the autores ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addAutorButton.on('click', function(e) {
        // add a new autor form (see next code block)
        addAutorForm($collectionHolder, $newLinkLi);
    });
});

function addAutorForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your autores field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a autor" link li
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);
}
