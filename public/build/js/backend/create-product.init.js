/*
Template Name: Toner eCommerce + Admin HTML Template
Author: Themesbrand
Version: 1.2.0
Website: https://Themesbrand.com/
Contact: Themesbrand@gmail.com
File: Create Product init File
*/

var editinputValueJson = sessionStorage.getItem('editInputValue');
let ck_editor;

ClassicEditor
    .create(document.querySelector('#editor2'))
    .then(function (editor) {
        ck_editor = editor;
        if(editinputValueJson){
            ck_editor.setData(editinputValueJson.description);
        }
        editor.ui.view.editable.element.style.height = '200px';
    })
    .catch(function (error) {
        console.error(error);
    });

var thumbnailArray = [];
var uploadPathArray = [];

// Dropzone has been added as a global variable.
var csrf_token = document.querySelector('meta[name="csrf-token"]').content;

function result(r){
    uploadPathArray.push(r);
}

var myDropzone = new Dropzone("div.my-dropzone", { 
    url: "/product/upload",
    headers:{
        'X-CSRF-TOKEN': csrf_token
    },
    success:function(response,xhr){
        result(xhr.imagePath);
    },
    addRemoveLinks: true,
    removedfile: function (file) {
        file.previewElement.remove();

        thumbnailArray = [];
    },
});

myDropzone.on("thumbnail", function (file, dataUrl) {
    thumbnailArray.push(dataUrl);
});
var mockFile = { name: "Existing file!", size: 12345 };

// choices category input
var productCategoryInput = new Choices('#choices-category-input', {
    searchEnabled: false,
});

if (editinputValueJson) {
    var editinputValueJson = JSON.parse(editinputValueJson);
    document.getElementById("formAction").value = "edit";
    document.getElementById("product-id-input").value = editinputValueJson.id;
    productCategoryInput.setChoiceByValue(editinputValueJson.category);
    
    var imagesArray = editinputValueJson.images;
    imagesArray.forEach(function(item){
        myDropzone.options.addedfile.call(myDropzone, mockFile);
        myDropzone.options.thumbnail.call(myDropzone,mockFile,'/storage/'+item.image_path);
        uploadPathArray.push(item.image_path);
    });
    //myDropzone.options.thumbnail.call(myDropzone, mockFile, editinputValueJson.productImg);
    //thumbnailArray.push(editinputValueJson.productImg)
    document.getElementById("product-title-input").value = editinputValueJson.productTitle;
    document.getElementById("short_description_value").value = editinputValueJson.short_description;
    document.getElementById("manufacturer-name-input").value = editinputValueJson.manufacture_name;
    document.getElementById("manufacturer-brand-input").value = editinputValueJson.manufacture_brand;
    document.getElementById("choices-publish-status-input").selectedOptions[0].value = editinputValueJson.status;
    document.getElementById("choices-publish-visibility-input").selectedOptions[0].value = editinputValueJson.visibility;
    document.getElementById("stocks-input").value = editinputValueJson.stock;
    document.getElementById("product-price-input").value = editinputValueJson.price;
    document.getElementById("product-discount-input").value = editinputValueJson.discount;
    
    // clothe-colors
    Array.from(document.querySelectorAll(".clothe-colors li")).forEach(function (subElem) {
        var nameelem = subElem.querySelector('[type="checkbox"]');
        editinputValueJson.color.map(function(subItem){
            if (subItem == nameelem.value) {
                nameelem.setAttribute("checked", "checked");
            }
        })
    })

    // clothe-size
    Array.from(document.querySelectorAll(".clothe-size li")).forEach(function (subElem) {
        var nameelem = subElem.querySelector('[type="checkbox"]');
        if(editinputValueJson.size){
            editinputValueJson.size.map(function(subItem){
                if (subItem == nameelem.value) {
                    nameelem.setAttribute("checked", "checked");
                }
            })
        }
    })
}

var forms = document.querySelectorAll('.needs-validation')
// date & time
var date = new Date().toUTCString().slice(5, 16);

var colors = [];
var sizes = [];

Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            event.preventDefault();
            var productTitleValue = document.getElementById("product-title-input").value;
            var productCategoryValue = productCategoryInput.getValue(true);
            var description = document.getElementById("editor2").value;
            var short_description = document.getElementById("short_description_value").value;
            var manufacture_name = document.getElementById("manufacturer-name-input").value;
            var manufacture_brand = document.getElementById("manufacturer-brand-input").value;
            var status = document.getElementById("choices-publish-status-input").selectedOptions[0].value;
            var visibility = document.getElementById("choices-publish-visibility-input").selectedOptions[0].value;
            var stockInputValue = document.getElementById("stocks-input").value;
            var productPriceValue = document.getElementById("product-price-input").value;
            var productDiscountVal = document.getElementById("product-discount-input").value;

            // clothe-colors
            document.querySelectorAll(".clothe-colors li").forEach(function (item) {
                if (item.querySelector("input").checked == true) {
                    var colorListVal = item.querySelector("input").value;
                    colors.push(colorListVal)
                }
            });

            // clothe-size
            document.querySelectorAll(".clothe-size li").forEach(function (item) {
                if (item.querySelector("input").checked == true) {
                    var sizeListVal = item.querySelector("input").value;
                    sizes.push(sizeListVal)
                }
            });

            var formAction = document.getElementById("formAction").value;
            if (formAction == "add" && productCategoryValue !== "" && uploadPathArray.length > 0) {
                var newObj = {
                    "id":null,
                    "images_path": uploadPathArray,
                    "title": productTitleValue,
                    "category_id": productCategoryValue,
                    "description" : description,
                    "short_description" : short_description,
                    "manufacture_name" : manufacture_name,
                    "manufacture_brand" : manufacture_brand,
                    "stocks": stockInputValue,
                    "price": productPriceValue,
                    "discount": productDiscountVal,
                    "colors": colors,
                    "sizes": sizes,
                    "status":status,
                    "visibility":visibility
                };
                $.ajax({
                    type:'POST',
                    url:'/product',
                    data:newObj,
                    headers:{
                        'X-CSRF-TOKEN': csrf_token
                    },
                    success:function(response,xhr){
                        window.location.replace("/product");
                    }
                });
            }else if (formAction == "edit" && productCategoryValue !== "" && uploadPathArray.length > 0) {
                var editproductId = document.getElementById("product-id-input").value;
                if (sessionStorage.getItem('editInputValue')) {
                    var editObj = {
                        "id": parseInt(editproductId),
                        //"images_path": uploadPathArray,
                        "title": productTitleValue,
                        "category_id": productCategoryValue,
                        "description" : description,
                        "short_description" : short_description,
                        "manufacture_name" : manufacture_name,
                        "manufacture_brand" : manufacture_brand,
                        "stocks": stockInputValue,
                        "price": productPriceValue,
                        "discount": productDiscountVal,
                        "colors": colors,
                        "sizes": sizes,
                        "status":status,
                        "visibility":visibility
                    };
                    $.ajax({
                        type:'POST',
                        url:'/product',
                        data:editObj,
                        headers:{
                            'X-CSRF-TOKEN': csrf_token
                        },
                        success:function(response,xhr){
                            sessionStorage.removeItem("editInputValue");
                            window.location.replace("/product");
                        }
                    });
                }
            }else {
                console.log('Form Action Not Found.');
            }

            return false;
        }

        form.classList.add('was-validated');

    }, false)
});