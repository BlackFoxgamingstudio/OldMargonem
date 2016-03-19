function lpanel(){

    if(pp==0){
	 		$.ajax({
			type: "POST",
			url: "js/lpanel-pages.php",
			data:"strona=1",
			success: function(msg){
				if(msg){
            $('div#stat2').css("background-position","0px -98px");
            $('div#stat2in').html(msg);
				}
			}
		});
    }
        if(pp==1){
	 		$.ajax({
			type: "POST",
			url: "js/lpanel-pages.php",
			data:"strona=2",
			success: function(msg){
				if(msg){
            $('div#stat2').css("background-position","0px -196px");
            $('div#stat2in').html(msg);
				}
			}
		});
    }
    
        if(pp==2){
	 		$.ajax({
			type: "POST",
			url: "js/lpanel-pages.php",
			data:"strona=3",
			success: function(msg){
				if(msg){
            $('div#stat2').css("background-position","0px -294px");
            $('div#stat2in').html(msg);
				}
			}
		});
    }
    
        if(pp==3){
	 		$.ajax({
			type: "POST",
			url: "js/lpanel-pages.php",
			data:"strona=0",
			success: function(msg){
				if(msg){
            $('div#stat2').css("background-position","0px 0px");
            $('div#stat2in').html(msg);
				}
			}
		});
    }
    
    if(pp < 3){ pp = pp + 1; }
    else {pp = 0;}
}