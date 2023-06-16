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
            text: "¡Está a punto de eliminar un registro de forma permanente!",
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
            confirmButtonText: 'Sí, eliminarlo'
        }).then((result) => {
            if (result.isConfirmed) {
                const userId = icon.getAttribute("data-id");
                deleteUserId(userId); // Llamar a la función para eliminar el usuario
            }
        });
    });
});

function deleteUserId(userId) {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            Swal.fire(
                '¡Eliminado!',
                'El registro ha sido eliminado.',
                'success'
            ).then(() => {
                location.reload(); // Recargar la página para mostrar los cambios actualizados
            });
        }
    };
    xhr.open('POST', '../../../App/View/Admin/profileAdmin.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('deleteUserId=' + userId);
}

function loadCascadingSelects() {
    var selectedCountry = (selectedRegion = selectedCity = "");
    var BATTUTA_KEY = "00000000000000000000000000000000";

    // Populate country select box from battuta API
    var populateCountrySelectBox = function () {
        var url =
            "https://battuta.medunes.net/api/country/all/?key=" +
            BATTUTA_KEY +
            "&callback=?";

        $.getJSON(url, function (data) {
            $.each(data, function (index, value) {
                $("#country").append(
                    '<option value="' + value.code + '">' + value.name + "</option>"
                );
            });
        });
    };

    // Country selected --> update region list
    var updateRegionSelectBox = function () {
        selectedCountry = $("#country option:selected").text();
        countryCode = $("#country").val();
        var url =
            "https://battuta.medunes.net/api/region/" +
            countryCode +
            "/all/?key=" +
            BATTUTA_KEY +
            "&callback=?";

        $.getJSON(url, function (data) {
            $("#region option").remove();
            $("#region").append(
                '<option value="">Please select your region</option>'
            );
            $.each(data, function (index, value) {
                $("#region").append(
                    '<option value="' + value.region + '">' + value.region + "</option>"
                );
            });

            // Call updateCitySelectBox() to load cities when a region is selected
            updateCitySelectBox();
        });
    };

    // Region selected --> update city list
    var updateCitySelectBox = function () {
        selectedRegion = $("#region option:selected").text();
        countryCode = $("#country").val();
        region = $("#region").val();
        var url =
            "https://battuta.medunes.net/api/city/" +
            countryCode +
            "/search/?region=" +
            region +
            "&key=" +
            BATTUTA_KEY +
            "&callback=?";

        $.getJSON(url, function (data) {
            $("#city option").remove();
            $("#city").append('<option value="">Please select your city</option>');
            $.each(data, function (index, value) {
                $("#city").append(
                    '<option value="' + value.city + '">' + value.city + "</option>"
                );
            });
        });
    };

    // City selected --> update location string
    var updateLocationString = function () {
        selectedCity = $("#city option:selected").text();
        $("#location").html(
            "Location: Country: " +
            selectedCountry +
            ", Region: " +
            selectedRegion +
            ", City: " +
            selectedCity
        );
    };

    // Call the functions to populate the select boxes and set up the event listeners
    populateCountrySelectBox();

    $("#country").change(function () {
        updateRegionSelectBox();
    });

    $("#region").change(function () {
        updateCitySelectBox();
    });

    $("#city").change(function () {
        updateLocationString();
    });
}
//UPDATE
const btnUpdate = document.querySelectorAll(".fa-pen-to-square");
btnUpdate.forEach((icon) => {
    icon.addEventListener("click", () => {
        const row = icon.closest('tr');
        const name = row.querySelector('td:nth-child(3)').textContent;
        const lastName = row.querySelector('td:nth-child(4)').textContent;
        const dateOfBirth = row.querySelector('td:nth-child(5)').textContent;
        const phoneNumber = row.querySelector('td:nth-child(6)').textContent;
        const studentType = row.querySelector('td:nth-child(7)').textContent;
        const country = row.querySelector('td:nth-child(8)').textContent;
        const city = row.querySelector('td:nth-child(9)').textContent;
        Swal.fire({
            title: 'Actualizar registro',
            html:
                '<div id="location>"' +
                '<div class="swal2-form-group">' +
                '  <label for="swal-input-name">Nombre actual: ' + name + '</label>' +
                '  <input id="name" class="swal2-input" value="">' +
                '</div>' +
                '<div class="swal2-form-group">' +
                '  <label for="swal-input-lastname">Apellido actual: ' + lastName + '</label>' +
                '  <input id="lastname" class="swal2-input" value="">' +
                '</div>' +
                '<div class="swal2-form-group">' +
                '  <label for="swal-input-dateofbirth">Fecha de nacimiento actual: ' + dateOfBirth + '</label>' +
                '  <input id="dateofbirth" class="swal2-input" value="">' +
                '</div>' +
                '<div class="swal2-form-group">' +
                '  <label for="swal-input-phoneNumber">Número actual: ' + phoneNumber + '</label>' +
                '  <input id="phoneNumber" class="swal2-input" value="">' +
                '</div>' +
                '<div class="swal2-form-group">' +
                '  <label for="swal-input-studentType">Tipo de estudiante actual: ' + studentType + '</label>' +
                '  <select id="studentType" class="swal2-select">' +
                '    <option value="">-- ¿Qué tipo de estudiante eres? --</option>' +
                '    <option value="1">Estudiante universitario/a</option>' +
                '    <option value="2">Estudiante de secundaria</option>' +
                '    <option value="3">Estudiante técnico o tecnólogo</option>' +
                '  </select>' +
                '</div>' +
                '<div class="swal2-form-group">' +
                '  <label for="swal-input-country">País actual: ' + country + '</label>' +
                '  <select id="country" class="swal2-select">' +
                '    <option value="">-- País --</option>' +
                '  </select>' +
                '</div>' +
                '<div class="swal2-form-group">' +
                '  <select id="region" class="swal2-select">' +
                '    <option value="">-- Región --</option>' +
                '  </select>' +
                '</div>' +
                '<div class="swal2-form-group">' +
                '  <label for="swal-input-city">Ciudad actual: ' + city + '</label>' +
                '  <select id="city" class="swal2-select">' +
                '    <option value="">-- Ciudad --</option>' +
                '  </select>' +
                '</div>' +
                '</div>',
            showCancelButton: true,
            confirmButtonText: 'Actualizar',
            preConfirm: () => {
                const name = document.getElementById('name').value;
                const lastName = document.getElementById('lastname').value;
                const dateOfBirth = document.getElementById('dateofbirth').value;
                const phoneNumber = document.getElementById('phoneNumber').value;
                const studentType = document.getElementById('studentType').value;
                const country = document.getElementById('country').value;
                const city = document.getElementById('city').value;

                return { name, lastName, dateOfBirth, phoneNumber, studentType, country, city };
            },
        }).then((result) => {
            if (result.isConfirmed) {
                const { name, lastName, dateOfBirth, phoneNumber, studentType, country, city } = result.value;
                // ID del usurio selecionado
                const userId = icon.getAttribute("data-id");
                // Llamar a la función para actualizar el usuario
                updateUserId(userId, name, lastName, dateOfBirth, phoneNumber, studentType, country, city);
            }
        });
        loadCascadingSelects();
    });
});

function updateUserId(userId, name, lastName, dateOfBirth, phoneNumber, studentType, country, city) {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                Swal.fire(
                    '¡Actualizado!',
                    'El registro ha sido actualizado.',
                    'success'
                ).then(() => {
                    location.reload(); // Recargar la página para mostrar los cambios actualizados
                });
            } else {
                Swal.fire(
                    'Error',
                    'Ocurrió un error al actualizar el registro.',
                    'error'
                );
            }
        }
    };

    xhr.open('POST', '../../../App/View/Admin/profileAdmin.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    const params = new URLSearchParams();
    params.append('updateUserId', true); 
    params.append('userId', userId);
    if (name) params.append('name', name);
    if (lastName) params.append('lastName', lastName);
    if (dateOfBirth) params.append('dateOfBirth', dateOfBirth);
    if (phoneNumber) params.append('phoneNumber', phoneNumber);
    if (studentType) params.append('studentType', studentType);
    if (country) params.append('country', country);
    if (city) params.append('city', city);
    xhr.send(params);
}

