$(function(){

    function addValueKey(array){
        for(i=0;i<array.length;i++){
            array[i].value = array[i].name;
        }
        return array;
    }

    var pointTemplate = Handlebars.compile($('#template-game-point').html());

    var addGameBtn = $('#add-game-btn');
    var addGameLink = addGameBtn.attr('href');
    var addPlayerBtn = $('#add-player-btn');
    var addPlayerLink = addPlayerBtn.attr('href');

    var gamesInput = $('#game');
    var gamesIdInput = $('#game_id');
    var numPlayersInput = $('#number_players');
    var pointsContainer = $('#game-points');
    var completeFormWithGame = function(id){
        addPlayerBtn.attr('href', addPlayerLink+'&withGameId='+id);
        $.getJSON($_SERVER.root+'/games/'+id+'.json', function(data){
            numPlayersInput.attr('min', data.min_players);
            numPlayersInput.attr('max', data.max_players);
            pointsContainer.empty();
            for(var i=0; i < data.game_points.length; i++){
                var pointForm = $(pointTemplate({
                    index: i,
                    label: data.game_points[i].label,
                    game_point_id: data.game_points[i].id
                }));
                pointForm.find('input').attr('required', i === 0);
                pointsContainer.append(pointForm);
            }
        });
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
                    pointsContainer.empty();
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
