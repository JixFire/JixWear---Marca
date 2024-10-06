// Inicio del movimiento de carrusel de productos coleccion
let currentIndex = 0; // Índice del producto actual
const totalItems = 7; // Total de productos, incluyendo la copia
const carousel = document.querySelector('.carousel01');

// Función para mover el carrusel
function moveCarousel() {
  currentIndex++;
  
  // Reinicia después de la décima imagen
  if (currentIndex >= totalItems) {
    currentIndex = 0; // Cambia a la segunda imagen para evitar el salto brusco
    setTimeout(() => {
      carousel.style.transition = 'none'; // Elimina la transición para el reinicio
      carousel.style.transform = `translateX(0)`; // Resetea a la posición inicial
    }, 3000); // Espera el tiempo de visualización de la imagen antes de resetear
  } else {
    carousel.style.transition = 'transform 3s ease-in-out'; // Habilita la transición
  }
  
  updateCarousel();
}

// Función para actualizar la posición del carrusel
function updateCarousel() {
  const offset = -currentIndex * (500 + 40); // Calcula el desplazamiento en píxeles
  carousel.style.transform = `translateX(${offset}px)`;
}

// Inicia el carrusel
setInterval(moveCarousel, 4000); // Cambia de imagen cada 3 segundos

// Función para navegar a la página del producto
function goToProduct(productId) {
  window.location.href = `producto${productId}.html`;
}


document.querySelectorAll('.color-options05 span').forEach(span => {
    span.addEventListener('click', function() {
        let productDiv = this.closest('.product05');
        let img = productDiv.querySelector('img');
        
        // Aquí puedes definir una lógica para cambiar la imagen según el color
        // Por ejemplo, podrías cambiar el `src` de la imagen según el color seleccionado
        // Basado en un atributo de cada <span> que indique la imagen a mostrar
        // img.src = 'ruta_nueva_de_imagen.jpg';
    });
});

  // PR



