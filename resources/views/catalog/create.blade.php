<div class='row'>
    <div class='col-sm-6'>
        <div class='card'>
            <div class='card-header'>{{ __('Number of fields') }}</div>
            <div class='card-body'>
                <input class="form-control" min="1" type='number' id='manual_amount' style='width:80%' placeholder="{{ __('The number of fields in the catalog (exluding images)') }}" step="1"/><br>
                <button class='btn btn-success' value='field_nr' onclick="createCatalogFields()">{{ __('Start your catalog') }}</button>
            </div>
        </div>
    </div>
    <div class='col-sm-6'>
        <div class='card'>
            <div class='card-header'>{{ __('Import a CSV/Excel file') }}</div>
            <div class='card-body'>
                <label for='title'><b>{{ __('Catalog title') }}:</b>&nbsp;&nbsp;&nbsp;</label><input type="text" class="form-control" id='cat_title' name='cat_title' style='width:80%;display:inline' /><br><br>
                <label for='delimiter'><b>{{ __('Field delimiter') }}:</b>&nbsp;&nbsp;&nbsp;</label>
                <select class='selectpicker' name='delimiter'>
                  <option val=';' data-content="<span class='btn btn-info'><b>;</b>&nbsp;&nbsp;<strong class='text-muted'>{{ __('Semicolon') }}</strong></span></span>"><b>;</b></option>  
                  <option val=',' data-content="<span class='btn btn-info'><b>,</b>&nbsp;&nbsp;<strong class='text-muted'>{{ __('Comma') }}</strong></span>"><b>,</b></option>  
                  <option val='.' data-content="<span class='btn btn-info'><b>.</b>&nbsp;&nbsp;<strong class='text-muted'>{{ __('Dot') }}</strong></span></span>"><b>.</b></option>  
                </select>
                <hr />
                <input type="file" id="upload_catalog" name='upload_catalog' class="file"><br><br>
                <button class='btn btn-primary' onclick='createCSVCatalog()'>{{ __('Generate your catalog') }}</button>
            </div>
        </div>
    </div>
    
</div><br><br>
<div id="catalog_fields"></div>
<script src="{{ asset('js/init_events.js') }}" async></script>