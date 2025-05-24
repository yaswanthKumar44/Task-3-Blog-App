// Add client-side form validation or other enhancements
document.addEventListener('DOMContentLoaded', function() {
    // Example: Confirm delete action
    document.querySelectorAll('.btn-danger').forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this post?')) {
                e.preventDefault();
            }
        });
    });
});