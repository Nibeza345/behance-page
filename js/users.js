$(document).ready(function () {
    const tbody = document.querySelector("tbody");

   

    // Edit button click event
    $(document).on("click", ".edit-button", function () {
        // Get the row data
        var row = $(this).closest("tr");
        var id = row.find("td:nth-child(1)").text().trim();
        var username = row.find("td:nth-child(2)").text().trim();
        var email = row.find("td:nth-child(3)").text().trim();
        var password = row.find("td:nth-child(4)").text().trim();

        // Set the data in the edit form
        $("#edit-id").val(id);
        $("#edit-name").val(username);
        $("#edit-email").val(email);
        $("#edit-password").val(password);

        // Display the edit form
        $("#edit-form").show();
    });

    // Form submit event
    $("#edit-form").submit(function (event) {
        // Prevent the default form submission
        event.preventDefault();

        // Get the form data
        var formData = $(this).serialize();

        // Send the form data to the server using AJAX
        $.post("../backend/update_user.php", formData, function (response) {
            // Handle the response from the server
            alert("User updated successfully!");
            // You can optionally reload the page or update the UI here
        }).fail(function (xhr, status, error) {
            // Handle errors
            console.error(xhr.responseText);
            alert("An error occurred while updating user.");
        });
    });
    
    document.getElementById('search-input').addEventListener('input', function() {
      var searchText = this.value.toLowerCase();
      var rows = document.querySelectorAll('#users-table tbody tr');

      rows.forEach(function(row) {
        var shouldHide = true;
        row.querySelectorAll('td').forEach(function(cell) {
          if (cell.textContent.toLowerCase().indexOf(searchText) > -1) {
            shouldHide = false;
          }
        });

        if (shouldHide) {
          row.style.display = 'none';
        } else {
          row.style.display = '';
        }
      });
    });

    $(document).ready(function() {
      $('#delete-btn').click(function() {
        var checkedIds = [];
        $('.user-checkbox:checked').each(function() {
          checkedIds.push($(this).data('id'));
        });

        if (checkedIds.length === 0) {
          alert('Please select at least one user to delete.');
          return;
        }

        if (confirm('Are you sure you want to delete the selected users?')) {
          $.ajax({
            url: '../backend/delete_users.php', // Your PHP script to handle delete
            method: 'POST',
            data: {
              ids: checkedIds
            },
            success: function(response) {
              alert('Users deleted successfully.');
              // Optionally, you can reload the page or update the table here
            },
            error: function(xhr, status, error) {
              console.error(error);
              alert('An error occurred while deleting users.');
            }
          });
        }
      });
    });


});
