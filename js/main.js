$(function () {

    //User Registration
    $("#regsubmit").click(function () {
        var name = $("#name").val();
        var username = $("#username").val();
        var password = $("#password").val();
        var email = $("#email").val();
//        var dataString = 'name' + name + '&username' + username + '&password' + password + '&email' + email;

        $.ajax({
            type: 'post',
            url: 'getregister.php',
//            data:dataString,
            data: {name: name, username: username, password: password, email: email},
            success: function (data) {
                $("#state").html(data);
            }
        });
        return false;
    });

    //User Login
    $("#loginsubmit").click(function () {
        var email = $("#email").val();
        var password = $("#password").val();
        $.ajax({
            type: 'post',
            url: 'getlogin.php',
            data: {email: email, password: password},
            success: function (data) {
                if ($.trim(data) == 'empty') {
                    $("#empty").show();
                    setTimeout(function () {
                        $("#empty").fadeOut();
                    }, 2000);
                } else if ($.trim(data) == 'disable') {
                    $("#disable").show();
                    setTimeout(function () {
                        $("#disable").fadeOut();
                    }, 2000);
                } else if ($.trim(data) == 'error') {
                    $("#error").show();
                    setTimeout(function () {
                        $("#error").fadeOut();
                    }, 2000);
                } else {
                    window.location = "exam.php";
                }
            }
        });
        return false;
    });


});