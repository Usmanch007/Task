jQuery(document).ready(function($) {
    // Send the Ajax request
    $.ajax({
        url: ajaxurl, // WordPress global variable for AJAX URL
        method: 'GET',
        data: {
            action: 'get_architecture_projects',
        },
        success: function(response) {
            if (response.success) {
                console.log('Projects:', response.data);
                // Process and display the projects here
            } else {
                console.log('Error:', response.message);
            }
        }
    });
});