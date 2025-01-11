<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery -->
    <title>Online Job Application</title>
</head>
<body>
    <div id="svg_wrap"></div>

    <h1>Online Job Application</h1>
    <section>
        <!-- The form no longer has an action attribute, as it will be handled by AJAX -->
        <form id="applicationForm" method="POST">
            <input type="text" placeholder="Firstname" name="Firstname" required />
            <input type="text" placeholder="Surname" name="Surname" required />
            <input type="date" placeholder="Birthdate" name="Birthdate" required />
            <input type="text" placeholder="Street" name="Street" required />
            <input type="text" placeholder="City" name="City" required />
            <input type="text" placeholder="Mobile" name="Mobile" required />
            <!-- Button triggers JavaScript function to submit the form via AJAX -->
            <button class="button" type="button" onclick="submitForm()">Submit</button>
        </form>
        <div id="responseMessage"></div> <!-- For displaying success or error messages -->
    </section>

    <script>
        // Submit form via AJAX
        function submitForm() {
            // Serialize form data
            var formData = $("#applicationForm").serialize();
            
            // Send the form data using AJAX
            $.ajax({
                url: "connect.php",  // The PHP file that will handle the request
                type: "POST",        // Using POST method
                data: formData,      // Form data
                success: function(response) {
                    // Display the response from PHP (e.g., success or error message)
                    $("#responseMessage").html(response);
                },
                error: function(xhr, status, error) {
                    // Display error message if AJAX request fails
                    $("#responseMessage").html("There was an error submitting the form.");
                }
            });
        }
    </script>
</body>
</html>
