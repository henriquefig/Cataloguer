<h2>Catalog layout</h2>
<hr />
<style>
    .drop-zone {
    border: 1px dotted #9C9898;
    height:350px;
    width:100%;
    margin-top: 10px;
    overflow:auto;
}
    </style>
 <input type="radio" name='orientation' id='orientation' value='horizontal'>
        <img src="{{asset('imgs/page_horizontal.png') }}" alt="{{ __('Horizontal page') }}"></img>
 <input type="radio" name='orientation' id='orientation' value='vertical' checked>
        <img src="{{asset('imgs/page_vertical.png') }}" alt="{{ __('Vertical page') }}"></img>
<hr />
<div class='row'>
    <div class='col-md-9'>
    <div style='font-size:20px'><br>
     <div class='rows'>

        <div class='containment topleft'>
          &nbsp;
        </div>
        <div class='containment top'>
          &nbsp;

        </div>
        <div class='containment topright'>
          &nbsp;

        </div>
        <div class='containment bottomleft'>
          &nbsp;
        </div>
        <div class='notcontainer'>
          &nbsp;

        </div>
        <div class='containment bottomright'>
          &nbsp;

        </div>
      </div>
      
        @for($i=10;$i<count($titles);$i++)
          <div class='middlerow'>

            <div class='containment centerleft'>
              &nbsp;
            </div>
            <div class='notcontainer'>
              &nbsp;

            </div>
            <div class='containment centerright'>
              &nbsp;

            </div>
          </div>
        @endfor
      
      <div class='rows'>
        <div class='containment topleft'>
          &nbsp;
        </div>
        <div class='notcontainer'>
          &nbsp;

        </div>
        <div class='containment topright'>
          &nbsp;

        </div>
        <div class='containment bottomleft'>
          &nbsp;
        </div>
        <div class='containment bottom'>
          &nbsp;

        </div>
        <div class='containment bottomright'>
          &nbsp;

        </div>
      </div>







       <!-- <thead>
        <th>
            <h3>
                <select class='selectpicker' id='ord_0' data-style="btn-success">
                @foreach ($titles as $title)
                    @if($title->name=='image1')
                        <option value='{{$title->id}}'>{{ __('Images') }} </option>
                    @elseif($title->name!='image1' && trim(strpos($title->name,'image'))!="0")
                        <option value='{{$title->id}}'>{{$title->name}}</option>
                    @endif
                @endforeach
                </select>
                {{ __('- Value') }}
                <br>  
                <small>
                {{ __('Select the text color:') }}
                 <input type="color" name="tcolor0" id="tcolor0" value="#000000">
                 <br>
                {{ __('Select the background color:') }}
                 <input type="color" name="backcolor0" id="backcolor0" value="#ffffff">
                </small>
            </h3>
        </th>
        </thead>
        <tbody>
         <tr><td>
            <div class="row">  
                <div class='col-md-4' style='margin-bottom:15px'>
                <select class='selectpicker' id='ord_1' data-style="btn-primary">
                @foreach ($titles as $title)
                    @if($title->name=='image1')
                        <option value='{{$title->id}}'>{{ __('Images') }} </option>
                    @elseif($title->name!='image1' && trim(strpos($title->name,'image'))!="0")
                        <option value='{{$title->id}}'>{{$title->name}}</option>
                    @endif
                @endforeach
                </select>
                {{ __(': Value') }}
                <br>
                <small>
                {{ __('Select the text color:') }}
                 <input type="color" name="tcolor1" id="tcolor1" value="#000000">
                 <br>
                {{ __('Select the background color:') }}
                 <input type="color" name="backcolor1" id="backcolor1" value="#ffffff">
                </small>

                </div>
                <div class='col-md-8' style='margin-bottom:15px'>
                <select class='selectpicker' id='ord_2' data-style="btn-primary">
                @foreach ($titles as $title)
                    @if($title->name=='image1')
                        <option value='{{$title->id}}'>{{ __('Images') }} </option>
                    @elseif($title->name!='image1' && trim(strpos($title->name,'image'))!="0")
                        <option value='{{$title->id}}'>{{$title->name}}</option>
                    @endif
                @endforeach
                </select>
                {{ __(': Value') }}<small style='font-size:12px'><i class='fa fa-exclamation-triangle'></i>&nbsp;{{ __('This is the appropriate place for a descriptive field.') }}</small>
                <br>
                <small>
                {{ __('Select the text color:') }}
                 <input type="color" name="tcolor2" id="tcolor2" value="#000000">
                 <br>
                {{ __('Select the background color:') }}
                 <input type="color" name="backcolor2" id="backcolor2" value="#ffffff">
                </small>

                </div>
                @for($i=3;$i<count($titles);$i++)
                    @if($titles[$i]->name!='image1' && trim(strpos($titles[$i]->name,'image'))=="0")
                        @continue
                    @endif
                <div class="col-md-4" style='margin-bottom:15px'>
                    <select class='selectpicker'  id='ord_{{$i}}'  data-style="btn-info">
                    @foreach ($titles as $title)
                        @if($title->name=='image1')
                            <option value='{{$title->id}}'>{{ __('Images') }}</option>
                        @elseif($title->name!='image1' && trim(strpos($title->name,'image'))!="0")
                            <option value='{{$title->id}}'>{{$title->name}}</option>
                        @endif
                    @endforeach
                    </select>
                    {{ __(': Value') }}<br>
                    <small>
                    {{ __('Select the text color:') }}
                     <input type="color" name="tcolor{{$i}}"  id="tcolor{{$i}}" value="#000000">
                     <br>
                    {{ __('Select the background color:') }}
                     <input type="color" name="backcolor{{$i}}" id="backcolor{{$i}}" value="#ffffff">
                    </small>
                </div>
                @endfor
            </div>
        </td></tr>
        </tbody>-->
    </div>
</div>
<div class='col-md-3'>
<ul style='font-size:20px'>
    @foreach ($titles as $title)
        @if($title->name=='image1')
            <li class='drag' id='dragme' value='{{$title->id}}'>{{ __('Images') }} </li>
        @elseif($title->name!='image1' && trim(strpos($title->name,'image'))!="0")
            <li class='drag' id='dragme' value='{{$title->id}}'>{{$title->name}}</li>
        @endif
    @endforeach
</ul>
</div>
</div>

<br><br>
<button class="btn btn-primary" onclick="publish()"><i class="fa fa-check"></i>&nbsp;Publish your catalog</button>
<script>$("select").selectpicker();init_dropzone()</script> 
<!-- to give the footer space -->
<br><br>
<br><br>