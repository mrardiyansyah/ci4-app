var inputCompany = document.querySelector("#phone-company");
var inputLeader = document.querySelector("#phone-leader-company");
var inputFinance = document.querySelector("#phone-finance-company");
var inputEngineering = document.querySelector("#phone-engineering-company");
var inputGeneral = document.querySelector("#phone-general-company");

window.intlTelInput(inputCompany, {
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

window.intlTelInput(inputLeader, {
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

window.intlTelInput(inputFinance, {
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

window.intlTelInput(inputEngineering, {
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

window.intlTelInput(inputGeneral, {
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