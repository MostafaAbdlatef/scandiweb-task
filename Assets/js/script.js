// Array to hold product types
const options = ["dvd", "furniture", "book"];

// Product types DOM
var dvd = document.getElementById("dvd");
var furniture = document.getElementById("furniture");
var book = document.getElementById("book");
// Specific class to mark the types
var elems = document.getElementsByClassName("show-hide");

// Event that shows only the div of the selected option

document.querySelector("#productType").addEventListener("change", function () {
  for (i = 0; i < elems.length; i++) {
    if (options[i] == this.value) {
      elems[i].style.display = "block";
    } else {
      elems[i].style.display = "none";

      childNodes = elems[i].getElementsByTagName("input");
      for (j = 0; j < childNodes.length; j++) {
        childNodes[j].removeAttribute("name");
      }
    }
  }
});


// ===========================================

// function to handle the validation errors
function saveData() {
  var formElement = document.getElementsByClassName('form-data')


  var formData = new FormData();


  for (var count = 0; count < formElement.length; count++) {
    formData.append(formElement[count].name, formElement[count].value);
  }

  document.getElementById('submit').disabled = true;

  var ajax_request = new XMLHttpRequest();

  ajax_request.open('POST', 'app/Requests/ProductsRequest.php');

  ajax_request.send(formData);

  ajax_request.onreadystatechange = function () {
    if (ajax_request.readyState == 4 && ajax_request.status == 200) {
      document.getElementById('submit').disabled = false;

      var response = JSON.parse(ajax_request.responseText);


      typeof response.sku_error === 'undefined' ? document.getElementById('sku-error').innerHTML = '' : document.getElementById('sku-error').innerHTML = response.sku_error;
      typeof response.name_error === 'undefined' ? document.getElementById('name-error').innerHTML = '' : document.getElementById('name-error').innerHTML = response.name_error;
      typeof response.price_error === 'undefined' ? document.getElementById('price-error').innerHTML = '' : document.getElementById('price-error').innerHTML = response.price_error;
      typeof response.type_error === 'undefined' ? document.getElementById('type-error').innerHTML = '' : document.getElementById('type-error').innerHTML = response.type_error;
      typeof response.size_error === 'undefined' ? document.getElementById('size-error').innerHTML = '' : document.getElementById('size-error').innerHTML = response.size_error;
      typeof response.length_error === 'undefined' ? document.getElementById('length-error').innerHTML = '' : document.getElementById('length-error').innerHTML = response.length_error;
      typeof response.width_error === 'undefined' ? document.getElementById('width-error').innerHTML = '' : document.getElementById('width-error').innerHTML = response.width_error;
      typeof response.height_error === 'undefined' ? document.getElementById('height-error').innerHTML = '' : document.getElementById('height-error').innerHTML = response.height_error;
      typeof response.weight_error === 'undefined' ? document.getElementById('weight-error').innerHTML = '' : document.getElementById('weight-error').innerHTML = response.weight_error;

      if (Object.keys(response).length == 0) {
        window.location.href = 'index.php';
      }
    }
  }
}