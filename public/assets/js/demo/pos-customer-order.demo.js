/*
Template Name: STUDIO - Responsive Bootstrap 5 Admin Template
Version: 4.0.0
Author: Sean Ngu
Website: http://www.seantheme.com/studio/
*/

var currentURL = window.location.href

var handleFilter = function () {
    "use strict";

    // Get all elements with the class 'pos-menu' and listen for clicks within them
    var posMenuItems = document.querySelectorAll(".pos-menu [data-filter]");

    // Define the click event handler function
    function handleClick(e) {
        e.preventDefault();

        var targetType = this.getAttribute("data-filter");

        // Add 'active' class to the clicked element
        this.classList.add("active");

        // Remove 'active' class from other elements
        posMenuItems.forEach(function (item) {
            if (item !== this) {
                item.classList.remove("active");
            }
        }, this);

        // Show/hide elements based on the 'data-filter' attribute
        var posContentItems = document.querySelectorAll(
            ".pos-content [data-type]"
        );
        posContentItems.forEach(function (item) {
            if (
                targetType === "all" ||
                item.getAttribute("data-type") === targetType
            ) {
                item.classList.remove("d-none");
            } else {
                item.classList.add("d-none");
            }
        });
    }

    // Attach the click event handler to each element
    posMenuItems.forEach(function (item) {
        item.addEventListener("click", handleClick);
    });
};

document.addEventListener("DOMContentLoaded", function () {
    handleFilter();

    var checkAddon = document.querySelectorAll(".addon-checkbox");
    checkAddon.forEach(function (item) {
        item.addEventListener("click", function (e) {
            var checkboxName = this.getAttribute("name");

            var confirmation = document.getElementById("check_" + checkboxName);

            if (confirmation.value == "on") {
                console.log("CONFIRMATION NOW OFF");
                confirmation.value = "off";
            } else {
                console.log("CONFIRMATION NOW ON");
                confirmation.value = "on";
            }
        });
    });

    var cancelButtons = document.querySelectorAll(".btn-cancel");
    cancelButtons.forEach(function (button) {
        button.addEventListener("click", function (e) {
            e.preventDefault();

            var fieldName = this.getAttribute("data-field");
            var input = document.querySelector(
                "input[name='" + fieldName + "']"
            );
            var initialVal = parseInt(input.getAttribute("data-initialValue"));

            console.log(
                "initialVal: " + input.getAttribute("data-initialValue")
            );

            if (!isNaN(initialVal)) {
                input.value = initialVal;
                input.setAttribute("value", initialVal);
                input.setAttribute("data-change", "initial");
                input.dispatchEvent(new Event("change"));
            } else {
                input.value = 0;
                input.setAttribute("value", 0);
                input.setAttribute("data-change", "initial");
                input.dispatchEvent(new Event("change"));
            }
        });
    });

    var addonCheckbox = document.querySelectorAll(".addon-checkbox");
    addonCheckbox.forEach(function (input) {
        input.addEventListener("click", function (e) {
            console.log(
                this.getAttribute("name") +
                    " is clicked with value " +
                    this.checked
            );

            if (this.checked) {
                var name = this.getAttribute("data-menu");
                console.log(name);
                var oneprice = parseInt(
                    document
                        .querySelector(
                            ".add-order-detail[name='qtyToCart" + name + "']"
                        )
                        .getAttribute("data-price")
                );
                console.log(oneprice);
                var currentPrice =
                    oneprice + parseInt(this.getAttribute("data-price"));
                console.log(currentPrice);
                document
                    .querySelector(
                        ".add-order-detail[name='qtyToCart" + name + "']"
                    )
                    .setAttribute("data-price", currentPrice);
                document.querySelector(
                    ".add-order-detail[name='qtyToCart" + name + "']"
                ).innerHTML = "Rp. " + currentPrice.toLocaleString("en-US");
                document
                    .querySelector("input[data-target='qtyToCart" + name + "']")
                    .dispatchEvent(new Event("change"));
            } else {
                var name = this.getAttribute("data-menu");
                console.log(name);
                var oneprice = parseInt(
                    document
                        .querySelector(
                            ".add-order-detail[name='qtyToCart" + name + "']"
                        )
                        .getAttribute("data-price")
                );
                console.log(oneprice);
                var currentPrice =
                    oneprice - parseInt(this.getAttribute("data-price"));
                console.log(currentPrice);
                document
                    .querySelector(
                        ".add-order-detail[name='qtyToCart" + name + "']"
                    )
                    .setAttribute("data-price", currentPrice);
                document.querySelector(
                    ".add-order-detail[name='qtyToCart" + name + "']"
                ).innerHTML = "Rp. " + currentPrice.toLocaleString("en-US");
                document
                    .querySelector("input[data-target='qtyToCart" + name + "']")
                    .dispatchEvent(new Event("change"));
            }
        });
    });

    // Select all elements with the class 'btn-number'
    var numberButtons = document.querySelectorAll(".btn-number");

    // Loop through each button and add a click event listener
    numberButtons.forEach(function (button) {
        button.addEventListener("click", function (e) {
            console.log("masuk sih");
            e.preventDefault();

            
            var fieldName = this.getAttribute("data-field");
            var type = this.getAttribute("data-type");
            var input = document.querySelector(
                "input[name='" + fieldName + "']"
                );
            if (fieldName.includes("qtyToCart")) {
                input = document.querySelector(
                    "input[data-target='" + fieldName + "']"
                );
            }
            var currentVal = parseInt(input.value);

            if (!isNaN(currentVal)) {
                console.log("TIDAK NAN GAIS INPUTNYA");
                if (type === "minus") {
                    console.log("MINUS");
                    if (currentVal > parseInt(input.getAttribute("min"))) {
                        input.value = currentVal - 1;
                        input.setAttribute("data-value-lama", currentVal - 1);
                        input.setAttribute("data-change", "minus");
                        input.dispatchEvent(new Event("change"));
                    }
                    if (
                        parseInt(input.value) ===
                        parseInt(input.getAttribute("min"))
                    ) {
                        this.disabled = true;
                    }
                } else if (type === "plus") {
                    console.log("PLUS");
                    if (currentVal < parseInt(input.getAttribute("max"))) {
                        input.value = currentVal + 1;
                        input.setAttribute("data-change", "plus");
                        input.setAttribute("data-value-lama", currentVal + 1);
                        input.dispatchEvent(new Event("change"));
                    }
                    if (
                        parseInt(input.value) ===
                        parseInt(input.getAttribute("max"))
                    ) {
                        this.disabled = true;
                    }
                }
            } else {
                input.value = 0;
            }
        });
    });

    // Select all elements with the class 'input-number'
    var inputNumbers = document.querySelectorAll(".input-number");

    // Loop through each input and add event listeners
    inputNumbers.forEach(function (input) {
        input.addEventListener("focusin", function () {
            this.dataset.oldValue = this.value;
        });

        input.addEventListener("change", function () {
            var minValue = parseInt(this.getAttribute("min"));
            var maxValue = parseInt(this.getAttribute("max"));
            var valueCurrent = parseInt(this.value);
            var name = this.getAttribute("name");
            
            if (this.getAttribute("name").includes("qtyToCart")) {
                name = this.getAttribute("data-target");
            }

            var change = this.getAttribute("data-change");

            if (valueCurrent >= minValue) {
                document
                    .querySelector(
                        ".btn-number[data-type='minus'][data-field='" +
                            name +
                            "']"
                    )
                    .removeAttribute("disabled");
            } else {
                alert("Sorry, the minimum value of 1 was reached");
                this.value = 1;
            }

            if (valueCurrent <= maxValue) {
                document
                    .querySelector(
                        ".btn-number[data-type='plus'][data-field='" +
                            name +
                            "']"
                    )
                    .removeAttribute("disabled");
            } else {
                alert(
                    "Sorry, the maximum value of " + maxValue + " was reached"
                );
                this.value = maxValue;
            }

            if (name.includes("qtyOrderHistory")) {
                var onesPrice = parseInt(
                    document
                        .querySelector(".flex-1[name='" + name + "price']")
                        .getAttribute("data-onesPrice")
                );
                var currentPrice =
                    this.value *
                    onesPrice;
                    console.log(currentPrice);
                document.querySelector(
                    ".flex-1[name='" + name + "price']"
                ).innerHTML = "Rp. " + currentPrice.toLocaleString("en-US");

                var currentCartTotalText = document.getElementById('cartTotal').innerHTML;
                currentCartTotalText = currentCartTotalText.replace("Rp. ", "");
                currentCartTotalText = currentCartTotalText.replaceAll(",", "");
                
                var currentCartTotal = parseInt(currentCartTotalText);

                var taxRate = parseInt(document.getElementById('tax-rate').getAttribute("data-tax"));
                var serviceRate = parseInt(document.getElementById('service-rate').getAttribute("data-service"));

                if (change == "minus") {
                    currentCartTotal -= onesPrice;
                } else if (change == "plus") {
                    currentCartTotal += onesPrice;
                } else if (change == "initial") {
                    var selisih = this.getAttribute("data-initialvalue") - this.getAttribute("data-value-lama");
                    console.log(this.getAttribute("data-value-lama"))
                    console.log(selisih)
                    currentCartTotal += (onesPrice * selisih);
                }

                var theService = Math.round((currentCartTotal * serviceRate) / 100)
                var theTax = Math.round((currentCartTotal + theService) * taxRate / 100)
                var grandTotal = Math.round(currentCartTotal + theService + theTax)

                document.getElementById('cartTotal').innerHTML = "Rp. " + currentCartTotal.toLocaleString("en-US");
                document.getElementById('cartService').innerHTML = "Rp. " + theService.toLocaleString("en-US");
                document.getElementById('cartTax').innerHTML = "Rp. " + theTax.toLocaleString("en-US");
                document.getElementById('cartGrandTotal').innerHTML = "Rp. " + grandTotal.toLocaleString("en-US");
            }

            if (name.includes("qtyToCart")) {
                var onesPrice = parseInt(
                    document
                        .querySelector(
                            ".add-order-detail[name='" + name + "']"
                        )
                        .getAttribute("data-price")
                );
                var currentPrice = this.value * onesPrice;
                document.querySelector(
                    ".add-order-detail[name='" + name + "price']"
                ).innerHTML = "Rp. " + currentPrice.toLocaleString("en-US");
            }
        });
    });

    // Select all elements with the class 'input-number'
    var deleteOrder = document.querySelectorAll(".btn-trash");
    deleteOrder.forEach(function (button) {
        button.addEventListener("click", function (e) {
            console.log("BUTTON DIPENCET");

            elementId = button.id

            parentId = elementId.replace('cancel', 'parent');
            confirmId= elementId.replace('cancel', 'qtyOrderHistory');
            
            //     var Child1 = document.createElement(`<div class="pos-order-confirmation text-center d-flex flex-column justify-content-center">
            //     <div class="mb-1">
            //         <i class="fa fa-trash fs-36px lh-1 text-body text-opacity-25"></i>
            //     </div>
            //     <div class="mb-2">Remove this item?</div>
            //     <div>
            //         <a href="#" class="btn btn-default btn-sm ms-auto me-2 width-100px">No</a>
            //         <a href="#" class="btn btn-danger btn-sm width-100px">Yes</a>
            //     </div>
            // </div>`);
            
            document.getElementById(parentId).insertAdjacentHTML('beforeend', `<div class="pos-order-confirmation text-center d-flex flex-column justify-content-center" id="` + elementId + `">
            <div class="mb-1">
                <i class="fa fa-trash fs-36px lh-1 text-body text-opacity-25"></i>
            </div>
            <div class="mb-2">Remove this item?</div>
            <div>
                <a href="#" type="button" data-parent="` + elementId + `" class="btn btn-default btn-trash-cancel btn-sm ms-auto me-2 width-100px" onclick="deleteOrderCancel()">No</a>
                <a href="#" id="id` + confirmId + `" data-qty="` + confirmId + `" class="btn btn-danger btn-sm width-100px" onclick="deleteOrderConfirm('id` + confirmId + `')">Yes</a>
            </div>
        </div>`);
        });
    });

    document.addEventListener("click", function (e) {
        e = e || window.event;
        var target = e.target || e.srcElement,
            text = target.textContent || target.innerText;

        if (target.classList.contains("btn-trash-cancel")) {
            parentNode1 = target.parentNode;
            parentNode2 = parentNode1.parentNode;
            parentNode3 = parentNode2.parentNode;

            parentNode3.removeChild(parentNode3.lastElementChild);
        }
    });

    var addToCart = document.querySelectorAll(".formAddToCart");
    addToCart.forEach(function (button) {
        button.addEventListener("submit", function (e) {
            e.preventDefault();
            newObject = getData(e.target);
            console.log(newObject);
            // console.log('INI QTY: ' + newObject['qtyToCartMNURUMIPE23017UJ2F']);
            addonName =Object.keys(newObject).filter(key => newObject[key] === "true")
            console.log(addonName);
            
            for (let index = 0; index < addonName.length; index++) {
                if (addonName[index] in newObject === true) {
                    console.log("DELETING KEY : ", addonName[index])
                    deletedName = addonName[index];
                    delete newObject[deletedName];
                }
            }
            console.log(newObject);

            var addonName2 = []
            var addonName3 = []
            for (let index = 0; index < addonName.length; index++) {
                split = addonName[index].split("_")
                addonName2.push(split[1])
            }
            for (let index = 0; index < addonName.length; index++) {
                split = addonName2[index].split("|")
                addonName3.push(split[1])
            }
            console.log(addonName3);

            newObject['addon'] = addonName3
            console.log(newObject)

            var xhr = new XMLHttpRequest();
            
            var data = "menu_id=" + newObject["menu_id"] + "&qtyToCart=" + newObject["qtyToCart"] + "&addon=" + newObject["addon"];

            xhr.open("POST", "/doorder", true);

            var csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            var csrfToken = csrfTokenMeta.getAttribute('content');

            xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        location.replace(currentURL)
                    } else {
                        alert("FAILED TO SEND MENU ORDER " + newObject["menu_id"] + ": " + xhr.status)
                        location.replace(currentURL)
                    }
                }
            };

            xhr.send(data);
        });
    });
});

function searchMenu() {
    // Declare variables
    var input, filter, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    cardContainer = document.getElementById("myItems");
    cards = cardContainer.getElementsByClassName("pos-product");

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < cards.length; i++) {
        title = cards[i].querySelector(".info div.title");
        txtValue = title.textContent || title.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            cards[i].parentElement.style.display = "block";
        } else {
            cards[i].parentElement.style.display = "none";
        }
    }
}

function getData(form) {
    var formData = new FormData(form);

    for (var pair of formData.entries()) {
        console.log(pair[0] + ": " + pair[1]);
    }

    return Object.fromEntries(formData);
}

function confirmation(e) {
    formid = e.getAttribute('data-form-id')
    
    if (confirm('Do you want to submit?')) {
        document.getElementById(formid).submit();
    } else {
        return false;
    }
 }