"use strict";

function colorWiseImageFunctionality(t) {
    let colors = t.val();
    $('#color-wise-image-section').html('')
    $.each(colors, function (key, value) {
        let value_id = value.replace('#', '');
        let color = "color_image_" + value_id;

        let generateHtml = `<div class="col-sm-12 col-md-4">
                            <div class="custom_upload_input position-relative border-dashed-2">
                                <input type="file" name="` + color + `" class="custom-upload-input-file action-upload-color-image" id="color-img-upload-` + value_id + `" data-index="1" data-imgpreview="additional_Image_${value_id}"
                                    accept=".jpg, .webp, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required>

                                <div class="position-absolute right-0 top-0 d-flex gap-2">
                                    <label for="color-img-upload-` + value_id + `" class="delete_file_input_css btn  btn-outline-danger btn-sm square-btn position-relative product-image-edit-icon" style="background: ${value};border-color: ${value};color:#fff">
                                        <i class="fi fi-rr-pencil"></i>
                                    </label>

                                    <span class="delete_file_input btn btn-outline-danger btn-sm square-btn position-relative" style="display: none">
                                        <i class="fi fi-rr-trash"></i>
                                    </span>
                                </div>

                                <div class="img_area_with_preview position-absolute z-index-2 border-0">
                                    <img id="additional_Image_${value_id}" alt="" class="h-auto aspect-1 bg-white onerror-add-class-d-none" src="img">
                                </div>
                                <div class="position-absolute h-100 top-0 w-100 d-flex align-content-center justify-content-center">
                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                        <img alt="" src="`+ elementImagePathOfProductUploadIconByID +`" class="w-50">
                                        <h3 class="text-muted">`+ messageUploadImage +`</h3>
                                    </div>
                                </div>
                            </div>
                        </div>`;

        $('#color-wise-image-section').append(generateHtml);

        $('.delete_file_input').on('click', function () {
            let $parentDiv = $(this).parent().parent();
            $parentDiv.find('input[type="file"]').val('');
            $parentDiv.find('.img_area_with_preview img').addClass("d-none");
            $(this).removeClass('d-flex');
            $(this).hide();
        });

        elementCustomUploadInputFileByID.on('change', function () {
            if (parseFloat($(this).prop('files').length) !== 0) {
                let $parentDiv = $(this).closest('div');
                $parentDiv.find('.delete_file_input').fadeIn();
            }
        });

        uploadColorImage();
    });

    document.addEventListener('change', function (e) {
        if (e.target.matches('.action-upload-color-image')) {
            uploadColorImage(e.target);
        }
    });

    $('.onerror-add-class-d-none').on('error', function () {
        $(this).addClass('d-none')
    })
}

function shapeWiseImageFunctionality(t) {
    let shapes = t.val();
    $('#shape-wise-image-section').html('')
    $.each(shapes, function (key, value) {
        let shape = "shape_image_" + value;

        let generateHtml = `<div class="col-sm-12 col-md-4">
                            <div class="custom_upload_input position-relative border-dashed-2">
                                <input type="file" name="` + shape + `" class="custom-upload-input-file action-upload-shape-image" id="shape-img-upload-` + value + `" data-index="1" data-imgpreview="shape_Image_${value}"
                                    accept=".jpg, .webp, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required>

                                <div class="position-absolute right-0 top-0 d-flex gap-2">
                                    <label for="shape-img-upload-` + value + `" class="delete_file_input_css btn btn-outline-primary btn-sm square-btn position-relative product-image-edit-icon">
                                        <i class="fi fi-rr-pencil"></i>
                                    </label>

                                    <span class="delete_file_input btn btn-outline-danger btn-sm square-btn position-relative" style="display: none">
                                        <i class="fi fi-rr-trash"></i>
                                    </span>
                                </div>

                                <div class="img_area_with_preview position-absolute z-index-2 border-0">
                                    <img id="shape_Image_${value}" alt="" class="h-auto aspect-1 bg-white onerror-add-class-d-none" src="img">
                                </div>
                                <div class="position-absolute h-100 top-0 w-100 d-flex align-content-center justify-content-center">
                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                        <img alt="" src="`+ elementImagePathOfProductUploadIconByID +`" class="w-50">
                                        <h3 class="text-muted">`+ messageUploadImage +`</h3>
                                    </div>
                                </div>
                            </div>
                        </div>`;

        $('#shape-wise-image-section').append(generateHtml);

        $('.delete_file_input').on('click', function () {
            let $parentDiv = $(this).parent().parent();
            $parentDiv.find('input[type="file"]').val('');
            $parentDiv.find('.img_area_with_preview img').addClass("d-none");
            $(this).removeClass('d-flex');
            $(this).hide();
        });

        elementCustomUploadInputFileByID.on('change', function () {
            if (parseFloat($(this).prop('files').length) !== 0) {
                let $parentDiv = $(this).closest('div');
                $parentDiv.find('.delete_file_input').fadeIn();
            }
        });

        uploadShapeImage();
    });

    document.addEventListener('change', function (e) {
        if (e.target.matches('.action-upload-shape-image')) {
            uploadShapeImage(e.target);
        }
    });

    $('.onerror-add-class-d-none').on('error', function () {
        $(this).addClass('d-none')
    })
}

function uploadShapeImage(thisData = null) {
    if (thisData) {
        document
            .getElementById(thisData.dataset.imgpreview)
            .setAttribute("src", window.URL.createObjectURL(thisData.files[0]));
        document
            .getElementById(thisData.dataset.imgpreview)
            .classList.remove("d-none");
    }
}
