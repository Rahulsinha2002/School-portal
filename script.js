
document.addEventListener("DOMContentLoaded", () => {
  const counters = document.querySelectorAll('.counter');
  const speed = 200;

  counters.forEach(counter => {
    let started = false; // To prevent double-trigger

    const updateCount = () => {
      const target = +counter.getAttribute('data-count');
      let count = +counter.innerText;

      const increment = Math.ceil(target / speed);

      const animate = () => {
        if (count < target) {
          count += increment;
          counter.innerText = count > target ? target : count;
          setTimeout(animate, 20);
        } else {
          counter.innerText = target;
        }
      };

      animate();
    };

    // Observer to trigger when visible
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting && !started) {
          started = true;
          updateCount();
        }
      });
    }, { threshold: 0.7 }); // Adjust if needed

    observer.observe(counter);
  });
});



 



  
  const quotes = [
    {
      sanskrit: "सा विद्या या विमुक्तये।",
      meaning: "That is true education which liberates.",
      source: "– विष्णु पुराण (Vishnu Purana)"
    },
    {
      sanskrit: "विद्या ददाति विनयं।",
      meaning: "Education gives humility.",
      source: "– हितोपदेश (Hitopadesha)"
    },
    {
      sanskrit: "न चौरहार्यं न च राजहार्यं।",
      meaning: "Knowledge cannot be stolen, taken or divided — it's the highest wealth.",
      source: "– नीति श्लोक (Subhashita)"
    },
    {
      sanskrit: "गुरुवाक्यं प्रमाणं।",
      meaning: "The word of the teacher is the ultimate truth.",
      source: "– वेद (Vedas)"
    }
  ];

  let index = 0;

  function rotateQuotes() {
    const sanskritEl = document.getElementById('sanskrit-text');
    const meaningEl = document.getElementById('quote-meaning');
    const sourceEl = document.getElementById('quote-source');

    index = (index + 1) % quotes.length;
    sanskritEl.style.opacity = '0';
    meaningEl.style.opacity = '0';
    sourceEl.style.opacity = '0';

    setTimeout(() => {
      sanskritEl.innerText = quotes[index].sanskrit;
      meaningEl.innerText = quotes[index].meaning;
      sourceEl.innerText = quotes[index].source;

      sanskritEl.style.opacity = '1';
      meaningEl.style.opacity = '1';
      sourceEl.style.opacity = '1';
    }, 500);
  }

  setInterval(rotateQuotes, 6000); // Change every 6 seconds

  function toggleMenu() {
    const navLinks = document.getElementById("navLinks");
    navLinks.classList.toggle("show");
  }

  function toggleDropdown(event, index) {
    event.preventDefault();
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach((item, i) => {
      if (i === index + 1) { // +1 to skip the "Home" nav item
        item.classList.toggle("open");
      } else {
        item.classList.remove("open");
      }
    });
  }


  
  
 

  // Show Terms Modal
  document.getElementById("openTerms").addEventListener("click", function(e) {
    e.preventDefault();
    document.getElementById("termsModal").style.display = "block";
  });

  // Show Privacy Modal
  document.getElementById("openPrivacy").addEventListener("click", function(e) {
    e.preventDefault();
    document.getElementById("privacyModal").style.display = "block";
  });

  // Close Terms Modal
  document.getElementById("closeTerms").addEventListener("click", function() {
    document.getElementById("termsModal").style.display = "none";
  });

  // Close Privacy Modal
  document.getElementById("closePrivacy").addEventListener("click", function() {
    document.getElementById("privacyModal").style.display = "none";
  });

  // Close modals when clicking outside of them
  window.addEventListener("click", function(e) {
    if (e.target === document.getElementById("termsModal")) {
      document.getElementById("termsModal").style.display = "none";
    }
    if (e.target === document.getElementById("privacyModal")) {
      document.getElementById("privacyModal").style.display = "none";
    }
  });

  // Optional: Smooth scroll to top
  document.querySelector('.back-to-top').addEventListener('click', function(e) {
    e.preventDefault();
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  let current = 0;

    function toggleVideo() {
      const slider = document.getElementById('slider');
      const video1 = document.getElementById('video1');
      const video2 = document.getElementById('video2');

      if (current === 0 || current === 2) {
        // Play Video 1
        slider.style.transform = "translateX(0%)";
        video2.pause();
        video2.currentTime = 0;
        video1.play();
        current = 1;
      } else {
        // Play Video 2
        slider.style.transform = "translateX(100%)";
        video1.pause();
        video1.currentTime = 0;
        video2.play();
        current = 2;
      }
    }

    // ❌ Don't autoplay anything on load
    window.onload = () => {
      const video1 = document.getElementById('video1');
      const video2 = document.getElementById('video2');
      video1.pause();
      video2.pause();
    };



    
  