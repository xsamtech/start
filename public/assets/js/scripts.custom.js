/**
 * Custom script
 * 
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
// Common variables
const navigator = window.navigator;
const currentLanguage = $('html').attr('lang');
const browserLanguage = (navigator.language || navigator.userLanguage).substring(0, 2);
const currentUser = $('[name="strt-visitor"]').attr('content');
const currentHost = $('[name="strt-url"]').attr('content');
const apiHost = $('[name="strt-api-url"]').attr('content');
const headers = { 'Authorization': 'Bearer ' + $('[name="strt-ref"]').attr('content'), 'Accept': $('.mime-type').val(), 'X-localization': navigator.language };
// Modals
const modalUser = $('#cropModalUser');
// Preview images
const retrievedAvatar = document.getElementById('retrieved_image');
const retrievedMediaCover = document.getElementById('retrieved_media_cover');
const currentMediaCover = document.querySelector('#mediaCoverWrapper img');
const retrievedImageProfile = document.getElementById('retrieved_image_profile');
const currentImageProfile = document.querySelector('#profileImageWrapper img');
const retrievedImageRecto = document.getElementById('retrieved_image_recto');
const currentImageRecto = document.querySelector('#rectoImageWrapper img');
const retrievedImageVerso = document.getElementById('retrieved_image_verso');
const currentImageVerso = document.querySelector('#versoImageWrapper img');
let locale = currentLanguage === 'fr' ? 'fr' : 'en';
let cropper;

/**
 * Check string is numeric
 * 
 * @param string str
 */
function isNumeric(str) {
    if (typeof str != 'string') {
        return false
    } // we only process strings!

    return !isNaN(str) && // use type coercion to parse the _entirety_ of the string (`parseFloat` alone does not do this)...
        !isNaN(parseFloat(str)) // ...and ensure strings of whitespace fail
}

/**
 * Toggle Password Visibility
 * 
 * @param string current
 * @param string element
 */
function passwordVisible(current, element) {
    var el = document.getElementById(element);

    if (el.type === 'password') {
        el.type = 'text';
        current.innerHTML = '<i class="bi bi-eye-slash-fill"></i>'

    } else {
        el.type = 'password';
        current.innerHTML = '<i class="bi bi-eye-fill"></i>'
    }
}

/**
 * Show alert on Ajax
 * 
 * @param string current
 * @param string element
 */
function showAjaxAlert(type, message) {
    const icon = type === 'success'
        ? '<i class="bi bi-info-circle me-2 fs-4" style="vertical-align: -3px;"></i>'
        : '<i class="bi bi-exclamation-triangle me-2 fs-4" style="vertical-align: -3px;"></i>';

    const alertHtml = `
        <div class="position-relative">
            <div class="row position-fixed w-100" style="opacity: 0.9; z-index: 999;">
                <div class="col-lg-4 col-sm-6 mx-auto">
                    <div class="alert alert-${type} alert-dismissible fade show rounded-0 cnpr-line-height-1_1" role="alert">
                        ${icon} ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                    </div>
                </div>
            </div>
        </div>`;

    $('#ajax-alert-container').html(alertHtml);

    // Auto-dismiss après 5 secondes
    setTimeout(() => {
        $('.alert').alert('close');
    }, 5000);
}

$(function () {
    $('.navbar, .card, .btn').addClass('shadow-0');
    $('.btn').css({ textTransform: 'inherit', paddingBottom: '0.5rem' });
    $('.back-to-top').click(function (e) {
        $("html, body").animate({ scrollTop: "0" });
    });

    /* On check, show/hide some blocs */
    // OFFER TYPE
    $('#donationType .form-check-input').each(function () {
        $(this).on('click', function () {
            if ($('#anonyme').is(':checked')) {
                $('#donorIdentity, #otherDonation').addClass('d-none');

            } else {
                $('#donorIdentity, #otherDonation').removeClass('d-none');
            }
        });
    });

    // TRANSACTION TYPE
    $('#paymentMethod .radio-inline').each(function () {
        $(this).on('click', function () {
            if ($('#bank_card').is(':checked')) {
                $('#phoneNumberForMoney').addClass('d-none');

            } else {
                $('#phoneNumberForMoney').removeClass('d-none');
            }
        });
    });

    /* Auto-resize textarea */
    autosize($('textarea'));

    /* jQuery Date picker */
    // Ensure the localization exists
    // if ($.datepicker.regional[browserLanguage]) {
    //     $.datepicker.setDefaults($.datepicker.regional[browserLanguage]);

    // } else {
    //     // fallback to english if language is not found
    //     $.datepicker.setDefaults($.datepicker.regional['fr']);
    // }

    // Initialize the datepicker
    // $('#birthdate, #register_birthdate, #update_birthdate').datepicker({
    //     onSelect: function () {
    //         $(this).focus();
    //     }
    // });

    // $('#birthdate, #register_birthdate, #update_birthdate').datepicker({
    //     dateFormat: currentLanguage.startsWith('fr') || currentLanguage.startsWith('ln') ? 'dd/mm/yy' : 'mm/dd/yy',
    //     onSelect: function () {
    //         $(this).focus();
    //     }
    // });

    /* jQuery DateTime picker */
    // jQuery('#outflow_date').datetimepicker({
    //     format: 'd/m/Y H:i'
    // });
    // jQuery.datetimepicker.setLocale('fr');

    // AVATAR with ajax
    $('#avatar').on('change', function (e) {
        var files = e.target.files;
        var done = function (url) {
            retrievedAvatar.src = url;
            // var modal = new bootstrap.Modal(document.getElementById('cropModalUser'), { keyboard: false });
            // modal.show();

            $('#cropModalUser').modal({
                backdrop: 'static',
                keyboard: false
            });
        };

        if (files && files.length > 0) {
            var reader = new FileReader();

            reader.onload = function () {
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
        }
    });

    $(modalUser).on('shown.bs.modal', function () {
        cropper = new Cropper(retrievedAvatar, {
            aspectRatio: 1,
            viewMode: 3,
            preview: '#cropModalUser .preview',
            done: function (data) { console.log(data); },
            error: function (data) { console.log(data); }
        });

    }).on('hidden.bs.modal', function () {
        cropper.destroy();

        cropper = null;
    });

    $('#cropModalUser #crop_avatar').click(function () {
        $('.user-image').attr('src', currentHost + '/assets/img/ajax-loading.gif');

        var canvas = cropper.getCroppedCanvas({
            width: 700,
            height: 700
        });

        canvas.toBlob(function (blob) {
            var reader = new FileReader();

            reader.readAsDataURL(blob);
            reader.onloadend = function () {
                var base64_data = reader.result;
                // Prepare data as in an HTML form
                var formData = new FormData();

                formData.append('_token', $('meta[name="csrf-token"]').attr('content')); // important
                formData.append('image_64', base64_data);

                $.ajax({
                    url: currentHost + '/account',
                    type: 'POST',
                    data: formData,
                    contentType: false, // IMPORTANT : do not specify a contentType
                    processData: false, // IMPORTANT : do not transform the data
                    success: function (res) {
                        $('.user-image').attr('src', currentHost + '/storage/' + res.avatar_url);
                        $('#ajax-alert-container').html(`<div class="position-relative">
                                                            <div class="row position-fixed w-100" style="opacity: 0.9; z-index: 999;">
                                                                <div class="col-lg-4 col-sm-6 mx-auto">
                                                                    <div class="alert alert-success alert-dismissible fade show rounded-0 cnpr-line-height-1_1" role="alert">
                                                                        <i class="bi bi-info-circle me-2 fs-4" style="vertical-align: -3px;"></i>Photo mise à jour.
                                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>`);
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseJSON || xhr.responseText);
                    }
                });
            };
        });
    });

    // AVATAR without ajax
    $('#image_profile').on('change', function (e) {
        var files = e.target.files;
        var done = function (url) {
            retrievedImageProfile.src = url;
            // var modal = new bootstrap.Modal(document.getElementById('cropModal_profile'), { keyboard: false });
            // modal.show();

            $('#cropModal_profile').modal({
                backdrop: 'static',
                keyboard: false
            });
        };

        if (files && files.length > 0) {
            var reader = new FileReader();

            reader.onload = function () {
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
        }
    });

    $('#cropModal_profile').on('shown.bs.modal', function () {
        cropper = new Cropper(retrievedImageProfile, {
            aspectRatio: 1,
            viewMode: 3,
            preview: '#cropModal_profile .preview'
        });

    }).on('hidden.bs.modal', function () {
        cropper.destroy();

        cropper = null;
    });

    $('#cropModal_profile #crop_profile').on('click', function () {
        var canvas = cropper.getCroppedCanvas({
            width: 700,
            height: 700
        });

        canvas.toBlob(function (blob) {
            URL.createObjectURL(blob);
            var reader = new FileReader();

            reader.readAsDataURL(blob);
            reader.onloadend = function () {
                var base64_data = reader.result;

                $(currentImageProfile).attr('src', base64_data);
                $('#image_64').attr('value', base64_data);
            };
        });
    });

    /* Increment/Decrement panel quantity */
    $('.qty-btn').click(function () {
        const button = $(this);
        const operation = button.data('type');
        const entity = button.data('entity');
        const panelId = button.data('panel-id');
        const cartId = button.data('cart-id') || null;
        const stockQty = parseInt($('#stock-qty-' + panelId).text(), 10);
        const orderedQty = parseInt($('#ordered-qty-' + panelId).text() || '0', 10);

        // Validation front-end
        if (operation === 'inc' && stockQty <= 0) {
            showAjaxAlert('danger', 'Stock insuffisant.');
            return;
        }
        if (operation === 'dec' && orderedQty <= 0) {
            showAjaxAlert('danger', 'Impossible de réduire davantage.');
            return;
        }

        button.prop('disabled', true);

        $.ajax({
            url: `/panel-quantity/${entity}/${panelId}`,
            method: 'POST',
            data: {
                amount: 1,
                operation: operation,
                cart_id: cartId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                // Mise à jour quantités
                if (entity === 'ordered_panel') {
                    if (response.new_ordered_quantity === 0) {
                        $('#ordered-panel-row-' + panelId).fadeOut(300, function () {
                            $(this).remove();
                        });
                    } else {
                        $('#ordered-qty-' + panelId).text(response.new_ordered_quantity);
                    }
                }

                if (response.remaining_stock !== undefined) {
                    $('#stock-qty-' + panelId).text(response.remaining_stock);
                } else if (response.quantity !== undefined) {
                    $('#stock-qty-' + panelId).text(response.quantity);
                }

                showAjaxAlert('success', response.message);
            },
            error: function (xhr) {
                showAjaxAlert('danger', xhr.responseJSON?.error || 'Erreur');
            },
            complete: function () {
                button.prop('disabled', false);
            }
        });
    });

});
