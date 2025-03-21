document.addEventListener("DOMContentLoaded", function () {
  console.log("EliteFit Gym - JavaScript Loaded!");

  // Handle form submission validation
  const form = document.querySelector("form");
  if (form) {
    form.addEventListener("submit", function (event) {
      const password = document.querySelector(
        "input[name='user_password']"
      ).value;
      if (password.length < 8) {
        alert("Password must be at least 8 characters long.");
        event.preventDefault();
      }
    });
  }
});

function toggleSidebar() {
  document.querySelector(".sidebar").classList.toggle("collapsed");
}





// Navigation Toggle
const navToggle = document.getElementById('navToggle');
const navMenu = document.querySelector('.nav-menu');

if (navToggle) {
  navToggle.addEventListener('click', () => {
    navMenu.classList.toggle('active');
    navToggle.classList.toggle('active');
  });
}

// Smooth Scrolling for Anchor Links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function(e) {
    e.preventDefault();
    
    if (this.getAttribute('href') === '#') return;
    
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      // Close mobile menu if open
      if (navMenu.classList.contains('active')) {
        navMenu.classList.remove('active');
        navToggle.classList.remove('active');
      }
      
      window.scrollTo({
        top: target.offsetTop - 70, // Adjust for fixed header
        behavior: 'smooth'
      });
    }
  });
});

// Active Navigation Link on Scroll
const sections = document.querySelectorAll('section[id], header[id]');
const navLinks = document.querySelectorAll('.nav-menu a');

window.addEventListener('scroll', () => {
  let current = '';
  
  sections.forEach(section => {
    const sectionTop = section.offsetTop - 100;
    const sectionHeight = section.offsetHeight;
    
    if (pageYOffset >= sectionTop && pageYOffset < sectionTop + sectionHeight) {
      current = section.getAttribute('id');
    }
  });
  
  navLinks.forEach(link => {
    link.classList.remove('active');
    if (link.getAttribute('href') === `#${current}`) {
      link.classList.add('active');
    }
  });
});

// Testimonial Slider
const testimonialSlider = document.querySelector('.testimonial-slider');
const testimonialPrev = document.querySelector('.testimonial-prev');
const testimonialNext = document.querySelector('.testimonial-next');
const testimonialCards = document.querySelectorAll('.testimonial-card');

if (testimonialSlider && testimonialPrev && testimonialNext) {
  let currentIndex = 0;
  const cardWidth = testimonialSlider.offsetWidth;
  
  // Set initial position
  testimonialSlider.scrollLeft = 0;
  
  testimonialNext.addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % testimonialCards.length;
    testimonialSlider.scrollTo({
      left: currentIndex * cardWidth,
      behavior: 'smooth'
    });
  });
  
  testimonialPrev.addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + testimonialCards.length) % testimonialCards.length;
    testimonialSlider.scrollTo({
      left: currentIndex * cardWidth,
      behavior: 'smooth'
    });
  });
}

// Back to Top Button
const backToTopBtn = document.getElementById('backToTop');

if (backToTopBtn) {
  window.addEventListener('scroll', () => {
    if (window.pageYOffset > 300) {
      backToTopBtn.classList.add('active');
    } else {
      backToTopBtn.classList.remove('active');
    }
  });
  
  backToTopBtn.addEventListener('click', (e) => {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
}

// Form Validation
const contactForm = document.querySelector('.contact-form form');

if (contactForm) {
  contactForm.addEventListener('submit', (e) => {
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const messageInput = document.getElementById('message');
    let isValid = true;
    
    // Simple validation
    if (!nameInput.value.trim()) {
      isValid = false;
      nameInput.style.borderColor = 'red';
    } else {
      nameInput.style.borderColor = '';
    }
    
    if (!emailInput.value.trim() || !isValidEmail(emailInput.value)) {
      isValid = false;
      emailInput.style.borderColor = 'red';
    } else {
      emailInput.style.borderColor = '';
    }
    
    if (!messageInput.value.trim()) {
      isValid = false;
      messageInput.style.borderColor = 'red';
    } else {
      messageInput.style.borderColor = '';
    }
    
    if (!isValid) {
      e.preventDefault();
      alert('Please fill in all required fields correctly.');
    }
  });
}

// Email validation helper
function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

// Animate on scroll
window.addEventListener('scroll', () => {
  const elements = document.querySelectorAll('.feature-card, .service-card, .pricing-card, .trainer-card');
  
  elements.forEach(element => {
    const elementPosition = element.getBoundingClientRect().top;
    const screenPosition = window.innerHeight / 1.3;
    
    if (elementPosition < screenPosition) {
      element.style.opacity = '1';
      element.style.transform = 'translateY(0)';
    }
  });
});

// Initialize animations
document.addEventListener('DOMContentLoaded', () => {
  // Add initial opacity and transform to elements for animation
  const animatedElements = document.querySelectorAll('.feature-card, .service-card, .pricing-card, .trainer-card');
  
  animatedElements.forEach(element => {
    element.style.opacity = '0';
    element.style.transform = 'translateY(20px)';
    element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
  });
  
  // Trigger initial scroll to show elements in viewport
  window.dispatchEvent(new Event('scroll'));
});