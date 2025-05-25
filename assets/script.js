$(document).ready(function () {
  $(".owl-carousel").owlCarousel({
    items: 1,
    loop: true,
    autoplay: true,
    margin: 20,
    autoplayTimeout: 1000, // Adjust autoplay speed (in milliseconds)
    dots: true, // Enable navigation dots
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 4,
      },
    },
  });
});
var accItem = document.getElementsByClassName("accordionItem");
var accHD = document.getElementsByClassName("accordionItemHeading");
for (i = 0; i < accHD.length; i++) {
  accHD[i].addEventListener("click", toggleItem, false);
}
function toggleItem() {
  var itemClass = this.parentNode.className;
  for (i = 0; i < accItem.length; i++) {
    accItem[i].className = "accordionItem close";
  }
  if (itemClass == "accordionItem close") {
    this.parentNode.className = "accordionItem open";
  }
}

document.addEventListener('DOMContentLoaded', function () {
  var navLinks = document.querySelectorAll('.nav-list > li a');

  navLinks.forEach(function (link) {
    link.addEventListener('click', function () {
      var checkbox = document.getElementById('nav-check');
      checkbox.checked = false; // Close the dropdown menu
    });
  });
});


	jQuery(document).ready(function($) {
		function getParameterByName(name) {
			name = name.replace(/[\[\]]/g, '\\$&');
			var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
			var results = regex.exec(window.location.href);
			if (!results) return null;
			if (!results[2]) return '';
			return decodeURIComponent(results[2].replace(/\+/g, ' '));
		}

		function addParameter(url, paramName, paramValue) {
			var hash = '';
			var anchorIndex = url.indexOf('#');
			if (anchorIndex !== -1) {
				hash = url.substr(anchorIndex);
				url = url.substr(0, anchorIndex);
			}
			if (url.indexOf('?') === -1) {
				return url + '?' + paramName + '=' + paramValue + hash;
			} else {
				return url + '&' + paramName + '=' + paramValue + hash;
			}
		}

		var utm_parameters = {
			'sub_source': getParameterByName('sub_source'),
			'utm_source': getParameterByName('utm_source'),
			'utm_campaign': getParameterByName('utm_campaign'),
			'utm_medium': getParameterByName('utm_medium'),
			'utm_term': getParameterByName('utm_term'),
			'messageText': getParameterByName('messageText')
		};

		$('a').each(function() {
			var link = $(this).attr('href');
			if (link) {
				for (var key in utm_parameters) {
					if (utm_parameters[key]) {
						link = addParameter(link, key, utm_parameters[key]);
					}
				}
				$(this).attr('href', link);
			}
		});
	});



	document.addEventListener("DOMContentLoaded", function() {
		// Function to get the value of a URL parameter
		function getQueryParam(param) {
			var searchParams = new URLSearchParams(window.location.search);
			return searchParams.has(param) ? searchParams.get(param) : null; // Return null if the parameter is not found
		}

		// Function to set values for all forms
		function setUTMValues() {
			var utmParams = ['source', 'sub_source', 'utm_source', 'utm_campaign', 'utm_medium', 'utm_term'];
			utmParams.forEach(function(param) {
				var inputFields = document.querySelectorAll('input[name="' + param + '"]');
				inputFields.forEach(function(input) {
					var paramValue = getQueryParam(param);
					if (paramValue !== null) { // Only set the value if the parameter exists
						input.value = paramValue;
					}
				});
			});
		}

		setUTMValues();
	});



	document.addEventListener("DOMContentLoaded", function() {
		// Function to get the value of a URL parameter
		function getQueryParam(param) {
			var searchParams = new URLSearchParams(window.location.search);
			return searchParams.get(param) || ''; // Return an empty string if the parameter is not found
		}

		// Get all forms on the page
		var forms = document.querySelectorAll('form');

		// Loop through each form to set the values
		forms.forEach(function(form) {

			// Get the current URL
			const currentURL = window.location.href;

			// Remove UTM parameters and fragments from the URL
			// const urlWithoutParams = currentURL.split(/[?#]/)[0];

			// Set the extracted URL to the input field
			// form.querySelector('#page_url').value = urlWithoutParams;
			form.querySelector('#page_url').value = currentURL;
		});
	});


  