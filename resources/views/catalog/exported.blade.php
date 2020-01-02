<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('imgs/favicon.ico') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$cat_title .__(' Catalog')}}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="{{ asset('js/ajax_handler.js') }}" defer></script>
    <script src="{{ asset('js/init_events.js') }}" defer></script>
    <script src="{{ asset('js/fileinput.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
    <script src="{{ asset('js/util.js') }}" defer></script>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/jquery-ui.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/bootstrap-select.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
</head>
<body style="background-image:url('')">
    <div class='col-md-12' id='header' style='border: 0;padding: 12px;background:{{$layout['banner_color']}}'>
        <img style='color:white' id='config_logo' src='{{asset(Request::input('u_id')."/mylogo.png")}}' alt='{{ __('Company logo')}}' onclick="window.open($(this).attr('src'));" />
        <span style='margin-left: 35%;font-size:3.4vh' >{{$layout['comp_name']}}</div>
    </div>
    <br><br><br>
    <br><br><br>
    <div class='row'>
        <div class='col-md-12' id='product_zone'>
            <div id='searchbox'>


                <b>{{ __('Sort by:') }}</b>
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
                <input type='text' id='search' name='search' placeholder='{{ __('Search for (a) product(s)') }}' onkeyup='delay(searchcatalogG,750)' class="form-control" style="display:inline" />

            </div>
            <h2 style='margin-left: 2vw;'>{{$cat_title}}</h2>
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
                        <li class='threecols' style='{{$layout['card_layout']}}'>
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
                                @endif
                                
                                @if($j==count($headers)-1)
                                 <script class='removal'>$(".img_div{{$i}}").wrapAll('<div id="carousel" style="{{ $headers[$j]->styles }}"></div>').parent().prepend('<b>Images</b>');$("#remove").remove()</script>
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
                $(function(){
                     $(".annoying").each(function(i,val){

                        $(val).find('a').css('color',$(val).css('color'));
                    })
                    scrollevent();
                    sortingfunc();
                    $("select").selectpicker({'width':'fit'});
                    if($("#img_wrapper").length>0)
                        fixcarouselimgs();
                    $(".removal").remove();

                })
            </script>
        </div>
    </div>
    <nav class='sticky' id='footer' style='height:50px;'>
        <div class='container'> 
            <div class='row'>
                <div class='col-md-3'></div>
                <div class='col-md-6'>
                    <!-- Remove inline CSS -->
                     <label style='font-size: 14px;font-weight: normal;'>  &copy;2019 Henrique Figueiredo,&nbsp;{{ __('All Rights Reserved')  }}&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="mailto:nf.henrique@gmail.com" >nf.henrique@gmail.com</a>
                    </label>
                 </div>
                <div class='col-md-3'></div>

        </div>
    </div> 
    </nav>
</body>
    
</html>