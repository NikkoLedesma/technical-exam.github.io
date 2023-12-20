$(document).ready(function () {
    // Fetch and display existing records on page load
    fetchRecords();

    // Form submission using AJAX
    $("#productForm").submit(function (e) {
        e.preventDefault();
        submitForm();
    });

    // Function to submit form using AJAX
    function submitForm() {
        var formData = new FormData($("#productForm")[0]);

        $.ajax({
            url: "process.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);

                // Clear the form
                $("#productForm")[0].reset();

                // Fetch and display updated records
                fetchRecords();

                // Show success notification
                showNotification("Record added successfully!");
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    // Function to fetch and display records using AJAX
    function fetchRecords() {
        $.ajax({
            url: "fetch.php",
            type: "GET",
            success: function (data) {
                $("#tableBody").html(data);
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    // Function to show local notification
    function showNotification(message) {
        // You can customize the notification style here
        alert(message);
    }

    // Event delegation for view, edit, and delete buttons
    $("#tableBody").on("click", ".btn-view", function () {
        // Get the record ID from the button's data-id attribute
        var productId = $(this).data("id");

        // Use AJAX to fetch the record details
        $.ajax({
            url: "view.php",
            type: "GET",
            data: { id: productId },
            success: function (data) {
                // Display the record details in a modal
                $("#viewModal .modal-body").html(data);
                $("#viewModal").modal("show");
            },
            error: function (error) {
                console.error(error);
            }
        });
    });

    // Event delegation for edit button
    $("#tableBody").on("click", ".btn-edit", function () {
        var productId = $(this).data("id");

        // Use AJAX to fetch the record details
        $.ajax({
            url: "edit.php",
            type: "GET",
            data: { id: productId },
            success: function (data) {
                // Display the record details in the edit modal
                $("#editModal .modal-body").html(data);
                $("#editModal").modal("show");
            },
            error: function (error) {
                console.error(error);
            }
        });
    });

    // Handle the "Update" button click in the Edit Modal
    $("#editModal").on("click", "#updateBtn", function () {
        // Perform the update action using AJAX
        var formData = new FormData($("#editForm")[0]);

        $.ajax({
            url: "update.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);

                // Close the edit modal
                $("#editModal").modal("hide");

                // Fetch and display updated records
                fetchRecords();

                // Show success notification
                showNotification("Record updated successfully!");
            },
            error: function (error) {
                console.error(error);
            }
        });
    });

    // Event delegation for delete button
    $("#tableBody").on("click", ".btn-delete", function () {
        var productId = $(this).data("id");

        // Use AJAX to delete the record
        if (confirm("Are you sure you want to delete this record?")) {
            $.ajax({
                url: "delete.php",
                type: "POST",
                data: { id: productId },
                success: function (response) {
                    console.log(response);

                    // Fetch and display updated records
                    fetchRecords();

                    // Show success notification
                    showNotification("Record deleted successfully!");
                },
                error: function (error) {
                    console.error(error);
                }
            });
        }
    });

});
