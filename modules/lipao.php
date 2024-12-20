<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <link href='https://fonts.googleapis.com/css?family=Cantarell:400,700' rel='stylesheet' type='text/css'>
    <title>File Request Form</title>
</head>
<body>

  <div id='formContainer'>
    <div id='formHeader'>
      <h3>File Request Form</h3>
    </div>
    <form id='formBody' class='fileRequestForm FlowupLabels' method="POST" action="connect1.php">
      <p class='rf_notice'>Your information will be kept private and is only collected to satisfy our burning curiosity.</p>
      
      <div class='fl_wrap'>
        <label class='fl_label' for='rf_name'>Name:</label>
        <input class='fl_input' type='text' id='rf_name' name="rf_name" required />
      </div>
      <div class='fl_wrap'>
        <label class='fl_label' for='rf_email'>Email:</label>
        <input class='fl_input' type='email' id='rf_email' name="rf_email" required />
      </div>
      <div class='fl_wrap'>
        <label class='fl_label' for='rf_company'>Company:</label>
        <input class='fl_input' type='text' id='rf_company' name="rf_company" required />
      </div>
      <div class='fl_wrap'>
        <label class='fl_label' for='rf_phone'>Phone:</label>
        <input class='fl_input' type='tel' id='rf_phone' name="rf_phone" required />
      </div>
      <p>
        <input class='rf_submit' type='submit' value='Send' />
      </p>
    </form>
  </div>

</body>
</html>
