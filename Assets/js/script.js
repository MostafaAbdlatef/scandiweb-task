// Array to hold product types
const options = ["dvd", "furniture", "book"];

// Product types DOM
var dvd = document.getElementById("dvd");
var furniture = document.getElementById("furniture");
var book = document.getElementById("book");
// Specific class to mark the types
var elems = document.getElementsByClassName("show-hide");

// Event that shows only the div of the selected option

document.querySelector("#product-type").addEventListener("change", function () {
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