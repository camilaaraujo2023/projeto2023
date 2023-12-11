<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/styleCadastro.css">
    <title>Usuário Comum</title>
</head>
<body>

    <figure class="telecall">
      <img src="Imagens/Telecall.png" alt="Telecall">
    </figure>

    <h1 class="h1">Usuário Comum</h1>

    <div id="buttonContainer">
        <button onclick="adicionaUsuario()" class="btn1">Adiciona Usuário</button>
        <button onclick="alteraSenha()" class="btn1">Altera Senha</button>
        <button onclick="modeloBD()" class="btn1">Modelo BD</button>
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

    </script>

</body>
</html>