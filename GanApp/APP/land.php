<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GanApp</title>
    <link rel="stylesheet" href="css/landing.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <img src="images/Logo.png" alt="GanApp Logo">
                <span>GanApp</span>
            </div>
            <nav>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#about">About</a></li>
                </ul>
            </nav>
            <div class="cta-button">
                <a href="main.php" class="btn-get-started">Get Started</a>
            </div>
        </div>
    </header>

    <main>
        <section class="hero" id="home">
            <div class="container">
                <div class="hero-content">
                    <h1>The <span class="highlight">Event Tracker</span><br>for OSA</h1>
                    <p>Event Signing, Scheduling<br>On Our Advanced GanApp Platform!</p>
                    <a href="Main.php" class="btn-start-free">Fill up</a>
                </div>
                <div class="hero-video">
                    <iframe src="https://www.youtube.com/embed/your-video-id" title="GanApp Demo Video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </section>

        <section class="features" id="features">
            <div class="container">
                <h2>The <span class="highlight">Best</span> Place to Track, Schedule,</h2>
                <p class="section-description">A number of features designed to easily track<br>Events.</p>
                
                <div class="feature-cards">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-simple"></i>
                        </div>
                        <h3>Chart Dashboard</h3>
                        <p>Organized data for managing.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3>Track Events easily</h3>
                        <p>Keep on track of your venue availability.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-pencil"></i>
                        </div>
                        <h3>Fill up and Go</h3>
                        <p>We'll let you know in a short amount of time if available or not.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="images/Logo.png" alt="GanApp Logo">
                    <span>GanApp</span>
                </div>
                <div class="footer-links">
                    <div class="footer-column">
                        <h4>Product</h4>
                        <ul>
                            <li><a href="#">Features</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h4>Resources</h4>
                        <ul>
                            <li><a href="#">Help Center</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Tutorials</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h4>Company</h4>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 GanApp. All rights reserved.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>