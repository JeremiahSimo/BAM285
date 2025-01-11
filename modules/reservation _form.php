<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f9;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);   
            width: 100%;
            max-width: 400px;
        }
        input, button {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #5cb85c;  
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>

<form action="connect3.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="rsv_name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="rsv_email" required>

    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="rsv_phone" required>

    <label for="date">Reservation Date:</label>
    <input type="date" id="date" name="rsv_date" required>

    <label for="time">Reservation Time:</label>
    <input type="time" id="time" name="rsv_time" required>

    <button type="submit">Submit</button>
</form>

    </form>
</body>
</html>
