$(window).on("load", function () {
  $("body").removeClass("overflow");
});
$(document).ready(function () {
  /************************************ Menu ************************************/
  if ($(window).width() <= 767) {
    $(".menu-btn").click(function () {
      $(".header-nav").addClass("active");
      $("body").addClass("overflow");
      $(".overlay").fadeIn();
    });
    $(".close-btn,.overlay").click(function () {
      $(".header-nav").removeClass("active");
      $("body").removeClass("overflow");
      $(".overlay").fadeOut();
    });
  }

  /************************************ Search ************************************/
  $(".header-search").click(function () {
    $(".header-search").toggleClass("active");
    $(".search-body").fadeToggle();
  });
  /************************************ Main Slider ************************************/
  var mainSwiper = new Swiper(".main-slider .swiper", {
    a11y: {
      enabled: false,
    },
    spaceBetween: 10,
    loop: true,
    pagination: {
      el: ".main-slider .slider-pagination",
      clickable: true,
    },
  });

  /************************************ Projects Slider ************************************/
  var projectsSwiper = new Swiper(".projects-slider .swiper", {
    a11y: {
      enabled: false,
    },
    loop: true,
    breakpoints: {
      0: {
        slidesPerView: 1,
        spaceBetween: 15,
      },
      767: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      992: {
        slidesPerView: 3,
        spaceBetween: 10,
      },
      1199: {
        slidesPerView: 3,
        spaceBetween: 25,
      },
      1499: {
        slidesPerView: 3,
        spaceBetween: 41,
      },
    },
    navigation: {
      nextEl: ".projects-slider .swiper-btn-next",
      prevEl: ".projects-slider .swiper-btn-prev",
    },
    pagination: {
      el: ".projects-slider .slider-pagination",
      clickable: true,
    },
  });

  /************************************ Statistics ************************************/
  var a = 0;
  $(window).scroll(function () {
    if ($("section").hasClass("statistics-section")) {
      if (
        a == 0 &&
        $(this).scrollTop() >= $(".statistics-section").offset().top - 500
      ) {
        $(".statistics-item .value span").each(function () {
          $(this)
            .prop("Counter", 0)
            .animate(
              {
                Counter: $(this).text(),
              },
              {
                duration: 1000,
                easing: "swing",
                step: function (now) {
                  $(this).text(Math.ceil(now));
                },
              }
            );
        });
        a++;
      }
    }
  });

  /************************************ Fields Slider ************************************/
  var fieldsSwiper = new Swiper(".fields-slider .swiper", {
    a11y: {
      enabled: false,
    },
    loop: true,
    breakpoints: {
      0: {
        slidesPerView: 1,
        spaceBetween: 15,
      },
      767: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      992: {
        slidesPerView: 3,
        spaceBetween: 10,
      },
      1199: {
        slidesPerView: 3,
        spaceBetween: 25,
      },
      1499: {
        slidesPerView: 3,
        spaceBetween: 41,
      },
    },
    pagination: {
      el: ".fields-slider .slider-pagination",
      clickable: true,
    },
  });

  /************************************ Blog Slider ************************************/
  var blogSwiper = new Swiper(".blog-slider .swiper", {
    a11y: {
      enabled: false,
    },
    loop: true,
    breakpoints: {
      0: {
        slidesPerView: 1,
        spaceBetween: 15,
      },
      767: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      992: {
        slidesPerView: 3,
        spaceBetween: 10,
      },
      1199: {
        slidesPerView: 3,
        spaceBetween: 25,
      },
      1499: {
        slidesPerView: 3,
        spaceBetween: 41,
      },
    },
    pagination: {
      el: ".blog-slider .slider-pagination",
      clickable: true,
    },
  });

  /************************************ Blog Slider ************************************/
  $(".filter-btn").click(function () {
    $(".filter-btn").toggleClass("active");
    $(".filter-body").slideToggle();
  });
});
