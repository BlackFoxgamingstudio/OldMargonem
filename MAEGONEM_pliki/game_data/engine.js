// initiates all in-game objects
function init()
{
	log("Engine started.");
	k_add(KTILDE,37,39,38,40,81,106,13,90); // ~,l,r,up,dn,Q,*,enter,Z(8)
	alts[1]=65;alts[2]=68;alts[3]=87;alts[4]=83;

	global=new Object();
	global.console= new Object();
	global.console.keylog=false;
	global.towns=new Array();
	global.initlvl=1;
	global.path=new Object();
	global.path.server='http://www.margonem.pl';
	global.path.wwwserver='http://www.margonem.pl';
	global.serverno=1;
	if(window.location.href.indexOf('http://game')>=0) {
		tmp=window.location.href.split('.');
		www=tmp[0];
		t2=window.location.href.split('.');
		t3=t2[0].split('game');
		global.serverno=t3[1];
	}
	else www='http://www';
	global.path.characters=www+'.margonem.pl/obrazki/postacie';
	global.path.npc=www+'.margonem.pl/obrazki/npc';
	global.path.items=www+'.margonem.pl/obrazki/itemy';
	global.path.maps='/obrazki/miasta';
	global.ajax=new Object();
	global.ajax.busy=false;
	global.ajax.queue=new stack(3);
	global.ajax.t0=0; // start query time
	global.ping=false; // ping on screen
	global.msg=new stack();
	global.refresh=0;
	global.dontmove=false;
	global.movebymouse=false;
	global.chatFocus=false;
	global.chatFocus2=false;
	global.chatIdx=0;
	global.clChatIdx=0;
	global.chreply='';
	global.chatBan=0;
	global.eventseq=0;
	global.drag=false;
	global.debug=false;
	global.battle=new Object();
	global.battle.now=false;
	global.battle.id=0;
	global.battle.agrnow=false;
	global.battle.places=new Array();
	global.battle.selected=0;
	global.battle.seq=0;
	global.battle.posx=new Array();
	global.battle.width=new Array();
	global.lastchat='';
	global.clans=new Array();
	global.trader=0;
	global.bag=0;
	global.bagon=false;
	global.attitem=0;
	global.confirmdel=false; // confirm delete item in 'trash' place
	global.r=new Object(); // rollover ofsets
	global.r.closebattle=-38;
	global.r.pvpbutton=-44;
	global.r.eqbutton=0;
	global.rpg=false;
	global.pvp=false;
	global.gm=false;
	global.lastdrop=0;
	global.myau=true; // my auctions are shown or browsing other's auctions
	global.aulv1=0;
	global.aulv2=0;
	global.aup1=0;
	global.aup2=0;
	global.atype=0;
	global.auname='';
	global.sakwa=0;
	global.logoff=0;
	initEqGlobals();
	il=new ImageLoader(); // preloads all ingame images
	setih('objects','');
	setih('chatTxt','');
	hide('menu',true);
	ol=new ObjectLoader(); // creates list of IMG objects
	el=new elements();
	map=new theMap();
	hero=(); // first key number
	tip=new tips('oTip');	
	document.getElementById('consoleIn').onkeyup=onConsoleWrite;
	document.getElementById('chatIn').onkeyup=onChatWrite;
	document.getElementById('tradegold').onkeyup=onGoldWrite;
	window.focus();
	var agt=navigator.userAgent.toLowerCase();
	ie6=(agt.indexOf("msie 6.")!=-1);	
	if(navigator.userAgent.indexOf("Opera") > -1) { 
		log("Opera detected. It is NOT supported browser.",1);
/*		error("Opera nie potrafi poradzić sobie z technologiami używanymi w grze Margonem." 
			+"Jeśli to możliwe zmień przeglądarkę na FF lub IE.");*/
		ie6=false;
	}
	if(ie6) { 
		ge('menu').style.background=''; 
		ge('dialog').style.background='';
		ge('mailnotifier').style.background='';
	}
	setTimeout("dbget('init','initlvl=1&build=1008')",500);
	document.onmousemove=mousemove;
	document.onclick=mouseclick;	
	document.onmouseup=mouseup;	
	document.onmousedown=mousedown;	
	document.onmouseover=mouseover;
	document.onmouseout=mouseout;
	log("init() complete");
	log(navigator.userAgent);
	hide('bagback',false);
	
	// tips
	addEvent(document.getElementById('lagometer'),'mouseover',function (e) {
		if(!e)var e=window.event;
		global.ping=true;
		tip.show(e.clientX,e.clientY,'','<B>Ping:</B>'+global.ajax.t1+'ms');			
	});
	addEvent(document.getElementById('lagometer'),'mouseout',function (e) {tip.hide();global.ping=false;});

	// chat/eq button	
	addEvent(document.getElementById('eqbutton'),'click',togglechat);
}

function togglechat(e) {
	if(!global.bagon) {
		hide('chat',false);
		hide('chatIn',false);
		show('bag', false);
		show('bagback', false);
		global.r.eqbutton=-40;
		if(k[5]) document.getElementById('eqbutton').style.backgroundPosition='0 -40px';
		else document.getElementById('eqbutton').style.backgroundPosition='0 -60px';
		global.bagon=true;
	} else {
		show('chat',false);
		show('chatIn',false);
		hide('bag', false);
		hide('bagback', false);
		global.r.eqbutton=0;
		if(k[5]) document.getElementById('eqbutton').style.backgroundPosition='0 -0px';
		else document.getElementById('eqbutton').style.backgroundPosition='0 -20px';
		global.bagon=false;
	}
}

// IE PNG fix
function iefix() { 	 	
	if (document.all && document.styleSheets && document.styleSheets[0] && document.styleSheets[0].addRule && ie6)
	{
		// Feel free to add rules for specific tags only, you just have to call it several times.
		document.styleSheets[0].addRule('IMG.fixit', 'behavior: url(iepngfix.htc)');
		log('IE6 PNG fix loaded');
	}
}

// fires when serious error occurs
function loaderror(sMsg,sUrl,sLine)
{
	document.getElementById('loading').innerHTML="<span>Wystąpił błąd podczas ładowania gry</span>";
	log(navigator.userAgent);
	log("'"+sMsg+"' in "+sUrl+" at line: "+sLine,3);
	document.getElementById('mconsole').style.display='block';	
} 

function mousemove(e) {
	if(!e)var e=window.event;
	if(tip.on) tip.move(e.clientX,e.clientY);
	global.logoff=0;
	if(global.drag){
		var it=global.drag;
		var obj=document.getElementById('oDrag');
		obj.style.left=(it.ox+it.orgx-(it.x-e.clientX))+"px";
		obj.style.top=(it.oy+it.orgy-(it.y-e.clientY))+"px";
		return false;
	}
	if(global.movebymouse) hero.setMousePos(e.clientX,e.clientY);
}
function mouseup(e) {
	if(!e)var e=window.event;
	if(global.drag){
		global.drag.onup(e);
	}
	global.movebymouse=false;
}
function mousedown(e) {
	if(!e)var e=window.event;
	if (e.target) targ = e.target;
	else if (e.srcElement) targ = e.srcElement;
	if((!(hero.opt&64)) && (!global.battle.now) && (targ.id=='oMap' || targ.className=='cItem')) {
		hero.setMousePos(e.clientX,e.clientY);
		global.movebymouse=true;
	}
	if(targ.tagName == "IMAGE") return false;
}
function mouseclick(e) {
	if(!e)var e=window.event;
	if (e.target) targ = e.target;
	else if (e.srcElement) targ = e.srcElement;
	if(targ.id.length==3 && targ.id.substr(0,2)=='rr') {
		var orid=document.getElementById('oldrid').value;		
		if(targ.id!='rr1' && orid>0 && orid<100) {
			targ.innerHTML=(targ.innerHTML=='0')?'1':'0';
			rr=0;
			for(i=1,b=1;i<8;i++,b<<=1)
				if(parseInt(document.getElementById('rr'+i).innerHTML)&b>0) rr+=b;
			document.getElementById('rankr').value=rr;
		}
	}
}
function mouseout(e) {
	if(!e)var e=window.event;
	if (e.target) targ = e.target;
	else if (e.srcElement) targ = e.srcElement;
	if(tip.on) tip.hide();
	if(targ.getAttribute('rollover')) {
	 	if(dy=global.r[targ.id]) targ.style.backgroundPosition='0 '+dy+'px';
		else targ.style.backgroundPosition='0 0';
	}
}
function mouseover(e) {
	var targ;
	if (!e) var e = window.event;
	if (e.target) targ = e.target;
	else if (e.srcElement) targ = e.srcElement;
	if(targ.getAttribute('tip')) tip.show(e.clientX+document.body.scrollLeft,e.clientY+document.body.scrollTop,targ.getAttribute('tipcl'),targ.getAttribute('tip'));
	if(dy=targ.getAttribute('rollover')) {
		if(dy2=global.r[targ.id]) targ.style.backgroundPosition='0 '+(parseInt(dy2)-dy)+'px';
		else targ.style.backgroundPosition='0 -'+dy+'px';
	}
}

window.onload=init;
window.onerror=loaderror;

function error()
{
	alert(arguments[0]);
} 
function message(s)
{
	global.msg.push(s);
	if(global.msg.size()==1) show('msg',false);
	s=global.msg.data.join('<BR>');
	document.getElementById('msg').innerHTML=s;
	setTimeout("delmsg()",1000+1000*global.msg.size());
}
function delmsg()
{
	global.msg.pop();
	if(global.msg.size()<=0)
		hide('msg',false);
	else {
		var s=global.msg.data.join('<BR>');
		document.getElementById('msg').innerHTML=s;
	}
}

function logout()
{
	setCookie('chash','',0,'/','margonem.pl');
	setCookie('user_id','',0,'/','margonem.pl');
	top.location.href="http://www.margonem.pl";	
}

function ge(obj)
{ return document.getElementById(obj); }

function setih(obj,txt)
{	document.getElementById(obj).innerHTML=txt; }
 
// send a message to server
function dbget()
{
	var l=arguments.length;
	var task= l>0?arguments[0]:"";
	var params= l>1?arguments[1]:"";
	if(global.ajax.busy) {
		if(task!='_' && task!='go')global.ajax.queue.push(arguments);
		return;
	}	
	global.ajax.busy=true;
	global.ajax.t0=nowms();
	var to=(task=="init")?10000:2000;	
	advAJAX.get({
		url: "db.php",
		timeout : to,
		queryString : params,
		parameters : {
			"task": task,
			"pid": hero.pid,
//			"hash": hero.hash,
			"ev": global.eventseq,
			"lastch": global.chatIdx,
			"lastcch": global.clChatIdx,
			"bseq": global.battle.seq,
			"pdir": hero.kier
		},
		onError : function(obj) { log("ajax: " + obj.status,2); },
		onFatalError : function(obj) { log("ajax: " + obj.status,3); },
		onSuccess : function(obj) { proceed(obj.responseText);	},
		onTimeout : function(obj) { global.ajax.t1=9999; },
		//onInitialization : function(obj) { },		
		onFinalization : function(obj) { 
			global.ajax.busy=false; 
			global.ajax.t1=nowms()-global.ajax.t0;
			if(global.ajax.t1<0)global.ajax.t1+=60000;
			if(global.ping) tip.update('<B>Ping:</B>'+global.ajax.t1+'ms'); 
			}		
	})
	global.refresh=0;
}
function forceget()
{
	var l=arguments.length;
	var task= l>0?arguments[0]:"";
	var params= l>1?arguments[1]:"";
	advAJAX.get({
		url: "db.php",
		timeout : 2500,
		queryString : params,
		parameters : {
			"task": task,
			"pid": hero.pid,
			"ev": 99999999,
			"lastch": 99999999,
			"lastcch": 99999999
//			,"hash": hero.hash
		},
		onError : function(obj) { log("ajax: " + obj.status,2); },
		onFatalError : function(obj) { log("ajax: " + obj.status,3); },
		onSuccess : function(obj) { proceed(obj.responseText);	}
	});	
	global.refresh=0;
}

function advget(task,params)
{
	var l=arguments.length;
	var additional = '';
	for(i=2;i<l;i++)
		additional+='&'+arguments[i]+'='+escape(document.getElementById(arguments[i]).value);
	dbget(task,params+additional);
	if(task=='clan') tip.hide();
}
function advgeti(task,params,additional)
{
	dbget(task,params+'&'+additional+'='+escape(document.getElementById(additional).innerHTML));
}

function proceed(response)
{
	//  states for friends list
	enstate=new Array('niedawno aktywny(a)','był(a) kilka dni temu','od dawna nieaktywny(a)');
	enstcol=new Array('#6f6','#888','#000');
	response=response.split('<eol>');
	var cht=''; 
	var mails='';
	var runt=false;
	var alldata=false;
	for(key in response) {
		var val=response[key].split(':');
		var cmd=val[0];
		val=response[key].substr(cmd.length+1);
		switch(cmd){
			//////////// PLAYER COMMANDS /////////
			case 'hero': hero.setup(val);	break;
			case 'rpg' : global.rpg=true; break;
			case 'pvp' : global.pvp=true; break;
			case 'gm'  : global.gm=true; show('constat'); break;
			case 'move': hero.go(val.split(',')); break;
			case 'xy'  : hero.synchMove(val); break;
			case 'collisions': hero.cmap=val; break;
			case 'stats': hero.stats(val); break;
			case 'dazed': hero.dazedleft=parseInt(val);
				if(hero.dazed) break;
				show('dazed',true); 
				hero.dazed=true;
				hero.countDazed(); 
				break;
			case 'dontblock' : global.battle.agrnow=false; 
												if(val>0) el.del(parseInt(val),'npc'); 
												break;
			case 'battleend': hide('battle',true);
												global.battle.selected=0;
												el.delall('troop');
												global.battle.now=false; 
												break;
			case 'battlenow': if(!global.battle.now || global.battle.id!=val) { 
														global.battle.seq=0;
														global.battle.id=val;
														global.battle.agrnow=false;
														document.getElementById('battlein').innerHTML='';
														el.delall('troop');
														show('battle',true); 
														dbget('fight','action=refresh');
														global.battle.now=true; 
														tip.hide();
												} 
				break;
			case 'battleref':	el.delall('troop');
												global.dontmove=true;
												global.battle.posx=new Array();
												global.battle.width=new Array();
												document.getElementById('battleplace').style.backgroundImage='url(http://www.margonem.pl/obrazki/battle/'+val+')';												
												break;
			case 'battlemsg': val=val.split(';;'); 
				global.battle.seq=parseInt(val[0]);
				document.getElementById('battlein').innerHTML+="<P class=battr"+val[1]+">"+val[2]+"</P>";
				var c1=document.getElementById('battlein');
				c1.scrollTop = c1.scrollHeight;				
				break;
			case 'battleinfo': setih('battletime',val); break;
			case 'spells': sp=val.split(';');
				document.getElementById('spell').options.length=0;
				if(val.length>0)
				for(i=0;i<sp.length;i++) {
					ss=sp[i].split(',');
					document.getElementById('spell').options[i]=new Option(ss[1], ''+ss[0]);
				}
				break;
			/////////// EVENTS
			case 'othermove': val=val.split(',');   
				for(var i in el.eList)
					if((el.eList[i].type=='other')&&(el.eList[i].id==val[0])) 
						el.eList[i].handler(val[1]); 
					break;
			case 'lastevent': global.eventseq=val; break;
			/////// ELEMENTS
			case 'cleareq': el.delall('equip'); break;
			case 'element' : el.add(val); break;
			case 'delete' : val=val.split(','); el.del(val[0],val[1]); break;
			///////////// SHOP
			case 'newshop': el.delall('shop');
				val=val.split(';');
				if(val[0]=='' || val[0]==' ') val[0]='nic';
				if(parseInt(val[2])==0) val[2]='brak limitu';
				if(val[4]=='ph') setih('shopinfo','Sprzedaż za <b>Punkty Honoru</b>'); else
				if(val[4]=='sl') setih('shopinfo','Sprzedaż za <b>Smocze Łzy</b>'); else
				setih('shopinfo','<b>Ceny:</b> '+val[3]+'<br><b>Skupuje:</b> '
					+(val[0]=='nic'?'nic':(val[0]+'<br><b>Płaci </b> '+val[1]+'% wartości,  <b>maksymalnie:</b> '+val[2]))); 
				break;
			case 'shop': show('shop',true); break;
			//////////// TRADE
			case 'tradestart': show('trade',true); global.trader=val; break;			
			case 'tradeinit': if(global.trader==0) break;
												val=val.split(','); o1=0; o2=0; //offset
												if(hero.nick==val[0]) o1=1; else o2=1;
												setih('tradername1',val[o1]);
												setih('tradername2',val[o2]);
												setih('gold1',val[4+o1]);
												setih('gold2',val[4+o2]);
												document.getElementById('tradeaccept1').style.backgroundPosition=parseInt(val[2+o1])?'0 0':'0 20px';
												document.getElementById('tradeaccept2').style.backgroundPosition=parseInt(val[2+o2])?'0 20px':'0 0';
												el.delall('trade'); 
												break;
			case 'tradeend': hide('trade',true); el.delall('trade'); break;
			/////////// DIALOGS
			case 'dialogi': val=val.split(','); hero.initTalk(val[0],val[1].split('~').join(',')); break;
			case 'dialog': if(val.indexOf('<sakwa>')>0)global.sakwa=30;
											val=val.split(','); 
											hero.addTalk(val[0],val[1].split('~').join(',')); 
											break;
			case 'koniecdialogu': hero.endTalk(); break;			
			/////////// CHAT
			case 'maxchat': global.chatIdx=val; break;
			case 'maxcchat': global.clChatIdx=val; break;
			case 'chat': var re=new RegExp(hero.nick, "i");
					val=unescape(val);
					if(val.indexOf('<span class=chpriv>')==0 && val.indexOf('od: ')>0){
						v1=val.split('» ');
						global.chreply=v1[0].substr(v1[0].indexOf('od: ')+4).split(' ').join('_');
						cht=val+'<br>'+cht;
					} else
					if(val.indexOf('<span ')!=0) {
						val=val.replace(re,"<b class=yourname>"+hero.nick+"</b>");
						cht=val.replace(/«(.*?)»/,"<span style='color:#ff7'>«$1»<\/span>")+'<br>'+cht;
					} else cht=val+'<br>'+cht;
					if(document.getElementById('chat').style.display=='none') {
						global.r.eqbutton=-80;
						document.getElementById('eqbutton').style.backgroundPosition='0 -80px';
					}						
				break;
			/////////// TOWN				
			case 'town': runt=true; map.loadMap(val); map.center(hero.x,hero.y);break;
			case 'townname': val=val.split(';'); global.towns[parseInt(val[0])]=val[1]; break;
			//////// CLANS
			case 'createclan': setTimeout("createClan("+val+")",30); break;
			case 'claninvite': setTimeout("inviteClan('"+val+"')",30); break;
			case 'clan': document.getElementById('clancontent').innerHTML=val; break;
			case 'clanlogo': document.getElementById('clanlogo').style.backgroundImage='url('+val+')'; break;
			case 'clanname': val=val.split(','); global.clans[val[0]]=val[1]; break;
			//////// FRIENDS LIST
			case 'friends': list=val.split(';');
				fr='';
				en='';
				for(i=0;i<list.length;i++) 
				if(list[i].length>3){
					x=list[i].split(',');
					if(x[0]=='e')
						en+='<div class=frbox><div class=frchar style="background-image:url('+global.path.characters+x[3]
							+')"></div><div class=delen rollover=22 onclick=dbget("friends","proc=delen&id='+x[4]+'")></div>'+x[1]+'('+x[2]+')'
							+'<br><small style="color:'+enstcol[parseInt(x[5])]+'">('+enstate[parseInt(x[5])]+')</small></div>';
					else {
						var frs=parseInt(x[5]); // state, 0-online, 1-offline, 2,3 - dazed
						var frl=parseInt(x[9]); // last time online
						var frsate='';
						var frcol='#999';
						if(frs==0) { frstate='online'; frcol='#6f6';}
						else if((frs>1)&&(frl<1)) {frstate='online, nieprzytomny'; frcol='#09f';}
						else {
							frstate='offline od ';
							if(frl<110) frstate+=frl+' min';
							else if(frl<1440) frstate+=Math.round(frl/60)+' h';
							else frstate+=Math.round(frl/1440)+' dni';
						}
						fr+='<div class=frbox><div class=frchar style="background-image:url('+global.path.characters+x[3]
							+')"></div><div class=delfr rollover=22 onclick=dbget("friends","proc=delfr&id='+x[4]+'")></div>'
							+'<div class=chatfr rollover=22 onclick=\'chatfr("'+x[1]+'")\'></div><b>'+x[1]+'('+x[2]+')</b><br>'
							+'<small style="color:'+frcol+'">('+frstate+')</small><br>'
							+'<span class=frloc>'+x[6]+'('+x[7]+','+x[8]+')</span></div>';
						}
				}
				setih('myfriends',fr); 
				setih('myenemies',en); 
				ge('enname').value='';
				ge('frname').value='';
				show('friends',true); 
				break;
			case 'friendship': setTimeout("friendship('"+val+"')",30); break;
			case 'refreshfriends': if(document.getElementById('friends').style.display=='block') setTimeout("dbget('friends')",30); break;
			//////// MAILS
			case 'newmails': show('mails',true);
				ge('inbox').innerHTML='<br clear=all>'; 
				hero.mails=0; 
				hide('newmail',false);
				global.attitem=0;
				ge('attitem').innerHTML=''; 
				break;
			case 'mail': m=val.split('||');
				att='';
				if(m[2]>0) att+=' Złoto: '+m[2]; 
				if(m[3]>0) att+=' SŁ: '+m[3];
				if(m[4]!='') att+=m[4];
				mail='<div class=mail>';
				if(att!='') mail+='<div class=mailattdel rollover=22 tip="Pobierz i usuń" onclick=\'dbget("mails","proc=del&from='+escape(m[1])+'&ts='+m[5]+'&bag="+global.bag)\'></div>'
					+'<div class=mailatt rollover=22 tip="Pobierz załącznik" onclick=\'dbget("mails","proc=get&from='+escape(m[1])+'&ts='+m[5]+'&bag="+global.bag)\'></div>'
					+'<div class=mailrep rollover=22 tip="Odpowiedz" onclick=mailreply("'+escape(m[1])+'")></div>Od: <b>'
					+m[1]+'</b> '+m[0]+'<br><b>Załączniki:</b>'+att;
				else mail+='<div class=maildel rollover=22 tip="Usuń wiadomość" onclick=dbget("mails","proc=del&from='+escape(m[1])+'&ts='+m[5]+'")></div>'
					+'<div class=mailrep rollover=22 tip="Odpowiedz" onclick=mailreply("'+escape(m[1])+'")></div>Od: <b>'+m[1]+'</b> '+m[0];
				mail+='<br>'+m[6]+'</div>';
				mails+=mail;
				break;
			case 'sentdone': 
				ge('mailmsg').value=''; 
				ge('mailgold').value=''; 
				ge('receiver').value=''; 
				hide('newmail',false);
				global.attitem=0;
				ge('attitem').innerHTML='';
				alert('Wiadomość wysłana.'); 
				break;
			//////// AUCTIONS
			case 'auctions': myauctions(''); break;
			case 'aubrowse': aubrowse(val.split(',')); ge('ahpanel').scrollTop=0; break;
			case 'auctionsend': myauctions("Aukcja wystawiona. Możesz wystawić następną."); break;
			case 'ahitem': ahitem(val.split('||')); break;
			////////// OTHER
			case 'quests': document.getElementById('questsTxt').innerHTML=val; break;
			case 'walka' : if(tip.on)tip.hide();
				document.getElementById('battlein').innerHTML=val; 
				show('battle',true); 
				break;
			case 'blokok': log('Gateway (un)blocked.'); break;
			case 'motel': show('motel',true); setih('moteltxt',val); break;
			case 'skills': showskills(val); break;
			case 'skillshop': skillshop(val); break;
			/////////// SYSTEM MESSAGES 		
			case 'alert' : alert(val); break;	
			case 'reload': document.location.reload(); clearInterval(thread1); return;
			case 'msg'   : message(val); break;		
			case 'log'   : log(val); break;		
			case 'error' : log(val,2); break;
			case 'ferror' : log(val,3);	document.getElementById('mconsole').style.display='block';	break;
			case 'toomany' : toomany(val); break;
			case 'banned' : alert("Twoje IP jest zablokowane."); clearInterval(thread1); break;
			case 'sqltime': document.getElementById('servstat').innerHTML=val; break;
			case 'stop': clearInterval(thread1); break;
			case 'end' : alldata=true; 
		}
	}
	if(mails!='') ge('inbox').innerHTML=mails;
	if(cht!='') {
		ge('chatTxt').innerHTML+=cht;
		var c1=ge('chat');
		c1.scrollTop = c1.scrollHeight;
	}	
	if(runt) thread1=setInterval(gameThread,100);
	if(global.initlvl<4) {	
		if(!global.gm && window.console && window.console.firebug) {
			dbget=function(){};
			clearInterval(thread1);
			log('Aby grać w Margonem musisz wyłączyć Firebuga.',3);
		}
		if(!alldata)document.location.reload();
		global.initlvl++;
		dbget('init','initlvl='+global.initlvl);		
	}
}

function gameThread()
{
	/* resend queued commands */
	if(!global.ajax.busy && (global.ajax.queue.size()>0))
	{
		var args=global.ajax.queue.pop();
		if(args.length==0) dbget();
		if(args.length==1) dbget(args[0]);
		if(args.length==2) dbget(args[0],args[1]);
	}	
	if(k[7] && (!global.chatFocus) && (!global.dontmove)) {
		var con=document.getElementById('mconsole'); 
		if(con.style.display!='block') {
			global.chatFocus=true; 
			document.getElementById('chatIn').focus(); 
			k[7]=false;
		}
	}
	if(k[8]) doFight('quit');
	if(global.sakwa>0) {
		if(Math.ceil(global.sakwa/5)&1) hide('sakwa',false); else show('sakwa',false);
		global.sakwa--;
	}
	global.logoff++; // counter till logoff
	if(global.logoff>(global.gm?9000:3000)) {
		 clearInterval(thread1);
		 ge('dazed').innerHTML='Zostałeś wylogowany z powodu braku aktywności.<br><br><button onclick="document.location.reload()">Wejdź do gry</button>';
		 show('dazed',true);
	}
	if(global.chatBan>0) global.chatBan--;
	
	/* toggle console */
	if(k[0]){
		k[0]=false;
		var con=document.getElementById('mconsole'); 
		if(con.style.display=='block') {
			con.style.display='none';
			global.dontmove=false;
		}	else {
			con.style.display='block';
			document.getElementById('consoleIn').value='';
			document.getElementById('consoleIn').focus();
			global.dontmove=true;		
		}
	}	
	if(global.initlvl<4) return;
	if(document.getElementById('mconsole').style.display!='block')
		if(k[5]) { log('k5'); togglechat(); k[5]=false; }
	
	mntop=parseInt(ge('mailnotifier').style.top);
	if(hero.mails>0 && mntop>485) ge('mailnotifier').style.top=(mntop-1)+'px';
	else if(hero.mails==0 && mntop<512) ge('mailnotifier').style.top='512px';
	var iml=document.getElementById('imgloaded');
	if(il.imgList.length>il.nLoaded+il.nErrors) {
		iml.style.display='block';
		iml.innerHTML='Ładuję obrazki ('+(il.nLoaded+il.nErrors)+'/'+il.imgList.length+')';
	} else if (iml.style.display!='none')iml.style.display='none';
	global.refresh++;
	if(global.refresh>10)  
		if(!hero.doMove()) dbget("_");
	if(!global.dontmove)hero.run();
	el.draw();
	var ga=global.ajax;
	if((ga.t1>0)&&(ga.t1<2000)) {
		//setih("status", "<span style='color:"+map.getColor()+"'>"+map.name+"</span> ("+hero.x+","+hero.y+") "+ga.t1+"ms");
		tmp=map.name+" ("+hero.x+","+hero.y+")";
		if(document.getElementById('status').innerHTML!=tmp) setih("status", tmp);
		if(ga.t1<80) lagY=0;
		else if(ga.t1<130) lagY=1;
		else if(ga.t1<180) lagY=2;		
		else if(ga.t1<250) lagY=3;
		else if(ga.t1<350) lagY=4;
		else lagY=5;
		document.getElementById('lagometer').style.backgroundPosition='0 -'+(lagY*32)+'px';
	}
	el.checkAgressive(hero.x, hero.y);
}

// key hanlder for chat input box
function onChatWrite(e)
{
	if (!e) var e = window.event;
	var c=e.keyCode;
	var oIn=document.getElementById('chatIn');
	if(oIn.value=='/r') oIn.value='@'+global.chreply+' ';
	if(c==13){
		if(oIn.value!='') {
			if(global.chatBan>9) { alert('Pisz wolniej! Nikt nie lubi spamu/floodu na czacie.\nOdczekaj teraz 5 sekund.'); global.chatBan=50; } else
			if(global.lastchat!=oIn.value) {
				dbget('chat','tekst='+escape(oIn.value).split('+').join('%2B'));
				global.chatBan+=10;
			}	else alert('Wystarczy napisać raz. \nZa floodowanie/spamowanie można co najwyżej dostać kicka od MG.'); 
			global.lastchat=oIn.value;
			oIn.value='';
		}
		if(global.chatFocus && global.chatFocus2){
			document.body.focus();
			k[7]=false;
			global.chatFocus=false;
			global.chatFocus2=false;
		}
	}	else global.chatFocus2=true;
}

function show(what,block)
{
	document.getElementById(what).style.display='block';
	if(block) global.dontmove=true;
	if(global.initlvl<4) return;
	hero.resetMouse();
}
function hide(what,unblock)
{
	document.getElementById(what).style.display='none';
	if(unblock) global.dontmove=false;
	if(global.initlvl<4) return;
	hero.resetMouse();
}
function round(n,precise,sep)
{
	n=parseFloat(n);
	if(precise==3) {
		n=n.toString();
		var newn='';
		if(!sep) var sep=" ";
		while(n.length>3) {
			var last3=n.substr(n.length-3,3);
			n=n.substring(0,n.length-3);
			newn=sep+last3+newn;
		}		
		return n+newn;
	} else
	if(precise==2) {
		if(n<1000) return n;
		if(n<1000000) return Math.round(n/100)/10+"k";
		if(n<1000000000) return Math.round(n/100000)/10+"m";
		if(n<10000000000) return Math.round(n/100000000)/10+"g";
		return Math.round(n/1000000000)+"g";
	} else
	if(precise==1) {
		if(n<10000) return n;
		if(n<100000) return Math.round(n/100)/10+"k";
		if(n<10000000) return Math.round(n/1000)+"k";
		if(n<100000000) return Math.round(n/100000)/10+"m";
		if(n<1000000000) return Math.round(n/1000000)+"m";
		if(n<10000000000) return Math.round(n/100000000)/10+"g";
		return Math.round(n/10000000000)+"g";		
	} else
	{
		if(n<1000) return n;
		if(n<1000000) return Math.round(n/1000)+"k";
		if(n<1000000000) return Math.round(n/1000000)+"m";
		return Math.round(n/1000000000)+"g";
	}
}

function nowms() 
{
	var now=new Date();
	return now.getSeconds()*1000+now.getMilliseconds();
}

function doFight(what)
{
	switch(what) {
		case 'attack': dbget('fight', 'action=attack&who='+global.battle.selected); break;
		case 'move'  : dbget('fight', 'action=move'); break;
		case 'spell' : spl=document.getElementById('spell'); 
									if(spl.selectedIndex>-1) dbget('fight', 'action=spell&who='+global.battle.selected
										+'&spell='+spl.options[spl.selectedIndex].value); 
									break;
		case 'quit'  : dbget('fight', 'action=quit'); break;
	}
}

function toomany(n) {
	log("Too many users online, limit="+n,2);
	alert("Przekroczono limit graczy online.\n");
	clearInterval(thread1);
	hide('loading');
}

function createClan(val)
{
	str=prompt("Podaj nazwę swego klanu:");
	if(str) 
		dbget('clan','proc=create&clanname='+str+'&npcid='+val);
}

function inviteClan(val)
{
	val=val.split(',');
	if(confirm("Czy chcesz dołączyć do klanu "+val[1]))
		dbget('clan','proc=join&ticket='+val[0]);
}

/* trade window */
function cancelTrade()
{
	dbget('trade','tt=2&who='+global.trader);
	global.trader=0;
	el.delall('trade');	 
	hide('trade', true);
}
function acceptTrade()
{
	dbget('trade','tt=7&who='+global.trader);
}
function setGold()
{
	var oIn=document.getElementById('tradegold');
	dbget('trade','tt=6&who='+global.trader+'&gold='+oIn.value);
	oIn.value='';
}
function onGoldWrite(e)
{
	if (!e) var e = window.event;
	var c=e.keyCode;
	if(c==13) setGold();
}

/* configuration window */
function cfgupdate()
{
	document.getElementById('opt1').style.backgroundPosition=(hero.opt2&1)?'0 -22px':'0 0';
	document.getElementById('opt2').style.backgroundPosition=(hero.opt2&2)?'0 -22px':'0 0';
	document.getElementById('opt3').style.backgroundPosition=(hero.opt2&4)?'0 -22px':'0 0';
	document.getElementById('opt4').style.backgroundPosition=(hero.opt2&8)?'0 -22px':'0 0';
	document.getElementById('opt5').style.backgroundPosition=(hero.opt2&16)?'0 -22px':'0 0';
	document.getElementById('opt6').style.backgroundPosition=(hero.opt2&32)?'0 -22px':'0 0';
	document.getElementById('opt7').style.backgroundPosition=(hero.opt2&64)?'0 -22px':'0 0';
}
function config_show()
{
	hero.opt2=hero.opt;
	cfgupdate();
	show('config', true);
}
function optclick(x)
{
	hero.opt2^=1<<(x-1);
	cfgupdate();
}
function config_save()
{
	dbget('config','opt='+hero.opt2);
	hide('config', true);
}
/* clan window */ 
function loadrank(id,name,rights)
{
	if(id==100 || id==0) document.getElementById('rankid').disabled=true;
	else document.getElementById('rankid').disabled=false;
	document.getElementById('oldrid').value=id;
	document.getElementById('rankid').value=id;
	document.getElementById('rankname').value=name;
	document.getElementById('rankr').value=rights;
	for(var i=1,b=1;i<8;i++,b*=2)
		document.getElementById('rr'+i).innerHTML=((rights&b)>0)?1:0;
}
function clearrank()
{
	document.getElementById('oldrid').value=-1;
	document.getElementById('rankid').disabled=false;
	document.getElementById('rankid').value=1;
	document.getElementById('rankname').value='';
	document.getElementById('rankr').value=0;	
	for(i=1;i<8;i++)
		document.getElementById('rr'+i).innerHTML=0;
}

/**** skills */
function showskills(skillslist)
{
	sl=skillslist.split(';');
	str='';
	for(i=0;i<sl.length;i++)
	{
		sl1=sl[i].split('|');
		if(sl1.length>1) {
			if(sl1[1]=='grp') str+='<h2 class=sbranch>'+sl1[0]+'</h2>';
			else str+=(parseInt(sl1[4])>0?('<div class=skillUse style="background-position:0 '+((sl1[4]-1)*22)+'px" onclick=dbget("skills","stask=su&sid='+sl1[5]+'")></div>'):'')
				+'<p><b class=sname>'+sl1[0]+' ('+sl1[2]+'/'+sl1[3]+')</b><br><small>'+sl1[1]+'</small><br>'+(sl1[6]?('<b class=sstats>'+sl1[6]+'</b></p>'):'');
		}
	}
	setih('skillslist',str);
	show('skills',true);
}
function skillshop(skillslist)
{
	sl=skillslist.split(';');
	str='';
	for(i=0;i<sl.length;i++)
	{
		sl1=sl[i].split('|');
		if(sl1.length>1) {
			if(sl1[4]=='zl') sl1[4]='złota';
			if(sl1[1]=='grp') str+='<h2 class=sbranch>'+sl1[0]+'</h2>';
			else str+=(parseInt(sl1[1])>0?('<div rollover=19 class=skillLearn onclick=dbget("skills","stask=ss&learn='+sl1[1]+'")></div>'):'')
				+'<p><b class=sname>'+sl1[0]+'</b><br><small>'+sl1[5]+'</small><br><b class=sgold>Poziom '+sl1[2]+': '+sl1[3]+' '+sl1[4]+'</b><br><b class=sstats>'+sl1[6]+'</b><i class=sreq>'+sl1[7]+'</i></p>';
		}
	}
	setih('skillshoplist',str);
	show('skillshop',true);
}

/****** friends */
function friendship(val)
{
	val=val.split(',');
	if(confirm("Czy chcesz dodać "+val[1]+" do swojej listy przyjaciół?")) dbget('friends','proc=fraccept&id='+val[0]); 
	else dbget('friends','proc=frdiscard&id='+val[0]);
}
function chatfr(nick)
{
	document.getElementById('chatIn').value='@'+nick.split(' ').join('_')+' ';
	global.chatFocus=true; 
	document.getElementById('chatIn').focus(); 
}

/*********** mails */
function newmail()
{
	if(hero.gold<100) {
		alert("Koszt wysłania 1 wiadomości to 100 złota,\na Ty tyle nie masz.");
		return;
	}
	ge('attitem').innerHTML='';
	global.attitem=0;
	show('newmail',false);
}
function sendmail()
{
	var r=ge('receiver').value;
	var gold=ge('mailgold').value;
	var msg=ge('mailmsg').value;
	if(r=='') alert('Brak adresata wiadomości!'); else
	if(msg=='') alert('Brak treści wiadomości!'); else
		dbget('mails','proc=sendmail&receiver='+escape(r)+'&gold='+gold+'&item='+global.attitem+'&msg='+escape(msg));
}
function mailreply(recv)
{
	if(hero.gold<100) { 
		alert("Koszt wysłania 1 wiadomości to 100 złota,\na Ty tyle nie masz.");
		return;
	}
	ge('mailmsg').value=''; 
	ge('mailgold').value=''; 
	ge('receiver').value=unescape(recv);
	ge('attitem').innerHTML='';
	global.attitem=0;
	show('newmail',false);
	ge('mailmsg').focus();
	ge('mailmsg').scrollTop=0;
}
function delatt()
{
	ge('attitem').innerHTML='';
	global.attitem=0;
}

/*********** auctions */
function myauctions(t)
{	
	if(t=='') t='Aby dodać nową aukcję przeciągnij na ten panel przedmiot ze swojego ekwipunku.';
	var txt='<h2>Nowa aukcja</h2><p id=newaitem>'+t+'</p><h2>Moje aukcje</h2>'
		+'<table id=ahtable><tr><th colspan=2>Przedmiot<th>Cena<th>Kup teraz<th>Koniec licytacji</table>';
	ge('ahpanel').innerHTML=txt;
	show('auctions',true);
	global.myau=true;
}

function newauction(id,desc,sl)
{
	var txt='<table><tr><td>'+desc+'<td>';
	if(sl) txt+='<td>Cena kup teraz:<br>Od 10 do 34SŁ zależnie od jakości i poziomu przedmiotu.' 
		+'<td>Czas aukcji:<br><input size=2 id=itemtime value=48><td><button onclick="sendauction('+id+',1)">Wystaw<br>przedmiot<button></table>'
		+'<small>Cena przedmiotu to 12SŁ + 1/10 poziomu przedmiotu, +20% za unikat, +40% za heroik, +60% za legendarny.'
		+'Jakkolwiek gracz otrzymuje 10% tej sumy, reszta to koszty odwiązania.</small>';
	else txt+='Cena wyjściowa:<br><input size=5 id=itemprice maxlength=9><td>Cena kup teraz:<br><input size=5 id=itemboprice maxlength=9>'
		+'<td>Czas aukcji:<br><input size=2 id=itemtime value=24><td><button onclick="sendauction('+id+',0)">Wystaw<br>przedmiot<button></table>'
		+'<small>Cena przedmiotu może być również zapisana jako np. 5k (5&nbsp;tysięcy) lub 1m (1&nbsp;milion).'
		+'Czas aukcji w godzinach, od 2 do 48. Koszt wystawienia przedmiotu to 10% jego wartości, 100 złota, 2% z ceny początkowej lub kup teraz - brana jest pod uwagę największa z tych liczb.</small>';
	ge('newaitem').innerHTML=txt;
}
function ahitem(a)
{
	newRow = ge('ahtable').insertRow(-1);
	var dt=a[5].split(',');
	a[5]='<b>'+dt[0]+'</b><br><small>'+dt[1]+'<br>'+dt[2]+'</small>';
	if(a[3]==0) a[3]='-'; else
		if(!global.myau) a[3]='<input value='+a[3]+' size=4 id=ai'+a[0]
		+'><br><button onclick=aubid('+a[0]+',"'+a[3]+'","'+a[4]+'")>Licytuj</button>';
	if(a[4]==0) a[4]='-'; else {
		var add=''; 
		if(!global.myau) add='<br><button onclick=buyout('+a[0]+',"'+escape(a[2])+'","'+a[4]+'",'+a[8]+')>Kup teraz</button>'; 
		if(a[8]=='1') a[4]='<span class=ausl>'+a[4]+' SŁ</span>';
		a[4]+=add;
	} 
	for(var idx=1;idx<6;idx++) {
		newCell = newRow.insertCell(-1);
		if(idx==2) {
			newCell.innerHTML = a[idx]+((a[7]>0)?('<br>(lvl:'+a[7]+')'):'');
			newCell.className='itemtype'+a[6];
		}
		else newCell.innerHTML = a[idx];
		//if(idx==1alert(a[4]);
	}
}

function parsePrice(x) 
{
	x=x.split(',').join('.');
	if(x.slice(-1)=='m') return Math.round(parseFloat(x)*1000000);	
	if(x.slice(-1)=='k') return Math.round(parseFloat(x)*1000);	
	return parseInt(x);
}

function sendauction(id,sl)
{
	if(sl) {
		var t1=parseInt(ge('itemtime').value);
		if(t1<2) alert("Czas aukcji to minimum 2h"); else
		if(t1>48) alert("Czas aukcji nie może być większy niż 48h"); else 
		dbget('auctions','proc=newauction&itemid='+id+'&p1=1&p2=2&time='+t1);
	}	else {
		var p1=parsePrice(ge('itemprice').value);
		var p2=parsePrice(ge('itemboprice').value);
		var t1=parseInt(ge('itemtime').value);
		if(!p1 & !p2) alert("Brak ceny!"); else
		if(p1 && p1<1000) alert("Minimalna cena to 1000 złota"); else
		if(p2 && p2<1000) alert("Minimalna cena kup teraz to 1000 złota"); else
		if(p2 && (p2<p1)) alert("Cena kup teraz nie może być mniejsza od wywoławczej!"); else
		if(t1<2) alert("Czas aukcji to minimum 2h"); else
		if(t1>48) alert("Czas aukcji nie może być większy niż 48h"); else 
		dbget('auctions','proc=newauction&itemid='+id+'&p1='+p1+'&p2='+p2+'&time='+t1);
	}
}

function aubrowse(cat)
{
	global.aucat=cat[0];
	var types=new Array('zwykłe','unikaty','heroiczne','legendarne');
	var opts='';
	for(var idx=0;idx<4;idx++)
		opts+='<option value='+idx+((global.atype==idx)?' selected':'')+'>'+types[idx];
	var txt='<h2>'+cat[1]+'</h2><div id=aufilter>Lvl od <input size=3 value='+global.aulv1+' id=alvlmin class=nr3>'
		+' do <input size=3 value='+global.aulv2+' id=alvlmax class=nr3> Nie gorsze niż:<select id=aitype>'+opts+'</select>'
		+'<br>Nazwa zawiera: <input style="width:200px" id=auname value="'+global.auname+'">'
		+'<br>Cena od <input size=3 value='+round(global.aup1)+' id=aprmin class=nr5> do <input size=3 value='+round(global.aup2)
		+' id=aprmax class=nr5> <button onclick=aapply()>Zastosuj</button></div>'
		+'<table id=ahtable><tr><th colspan=2>Przedmiot<th>Cena<th>Kup teraz<th>Koniec licytacji</table><center>';
	if(global.austart>0) txt+='<button onclick=auprev()>wstecz</button>';
	if(global.austart+20<cat[2]) txt+='<button onclick=aunext()>dalej</button>';
	ge('ahpanel').innerHTML=txt+'</center>';	
	global.myau=false;
}

function auview(cat)
{
	dbget('auctions','proc=filter&cat='+cat+'&start='+global.austart+'&fltr='+global.aulv1+'!'+global.aulv2+'!'
		+global.aup1+'!'+global.aup2+'!'+global.atype+'!'+global.auname);
}

function aapply()
{
	global.aulv1=parseInt(ge('alvlmin').value);
	global.aulv2=parseInt(ge('alvlmax').value);
	global.aup1=parsePrice(ge('aprmin').value);
	global.aup2=parsePrice(ge('aprmax').value);
	global.atype=parseInt(ge('aitype').value);
	global.auname=ge('auname').value;
	global.austart=0;
	auview(global.aucat);
}

function ahselect(n)
{
	global.austart=0;
	auview(n);
}

function auprev()
{
	global.austart=Math.max(0,global.austart-20);
	auview(global.aucat);
}
function aunext()
{
	global.austart+=20;
	auview(global.aucat);
}

function buyout(iid,iname,cost,sl)
{
	if(confirm('Czy na pewno chcesz kupić: \n'+unescape(iname)+'\nza '+cost+(sl?' Smoczych Łez?':' złota?')))
	dbget('auctions','proc=buyout&iid='+iid+'&bag='+global.bag+'&start='+global.austart+'&fltr='+global.aulv1+'!'+global.aulv2+'!'
		+global.aup1+'!'+global.aup2+'!'+global.atype+'!'+global.auname);
}

function aubid(iid,p1,p2)
{
	var bid=parsePrice(ge('ai'+iid).value);
	p1=parsePrice(p1);p2=parsePrice(p2);
	if(p2 && bid>p2) alert('Licytowanie wyższej kwoty niż "Kup Teraz" nie ma sensu.'); else
	if(bid<p1*1.1) alert('Musisz podbić cenę o co najmniej 10%.'); else
	if(bid>(1*hero.gold)) alert('Nie masz tyle złota.'); else
	dbget('auctions','proc=bid&iid='+iid+'&bid='+bid+'&start='+global.austart+'&fltr='+global.aulv1+'!'+global.aulv2+'!'
		+global.aup1+'!'+global.aup2+'!'+global.atype+'!'+global.auname);	
}
function pvpfr(prof) {
	switch(prof) {
		case 'w':
		case 'p':
		case 'h': return 0;
		default: return 1;
	}
}
function youtube(url)
{
	var str='<DIV class=mapClose onclick="hide(\'customdiv\',true); ge(\'customdiv\').innerHTML=\'\'" rollover=22></DIV>'
	+'<center style="margin-top:60px"><object width="480" height="385"><param name="movie" value="http://www.youtube.com/v/'+url
	+'&autoplay=1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param>'
	+'<embed src="http://www.youtube.com/v/'+url+'&autoplay=1" type="application/x-shockwave-flash" allowscriptaccess="always" '
	+'allowfullscreen="true" width="480" height="385"></embed></object></center>';
	ge('customdiv').innerHTML=str;
	show('customdiv');
}
