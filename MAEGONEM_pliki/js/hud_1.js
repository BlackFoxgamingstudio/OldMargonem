function pokaz_hp(){
var a = document.getElementById('oTip2');
a.style.display = "block";
}
function schowaj_hp(){
var a = document.getElementById('oTip2');
a.style.display = "none";
}
function pokaz_exp(){
var a = document.getElementById('oTip3');
a.style.display = "block";
}
function schowaj_exp(){
var a = document.getElementById('oTip3');
a.style.display = "none";
}
function pokaz_quest(){
var a = document.getElementById('oQuests');
a.style.display = "block";
}
function schowaj_quest(){
var a = document.getElementById('oQuests');
a.style.display = "none";
}
function pokaz_item(item_id){
var a = document.getElementById(item_id);
a.style.display = "block";
}
function schowaj_item(item_id){
var a = document.getElementById(item_id);
a.style.display = "none";
}
function pokaz_npc(item_id){
var a = document.getElementById(item_id);
a.style.display = "block";
}
function schowaj_npc(item_id){
var a = document.getElementById(item_id);
a.style.display = "none";
}
function pokaz_ekwipunek(){
var a = document.getElementById('bag');
a.style.display = "block";
var b = document.getElementById('bagback');
b.style.display = "block";
var c = document.getElementById('chat');
c.style.display = "none";
var d = document.getElementById('eqbutton');
d.onclick = "schowaj_ekwipunek()";
}
function schowaj_ekwipunek(){
var a = document.getElementById('bag');
a.style.display = "none";
var b = document.getElementById('bagback');
b.style.display = "none";
var c = document.getElementById('chat');
c.style.display = "block";
var d = document.getElementById('eqbutton');
d.onclick = "pokaz_ekwipunek()";
}


function sklep_pokaz(id){
     	$.ajax({
			type: "POST",
			url: "js/sklep.php",
			data:"id="+id,
			success: function(msg){
				if(msg){
            $('#shop').css("display","block");
            $('#shop').html(msg);
            shop = id;
        }
    }
  });
}

function wyloguj(){
           $.ajax({
		type: "POST",
		url: "js/wyloguj.php",
		data: "",
		success: function(msg){
		if(msg){
				location.reload();
			}

		}
	});
}

function kup_przedmiot(id,cena){
     	$.ajax({
			type: "POST",
			url: "js/kup.php",
			data:"id="+id+"&cena="+cena,
			success: function(msg){
				if(msg){
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
		url: "js/dead.php",
		data: "",
		success: function(msg){
		if(msg){
				$('div#dazedleft').html(msg);
        $('div#dazed').css("display","block");
			} else {
        $('div#dazed').css("display","none");
      }

		}
	});
        }
    }
  });
}

function zamknij_sklep(){
var a = document.getElementById('shop');
a.style.display = 'none';
shop = 0;
}

function zdejmij(strona){
     	$.ajax({
			type: "POST",
			url: "js/zdejmij.php",
			data:"typ="+strona,
			success: function(msg){
				if(msg){
            
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
				       }
			  }
		  });
}

function zaloz(strona){
if(shop==0){
     	$.ajax({
			type: "POST",
			url: "js/zaloz.php",
			data:"id="+strona,
			success: function(msg){
				if(msg){
                  
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
				       }
			  }
		  });
      } else {
      
      
      $.ajax({
			type: "POST",
			url: "js/sprzedaj.php",
			data:"id="+strona+"&sklep="+shop,
			success: function(msg){
				if(msg){
                  document.write();
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
		url: "js/gracz-items.php",
		data: "",
		success: function(msg){
		if(msg){
				$('div#bag').html(msg);
			}

		}
	});
      
      }
}

function walcz(id,id2){
    $.ajax({
		type: "POST",
		url: "js/walcz1.php",
		data: "id="+id+"&id2="+id2,
		success: function(msg){
		if(msg){
				alert(msg);    
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
		url: "js/wyjscia.php",
		data: "",
		success: function(msg){
		if(msg){
				$('#oMap').html(msg);
			}

		}
	});
  
			} else { $alert('Blad'); }

		}
	});
}

function pvp(id,id2){
    $.ajax({
		type: "POST",
		url: "js/pvp.php",
		data: "id="+id+"&id2="+id2,
		success: function(msg){
		if(msg){
				alert(msg);    
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
		url: "js/wyjscia.php",
		data: "",
		success: function(msg){
		if(msg){
				$('#oMap').html(msg);
			}

		}
	});
  
			} else { $alert('Blad'); }

		}
	});
}

