@for($i=0;$i<ceil($amount/3);$i++)
<div class='row' data='{{$amount}}'>
	@if($i*3<$amount)
    <div class='col-sm-4'>
        <div class='card'>
            <div class='card-header'>{{ __('Field title') }} {{ $i*3+1 }} </div>
            <div class='card-body'>
            	<input class="form-control" type='text' id='field_{{ $i*3+1 }}' placeholder='The name of your information field in the catalog'>
            </div>
        </div>
    </div>
    @endif
	@if($i*3+1<$amount)
    <div class='col-sm-4'>
        <div class='card'>
            <div class='card-header'>{{ __('Field title') }} {{ $i*3+2 }}</div>
            <div class='card-body'>
            	<input class="form-control" type='text' id='field_{{ $i*3+2 }}' placeholder='The name of your information field in the catalog'>
            </div>
        </div>
    </div>
    @endif
	@if($i*3+2<$amount)
    <div class='col-sm-4'>
        <div class='card'>
            <div class='card-header'>{{ __('Field title') }} {{ $i*3+3 }} </div>
            <div class='card-body'>
            	<input class="form-control" type='text' id='field_{{ $i*3+3 }}' placeholder='The name of your information field in the catalog'>
            </div>
        </div>
    </div>
    @endif
 </div>
 @endfor
 <hr />
 <br>
<div class='row'>
	<div class='col-md-4'>
        <div class='card'>
            <div class='card-header'>{{ __('Product Images') }}</div>
            <div class='card-body'>
            	<label for='img_amount'>{{ __('The amount of images a product can have.') }}<br>{{ __('Choose 0 for none') }}</label>
            	<input class="form-control" type='number' min="0" max="4" id='img_amount' value='0'>
            </div>
        </div>
    </div>
    <div class='col-md-4'></div>
    <div class='col-md-4'>
        <div class='card'>
            <div class='card-header'>{{ __('Catalog title') }}</div>
            <div class='card-body'>
                <input class="form-control" id='cat_title_gen' type='text' placeholder="{{ __('The name of your catalog') }}">
                <br>
                <button class='btn btn-primary right-float' onclick='createCatalog()'>{{ __('Generate your catalog') }}</button>
            </div>
        </div>
    </div>
</div>

<br><br><br><br>