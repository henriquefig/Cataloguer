<h2>{{ __('Header\'s mapping') }}</h2>
<hr />
<div class='col-md-12 jumbotran'>
	<ul style='width:100%'>
	@php
     	$flag=false;
     @endphp
     
	@for($i=0;$i<count($titles);$i++)
	<li style='width:28.5%;display: inline-block;margin: 0px 50px 0px 0px;'>
		<div class='form-group map_div'>
		    <label class="text-capitalize"><b>{{ $titles[$i]->name }}:</b></label>
		    <select class="selectpicker" id='cat_{{ $titles[$i]->name }}_{{ $titles[$i]->id }}'>

		    	@if($cat[$i]->type=='header')
		    	<option value='header' selected>{{ __('Header') }}</option>
		    	@else
		    	<option value='header'>{{ __('Header') }}</option>
		    	@endif
		    	@if($cat[$i]->type=='desc')
		    	<option value='desc' selected>{{ __('Description') }}</option>
		    	@else
		    	<option value='desc'>{{ __('Description') }}</option>
		    	@endif
		    	@if($cat[$i]->type=='text')
		    	<option value='text' selected>{{ __('Text') }}</option>
		    	@else
		    	<option value='text'>{{ __('Text') }}</option>
		    	@endif
		    	@if($cat[$i]->type=='link')
		    	<option value='link' selected>{{ __('Link') }}</option>
		    	@else
		    	<option value='link'>{{ __('Link') }}</option>
		    	@endif
		    	@if($cat[$i]->type=='image')
		    	<option value='image' selected>{{ __('Image') }}</option>
		    	@else
		    	<option value='image'>{{ __('Image') }}</option>
		    	@endif
		    </select>
		     @if($cat[$i]->type!='image')
		    <hr />
		    <div class='checkbox checkbox-circle checkbox-success'>
			    <input class="styled" type='checkbox' id='cat_{{ $titles[$i]->name }}_{{ $titles[$i]->id }}_vis' 
			    @if($cat[$i]->visibility==true)
			    checked
			    @endif
			     ><label  for='cat_{{ $titles[$i]->name }}_{{ $titles[$i]->id }}_vis' >{{ __('Visible') }}</label>
		 	</div>
		     <div class='checkbox checkbox-circle checkbox-info'>
			    <input class="styled" type='checkbox' id='cat_{{ $titles[$i]->name }}_{{ $titles[$i]->id }}_sort' 

			    @if($cat[$i]->sort==true)
			    checked
			    @endif
			    ><label for='cat_{{ $titles[$i]->name }}_{{ $titles[$i]->id }}_sort' >{{ __('Sortable') }}</label>
		    </div>
		    @endif
		</div>
	</li>
     @if($flag==false && $i+1<count($cat) && $cat[$i+1]->type=='image')
     </ul>
     <br><hr /><br>
     <ul style='width:100%'>
     @php
     	$flag=true;
     @endphp
     @endif
    @endfor
	</ul>
	<div class='col-md-12'>

		<button class="btn btn-primary" style='margin-left: 38px;' onclick="savecategories()"><i class="fa fa-plus"></i>&nbsp;{{ __('Save mapping') }}</button>
	</div>
</div>
<!-- to give the footer space -->
<br><br>
<br><br>
<script>$("select").selectpicker();sortingfunc();</script>