//get parameters from url
$.urlParam = function(name){
	var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
	return results[1] || 0;
}

//if user focused on input
$(document).on('focus','[data-type="input"]', function() {
    $(this).css("border-bottom", "2px solid #6e5dff");
    $(this).css("cursor", "auto");
});

//if user focudes out of input
$(document).on('focusout','[data-type="input"]', function() {
    $(this).css("border-bottom", "none");
    $(this).css("cursor", "pointer");
});

//if input values got changed send it to database
$(document).on('change','[data-type="input"]', function() {
    var task_list_id = this.getAttribute('data-id');
    var name = this.getAttribute('data-name');
    var task_id = this.getAttribute('data-task_id');
    var value = $(this).val();
    editTaskList(task_list_id, name, value, task_id)
});

function editTaskList(task_list_id, name, value, task_id){
    $.ajax({
        type: "POST",
        url: "http://localhost/ManageIT/edit_task_list.php",
        data: {
            edit_task_list: true,
            task_list_id:  task_list_id,
            name: name,
            value: value,
            task_id: task_id
        },
    })
}

$(document).ready(function(){
    //add new task list
    $(".add_task_list").click(function(){
        var event_id = $.urlParam('event_id');
        $.ajax({
            type: "POST",
            url: "http://localhost/ManageIT/add_task_list.php",
            data: {
                add_task_list: true,
                event_id:  event_id
            },
        })
        .done(response => {
            $(".add_task_list_container").before(response);
        })
    });

    //add new task
    $(document).on('click','.add_task', function() {
        var task_list_id = this.getAttribute('data-id');
        $.ajax({
            type: "POST",
            url: "http://localhost/ManageIT/add_task.php",
            data: {
                add_task: true,
                task_list_id:  task_list_id
            },
        })
        .done(response => {
             $(".task_container[data-id="+task_list_id+"]").append(response);
             uptadeProgressBar(task_list_id);
        })
    });

    //remove task
    $(document).on('click','.delete_task', function() {
        var task_id = this.getAttribute('data-task_id');
        var task_list_id = this.getAttribute('data-id');
        $.ajax({
            type: "POST",
            url: "http://localhost/ManageIT/remove_task.php",
            data: {
                remove_task: true,
                task_id:  task_id
            },
        })
        .done(response => {
             $(".task[data-task_id="+task_id+"]").remove();
             uptadeProgressBar(task_list_id);
        })
    });

    //remove member from task
    $(document).on('click','.delete_member', function() {
        var task_list_id = this.getAttribute('data-id');
        var user_id = this.getAttribute('data-user_id');
        $.ajax({
            type: "POST",
            url: "http://localhost/ManageIT/remove_member.php",
            data: {
                remove_member: true,
                task_list_id:  task_list_id,
                user_id: user_id
            },
        })
        .done(response => {
             $(".member_container[data-id="+task_list_id+"][data-user_id="+user_id+"]").remove();
        })
    });
    


    //checbkox function
    $(document).on('click','.task_checkbox', function(){
        var task_id = this.getAttribute('data-task_id');
        var task_list_id = this.getAttribute('data-id');
        var status = 0;
        if($(this).prop('checked')){
            status = 1;
        }
        else{
            status=0;
        }
        $.ajax({
            type: "POST",
            url: "http://localhost/ManageIT/change_task_status.php",
            data: {
                change_status: true,
                task_id:  task_id,
                status: status
            },
        })
        .done(response => {
             uptadeProgressBar(task_list_id);
        })
    });

    //this function uptades progress bar
    function uptadeProgressBar(task_list_id){
        var checkboxes = 0;
        var checked_checboxes = 0;
        var score = 0;
        $("input[type=checkbox][data-id="+task_list_id+"]").each(function(){
            checkboxes++;
            if($(this).prop('checked')){
                checked_checboxes++;
            }
        })
        if(checkboxes == 0){
            score = 100;
        }
        else{
            score = ( checked_checboxes / checkboxes ) * 100;
            score = Math.round(score);
        }
        
        $(".progress-bar[data-id="+task_list_id+"]").css('width', score+'%').attr('aria-valuenow', score).text(score+"%");
    }

    //remove card_list
    $(document).on('click','.delete_task_list', function() {
        var task_list_id = this.getAttribute('data-id');
        $.ajax({
            type: "POST",
            url: "http://localhost/ManageIT/remove_task_list.php",
            data: {
                remove_task_list: true,
                task_list_id:  task_list_id,
            },
        })
        .done(response => {
             $(".task_card[data-id="+task_list_id+"]").remove();
        })
    });

    $(".task_card").each(function(){
        var task_list_id = this.getAttribute('data-id');
        uptadeProgressBar(task_list_id);
    })
});
