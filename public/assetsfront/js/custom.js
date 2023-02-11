// NAVIGATION
initializeStellarNav(1, "#main-nav");
function initializeStellarNav(index, element) {
    $(element).stellarNav({
        breakpoint: 1023,
        position: "left",
    });
}

$(".like-imgss").click(function () {
    var like = $(this);
    var counter = $(this).find(".like-count").text();
    if (like.hasClass("active")) {
        counter = --counter;
        like.find(".like-count").text(counter);
        like.removeClass("active");
    } else {
        like.addClass("active");
        counter = ++counter;
        like.find(".like-count").text(counter);
    }

    // if(like.hasClass("active")) {
    //  alert("like");
    //   counter = --counter;
    //   console.log(counter)
    //   $(this).find(".like-count").text(counter);
    //   like.removeClass("active");
    // }
});

//STORY SLIDER
var swiper = new Swiper(".story-slider", {
    slidesPerView: "auto",
    centeredSlides: false,
    loop: true,
    freeMode: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    autoplay: {
        delay: 3000,
        disableOnInteraction: true,
    },
    breakpoints: {
        320: {
            spaceBetween: 10,
        },
        1600: {
            spaceBetween: 25,
        },
    },
});

//DASHBOARD BAR CHART

var ctx = document.querySelectorAll(".custome-chart");
ctx.forEach(function (ct) {
    ct.getContext("2d");
    var myChart = new Chart(ct, {
        type: "bar",
        responsive: true,
        maintainAspectRatio: false,
        data: {
            labels: [
                "Jan",
                "Feb",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ],
            datasets: [
                {
                    label: "# of Votes",
                    data: [3, 5, 6, 4, 7, 6, 8, 5, 6, 5, 4, 8],
                    backgroundColor: [
                        "#085684",
                        "#085684",
                        "#503e64",
                        "#085684",
                        "#8d2b49",
                        "#e32024",
                        "#f3301e",
                        "#fd5b1c",
                        "#fe871c",
                        "#ff8f1c",
                        "#ff8f1c",
                        "#ff8f1c",
                    ],
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
});

//DASHBOARD PIE CHART
var ctx = document.querySelectorAll(".custome-chart-2");
ctx.forEach(function (ct) {
    ct.getContext("2d");
    var myChart = new Chart(ct, {
        type: "pie",
        responsive: true,
        maintainAspectRatio: true,
        data: {
            labels: ["Jan", "Feb", "March", "April", "May"],
            datasets: [
                {
                    label: "# of Votes",
                    data: [49, 39, 38, 10, 15],
                    backgroundColor: [
                        "#00a2ff",
                        "#00efff",
                        "#ffd200",
                        "#ff7d00",
                        "#ff4e00",
                    ],
                },
            ],
        },
    });
});

$(document).ready(function () {
    //CHAT BUTTON

    $(".agent-chat-btn").click(function () {
        $(".right-chat-box").toggleClass("active");
        $(this).toggleClass("active");
    });

    $(".chat-close").click(function () {
        $(".right-chat-box").removeClass("active");
        $(this).removeClass("active");
    });

    $("#chat-attachments").click(function (e) {
        e.preventDefault();
        $(".attachment-box").toggleClass("active");
    });

    // SIDE BAR

    $(".side-bar-toggle-btn").click(function () {
        $(".dashboard-left-col").toggleClass("active");
    });

    //TOGGLE ICON REMOVE SIDE BAR

    $(".menu-toggle").click(function () {
        $(".dashboard-left-col").removeClass("active");
    });

    // OTP INPUTS

    $(".digit-group")
        .find("input")
        .each(function () {
            $(this).attr("maxlength", 1);
            $(this).on("keyup", function (e) {
                var parent = $($(this).parent());

                if (e.keyCode === 8 || e.keyCode === 37) {
                    var prev = parent.find("input#" + $(this).data("previous"));

                    if (prev.length) {
                        $(prev).select();
                    }
                } else if (
                    (e.keyCode >= 48 && e.keyCode <= 57) ||
                    (e.keyCode >= 65 && e.keyCode <= 90) ||
                    (e.keyCode >= 96 && e.keyCode <= 105) ||
                    e.keyCode === 39
                ) {
                    var next = parent.find("input#" + $(this).data("next"));

                    if (next.length) {
                        $(next).select();
                    } else {
                        if (parent.data("autosubmit")) {
                            parent.submit();
                        }
                    }
                }
            });
        });
});

// // POST PARAGRAPH expanded

$(document).ready(function () {
    $(".expanded").hide();

    $(".expanded a, .collapsed a").click(function (eve) {
        eve.preventDefault();
        $(".expanded, .collapsed").toggle();
    });

    // See More Toggle

    $(".see-more-btn").click(function (e) {
        e.preventDefault();
        $(this).find(".other-options").toggleClass("active");
        e.stopPropagation();
    });
    $(".see-more-btn .other-options").click(function (e) {
        e.stopPropagation();
    });

    // Comment Body Expend

    $(".comment-expend").click(function () {
        $(this).closest(".user-post-wrap").toggleClass("active");
    });
});
