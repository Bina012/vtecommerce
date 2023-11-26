/*
Template Name: Toner eCommerce + Admin HTML Template
Author: Themesbrand
Version: 1.2.0
Website: https://Themesbrand.com/
Contact: Themesbrand@gmail.com
File: Product-list init File
*/

console.log(productListData);

var inputValueJson = sessionStorage.getItem('inputValue');
if (inputValueJson) {
    inputValueJson = JSON.parse(inputValueJson);
    Array.from(inputValueJson).forEach(element => {
        productListData.push(element);
    });
}

var editinputValueJson = sessionStorage.getItem('editInputValue');
if (editinputValueJson) {
    editinputValueJson = JSON.parse(editinputValueJson);
    productListData = productListData.map(function (item) {
        if (item.id == editinputValueJson.id) {
            return editinputValueJson;
        }
        return item;
    });
}

// product-list
if (document.getElementById("product-list")) {
    var productList = new gridjs.Grid({
        columns: [
            {
                name: '#',
                width: '40px',
                sort: {
                    enabled: false
                },
                data: (function (row) {
                    return gridjs.html('<div class="form-check checkbox-product-list">\
                            <input class="form-check-input" type="checkbox" value="'+ row.id + '" id="checkbox-' + row.id + '">\
                            <label class="form-check-label" for="checkbox-'+ row.id + '"></label>\
                        </div>');
                })
            },
            {
                name: 'Product name',
                data: (function (row) {
                    var num = 1;
                    if (row.color) {
                        var colorElem = '<ul class="clothe-colors list-unstyled hstack gap-1 mb-0 flex-wrap d-none">';
                        Array.from(row.color).forEach(function (elem) {
                            num++;
                            colorElem += '<li>\
                                                <input type="radio" name="color'+ row.id + '" id="product-color-' + row.id + num + '">\
                                                <label class="avatar-xxs border border-2 border-white btn btn-'+ elem + ' p-0 d-flex align-items-center justify-content-center rounded-circle" for="product-color-' + row.id + num + '"></label>\
                                            </li>';
                        })
                        colorElem += '</ul>';
                    } else {
                        var colorElem = '';
                    }

                    if (row.size) {
                        var sizeElem = '<ul class="clothe-size list-unstyled hstack gap-2 mb-0 flex-wrap d-none">';
                        Array.from(row.size).forEach(function (elem) {
                            num++;
                            sizeElem += '<li>\
                                                <input type="radio" name="sizes'+ row.id + '" id="product-size-' + row.id + num + '">\
                                                <label class="avatar-xxs border border-2 border-white btn btn-soft-primary text-uppercase p-0 fs-13 d-flex align-items-center justify-content-center rounded-circle" for="product-size-'+ row.id + num + '">' + elem + '</label>\
                                            </li>';
                        })
                        sizeElem += '</ul>';
                    } else {
                        var sizeElem = '';
                    }
                    return gridjs.html('<div class="d-flex align-items-center">\
                            <div class="flex-shrink-0 me-2 avatar-sm">\
                                <div class="avatar-title bg-light rounded">\
                                    <img src="'+ row.productImg + '" alt="" class="avatar-xs" />\
                                </div>\
                            </div>\
                            <div class="flex-grow-1">\
                                <h6 class="mb-1"><a href="product-create.html" class="d-block text-reset">'+ row.productTitle + '</a></h6>\
                                <p class="mb-0 text-muted">Category : <span class="fw-medium">'+ row.category + '</span></p>\
                            </div>\
                        </div>'+ colorElem + sizeElem);
                }),
                width: '400px',
            },
            {
                name: 'Stock',
                width: '94px',
            },
            // {
            //     name: 'Rate',
            //     data: (function (row) {
            //         return gridjs.html('<span class="badge bg-light text-body fs-13 fw-medium"><i class="mdi mdi-star text-warning me-1"></i>' + row.rating + '</span>');
            //     }),
            //     width: '80px',
            // },
            {
                name: 'Price',
                data: (function (row) {
                    var text = row.discount;
                    var myArray = text.split("%");
                    var discount = myArray[0];
                    var afterDiscount = row.price - (row.price * discount / 100);
                    if (discount > 0) {
                        var afterDiscountElem = '<div>$' + afterDiscount.toFixed(2) + ' <span class="text-muted fs-14"><del>$' + row.price + '</del></span></div>'
                    } else {
                        var afterDiscountElem = '<div>$' + row.price + '</div>'
                    }
                    return gridjs.html(afterDiscountElem);
                }),
                width: '60px',
            },
            {
                name: 'Status',
                width: '84px',
            },
            {
                name: 'Visibility',
                width: '120px',
            }, {
                name: 'Action',
                width: '80px',
                data: (function (row) {
                    return gridjs.html('<div class="text-center dropdown">\
                        <a href="javascript:void(0);" class="btn btn-ghost-primary btn-icon btn-sm" data-bs-toggle="dropdown" aria-expanded="false" class=""><i class="mdi mdi-dots-horizontal"></i></a>\
                        <ul class="dropdown-menu dropdown-menu-end">\
                            <li>\
                                <a class="dropdown-item" onClick="editProductList('+ row.id + ')" href="product-create.html"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>\
                            </li>\
                            <li>\
                                <a class="dropdown-item remove-list" onClick="removeItem('+ row.id +')" data-bs-toggle="modal" href="#removeItemModal"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a>\
                            </li>\
                        </ul>\
                    </div>');
                })
            },
        ],
        sort: true,
        pagination: {
            limit: 10
        },
        data: productListData,
    }).render(document.getElementById("product-list"));
};

function isStatus(val) {
    switch (val) {
        case "In stock":
            return ('<span class="badge bg-success-subtle text-success  align-middle ms-1">' + val + '</span>');
        case "Out of stock":
            return ('<span class="badge bg-danger-subtle text-danger  align-middle ms-1">' + val + '</span>');
    }
}

// Search product list
var searchProductList = document.getElementById("searchProductList");
searchProductList.addEventListener("keyup", function () {
    var inputVal = searchProductList.value.toLowerCase();
    function filterItems(arr, query) {
        return arr.filter(function (el) {
            return el.productTitle.toLowerCase().indexOf(query.toLowerCase()) !== -1 || el.category.toLowerCase().indexOf(query.toLowerCase()) !== -1 || el.stock.toLowerCase().indexOf(query.toLowerCase()) !== -1 || el.price.toLowerCase().indexOf(query.toLowerCase()) !== -1
        })
    }
    var filterData = filterItems(productListData, inputVal);
    productList.updateConfig({
        data: filterData
    }).forceRender();
});

// price range slider
var slider = document.getElementById('product-price-range');
if (slider) {
    noUiSlider.create(slider, {
        start: [0, 2000], // Handle start position
        step: 10, // Slider moves in increments of '10'
        margin: 20, // Handles must be more than '20' apart
        connect: true, // Display a colored bar between the handles
        behaviour: 'tap-drag', // Move handle on tap, bar is draggable
        range: { // Slider can select '0' to '100'
            'min': 0,
            'max': 2000
        },
        format: wNumb({ decimals: 0, prefix: '$ ' })
    });

    var minCostInput = document.getElementById('minCost'),
        maxCostInput = document.getElementById('maxCost');

    var filterDataAll = '';

    // When the slider value changes, update the input and span
    slider.noUiSlider.on('update', function (values, handle) {
        var productListupdatedAll = productListData;

        if (handle) {
            maxCostInput.value = values[handle];

        } else {
            minCostInput.value = values[handle];
        }

        var maxvalue = maxCostInput.value.substr(2);
        var minvalue = minCostInput.value.substr(2);
        filterDataAll = productListupdatedAll.filter(
            product => parseFloat(product.price) >= minvalue && parseFloat(product.price) <= maxvalue
        );

        productList.updateConfig({
            data: filterDataAll
        }).forceRender();
    });

    minCostInput.addEventListener('change', function () {
        slider.noUiSlider.set([null, this.value]);
    });

    maxCostInput.addEventListener('change', function () {
        slider.noUiSlider.set([null, this.value]);
    });
}


// color-filter
document.querySelectorAll("#color-filter li").forEach(function (item) {
    var inputVal = item.querySelector("input[type='radio']").value;
    item.querySelector("input[type='radio']").addEventListener("change", function () {

        var filterData = productListData.filter(function (filterlist) {
            if (filterlist.color) {
                return filterlist.color.some(function (g) {
                    return g == inputVal;
                });
            }
        });

        productList.updateConfig({
            data: filterData
        }).forceRender();
    });
});

// size-filter
document.querySelectorAll("#size-filter li").forEach(function (item) {
    var inputVal = item.querySelector("input[type='radio']").value;
    item.querySelector("input[type='radio']").addEventListener("change", function () {

        var filterData = productListData.filter(function (filterlist) {
            if (filterlist.size) {
                return filterlist.size.some(function (g) {
                    return g == inputVal;
                });
            }
        });

        productList.updateConfig({
            data: filterData
        }).forceRender();
    });
});

// discount-filter
var arraylist = [];
document.querySelectorAll("#discount-filter .form-check").forEach(function (item) {
    var inputVal = item.querySelector(".form-check-input").value;
    item.querySelector(".form-check-input").addEventListener("change", function () {
        if (item.querySelector(".form-check-input").checked) {
            arraylist.push(inputVal);
        } else {
            arraylist.splice(arraylist.indexOf(inputVal), 1);
        }

        var filterproductdata = productListData;
        if (item.querySelector(".form-check-input").checked && inputVal == 0) {
            filterDataAll = filterproductdata.filter(function (product) {
                if (product.discount) {
                    var listArray = product.discount.split("%");

                    return parseFloat(listArray[0]) < 10;
                }
            });
        } else if (item.querySelector(".form-check-input").checked && arraylist.length > 0) {
            var compareval = Math.min.apply(Math, arraylist);
            filterDataAll = filterproductdata.filter(function (product) {
                if (product.discount) {
                    var listArray = product.discount.split("%");
                    return parseFloat(listArray[0]) >= compareval;
                }
            });
        } else {
            filterDataAll = productListData;
        }

        productList.updateConfig({
            data: filterDataAll
        }).forceRender();
    });
});


// rating-filter
document.querySelectorAll("#rating-filter .form-check").forEach(function (item) {
    var inputVal = item.querySelector(".form-check-input").value;
    item.querySelector(".form-check-input").addEventListener("change", function () {
        if (item.querySelector(".form-check-input").checked) {
            arraylist.push(inputVal);
        } else {
            arraylist.splice(arraylist.indexOf(inputVal), 1);
        }

        var filterproductdata = productListData;
        if (item.querySelector(".form-check-input").checked && inputVal == 1) {
            filterDataAll = filterproductdata.filter(function (product) {
                if (product.rating) {
                    var listArray = product.rating;
                    return parseFloat(listArray) == 1;
                }
            });
        } else if (item.querySelector(".form-check-input").checked && arraylist.length > 0) {
            var compareval = Math.min.apply(Math, arraylist);
            filterDataAll = filterproductdata.filter(function (product) {
                if (product.rating) {
                    var listArray = product.rating;
                    return parseFloat(listArray) >= compareval;
                }
            });
        } else {
            filterDataAll = productListData;
        }

        productList.updateConfig({
            data: filterDataAll
        }).forceRender();
    });
});

document.getElementById("addproduct-btn").addEventListener("click", function () {
    sessionStorage.setItem('editInputValue', "")
})


function editProductList(elem) {
    var getEditid = elem;
    productListData = productListData.map(function (item) {
        if (item.id == getEditid) {
            sessionStorage.setItem('editInputValue', JSON.stringify(item));
        }
        return item;
    });
};

// removeItem event
function removeItem(elem) {
    var getid = elem;
    document.getElementById("remove-product").addEventListener("click", function () {
        function arrayRemove(arr, value) {
            return arr.filter(function (ele) {
                return ele.id != value;
            });
        }
        var filtered = arrayRemove(productListData, getid);

        productListData = filtered;
        productList.updateConfig({
            data: productListData
        }).forceRender();

        document.getElementById("close-removeproductModal").click();
    });
}


//  category list filter
Array.from(document.querySelectorAll('.filter-list a')).forEach(function (filteritem) {
    filteritem.addEventListener("click", function () {
        var filterListItem = document.querySelector(".filter-list a.active");
        if (filterListItem) filterListItem.classList.remove("active");
        filteritem.classList.add('active');

        var filterItemValue = filteritem.querySelector(".listname").innerHTML
        var filterData = productListData.filter(filterlist => filterlist.category === filterItemValue);

        productList.updateConfig({
            data: filterData
        }).forceRender();
    });
});