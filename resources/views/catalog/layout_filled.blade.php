<h2>Product's layout</h2>
<hr />
<strong id="resize_warn" style="display:none;margin-left: 15%;" class="text-danger"><i class="fa fa-exclamation-triangle"></i>{{ __('Resizing the product card might produce unwanted results when displaying the full catalog, see') }}
    <a href='{{ asset('imgs/sample_layout.png') }}'> {{ __('the example') }}.&nbsp;&nbsp;</a> 
   {{ __('To revert to the pre-set sizes, click on these buttons') }}    --></strong>
<div id='searchbox'>
    <span title='{{ __('Display the products in 4 columns per row')}}' style='margin: 0 3px 0 3px;' onclick="$('.col-md-9 li').css('width','22.5%')"><i class="fa fa-lg fa-grid" aria-hidden="true"></i></span>
    <span title='{{ __('Display the products in 3 columns per row')}}' style='margin: 0 3px 0 3px;' onclick="$('.col-md-9 li').css('width','30.5%')"><i class="fa fa-lg fa-th" aria-hidden="true"></i></span>
    <span title='{{ __('Display the products in 2 columns per row')}}' style='margin: 0 3px 0 3px;' onclick="$('.col-md-9 li').css('width','47.5%')"><i class="fa fa-lg fa-th-large" aria-hidden="true"></i></span>
    <span title='{{ __('Display the products in 1 columns per row')}}' style='margin: 0 3px 0 3px;' onclick="$('.col-md-9 li').css('width','100%')"><i class="fa fa-lg fa-bars" aria-hidden="true"></i></span>
</div>
<div class='row'>
              
</div>
@php
    $count_img=0;
@endphp
<div class='row'>
    <div class='col-md-10' id='product_zone'>
        <ul style='display: inherit;width:100%;'>
            <li class='threecols' style='{{$layout[0]['card_layout']}}'>
                <div class='card' id='prod_card'>
                    @for($i=0;$i<count($headers);$i++)
                        @if($headers[$i]->type=='header')
                            <div class='card-header drag_resize
                            @if($headers[$i]->visibility==0)
                            inv
                            @endif
                            ' style='border:0px!important;{{ $headers[$i]->styles }}' align='center' id='{{ str_replace(array(' ','?','#',':',';',',','=','.'),'',$headers[$i]->name) }}_{{ $headers[$i]->cat_field_id}}'><b>{{ $headers[$i]->name }}</b>:&nbsp;{{$examp[$i]->value}}&nbsp;<i class='fa fa-cog' onclick='config_header(this)' 
                           

                            ></i></div>
                        @elseif($headers[$i]->type=='image')
                            <div id='img_wrapper' class='img_div0' style='height:100%;width:100%;
                                @if($count_img!=0)
                                    display:none;
                                @endif
                                ' data='{{ $headers[$i]->styles }}' >
                                <i class='fa fa-cog' style='float:right' onclick='config_header(this)'></i>
                               &nbsp;&nbsp;<span class='crop' id='{{ str_replace(array(' ','?','#',':',';',',','=','.'),'',$headers[$i]->name) }}_{{ $headers[$i]->cat_field_id}}'  style='background-image:url("{{$examp[$i]->value}}")' ></span>
                                <div class='but_style'>
                                <a class="prev" onclick="plusDivs(-1,this)">&#10094;</a>
                                <a class="next" style='margin-right:5px' onclick="plusDivs(1,this)">&#10095;</a>
                                </div>
                            </div>
                            @php
                                $count_img++;
                            @endphp
                        @elseif($headers[$i]->type=='text')
                            <span class='drag_resize 
                            @if($headers[$i]->visibility==0)
                            inv
                            @endif
                            ' id='{{ str_replace(array(' ','?','#',':',';',',','=','.'),'',$headers[$i]->name) }}_{{ $headers[$i]->cat_field_id}}' style='{{ $headers[$i]->styles }}'><b>{{ $headers[$i]->name }}</b>:&nbsp;{{$examp[$i]->value}}&nbsp;<i class='fa fa-cog' onclick='config_header(this)'></i></span>
                        @elseif($headers[$i]->type=='desc')
                            <span class='drag_resize
                            @if($headers[$i]->visibility==0)
                            inv
                            @endif
                            ' id='{{ str_replace(array(' ','?','#',':',';',',','=','.'),'',$headers[$i]->name) }}_{{ $headers[$i]->cat_field_id}}' style='{{ $headers[$i]->styles }}'><b>{{ $headers[$i]->name }}</b>:&nbsp;{{$examp[$i]->value}}&nbsp;<i class='fa fa-cog' onclick='config_header(this)'></i></span>
                        @elseif($headers[$i]->type=='link')
                        <div style='{{ $headers[$i]->styles }}' id='link_wrapper' class='drag_resize annyoing

                            @if($headers[$i]->visibility==0)
                            inv
                            @endif
                            ' >
                            <a target='_blank' id='{{ str_replace(array(' ','?','#',':',';',',','=','.'),'',$headers[$i]->name) }}_{{ $headers[$i]->cat_field_id}}' href='{{$examp[$i]->value}}'><b>{{ $headers[$i]->name }}</b>:&nbsp;{{ __('Click here.') }}</a><i class='fa fa-cog' onclick='config_header(this)'></i>
                        </div>

                        <script class='removal'>

                       
                         $("#link_wrapper").find('a').css('color',$("#link_wrapper").css('color')+"!important");
                        </script>
                        @endif
                    @endfor
                     <script class='removal'>$(".img_div0").wrapAll("<div id='carousel' class='drag_resize' style='"+$(".img_div0").attr('data')+"'></div>").parent().prepend('<b>Images</b>');$(".removal").remove()</script>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class='row' style='margin-left: 27px;'>
        <span class='jumbotron' id='config_tab' style='display:none;list-style-type: none;float: right;width:33%'>
            <div align="center" style="margin-top: -10%;"><b id='current_field'></b>
            </div>
            <span onclick='$(this).parent().hide()' style='float:right;margin-top: -5%;'><i class='fa fa-times text-danger'></i></span>
            <br>
            <div class='form-group'>
                <div class='form-group'>
                    <label><b>{{ __('Field type:') }}</b></label>
                    <b><i><span id='fld_type'>
                    </span></i></b>
                </div>
                <label><b>{{ __('Font size:') }}</b></label>
                <br>
                <i onclick='increaserange("-")' style='cursor: pointer;' class='fa fa-minus text-primary'></i>&nbsp;&nbsp;<input id='font_s' class='myslider' type='range' max="1.13" min="0.45" step="0.05">&nbsp;&nbsp;<i onclick='increaserange("+")' class='fa fa-plus text-primary' style='cursor: pointer;' ></i>
                <br>
                <label><b>{{ __('Font color:') }}</b></label>
                <input style='width:60px' class='form-control' id='font_c' type='color' />
                <br>
                <label><b>{{ __('Background color:') }}</b></label>
                <input style='width:60px' class='form-control' id='font_bg' type='color' />

                <small><i class='fa fa-exclamation-triangle text-warning'></i>{{ __('Changing background colors might produce unappealing results')}} </small>
                <input type='hidden' value='none' id='element_id'>
            </div>
        </span>
</div>
<div class='row' style='margin-left: 27px;'>
    <button onclick='saveprodlayout()' class='btn btn-primary'>{{__('Save my product layout')}}</button>

</div>
<br><br>
<!-- to give the footer space -->
<br><br>
<br><br>
<script class='removal'>$("select").selectpicker();layouterevents();$(".removal").remove()</script>