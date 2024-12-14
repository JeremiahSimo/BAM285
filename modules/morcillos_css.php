/* Basic Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 70%;
    margin: 0 auto;
    background-color: white;
    padding: 30px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-top: 50px;
}

h1 {
    text-align: center;
    color: #333;
}

form {
    display: flex;
    flex-direction: column;
}

fieldset {
    border: 1px solid #ddd;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 8px;
}

legend {
    font-weight: bold;
    font-size: 18px;
    color: #555;
}

label {
    font-size: 14px;
    margin-bottom: 5px;
    margin-top: 10px;
}

input, select, textarea {
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 10px;
    width: 100%;
    border-radius: 4px;
    border: 1px solid #ccc;
}

textarea {
    height: 100px;
}

button {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        width: 90%;
        padding: 15px;
    }
}
