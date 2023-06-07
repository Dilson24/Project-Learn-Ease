document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const registerParam = urlParams.get('register');
    const chk = document.getElementById('chk');
    const originalTitle = document.title;
    const mainElement = document.querySelector('.main');
    const bodyElement = document.body;

    if (registerParam === 'newUser') {
        chk.checked = true;
        document.title = 'Register';
        mainElement.style.maxHeight = '790px';
        mainElement.style.margin = '0.5em 0 0.5em 0';
        bodyElement.style.height = 'auto';

    }

    chk.addEventListener('click', function () {
        if (chk.checked) {
            history.pushState(null, '', '?register=newUser');
            document.title = 'Register';
            mainElement.style.maxHeight = '790px';
            mainElement.style.margin = '0.5em 0 0.5em 0';
            bodyElement.style.height = 'auto';
        } else {
            history.pushState(null, '', window.location.pathname);
            document.title = originalTitle;
            mainElement.style.maxHeight = '350px';
            mainElement.style.margin ='auto 0 auto 0';
            bodyElement.style.height = '100vh';
        }
    });
});

/*Alerts control*/
setTimeout(function() {
    document.getElementById('error-alert').style.display = 'none';
}, 4000);

const closeButton = document.getElementById('close-btn');
if (closeButton) {
    closeButton.addEventListener('click', function() {
        document.getElementById('error-alert').style.display = 'none';
        history.pushState(null, '', window.location.pathname);
    });
}
/*Input controls*/
const dateInput = document.querySelector('#boxdate');

dateInput.addEventListener('click', function () {
    this.classList.remove('date');
});

dateInput.addEventListener('blur', function () {
    if (this.value === '') {
        this.classList.add('date');
    }
});




/*Api county and city*/
$(document).ready(function () {
    //-------------------------------SELECT CASCADING-------------------------//
    var selectedCountry = (selectedRegion = selectedCity = "");
    // This is a demo API key for testing purposes. You should rather request your API key (free) from http://battuta.medunes.net/
    var BATTUTA_KEY = "00000000000000000000000000000000";
    // Populate country select box from battuta API
    url =
        "https://battuta.medunes.net/api/country/all/?key=" +
        BATTUTA_KEY +
        "&callback=?";

    // EXTRACT JSON DATA.
    $.getJSON(url, function (data) {
        console.log(data);
        $.each(data, function (index, value) {
            // APPEND OR INSERT DATA TO SELECT ELEMENT.
            $("#country").append(
                '<option value="' + value.code + '">' + value.name + "</option>"
            );
        });
    });
    // Country selected --> update region list .
    $("#country").change(function () {
        selectedCountry = this.options[this.selectedIndex].text;
        countryCode = $("#country").val();
        // Populate country select box from battuta API
        url =
            "https://battuta.medunes.net/api/region/" +
            countryCode +
            "/all/?key=" +
            BATTUTA_KEY +
            "&callback=?";
        $.getJSON(url, function (data) {
            $("#region option").remove();
            $('#region').append('<option value="">Please select your region</option>');
            $.each(data, function (index, value) {
                // APPEND OR INSERT DATA TO SELECT ELEMENT.
                $("#region").append(
                    '<option value="' + value.region + '">' + value.region + "</option>"
                );
            });
        });
    });
    // Region selected --> updated city list
    $("#region").on("change", function () {
        selectedRegion = this.options[this.selectedIndex].text;
        // Populate country select box from battuta API
        countryCode = $("#country").val();
        region = $("#region").val();
        url =
            "https://battuta.medunes.net/api/city/" +
            countryCode +
            "/search/?region=" +
            region +
            "&key=" +
            BATTUTA_KEY +
            "&callback=?";
        $.getJSON(url, function (data) {
            console.log(data);
            $("#city option").remove();
            $('#city').append('<option value="">Please select your city</option>');
            $.each(data, function (index, value) {
                // APPEND OR INSERT DATA TO SELECT ELEMENT.
                $("#city").append(
                    '<option value="' + value.city + '">' + value.city + "</option>"
                );
            });
        });
    });
    // city selected --> update location string
    $("#city").on("change", function () {
        selectedCity = this.options[this.selectedIndex].text;
        $("#location").html(
            "Locatation: Country: " +
            selectedCountry +
            ", Region: " +
            selectedRegion +
            ", City: " +
            selectedCity
        );
    });
});





