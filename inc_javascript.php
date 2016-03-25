<script type="text/javascript" src="../../scripts/jquery.js"></script>
<script type="text/javascript" src="../../scripts/jquery.maskedinput.js"></script>
<script type="text/javascript" src="../../scripts/jquery.alphanumeric.pack.js"></script>
<script type="text/javascript" src="../../scripts/jquery.decimal.js"></script>
<script type="text/javascript" src="../../scripts/jquery.blockUI.js"></script>
<script type="text/javascript" src="../../scripts/jquery.maskedprice.js"></script>
<script type="text/javascript" src="../../scripts/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="../../scripts/fancybox/jquery.fancybox-1.3.1.js"></script>
<script type="text/javascript" src="../../scripts/fancybox/jquery.mousewheel-3.0.2.pack.js"></script>
<script type="text/javascript" src="../../scripts/datepicker/jquery.datepick.js"></script>
<script type="text/javascript" src="../../scripts/datepicker/jquery.datepick-pt-BR.js"></script>
<link rel="stylesheet" type="text/css" href="../../scripts/fancybox/jquery.fancybox-1.3.1.css" media="screen" />
<style type="text/css"> @import "../../scripts/datepicker/redmond.datepick.css"; </style>
<script src="../../scripts/msdropdown/js/jquery.dd.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../../scripts/msdropdown/dd.css" />
<link rel="stylesheet" type="text/css" href="../../include/styleDivs.css" />

<script type="text/javascript">
function isNumberKey(evt){
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))
     return false;
  return true;
}
function abreChecklist(url,alt,lrg,titulo){
	jQuery(document).ready(function() {
		$.fancybox(
			'<iframe width="'+lrg+'" height="'+alt+'" src="'+url+'" frameborder=0 scrolling=yes></iframe>',
			{'width':lrg,'height':alt,'autoScale':false,'transitionIn':'elastic','transitionOut':'elastic','autoDimensions':false,
			'overlayShow':false,'showCloseButton':true,'showNavArrows':false,'enableEscapeButton':true,'titleShow':true,
			'titlePosition':'outside','title':titulo,
			'onStart':function(){ $("#divGeral").hide();},
			'onClosed':function(){ $("#divGeral").show();}
			}
		);
	});
}
</script>