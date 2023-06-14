//Search
$(window).on('load', function () {
    // Agrega la clase 'list' a todas las filas del cuerpo de la tabla
    $('#table tbody tr').addClass('list');

    // Itera sobre cada fila con clase 'list'
    $('.list').each(function () {
        var dataID = $(this).index() + 1; // Obtiene el índice de la fila y le suma 1
        $(this).find('td').eq(0).text(dataID); // Establece el índice como texto en la primera celda de la fila
    });

    // Obtiene el número total de filas
    var noOfRows = $('.list').length;

    // Obtiene el valor actual del elemento de selección
    var showNo = $('.showRow select').val();

    // Maneja el evento de cambio en el elemento de selección
    $('.showRow select').on('change', function (e) {
        showNo = $(this).val(); // Actualiza el valor seleccionado
        myRemoveClass(); // Llama a la función para actualizar la visualización de las filas
    });

    // Función para actualizar la visualización de las filas
    function myRemoveClass() {
        var showNoOfRows = showNo; // Número de filas a mostrar
        var showPage = Math.ceil(noOfRows / showNo); // Cantidad de páginas
        var counter;
        var no = 0;
        var start = no;
        var end = showNoOfRows;

        $('.pagination').empty();

        // Crea los elementos de paginación y los agrega al contenedor
        for (counter = 1; counter <= showPage; counter++) {
            $('<li><a href="javascript:void(0)" data-lt="' + counter + '">' + counter + '</a></li>').appendTo('.pagination');
            $('.pagination li').eq(0).addClass('active'); // Establece la primera página como activa
        }

        // Oculta las filas y muestra solo las que deben estar en la página actual
        $('#table tbody tr').removeClass('active-item').hide();
        $('#table tbody tr').slice(start, end).show().addClass('active-item');

        $('.prev').prop('disabled', true).parent('li').addClass('disabled'); // Desactiva el botón 'Anterior'
        $('.next').prop('disabled', false).parent('li').removeClass('disabled'); // Habilita el botón 'Siguiente'

        // Maneja el evento de clic en los elementos de paginación
        function myfunction(controller) {
            return function () {
                if (controller == 'nextPagination') {
                    no++;
                    $('.pagination li').removeClass('active');
                    $('.pagination li').eq(no).addClass('active'); // Establece la página actual como activa
                    start1 = showNoOfRows * no;
                    end1 = showNoOfRows * (no + 1);

                    // Oculta las filas y muestra solo las que deben estar en la página actual
                    $('#table tbody tr').removeClass('active-item').hide();
                    $('#table tbody tr').slice(start1, end1).show().addClass('active-item');

                    $('.prev').prop('disabled', false).parent('li').removeClass('disabled'); // Habilita el botón 'Anterior'

                    if (end1 >= noOfRows) {
                        $('.next').prop('disabled', true).parent('li').addClass('disabled'); // Desactiva el botón 'Siguiente' si se alcanza la última página
                    }
                } else if (controller == 'prevPagination') {
                    no--;
                    $('.pagination li').removeClass('active');
                    $('.pagination li').eq(no).addClass('active'); // Establece la página actual como activa
                    start1 = showNoOfRows * no;
                    end1 = showNoOfRows * (no + 1);

                    // Oculta las filas y muestra solo las que deben estar en la página actual
                    $('#table tbody tr').removeClass('active-item').hide();
                    $('#table tbody tr').slice(start1, end1).show().addClass('active-item');

                    $('.next').prop('disabled', false).parent('li').removeClass('disabled'); // Habilita el botón 'Siguiente'

                    if (no === 0) {
                        $('.prev').prop('disabled', true).parent('li').addClass('disabled'); // Desactiva el botón 'Anterior' si se está en la primera página
                    }
                } else if (controller == 'dots') {
                    $('.pagination li').removeClass('active');
                    var thisIndex = $(this).addClass('active').index();
                    no = thisIndex;
                    start1 = showNoOfRows * no;
                    end1 = showNoOfRows * (no + 1);

                    // Oculta las filas y muestra solo las que deben estar en la página actual
                    $('#table tbody tr').removeClass('active-item').hide();
                    $('#table tbody tr').slice(start1, end1).show().addClass('active-item');

                    if (no > 0) {
                        $('.prev').prop('disabled', false).parent('li').removeClass('disabled'); // Habilita el botón 'Anterior'
                    } else {
                        $('.prev').prop('disabled', true).parent('li').addClass('disabled'); // Desactiva el botón 'Anterior' si se está en la primera página
                    }

                    if (end1 >= noOfRows) {
                        $('.next').prop('disabled', true).parent('li').addClass('disabled'); // Desactiva el botón 'Siguiente' si se alcanza la última página
                    } else {
                        $('.next').prop('disabled', false).parent('li').removeClass('disabled'); // Habilita el botón 'Siguiente'
                    }
                }
            };
        }

        // Asigna los manejadores de eventos a los botones y elementos de paginación
        $('.controller').on('click', '.next', myfunction('nextPagination'));
        $('.controller').on('click', '.prev', myfunction('prevPagination'));
        $('.controller').on('click', '.pagination li', myfunction('dots'));
    }

    myRemoveClass(); // Llama a la función para establecer la visualización inicial

    // Buscador en tiempo real
    $('.searchRow input').on('keyup', function () {
        var value = $(this).val();
        var patt = new RegExp(value, "i");

        // Itera sobre las filas visibles y oculta aquellas que no coincidan con el valor de búsqueda
        $('#table').find('.active-item').each(function () {
            if (!($(this).find('td').text().search(patt) >= 0)) {
                $(this).not('.myHead').hide();
            }
            if ($(this).find('td').text().search(patt) >= 0) {
                $(this).show();
            }
        });
    });
});




//SIDEBAR
let btn = document.querySelector("#btn");
let sidebar = document.querySelector(".sidebar");
let searchBtn = document.querySelector(".bx-search");
let hamburger = document.querySelector(".hamburger");

btn.onclick = function () {
    hamburger.classList.toggle("is-active");
    sidebar.classList.toggle("active");
}
searchBtn.onclick = function () {
    sidebar.classList.toggle("active");
}

document.getElementById('log_out').addEventListener('click', function () {
    // Realizar una solicitud AJAX o redirigir directamente a un archivo PHP que cierre la sesión
    // y luego redirigir a la página principal
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Redirigir a la página principal
                window.location.href = '../../../index.html';
            } else {
                // Manejar cualquier error de solicitud
                console.error('Error al cerrar sesión');
            }
        }
    };
    xhr.open('GET', '../../../App/View/User/loguot.php', true); // Reemplaza 'logout.php' con el nombre real del archivo que cierra la sesión
    xhr.send();
});

//Operations


//DELETE

const btnDelete = document.querySelectorAll(".fa-trash");
btnDelete.forEach((icon) => {
    icon.addEventListener("click", () => {
        Swal.fire({
            title: 'Eliminar registro',
            text: "¡Esta apunto de eliminar un registro de forma permanente!",
            icon: 'warning',
            showCancelButton: true,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            },
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        });
    });
});
