<h2>{{$title}}</h2>
<hr /><br>
<table class='table'>
    <thead>
        @for($i=0;$i<count($headers);$i++)
            <th>
                {{ $headers[$i]->name }}
            </th>
        @endfor
            <th>{{ __('Edit') }}</th>
            <th>{{ __('Delete') }}</th>
    </thead>
    <tbody>
        @for($i=0;$i<$rows;$i++)
            @php
                $hidden_id=false;
            @endphp
        <tr>
            @foreach($entries as $name => $entry)
                @if(isset($entry[$i]))
                   <td style='margin:5px'
                    @if(strlen($entry[$i]['value'])>30)
                        title='{{ $entry[$i]['value'] }}'>
                        <input type='hidden' value='{{ $entry[$i]['value'] }}' />{{substr($entry[$i]['value'],0,13) .'...'.substr($entry[$i]['value'],strlen($entry[$i]['value'])-4,strlen($entry[$i]['value'])-1)}}
                    @else
                        > {{ $entry[$i]['value'] }}
                    @endif
                    @if(!$hidden_id)
                        @php
                            $hidden_id=true;
                        @endphp
                        <input type='hidden' id='hidden_id' name='hidden_id' value='{{ $entry[$i]['product_id'] }}'>
                    @endif
                    </td>
                @else
                    <td></td>
                @endif
            @endforeach
            <td align='center' id='edit_{{$i}}' onclick='edit_entry(this)'><i class='fa fa-pencil text-info' title={{ __('Edit entry') }}></i></td>
            <td align='center' id='delete_{{$i}}' onclick='delete_entry(this)'><i class='fa fa-times text-danger' title={{ __('Delete entry') }}></i></td>
        </tr>
        @endfor
    </tbody>
</table> <!-- MODAL -->
<div class="modal fade" tabindex="-1" role="dialog" id="edit_entry_modal" style='display:none'>
    <div class="modal-dialog" role="document" style='max-width: 45%;'>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Editing entry')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style='color:#2059ff;'>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="entry_modal_body">

            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-primary" onclick='save_changes_entry()'>{{ __('Save changes') }}</button> 
            </div>
        </div>
    </div>
</div>
<br><br>
<div class='card' style='float:right'>
            <div class='card-body'>
                <label><b>{{ __('Add entries with a CSV/Excel file') }}</b></label>
                
                <hr />
                <label for='delimiter'><b>{{ __('Field delimiter') }}</b></label>
                <select class='selectpicker' name='delimiter'>
                  <option val=';' data-content="<span class='btn btn-info'><b>;</b>&nbsp;&nbsp;<strong class='text-muted'>{{ __('Semicolon') }}</strong></span></span>"><b>;</b></option>  
                  <option val=',' data-content="<span class='btn btn-info'><b>,</b>&nbsp;&nbsp;<strong class='text-muted'>{{ __('Comma') }}</strong></span>"><b>,</b></option>  
                  <option val='.' data-content="<span class='btn btn-info'><b>.</b>&nbsp;&nbsp;<strong class='text-muted'>{{ __('Dot') }}</strong></span></span>"><b>.</b></option>  
                </select>
                <br>
                <input type="file" id="upload_catalog" name='upload_catalog' class="file"><br>
                <small><i class='fa fa-exclamation-triangle text-danger'></i>&nbsp;&nbsp;{{ __('Please do not include the field headers, as they\'re already imported for your catalog') }}</small>
                <br><br>
            </div>
        </div>
<dialog id='delete_dialog'>
    <section>
     <h6 class="text-danger" style='font-weight:bolder;font-size:1.7875rem;'>{{ __('Warning') }}</h6>
      <p>{{ __("You're permenantly deleting an entry from your catalog!") }}
      </p>

      {{ __("Are you sure you want to continue?") }}
    </section>
    <menu align="right">
      <button id="cancel" class='btn btn-secondary' type="reset" onclick='$(this).parent().parent()[0].close()'>{{ __('Cancel') }}</button>
      <button type="button" onclick='delete_confirm()' class='btn btn-danger' >{{ __('Confirm') }}</button>
    </menu>
</dialog>
<button class="btn btn-primary" onclick="newentry()"><i class="fa fa-plus"></i>&nbsp;{{ __('New entry') }}</button>
<!-- to give the footer space -->
<br><br>
<br><br>
<script>
$("select").selectpicker({'showTick':true,'width':'fit'});
uploadFileSettings.uploadExtraData=function(previewId, index) {
    return {
    'delimiter': $("select[name=delimiter]").val(),
    'extra':true
    }
};
$("#upload_catalog").fileinput(uploadFileSettings);
</script>