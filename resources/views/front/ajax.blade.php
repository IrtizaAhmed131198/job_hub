<script>
    $(document).ready(function() {
        $('#form-newsletter').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: "{{ route('subscribe') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                },
                error: function(response) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Subscription failed. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });

    /* --- SwiperJS --- */
    $(".swiper-group-6").each(function () {
        var swiper_6_items = new Swiper(this, {
            spaceBetween: 30,
            slidesPerView: 6,
            spaceBetween: 30,
            slidesPerGroup: 2,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            autoplay: {
                delay: 10000
            },
            breakpoints: {
                1199: {
                    slidesPerView: 6
                },
                800: {
                    slidesPerView: 4
                },
                400: {
                    slidesPerView: 2
                },
                350: {
                    slidesPerView: 2,
                    slidesPerGroup: 1,
                    spaceBetween: 15
                }
            }
        });
    });
    $(".swiper-group-3").each(function () {
        var swiper_3_items = new Swiper(this, {
            spaceBetween: 30,
            slidesPerView: 3,
            spaceBetween: 30,
            slidesPerGroup: 1,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            pagination: {
                el: ".swiper-pagination",
                type: "custom",
                renderCustom: function (swiper, current, total) {
                    var customPaginationHtml = "";
                    for (var i = 0; i < total; i++) {
                        //Determine which pager should be activated at this time
                        if (i == current - 1) {
                            customPaginationHtml += '<span class="swiper-pagination-customs swiper-pagination-customs-active"></span>';
                        } else {
                            customPaginationHtml += '<span class="swiper-pagination-customs"></span>';
                        }
                    }
                    return customPaginationHtml;
                }
            },
            autoplay: {
                delay: 10000
            },
            breakpoints: {
                1199: {
                    slidesPerView: 3
                },
                800: {
                    slidesPerView: 2
                },
                400: {
                    slidesPerView: 1
                },
                350: {
                    slidesPerView: 1
                }
            }
        });
    });
    $(".swiper-group-2").each(function () {
        var swiper_2_items = new Swiper(this, {
            spaceBetween: 30,
            slidesPerView: 2,
            spaceBetween: 30,
            slidesPerGroup: 1,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            pagination: {
                el: ".swiper-pagination",
                type: "custom",
                renderCustom: function (swiper, current, total) {
                    var customPaginationHtml = "";
                    for (var i = 0; i < total; i++) {
                        //Determine which pager should be activated at this time
                        if (i == current - 1) {
                            customPaginationHtml += '<span class="swiper-pagination-customs swiper-pagination-customs-active"></span>';
                        } else {
                            customPaginationHtml += '<span class="swiper-pagination-customs"></span>';
                        }
                    }
                    return customPaginationHtml;
                }
            },
            autoplay: {
                delay: 10000
            },
            breakpoints: {
                1199: {
                    slidesPerView: 2
                },
                800: {
                    slidesPerView: 1
                },
                600: {
                    slidesPerView: 1
                },
                400: {
                    slidesPerView: 1
                },
                350: {
                    slidesPerView: 1
                }
            }
        });
    });
</script>
