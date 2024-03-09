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

function edit(id) {
    console.log("called with id : ",id)
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
                var password = document.getElementById("edit-password");
              }
            })

        },
        error: function (error) {
            console.log("failed", error);
        }
    });
}
