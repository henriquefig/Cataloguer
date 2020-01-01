<h2>Catalog layout</h2>
<hr />
<div class='row'>
    <div class='col-md-5'>
        <div class='card'>
            <div class='card-header' align='center' style='border:none!important;background:#2a335fe6!important;'>
                    <select class='selectpicker' id='ord_0' data-style="btn-primary">
                    @foreach ($titles as $title)
                        @if($title->name=='image1')
                            <option value='{{$title->id}}'>{{ __('Images') }} </option>
                        @elseif($title->name!='image1' && trim(strpos($title->name,'image'))!="0")
                            <option value='{{$title->id}}'>{{$title->name}}</option>
                        @endif
                    @endforeach
                    </select><br>
                    <small>
                {{ __('Select the text color:') }}
                 <input type="color" name="tcolor0" id="tcolor0" value="#000000">
                 <br>
                {{ __('Select the background color:') }}
                 <input type="color" name="backcolor0" id="backcolor0" value="#ffffff">
                </small>
                
            </div>
                <div class='card-body' >
                    @for($i=1;$i<count($titles);$i=$i+2)
                        <div class='row'>
                            <div class='col-md-6'>
                                @if($titles[$i]->name!='image1' && trim(strpos($titles[$i]->name,'image'))=="0")
                                    @continue
                                @endif
                                <select class='selectpicker'  id='ord_{{$i}}'  data-style="btn-info">
                                @foreach ($titles as $title)
                                    @if($title->name=='image1')
                                        <option value='{{$title->id}}'>{{ __('Images') }}</option>
                                    @elseif($title->name!='image1' && trim(strpos($title->name,'image'))!="0")
                                        <option value='{{$title->id}}'>{{$title->name}}</option>
                                    @endif
                                @endforeach
                                </select><br>
                                <small>
                                {{ __('Select the text color:') }}
                                 <input type="color" name="tcolor0" id="tcolor{{$i}}" value="#000000">
                                 <br>
                                {{ __('Select the background color:') }}
                                 <input type="color" name="backcolor0" id="backcolor{{$i}}" value="#ffffff">
                                </small>
                            </div>
                            <div class='col-md-6'>
                                @if(count($titles)==$i+1 || ($titles[$i+1]->name!='image1' && trim(strpos($titles[$i+1]->name,'image'))=="0"))
                                    @continue
                                @endif
                                <select class='selectpicker'  id='ord_{{$i+1}}'  data-style="btn-info">
                                @foreach ($titles as $title)
                                    @if($title->name=='image1')
                                        <option value='{{$title->id}}'>{{ __('Images') }}</option>
                                    @elseif($title->name!='image1' && trim(strpos($title->name,'image'))!="0")
                                        <option value='{{$title->id}}'>{{$title->name}}</option>
                                    @endif
                                @endforeach
                                </select><br>
                                <small>
                            {{ __('Select the text color:') }}
                             <input type="color" name="tcolor0" id="tcolor{{$i+1}}" value="#000000">
                             <br>
                            {{ __('Select the background color:') }}
                             <input type="color" name="backcolor0" id="backcolor{{$i+1}}" value="#ffffff">
                            </small>
                            </div>
                        </div><hr />
                    @endfor
            </div>
        </div>


      <!--  <table class='table jumbotron'>
     <thead>
        <th>
            <h3 style='border:1px dotted grey'>
                <select class='selectpicker' id='ord_0' data-style="btn-primary">
                @foreach ($titles as $title)
                    @if($title->name=='image1')
                        <option value='{{$title->id}}'>{{ __('Images') }} </option>
                    @elseif($title->name!='image1' && trim(strpos($title->name,'image'))!="0")
                        <option value='{{$title->id}}'>{{$title->name}}</option>
                    @endif
                @endforeach
                </select><br><small><i class='fa fa-info-circle'></i>&nbsp;
                {{ __('Appropriate for a title/header') }}
                <br>  
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
                <div class='col-md-4' style='margin-bottom:15px;border:1px dotted grey'>
                <select class='selectpicker' id='ord_1' data-style="btn-info">
                @foreach ($titles as $title)
                    @if($title->name=='image1')
                        <option value='{{$title->id}}'>{{ __('Images') }} </option>
                    @elseif($title->name!='image1' && trim(strpos($title->name,'image'))!="0")
                        <option value='{{$title->id}}'>{{$title->name}}</option>
                    @endif
                @endforeach
                </select><br>
                <small style='font-size:12px'><i class='fa fa-info-circle'></i>&nbsp;{{ __('Appropriate for images or sub-titles.') }}
                <br>
                {{ __('Select the text color:') }}
                 <input type="color" name="tcolor1" id="tcolor1" value="#000000">
                 <br>
                {{ __('Select the background color:') }}
                 <input type="color" name="backcolor1" id="backcolor1" value="#ffffff">
                </small>

                </div>
                <div class='col-md-8' style='margin-bottom:15px;border:1px dotted grey'>
                <select class='selectpicker' id='ord_2' data-style="btn-info">
                @foreach ($titles as $title)
                    @if($title->name=='image1')
                        <option value='{{$title->id}}'>{{ __('Images') }} </option>
                    @elseif($title->name!='image1' && trim(strpos($title->name,'image'))!="0")
                        <option value='{{$title->id}}'>{{$title->name}}</option>
                    @endif
                @endforeach
                </select><br>
                <small style='font-size:12px'><i class='fa fa-info-circle'></i>&nbsp;{{ __('Appropriate place for a descriptive field.') }}
                <br>
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
                <div class="col-md-4" style='margin-bottom:15px;border:1px dotted grey'>
                    <select class='selectpicker'  id='ord_{{$i}}'  data-style="btn-info">
                    @foreach ($titles as $title)
                        @if($title->name=='image1')
                            <option value='{{$title->id}}'>{{ __('Images') }}</option>
                        @elseif($title->name!='image1' && trim(strpos($title->name,'image'))!="0")
                            <option value='{{$title->id}}'>{{$title->name}}</option>
                        @endif
                    @endforeach
                    </select>
                    <br><small style='font-size:12px'><i class='fa fa-info-circle'></i>&nbsp;{{ __('General purpose field.') }}
                    <br>
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
        </tbody>
    </table>-->
    </div>
</div>

<br><br>
<button class="btn btn-primary" onclick="publish()"><i class="fa fa-check"></i>&nbsp;Publish your catalog</button>
<script>$("select").selectpicker();init_dropzone()</script> 
<!-- to give the footer space -->
<br><br>
<br><br>