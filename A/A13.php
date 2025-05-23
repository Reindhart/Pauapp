<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Filas Dinámicas</title>
    </head>
    <body>
        <h1>Selecciona un número</h1>
        <form action="tabla.php" method="POST" onsubmit="return validarFormulario();">
            <label for="numero">Número de filas:</label>
            <select name="numero" id="numero">
                <option value="">Selecciona</option>
                <?php
                    for ($i = 0; $i <= 5000; $i++) {
                    echo "<option value=\"$i\">$i</option>";
                    }
                ?>
            </select>
            <br><br>
            <input type="submit" value="Enviar">
        </form>
        <script>
            function validarFormulario() {
                const select = document.getElementById("numero");
                if (select.value === "0" || select.value === "") {
                    alert("Debes seleccionar un número mayor a 0.");
                    return false;
                }
                return true;
            }
        </script>
    </body>
</html>
