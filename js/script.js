$(document).ready(function () {
    // Load users on page load
    loadUsers();

    // Handle form submission
    $('#signup-form').submit(function (event) {
        event.preventDefault();
        var username = $('#username').val();
        var email = $('#email').val();
        var password = $('#password').val();

        // Send the signup data to the server
        $.ajax({
            url: 'process_signup.php',
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

    // Handle user deletion
    $('#delete-users-button').click(function () {
        var selectedUserIds = [];
        $('.user-checkbox:checked').each(function () {
            selectedUserIds.push($(this).data('id'));
        });

        // Send the selected user IDs to the server for deletion
        $.ajax({
            url: 'delete_users.php',
            method: 'POST',
            data: { ids: selectedUserIds },
            success: function (response) {
                // loadUsers(1); // Reload the user table on the first page
            }
        });
    });

    // Handle pagination click
    $(document).on('click', '.page-link', function () {
        var page = $(this).data('page');
        // loadUsers(page);
    });
});
$("#show").click(function(){
    console.log("button clicked");
    
    $.ajax({
        url: 'get_users.php',
        method: 'GET',
        data: {
            // page: page
            username: username,
            password: password,
            email: email
        },
        success: function (response) {
            console.log(response);
        }, 
        error: function(error){
            console.log("failed", error);
        }
    });
})
// function loadUsers() {
//     $.ajax({
//         url: 'get_users.php',
//         method: 'GET',
//         data: {
//             // page: page
//             username: username,
//             password: password,
//             email: email
//         },
//         success: function (response) {
//             console.log(response);
//         }, 
//         error: function(error){
//             console.log("failed", error);
//         }
        //     var result = JSON.parse(response);
        //     var users = result.users;
        //     var totalPages = result.totalPages;

        //     var userTableBody = $('#user-table-body');
        //     userTableBody.empty();

        //     for (var i = 0; i < users.length; i++) {
        //         var user = users[i];
        //         var row = '<tr>' +
        //             '<td>' + user.id + '</td>' +
        //             '<td>' + user.name + '</td>' +
        //             '<td>' + user.email + '</td>' +
        //             '<td><input type="checkbox" class="user-checkbox" data-id="' + user.id + '"></td>' +
        //             '</tr>';
        //         userTableBody.append(row);
        //     }

        //     renderPagination(totalPages, page);
        // }
    // });


function renderPagination(totalPages, currentPage) {
    var paginationContainer = $('#pagination-container');
    paginationContainer.empty();

    for (var i = 1; i <= totalPages; i++) {
        var pageLinkClass = 'page-link' + (i === currentPage ? ' active' : '');
        var pageLink = '<span class="' + pageLinkClass + '" data-page="' + i + '">' + i + '</span>';
        paginationContainer.append(pageLink);
    }
}