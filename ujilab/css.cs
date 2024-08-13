/* Global Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    color: #333;
}

header {
    background-color: #4CAF50;
    color: white;
    padding: 20px;
    text-align: center;
}

header h1 {
    margin: 0;
}

main {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: white;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="text"],
input[type="number"],
datalist,
button {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #45a049;
}

button[type="button"] {
    width: auto;
    background-color: #2196F3;
}

button[type="button"]:hover {
    background-color: #0b7dda;
}

footer {
    margin-top: 20px;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

thead {
    background-color: #4CAF50;
    color: white;
}

th, td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #ddd;
}

a {
    text-decoration: none;
    color: #2196F3;
    transition: color 0.3s;
}

a:hover {
    color: #0b7dda;
}

.text-center {
    text-align: center;
}

.btn-2 {
    background-color: #ff5722;
    color: white;
    padding: 5px 10px;
    border-radius: 4px;
    text-decoration: none;
    transition: background-color 0.3s;
}

.btn-2:hover {
    background-color: #e64a19;
}
