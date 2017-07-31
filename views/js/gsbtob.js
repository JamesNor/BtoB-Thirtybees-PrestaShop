$( window ).on( "load", function(){
  $('#firstname').autocomplete({
    source : function(requete, reponse){
  	   $.ajax({
          url : '/modules/gsbtobs/ajax.php',
          dataType : 'json',
          data : {
                  term : $('#firstname').val()
              },
          success : function(donnee){
                  reponse($.map(donnee, function(objet){
                      return objet;
                  }));
              }
          });
    }
  });
});
