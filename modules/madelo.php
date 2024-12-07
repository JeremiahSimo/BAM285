<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Carl Vinncent D. Madelo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://source.unsplash.com/random/1600x900');
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            color: #333;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            width: 400px;
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            color: white;
        }
        h1 {
            text-align: center;
            color: #2980b9;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 16px;
            color: #2980b9;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.3);
            color: white;
            outline: none;
        }
        .form-group input:focus {
            border-color: #2980b9;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            margin-top: 30px;
            color: #aaa;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Profile Information</h1>
        <form>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" value="Carl Vinncent D. Madelo" disabled>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="text" id="age" value="21" disabled>
            </div>
            <div class="form-group">
                <label for="occupation">Occupation:</label>
                <input type="text" id="occupation" value="Software Developer" disabled>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" value="Zone 9, Macanhan, Carmen, CDO" disabled>
            </div>
        </form>
       
</body>
</html>
