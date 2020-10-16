// var inputCompany = document.querySelector("#phone-company"),
// errorMsg = document.querySelector("#error-msg-company"),
// validMsg = document.querySelector("#valid-msg-company");


// var inputLeader = document.querySelector("#phone-leader-company");
// var inputFinance = document.querySelector("#phone-finance-company");
// var inputEngineering = document.querySelector("#phone-engineering-company");
// var inputGeneral = document.querySelector("#phone-general-company");

let ary = Array.prototype.slice.call(document.querySelectorAll(".phone"));

	ary.forEach(function(el) {
        PhoneDisplay(el);
        // console.log(el.querySelector("#error-msg"));
	})	
	
    function PhoneDisplay(input){		
	 let errorMsg = input.querySelector(".error-msg"),
	     validMsg = input.querySelector(".valid-msg");

	 let errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];	
        
     let intl =input.querySelector(".phone_flag");
      let iti = window.intlTelInput(intl, {
		  utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.6/js/utils.min.js",
		  preferredCountries: ["id"]
      });
	  
		let reset = function() {
		  intl.classList.remove("error-msg");
		  errorMsg.innerHTML = "";
		  errorMsg.classList.add("hide");
		  validMsg.classList.add("hide");
		};

		intl.addEventListener('blur', function() {
		  reset();
		  if (intl.value.trim()) {
			if (iti.isValidNumber()) {
			  validMsg.classList.remove("hide");
			} else {
			  intl.classList.add("error-msg");
			  let errorCode = iti.getValidationError();
			  errorMsg.innerHTML = errorMap[errorCode];
			  errorMsg.classList.remove("hide");
			}
		  }
		});

		intl.addEventListener('change', reset);
		intl.addEventListener('keyup', reset);	  	  	  
    }

// // here, the index maps to the error code returned from getValidationError - see readme
// var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

// window.intlTelInput(inputCompany, {
//     // any initialisation options go here
//     intialCountry: "auto",
//     geoIpLookup: function (callback) {
//         $.get('https://ipinfo.io', function () {}, "jsonp").always(function (resp) {
//             var countryCode = (resp && resp.country) ? resp.country : "";
//             callback(countryCode);
//         });
//     },
//     utilsScript: "http://localhost/ci4-app/public/assets/vendor/intl-tel-input/build/js/utils.js",
//     preferredCountries: ["id"]
// });

// window.intlTelInput(inputLeader, {
//     // any initialisation options go here
//     intialCountry: "auto",
//     geoIpLookup: function (callback) {
//         $.get('https://ipinfo.io', function () {}, "jsonp").always(function (resp) {
//             var countryCode = (resp && resp.country) ? resp.country : "";
//             callback(countryCode);
//         });
//     },
//     utilsScript: "http://localhost/ci4-app/public/assets/vendor/intl-tel-input/build/js/utils.js",
//     preferredCountries: ["id"]
// });

// window.intlTelInput(inputFinance, {
//     // any initialisation options go here
//     intialCountry: "auto",
//     geoIpLookup: function (callback) {
//         $.get('https://ipinfo.io', function () {}, "jsonp").always(function (resp) {
//             var countryCode = (resp && resp.country) ? resp.country : "";
//             callback(countryCode);
//         });
//     },
//     utilsScript: "http://localhost/ci4-app/public/assets/vendor/intl-tel-input/build/js/utils.js",
//     preferredCountries: ["id"]
// });

// window.intlTelInput(inputEngineering, {
//     // any initialisation options go here
//     intialCountry: "auto",
//     geoIpLookup: function (callback) {
//         $.get('https://ipinfo.io', function () {}, "jsonp").always(function (resp) {
//             var countryCode = (resp && resp.country) ? resp.country : "";
//             callback(countryCode);
//         });
//     },
//     utilsScript: "http://localhost/ci4-app/public/assets/vendor/intl-tel-input/build/js/utils.js",
//     preferredCountries: ["id"]
// });

// window.intlTelInput(inputGeneral, {
//     // any initialisation options go here
//     intialCountry: "auto",
//     geoIpLookup: function (callback) {
//         $.get('https://ipinfo.io', function () {}, "jsonp").always(function (resp) {
//             var countryCode = (resp && resp.country) ? resp.country : "";
//             callback(countryCode);
//         });
//     },
//     utilsScript: "http://localhost/ci4-app/public/assets/vendor/intl-tel-input/build/js/utils.js",
//     preferredCountries: ["id"]
// });