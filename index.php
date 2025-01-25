<?php
require 'config.php';
include 'includes/header.php';
include 'includes/navigation.php';

// Existing task fetching logic remains the same
$tasks = [];
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['role'] === 'admin') {
        $tasks = $pdo->query("SELECT tasks.*, u.name as assigned_to_name, u2.name as assigned_by_name 
            FROM tasks 
            JOIN users u ON tasks.assigned_to = u.id
            JOIN users u2 ON tasks.assigned_by = u2.id")->fetchAll();
    } else {
        $stmt = $pdo->prepare("SELECT tasks.*, u.name as assigned_to_name, u2.name as assigned_by_name 
            FROM tasks 
            JOIN users u ON tasks.assigned_to = u.id
            JOIN users u2 ON tasks.assigned_by = u2.id
            WHERE assigned_to = ?");
        $stmt->execute([$_SESSION['user']['id']]);
        $tasks = $stmt->fetchAll();
    }
}
?>

<div class="enroll-modal" id="enrollModal" aria-labelledby="modal-title" aria-modal="true">
    <div class="modal-content">
        <button class="close-btn" onclick="closeModal()">
            <i class="fas fa-times"></i>
        </button>
        <div class="modal-header">
            <h3 class="modal-title">Enroll in Course</h3>
        </div>
        <form id="enrollmentForm" onsubmit="handleSubmit(event)">
            <div class="form-group">
                <label class="form-label" for="name">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" required
                    placeholder="Enter your full name">
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" required
                    placeholder="Enter your email">
            </div>

            <div class="form-group">
                <label class="form-label" for="phone">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" required
                    placeholder="Enter your phone number">
            </div>

            <div class="form-group">
                <label class="form-label" for="course">Select Course</label>
                <select class="form-select" id="course" name="course" required>
                    <option value="">Choose a course</option>
                    <option value="ai">AI & Machine Learning</option>
                    <option value="web">Web Development</option>
                    <option value="uiux">UI/UX Design</option>
                    <option value="other">Other Courses</option>
                </select>
            </div>

            <button type="submit" class="submit-btn">Submit Application</button>
        </form>
    </div>
</div>


<section class="hero-section" aria-labelledby="hero-title">
    <!-- Navigation -->

    <!-- Hero Container -->
    <div class="hero-container">
        <div class="container">
            <div class="d-flex align-items-center">
                <!-- Hero Content -->
                <div class="hero-content">
                    <div class="hero-badge" aria-hidden="true">
                        <i class="fas fa-star me-2"></i>
                        Trusted by 50,000+ Students Worldwide
                    </div>

                    <h1 class="hero-title">Unlock Your Potential with Expert-Led Education</h1>

                    <p class="hero-description">
                        Transform your future with our comprehensive learning programs. Join a community of ambitious
                        learners and industry-leading instructors.
                    </p>

                    <div class="cta-buttons">
                        <a href="#courses" class="btn btn-primary-custom">Explore Programs</a>
                        <a href="#about-us" class="btn btn-outline-custom">About Us </a>
                    </div>

                    <div class="feature-cards-hero">
                        <div class="feature-card-hero">
                            <div class="icon mb-3">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <h4 class="text-white mb-2">Certified Courses</h4>
                            <p class="text-white-50 mb-0">Industry-recognized certificates</p>
                        </div>
                        <div class="feature-card-hero">
                            <div class="icon mb-3">
                                <i class="fas fa-users"></i>
                            </div>
                            <h4 class="text-white mb-2">Live Sessions</h4>
                            <p class="text-white-50 mb-0">Interactive learning experience</p>
                        </div>
                        <div class="feature-card-hero">
                            <div class="icon mb-3">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h4 class="text-white mb-2">Flexible Schedule</h4>
                            <p class="text-white-50 mb-0">Learn at your own pace</p>
                        </div>
                    </div>
                </div>

                <!-- Hero Image Section -->
                <div class="hero-image-section" aria-label="Students learning in a modern classroom">
                    <div class="hero-image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-section" id="about-us" aria-labelledby="courses-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-badge">About Us</div>
                <h2 class="about-title" aria-labelledby="courses-title">Building Future Leaders Through Quality
                    Education</h2>
                <p class="about-description">
                    At Learn Academy, we combine innovative teaching methodologies with
                    industry expertise to create an immersive learning experience that prepares
                    students for real-world success.
                </p>

                <div class="experience-grid">
                    <div class="experience-item">
                        <div class="experience-number">15K+</div>
                        <div class="experience-text">Active Students</div>
                    </div>
                    <div class="experience-item">
                        <div class="experience-number">200+</div>
                        <div class="experience-text">Expert Teachers</div>
                    </div>
                    <div class="experience-item">
                        <div class="experience-number">98%</div>
                        <div class="experience-text">Success Rate</div>
                    </div>
                </div>

                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-book-reader"></i>
                        </div>
                        <h3 class="feature-title">Quality Education</h3>
                        <p class="feature-text">
                            Comprehensive curriculum designed by industry experts focusing on practical skills.
                        </p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="feature-title">Expert Instructors</h3>
                        <p class="feature-text">
                            Learn from experienced professionals with proven track records.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="features-grid-right">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <h3 class="feature-title">Modern Curriculum</h3>
                        <p class="feature-text">
                            Up-to-date course content aligned with industry standards and future trends.
                        </p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <h3 class="feature-title">Certified Programs</h3>
                        <p class="feature-text">
                            Industry-recognized certifications to boost your career prospects.
                        </p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 class="feature-title">Flexible Learning</h3>
                        <p class="feature-text">
                            Study at your own pace with 24/7 access to course materials.
                        </p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h3 class="feature-title">Career Support</h3>
                        <p class="feature-text">
                            Dedicated career guidance and placement assistance for students.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="courses-section" id="courses" aria-labelledby="section-title-courses">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">Featured Courses</div>
            <h2 class="section-title text-white">Advance Your Career With Our Top Courses</h2>
            <p class="section-subtitle text-white">Choose from our carefully curated selection of premium courses
                designed to help you master the most in-demand skills</p>
        </div>

        <div class="course-grid">
            <!-- Course Card 1 -->
            <div class="course-card">
                <div class="course-image">
                    <img src="assets/full-stack-web-developer.png" alt="Web Development">
                    <span class="course-badge">Most Popular</span>
                </div>
                <div class="course-content">
                    <div class="course-meta">
                        <span class="meta-item">
                            <i class="fas fa-video"></i>
                            75 Lessons
                        </span>
                        <span class="meta-item">
                            <i class="fas fa-signal"></i>
                            Beginner
                        </span>
                    </div>
                    <div class="course-rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="review-count">4.8 (2.2k reviews)</span>
                    </div>
                    <h3 class="course-title">Advanced Full-Stack Web Development</h3>
                    <div class="course-price">
                        $89.99 <small>$199.99</small>
                    </div>
                    <div class="course-actions">
                        <div class="info-item">
                            <i class="far fa-clock"></i>
                            <span>20 Hours</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-certificate"></i>
                            <span>Certificate</span>
                        </div>
                    </div>
                    <button onclick="openModal()" class="enroll-btn">Enroll Now</button>
                </div>
            </div>

            <!-- Course Card 2 -->
            <div class="course-card">
                <div class="course-image">
                    <img src="assets/images.jpeg" alt="Web Development">
                    <span class="course-badge">Most Selling</span>
                </div>
                <div class="course-content">
                    <div class="course-meta">
                        <span class="meta-item">
                            <i class="fas fa-video"></i>
                            75 Lessons
                        </span>
                        <span class="meta-item">
                            <i class="fas fa-signal"></i>
                            Beginner
                        </span>
                    </div>
                    <div class="course-rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="review-count">4.8 (2.2k reviews)</span>
                    </div>
                    <h3 class="course-title">AI and Machine Learning</h3>
                    <div class="course-price">
                        $89.99 <small>$199.99</small>
                    </div>
                    <div class="course-actions">
                        <div class="info-item">
                            <i class="far fa-clock"></i>
                            <span>30 Hours</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-certificate"></i>
                            <span>Certificate</span>
                        </div>
                    </div>
                    <button class="enroll-btn" onclick="openModal()">Enroll Now</button>
                </div>
            </div>

            <!-- Course Card 3 -->
            <div class="course-card">
                <div class="course-image">
                    <img src="assets/ui-ux.jpeg" alt="Web Development">
                    <span class="course-badge">Most Selling</span>
                </div>
                <div class="course-content">
                    <div class="course-meta">
                        <span class="meta-item">
                            <i class="fas fa-video"></i>
                            45 Lessons
                        </span>
                        <span class="meta-item">
                            <i class="fas fa-signal"></i>
                            Beginner
                        </span>
                    </div>
                    <div class="course-rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="review-count">4.8 (2.2k reviews)</span>
                    </div>
                    <h3 class="course-title">Complete UI and UX Proffesional</h3>
                    <div class="course-price">
                        $89.99 <small>$199.99</small>
                    </div>
                    <div class="course-actions">
                        <div class="info-item">
                            <i class="far fa-clock"></i>
                            <span>30 Hours</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-certificate"></i>
                            <span>Certificate</span>
                        </div>
                    </div>
                    <button class="enroll-btn" onclick="openModal()">Enroll Now</button>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testimonial-section">
    <div class="section-header">
        <h2 class="section-title">Student Testimonials</h2>
        <p class="section-subtitle">What our students say about their learning journey</p>
    </div>

    <div class="testimonial-container">
        <button class="nav-button prev-btn">
            <i class="fas fa-chevron-left"></i>
        </button>

        <div class="testimonial-wrapper">
            <div class="testimonial-track">
                <!-- Card 1 -->
                <div class="testimonial-card">
                    <div class="student-profile">
                        <div class="profile-image">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="profile-info">
                            <h4>Sarah Johnson</h4>
                            <p>Web Development</p>
                        </div>
                    </div>
                    <p class="review-text">
                        The instructors are outstanding. Their practical approach made complex concepts easy to
                        understand.
                        I went from beginner to landing my dream job within months.
                    </p>
                    <div class="review-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="testimonial-card">
                    <div class="student-profile">
                        <div class="profile-image">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="profile-info">
                            <h4>Michael Chen</h4>
                            <p>Data Science</p>
                        </div>
                    </div>
                    <p class="review-text">
                        The AI & Machine Learning course provided me with practical skills that I use daily.
                        The mentorship program was invaluable for my growth.
                    </p>
                    <div class="review-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="student-profile">
                        <div class="profile-image">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <div class="profile-info">
                            <h4>John Smith</h4>
                            <p>Web Development</p>
                        </div>
                    </div>
                    <p class="review-text">
                        The web development course gave me hands-on experience in creating responsive and dynamic
                        websites. The instructors were highly knowledgeable.
                    </p>
                    <div class="review-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="student-profile">
                        <div class="profile-image">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <div class="profile-info">
                            <h4>Sarah Lee</h4>
                            <p>Data Science</p>
                        </div>
                    </div>
                    <p class="review-text">
                        The data science course exceeded my expectations. The practical projects and tools like Python
                        and Tableau helped me build a strong portfolio.
                    </p>
                    <div class="review-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="student-profile">
                        <div class="profile-image">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <div class="profile-info">
                            <h4>Michael Brown</h4>
                            <p>Digital Marketing</p>
                        </div>
                    </div>
                    <p class="review-text">
                        The digital marketing course covered all the key strategies and tools. The interactive sessions
                        and case studies were particularly helpful.
                    </p>
                    <div class="review-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="student-profile">
                        <div class="profile-image">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <div class="profile-info">
                            <h4>Emma Wilson</h4>
                            <p>Graphic Design</p>
                        </div>
                    </div>
                    <p class="review-text">
                        I loved the graphic design course! The focus on creativity and technical skills helped me build
                        an impressive portfolio.
                    </p>
                    <div class="review-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>


                <!-- Card 3 -->
                <div class="testimonial-card">
                    <div class="student-profile">
                        <div class="profile-image">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <div class="profile-info">
                            <h4>Emily Rodriguez</h4>
                            <p>UI/UX Design</p>
                        </div>
                    </div>
                    <p class="review-text">
                        The UI/UX design course was transformative. The emphasis on real-world projects helped me
                        develop strong design thinking skills.
                    </p>
                    <div class="review-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
        </div>

        <button class="nav-button next-btn">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</section>


<section class="knowledge-section">
    <div class="knowledge-pattern"></div>
    <div class="container">
        <div class="knowledge-header">
            <div class="knowledge-tag">FAQ</div>
            <h2 class="knowledge-title">Frequently Asked Questions</h2>
            <p class="knowledge-subtitle">Find answers to common questions about our courses and learning experience</p>
        </div>

        <div class="faq-container">
            <div class="faq-item">
                <div class="faq-question">
                    What prerequisites do I need to start the courses?
                    <i class="fas fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    Most of our beginner courses don't require any prior experience. For advanced courses, specific
                    prerequisites are listed in the course description. Basic computer literacy and a dedication to
                    learning are all you need to get started.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    How long does it take to complete a course?
                    <i class="fas fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    Course duration varies depending on the program. Most courses range from 8-16 weeks. You'll have
                    access to the materials for up to 6 months after completion, allowing you to learn at your own pace.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    Are the certificates recognized by employers?
                    <i class="fas fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    Yes, our certificates are industry-recognized. We partner with leading companies to ensure our
                    curriculum meets industry standards. Many of our graduates have successfully secured positions at
                    top tech companies.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    What kind of support will I receive?
                    <i class="fas fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    You'll have access to mentor support, live Q&A sessions, a community forum, and 24/7 technical
                    assistance. Our career services team also provides resume reviews, interview preparation, and job
                    placement support.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    Can I access the course content after completion?
                    <i class="fas fa-chevron-down faq-icon"></i>
                </div>
                <div class="faq-answer">
                    Yes, you'll have lifetime access to all course materials after completion. This includes video
                    lectures, assignments, projects, and any updates we make to the curriculum.
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');

        question.addEventListener('click', () => {
            const isOpen = item.classList.contains('active');

            // Close all items
            faqItems.forEach(faqItem => {
                faqItem.classList.remove('active');
            });

            // If clicked item wasn't open, open it
            if (!isOpen) {
                item.classList.add('active');
            }
        });
    });
</script>


<script>
    const track = document.querySelector('.testimonial-track');
    const cards = document.querySelectorAll('.testimonial-card');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');

    let currentIndex = 0;
    let cardWidth;
    let slidesToShow;

    function updateSlidesToShow() {
        if (window.innerWidth <= 768) {
            slidesToShow = 1;
        } else if (window.innerWidth <= 992) {
            slidesToShow = 2;
        } else {
            slidesToShow = 3;
        }
        cardWidth = track.clientWidth / slidesToShow;
        updateSlider();
    }

    function updateSlider() {
        track.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
    }

    prevBtn.addEventListener('click', () => {
        currentIndex = Math.max(currentIndex - 1, 0);
        updateSlider();
    });

    nextBtn.addEventListener('click', () => {
        const maxIndex = cards.length - slidesToShow;
        currentIndex = Math.min(currentIndex + 1, maxIndex);
        updateSlider();
    });

    window.addEventListener('resize', updateSlidesToShow);
    updateSlidesToShow();
</script>

<script>
    const modal = document.getElementById('enrollModal');

    function openModal() {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    function handleSubmit(event) {
        event.preventDefault();

        // Get form data
        const formData = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            course: document.getElementById('course').value
        };

        // Log form data (replace with your submission logic)
        console.log('Form submitted:', formData);

        // Reset form and close modal
        event.target.reset();
        closeModal();

        // Show success message (customize as needed)
        alert('Thank you for your application! We will contact you soon.');
    }

    // Close modal if clicking outside
    window.onclick = function (event) {
        if (event.target === modal) {
            closeModal();
        }
    }
</script>

<?php include 'includes/footer.php'; ?>