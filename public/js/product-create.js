//Product gallery crud
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


//Product variant crud
let colors = [];

let sizes = [];

let properties = document.getElementById('properties');

let btnAddProperty = document.querySelector('#addProperty');

let errorVariant = document.querySelector('#error-variant');

let errorPropertyColor = document.querySelector('#errorPropertyColor')

let errorPropertySize = document.querySelector('#errorPropertySize')

//Lưu trữ số màu đã chọn
document.querySelectorAll('.color-product').forEach(function (colorElement) {

    colorElement.addEventListener('click', function () {
        const index = colorElement.getAttribute('data-index');
        const checkbox = document.getElementById(`color${index}`);

        checkbox.checked = !checkbox.checked; // Toggle checkbox checked status

        let parentElement = this.closest('.border-color');

        if (checkbox.checked) {
            parentElement.classList.add('selected-color')
        } else {
            parentElement.classList.remove('selected-color')
        }
    });
});

//Lưu trữ số kích thước đã chọn
document.querySelectorAll('.size-product').forEach(function (sizeElement) {
    sizeElement.addEventListener('click', function () {
        const index = sizeElement.getAttribute('data-index');
        const checkbox = document.getElementById(`size${index}`);

        checkbox.checked = !checkbox.checked; // Toggle checkbox checked status

        const parentElement = this.closest('.border-size');

        if (checkbox.checked) {
            parentElement.classList.add('selected-size')
        } else {
            parentElement.classList.remove('selected-size')
        }
    });
});

//Hiển thị tổng số biến thể
document.querySelector('#save-property').addEventListener('click', function () {

    let colorsBox = document.querySelectorAll(".color-ppt")
    let sizesBox = document.querySelectorAll(".size-ppt")
    sizes = [];
    colors = [];

    sizesBox.forEach(function (element) {
        if (element.checked) {
            sizes.push(element.value)
        }
    })

    colorsBox.forEach(function (element) {
        if (element.checked) {
            colors.push(element.value)
        }
    })

    if (colors.length == 0) {
        errorPropertyColor.innerHTML = "Bạn chưa chọn màu sản phẩm";
        if (btnAddProperty.classList.contains('d-block')) {
            btnAddProperty.classList.remove('d-block');
            btnAddProperty.classList.add('d-none');
        }
        properties.innerHTML = "";
        errorVariant.innerHTML = "";

    } else {
        errorPropertyColor.innerHTML = "";
    }
    if (sizes.length == 0) {
        errorPropertySize.innerHTML = "Bạn chưa chọn kích cỡ sản phẩm";
        if (btnAddProperty.classList.contains('d-block')) {
            btnAddProperty.classList.remove('d-block');
            btnAddProperty.classList.add('d-none');
        }
        properties.innerHTML = "";
        errorVariant.innerHTML = "";

    } else {
        errorPropertySize.innerHTML = '';
    }

    if (colors.length > 0 && sizes.length > 0) {

        errorPropertyColor.innerHTML = "";

        errorPropertySize.innerHTML = "";

        errorVariant.innerHTML = "";

        let optionColor = '';

        let optionSize = '';

        if (btnAddProperty.classList.contains('d-none')) {
            btnAddProperty.classList.remove('d-none');
            btnAddProperty.classList.add('d-block');
        }

        for (const color of colors) {
            let colorAndName = color.split("-");
            optionColor += `<option value="${colorAndName[0]}">${colorAndName[1]}</option>`;
        }

        for (const size of sizes) {
            let sizeAndName = size.split("-");
            optionSize += `<option value="${sizeAndName[0]}">${sizeAndName[1]}</option>`;
        }

        let propertyBox = `<div class="col-12 mb-2 box-properties" id="box-property-${id}">
                            <div class="row justify-content-between">
                                <div class="d-flex col">
                                    <select class="form-select selectBoxColor" aria-label="Default select example" name="product_variants[${id}][product_color_id]">
                                        <option value="" selected>Chọn màu sắc</option>
                                        ${optionColor}
                                    </select>
                                    <select class="form-select selectBoxSize" aria-label="Default select example" name="product_variants[${id}][product_size_id]">
                                        <option value="" selected>Chọn kích cỡ</option>
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
                                        value="" placeholder="Enter product price regular" name="product_variants[${id}][price_regular]"
                                        required>
                                </div>
                                <div class="col">
                                    <label class="form-label" for="product-title-input">Price Sale</label>
                                    <input type="number" class="form-control" id="product-title-input"
                                        value="" placeholder="Enter product price sale" name="product_variants[${id}][price_sale]"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label class="form-label" for="product-title-input">Quantity</label>
                                    <input type="number" class="form-control" id="product-title-input"
                                        value="" placeholder="Enter product quantity" name="product_variants[${id}][quantity]"
                                        required>
                                </div>
                                <div class="col">
                                    <label class="form-label" for="product-title-input">Image</label>
                                    <input type="file" class="form-control" id="product-title-input" name="product_variants[${id}][image]"
                                        required>
                                </div>
                            </div>
                                </div>
                            </div>
                        </div>`;

        properties.innerHTML = propertyBox;

    }

})


function deleteBoxProperty(param) {
    $(`#${param}`).remove()
}


function addBoxProperty() {

    let optionColor = '';

    let optionSize = '';

    let propertyBoxes = document.querySelectorAll('.box-properties').length;

    let totalCoupleProperty = colors.length * sizes.length;

    // alert(totalCoupleProperty);
    // console.log(propertyBoxes);

    if (totalCoupleProperty <= propertyBoxes) {
        errorVariant.innerHTML = "Vượt quá số lượng biến thể đã chọn";
    } else {

        errorVariant.innerHTML = '';

        let idSelect = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();

        for (const color of colors) {
            let colorAndName = color.split("-");
            optionColor += `<option value="${colorAndName[0]}">${colorAndName[1]}</option>`;
        }

        for (const size of sizes) {
            let sizeAndName = size.split("-");
            optionSize += `<option value="${sizeAndName[0]}">${sizeAndName[1]}</option>`;
        }

        let propertyBox = `<div class="col-12 mb-2 box-properties" id="box-property-${idSelect}">
                            <div class="row justify-content-between">
                                <div class="d-flex col">
                                    <select class="form-select selectBoxColor" aria-label="Default select example" name="product_variants[${idSelect}][product_color_id]">
                                        <option value="" selected>Chọn màu sắc</option>
                                        ${optionColor}
                                    </select>
                                    <select class="form-select selectBoxSize" aria-label="Default select example" name="product_variants[${idSelect}][product_size_id]">
                                        <option value="" selected>Chọn kích cỡ</option>
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
                                        value="" placeholder="Enter product price regular" name="product_variants[${idSelect}][price_regular]"
                                        required>
                                </div>
                                <div class="col">
                                    <label class="form-label" for="product-title-input">Price Sale</label>
                                    <input type="number" class="form-control" id="product-title-input"
                                        value="" placeholder="Enter product price sale" name="product_variants[${idSelect}][price_sale]"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label class="form-label" for="product-title-input">Quantity</label>
                                    <input type="number" class="form-control" id="product-title-input"
                                        value="" placeholder="Enter product quantity" name="product_variants[${idSelect}][quantity]"
                                        required>
                                </div>
                                <div class="col">
                                    <label class="form-label" for="product-title-input">Image</label>
                                    <input type="file" class="form-control" id="product-title-input" name="product_variants[${idSelect}][image]"
                                        required>
                                </div>
                            </div>
                                </div>
                            </div>
                        </div>`;
        $(properties).append(propertyBox);
    }

}

let btnError = document.querySelector('#displayerror');
btnError.click();

function addImageVariant(id) {
    let inputImage = document.getElementById(`fileInput${id}`);
    inputImage.click();
    inputImage.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imagePreview = document.getElementById(`imagePreview${id}`);
                imagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    })
}