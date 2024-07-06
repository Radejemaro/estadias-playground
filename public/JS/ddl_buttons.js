$(document).ready(function(){
  //Ocultamos el menú al cargar la página
  $("#menu_derecho").hide();

  /* mostramos el menú si hacemos click derecho con el ratón en una celda de la tabla */
  $("table td").bind("contextmenu", function(e){
    $("#menu_derecho").css({'display':'block', 'left':e.pageX, 'top':e.pageY});
    return false;
  });

  var idSelec;
  $('table td').mousedown(function(event) {
    switch (event.which) {
        case 3:
            idSelec = $(this).closest('tr').attr("id");
            break;
    }
});

$('.nom_menu').click(function(){
  alert("Has seleccionado " + $(this).html() + " sobre la fila con id " +  idSelec);
})

  //cuando hagamos click, el menú desaparecerá
  $(document).click(function(e){
    if(e.button == 0){
      $("#menu_derecho").css("display", "none");
    }
  });

  //si pulsamos escape, el menú desaparecerá
  $(document).keydown(function(e){
    if(e.keyCode == 27){
      $("#menu_derecho").css("display", "none");
    }
  });
});
