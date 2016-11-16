$(document).ready(function(){
    elementosDerecha = [];
     $("#myTextField").on('keyup', function() {                           
             var input = $(this).val(); 
             if ( input.length >= 2 ) { 
                     var data = {input: input}; 
                     $.ajax({
                             type: "GET",
                             url: "/autocomplete/update/data", 
                             data: data, 
                             dataType: 'json', 
                             timeout: 3000,
                             success: function(response){ 
                                     var $ul = $(response.ingredientList);
                                     var $ulElementos = $('#elementos')
                                     
                                     var elementos = [];
                                     
                                     $ulElementos.children().each(function(){
                                         elementos.push($(this).text());
                                     });
                                     
                                     $ul.children().each(function(){
                                         for(i=0; i<elementos.length; i++){
                                            if($(this).text().trim() === elementos[i].trim()){                                                
                                                $(this).remove();
                                                return;
                                            }
                                        }
                                     });
                                     
                                     
                                     
                                     /*$ul.each(function(){
                                         var $this = $(this);
                                     });*/
                                     
                                     /*$ul.children().each(function(){
                                         //$(this).remove();
                                         if($(this).text() == 'Pechuga de pollo'){
                                             $(this).remove();
                                         }
                                     })*/
                                     
                                     $('#match').empty().append($ul); 
                                     $('#matchList li').on('click', function() {
                                             $('#match').text('');
                                             $('#sendIngredients').prop('disabled', false);
                                             elementosDerecha.push($(this).text());
                                             $('#elementos').append('<li><span> <i class="removeIngredient fa fa-trash"></i> '+$(this).text()+'</span></li>');
                                     });     
                             },
                             error: function() { 
                                     $('#match').text('Problem!');
                             }
                     });
             } else {
                     $('#match').text(''); 
             }
     });
     $(document).on('click','.removeIngredient', function(){
         
            $(this).parent().remove();
        });
     $('#matchList li').on('click', function() {
            $(this).attr("data-id");
            $('#myTextField').val($(this).text()); 
            $("#sendIngredients").prop('disabled', false);
    });
    
    
    $(document).on('submit','#formSearch',function(event){
        $("#queryParameter").val(elementosDerecha.join());
    });

    
 });





/*$(document).ready(function(){
    $("#myTextField").on('keyup', function() { 
             var input = $(this).val(); 
             if ( input.length >= 2 ) { 
                     var data = {input: input}; 
                     $.ajax({
                             type: "GET",
                             url: "/autocomplete/update/data", 
                             data: data, 
                             dataType: 'json', 
                             timeout: 3000,
                             success: function(response){ 
                                     $('#match').html(response.ingredientList);   
                             },
                             error: function() { 
                                     $('#match').text('Problem!');
                             }
                     });
             } else {
                     $('#match').text(''); 
             }
     });
    $(document).on('click','.removeIngredient', function(){
         
            $(this).parent().remove();
    });
    $('#matchList li').on('click', function() {
            $(this).attr("data-id");
            $('#myTextField').val($(this).text()); 
            $('#match').text('');
            $('#elementos').append('<li><i class="removeIngredient fa fa-trash"></i> <span id="data-id">'+$(this).text()+'</span></li>');
            $("#sendIngredients").prop('disabled', false);
    });   
 });
*/