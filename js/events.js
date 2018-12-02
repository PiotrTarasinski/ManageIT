//this function allow to preview choosen image as logo of the event 
function previewLogo(input) {
    if (input.files && input.files[0]) {
      var id = input.getAttribute('data-id');
      var reader = new FileReader();
      reader.onload = function(e) {
        $("[data-id="+id+"][data-type='preview']").attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
//this function triggers input file
function triggerInputFile(input){
    var id = input.getAttribute('data-id');
    $("[data-id="+id+"][data-function='input-file']").trigger('click');
}
//this function turn on/off event edit
function editEvent(input){
    var id = input.getAttribute('data-id');
    var isDisabled = input.getAttribute('data-disabled');
    
    if(isDisabled==1){
      input.dataset.disabled = 0;
      $("[data-id="+id+"][data-type='input']").removeAttr('disabled');
    }
    else{
      input.dataset.disabled = 1;
      $("[data-id="+id+"][data-type='input']").attr('disabled','disabled');
    }
}
  