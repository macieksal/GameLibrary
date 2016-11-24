$(document).ready(function () {

    var button = $('#createGame');

    button.on('click', function (event) {


        $('#createGameAjaxForm').toggleClass('expand');


        $('form[name=gamelibrarybundle_game]').on('submit', function (event) {
            event.preventDefault();

            $.ajax({
                url: '/game/newGameAjax',
                type: "POST",
                data: $('form[name=gamelibrarybundle_game]').serialize()

            }).done(function (result) {

                var newGame = $('#gra').clone().appendTo( $("#gierki2") ).attr('id', 'newGame');
                var children = newGame.children();

               // console.log(children);

               // console.log(result);

                $(children[0]).text(result.id);
                $(children[1]).text(result.title);
                $(children[2]).text(result.producer);
                $(children[3]).text(result.premiere);
                $(children[4]).text(null).attr('id', 'ratingMy-' + result.id);
                $(children[5]).text(null).attr('id', 'votesMy-' + result.id);
                $(children[6]).find('fieldset').attr('id', result.id);
                var fieldset =  $(children[6]).find('fieldset');
                $(children[8]).find('a').attr('href', '/game/' +result.id + '/show');
                $(children[8]).find('a').attr('href', '/game/' +result.id + '/edit');


                var childreen = fieldset.children();

               // console.log(childreen);

                for (var i = 0; i< 20; i=i+2) {

                    var oldId = $(childreen[i]).attr('id');
                    var parts = oldId.split ('-');
                    var newId = parts[0] + '-' + result.id;
                    $(childreen[i]).attr('id', newId);
                }

                for (var j = 0; j< 20; j=j+2) {

                    var oldName = $(childreen[j]).attr('name');
                    var parts2 = oldId.split ('-');
                    var newName = parts2[0] + '-' + result.id;
                    $(childreen[j]).attr('name', newName);
                }

                for (var k = 1; k< 21; k=k+2) {

                    var oldFor = $(childreen[k]).attr('for');
                    //console.log(oldFor);
                    var parts3 = oldFor.split ('-');
                    var newFor = parts3[0] + '-' + result.id;

                    $(childreen[k]).attr('for', newFor);
                }


            }).fail(function (xhr, status, errorThrown, exception) {
                alert(errorThrown + xhr + status + exception);
                console.log('Game edit error: ' + errorThrown);

            });

        });

    });

});