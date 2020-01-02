@for($i=0;$i<count($entries);$i=$i+count($headers))
@php
    $count_img=0;
@endphp
    <li class='threecols' style='{{$layout[0]['card_layout']}}'>
        <div class='card' style='overflow:visible;width:100%;height:100%;'>
            @for($j=0;$j<count($headers);$j++)
                @if($headers[$j]->type=='header')
                    <div  id='{{ $headers[$j]->name }}_{{ $headers[$j]->cat_field_id}}' class='card-header
                    @if($headers[$j]->visibility==0)
                    inv
                    @endif
                    ' title='{{$headers[$j]->name}}' style='overflow:hidden;{{$headers[$j]->styles}}' align='center'><b>{{$headers[$j]->name}}</b>:&nbsp;{{$entries[$i+$j]->value }}</div>
                @elseif($headers[$j]->type=='image')

                    @if(isset($entries[$i+$j]) && $entries[$i+$j]->product_id==$entries[$i+$j-1]->product_id)

                        <div id='img_wrapper' class='img_div{{$i}}'
                            @if($count_img!=0)
                                style='display:none;'
                            @endif
                            >
                                <span class='crop' style='background-image:url("{{$entries[$i+$j]->value}}");' data='{{$entries[$i+$j]->value}}' onclick='window.open($(this).attr("data"))'></span><br>
                                
                                <div class='but_style'>
                                    <a class="prev" onclick="plusDivs(-1,this)">&#10094;</a>
                                    <a class="next" style='margin-right:5px' onclick="plusDivs(1,this)">&#10095;</a>
                                </div>
                        </div>
                        @php
                            $count_img++;
                        @endphp
                    @else

                        <script id='remove'>$(".img_div{{$i}}").wrapAll('<div id="carousel" style="{{ $headers[$j]->styles }}"></div>').parent().prepend('<b>Images</b>');$("#remove").remove()</script>
                        @php
                            $i--;
                            $j++;
                        @endphp

                    @endif

                @elseif($headers[$j]->type=='text')
                    <span 
                    @if($headers[$j]->visibility==0)
                        class='inv'
                    @endif
                    style='{{$headers[$j]->styles}}' id='{{ $headers[$j]->name }}_{{ $headers[$j]->cat_field_id}}' >
                        <b>{{ $headers[$j]->name }}</b>:&nbsp;{{ $entries[$i+$j]->value}}
                    </span>
                @elseif($headers[$j]->type=='desc')
                    <span 
                    @if($headers[$j]->visibility==0)
                        class='inv'
                    @endif
                     id='{{ $headers[$j]->name }}_{{ $headers[$j]->cat_field_id}}' style='{{ $headers[$j]->styles }}'>
                        <b>{{ $headers[$j]->name }}</b>:&nbsp;{{$entries[$i+$j]->value}}
                    </span>
                @elseif($headers[$j]->type=='link')
                    <a 
                    @if($headers[$j]->visibility==0)
                        class='inv'
                    @endif
                     style='{{$headers[$j]->styles}}' target='_blank' id='{{ $headers[$j]->name }}_{{ $headers[$j]->cat_field_id}}' href='{{$entries[$i+$j]->value}}' >
                        <b>{{ $headers[$j]->name }}</b>:&nbsp;{{ __('Click here.') }}</i>
                    </a>
                @endif
                
                @if($j==count($headers)-1)
                 <script id='remove'>$(".img_div{{$i}}").wrapAll('<div id="carousel" style="{{ $headers[$j]->styles }}"></div>').parent().prepend('<b>Images</b>');$("#remove").remove()</script>
                 @endif
                
               
            @endfor
        </div>
    </li>
@endfor