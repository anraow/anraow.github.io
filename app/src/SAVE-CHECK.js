"use strict";

// CHECK ON CLASS 'SAVED'
$(document).ready(function () {

    var cards = $('.card');
    
    $(cards).each( function() {
        if ( $(this).attr('id') == "saved" ) {
            $('#save-checkbox').prop('checked', true);
        }
    });
    
    if ( $('#save-checkbox[type=checkbox]').prop('checked') ) {
        $('#save-checkbox-icon').css('color', '#FFD53E');
    } else {
        $('#save-checkbox-icon').css('color', '#BFBFBF');
    }

});

// CHANGE COLOR ON CHECKBOX CLICK
$('#save-checkbox[type=checkbox]').on('change', function (e) {
    if ( $(this).prop('checked') ) {
        $(this).closest('label').find('#save-checkbox-icon').css('color', '#FFD53E');
        $(this).parents('.card').attr('id', 'saved');
        // $(this).closest( ".card" ).removeAttr('id');
    } else {
        $(this).closest('label').find('#save-checkbox-icon').css('color', '#BFBFBF');
        $(this).parents('.card').removeAttr('id');
        // $(this).parent( ".card" ).attr('id') = "saved";
        
    } 
});