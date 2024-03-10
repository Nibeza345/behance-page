$(document).ready(function () {
    const tbody = document.querySelector("tbody");
    var editForm = document.getElementById("edit-form")
    editForm.classList.display = "none";

    $("#show").click(function () {
        $.ajax({
            url: '../backend/get_users.php',
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                $.each(response, (index, user) => {
                    const tr = document.createElement("tr");
                    tr.innerHTML = `
                    <td>${user.id}</td>
                    <td>${user.username}</td>
                    <td>${user.email}</td>
                    <td>${user.password}</td>
                    <td> <input type="checkbox" id="delete"> </td>
                    <td> <button type="button" id="edit" onclick="edit(${user.id})" data-id=${user.id}>Edit</button></td>
                    `
                    tbody.appendChild(tr)
                })
            },
            error: function (error) {
                console.log("failed", error);
            }
        });
    })
})
// assigning the value in the current user info into the edit form
function edit(id) {
    $.ajax({
        url: '../backend/get_users.php',
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            $.each(response, (index, user) => {
                if (user.id == id) {
                    var name = document.getElementById("edit-name");
                    name.value = user.username
                    var email = document.getElementById("edit-email");
                    email.value = user.email
                    var password = document.getElementById("edit-password");
                    password.value = user.password
                }
            })

        },
        error: function (error) {
            console.log("failed", error);
        }
    }
    
    );
    
        $('#save').click(function (e) {
            e.preventDefault();
            console.log("form submitted!")
            var username = $('#edit-name').val();
            var email = $('#edit-email').val();
            var password = $('#edit-password').val();
    
            // Send the signup data to the server
            $.ajax({
                url: '../backend/edit.php',
                method: 'POST',
                data: {
                    username: username,
                    password: password,
                    email: email
                },
                success: function (response) {
                    console.log(response);
                    
                }
            });
    
        });
    }
