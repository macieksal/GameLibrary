$(document).ready(function () {

    $('#myTable').tablesorter();

    $('.rating input').on('change', function (event) {
        //alert($(this).parent().find(':checked').val());

        event.preventDefault();

        $.ajax({
            url: '/game/rate',
            type: "POST",
            data: {
                rating: $(this).val(),
                id: $(this).parent().attr('id')
            },

        }).done(function (result) {

            $('#votesMy-' + result.id + '').text(result.votes);
            $('#ratingMy-' + result.id + '').text(result.rating.toFixed(2));

        }).fail(function (xhr, status, errorThrown, exception) {
            alert(errorThrown + xhr + status + exception);
            console.log('Game rate error: ' + errorThrown);

        });

    });

});