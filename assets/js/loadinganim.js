  setTimeout(function () {
    var loadingAnimation = document.getElementById('loading-animation');
    loadingAnimation.style.opacity = '0';
    loadingAnimation.style.transform = 'translateY(100%)';

    setTimeout(function () {
      loadingAnimation.style.display = 'none';
    }, 500);
  }, 1200); // Adjust delay based on your loading animation duration
