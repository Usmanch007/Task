jQuery(document).ready(function($) {
    $.ajax({
        url: 'https://api.kanye.rest/',
        method: 'GET',
        success: function(data) {
            let quotes = data.quote; // assuming the response contains a single quote
            
            // Loop to get 5 quotes
            for (let i = 0; i < 5; i++) {
                $('#kanye-quotes').append('<p>' + quotes + '</p>');
            }
        },
        error: function() {
            $('#kanye-quotes').append('<p>Could not load quotes. Please try again.</p>');
        }
    });
});
