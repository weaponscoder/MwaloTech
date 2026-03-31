<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mwalo Tech Portfolio</title>
    <link rel="stylesheet" href="asset/portifolio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="asset/portifolio.js" defer></script>
    <style>
        /* Additional styles for dynamic content */
        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }
        
        .skill-item {
            background: linear-gradient(to right, rgb(56, 43, 43), #be8a5f);
            padding: 20px;
            border-radius: 10px;
            color: white;
        }
        
        .skill-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }
        
        .skill-header i {
            font-size: 24px;
            color: #00ffcc;
        }
        
        .skill-header h3 {
            margin: 0;
            font-size: 18px;
        }
        
        .progress-bar {
            width: 100%;
            height: 10px;
            background: rgba(255,255,255,0.2);
            border-radius: 5px;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            background: #00ffcc;
            border-radius: 5px;
            transition: width 0.3s ease;
        }
        
        .project-links {
            margin-top: 15px;
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        
        .project-links a {
            color: white;
            text-decoration: none;
            padding: 5px 15px;
            background: rgba(0,0,0,0.3);
            border-radius: 5px;
            font-size: 14px;
            transition: 0.3s;
        }
        
        .project-links a:hover {
            background: #d36804;
        }
        
        .cv-download {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            background: #d36804;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: 0.3s;
        }
        
        .cv-download:hover {
            background: #b55500;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<?php
// Database connection
require_once "db.php";

// Fetch data from database
$services = mysqli_query($conn, "SELECT * FROM services WHERE status = 1 ORDER BY display_order ASC");
$projects = mysqli_query($conn, "SELECT * FROM projects WHERE status = 1 ORDER BY display_order ASC");
$skills = mysqli_query($conn, "SELECT * FROM skills WHERE status = 1 ORDER BY display_order ASC");
?>

<!-- ===== HEADER ===== -->
<header>
    <div class="logo">
        <img src="asset/logo.png" alt="Logo" onerror="this.src='https://via.placeholder.com/40'">
        <span>Mwalo Tech</span>
    </div>

    <div class="search-bar">
        <input type="text" placeholder="Search...">
        <button class="search-button"><i class="fa fa-search"></i></button>
    </div>

    <button class="menu-button" id="menuBtn">&#9776;</button>
    <div class="menu" id="menuBox">
        <ul>
            <li><a href="#home">🏠 Home</a></li>
            <li><a href="#about">🙋 About</a></li>
            <li><a href="#services">💼 Services</a></li>
            <li><a href="#projects">🚀 Projects</a></li>
            <li><a href="#skills">📊 Skills</a></li>
            <li><a href="#contact">📞 Contact</a></li>
            <li><a href="admin/login.php">📰 Admin</a></li>
        </ul>
    </div>
</header>

<!-- ===== HERO ===== -->
<section class="hero" id="home">
    <p><u>Coding the Future,</u></p>
    <h1>Welcome to <span style="color:#d36804;">Mwalo Tech</span>, where creativity meets technology.</h1>
    <a href="#contact" style="color: white; text-decoration: none;"><button>Work with Me</button></a>

    <ul class="social-links">
        <li><a href="https://github.com/weaponscoder/weaponscoder" target="_blank"><i class="fa-brands fa-github"></i> GitHub</a></li>
        <li><a href="https://linkedin.com/in/ezekiel-mwalongo-696257318" target="_blank"><i class="fa-brands fa-linkedin"></i> LinkedIn</a></li>
        <li><a href="https://wa.me/255688902638" target="_blank"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a></li>
    </ul>
</section>

<!-- ===== ABOUT ===== -->
<section id="about" class="section about-section">
    <div class="about-container">
        <div class="about-image">
            <img src="asset/portifo2.png" alt="Mwalongo Coder" onerror="this.src='https://via.placeholder.com/500x300'">
        </div>
        <div class="about-content">
            <h2>About Me</h2>
            <p>I'm Ezekiel Mwalongo, a passionate developer and IT professional dedicated to building modern, secure, and user-friendly digital solutions. With expertise in web development, cybersecurity, and networking, I help businesses and individuals bring their ideas to life.</p>
            
            <h3 style="color: #d36804; margin-top: 20px;">What I Do:</h3>
            <ul>
                <li><strong>Web Development:</strong> Custom websites and applications</li>
                <li><strong>Cybersecurity:</strong> Security assessments and protection</li>
                <li><strong>Networking:</strong> Network setup and maintenance</li>
                <li><strong>IT Consulting:</strong> Technical advice and support</li>
            </ul>
            
            <!-- CV Download Button -->
            <a href="asset/Ezekiel_Mwalongo_CV.pdf" download class="cv-download" onclick="alert('CV download started!')">
                <i class="fas fa-download"></i> Download My CV
            </a>
        </div>
    </div>
</section>

<!-- ===== SERVICES (Dynamic from Database) ===== -->
<section id="services" class="section services-section">
    <h2>My Services</h2>
    <div class="services-grid">
        <?php if (mysqli_num_rows($services) > 0): ?>
            <?php while ($service = mysqli_fetch_assoc($services)): ?>
                <div class="service-card">
                    <i class="fas <?= htmlspecialchars($service['icon']) ?>" style="font-size: 40px; color: #00ffcc; margin-bottom: 15px;"></i>
                    <h3><?= htmlspecialchars($service['title']) ?></h3>
                    <p class="short-desc"><?= htmlspecialchars($service['short_desc']) ?></p>
                    <?php if (!empty($service['full_desc'])): ?>
                        <p class="full-desc" style="display: none;"><?= htmlspecialchars($service['full_desc']) ?></p>
                        <button class="toggle-btn" onclick="toggleDesc(this)">See More</button>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No services available at the moment.</p>
        <?php endif; ?>
    </div>
</section>

<!-- ===== PROJECTS (Dynamic from Database) ===== -->
<section id="projects" class="section projects-section">
    <h2>My Projects</h2>
    <div class="projects-grid">
        <?php if (mysqli_num_rows($projects) > 0): ?>
            <?php while ($project = mysqli_fetch_assoc($projects)): ?>
                <div class="project-card" <?php if (!empty($project['image'])): ?>style="background-image: url('asset/<?= htmlspecialchars($project['image']) ?>');"<?php endif; ?>>
                    <div class="project-overlay">
                        <h3><?= htmlspecialchars($project['title']) ?></h3>
                        <p><?= htmlspecialchars($project['description']) ?></p>
                        
                        <?php if (!empty($project['technologies'])): ?>
                            <p style="font-size: 12px; margin-top: 5px; color: #00ffcc;">
                                <strong>Tech:</strong> <?= htmlspecialchars($project['technologies']) ?>
                            </p>
                        <?php endif; ?>
                        
                        <div class="project-links">
                            <?php if (!empty($project['github_link'])): ?>
                                <a href="<?= htmlspecialchars($project['github_link']) ?>" target="_blank"><i class="fab fa-github"></i> Code</a>
                            <?php endif; ?>
                            <?php if (!empty($project['live_link'])): ?>
                                <a href="<?= htmlspecialchars($project['live_link']) ?>" target="_blank"><i class="fas fa-external-link-alt"></i> Live</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No projects available at the moment.</p>
        <?php endif; ?>
    </div>
</section>

<!-- ===== SKILLS (Dynamic from Database) ===== -->
<section id="skills" class="section skills-section" style="padding: 60px 20px; background: #f8fafc;">
    <h2>My Skills</h2>
    <div class="skills-grid">
        <?php 
        // Check if skills query was successful and has data
        if ($skills && mysqli_num_rows($skills) > 0): 
            while ($skill = mysqli_fetch_assoc($skills)): 
        ?>
            <div class="skill-item">
                <div class="skill-header">
                    <i class="fas <?= htmlspecialchars($skill['icon'] ?? 'fa-code') ?>"></i>
                    <h3><?= htmlspecialchars($skill['name'] ?? 'Skill') ?></h3>
                    <span style="margin-left: auto; color: #00ffcc;"><?= $skill['percentage'] ?? 0 ?>%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?= $skill['percentage'] ?? 0 ?>%;"></div>
                </div>
            </div>
        <?php 
            endwhile; 
        else: 
        ?>
            <!-- Default skills if database has no data -->
            <div class="skill-item">
                <div class="skill-header">
                    <i class="fas fa-html5"></i>
                    <h3>HTML5</h3>
                    <span style="margin-left: auto; color: #00ffcc;">95%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 95%;"></div>
                </div>
            </div>
            
            <div class="skill-item">
                <div class="skill-header">
                    <i class="fas fa-css3-alt"></i>
                    <h3>CSS3</h3>
                    <span style="margin-left: auto; color: #00ffcc;">90%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 90%;"></div>
                </div>
            </div>
            
            <div class="skill-item">
                <div class="skill-header">
                    <i class="fas fa-js"></i>
                    <h3>JavaScript</h3>
                    <span style="margin-left: auto; color: #00ffcc;">85%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 85%;"></div>
                </div>
            </div>
            
            <div class="skill-item">
                <div class="skill-header">
                    <i class="fas fa-php"></i>
                    <h3>PHP</h3>
                    <span style="margin-left: auto; color: #00ffcc;">80%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 80%;"></div>
                </div>
            </div>
            
            <div class="skill-item">
                <div class="skill-header">
                    <i class="fas fa-database"></i>
                    <h3>MySQL</h3>
                    <span style="margin-left: auto; color: #00ffcc;">85%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 85%;"></div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- ===== TESTIMONIALS ===== -->
<section class="testimonials" id="testimonials">
    <h2>What People Say</h2>
    <p class="section-subtitle">Feedback from clients and collaborators</p>
    <div class="testimonials-container" id="testimonials-container">
        <?php
        // Fetch testimonials from database
        $testimonials_query = mysqli_query($conn, "SELECT * FROM testimonials ORDER BY created_at DESC LIMIT 3");
        
        if ($testimonials_query && mysqli_num_rows($testimonials_query) > 0):
            while ($testimonial = mysqli_fetch_assoc($testimonials_query)):
        ?>
            <div class="testimonial-card">
                <div class="testimonial-rating">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <?php if ($i <= $testimonial['rating']): ?>
                            <i class="fas fa-star" style="color: gold;"></i>
                        <?php else: ?>
                            <i class="far fa-star" style="color: gold;"></i>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
                <p class="testimonial-text">"<?= htmlspecialchars($testimonial['message']) ?>"</p>
                <div class="testimonial-author">
                    <strong><?= htmlspecialchars($testimonial['name']) ?></strong>
                    <?php if (!empty($testimonial['title'])): ?>
                        <span><?= htmlspecialchars($testimonial['title']) ?></span>
                    <?php endif; ?>
                </div>
            </div>
        <?php 
            endwhile;
        else:
        ?>
            <!-- Default testimonials if database has no data -->
            <div class="testimonial-card">
                <div class="testimonial-rating">
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                </div>
                <p class="testimonial-text">"Ezekiel did an amazing job on our company website. He is professional, timely, and his work is top quality. Highly recommended!"</p>
                <div class="testimonial-author">
                    <strong>John Doe</strong>
                    <span>CEO, Tech Solutions</span>
                </div>
            </div>
            
            <div class="testimonial-card">
                <div class="testimonial-rating">
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                </div>
                <p class="testimonial-text">"Great experience working with Mwalo Tech. The e-commerce platform he built for us is exactly what we needed. Will definitely work with him again."</p>
                <div class="testimonial-author">
                    <strong>Jane Smith</strong>
                    <span>Business Owner</span>
                </div>
            </div>
            
            <div class="testimonial-card">
                <div class="testimonial-rating">
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="fas fa-star" style="color: gold;"></i>
                    <i class="far fa-star" style="color: gold;"></i>
                </div>
                <p class="testimonial-text">"Very knowledgeable in cybersecurity. He helped us secure our network and provided excellent training for our staff. Professional and reliable."</p>
                <div class="testimonial-author">
                    <strong>Mike Johnson</strong>
                    <span>IT Manager</span>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- ===== CONTACT ===== -->
<section class="contact-section" id="contact">
    <h2>Contact Us</h2>
    <div class="contact-card">
        <div id="contact-message" style="margin-bottom: 10px; font-weight: bold;"></div>
        <form id="contact-form" method="POST" action="contact_submit.php">
            <input id="contact-name" type="text" placeholder="Your name" name="name" required>
            <input id="contact-email" type="email" placeholder="Email address" name="email" required>
            <textarea id="contact-message-text" placeholder="Write your message..." name="message" required></textarea>
            <button type="submit" class="btn">Send Message</button>
        </form>
    </div>
</section>

<!-- ===== TESTIMONIAL FORM ===== -->
<section class="contact-section" id="testimonial-form-section">
    <h2>Share Your Experience</h2>
    <div class="contact-card">
        <div id="testimonial-message" style="margin-bottom: 10px; font-weight: bold;"></div>
        <form id="testimonial-form" method="POST" action="testimonial_submit.php">
            <input id="test-name" type="text" placeholder="Your name" name="name" required>
            <input id="test-email" type="email" placeholder="Email address" name="email" required>
            <input id="test-title" type="text" placeholder="Your position/title (optional)" name="title">
            <textarea id="test-message" placeholder="Share your testimonial..." name="message" required></textarea>
            <div style="margin: 15px 0;">
                <label for="test-rating" style="margin-right:10px;">Rating:</label>
                <select id="test-rating" name="rating" required>
                    <option value="5">⭐⭐⭐⭐⭐ (5 stars)</option>
                    <option value="4">⭐⭐⭐⭐ (4 stars)</option>
                    <option value="3">⭐⭐⭐ (3 stars)</option>
                    <option value="2">⭐⭐ (2 stars)</option>
                    <option value="1">⭐ (1 star)</option>
                </select>
            </div>
            <button type="submit" class="btn">Submit Testimonial</button>
        </form>
    </div>
</section>

<!-- ===== FOOTER ===== -->
<footer>
    <div class="footer-container">
        <div class="footer-left">
            <img src="asset/logo.png" alt="Mwalo Tech Logo" onerror="this.src='https://via.placeholder.com/90'">
            <h2>Mwalo<span>Tech</span></h2>
            <p>Innovating the Future with Code & Creativity 🚀</p>
        </div>
        <div class="footer-center">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#projects">Projects</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
        <div class="footer-right">
            <h3>Contact Info</h3>
            <p>Email: mwalongojoshua042@gmail.com</p>
            <p>Phone: +255 688 902 638</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-github"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        © 2025 Mwalo Tech | All Rights Reserved | <a href="admin/login.php" style="color: #d36804;">Admin</a>
    </div>
</footer>

<script>
// Toggle description function for services
function toggleDesc(btn) {
    const card = btn.closest('.service-card');
    const fullDesc = card.querySelector('.full-desc');
    const shortDesc = card.querySelector('.short-desc');
    
    if (fullDesc.style.display === 'none' || fullDesc.style.display === '') {
        fullDesc.style.display = 'block';
        shortDesc.style.display = 'none';
        btn.textContent = 'See Less';
    } else {
        fullDesc.style.display = 'none';
        shortDesc.style.display = 'block';
        btn.textContent = 'See More';
    }
}

// Mobile menu toggle
document.getElementById('menuBtn').addEventListener('click', function() {
    document.getElementById('menuBox').classList.toggle('show');
});

// Close menu when clicking a link
document.querySelectorAll('#menuBox a').forEach(link => {
    link.addEventListener('click', () => {
        document.getElementById('menuBox').classList.remove('show');
    });
});

// Contact form submission
document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('contact_submit.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const messageDiv = document.getElementById('contact-message');
        if (data.status === 'success') {
            messageDiv.innerHTML = '<div style="color: green; padding: 10px; background: #d4edda; border-radius: 5px;">' + data.msg + '</div>';
            this.reset();
        } else {
            messageDiv.innerHTML = '<div style="color: red; padding: 10px; background: #f8d7da; border-radius: 5px;">' + data.msg + '</div>';
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

// Testimonial form submission
document.getElementById('testimonial-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('testimonial_submit.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const messageDiv = document.getElementById('testimonial-message');
        if (data.status === 'success') {
            messageDiv.innerHTML = '<div style="color: green; padding: 10px; background: #d4edda; border-radius: 5px;">' + data.msg + '</div>';
            this.reset();
            
            // Reload testimonials after 2 seconds
            setTimeout(() => {
                location.reload();
            }, 2000);
        } else {
            messageDiv.innerHTML = '<div style="color: red; padding: 10px; background: #f8d7da; border-radius: 5px;">' + data.msg + '</div>';
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
</script>

</body>
</html>