//add event
$(document).ready(function(){
    $(".add_event_button").click(function(){
        $.ajax({
            type: "POST",
            url: "http://localhost/ManageIT/add_event.php",
            data: {
                add_event: true
            },
        })
        .done(response => {
            $(".row").prepend(response);
            $(".edit_icon:first").trigger('click');
        })
    });

    //remove event
    $(document).on('click','.delete_icon', function() {
        var event_id = this.getAttribute('data-id');
        $.ajax({
            type: "POST",
            url: "http://localhost/ManageIT/remove_event.php",
            data: {
                remove_event: true,
                event_id:  event_id,
            },
        })
        .done(response => {
             $(".col[data-id="+event_id+"]").remove();
        })
    });

    //sign off from event
    $(document).on('click','.sign_off', function() {
        var event_id = this.getAttribute('data-id');
        $.ajax({
            type: "POST",
            url: "http://localhost/ManageIT/sign_off_from_event.php",
            data: {
                sign_off_from_event: true,
                event_id:  event_id,
            },
        })
        .done(response => {
             $(".col[data-id="+event_id+"]").remove();
        })
    });

});

//go to event page
$(document).on('click','.enter_event_button', function() {
    var event_id = this.getAttribute('data-id');
    $(location).attr('href','event_manager.php?event_id='+event_id);
});

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
        $("[data-id="+id+"].edit_icon").html('<i class="fas fa-save"></i> Zapisz zmiany');
        $("[data-id="+id+"].add_img_button").removeClass("hide");
    }
    else{
        input.dataset.disabled = 1;
        $("[data-id="+id+"][data-type='input']").attr('disabled','disabled');
        $("[data-id="+id+"].edit_icon").html('<i class="fas fa-edit"></i>');
        $("[data-id="+id+"].add_img_button").addClass("hide");

        var title = $(".event_card_title[data-id="+id+"]").val();
        var date = $(".event_card_date_value[data-id="+id+"]").val();
        var description = $(".event_card_description[data-id="+id+"]").val();
        var logo =  $("[data-id="+id+"][data-function='input-file']").prop("files")[0];

        var form_data = new FormData();
        form_data.append("edit_event", true);
        form_data.append("event_id", id);
        form_data.append("logo_src", logo);
        form_data.append("title", title);
        form_data.append("date", date);
        form_data.append("description", description);

        $.ajax({
            url: "http://localhost/ManageIT/edit_event.php",
            type: 'POST',
            processData: false, 
            contentType: false,
            dataType : 'json',
            data: form_data
        });
    }
}


  