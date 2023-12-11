<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Page</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <link rel="stylesheet" href="Css/styleCadastro.css">
</head>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
    <h1 class="h1">Página Master</h1>

    <figure class="telecall">
      <img src="Imagens/Telecall.png" alt="Telecall">
    </figure>

    <div id="buttonContainer">
        <button onclick="adicionaUsuario()" class="btn1">Adiciona Usuário</button>
        <button onclick="consultaUsuario()" class="btn1">Consulta Usuário</button>
        <button onclick="alteraSenha()" class="btn1">Altera Senha</button>
        <button onclick="modeloBD()" class="btn1">Modelo BD</button>
        <button onclick="downloadUsers()" class="btn1">Download PDF</button>
    </div>
    
    <div id="tableContainer"></div>
    
    <script>
        function adicionaUsuario() {
            // Create a form with input fields for user details
            var form = document.createElement('form');
            form.id = 'userForm';

            var fields = [
                'login', 'senha', 'nome', 'nomeMaterno',
                'telefone', 'data', 'cpf', 'celular',
                'sexo', 'endereco', 'profile'
            ];

            for (var i = 0; i < fields.length; i++) {
                var label = document.createElement('label');
                label.textContent = fields[i] + ': ';
                form.appendChild(label);

                var input = document.createElement('input');
                input.type = 'text';
                input.name = fields[i];
                form.appendChild(input);

                form.appendChild(document.createElement('br'));
            }

            // Create an "Insert" button
            var insertButton = document.createElement('button');
            insertButton.type = 'button';
            insertButton.textContent = 'Insert';
            insertButton.onclick = function() {
                insertUser();
            };
            form.appendChild(insertButton);

            // Clear previous form content and append the new form
            var tableContainer = document.getElementById('tableContainer');
            tableContainer.innerHTML = '';
            tableContainer.appendChild(form);
        }

        function insertUser() {
            var form = document.getElementById('userForm');
            var formData = new FormData(form);

            // Call PHP script to perform database insertion
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Handle the response from the PHP script
                    alert(this.responseText);
                    // Clear the form after successful insertion
                    form.reset();
                }
            };
            xmlhttp.open("POST", "insert.php", true);
            xmlhttp.send(formData);
        }

        function consultaUsuario() {
            var username = prompt('Enter username to search:');
            if (username !== null && username !== '') {
                // Call PHP script to perform database query
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // Handle the response from the PHP script
                        displayTable(this.responseText);
                    }
                };
                xmlhttp.open("GET", "query.php?username=" + username, true);
                xmlhttp.send();
            }
        }

        function alteraSenha() {
            var username = prompt('Enter username to update password:');
            var newPassword = prompt('Enter new password:');
            if (username !== null && username !== '' && newPassword !== null && newPassword !== '') {
                // Call PHP script to perform database update
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // Handle the response from the PHP script
                        alert(this.responseText);
                    }
                };
                xmlhttp.open("GET", "update.php?username=" + username + "&newpassword=" + newPassword, true);
                xmlhttp.send();
            }
        }

        function modeloBD() {
            // Create an image element
            var imgElement = document.createElement('img');
            
            // Set the source (replace 'path/to/your/image.jpg' with the actual path to your image)
            imgElement.src = 'Imagens/db_diagram.png';
            
            // Set optional attributes
            imgElement.alt = 'Modelo BD Image';
            imgElement.width = 200; // Adjust the width as needed
            
            // Append the image to the body
            document.body.appendChild(imgElement);
        }

        function displayTable(tableData) {
            // Parse JSON data from PHP response
            var data = JSON.parse(tableData);

            // Create a table element
            var table = document.createElement('table');
            table.border = '1';

            // Create table header
            var headerRow = table.insertRow(0);
            for (var key in data[0]) {
                var headerCell = headerRow.insertCell(-1);
                headerCell.textContent = key;
            }

            // Create table rows and cells
            for (var i = 0; i < data.length; i++) {
                var row = table.insertRow(-1);
                for (var key in data[i]) {
                    var cell = row.insertCell(-1);
                    cell.textContent = data[i][key];
                }

                // Create a delete button for each row
                var deleteButton = document.createElement('button');
                deleteButton.textContent = 'Delete';
                deleteButton.onclick = function() {
                    var rowIndex = this.parentNode.parentNode.rowIndex;
                    var usernameToDelete = table.rows[rowIndex].cells[0].textContent; // Assuming the first cell contains the username
                    deleteUser(usernameToDelete);
                };
                row.insertCell(-1).appendChild(deleteButton);
            }

            // Clear previous table content and append the new table
            var tableContainer = document.getElementById('tableContainer');
            tableContainer.innerHTML = '';
            tableContainer.appendChild(table);
        }

        function deleteUser(username) {
            // Call PHP script to delete user from the database
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Handle the response from the PHP script
                    alert(this.responseText);
                    // Refresh the table after deletion
                    consultaUsuario();
                }
            };
            xmlhttp.open("GET", "delete.php?username=" + username, true);
            xmlhttp.send();
        }

        function downloadUsers() {
            // Call PHP script to get users data
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Handle the response from the PHP script
                    var usersData = JSON.parse(this.responseText);
                    generatePDF(usersData);
                }
            };
            xmlhttp.open("GET", "query.php?username=all", true);
            xmlhttp.send();
        }

        function generatePDF(usersData) {
            // Create a new jsPDF instance
            //window.jsPDF = window.jspdf.jsPDF;
            var pdf = new jsPDF();

            // Set the document title
            pdf.text("User Data", 10, 10);

            // Define initial y-coordinate for text
            var y = 20;

            // Iterate over the user data and add it to the PDF
            for (var i = 0; i < usersData.length; i++) {
                var user = usersData[i];
                for (var key in user) {
                    // Add user data to the PDF with increased y-coordinate for spacing
                    pdf.text(key + ": " + user[key], 10, y);
                    y += 7; // Adjust the value based on the desired spacing
                }
                // Add a line break between users
                y += 7; // Adjust the value based on the desired spacing
            }
            // Save the PDF file with a unique name (e.g., users.pdf)
            pdf.save('users.pdf');
        }
    </script>

</body>
</html>