<script>
    let allProducts = [];

    function loadProducts() {
        fetch('/products')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                allProducts = data; // Asegúrate de que sea un array
                console.log('Productos cargados:', allProducts); // Verifica la estructura de los datos
            })
            .catch(error => {
                console.error('Error al cargar productos:', error);
            });
    }

    document.addEventListener('DOMContentLoaded', () => {
        loadProducts();
        setupSearch('search-navbar', 'results-list');
        setupSearch('search-navbar-mobile', 'results-list-mobile');
    });

    function setupSearch(inputId, resultsListId) {
        const inputElement = document.getElementById(inputId);
        const resultsList = document.getElementById(resultsListId);

        inputElement.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            resultsList.innerHTML = ''; // Limpiar resultados previos

            if (query.length > 0) {
                const filteredProducts = allProducts.filter(product =>
                    product.name.toLowerCase().includes(query)
                );

                // Mostrar el contenedor de resultados si hay productos filtrados
                resultsList.parentElement.classList.remove('hidden');

                console.log('Productos filtrados:', filteredProducts); // Muestra los productos filtrados

                filteredProducts.forEach(product => {
                    const listItem = document.createElement('li');
                    listItem.className = 'p-2 hover:bg-gray-200 cursor-pointer'; // Agrega cursor pointer
                    const link = document.createElement('a');
                    link.href = `/products/${product.id}`; // Enlace a la página del producto usando ID
                    link.innerText = product.name;
                    listItem.appendChild(link);
                    resultsList.appendChild(listItem);
                });

                // Si no hay resultados
                if (filteredProducts.length === 0) {
                    const noResultsItem = document.createElement('li');
                    noResultsItem.className = 'p-2 text-gray-500';
                    noResultsItem.innerText = 'No hay resultados';
                    resultsList.appendChild(noResultsItem);
                }
            } else {
                // Ocultar resultados si no hay query
                resultsList.parentElement.classList.add('hidden');
            }
        });
    }
</script>
