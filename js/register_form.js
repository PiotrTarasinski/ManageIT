//this function allow to preview choosen image as avatar 
function previewAvatar(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#avatar_preview').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

//this function trigger default input file dialog
$('#add_avatar_register').click(function(){
    $('#avatar_register').trigger('click');
});

