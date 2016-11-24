$(document).ready(function(){
    $( "#myTextField" ).focus();
    elementosDerecha = [];
    firstli = null;
    
    
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
                                 //accedemos a los datos
                                     var $ul = $(response.ingredientList);
                                     // guardamos la caja de la derecha
                                     var $ulElementos = $('#elementos');
                                     
                                     //inicializamos la variable para guardar los datos
                                     var elementos = [];
                                     
                                    //recorremos todos los elementos que en parte del html de la derecha
                                     
                                     $ulElementos.children().each(function(){
                                         elementos.push($(this).text());
                                     });
                                     
                                     // recorremos la respuesta de la llamada ajax que son los ingrendientes
                                     // para eliminar los elementos que ya tengamos metidos en la parte de la derecha
                                     $ul.children().each(function(){
                                         for(i=0; i<elementos.length; i++){
                                            if($(this).text().trim() === elementos[i].trim()){                                                
                                                $(this).remove();
                                                return;
                                            }
                                        }
                                     });
                                     
                                     console.log('success llamada ajax');
                                    //vaciamos la caja de la izquierda y metemos la respuesta que viene de la llamada ajax
                                    emptySuggestionIngredients();
                                     $('#match').append($ul);
                                     
                                     firstli = $("#match li:first");
//                                      $('#recogeringredientes').html("<h1 style='color:white;'>"+firstli.html()+"</h1>");
                                    $('#matchList li').on('click', function() {
                                        insertElementInDerecha($(this).text());
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
     
    function emptySuggestionIngredients(){
        console.log('vacia sugerencias');
        $('#match').empty();
    }
     
    
    $("#igr input").keypress(function (e) {
        if (e.keyCode == 13) {
            console.log('presiono enter');
           insertElementInDerecha(firstli.html());
        }
    });
     
    function insertElementInDerecha(text){
            console.log('inserta en la derecha');
//        $('#match').text('');
        $('#sendIngredients').prop('disabled', false);
        elementosDerecha.push(text);
        $('#elementos').append('<li><span> <i class="removeIngredient fa fa-trash"></i> ' + text + '</span></li>');
        emptySuggestionIngredients();
    };

    
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

    
    
    
    
    
    
    
    
    
 
	/*$(function(){
            $(".slides").slidesjs({
                play: {
                    active: true,
                      // [boolean] Generate the play and stop buttons.
                      // You cannot use your own buttons. Sorry.
                    effect: "slide",
                      // [string] Can be either "slide" or "fade".
                    interval: 3000,
                      // [number] Time spent on each slide in milliseconds.
                    auto: true,
                      // [boolean] Start playing the slideshow on load.
                    swap: true,
                      // [boolean] show/hide stop and play buttons
                    pauseOnHover: false,
                      // [boolean] pause a playing slideshow on hover
                    restartDelay: 2500
                      // [number] restart delay on inactive slideshow
                }
            });
        });




        $("#igr input").keypress(function (e) {
            if (e.keyCode == 13) {
                $("#matchlist").first().children().addClass("highlight");
            }
        });
    });
*/

 



 
 
 
 
 
 
 





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
*/