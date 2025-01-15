document.addEventListener('DOMContentLoaded', function() {
    // Get the contact link from the header
    const contactLink = document.querySelector('a[href="contact.php"]');
    
    if (contactLink) {
        contactLink.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Find the footer contact section
            const footer = document.querySelector('.footer');
            if (footer) {
                // Smooth scroll to footer
                footer.scrollIntoView({ 
                    behavior: 'smooth'
                });
            }
        });
    }
}); 