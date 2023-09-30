/*
Template Name: STUDIO - Responsive Bootstrap 5 Admin Template
Version: 4.0.0
Author: Sean Ngu
Website: http://www.seantheme.com/studio/
*/

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
                input.dispatchEvent(new Event("change"));
            } else {
                input.value = 0;
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
            
            if (this.getAttribute("data-target").includes("qtyToCart")) {
                name = this.getAttribute("data-target");
            }

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
                var currentPrice =
                    this.value *
                    parseInt(
                        document
                            .querySelector(".flex-1[name='" + name + "price']")
                            .getAttribute("data-onesPrice")
                    );
                document.querySelector(
                    ".flex-1[name='" + name + "price']"
                ).innerHTML = "Rp. " + currentPrice.toLocaleString("en-US");
            }

            if (name.includes("qtyToCart")) {
                var currentPrice =
                    this.value *
                    parseInt(
                        document
                            .querySelector(
                                ".add-order-detail[name='" + name + "']"
                            )
                            .getAttribute("data-price")
                    );
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
            
            var data = "menu_id=" + newObject["menu_id"] + "&qtyToCart=" + newObject["qtyToCart"] + "&addon=" + newObject["addon"]+ "&order_id=" + newObject["order_id"];

            xhr.open("POST", "/pos/doorder", true);

            var csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            var csrfToken = csrfTokenMeta.getAttribute('content');

            xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        location.reload();
                    } else {
                        alert("FAILED TO SEND MENU ORDER " + newObject["menu_id"] + ": " + xhr.status)
                    }
                }
            };

            xhr.send(data);
        });
    });
});

function deleteOrderCancel(e) {
    parentId = e.getAttribute('data-parent')

    parentElement = document.getElementById(parentId);

    parentElement.parentNode.removeChild(parentElement);
}

function deleteOrderConfirm(e) {
    qtyId = document.getElementById(e).getAttribute('data-qty')

    parentElement = document.getElementById(qtyId);
    theQty = parentElement.getAttribute('data-initialValue')

    menu_id = qtyId.replace("qtyOrderHistory", "")
    order_id = document.getElementById("order_id").getAttribute('data-order-id');

    var xhr = new XMLHttpRequest();
            
    var data = "menu_id=" + menu_id + "&order_id=" + order_id + "&qty=-" + theQty;

    xhr.open("POST", "/pos/doadjustmentorder", true);

    var csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
    var csrfToken = csrfTokenMeta.getAttribute('content');

    xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                location.reload();
            } else {
                alert("FAILED TO SEND MENU ORDER ADJUSTMENT " + newObject["menu_id"] + ": " + xhr.status)
            }
        }
    };

    xhr.send(data);
}

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
