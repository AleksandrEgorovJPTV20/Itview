function startTypingAnimation() {
    var text = "Unleash Possibilities in the IT Universe!";
    var i = 0;
    var element = document.getElementById('typing-text');
    var cursor = document.querySelector('.typewriter-text::after');

    function typeWriter() {
      if (i < text.length) {
        element.innerHTML += text.charAt(i);
        i++;

        setTimeout(typeWriter, 60); // Adjust typing speed (milliseconds)
      }
    }

    typeWriter();
  }



  setTimeout(function () {
    var loadingAnimation = document.getElementById('loading-animation');
    loadingAnimation.style.opacity = '0';
    loadingAnimation.style.transform = 'translateY(100%)';

    setTimeout(function () {
      loadingAnimation.style.display = 'none';
    }, 500);
    startTypingAnimation(); // Start typing animation
  }, 1200); // Adjust delay based on your loading animation duration