
$(".menu > ul > li").click(function(e){
    // Evita la propagación del evento para prevenir el cierre inmediato
    e.stopPropagation();

    // Elimina la clase 'active' de todos los elementos <li> y oculta sus submenús
    $(".menu > ul > li").removeClass("active").find("ul").slideUp();

    // Agrega la clase 'active' solo al elemento que fue clickeado
    $(this).siblings().removeClass("active");
	$(this).addClass("active");
    
    // Alterna la visibilidad del submenú del elemento clickeado
    $(this).find("ul").slideToggle();
	    $(this).siblings.find("ul").slideUp();
									  
    $(this).siblings.find("ul").find("li").removeClass("active");
})

// Selecciona todos los botones de eliminar
document.querySelectorAll('.deleteBtn').forEach(button => {
    button.addEventListener('click', function (e) {
        e.preventDefault(); // Evita que el formulario se envíe automáticamente
        const deleteModal = document.getElementById('deleteModal');
        
        // Muestra el pop-up de confirmación
        deleteModal.style.display = 'flex'; 
        
        // Asocia el formulario correspondiente al botón de eliminar
        const formId = this.getAttribute('data-form-id');
        const deleteForm = document.getElementById(formId);

        // Cierra el pop-up si se hace clic en "Cancelar"
        document.getElementById('cancelBtn').addEventListener('click', function () {
            deleteModal.style.display = 'none'; // Oculta el pop-up
        });

        // Si se hace clic en "Eliminar", se envía el formulario
        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            deleteForm.submit(); // Envía el formulario correcto
        });
    });
});

$(document).ready(function () {
    // Función para manejar la clase 'active' en el menú
    function setActiveMenuItem() {
        // Obtener la ruta actual
        const currentPath = window.location.pathname;

        // Remover la clase 'active' de todos los elementos del menú
        $(".menu > ul > li").removeClass("active");

        // Verificar si la ruta contiene 'consumption'
        if (currentPath.includes("consumption")) {
            // Activar el menú de 'Consumo'
            $(".menu > ul > li:contains('Consumo')").addClass("active");
        } if (currentPath.includes("user")) {
            // Activar el menú de 'Consumo'
            $(".menu > ul > li:contains('Administración')").addClass("active");
        }if (currentPath.includes("clients")) {
            // Activar el menú de 'Consumo'
            $(".menu > ul > li:contains('Administración')").addClass("active");
        }if (currentPath.includes("tanques")) {
            // Activar el menú de 'Consumo'
            $(".menu > ul > li:contains('Administración')").addClass("active");
        }if (currentPath.includes("sensor")) {
            // Activar el menú de 'Consumo'
            $(".menu > ul > li:contains('Administración')").addClass("active");
        }if (currentPath.includes("level")) {
            // Activar el menú de 'Consumo'
            $(".menu > ul > li:contains('Nivel')").addClass("active");
        }if (currentPath.includes("quality")) {
            // Activar el menú de 'Consumo'
            $(".menu > ul > li:contains('Calidad')").addClass("active");
        }if (currentPath.includes("home")) {
            // Activar el menú de 'Consumo'
            $(".menu > ul > li:contains('Inicio')").addClass("active");
        }
    }

    // Llamar a la función al cargar la página
    setActiveMenuItem();

    // Manejar los clicks en el menú
    $(".menu > ul > li").click(function (e) {
        $(this).siblings().removeClass("active");
        $(this).toggleClass("active");
        $(this).find("ul").slideToggle();
        $(this).siblings().find("ul").slideUp();
        $(this).siblings().find("ul").find("li").removeClass("active");
    });
});
