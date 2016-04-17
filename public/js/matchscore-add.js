$(function(){

    function addValueKey(array){
        for(i=0;i<array.length;i++){
            array[i].value = array[i].name;
        }
        return array;
    }

    var gamesInput = $('#game');
    var gamesIdInput = $('#game_id');
    var addGameBtn = $('#add-game-btn');
    var addGameLink = addGameBtn.attr('href');
    var completeFormWithGame = function(id){
        addPlayerBtn.attr('href', addPlayerLink+'&withGameId='+id);
        //TODO
    };

    if(gamesIdInput.val() !== ""){
        completeFormWithGame(gamesIdInput.val());
    }
    $.getJSON($_SERVER.root+'/games.json', function(data){
        gamesInput.autocomplete({
            minLength: 0,
            source: addValueKey(data),
            select: function(event, ui){
                gamesInput.val(ui.item.name);
                gamesIdInput.val(ui.item.id);
                completeFormWithGame(ui.item.id);
            },
            change: function(event, ui){
                if(!ui.item){
                    gamesInput.val('');
                }
            }
        });
    });
    gamesInput.keydown(function(event){
        if(event.keyCode == 13){
            event.preventDefault();
        }
    });

    var playersInput = $('#player');
    var playersIdInput = $('#player_id');
    var addPlayerBtn = $('#add-player-btn');
    var addPlayerLink = addPlayerBtn.attr('href');
    var completeFormWithPlayer = function(id){
        addGameBtn.attr('href', addGameLink+'&withPlayerId='+id);
    };

    if(playersIdInput.val() !== ""){
        completeFormWithPlayer(playersIdInput.val());
    }
    $.getJSON($_SERVER.root+'/players.json', function(data){
        playersInput.autocomplete({
            minLength: 0,
            source: addValueKey(data),
            select: function(event, ui){
                playersInput.val(ui.item.name);
                playersIdInput.val(ui.item.id);
                completeFormWithPlayer(ui.item.id);
            },
            change: function(event, ui){
                if(!ui.item){
                    playersInput.val('');
                }
            }
        });
    });
    playersInput.keydown(function(event){
        if(event.keyCode == 13){
            event.preventDefault();
        }
    });

});
