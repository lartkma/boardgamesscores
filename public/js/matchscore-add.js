$(function(){

    function addValueKey(array){
        for(i=0;i<array.length;i++){
            array[i].value = array[i].name;
        }
        return array;
    }

    function completeFormWithGame(id){
        addPlayerBtn.attr('href', addPlayerLink+'&withGameId='+id);
        //TODO
    }

    function completeFormWithPlayer(id){
        addGameBtn.attr('href', addGameLink+'&withPlayerId='+id);
    }

    var gamesInput = $('#game');
    var gamesIdInput = $('#game_id');
    var addGameBtn = $('#add-game-btn');
    var addGameLink = addGameBtn.attr('href');
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
            }
        });
    });

    var playersInput = $('#player');
    var playersIdInput = $('#player_id');
    var addPlayerBtn = $('#add-player-btn');
    var addPlayerLink = addPlayerBtn.attr('href');
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
            }
        });
    });

});
