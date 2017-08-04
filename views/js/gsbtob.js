$( window ).on( "load", function(){
  $('#companies').autocomplete({
    source : function(requete, reponse){
  	   $.ajax({
          url : '/modules/gsbtobs/ajax.php',
          dataType : 'json',
          data : {
                  term : $('#companies').val()
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
