jQuery(document).ready(function($) {
  $("#buscador").autocomplete({
        minLength: 2,
        select: function(event, ui){
            $("#buscador").val(ui.item.label);
        },
        source: function(request,response){
            $.ajax({
                url: basePath + "categories/buscador",
                //url: "Categories/buscador",
                data: {
                    term: request.term
                },
                dataType: "json",
                success: function(data){
                    response($.map(data, function(el, index){
                        return{
                            value: el.Users.id,
                            nombre: el.Users.username, 
                            
                        };
                    }));
                }

            });
        }
      }).data("ui-autocomplete")._renderItem = function(ul, item){
          return $("<li></li>")
          .data("item.autocomplete", item)
          .append("<a>"+item.nombre+"</a>")
          .appendTo(ul)
      }
});
