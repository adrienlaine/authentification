var $collectionHolder;

var $addParticipantButton = $('<button type="button" class="btn btn-success">Ajouter Participant</button>');
var $newLinkContainer = $('<div class="buttonContainer"></div>').append($addParticipantButton);

jQuery(document).ready(function() {
    // Find the Collection group
    var $collectionSelector = $('fieldset > div[id*="Participates"]').attr('id');
    $collectionHolder = $('#' + $collectionSelector);

    // Add "Add New" Button
    $collectionHolder.append($newLinkContainer);

    // Initializing index
    // $collectionHolder.data('index', 0);

    // Set all existing Entities of the Collection
    $collectionEntities = $collectionHolder.find('fieldset');
    $.each($collectionEntities, function($collectionIndex, $collectionEntity) {
        $($collectionEntity).find('legend').text('');
        encapsulateEntity($collectionEntity, $newLinkContainer);
    });
    
    // Add "New Form" Event
    $addParticipantButton.on('click', function(e) {
        addParticipantForm($collectionHolder, $newLinkContainer);
    });
});


function addParticipantForm($collectionHolder, $newLinkContainer) {
    // Get the prototype of the Form for the new Entity
    var prototype = $collectionHolder.data('prototype');
    var newForm = prototype;

    // Get the new index
    // var index = $collectionHolder.data('index');

    // Set the new Entity of the Collection
    newForm = treatFormLabel(newForm);
    encapsulateEntity(newForm, $newLinkContainer);
}


function treatFormLabel($form, index = '') {
    $form = $form.replace(/__name__label__/g, index);
    return $form;
}


function encapsulateEntity($collectionEntity, newLinkContainer) {
    // Get the new index
    // var index = $collectionHolder.data('index');

    var $newFormContainer = $('<div class="participantContainer"></div>').append($collectionEntity);

    // Add "Remove" Button
    $newFormContainer.append('<button type="button" class="btn btn-danger remove-participant">Supprimer</button>');
    
    $newLinkContainer.before($newFormContainer);
    $('.participantContainer fieldset.form-group').addClass('col-8');

    // Increase the index of one for the next item
    // $collectionHolder.data('index', ++index);

    // Add "Delete" Event
    $('.remove-participant').click(function(e) {
        e.preventDefault();
        $(this).parent().remove();
        // Decrease the index of one due to the removed item
        // $collectionHolder.data('index', --index);
        return false;
    });
}