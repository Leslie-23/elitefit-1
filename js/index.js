/**
 * EliteFit Gym - Main JavaScript
 * This file handles all interactive functionality for the EliteFit landing page
 */

document.addEventListener("DOMContentLoaded", function () {
  // DOM Elements
  const navToggle = document.getElementById("navToggle");
  const navMenu = document.querySelector(".nav-menu");
  const navbar = document.querySelector(".navbar");
  const backToTopBtn = document.getElementById("backToTop");
  const testimonialPrev = document.querySelector(".testimonial-prev");
  const testimonialNext = document.querySelector(".testimonial-next");
  const testimonialSlider = document.querySelector(".testimonial-slider");
  const navLinks = document.querySelectorAll(".nav-menu a");

  // ===== Mobile Menu Toggle =====
  if (navToggle) {
    navToggle.addEventListener("click", function () {
      navToggle.classList.toggle("active");
      navMenu.classList.toggle("active");
    });
  }

  // Close mobile menu when clicking on a nav link
  navLinks.forEach((link) => {
    link.addEventListener("click", function () {
      navToggle.classList.remove("active");
      navMenu.classList.remove("active");
    });
  });

  // ===== Navbar Scroll Effect =====
  function handleScroll() {
    // Add 'scrolled' class to navbar when scrolling down
    if (window.scrollY > 50) {
      navbar.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled");
    }

    // Show/hide back to top button
    if (window.scrollY > 500) {
      backToTopBtn.classList.add("active");
    } else {
      backToTopBtn.classList.remove("active");
    }

    // Add active class to nav links based on scroll position
    const scrollPosition = window.scrollY + 100;

    // Get all sections with IDs
    document.querySelectorAll("section[id]").forEach((section) => {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.offsetHeight;
      const sectionId = section.getAttribute("id");

      if (
        scrollPosition >= sectionTop &&
        scrollPosition < sectionTop + sectionHeight
      ) {
        document
          .querySelector(`.nav-menu a[href*="#${sectionId}"]`)
          ?.classList.add("active");
      } else {
        document
          .querySelector(`.nav-menu a[href*="#${sectionId}"]`)
          ?.classList.remove("active");
      }
    });
  }

  // Add scroll event listener
  window.addEventListener("scroll", handleScroll);

  // Call once on page load to set initial state
  handleScroll();

  // ===== Back to Top Button =====
  if (backToTopBtn) {
    backToTopBtn.addEventListener("click", function (e) {
      e.preventDefault();
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    });
  }

  // ===== Testimonial Slider =====
  let currentSlide = 0;
  const testimonialCards = document.querySelectorAll(".testimonial-card");

  if (testimonialCards.length > 0) {
    // Initialize slider
    updateSlider();

    // Previous button
    if (testimonialPrev) {
      testimonialPrev.addEventListener("click", function () {
        currentSlide =
          currentSlide > 0 ? currentSlide - 1 : testimonialCards.length - 1;
        updateSlider();
      });
    }

    // Next button
    if (testimonialNext) {
      testimonialNext.addEventListener("click", function () {
        currentSlide =
          currentSlide < testimonialCards.length - 1 ? currentSlide + 1 : 0;
        updateSlider();
      });
    }

    // Auto slide every 5 seconds
    setInterval(function () {
      currentSlide =
        currentSlide < testimonialCards.length - 1 ? currentSlide + 1 : 0;
      updateSlider();
    }, 5000);
  }

  // Update slider position
  function updateSlider() {
    if (testimonialSlider) {
      testimonialSlider.scrollTo({
        left: testimonialCards[currentSlide].offsetLeft,
        behavior: "smooth",
      });
    }
  }

  // ===== Smooth Scrolling for Anchor Links =====
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      // Skip if it's the back to top button (already handled)
      if (
        this.getAttribute("href") === "#" &&
        this.classList.contains("back-to-top")
      ) {
        return;
      }

      const targetId = this.getAttribute("href");

      // Skip if the href is just "#" with no specific target
      if (targetId === "#") {
        return;
      }

      e.preventDefault();

      const targetElement = document.querySelector(targetId);

      if (targetElement) {
        // Calculate offset to account for fixed navbar
        const navbarHeight = navbar.offsetHeight;
        const targetPosition = targetElement.offsetTop - navbarHeight;

        window.scrollTo({
          top: targetPosition,
          behavior: "smooth",
        });
      }
    });
  });

  // ===== Animation on Scroll =====
  // Add fade-in class to elements as they come into view
  const animateElements = document.querySelectorAll(
    ".feature-card, .service-card, .pricing-card, .trainer-card, .contact-card"
  );

  function checkIfInView() {
    const windowHeight = window.innerHeight;
    const windowTopPosition = window.scrollY;
    const windowBottomPosition = windowTopPosition + windowHeight;

    animateElements.forEach((element) => {
      const elementHeight = element.offsetHeight;
      const elementTopPosition = element.offsetTop;
      const elementBottomPosition = elementTopPosition + elementHeight;

      // Check if element is in viewport
      if (
        elementBottomPosition >= windowTopPosition &&
        elementTopPosition <= windowBottomPosition
      ) {
        element.classList.add("fade-in");
      }
    });
  }

  // Run on scroll and once on page load
  window.addEventListener("scroll", checkIfInView);
  checkIfInView();

  // ===== Form Validation =====
  const contactForm = document.querySelector(".contact-form form");

  if (contactForm) {
    contactForm.addEventListener("submit", function (e) {
      let isValid = true;
      const nameInput = document.getElementById("name");
      const emailInput = document.getElementById("email");
      const messageInput = document.getElementById("message");

      // Simple validation
      if (nameInput && nameInput.value.trim() === "") {
        isValid = false;
        showError(nameInput, "Please enter your name");
      } else if (nameInput) {
        removeError(nameInput);
      }

      if (emailInput) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailInput.value.trim() === "") {
          isValid = false;
          showError(emailInput, "Please enter your email");
        } else if (!emailRegex.test(emailInput.value.trim())) {
          isValid = false;
          showError(emailInput, "Please enter a valid email");
        } else {
          removeError(emailInput);
        }
      }

      if (messageInput && messageInput.value.trim() === "") {
        isValid = false;
        showError(messageInput, "Please enter your message");
      } else if (messageInput) {
        removeError(messageInput);
      }

      if (!isValid) {
        e.preventDefault();
      }
    });
  }

  // Show error message
  function showError(input, message) {
    const formGroup = input.parentElement;
    let errorElement = formGroup.querySelector(".error-message");

    if (!errorElement) {
      errorElement = document.createElement("div");
      errorElement.className = "error-message";
      errorElement.style.color = "var(--danger)";
      errorElement.style.fontSize = "0.85rem";
      errorElement.style.marginTop = "5px";
      formGroup.appendChild(errorElement);
    }

    input.style.borderColor = "var(--danger)";
    errorElement.textContent = message;
  }

  // Remove error message
  function removeError(input) {
    const formGroup = input.parentElement;
    const errorElement = formGroup.querySelector(".error-message");

    if (errorElement) {
      formGroup.removeChild(errorElement);
    }

    input.style.borderColor = "";
  }

  // ===== Newsletter Form Validation =====
  const newsletterForm = document.querySelector(".newsletter-form");

  if (newsletterForm) {
    newsletterForm.addEventListener("submit", function (e) {
      const emailInput = this.querySelector('input[type="email"]');

      if (emailInput) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (
          emailInput.value.trim() === "" ||
          !emailRegex.test(emailInput.value.trim())
        ) {
          e.preventDefault();
          emailInput.style.borderColor = "var(--danger)";
          emailInput.style.backgroundColor = "rgba(220, 53, 69, 0.1)";

          // Reset styles after 3 seconds
          setTimeout(() => {
            emailInput.style.borderColor = "";
            emailInput.style.backgroundColor = "";
          }, 3000);
        }
      }
    });
  }
});
