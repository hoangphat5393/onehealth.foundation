$(function () {
    // var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    // var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    //     return new bootstrap.Popover(popoverTriggerEl);
    // });

    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
    const popoverList = [...popoverTriggerList].map((popoverTriggerEl) => new bootstrap.Popover(popoverTriggerEl));

    // var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    // var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    //     return new bootstrap.Tooltip(tooltipTriggerEl);
    // });

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map((tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl));

    //fix main menu khi scoll
    $(window).on("scroll", function () {
        if (window.pageYOffset > 100) {
            $("#site_header").addClass("active-menu");
        } else {
            $("#site_header").removeClass("active-menu");
        }
    });
    //fix main menu khi scoll

    $(document).on("click", ".product-form__cart-add", function () {
        var form = document.getElementById("product_form_addCart"),
            fdnew = new FormData(form);
        axios({
            method: "post",
            url: $("#product_form_addCart").prop("action"),
            data: fdnew,
        })
            .then((res) => {
                if (res.data.error == 0) {
                    setTimeout(function () {
                        $("#CartCount").html(res.data.count_cart);

                        if (res.data.view != "") {
                            $(".site-cart #header-cart").remove();
                            $(".site-cart").append(res.data.view);
                        }
                    }, 1000);
                    alertJs("success", res.data.msg);
                } else {
                    alertJs("error", res.data.msg);
                }
            })
            .catch((e) => console.log(e));
    });
    $(document).on("click", ".quick-buy", function () {
        $(this).text("Loading...");
        var form = document.getElementById("product_form_addCart"),
            fdnew = new FormData(form),
            href = $(this).attr("href");
        axios({
            method: "post",
            url: "buy-now",
            data: fdnew,
        })
            .then((res) => {
                if (res.data.error == 0) {
                    window.location.href = href;
                } else {
                    alertJs("error", res.data.msg);
                }
            })
            .catch((e) => console.log(e));

        return false;
    });

    $(document).on("click", ".mini-products-list .remove", function (event) {
        event.preventDefault();
        $(this).closest(".widget-cart-item").remove();
        var rowId = $(this).attr("data");
        axios({
            method: "post",
            url: "/cart/ajax/remove",
            data: { rowId: rowId },
        })
            .then((res) => {
                if (res.data.error == 0) {
                    setTimeout(function () {
                        $("#CartCount").html(res.data.count_cart);
                        $("#header-cart .money-total").html(res.data.total);
                    }, 1000);
                    alertJs("success", res.data.msg);
                } else {
                    alertJs("error", res.data.msg);
                }
            })
            .catch((e) => console.log(e));
    });

    $(".newsletter__submit").click(function () {
        var action = $(this).closest("form").attr("action"),
            email = $(this).closest("form").find('input[name="your_email"]').val();
        if (email != "") {
            axios({
                method: "post",
                url: action,
                data: { email: email },
            })
                .then((res) => {
                    if (res.data.status == "success") {
                        $("footer").find("#notifyModal").remove();
                        $("footer").append(res.data.view);
                        $("#notifyModal").modal("show");
                    }
                })
                .catch((e) => console.log(e));
        } else {
            alert("Vui lòng nhập Email");
            $('input[name="your_email"]').focus();
        }
    });

    $(document).on("click", ".add-to-wishlist", function () {
        var id = $(this).attr("data"),
            this_ = $(this);
        axios({
            method: "post",
            url: "/add-to-wishlist",
            data: {
                id: id,
            },
        })
            .then((res) => {
                // this_.find('i').removeClass('active');
                if (this_.find(".anm-heart").hasClass("active")) {
                    this_.find(".anm-heart-l").addClass("active");
                    this_.find(".anm-heart").removeClass("active");
                } else {
                    this_.find(".anm-heart").addClass("active");
                    this_.find(".anm-heart-l").removeClass("active");
                }
                /*if(res.data.view !='' && res.data.status =='success'){
          $(this).parent().html(res.data.view);
          $('.sub_number').show().text(res.data.count_wishlist);
          POTENZA.Tooltip();
        }*/
            })
            .catch((e) => console.log(e));
        return false;
    });
    $(document).on("click", ".quick-view", function () {
        var id = $(this).data("id");
        axios({
            method: "post",
            url: "/quick-view",
            data: {
                id: id,
            },
        })
            .then((res) => {
                if (res.data.error == 0) {
                    // console.log(res.data.error);
                    $("body").find("#content_quickview").remove();
                    $("body").append(res.data.view);
                    $("#content_quickview").modal("show");
                }
            })
            .catch((e) => console.log(e));
        return false;
    });

    $(document).on("click", ".description-view-more", function () {
        var max_height = $(this).closest(".tab-content").find(".max-height-300"),
            title_show = $(this).data("more"),
            title_less = $(this).data("less");
        if (max_height.length > 0) {
            $(this).text(title_less);
            max_height.removeClass("max-height-300");
            $(this).removeClass("description-view-more").addClass("description-view-less");
        }
    });
    $(document).on("click", ".description-view-less", function () {
        var max_height = $(this).closest(".tab-content").find(".max-height-300"),
            title_show = $(this).data("more"),
            title_less = $(this).data("less");
        if (!max_height.length) {
            console.log(title_show);
            $(this).text(title_show);
            $(".product-description").addClass("max-height-300");
            $(this).removeClass("description-view-less").addClass("description-view-more");
        }
    });

    //login modal

    var login_page = $("#signin-tab");
    login_page.validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,
        rules: {
            email: "required",
            password: "required",
        },
        messages: {
            email: "Nhập địa chỉ E-mail",
            password: "Nhập mật khẩu",
        },
        errorElement: "div",
        errorLabelContainer: ".errorTxt",
        invalidHandler: function (event, validator) {
            $("html, body").animate(
                {
                    scrollTop: 0,
                },
                500
            );
        },
    });

    $(".btn-login").click(function (event) {
        if (login_page.valid()) {
            var form = document.getElementById("signin-tab");
            var fdnew = new FormData(form);
            login_page.find(".list-content-loading").show();
            axios({
                method: "POST",
                url: "/customer/login",
                data: fdnew,
            })
                .then((res) => {
                    // console.log(res.data);
                    login_page.find(".error-message").hide();
                    if (res.data.error == 0) {
                        $("#signin-tab").html(res.data.view);

                        $("#signin-modal").on("hidden.bs.modal", function (e) {
                            window.location.href = "/";
                        });
                    } else {
                        login_page.find(".list-content-loading").hide();
                        login_page.find(".error-message").show().html(res.data.msg);
                    }
                })
                .catch((e) => console.log(e));
        }
    });

    //login modal

    // counter
    animateCounterUp();
    function animateCounterUp() {
        let e = document.querySelectorAll(".animate-counter-up");
        e.forEach((r) => {
            const u = () => {
                let e = +r.getAttribute("data-countTarget");
                var t,
                    n = +r.getAttribute("data-countStep"),
                    o = +r.innerText;
                (t = e < 100 ? 100 : 1), o < e ? ((r.innerText = o + n), setTimeout(u, t)) : (r.innerText = e.toLocaleString());
            };
            u();
        });
    }
    // counter

    // SUBSCRIPTION
    $(".btn-subscription").on("click", function () {
        var action = $(this).closest("form").attr("action"),
            email = $(this).closest("form").find('input[name="your_email"]').val();
        if (email != "") {
            axios({
                method: "post",
                url: action,
                data: { email: email },
            })
                .then((res) => {
                    if (res.data.status == "success") {
                        $("footer").find("#notifyModal").remove();
                        $("footer").append(res.data.view);
                        $("#notifyModal").modal("show");
                    }
                })
                .catch((e) => console.log(e));
        } else {
            alert("Vui lòng nhập Email");
            $('input[name="your_email"]').focus();
        }
    });

    // Open modal
    // var myModal = new bootstrap.Modal(document.getElementById("notifyModal"), {
    //     keyboard: false,
    // });
    // myModal.show();

    // CONTACT
    // var contact_form = $("#contact-form");

    // contact_form.validate({
    //     onfocusout: false,
    //     onkeyup: false,
    //     onclick: false,
    //     rules: {
    //         "contact[name]": "required",
    //         "contact[email]": {
    //             required: true,
    //             email: true,
    //         },
    //         "contact[phone]": {
    //             // required: true,
    //             number: true,
    //             digits: true,
    //             minlength: 10,
    //         },
    //         "contact[subject]": "required",
    //     },
    //     messages: {
    //         "contact[name]": "Please fill in you name!",
    //         "contact[email]": {
    //             required: "Please fill in your email address!",
    //             email: "Please provide valid email address!",
    //         },
    //         "contact[phone]": {
    //             required: "Please fill in your phone number!!",
    //             number: "Please provide valid phone number!!",
    //             digits: "Please provide valid phone number!!",
    //             minlength: "Please provide valid phone number!!",
    //         },
    //         "contact[subject]": "Please fill in subject!",
    //     },
    //     errorElement: "div",
    //     errorLabelContainer: ".errorTxt",
    //     invalidHandler: function (event, validator) {
    //         $("html, body").animate(
    //             {
    //                 scrollTop: 0,
    //             },
    //             500
    //         );
    //     },
    // });

    // $(".btn-submit-contact").on("click", function () {
    //     $(".list-content-loading").show();

    //     var action = $(this).closest("form").attr("action"),
    //         form = document.getElementById("contact-form"),
    //         fdnew = new FormData(form);
    //     axios({
    //         method: "post",
    //         url: action,
    //         data: fdnew,
    //     })
    //         .then((res) => {
    //             $(".list-content-loading").hide();
    //             if (res.data.error == 0) {
    //                 $("#modalContact").modal("hide");
    //                 $("footer").find("#notifyModal").remove();
    //                 $("footer").append(res.data.view);
    //                 $("#notifyModal").modal("show");
    //             } else {
    //                 $("#contact-form .text-error").text(res.data.message);
    //             }
    //         })
    //         .catch((e) => console.log(e));
    // });
});

function alertJs(type = "error", msg = "") {
    const Toast = Swal.mixin({
        toast: true,
        icon: type,
        position: "bottom-end",
        showConfirmButton: false,
        timer: 3000,
    });
    Toast.fire({
        type: type,
        title: msg,
    });
}

function alertMsg(type = "error", msg = "", note = "") {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger",
        },
        buttonsStyling: true,
    });
    swalWithBootstrapButtons.fire(msg, note, type);
}

/**
 * Animation on scroll
 */
window.addEventListener("load", () => {
    AOS.init({
        duration: 1000,
        easing: "ease-in-out",
        once: true,
        mirror: false,
        disable: function () {
            var maxWidth = 800;
            return window.innerWidth < maxWidth;
        },
    });
});
