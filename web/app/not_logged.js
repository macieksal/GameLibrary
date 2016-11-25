$(document).ready(function () {

    // $('#myTable').tablesorter();

    $('#myTable').tablesorter({ widgets: ['staticRow'] });

    $('#gierki2').on('change', '.rating input', function (event) {
        //alert($(this).parent().find(':checked').val());

            $('.rating').text("You must log in order to comment");

    });

});