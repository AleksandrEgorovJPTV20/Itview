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

  // Adjust font size and line height for responsiveness
  window.addEventListener('resize', function () {
      adjustTextSize();
  });

  function adjustTextSize() {
      var screenWidth = window.innerWidth;

      if (screenWidth < 768) { // Adjust the breakpoint as needed
          element.style.fontSize = '21px'; // Set the desired font size for smaller screens
          element.style.lineHeight = '1.5'; // Set the desired line height
      } else {
          element.style.fontSize = '24px'; // Set the default font size for larger screens
          element.style.lineHeight = '1.2'; // Set the default line height
      }
  }

  // Initial adjustment
  adjustTextSize();
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