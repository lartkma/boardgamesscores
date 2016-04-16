$(function(){
    var tieContainer = $('#container-tie-points');
    var tieFormSource = $('#template-tie-point').html();
    var tieFormTemplate = Handlebars.compile(tieFormSource);

    $('#btn-add-tie').click(function(e){
        var size = tieContainer.children('.tie-point').size();
        tieContainer.append(tieFormTemplate({index:size+1}));
    });

    var searchedTerm = null;
    var searchResults = [];
    var searchInProgress = false;
    var nameInput = $('#name');
    var bggIdInput = $('#bgg_id');
    var minPlayersInput = $('#min_players');
    var maxPlayersInput = $('#max_players');
    nameInput.autocomplete({
        minLength: 5,
        source: function(request, response){
            if(searchedTerm !== null && 
                    request.term.lastIndexOf(searchedTerm, 0) === 0){
                if(request.term === searchedTerm){
                    response(searchResults);
                }else{
                    response(searchResults.filter(function(element){
                        return element.name.toLowerCase().indexOf(
                            request.term.toLowerCase()) !== -1;
                    }));
                }
            }else{
                searchInProgress = true;
                searchedTerm = request.term;
                $.getJSON($_SERVER.root+'/bgg/search?q='+encodeURIComponent(searchedTerm), 
                    function(data, status, xhr){
                        searchResults = data;
                        response(data);
                        searchInProgress = false;
                        if(nameInput.val() !== searchedTerm){
                            nameInput.autocomplete('search');
                        }
                    });
            }
        },
        search: function(){
            if(searchInProgress) return false;
        },
        focus: function(event, ui){
            //Does nothing
            return false;
        },
        select: function(event, ui){
            nameInput.val(ui.item.name);
            bggIdInput.val(ui.item.id);
            $.getJSON($_SERVER.root+'/bgg/games/'+ui.item.id, function(data){
                minPlayersInput.val(data.min_players);
                maxPlayersInput.val(data.max_players);
            })
            return false;
        }
    });
    nameInput.autocomplete('instance')._renderItem = function(ul, item){
        return $('<li>').append(item.name + ' (' + item.year + ')')
                .appendTo(ul);
    };

});
