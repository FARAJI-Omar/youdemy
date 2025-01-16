document.addEventListener('DOMContentLoaded', function() {
    const contactLink = document.querySelector('a[href="contact.php"]');
    
    contactLink.addEventListener('click', function(e) {
        e.preventDefault();
        
        const contactSection = document.getElementById('contact');
        contactSection.scrollIntoView({ 
            behavior: 'smooth',
            block: 'center'
        });
    });
}); 