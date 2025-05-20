$(document).ready(function() {
    $(".delete-btn").click(function() {
        const boton = $(this);
        const id = boton.data("id");

        if (confirm("¿Estás seguro de que deseas eliminar este empleado?")) {
            $.ajax({
                url: "empleados_eliminar.php",
                method: "POST",
                data: { id: id },
                success: function(respuesta) {
                    if (respuesta == "ok") {
                        boton.closest("tr").remove();
                        alert("Empleado eliminado correctamente.");
                    } else {
                        alert("Error al eliminar empleado.");
                    }
                },
                error: function() {
                    alert("Error de conexión con el servidor.");
                }
            });
        }
    });
});