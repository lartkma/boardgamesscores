$(function(){
    var tieContainer = $('#container-tie-points');
    var tieFormSource = $('#template-tie-point').html();
    var tieFormTemplate = Handlebars.compile(tieFormSource);
    $('#btn-add-tie').click(function(e){
        var size = tieContainer.children('.tie-point').size();
        tieContainer.append(tieFormTemplate({index:size+1}));
    });
});
