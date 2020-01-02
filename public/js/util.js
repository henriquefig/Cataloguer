function plusDivs(count,el)
{
	let aux;
    $(el).parent().parent().parent().children().each(function(i,val){
		if($(val).find('span').length>0)
		{
			console.log($(val).filter('.skip_lavatudo'))
			if($(val).find('span').is(":visible"))
			{
				aux=i+count-1
				if(aux==-1)
					 aux=$(el).parent().parent().parent().find('#img_wrapper span').length-1
				if(aux==$(el).parent().parent().parent().find('#img_wrapper span').length)
					aux=0;
			}
			$(val).hide();
		}
	})
	$($(el).parent().parent().parent().find('#img_wrapper span')[aux]).parent().show()
}
var hexDigits = new Array
        ("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"); 

//Function to convert rgb color to hex format
function rgb2hex(rgb) {
 rgb_o = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
 if(rgb_o==null)
 	rgba = rgb.match(/^rgba\((\d+),\s*(\d+),\s*(\d+),\s*(\d+)\)$/);
 if(rgb_o==null)
 {
 	if(rgba[4]==0)
 		return "#ffffff";
 	return "#" + hex(rgba[1]) + hex(rgba[2]) + hex(rgba[3]) + hex(rgba[4]);

 }
 else
 	return "#" + hex(rgb_o[1]) + hex(rgb_o[2]) + hex(rgb_o[3]);
}

function hex(x) {
  return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
 }
function increaserange(sign)
{
 	if(sign=='-')
 		$("#font_s").val(parseFloat($("#font_s").val())-parseFloat($("#font_s").attr("step")));
 	else
 		$("#font_s").val(parseFloat($("#font_s").val())+parseFloat($("#font_s").attr("step")));
 	$("#font_s").change();
}
function config_header(el)
{
	$("#config_tab").css('display','inline');

	let el_id=$(el).parent().attr('id');
	$("#current_field").text(el_id);

	let current=$(el).parent().css('font-size');
	current=current.replace('vw','');
	$("#config_tab").find('#font_s').val(current)


	current=$(el).parent().css('color');
	$("#config_tab").find('#font_c').val(rgb2hex(current))


	current=$(el).parent().css('background');
	$("#config_tab").find('#font_bg').val(rgb2hex(current.split(") ")[0]+")"))

	current=$(el).parent().prop("tagName");
	if(current=='DIV' && $(el).parent().attr('id')=='img_wrapper')
		$('#fld_type').text('Image').removeClass('text-primary').removeClass('text-info').addClass('text-danger')
	if(current=='DIV' && $(el).parent().attr('id')=='link_wrapper')
		$('#fld_type').text('Link').removeClass('text-primary').removeClass('text-warning').addClass('text-info')
	if(current=='DIV' && $(el).parent().attr('id')!='img_wrapper' && $(el).parent().attr('id')!='link_wrapper')
		$('#fld_type').text('Header').removeClass('text-warning').removeClass('text-info').addClass('text-primary')
	if(current=='span')
		$('#fld_type').text('Text').removeClass('text-warning').removeClass('text-info').removeClass('text-primary')

	current=$(el).parent().find('b').text()
	$("#config_tab").find('#current_field').text(current)

	$("#config_tab").find('#font_c').off('change').change(function(evt){
		$("#prod_card").find('#'+el_id).css('color',$(this).val())
		if(el_id=='link_wrapper')
		{
			$("#prod_card").find('#'+el_id).find('a').css('color',$(this).val()+"!important")
		}
	})
	$("#config_tab").find('#font_s').off('change').change(function(evt){
		$("#prod_card").find('#'+el_id).css('font-size',$(this).val()+'vw')
	})

	$("#config_tab").find('#font_bg').off('change').change(function(evt){
		$("#prod_card").find('#'+el_id).css('background','');
		let original=$("#prod_card").find('#'+el_id).attr('style');
		$("#prod_card").find('#'+el_id).css({'cssText':'background:'+$(this).val()+" !important;"+original})
	})
	if(el_id=='img_wrapper')
	$("#current_field").text('Images');
}

function UnknownTimeoutClearer()
{
	var id = window.setTimeout(function() {}, 0);
	let count=id;
	while (id--) {
	    window.clearTimeout(id); // will do nothing if no timeout with id is present
	}
	console.log('cleared ' +count+' timeouts');
}
function make_notif_icon(el,type)
{
	$(el).removeClass().addClass('fa');
	switch(type)
	{
		case 'success':
		$(el).addClass('fa-check').addClass('text-success');
		break;
		case 'warning':
		$(el).addClass('fa-exclamation-triangle').addClass('text-warning');
		break;
		case 'error':
		$(el).addClass('fa-ban').addClass('text-danger');
		break;
		case 'complete':
		$(el).addClass('fa-info').addClass('text-primary');
		break;
	}
}
function notification(msg,type='success')
{
	UnknownTimeoutClearer()

	$("#notification").find('span').html(msg)
	$("#notification").fadeIn(250);
	make_notif_icon($($("#notification i")[1]),type);
	setTimeout(function(){
		$("#notification").fadeOut(250);
	},5000)
}
function delay(callback, ms) {
	var timer = 0;
	timer = setTimeout(function () {
  		callback();
	}, ms || 0);
	while(timer-1>=0)
	{
		clearTimeout(timer-1);
		timer--;
	}
}