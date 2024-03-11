var swiper = new Swiper(".slide-content", {
    slidesPerView: 5,
    spaceBetween: 25,
    preventClicks: true,
    allowTouchMove: false,
    noSwiping: true,   
    followFinger: false, 
    watchSlidesProgress: false, 
    loop: false,
    centerSlide: true,
    fade: true,
    grabCursor: true,
    slideToClickedSlide: false,
    allowClick: false,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      dynamicBullets: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints:{
        0: {
            slidesPerView: 1,
            allowTouchMove: true,   
            noSwiping: false, 
        },
        520: {
            slidesPerView: 2,
            allowTouchMove: false,
            noSwiping: true,        
        },
        950: {
            slidesPerView: 3,
            allowTouchMove: false,
            noSwiping: true,    
        },
        1150: {
            slidesPerView: 4,
            allowTouchMove: false,
            noSwiping: true,    
        },
        1350: {
            slidesPerView: 5,
            allowTouchMove: false,  
            noSwiping: true,   
        },
    },
  });