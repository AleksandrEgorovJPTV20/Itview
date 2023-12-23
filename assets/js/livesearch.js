$(document).ready(function () {
    $('#search-input').on('input', function () {
        // Delay the search to avoid sending too many requests
        clearTimeout($.data(this, 'timer'));
        var searchTerm = $(this).val();
        if (searchTerm === '') {
            $('#search-results').html('');
            return;
        }

        $(this).data('timer', setTimeout(function () {
            // Perform AJAX search request
            $.ajax({
                type: 'POST', // Use POST method
                url: '/forum', // Adjust the URL based on your setup
                data: { search: searchTerm },
                success: function (data) {
                    $('#search-results').html(data);
                }
            });
        }, 300)); // Adjust the delay as needed
    });
});