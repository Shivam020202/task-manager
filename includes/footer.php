<footer class="glass-footer mt-auto">
    <div class="container-fluid py-5">
        <div class="row g-4">
            <!-- Brand Column -->
            <div class="col-lg-4">
                <div class="footer-brand">
                    <a href="index.php" class="logo-text">
                        <i class="bi bi-mortarboard-fill me-2"></i>
                        Learn Academy
                    </a>
                    <p class="mt-3 footer-text">
                        Empowering learners through innovative education solutions.
                    </p>
                </div>
            </div>

            <!-- Links Columns -->
            <div class="col-lg-8">
                <div class="row g-4">
                    <div class="col-md-4">
                        <h5 class="footer-heading">Quick Links</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link footer-link">Courses</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link footer-link">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="tasks" class="nav-link footer-link">Tasks</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <h5 class="footer-heading">Resources</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link footer-link">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link footer-link">FAQs</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link footer-link">Support</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <h5 class="footer-heading">Connect</h5>
                        <div class="social-links">
                            <a href="#" class="social-icon">
                                <i class="bi bi-twitter"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="bi bi-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-top border-dark mt-4 pt-3">
            <p class="text-center mb-0 footer-text">
                © 2024 Learn Academy. All rights reserved.
            </p>
        </div>
    </div>
</footer>

<style>
    .glass-footer {
        background: linear-gradient(135deg, rgba(16, 25, 40, 0.95) 0%, rgba(30, 48, 70, 0.95) 100%);
        backdrop-filter: blur(10px);
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .footer-heading {
        color: #90e0ef;
        font-family: 'Poppins', sans-serif;
        font-size: 1.1rem;
        margin-bottom: 1.2rem;
        position: relative;
        padding-bottom: 0.5rem;
    }

    .footer-heading::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background: linear-gradient(90deg, #00b4d8, transparent);
    }

    .footer-link {
        color: rgba(255, 255, 255, 0.8) !important;
        padding: 0.3rem 0 !important;
        transition: all 0.3s ease;
        position: relative;
    }

    .footer-link:hover {
        color: #90e0ef !important;
        transform: translateX(8px);
    }

    .footer-link::before {
        content: '•';
        color: #00b4d8;
        position: absolute;
        left: -15px;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .footer-link:hover::before {
        opacity: 1;
        left: -10px;
    }

    .social-links {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .social-icon {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
    }

    .social-icon:hover {
        background: #00b4d8;
        transform: translateY(-3px);
    }

    .footer-text {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        line-height: 1.6;
    }
</style>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>