import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Trip delete confirmation functionality
document.addEventListener('DOMContentLoaded', function() {
    // Get all delete buttons and attach event listeners
    const deleteButtons = document.querySelectorAll('.delete-trip-button');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            const tripId = this.getAttribute('data-trip-id');
            const tripTitle = this.getAttribute('data-trip-title');

            if (confirm(`Are you sure you want to delete the trip "${tripTitle}"? This action cannot be undone.`)) {
                // If confirmed, submit the form
                this.closest('form').submit();
            }
        });
    });
});
