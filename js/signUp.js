    // Handle form submission
    $('#signup-form').submit(function (event) {
        event.preventDefault();
        var username = $('#username').val();
        var email = $('#email').val();
        var password = $('#password').val();

        // Send the signup data to the server
        $.ajax({
            url: '../backend/process_signup.php',
            method: 'POST',
            data: {
                username: username,
                password: password,
                email: email
            },
            success: function (response) {
                // Clear the form and reload the user table
                $('#username').val('');
                $('#email').val('');
                $('#password').val('');

                // loadUsers();
                console.log(response)
            }
        });
    
    });
