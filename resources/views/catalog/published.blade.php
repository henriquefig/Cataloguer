<div id='searchbox'>


        <select class='selectpicker' id='sorting'>
            <option value="" selected>{{ __('No sorting') }}</option>
            @for($j=0;$j<count($headers);$j++)

                @if($headers[$j]->type=='image')
                    @continue
                @endif
                @if($headers[$j]->sort==1) 
                    <option value='{{$headers[$j]->name}}_0'>{{$headers[$j]->name}} - {{__('Ascending')}} </option>
                    <option value='{{$headers[$j]->name}}_1'>{{$headers[$j]->name}} - {{__('Descending')}} </option>
                @endif
            @endfor
        </select>&nbsp;&nbsp;&nbsp;
        <label for='search'><b>{{ __('Search') }}</b>&nbsp;<i class="fa fa-search"></i></label>
        <input type='text' id='search' class="form-control" style="display:inline" name='search' onkeyup='return searchcatalog(event)' placeholder='{{ __('Press enter to search for (a) product(s)') }}' />

    </div>
<h2>{{$cat_title}}</h2>
<hr />
    
    <br><br>
    @php
     function range_attribute_in_array($array, $prop,$f) {
        $imgcounter=  count($f['image'])-1;
        return max(array_column($array, $prop))-min(array_column($array, $prop))+1+$imgcounter;
    }  
    @endphp
    <ul class='product_ul'>
        @for($i=0;$i<count($entries[$headers[0]->name]);$i++)

            @php
                $count_img=0;
            @endphp
            <li class='threecols' style='{{$layout[0]['card_layout']}}'>
                <div class='card' style='overflow:visible;width:100%;height:100%;'>

                    @for($j=0;$j<count($headers);$j++)
                        @if($headers[$j]->type=='header')
                            <div  id='{{ str_replace(array(' ','?','#',':',';',',','=','.'),'',$headers[$j]->name) }}_{{ $headers[$j]->cat_field_id}}' class='card-header 
                            @if($headers[$j]->visibility==0)
                            inv
                            @endif
                            ' title='{{$headers[$j]->name}}' style='overflow:hidden;{{$headers[$j]->styles}}' align='center'><b>{{$headers[$j]->name}}</b>:&nbsp;{{ $entries[$headers[$j]->name][$i]->value }}</div>
                        @elseif($headers[$j]->type=='image')
                            <div id='img_wrapper' class='img_div{{$i}}'
                                @if($count_img!=0)
                                    style='display:none;'
                                @endif
                                >
                                @if(isset($entries[$headers[$j]->name][$i]))
                                <span class='crop' style='background-image:url("{{$entries[$headers[$j]->name][$i]->value}}");' data='{{$entries[$headers[$j]->name][$i]->value}}' onclick='window.open($(this).attr("data"))'></span><br>
                                
                                <div class='but_style'>
                                <a class="prev" onclick="plusDivs(-1,this)">&#10094;</a>
                                <a class="next" style='margin-right:5px' onclick="plusDivs(1,this)">&#10095;</a>
                                </div>
                                @endif
                            </div>
                        @php
                            $count_img++;
                        @endphp
                        @elseif($headers[$j]->type=='text')
                            <span 
                            @if($headers[$j]->visibility==0)
                            class='inv'
                            @endif
                            style='{{$headers[$j]->styles}}' id='{{ str_replace(array(' ','?','#',':',';',',','=','.'),'',$headers[$j]->name) }}_{{ $headers[$j]->cat_field_id}}' ><b>{{ $headers[$j]->name }}</b>:&nbsp;{{ $entries[$headers[$j]->name][$i]->value}}</span>
                        @elseif($headers[$j]->type=='desc')
                            <span 
                            @if($headers[$j]->visibility==0)
                           class='inv'
                            @endif
                             id='{{ str_replace(array(' ','?','#',':',';',',','=','.'),'',$headers[$j]->name) }}_{{ $headers[$j]->cat_field_id}}' style='{{ $headers[$j]->styles }}'><b>{{ $headers[$j]->name }}</b>:&nbsp;{{$entries[$headers[$j]->name][$i]->value}}</span>
                        @elseif($headers[$j]->type=='link')

                        <div style='{{ $headers[$j]->styles }}' id='link_wrapper' class='annoying

                            @if($headers[$j]->visibility==0)
                            inv
                            @endif
                            ' >
                            <a target='_blank' id='{{ str_replace(array(' ','?','#',':',';',',','=','.'),'',$headers[$j]->name) }}_{{ $headers[$j]->cat_field_id}}' href='{{$entries[$headers[$j]->name][$i]->value}}'><b>{{ $headers[$j]->name }}</b>:&nbsp;{{ __('Click here.') }}</a>
                        </div>
                        <script class='removal'>

                       
                         $(".annoying").each(function(i,val){

                            $(val).find('a').css('color',$(val).css('color'));
                        })
                        </script>
                        @endif
                        
                        @if($j==count($headers)-1)
                         <script class='removal'>
                            if($(".img_div{{$i}}").length>0)
                            $(".img_div{{$i}}").wrapAll('<div id="carousel" style="{{ $headers[$j]->styles }}"></div>').parent().prepend('<b>Images</b>');
                         
                        </script>
                         @endif
                    @endfor
                </div>
            </li>
        @endfor
    </ul>
    <input type='hidden' value='{{$entries[$headers[0]->name][$i-1]->product_id}}' id='last_product_id' />
    <input type='hidden' value='{{count($headers)}}' id='header_range' />
    <input type='hidden' value='' id='infinite_scroll' />
<br><br>
<!-- to give the footer space -->
<br><br>
<br><br>

<script class='removal'>
scrollevent();
sortingfunc();
$("select").selectpicker({'width':'fit'});
if($("#img_wrapper").length>0)
    fixcarouselimgs();
$(".removal").remove();
</script>