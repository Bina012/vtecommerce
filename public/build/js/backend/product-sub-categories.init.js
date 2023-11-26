/*
Template Name: Toner eCommerce + Admin HTML Template
Author: Themesbrand
Version: 1.2.0
Website: https://Themesbrand.com/
Contact: Themesbrand@gmail.com
File: product category init File
*/

var editList = false;

// product-sub-categories
if (document.getElementById("product-sub-categories")) {
    var categoryList = new gridjs.Grid({
        columns: [
            {
                name: 'Id', 
                width: '80px',
                data: (function (row) {
                    return gridjs.html('<div class="fw-medium">#TBSC' + row.id + '</div>');
                })
            },
            {
                name: 'Subcategory',
                width: '120px'
            },
            {
                name: 'Category',
                width: '160px'
            },
            {
                name: 'Createby',
                width: '60px'
            },{
                name: 'Action',
                width: '80px',
                data: (function (row) {
                    return gridjs.html('<ul class="hstack gap-2 list-unstyled mb-0">\
                    <li>\
                        <a href="#" class="badge bg-success-subtle text-success " onClick="editCategoryList('+ row.id + ')">Edit</a>\
                    </li>\
                    <li>\
                        <a href="#removeItemModal" data-bs-toggle="modal" class="badge bg-danger-subtle text-danger " onClick="removeItem('+ row.id + ')">Delete</a>\
                    </li>\
                </ul>');
                })
            },
        ],
        sort: true,
        pagination: {
            limit: 10
        },
        data: subCategoriesData,
    }).render(document.getElementById("product-sub-categories"));
};


// Search result list
var searchResultList = document.getElementById("searchResultList");
searchResultList.addEventListener("keyup", function () {
    var inputVal = searchResultList.value.toLowerCase();
    function filterItems(arr, query) {
        return arr.filter(function (el) {
            return el.subcategory.toLowerCase().indexOf(query.toLowerCase()) !== -1 || el.category.toLowerCase().indexOf(query.toLowerCase()) !== -1 || el.createby.toLowerCase().indexOf(query.toLowerCase()) !== -1
        })
    }

    var filterData = filterItems(subCategoriesData, inputVal);

    categoryList.updateConfig({
        data: filterData
    }).forceRender();
});

var cateField = document.getElementById("categorySelect");

var categoryInput = new Choices(cateField, {
    searchEnabled: false,
});


var createCategoryForm = document.querySelectorAll('.createCategory-form')
Array.prototype.slice.call(createCategoryForm).forEach(function (form) {
    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            form.classList.add('was-validated');
        } else {
            event.preventDefault();
            var subcategoryTitle = document.getElementById('SubcategoryTitle').value;
            var categoryInputVal = categoryInput.getValue(true);
            var categoryDesc = document.getElementById("descriptionInput").value;

            if (subcategoryTitle !== "" && categoryInputVal !== "" && categoryDesc !== "" && !editList) {
                var newCategoryId = findNextId();
                var newCategory = {
                    'id': newCategoryId,
                    "subcategory": subcategoryTitle,
                    "category": categoryInputVal,
                    "createby": "Admin",
                    "description": categoryDesc
                };

                subCategoriesData.push(newCategory);
                
                categoryList.updateConfig({
                    data: subCategoriesData
                }).forceRender();
                clearVal();
                form.classList.remove('was-validated');
                
            }else if(subcategoryTitle !== "" && categoryInputVal !== "" && categoryDesc !== "" && editList){
                var getEditid = document.getElementById("categoryid-input").value;

                subCategoriesData = subCategoriesData.map(function (item) {
                    if (item.id == getEditid) {
                        var editObj = {
                            'id': getEditid,
                            "subcategory": subcategoryTitle,
                            "category": categoryInputVal,
                            "createby": item.createby,
                            "description": categoryDesc
                        }
                        return editObj;
                    }
                    return item;
                });

                categoryList.updateConfig({
                    data: subCategoriesData
                }).forceRender();
                clearVal();
                form.classList.remove('was-validated');
                editList = false;
            } else {
                form.classList.add('was-validated');
            }
            sortElementsById();
        }
    }, false)
});

function fetchIdFromObj(category) {
    return parseInt(category.id);
}

function findNextId() {
    if (subCategoriesData.length === 0) {
        return 0;
    }
    var lastElementId = fetchIdFromObj(subCategoriesData[subCategoriesData.length - 1]),
        firstElementId = fetchIdFromObj(subCategoriesData[0]);
    return (firstElementId >= lastElementId) ? (firstElementId + 1) : (lastElementId + 1);
}


function sortElementsById() {
    var categories = subCategoriesData.sort(function (a, b) {
        var x = fetchIdFromObj(a);
        var y = fetchIdFromObj(b);

        if (x > y) {
            return -1;
        }
        if (x < y) {
            return 1;
        }
        return 0;
    })
}

sortElementsById();


function editCategoryList(elem){
    var getEditid = elem;
    subCategoriesData = subCategoriesData.map(function (item) {
        if (item.id == getEditid) {
            
            editList = true;
            document.getElementById("addCategoryLabel").innerHTML = "Edit Sub Categories";
            document.getElementById("addNewCategory").innerHTML = "Save";
            document.getElementById("categoryid-input").value = item.id;
            document.getElementById("SubcategoryTitle").value = item.subcategory;
            var categoryId = item.category_id.toString();
            categoryInput.setChoiceByValue(categoryId);
            document.getElementById("descriptionInput").value = item.description;
        }
        return item;
    });
}

// removeItem event
function removeItem(elem) {
    var getid = elem;
    document.getElementById("remove-category").addEventListener("click", function () {
        function arrayRemove(arr, value) {
            return arr.filter(function (ele) {
                return ele.id != value;
            });
        }
        var filtered = arrayRemove(subCategoriesData, getid);

        subCategoriesData = filtered;
        categoryList.updateConfig({
            data: subCategoriesData
        }).forceRender();

        document.getElementById("close-removecategoryModal").click();
    });
}


function clearVal() {
    document.getElementById("addCategoryLabel").innerHTML = "Create Sub Categories";
    document.getElementById("addNewCategory").innerHTML = "Add Sub Category";
    document.getElementById('SubcategoryTitle').value = "";
    document.getElementById("descriptionInput").value = "";
    categoryInput.removeActiveItems();
    categoryInput.setChoiceByValue("");
}