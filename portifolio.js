// asset/portifolio.js
document.addEventListener('DOMContentLoaded', function() {
    console.log("JavaScript loaded successfully!");
    
    const menuBtn = document.getElementById("menuBtn");
    const menuBox = document.getElementById("menuBox");

    // Toggle menu when button is clicked
    if (menuBtn && menuBox) {
        menuBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            menuBox.classList.toggle("open");
        });

        // Close menu when clicking outside
        document.addEventListener("click", (e) => {
            if (!menuBox.contains(e.target) && e.target !== menuBtn) {
                menuBox.classList.remove("open");
            }
        });
    }

    // Contact form submit
    const contactForm = document.getElementById("contact-form");
    if (contactForm) {
        contactForm.addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(contactForm);
            const messageDiv = document.getElementById("contact-message");
            
            messageDiv.innerHTML = "Sending...";
            messageDiv.style.color = "blue";

            // Use relative path - no "api/" folder
            fetch("contact_submit.php", {
                method: "POST",
                body: formData
            })
            .then(res => {
                if (!res.ok) {
                    throw new Error("Network response was not ok");
                }
                return res.json();
            })
            .then(data => {
                messageDiv.innerText = data.msg;
                messageDiv.style.color = data.status === "success" ? "green" : "red";
                if (data.status === "success") contactForm.reset();
            })
            .catch(error => {
                messageDiv.innerText = "Error: " + error.message;
                messageDiv.style.color = "red";
                console.error("Fetch error:", error);
            });
        });
    }

    // Testimonial form submit
    const testimonialForm = document.getElementById("testimonial-form");
    if (testimonialForm) {
        testimonialForm.addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(testimonialForm);
            const messageDiv = document.getElementById("testimonial-message");
            
            messageDiv.innerHTML = "Submitting...";
            messageDiv.style.color = "blue";

            // Use relative path - no "api/" folder
            fetch("testimonial_submit.php", {
                method: "POST",
                body: formData
            })
            .then(res => {
                if (!res.ok) {
                    throw new Error("Network response was not ok");
                }
                return res.json();
            })
            .then(data => {
                messageDiv.innerText = data.msg;
                messageDiv.style.color = data.status === "success" ? "green" : "red";
                if (data.status === "success") {
                    testimonialForm.reset();
                    loadTestimonials();
                }
            })
            .catch(error => {
                messageDiv.innerText = "Error: " + error.message;
                messageDiv.style.color = "red";
                console.error("Fetch error:", error);
            });
        });
    }

    // Load testimonials dynamically
    function loadTestimonials() {
        const container = document.getElementById("testimonials-container");
        if (!container) return;
        
        container.innerHTML = "<div class='testimonial-card'><p>Loading testimonials...</p></div>";

        fetch("get_testimonials.php")
        .then(res => {
            if (!res.ok) {
                throw new Error("Network response was not ok");
            }
            return res.json();
        })
        .then(data => {
            if (!data || data.length === 0) {
                container.innerHTML = "<div class='testimonial-card'><p>No testimonials yet. Be the first to share!</p></div>";
                return;
            }
            container.innerHTML = "";
            data.forEach(t => {
                const card = document.createElement("div");
                card.classList.add("testimonial-card");
                
                // Create star rating display
                const stars = '⭐'.repeat(t.rating);
                
                card.innerHTML = `
                    <p class="testimonial-text">"${t.message}"</p>
                    <div class="testimonial-info">
                        <div>
                            <h4>${t.name}</h4>
                            ${t.title ? `<span>${t.title}</span>` : ''}
                            <div class="rating">${stars}</div>
                        </div>
                    </div>
                `;
                container.appendChild(card);
            });
        })
        .catch(error => {
            container.innerHTML = "<div class='testimonial-card'><p>Error loading testimonials. Make sure database is connected.</p></div>";
            console.error("Error:", error);
        });
    }

    // Initial load
    loadTestimonials();
});