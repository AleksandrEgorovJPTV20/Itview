setTimeout(function() {
    var loadingAnimation = document.getElementById('loading-animation');
    loadingAnimation.style.opacity = '0';
    loadingAnimation.style.transform = 'translateY(100%)'; /* Added translateY transform */
    setTimeout(function() {
        loadingAnimation.style.display = 'none';
    }, 500);
}, 1200);