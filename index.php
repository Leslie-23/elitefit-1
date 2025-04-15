<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="EliteFit - Premium fitness center offering personalized training programs, state-of-the-art equipment, and expert coaching.">
    <title>EliteFit - Premium Fitness Center</title>
    <link rel="stylesheet" href="css/indexHome.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">`
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <a href="/elitefit-1/index.php">
                    <img src="assets/images/elitefit-1.jpg" alt="EliteFit Logo">
                </a>
            </div>
            <div class="nav-toggle" id="navToggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-menu">
                <li><a href="#home" class="active">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#membership">Membership</a></li>
                <li><a href="#trainers">Trainers</a></li>
                <li><a href="#testimonials">Testimonials</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="views/login.php" class="nav-btn">Login</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <h1>Fitness for Everyone,  <span> Excellence for <strong>you</strong></span></h1>
                <p>Experience premium fitness with state-of-the-art equipment, expert trainers, and personalized programs designed to help you achieve your fitness goals.<i class="m-txt"> EliteFit isn’t just a gym — it’s a lifestyle revolution.</i></p>
                <div class="hero-btns">
                    <a href="views/register.php" class="btn btn-primary">Get Started</a>
                    <a href="#membership" class="btn btn-secondary">View Plans</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="feature-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-dumbbell"></i>
                    </div>
                    <h3>Modern Equipment</h3>
                    <p>Access to premium, state-of-the-art fitness equipment for all your training needs.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Expert Trainers</h3>
                    <p>Work with certified fitness professionals who will guide your fitness journey.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3>Flexible Classes</h3>
                    <p>Choose from a variety of classes that fit your schedule and fitness goals.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>Wellness Programs</h3>
                    <p>Comprehensive wellness programs focusing on nutrition, recovery, and mental health.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="about">
        <div class="container">
            <div class="section-header">
                <h2>About EliteFit</h2>
                <p><i>"Where fitness meets excellence"</i></p>
            </div>
            <div class="about-content">
                <div class="about-image">
                    <img src="assets/images/about-gym.jpg" alt="EliteFit Gym Interior">
                </div>
                <div class="about-text">
                    <h3>Your Premium Fitness Destination</h3>
                    <p>Founded in 2015, EliteFit has grown to become the leading fitness center focused on delivering exceptional results through personalized training and premium facilities.</p>
                    <p>Our mission is to empower individuals to achieve their fitness goals in a supportive, motivating environment with access to the best equipment and expert guidance.</p>
                    <ul class="about-features">
                        <li><i class="fas fa-check"></i> 24/7 Access</li>
                        <li><i class="fas fa-check"></i> Personal Training</li>
                        <li><i class="fas fa-check"></i> Nutrition Counseling</li>
                        <li><i class="fas fa-check"></i> Group Classes</li>
                        <li><i class="fas fa-check"></i> Recovery Zone</li>
                        <li><i class="fas fa-check"></i> Mobile App</li>
                    </ul>
                    <a href="#contact" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="services">
        <div class="container">
            <div class="section-header">
                <h2>Our Services</h2>
                <p><i>"Comprehensive fitness solutions for everyone"</i></p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <img src="https://images.unsplash.com/photo-1529516548873-9ce57c8f155e?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cHBlcnNvbmFsJTIwdHJhaW5pbmd8ZW58MHx8MHx8fDA%3D" alt="Personal Training">
                    <div class="service-content">
                        <h3>Personal Training</h3>
                        <p>One-on-one sessions with certified trainers tailored to your specific goals and fitness level.</p>
                        <a href="#" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="service-card">
                    <img src="https://plus.unsplash.com/premium_photo-1726098080905-982e83fbf157?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fHBlcnNvbmFsJTIwdHJhaW5pbmclMjBneW0lMjBncm91cHxlbnwwfHwwfHx8MA%3D%3D" alt="Group Classes">
                    <div class="service-content">
                        <h3>Group Classes</h3>
                        <p>Energetic, instructor-led classes including HIIT, yoga, cycling, and more for all fitness levels.</p>
                        <a href="#" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="service-card">
                    <img src="https://images.unsplash.com/photo-1546069901-d5bfd2cbfb1f?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fGhlYWx0aHklMjBtZWFsfGVufDB8fDB8fHww" alt="Nutrition Coaching">
                    <div class="service-content">
                        <h3>Nutrition Coaching</h3>
                        <p>Expert guidance on nutrition to complement your fitness routine and maximize results.</p>
                        <a href="#" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <!-- <div class="service-card">
                    <img src="" alt="Recovery Services">
                    <div class="service-content">
                        <h3>Personal Coaching Services</h3>
                        <p>Specialized recovery treatments including massage therapy, stretching, and cryotherapy.</p>
                        <a href="#" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div> -->
                <div class="service-card">
                    <img src="https://plus.unsplash.com/premium_photo-1661729642842-d074c4bc30cb?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fGJsYWNrJTIwcmVjb3ZlcnklMjB0aGVyYXB5fGVufDB8fDB8fHww" alt="Recovery Services">
                    <div class="service-content">
                        <h3>Recovery Services</h3>
                        <p>Specialized recovery treatments including massage therapy, stretching, and cryotherapy.</p>
                        <a href="#" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Membership Section -->
    <section class="membership" id="membership">
        <div class="container">
            <div class="section-header">
                <h2>Membership Plans</h2>
                <p><i>"Find the <b>perfect plan</b> for your fitness journey"</i></p>
            </div>
            <div class="pricing-grid">
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3>Basic</h3>
                        <div class="price">
                            <span class="currency">$</span>
                            <span class="amount">49</span>
                            <span class="period">/month</span>
                        </div>
                    </div>
                    <div class="pricing-features">
                        <ul>
                            <li><i class="fas fa-check"></i> Gym Access (6AM-10PM)</li>
                            <li><i class="fas fa-check"></i> Basic Equipment</li>
                            <li><i class="fas fa-check"></i> 2 Group Classes/Month</li>
                            <li><i class="fas fa-check"></i> Fitness Assessment</li>
                            <li class="not-included"><i class="fas fa-times"></i> Personal Training</li>
                            <li class="not-included"><i class="fas fa-times"></i> Nutrition Coaching</li>
                        </ul>
                    </div>
                    <div class="pricing-footer">
                        <a href="views/register.php" class="btn btn-outline">Choose Plan</a>
                    </div>
                </div>
                <div class="pricing-card featured">
                    <div class="pricing-badge">Popular</div>
                    <div class="pricing-header">
                        <h3>Premium</h3>
                        <div class="price">
                            <span class="currency">$</span>
                            <span class="amount">89</span>
                            <span class="period">/month</span>
                        </div>
                    </div>
                    <div class="pricing-features">
                        <ul>
                            <li><i class="fas fa-check"></i> 24/7 Gym Access</li>
                            <li><i class="fas fa-check"></i> All Equipment</li>
                            <li><i class="fas fa-check"></i> Unlimited Group Classes</li>
                            <li><i class="fas fa-check"></i> Advanced Fitness Assessment</li>
                            <li><i class="fas fa-check"></i> 2 Personal Training Sessions/Month</li>
                            <li class="not-included"><i class="fas fa-times"></i> Nutrition Coaching</li>
                        </ul>
                    </div>
                    <div class="pricing-footer">
                        <a href="views/register.php" class="btn btn-primary">Choose Plan</a>
                    </div>
                </div>
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3>Elite</h3>
                        <div class="price">
                            <span class="currency">$</span>
                            <span class="amount">149</span>
                            <span class="period">/month</span>
                        </div>
                    </div>
                    <div class="pricing-features">
                        <ul>
                            <li><i class="fas fa-check"></i> 24/7 Gym Access</li>
                            <li><i class="fas fa-check"></i> All Equipment & Amenities</li>
                            <li><i class="fas fa-check"></i> Unlimited Group Classes</li>
                            <li><i class="fas fa-check"></i> Comprehensive Fitness Assessment</li>
                            <li><i class="fas fa-check"></i> 4 Personal Training Sessions/Month</li>
                            <li><i class="fas fa-check"></i> Monthly Nutrition Consultation</li>
                        </ul>
                    </div>
                    <div class="pricing-footer">
                        <a href="views/register.php" class="btn btn-outline">Choose Plan</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trainers Section -->
    <section class="trainers" id="trainers">
        <div class="container">
            <div class="section-header">
                <h2>Meet Our Trainers</h2>
                <p><i>"Expert guidance from <b>certified professionals"</b> </i></p>
            </div>
            <div class="trainers-grid">
                <div class="trainer-card">
                    <div class="trainer-img">
                        <img src="https://images.unsplash.com/photo-1596079306903-9164c205f400?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8YmxhY2slMjBneW0lMjBjb2FjaHxlbnwwfHwwfHx8MA%3D%3D" alt="Trainer Michael Johnson">
                        <div class="trainer-social">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="trainer-info">
                        <h3>Michael Johnson</h3>
                        <p class="trainer-role">Strength & Conditioning</p>
                        <p class="trainer-desc">10+ years experience specializing in strength training and athletic performance.</p>
                    </div>
                </div>
                <div class="trainer-card">
                    <div class="trainer-img">
                        <img src="https://plus.unsplash.com/premium_photo-1725983651130-40bc371d5843?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8eW9nYSUyMGNvYWNoJTIwYWxvbmV8ZW58MHx8MHx8fDA%3D" alt="Trainer Sarah Williams">
                        <div class="trainer-social">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="trainer-info">
                        <h3>Sarah Williams</h3>
                        <p class="trainer-role">Yoga & Flexibility</p>
                        <p class="trainer-desc">Certified yoga instructor with expertise in mobility and mind-body connection.</p>
                    </div>
                </div>
                <div class="trainer-card">
                    <div class="trainer-img">
                        <img src="https://plus.unsplash.com/premium_photo-1666299820120-2da9cbff078b?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8YXNpYW4lMjBudXRyaXRpb24lMjBjb2FjaHxlbnwwfHwwfHx8MA%3D%3D" alt="Trainer David Chen">
                        <div class="trainer-social">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="trainer-info">
                        <h3>David Chen</h3>
                        <p class="trainer-role">Nutrition & Weight Loss</p>
                        <p class="trainer-desc">Nutritionist and trainer specializing in sustainable weight management programs.</p>
                    </div>
                </div>
                <div class="trainer-card">
                    <div class="trainer-img">
                        <img src="https://images.unsplash.com/photo-1584380931214-dbb5b72e7fd0?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fGZlbWFsZSUyMHN0cmVuZ3RoJTIwY29hY2h8ZW58MHx8MHx8fDA%3D" alt="Trainer Jessica Martinez">
                        <div class="trainer-social">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="trainer-info">
                        <h3>Jessica Martinez</h3>
                        <p class="trainer-role">HIIT & Cardio</p>
                        <p class="trainer-desc">Energy-focused trainer specializing in high-intensity interval training and cardio workouts.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials" id="testimonials">
        <div class="container">
            <div class="section-header">
                <h2>Success Stories</h2>
                <p>What our members say about us</p>
            </div>
            <div class="testimonial-slider">
                <div class="testimonial-card">
                    <div class="testimonial-img">
                        <img src="https://images.unsplash.com/photo-1541657333963-d31b55f58de1?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8bGFkeSUyMGhlYWRzaG90c3xlbnwwfHwwfHx8MA%3D%3D" alt="Client Testimonial">
                    </div>
                    <div class="testimonial-content">
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">"EliteFit completely transformed my approach to fitness. The trainers are exceptional and the facilities are top-notch. I've lost 30 pounds and gained confidence I never thought possible."</p>
                        <div class="testimonial-author">
                            <h4>Jennifer K.</h4>
                            <p>Member for 1 year</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-img">
                        <img src="https://media.istockphoto.com/id/1873081935/photo/mature-man-studio-portrait.webp?a=1&b=1&s=612x612&w=0&k=20&c=yghXGaSJH-NADAsVm4BFiVU_pg35U5p-jp1VajhcmXE=" alt="Client Testimonial">
                    </div>
                    <div class="testimonial-content">
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">"As a busy professional, I needed a gym that could accommodate my schedule. EliteFit's 24/7 access and variety of classes have made it easy to stay consistent with my fitness routine."</p>
                        <div class="testimonial-author">
                            <h4>Robert T.</h4>
                            <p>Member for 2 years</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-img">
                        <img src="https://media.istockphoto.com/id/2167472497/photo/close-up-portrait-of-a-happy-mature-businessman.webp?a=1&b=1&s=612x612&w=0&k=20&c=gxGGloXOxCDJ0r4jLNh863KmH95MGZSAzrvNUy3ZOiE=" alt="Client Testimonial">
                    </div>
                    <div class="testimonial-content">
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p class="testimonial-text">"The nutrition coaching at EliteFit was the missing piece in my fitness journey. I've not only built muscle but also learned how to fuel my body properly for optimal performance."</p>
                        <div class="testimonial-author">
                            <h4>Marcus L.</h4>
                            <p>Member for 8 months</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testimonial-controls">
                <button class="testimonial-prev"><i class="fas fa-chevron-left"></i></button>
                <button class="testimonial-next"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to Start Your Fitness Journey?</h2>
                <p>Join EliteFit today and take the first step toward a healthier, stronger you.</p>
                <div class="cta-buttons">
                    <a href="views/register.php" class="btn btn-primary">Get Started</a>
                    <a href="#contact" class="btn btn-secondary">Contact Us</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="container">
            <div class="section-header">
                <h2>Contact Us</h2>
                <p>We're here to answer your questions</p>
            </div>
            <div class="contact-content">
                <div class="contact-info">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Our Location</h3>
                            <p>86 Spintex Rd<br>00233 - Accra, GH</p>
                        </div>
                    </div>
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Phone Number</h3>
                            <p>(027) 123-4567</p>
                        </div>
                    </div>
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Email Address</h3>
                            <a  href="mailto:seunpaul003@example.com" >info@elitefit.com</a>
                        </div>
                    </div>
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Working Hours</h3>
                            <p>Monday - Friday: 5AM - 11PM<br>Saturday - Sunday: 7AM - 9PM</p>
                        </div>
                    </div>
                </div>
                <div class="contact-form">
    <form id="contact-form">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required />
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required />
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" />
        </div>
        <div class="form-group">
            <label for="subject">Subject</label>
            <select id="subject" name="subject">
                <option value="membership">Membership Inquiry</option>
                <option value="training">Personal Training</option>
                <option value="classes">Group Classes</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
</div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map">
        <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d254172.46490891826!2d-0.2817812719123927!3d5.594365641147003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfdf9084b2b7a773%3A0xbed14ed8650e2dd3!2sAccra%2C%20Ghana!5e0!3m2!1sen!2sus!4v1711095574961!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="assets/images/elitefit-1.jpg" alt="EliteFit Logo">
                    <p>Your premium fitness destination for transformation and excellence.</p>
                    <div class="social-links">
                        <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://x.com" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="footer-links">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#membership">Membership</a></li>
                        <li><a href="#trainers">Trainers</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h3>Services</h3>
                    <ul>
                        <li><a href="#">Personal Training</a></li>
                        <li><a href="#">Group Classes</a></li>
                        <li><a href="#">Nutrition Coaching</a></li>
                        <li><a href="#">Recovery Services</a></li>
                        <li><a href="#">Fitness Assessment</a></li>
                    </ul>
                </div>
                <div class="footer-newsletter">
                    <h3>Newsletter</h3>
                    <p>Subscribe to our newsletter for fitness tips, promotions, and updates.</p>
                    <form action="process/subscribe.php" method="POST" class="newsletter-form">
                        <input type="email" name="email" placeholder="Your email address" required>
                        <button type="submit"><i class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="copyright">
                    <p>&copy; 2023 EliteFit. All Rights Reserved.</p>
                </div>
                <div class="footer-bottom-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top" id="backToTop">
        <i class="fas fa-chevron-up"></i>
    </a>

    <!-- JavaScript -->
    <script src="js/index.js">

    </script>
    <script type="text/javascript" src="https://cdn.emailjs.com/dist/email.min.js"></script>
<script type="text/javascript">
    (function () {
        emailjs.init("kIdiDjEag_qr60aRX"); // Replace with your actual EmailJS user ID
    })();

    document.getElementById('contact-form').addEventListener('submit', function (e) {
        e.preventDefault();

        emailjs.sendForm('service_r3x2arl', 'template_3s06bzm', this)
            .then(function () {
                alert("Message sent successfully!");
                document.getElementById('contact-form').reset();
            }, function (error) {
                console.error("Failed to send message:", error);
                alert("An error occurred while sending the message. Please try again.");
            });
    });
</script>
</body>
</html>