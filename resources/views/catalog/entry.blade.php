<h2>{{$title}}</h2>
<hr /><br>
<div class='col-md-12 jumbotran'>
	<div class="row">
		@for($i=0;$i<count($headers);$i++)
				<div class="col-md-4">
				    @if($headers[$i]->type=='desc')
				    	<div class="form-group color-border-focus">
				    	<label class="text-capitalize" for="header_{{ $headers[$i]->id }}">{{ $headers[$i]->name }}:</label>
						  <textarea class="form-control z-depth-1" id="exampleFormControlTextarea6" rows="3"> </textarea>
						</div>
					@else
				    	<label class="text-capitalize" for="header_{{ $headers[$i]->id }}">{{ $headers[$i]->name }}:</label>
				    	<input class="form-control" type='text' id='header_{{ $headers[$i]->id }}'/><br>
				    @endif
				</div>
		@endfor
	</div>
</div>
<button class="btn btn-primary" onclick="addentry()"><i class="fa fa-plus"></i>&nbsp;Add entry</button>
</div>
<!-- to give the footer space -->
<br><br>
<br><br>