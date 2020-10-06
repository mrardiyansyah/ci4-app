var input = document.querySelector("#phone");
window.intlTelInput(input, {
    // any initialisation options go here
    intialCountry: "auto",
    geoIpLookup: function (callback) {
        $.get('https://ipinfo.io', function () {}, "jsonp").always(function (resp) {
            var countryCode = (resp && resp.country) ? resp.country : "";
            callback(countryCode);
        });
    },
    utilsScript: "http://localhost/ci4-app/public/assets/vendor/intl-tel-input/build/js/utils.js",
    preferredCountries: ["id"]
});