$(document).ready(function(){

  $('#loading').css("display","none");

	$.ajax({
		type: "POST",
		url: "js/div-lpanel.php",
		data: "",
		success: function(msg){
		if(msg){
				$('div#lpanel').html(msg);
			}

		}
	});

  $.ajax({
		type: "POST",
		url: "js/chat.php",
		data: "panel=tresc",
		success: function(msg){
		if(msg){
				$('div#chat').html(msg);
			}

		}
	});

	$.ajax({
		type: "POST",
		url: "js/div-base3.php",
		data: "",
		success: function(msg){
		if(msg){
				$('div#base3').html(msg);
			}

		}
	});

	$.ajax({
		type: "POST",
		url: "js/hud1.php",
		data: "",
		success: function(msg){
		if(msg){
				$('a#exphud').html(msg);
			}

		}
	});

	$.ajax({
		type: "POST",
		url: "js/hud2.php",
		data: "",
		success: function(msg){
		if(msg){
				$('a#hphud').html(msg);
			}

		}
	});
  
  $.ajax({
		type: "POST",
		url: "js/div-otip2.php",
		data: "",
		success: function(msg){
		if(msg){
				$('div#otip2').html(msg);
			}

		}
	});

	$.ajax({
		type: "POST",
		url: "js/div-otip3.php",
		data: "",
		success: function(msg){
		if(msg){
				$('div#otip3').html(msg);
			}

		}
	});
  
	$.ajax({
		type: "POST",
		url: "js/div-gold.php",
		data: "",
		success: function(msg){
		if(msg){
				$('div#gold').html(msg);
			}

		}
	});

	$.ajax({
		type: "POST",
		url: "js/wyjscia.php",
		data: "",
		success: function(msg){
		if(msg){
				$('#oMap').html(msg);
			}

		}
	});

  $.ajax({
		type: "POST",
		url: "js/gracz-items.php",
		data: "",
		success: function(msg){
		if(msg){
				$('div#bag').html(msg);
			}

		}
	});

  $.ajax({
		type: "POST",
		url: "js/ekwipunek.php",
		data: "",
		success: function(msg){
		if(msg){
				$('div#equip').html(msg);
			}

		}
	});
  
    	$.ajax({
		type: "POST",
		url: "js/dead.php",
		data: "",
		success: function(msg){
		if(msg){
				$("b#dazedleft").html(msg);
        $("div#dazed").css("display","block");
			} else {
        $("div#dazed").css("display","none");
      }

		}
	});

	$("div#l").click(function(){
				wyslij('lewo',8,0,1);
	});
	$("div#p").click(function(){
				wyslij('prawo',-8,0,2);
	});
	$("div#g").click(function(){
				wyslij('gora',0,8,3);
	});
	$("div#d").click(function(){
				wyslij('dol',0,-8,0);
	});
	$("div#oHero").click(function(){
	 		$.ajax({
			type: "POST",
			url: "js/teleport.php",
			data:"",
			success: function(msg){
				if(msg != 0){
          location.reload();
				}
			}
		});
});

$("div#friendsbutton").click(
function(){
$("div#friends").css("display",'block');
chatmode = 2;
$.ajax({
		type: "POST",
		url: "js/friends.php",
		data: "",
		success: function(msg){
		if(msg){
				$('div#myfriends').html(msg);
			}

		}
	});
});

$("div#skillsbutton").click(
function(){
$("div#skills").css("display",'block');
$.ajax({
		type: "POST",
		url: "js/umiejetnosci.php",
		data: "",
		success: function(msg){
		if(msg){
				$('div#skillslist').html(msg);
			}

		}
	});
});

$(".motelClose").click(
function(){
$("div#friends").css("display",'none');
chatmode = 0;
});

$(".skillClose").click(
function(){
$("div#skills").css("display",'none');
});

	 $(document).keydown(function (event) {
   			if(event.keyCode==13 && chatmode==1){
          var w = document.getElementById('chatIn');
          var tekst = w.value;
          chat_wyslij(tekst);
          w.value = "";
        }
				if(event.keyCode==27 && chatmode==0){wyloguj();} else { 
        if(chatmode == 1 && event.keyCode==27){
        chatmode = 0; 
        var w = document.getElementById('chatIn');
        w.value = "";
        }}
				if(event.keyCode==65 && chatmode==0){$("div#l").click();}
				if(event.keyCode==87 && chatmode==0){$("div#g").click();}
				if(event.keyCode==68 && chatmode==0){$("div#p").click();}
				if(event.keyCode==83 && chatmode==0){$("div#d").click();}
        if(event.keyCode==49 && chatmode==0){ teleportuj(1); }
        if(event.keyCode==50 && chatmode==0){ teleportuj(2); }
        if(event.keyCode==51 && chatmode==0){ teleportuj(3); }
        if(event.keyCode==48 && chatmode==0){ teleportuj('wlasne'); }					
	});
});

function wyslij(strona,ox,oy,kierunek){
 	$.ajax({
		type: "POST",
		url: "js/idz.php",
		data:"move="+strona,
		success: function(msg){
			if(msg){
					$('#oMap').css("background-image","url("+msg+")");
          setTimeout("map_poz(x+="+ox+",y+="+oy+");animation(0,"+kierunek+");",100);
          setTimeout("map_poz(x+="+ox+",y+="+oy+");animation(1,"+kierunek+");",200);
          setTimeout("map_poz(x+="+ox+",y+="+oy+");animation(2,"+kierunek+");",300);
          setTimeout("map_poz(x+="+ox+",y+="+oy+");animation(3,"+kierunek+");",400);
          setTimeout("animation(0,"+kierunek+");",500);
				 }

		}
	});

  $.ajax({
		type: "POST",
		url: "js/chat.php",
		data: "panel=tresc",
		success: function(msg){
		if(msg){
				$('div#chat').html(msg);
			}

		}
	});

  $.ajax({
		type: "POST",
		url: "js/wyjscia.php",
		data: "",
		success: function(msg){
		if(msg){
				$('#oMap').html(msg);
			}

		}
	});

	$.ajax({
		type: "POST",
		url: "js/div-status.php",
		data: "",
		success: function(msg){
		if(msg){
				$('div#status').html(msg);
			}

		}
	});

	$.ajax({
		type: "POST",
		url: "js/div-pvpmode.php",
		data: "",
		success: function(msg){
		if(msg){
				$('div#pvpmode').css("background-position",msg);
			}

		}
	});
}

function map_poz(x,y){
$("#oMap").css("background-position", x+"px "+y+"px");
}
function animation(klatka,kierunek){
$("#oHero").css("background-position",(-klatka*32)+"px "+(-kierunek*48)+"px");
}

function teleportuj(id){
	$.ajax({
			type: "POST",
			url: "js/przenos.php",
			data:"id="+id,
			success: function(msg){
          location.reload();
			}
		});
}

function chat_wyslij(tresc){
  $.ajax({
		type: "POST",
		url: "js/chat.php",
		data: "panel=wyslij&tresc="+tresc,
		success: function(msg){
		if(msg){
           // OK
			}

		}
	});
  				  $.ajax({
		type: "POST",
		url: "js/chat.php",
		data: "panel=tresc",
		success: function(msg){
		if(msg){
				$('div#chat').html(msg);
			}

		}
	});
}

function naucz(id){
  $.ajax({
		type: "POST",
		url: "js/naucz.php",
		data: "id="+id,
		success: function(msg){
		if(msg){
           alert(msg);
			}

		}
	});
  

  $.ajax({
		type: "POST",
		url: "js/umiejetnosci.php",
		data: "",
		success: function(msg){
		if(msg){
				$('div#skillslist').html(msg);
			}

		}
	});

 	$.ajax({
		type: "POST",
		url: "js/div-lpanel.php",
		data: "",
		success: function(msg){
		if(msg){
				$('div#lpanel').html(msg);
			}

		}
	});
  
	$.ajax({
		type: "POST",
		url: "js/hud1.php",
		data: "",
		success: function(msg){
		if(msg){
				$('a#exphud').html(msg);
			}

		}
	});

	$.ajax({
		type: "POST",
		url: "js/hud2.php",
		data: "",
		success: function(msg){
		if(msg){
				$('a#hphud').html(msg);
			}

		}
	});
  
  $.ajax({
		type: "POST",
		url: "js/div-otip2.php",
		data: "",
		success: function(msg){
		if(msg){
				$('div#otip2').html(msg);
			}

		}
	});

	$.ajax({
		type: "POST",
		url: "js/div-otip3.php",
		data: "",
		success: function(msg){
		if(msg){
				$('div#otip3').html(msg);
			}

		}
	});
}
  // GOOD GAME 