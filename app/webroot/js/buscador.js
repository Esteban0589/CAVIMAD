$(document).ready(function() {
   $("#sitesearch").autocomplete({
    minLength: 2,
    select: function(event, ui){
        $("#sitesearch").val(ui.item.label);
    },
    source: function(request,response){
        $.ajax({
            url: basePath + "Categories/buscador",
            data: {
                term: request.term
            },
            dataType: "json",
            success: function(data){
                response($.map(data, function(el, index){
                    return{
                        value: el.Users.name,
                        nombre: el.Users.name, 
                        
                    };
                }));
            }

        });
    }
       }).data("ui-aoutocomplete")._renderItem = function(ul, item){
           return $("<li></li>")
           .data("item.autocomplete", item)
           .append("<a>"+item.name+"</a>")
           .appendTo(ul)
       }
});