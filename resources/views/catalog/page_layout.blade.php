<h2>Catalog layout</h2>
<hr />
<div class='row'>
    <div class='col-md-12 ignore' id='header' style='position: relative;border: 0;padding: 12px;
        @if(!empty($page_settings))
            background:{{$page_settings->banner_color}}
        @endif
        '>

        <img style='color:white' id='config_logo' src='{{asset(Auth::id()."/mylogo.png")}}' alt='{{ __('The place for your company logo')}}' />
        <input 
        @if(!empty($page_settings))
            value='{{$page_settings->comp_name}}'
        @endif
        style='margin-left: 15%;' class='form-control-mine' type='text' placeholder='{{ __('Your company name') }}'  size='50px' id='comp_name'/>
        <input style='float:right' onchange='$(this).parent().css("background",$(this).val())' type='color' title='{{ __('Choose the color of your page header') }}' 

        @if(!empty($page_settings))
            value='{{$page_settings->banner_color}}'
        @else
            value='#000000'
        @endif
         id='header_color'/>
        <span style='float:right;font-weight:bold'>{{ __('Choose the color of your page header') }}&nbsp;&nbsp;</span>
    </div>
    
    <div class='col-md-12'>
        <br>
        <input type='file'  class='fileinput' id='comp_logo' name='comp_logo' />
    </div>
    <br>
    <hr />
    <ul style='display: inherit;width:100%;'>
        <li class='threecols'>
            <div class='card'>
                <div class='card-header'>{{ __('This is a product placeholder') }}</div>
                <div class='card-body' style='height:150px'>{{ __('This is a product placeholder') }}</div>

            </div>
        </li>
        <li class='threecols'>
            <div class='card'>
                <div class='card-header'>{{ __('This is a product placeholder') }}</div>
                <div class='card-body' style='height:150px'>{{ __('This is a product placeholder') }}</div>
            </div>
        </li>
        <li class='threecols'>
            <div class='card'>
                <div class='card-header'>{{ __('This is a product placeholder') }}</div>
                <div class='card-body' style='height:150px'>{{ __('This is a product placeholder') }}</div>
            </div>
        </li>
    </ul>
</div>
<div class='row' style='margin-left: 27px;'>
    <button onclick='savepagelayout()' class='btn btn-primary'>{{__('Save my page layout')}}</button>

</div>
<br><br>
<!-- to give the footer space -->
<br><br>
<br><br>