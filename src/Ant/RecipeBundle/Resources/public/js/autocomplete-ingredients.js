$(document).ready(function(){
     $("#myTextField").on('keyup', function() { 
             var input = $(this).val(); 
             if ( input.length >= 2 ) { 
                     var data = {input: input}; 
                     $.ajax({
                             type: "GET",
                             url: ROOT_URL + "/autocomplete/update/data", 
                             data: data, 
                             dataType: 'json', 
                             timeout: 3000,
                             success: function(response){ 
                                     $('#match').html(response.ingredientList); 
                                     $('#matchList li').on('click', function() {
                                             $('#myTextField').val($(this).text()); 
                                             $('#match').text('');
                                             $('#elementos').append('<li>'+$(this).text()+'</li>');
                                             $("#sendIngredients").prop('disabled', false);
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
 });


