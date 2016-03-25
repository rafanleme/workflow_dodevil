function nostat(){
	window.status="";
	return true;
}

function waitDownload(){
  xajax.callback.global.onRequest = function() {xajax.$('files').innerHTML = "<table width=100% height=100%><tr><td align=center valign=middle width=100% height=100%>&nbsp;<p>&nbsp;<p><img src='images/iconLoad.gif' border=0></td></tr></table>";}
  xajax.callback.global.beforeResponseProcessing = function() {}
}
function getDownload(x,y){
   waitDownload();
   xajax_getDownload(x,y);
 //  return false;
}
