<div class='row'>
    <div class='col-sm-6'>
        <div class='card'>
            <div class='card-header'>{{ __('Number of fields') }}</div>
            <div class='card-body'>
                <input class="form-control" min="1" type='number' id='manual_amount' style='width:80%' placeholder="{{ __('The number of fields in the catalogue (exluding images)') }}" step="1"/><br>
                <button class='btn btn-success' value='field_nr' onclick="createCatalogFields()">{{ __('Start your catalog') }}</button>
            </div>
        </div>
    </div>
    <div class='col-sm-6'>
        <div class='card'>
            <div class='card-header'>{{ __('Import a CSV file') }}</div>
            <div class='card-body'>
                <label for='title'><b>{{ __('Catalogue title') }}:</b>&nbsp;&nbsp;&nbsp;</label><input type="text" class="form-control" id='cat_title' name='cat_title' style='width:80%;display:inline' /><br><br>
                <label for='delimiter'><b>{{ __('Field delimiter') }}:</b>&nbsp;&nbsp;&nbsp;</label>
                <select class='selectpicker' name='delimiter'>
                  <option val=';' data-content="<span class='btn btn-info'><b>;</b>&nbsp;&nbsp;<strong class='text-muted'>{{ __('Semicolon') }}</strong></span></span>"><b>;</b></option>  
                  <option val=',' data-content="<span class='btn btn-info'><b>,</b>&nbsp;&nbsp;<strong class='text-muted'>{{ __('Comma') }}</strong></span>"><b>,</b></option>  
                  <option val='.' data-content="<span class='btn btn-info'><b>.</b>&nbsp;&nbsp;<strong class='text-muted'>{{ __('Dot') }}</strong></span></span>"><b>.</b></option>  
                </select>
                <hr />
                <input type="file" accept='.csv' id="upload_catalog" name='upload_catalog' class="file"><br>
                <small>
                    <i class='fa fa-exclamation-triangle text-warning'></i>{{ __(' If you already have a catalogue created, creating a new one will overwrite the previous catalogue') }}<br>
                    <i class='fa fa-exclamation-triangle text-danger'></i>{{ __(' Please make sure your CSV file contains headers, as it will be impossible to map your data without them') }}
                </small>
                <br>
                <button class='btn btn-primary' onclick='createCSVCatalog()'>{{ __('Generate your catalogue') }}</button>
            </div>
        </div>
    </div>
    
</div><br><br>
<div id="catalog_fields"></div>
<script src="{{ asset('js/init_events.js') }}" async></script>