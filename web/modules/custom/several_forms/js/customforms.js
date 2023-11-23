(function ($, Drupal) {

    $.fn.datacheck = function() {
        alert('working');
        element = $('[name="usermail"]'); 
        element.val("chippy.jacob@gmail.com"); 
        alert('not working');
    };

}(jQuery, Drupal));