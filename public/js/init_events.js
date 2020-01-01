 var uploadFileSettings = {
    'showClose': false,
    'showUpload':false,
    'uploadUrl': "./upload", // server upload action
    'ajaxSettings': {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    },
    'uploadExtraData':  function(previewId, index) {
        return {
        'cat_title': $("#cat_title").val(),
        'delimiter': $("select").val()
        }
    },
    'error':'You are not allowed to upload such a file.',
    'showPreview':true,
    'msgInvalidFileExtension':'Invalid extension for file "{name}". Only CSV or Excel files are supported.',
    'allowedFileExtensions':['csv', 'CSV', 'xlsx', 'xlsm','xls'],
    'dropZoneEnabled':false,
    'maxFileSize': 10240
};
$(function(){
    $('select').selectpicker({
        'showTick':true,
        'width':'fit'
    });
      $('#spinner').load('./loading/spinner.html');
   
	$("#upload_catalog").fileinput(uploadFileSettings);
    

});