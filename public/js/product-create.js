
CKEDITOR.replace('content');

let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();

let addGalleryBtn = document.getElementById('addGallery')

addGalleryBtn.addEventListener('click', (e) => {

    let addGalleryElement = `<div id="box_${id}" class="col-xxl-6 col-md-6">
        
        <div>
            <label for="gallery_${id}" class="form-label">Image gallery</label>
            <div class="d-flex">
                <input type="file" class="form-control" id="gallery_${id}"
                name="product_galleries[]">
                <button type="button" class="btn btn-danger" onclick="removeGalleryImg('box_${id}')"><span class="bx bx-trash"></span></button>
            </div>
        </div>

    </div>`;

    let boxGalleryImg = document.getElementById('boxGalleryImg')

    $(boxGalleryImg).append(addGalleryElement);
})

function removeGalleryImg(param) {
    if (confirm('Bạn có muốn xóa không?')) {
        $(`#${param}`).remove()
    }
}


let property = {
    color: [],
    size: []
};

let optionColor = '';

let optionSize = '';

document.querySelectorAll('.color-product').forEach(function (colorElement) {

    colorElement.addEventListener('click', function () {
        const index = colorElement.getAttribute('data-index');
        const checkbox = document.getElementById(`color${index}`);

        checkbox.checked = !checkbox.checked; // Toggle checkbox checked status

        let parentElement = this.closest('.border-color');

        if (checkbox.checked) {
            parentElement.classList.add('selected-color')
            property.color.push(checkbox.value);
        } else {
            parentElement.classList.remove('selected-color')
            let indexToRemove = property.color.indexOf(checkbox.value);
            property.color.splice(indexToRemove, 1);
        }
    });
});

document.querySelectorAll('.size-product').forEach(function (sizeElement) {
    sizeElement.addEventListener('click', function () {
        const index = sizeElement.getAttribute('data-index');
        const checkbox = document.getElementById(`size${index}`);

        checkbox.checked = !checkbox.checked; // Toggle checkbox checked status

        const parentElement = this.closest('.border-size');

        if (checkbox.checked) {
            parentElement.classList.add('selected-size')
            property.size.push(checkbox.value);
        } else {
            parentElement.classList.remove('selected-size')
            let indexToRemove = property.size.indexOf(checkbox.value);
            property.size.splice(indexToRemove, 1);
        }
    });
});

document.querySelector('#save-property').addEventListener('click', function () {

    let btnAddProperty = document.querySelector('#addProperty');

    if (btnAddProperty.classList.contains('d-none')) {
        btnAddProperty.classList.remove('d-none');
        btnAddProperty.classList.add('d-block');
    }

    let colors = property.color.reduce(function (accumulator, element) {
        if (accumulator.indexOf(element) === -1) {
            accumulator.push(element)
        }
        return accumulator
    }, [])

    let sizes = property.size.reduce(function (accumulator, element) {
        if (accumulator.indexOf(element) === -1) {
            accumulator.push(element)
        }
        return accumulator
    }, [])


    for (const color of colors) {
        let colorAndName = color.split("-");
        optionColor += `<option value="${colorAndName[0]}">${colorAndName[1]}</option>`;
    }

    for (const size of sizes) {
        let sizeAndName = size.split("-");
        optionSize += `<option value="${sizeAndName[0]}">${sizeAndName[1]}</option>`;
    }

    let properties = document.getElementById('properties');

    let propertyBox = `<div class="col-12 mb-2" id="box-property-${id}">
                                    <div class="row justify-content-between">
                                        <div class="d-flex col">
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>Chọn thuộc tính</option>
                                                ${optionColor}
                                            </select>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>Chọn thuộc tính</option>
                                                ${optionSize}
                                            </select>
                                        </div>
                                        <a class="col d-flex justify-content-end align-items-center"
                                            style="width:100%" data-bs-toggle="collapse"
                                            href="#multiCollapseExample1" role="button" aria-expanded="false"
                                            aria-controls="multiCollapseExample1"><i
                                                class="bx bx-chevron-down"></i></a>
                                        <div class="col-1">
                                            <button type="button" class="btn btn-danger" onclick="deleteBoxProperty('box-property-${id}')"><span class="bx bx-trash"></span></button>
                                        </div>
                                    </div>
                                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                                        <div class="card card-body mb-0">
                                            <div class="row">
                                        <div class="col">
                                            <label class="form-label" for="product-title-input">Price Regular</label>
                                            <input type="number" class="form-control" id="product-title-input"
                                                value="" placeholder="Enter product price regular" name="price_regular"
                                                required>
                                        </div>
                                        <div class="col">
                                            <label class="form-label" for="product-title-input">Price Sale</label>
                                            <input type="number" class="form-control" id="product-title-input"
                                                value="" placeholder="Enter product price sale" name="price_sale"
                                                required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label" for="product-title-input">Quantity</label>
                                            <input type="number" class="form-control" id="product-title-input"
                                                value="" placeholder="Enter product quantity" name="quantity"
                                                required>
                                        </div>
                                        <div class="col">
                                            <label class="form-label" for="product-title-input">Image</label>
                                            <input type="file" class="form-control" id="product-title-input" name="image"
                                                required>
                                        </div>
                                    </div>
                                        </div>
                                    </div>
                                </div>`;

    properties.innerHTML = propertyBox;

})


function deleteBoxProperty(param) {
    $(`#${param}`).remove()
}


function addBoxProperty() {

    let totalProperty = property.color.length * property.size.length;

    alert(totalProperty);


    let idSelect = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();

    // let properties = document.getElementById('properties');

    let propertyBox = `<div class="col-12 mb-2" id="box-property-${idSelect}">
                                    <div class="row justify-content-between">
                                        <div class="d-flex col">
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>Chọn thuộc tính</option>
                                                ${optionColor}
                                            </select>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>Chọn thuộc tính</option>
                                                ${optionSize}
                                            </select>
                                        </div>
                                        <a class="col d-flex justify-content-end align-items-center"
                                            style="width:100%" data-bs-toggle="collapse"
                                            href="#multiCollapseExample${idSelect}" role="button" aria-expanded="false"
                                            aria-controls="multiCollapseExample${idSelect}"><i
                                                class="bx bx-chevron-down"></i></a>
                                        <div class="col-1">
                                            <button type="button" class="btn btn-danger" onclick="deleteBoxProperty('box-property-${idSelect}')"><span class="bx bx-trash"></span></button>
                                        </div>
                                    </div>
                                    <div class="collapse multi-collapse" id="multiCollapseExample${idSelect}">
                                        <div class="card card-body mb-0">
                                            <div class="row">
                                        <div class="col">
                                            <label class="form-label" for="product-title-input">Price Regular</label>
                                            <input type="number" class="form-control" id="product-title-input"
                                                value="" placeholder="Enter product price regular" name="price_regular"
                                                required>
                                        </div>
                                        <div class="col">
                                            <label class="form-label" for="product-title-input">Price Sale</label>
                                            <input type="number" class="form-control" id="product-title-input"
                                                value="" placeholder="Enter product price sale" name="price_sale"
                                                required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label" for="product-title-input">Quantity</label>
                                            <input type="number" class="form-control" id="product-title-input"
                                                value="" placeholder="Enter product quantity" name="quantity"
                                                required>
                                        </div>
                                        <div class="col">
                                            <label class="form-label" for="product-title-input">Image</label>
                                            <input type="file" class="form-control" id="product-title-input" name="image"
                                                required>
                                        </div>
                                    </div>
                                        </div>
                                    </div>
                                </div>`;
    $(properties).append(propertyBox);
}
