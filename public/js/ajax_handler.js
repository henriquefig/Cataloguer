let running=false;
var entry_table;
function checkForHeader(h_name,data,index,fields)
{
	for(let i=index*fields;i<(index+1)*fields;i++)
	{
		if(data[i].name.trim() == h_name.trim())
		{
			return data[i].value;
		}
	}
}
function newcatalog() {
	$(window).unbind("scroll");
	$.ajax({
	   type:'POST',
	   url:'./new_catalog',
	    headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	   success:function(data) {
	      $("#product_zone").html(data);
	   }
	});
}
function createCatalogFields(){

	$.ajax({
	   type:'POST',
	   url:'./catalog_fields',
	    headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	    data:{
	    	amount:$("#manual_amount").val()
	    },
	   success:function(data) {
	      $("#catalog_fields").html(data);
	   }
	});
}
function createCatalog(){
	let fields_amount=$("#catalog_fields .row").attr('data');
	let fields=[];
	for(let i=0;i<fields_amount;i++)
	{
		fields[i]=$("#field_"+(i+1)).val()
	}
	fields[fields_amount]=$("#img_amount").val();
	$.ajax({
	   type:'POST',
	   url:'./create_catalog',
	    headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	    data:{
	    	fields:fields,
	    	title:$("#cat_title_gen").val()
	    },
	   success:function(data) {
	      $("#product_zone").html(data);
	   }
	});
}
function listcatalog(){
	$(window).unbind("scroll");

	$.ajax({
	   type:'POST',
	   url:'./list_catalog',
	    headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	   success:function(data) {
	      $("#product_zone").html(data);
    	entry_table=$('table').DataTable();
	   }
	});
}
function newentry(){

	$.ajax({
	   type:'POST',
	   url:'./new_entry',
	    headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	   success:function(data) {
	      $("#product_zone").html(data);
	   }
	});
}
function addentry(){
	var entries=[];
	var domChildren=$(".jumbotran .col-md-4 input");
	for(let i=0;i<domChildren.length;i++)
	{
		let cat_field_id=$(domChildren[i]).attr('id').split("_")[1];
		entries[i]={'val':$(domChildren[i]).val(),'cat_field':cat_field_id}
	}
	$.ajax({
	   type:'POST',
	   url:'./add_entry',
	    headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	    data:{
	    	entries:entries
	    },
	   success:function(data) {
	      $("#product_zone").html(data);
	   }
	});
}
function mapping()
{
	$(window).unbind("scroll");
	$.ajax({
	   type:'POST',
	   url:'./mapping',
	    headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	   success:function(data) {
	      $("#product_zone").html(data);
	      $("select").selectpicker();
	   }
	});
}



function resizeStop(event, ui){
    convert_to_percentage($(this));
}

function dragStop(event, ui){
    convert_to_percentage($(this));
}

function setContainerResizer(event, ui) {
    $($(this)[0]).children('.ui-resizable-handle').mouseover(setContainerSize);
    $($(this)[0]).children('.ui-resizable-handle').mouseout(resetContainerSize);
}

function convert_to_percentage(el){
    var parent = el.parent();
    var trueleft=parseInt(el.css('left'));
    var truetop=parseInt(el.css('top'));
    el.css({
        left:pxTOvh(trueleft)+"vh",
        top: pxTOvh(truetop)+"vh",
        width: pxTOvh(parseInt(el.outerWidth()))+"vh",
        height: pxTOvh(parseInt(el.outerHeight()))+"vh"
    });
}
function fixcarouselimgs()
{

	$(".threecols").each(function(i,val){
		$(val).find('#carousel').find('span').css('width',($(val).find('#carousel').css('width').split("px")[0]-60)+"px")
		$(val).find('#carousel').find('span').css('height',($(val).find('#carousel').css('height').split("px")[0]-80)+"px")
	});
}
function layouterevents()
{
	
  $(".drag_resize").draggable({
  	containment:'#prod_card',
  	snap:true,
  }).resizable({
  	handles:'nw,ne,se,sw,n,s,e,w'
        
  }).on('resize',function(evt){
  	if($(evt.target).attr('id')=='carousel')
  	{
  		$(evt.target).find('span').css('width',($(evt.target).css('width').split("px")[0]-60)+"px")
  		$(evt.target).find('span').css('height',($(evt.target).css('height').split("px")[0]-80)+"px")
  	}
  })
  if($("#carousel").length!=0)
  fixcarouselimgs();
  $("#prod_card").parent().resizable({
  	handles:'nw,ne,se,sw,n,s,e,w'
        
  }).on('resize',function(){
  	$("#resize_warn").show();
  	$("#searchbox").addClass('bordered_notif')
  })
  $("#searchbox span").click(function(){
  	$("#resize_warn").hide();
  	$("#searchbox").removeClass('bordered_notif')
  })
}
function pxTOvh(value) {
  var w = window,
    d = document,
    e = d.documentElement,
    g = d.getElementsByTagName('body')[0],
    x = w.innerWidth || e.clientWidth || g.clientWidth,
    y = w.innerHeight|| e.clientHeight|| g.clientHeight;
  var result = (100*value)/y;
  return result;
}
function setContainerSize(el) {
    var parent = $(el.target).parent().parent();
    parent.css('height', parent.height() + "px");
}

function resetContainerSize(el) {
    var parent = $(el.target).parent().parent();
    parent.css('height', 'auto');
}
function layouter()
{
	$(window).unbind("scroll");

	$.ajax({
	   type:'POST',
	   url:'./layout',
	    headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	   success:function(data) {
	      $("#product_zone").html(data);
	      layouterevents()
	   }
	});
}
function publish()
{

	$.ajax({
	   type:'POST',
	   url:'./publish',
	    headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	   success:function(data) {
	      $("#product_zone").html(data);

	   }
	});
}
function convert_to_percentage_for_card(el){
    var parent = el.parent();
    el.css({
        width: pxTOvh(parseInt(el.width()))+"vh",
        height: pxTOvh(parseInt(el.height()))+"vh"
    });
}
function saveprodlayout()
{
	let category_styles=[];
	let count=0;

	convert_to_percentage_for_card($(".threecols"));
	$("#prod_card").find('.card-header').each(function(i,val){
		convert_to_percentage($(val))
		category_styles[count]={
			'id':$(val).attr('id').split('_')[1],
			'style':$(val).attr('style')
		}
		count++;
	});
	$("#prod_card").find('#img_wrapper span').each(function(i,val){
		convert_to_percentage($(val).parent().parent())
		category_styles[count]={
			'id':$(val).attr('id').split('_')[1],
			'style':$(val).parent().parent().attr('style')
		}
		count++;
	});
	$("#prod_card").find('span').each(function(i,val){
		if($(val).parent().attr('id')!="img_wrapper")
		{
			convert_to_percentage($(val))
			category_styles[count]={
				'id':$(val).attr('id').split('_')[1],
				'style':$(val).attr('style')
			}
			count++;
		}
	});
	$("#prod_card").find('a').each(function(i,val){
		if(!$(val).hasClass('next') && !$(val).hasClass('prev'))
		{
			convert_to_percentage($(val).parent())
			category_styles[count]={
				'id':$(val).attr('id').split('_')[1],
				'style':$(val).parent().attr('style')
			}
			count++;
		}
	});
	let card_style=$("#prod_card").parent().attr('style');
	if(card_style==undefined)
	{
		card_style=' ';
	}
	category_styles[count]={
			'id':'prod_card',
			'style':card_style
	}
	$.ajax({
	   type:'POST',
	   url:'./save_styles',
	   data:{
	   	styles:category_styles
	   },
	    headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	   success:function(data) {
	      $("#product_zone").html(data);
	   }
	});
}
function savecategories()
{
	let cat=[];
	$("select").each(function(i,val){
		let checkboxes=$(val).parent().parent().find('input[type="checkbox"]');
		cat[i]={'id':$(val).attr('id'),'val':$(val).val(),'vis':$(checkboxes[0]).is(":checked"),'sort':$(checkboxes[1]).is(":checked")};
	})
	$.ajax({
	   type:'POST',
	   url:'./save_mapping',
	   data:{
	   	categories:cat
	   },
	    headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	   success:function(data) {
	      $("#product_zone").html(data);
	   }
	});
}
function createCSVCatalog()
{
	$("#upload_catalog").fileinput('upload')
	$('#upload_catalog').on('fileuploaded', function(event, data, previewId, index) {
		
		$.ajax({
		   type:'POST',
		   url:'./mapping',
		    headers: {
		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		   success:function(data) {
		      $("#product_zone").html(data);
		   }
		});
	});
}
function publishcatalog()
{

	$.ajax({
	   type:'POST',
	   url:'./publish_catalog',
	    headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	   success:function(data) {
	      $("#product_zone").html(data);
	   }
	});
}
function scrollevent(){
  $(window).scroll(function() {
    	if(running==false)
    	{
			if($(window).scrollTop() + $(window).height() >= $(document).height()-50) {
			    var last_id = $("#last_product_id").val();
			    loadMoreData(last_id);
	       }
   		}
    });

    function loadMoreData(last_id){
      $.ajax({
            url: './loadMoreData',
	        type: "get",
		    headers: {
		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
            beforeSend: function(xhr)
            {
            	running=true;
            	$("body").css('cursor','wait')
                $('#loading-spinner').show();
            },
            complete:function(){
            	running=false;
            	$("body").css('cursor','initial')
            	$('#loading-spinner').hide();
        	},
            data: {
            	last_id:last_id,
            	infinite_scroll:$("#infinite_scroll").val(),
            	header_range:$("#header_range").val()
            }
        }).done(function(data)
        {
        	$("#last_product_id").val(parseInt($("#last_product_id").val())+15);
        	$("#product_zone ul").append(data);
        	$('#sorting').change();
        	
        }).fail(function(jqXHR, ajaxOptions, thrownError)
        {
        	console.log(jqXHR, ajaxOptions, thrownError)
        });
    }
}
function edit_entry(me)
{
	let entry=entry_table.row($(me).parent()).data();
	$("#entry_modal_body").empty().append($("<form></form>"));
	for(var i=0;i<entry.length-2;i++)
	{
		var modalgroup=$("<div class='form-group'></div>")
		modalgroup.append($("<label>"+$("table thead th")[i].innerText+"</label>"));
		modalgroup.append("<br>")
		if(entry[i].includes('<input type="hidden"'))
		{
			if(entry[i][0]=='<')
				entry[i]=$(entry[i]).val();
			else
			{
				modalgroup.append($("<"+entry[i].split('<')[1]))
				entry[i]=entry[i].split('<')[0].trim()
			}
		}
		modalgroup.append($("<input class='form-control' name='"+$("table thead th")[i].innerText+"' type='text' value='"+entry[i]+"' />"));
		$("#entry_modal_body form").append(modalgroup)
	}
	$("#edit_entry_modal").modal('show')
}
function save_changes_entry()
{
	$.ajax({
        url: './save_entry',
        type: "post",
	    headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
        beforeSend: function(xhr)
        {
        	running=true;
            $('#loading-spinner').show();
        },
        complete:function(){
        	running=false;
            $('#loading-spinner').hide();
    	},
        data:$("#entry_modal_body form").serializeArray(),
        success:function(r){
        	notification('Your changes were successfully saved');
			$("#edit_entry_modal").modal('hide')
        	listcatalog();
        },
        error:function(e){
        	console.log(e)
        }
    })
}
function searchcatalog(evt)
{
	let word=$("#search").val();
  	$.ajax({
        url: './searchEntry',
        type: "post",
	    headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
        beforeSend: function(xhr)
        {
        	running=true;
            $('#loading-spinner').show();
        },
        complete:function(){
        	running=false;
            $('#loading-spinner').hide();
    	},
        data: {
        	search:word
        },
        success:function(r){

        	$("#product_zone .product_ul").empty().append(r.data)
        	$("#last_product_id").val(r.marker)
    		$("#infinite_scroll").val(word)
    		$('#sorting').change()
        },
        error:function(e){
        	console.log(e)
        }
    })
}
function savepagelayout()
{

	$.ajax({
        url: './save_p_layout',
        type: "post",
	    headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
        beforeSend: function(xhr)
        {
        	running=true;
            $('#loading-spinner').show();
        },
        complete:function(){
        	running=false;
            $('#loading-spinner').hide();
    	},
    	data:{
    		banner:$("#header_color").val(),
    		comp_name:$("#comp_name").val()
    	},
        success:function(r){
        	
        	notification('The catalog layout was saved. Please check your public link to see the final result','success');
 		}
    })
}
function page_layout()
{
	$(window).unbind("scroll");
	$.ajax({
        url: './page_layout',
        type: "post",
	    headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
        beforeSend: function(xhr)
        {
        	running=true;
            $('#loading-spinner').show();
        },
        complete:function(){
        	running=false;
            $('#loading-spinner').hide();
    	},
        success:function(r){
        	$("#product_zone").html(r)

		    let uploadFileSettings = {
		        'showClose': false,
		        'showUpload':true,
		        'uploadUrl': "./upload_comp", // server upload action
		        'ajaxSettings': {
		            headers: {
		                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		            }
		        },
		        'error':'You are not allowed to upload such a file.',
		        'showPreview':true,
		        'msgInvalidFileExtension':'Invalid extension for file "{name}". Only image files are supported.',
		        'allowedFileExtensions':['png', 'jpeg', 'jpg', 'svg','tiff'],
		        'dropZoneEnabled':false,
		        'maxFileSize': 10240
		    };
			$("#comp_logo").fileinput(uploadFileSettings);

				$("#comp_logo").on('fileuploaded', function(event, data, previewId, index) {
					$("#config_logo").attr('src',$("#config_logo").attr('src')+"?timestamp=" + new Date().getTime())
					$("#comp_logo").fileinput('clear')
				});
        },
        error:function(e){
        	console.log(e)
        }
    })
}

function searchcatalogG(evt)
{
	let word=$("#search").val();
  	$.ajax({
        url: './searchEntryG',
        type: "post",
	    headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
        beforeSend: function(xhr)
        {
        	running=true;
            $('#loading-spinner').show();
        },
        complete:function(){
        	running=false;
            $('#loading-spinner').hide();
    	},
        data: {
        	search:word,
        	u_id:window.location.href.slice(window.location.href.indexOf('?') + 1).split('=')[1]
        },
        success:function(r){
        	$("#product_zone .product_ul").empty().append(r.data)
    		$("#infinite_scroll").val(word)
        	$("#last_product_id").val(r.marker)
        	$('#sorting').change()
        	//$(".py-4 .col-md-9 ul").html(myans)
        },
        error:function(e){
        	console.log(e)
        }
    })
}

function scrolleventG(){
  $(window).scroll(function() {
    	if(running==false)
    	{
			if($(window).scrollTop() + $(window).height() >= $(document).height()-50) {
			    var last_id = $("#last_product_id").val();
			    loadMoreDataG(last_id);
	       }
   		}
    });

    function loadMoreDataG(last_id){
      $.ajax({
            url: './loadMoreDataG',
	        type: "get",
		    headers: {
		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
            beforeSend: function(xhr)
            {
            	running=true;
            	$("body").css('cursor','wait')
                $('#loading-spinner').show();
            },
            complete:function(){
            	running=false;
            	$("body").css('cursor','initial')
            	$('#loading-spinner').hide();
        	},
            data: {
            	last_id:last_id,
            	infinite_scroll:$("#infinite_scroll").val(),
            	header_range:$("#header_range").val(),
            	u_id:window.location.href.slice(window.location.href.indexOf('?') + 1).split('=')[1]
            }
        }).done(function(data)
        {
        	$("#last_product_id").val(parseInt($("#last_product_id").val())+15)
        	$("#product_zone ul").append(data)
        	$('#sorting').change()
        	
        }).fail(function(jqXHR, ajaxOptions, thrownError)
        {
        	console.log(jqXHR, ajaxOptions, thrownError)
        });
    }
}
function delete_entry(me)
{
	let entry=entry_table.row($(me).parent()).data();
	$("#delete_dialog")[0].showModal();
	$("#delete_dialog").find('#hidden_id').remove()
	for(var i=0;i<entry.length-2;i++)
	{
		if(entry[i].includes('<input type="hidden"'))
		{
			$("#delete_dialog").append($("<"+entry[i].split('<')[1]))
			break;
		}
	}
}
function delete_confirm()
{
	$.ajax({
        url: './delete_entry',
        type: "post",
	    headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
        beforeSend: function(xhr)
        {
        	running=true;
            $('#loading-spinner').show();
        },
        complete:function(){
        	running=false;
            $('#loading-spinner').hide();
    	},
        data: {
        	id:$("#delete_dialog").find('#hidden_id').val()
        },
        success:function(r){
        	listcatalog();
        },
        error:function(e){
        	console.log(e)
        }
    })
}
function sortingfunc()
{
	$("#sorting").change(function(){
		let sort=$(this).val().split("_");
		let data=$('.product_ul li').sort(function (a, b) {
		 	var sorta,sortb;
		 	$(a).find(".card").children().each(function(i,val){
		 		if(sort[0]==$(val).attr('id').split('_')[0])
		 		{
		 			sorta=$(val).not('b').text().split(":")[1];
		 		}
		 	});

		 	$(b).find(".card").children().each(function(i,val){
		 		if(sort[0]==$(val).attr('id').split('_')[0])
		 		{
		 			sortb=$(val).not('b').text().split(":")[1];
		 		}
		 	});
		 	if(!isNaN(sorta))
		 		sorta=parseFloat(sorta);
		 	if(!isNaN(sortb))
		 		sortb=parseFloat(sortb);
		 	if(sort[1]=='1')
		 		return (sortb>sorta)?1: (sortb < sorta) ? -1 : 0;
		 	if(sort[1]=='0')
		 		return (sorta > sortb)?1: (sorta < sortb) ? -1 : 0;
	   });
		$(".product_ul").html(data)
	})
}