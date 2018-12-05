    
    //close modal windows
    $(document).on('click','.windows_close', function(){
        $(".hero_body").removeClass("blur");
        $(".window_background").remove();
        $(".window_container").remove();
    });

    //open messages
    $(document).on('click','#open_messages', function(){
        $(".hero_body").addClass("blur");
        $("body").append("<div class="+"window_background"+"></div>");
        $("#dialog_window").load("messages.html");
       $.ajax({
           type: "POST",
           url: "http://localhost/ManageIT/show_messages.php",
           data: {
                show_messages: true
           },
       })
       .done(response => {
           $(".messages_list").html(response);
       })
    });

    //accept invite
    $(document).on('click','.accept_invite', function(){
        var message_id = this.getAttribute('data-id');
        var event_id = this.getAttribute('data-event_id');
        $.ajax({
            type: "POST",
            url: "http://localhost/ManageIT/invite_option.php",
            data: {
                    accept_invite: true,
                    message_id: message_id,
                    event_id: event_id
            },
        })
        .done(response => {
            $(location).attr('href','event_manager.php?event_id='+event_id);
        })
    });

    //discard invite
    $(document).on('click','.discard_invite', function(){
        var message_id = this.getAttribute('data-id');
        $.ajax({
            type: "POST",
            url: "http://localhost/ManageIT/invite_option.php",
            data: {
                    accept_invite: false,
                    message_id: message_id,
            },
        })
        .done(response => {
            $(".message_box[data-id="+message_id+"]").remove();
        })
    });

    //add friends
    $(document).on('click','.add_friends', function(){
        $(".hero_body").addClass("blur");
        $("body").append("<div class="+"window_background"+"></div>");
        $("#dialog_window").load("add_friends_window.html");
        var searched_user = "";
        var event_id = $.urlParam('event_id');
        $.ajax({
            type: "POST",
            url: "http://localhost/ManageIT/add_friends_search.php",
            data: {
                add_friends_search: true,
                event_id:  event_id,
                searched_user: searched_user
            },
        })
        .done(response => {
            $(".users_list").html(response);
        })
    });

    //send invite message
    $(document).on('click','.send_invite', function(){
        var event_id = $.urlParam('event_id');
        var user_id = this.getAttribute('data-user_id');
        $.ajax({
            type: "POST",
            url: "http://localhost/ManageIT/send_invite_message.php",
            data: {
                send_invite_message: true,
                event_id:  event_id,
                recipient_id: user_id
            },
        })
        .done(response => {
            $(".send_invite[data-user_id="+user_id+"]").removeClass('send_invite').addClass('already_member').find('.send_invite_text').html("Wysłano");
        })
    });

    //show assign task modal window
    $(document).on('click','.add_member', function(){
        var task_list_id = this.getAttribute('data-id');
        var event_id = $.urlParam('event_id');
        $(".hero_body").addClass("blur");
        $("body").append("<div class="+"window_background"+"></div>");
        $("#dialog_window").load("assign_task.html");
        $.ajax({
            type: "POST",
            url: "http://localhost/ManageIT/show_members.php",
            data: {
                show_members: true,
                event_id:  event_id,
                task_list_id: task_list_id
            },
        })
        .done(response => {
            $(".members_list").html(response);
        })

    });

    //assign task
    $(document).on('click','.assign_task', function(){
        var task_list_id = this.getAttribute('data-id');
        var user_id = this.getAttribute('data-user_id');
        $.ajax({
            type: "POST",
            url: "http://localhost/ManageIT/assign_task.php",
            data: {
                assign_task: true,
                task_list_id:  task_list_id,
                user_id: user_id
            },
        })
        .done(response => {
            $(".assign_task[data-user_id="+user_id+"]").removeClass('assign_task').addClass('already_member').find('.send_invite_text').html("Przydzielono");
            $(".members_container[data-id="+task_list_id+"]").append(response);
        })
    });

    //search users
    $(document).on('click','#add_friends_window_search', function(){
        var searched_user = $("#search_input").val();
        var event_id = $.urlParam('event_id');
        $.ajax({
            type: "POST",
            url: "http://localhost/ManageIT/add_friends_search.php",
            data: {
                add_friends_search: true,
                event_id:  event_id,
                searched_user: searched_user
            },
        })
        .done(response => {
            $(".users_list").html(response);
        })
    });