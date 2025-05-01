<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Huracanes</title>
    <link rel="stylesheet" href="mas.css"> <!-- Enlace al archivo CSS -->
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="users.php">Mi perfil</a></li>
            <li><a href="training.html">Entrenamientos</a></li>
            <li><a href="matches.html">Partidos</a></li>
        </ul>
        <ul>
            <li><a href="../Registro/logout.php">Cerrar sesión</a></li> <!-- Enlace para cerrar sesión -->
        </ul>
    </nav>
    
    <main>
        <header>
            <h1>Bienvenida, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h1> <!-- Muestra el nombre del usuario -->
        </header>
        <div class="container">
            <h2>Mi Perfil</h2>
            <div id="userInfo">
                <p><strong>Nombre:</strong> <span id="username"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span></p>
                <p><strong>Email:</strong> <span id="useremail"><?php echo htmlspecialchars($_SESSION['user_email']); ?></span></p>
                <p><strong>Posición:</strong> <span id="userposition"><?php echo isset($_SESSION['user_position']) ? htmlspecialchars($_SESSION['user_position']) : 'Base'; ?></span></p>
                <p><strong>Altura:</strong> <span id="userheight"><?php echo isset($_SESSION['user_height']) ? htmlspecialchars($_SESSION['user_height']) : '1,80'; ?></span> m</p>
            </div>
            <button id="editButton">Editar Perfil</button> <!-- Botón para editar el perfil -->
            <form id="editForm" style="display: none;"> <!-- Formulario para editar el perfil -->
                <label for="fullName">Nombre completo:</label>
                <input type="text" id="fullName" name="fullName" value="<?php echo htmlspecialchars($_SESSION['user_name']); ?>" required>

                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['user_email']); ?>" required>

                <label for="position">Posición:</label>
                <select id="position" name="position" required>
                    <option value="Base" <?php echo (isset($_SESSION['user_position']) && $_SESSION['user_position'] == 'Base') ? 'selected' : ''; ?>>Base</option>
                    <option value="Escolta" <?php echo (isset($_SESSION['user_position']) && $_SESSION['user_position'] == 'Escolta') ? 'selected' : ''; ?>>Escolta</option>
                    <option value="Alero" <?php echo (isset($_SESSION['user_position']) && $_SESSION['user_position'] == 'Alero') ? 'selected' : ''; ?>>Alero</option>
                    <option value="Ala-Pívot" <?php echo (isset($_SESSION['user_position']) && $_SESSION['user_position'] == 'Ala-Pívot') ? 'selected' : ''; ?>>Ala-Pívot</option>
                    <option value="Pívot" <?php echo (isset($_SESSION['user_position']) && $_SESSION['user_position'] == 'Pívot') ? 'selected' : ''; ?>>Pívot</option>
                </select>

                <label for="height">Altura (m):</label>
                <input type="text" id="height" name="height" value="<?php echo isset($_SESSION['user_height']) ? htmlspecialchars($_SESSION['user_height']) : ''; ?>" required>

                <button type="button" id="saveButton">Guardar Cambios</button> <!-- Botón para guardar cambios -->
                <button type="button" id="cancelButton">Cancelar</button> <!-- Botón para cancelar la edición -->
            </form>
        </div>
    </main>

    <script>
        // Maneja el evento de clic para mostrar el formulario de edición
        document.getElementById('editButton').addEventListener('click', function() {
            document.getElementById('editForm').style.display = 'block'; // Muestra el formulario de edición
            document.getElementById('userInfo').style.display = 'none'; // Oculta la información del usuario
            this.style.display = 'none'; // Oculta el botón de editar
        });

        // Maneja el evento de clic para cancelar la edición
        document.getElementById('cancelButton').addEventListener('click', function() {
            document.getElementById('editForm').style.display = 'none'; // Oculta el formulario de edición
            document.getElementById('userInfo').style.display = 'block'; // Muestra la información del usuario
            document.getElementById('editButton').style.display = 'inline-block'; // Muestra el botón de editar
        });

        // Maneja el evento de clic para guardar los cambios
        document.getElementById('saveButton').addEventListener('click', function() {
            // Actualiza la información visible con los nuevos datos
            document.getElementById('username').textContent = document.getElementById('fullName').value;
            document.getElementById('useremail').textContent = document.getElementById('email').value;
            document.getElementById('userposition').textContent = document.getElementById('position').value;
            document.getElementById('userheight').textContent = document.getElementById('height').value;

            document.getElementById('editForm').style.display = 'none'; // Oculta el formulario de edición
            document.getElementById('userInfo').style.display = 'block'; // Muestra la información del usuario
            document.getElementById('editButton').style.display = 'inline-block'; // Muestra el botón de editar
        });
    </script>
</body>
</html>