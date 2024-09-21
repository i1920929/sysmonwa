$(".menu > ul > li").click(function(e){
    $(this).siblings().removeClass("active");
    $(this).toggleClass("active");
    $(this).find("ul").slideToggle();
    $(this).siblings.find("ul").slideUp();
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