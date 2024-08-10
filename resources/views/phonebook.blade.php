<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phonebook System</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Phonebook System</h1>

    <!-- Search Form -->
    <div>
        <h2>Search Contact</h2>
        <input type="text" id="searchPhoneNumber" placeholder="Enter phone number">
        <button id="searchButton">Search</button>
        <div id="searchResult"></div>
    </div>

    <!-- Submit Form -->
    <div>
        <h2>Add Contact</h2>
        <input type="text" id="submitPhoneNumber" placeholder="Enter phone number">
        <input type="text" id="submitName" placeholder="Enter name">
        <button id="submitButton">Submit</button>
        <div id="submitResult"></div>
    </div>

    <script>
        $(document).ready(function() {
            // Search functionality
            $('#searchButton').click(function() {
                var phoneNumber = $('#searchPhoneNumber').val();
                $.ajax({
                    url: '/search',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        phone_number: phoneNumber
                    },
                    success: function(response) {
                        if (response.name) {
                            $('#searchResult').text("Name: " + response.name);
                        } else {
                            $('#searchResult').text(response.message);
                        }
                    }
                });
            });

            // Submit functionality
            $('#submitButton').click(function() {
                var phoneNumber = $('#submitPhoneNumber').val();
                var name = $('#submitName').val();
                $.ajax({
                    url: '/store',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        phone_number: phoneNumber,
                        name: name
                    },
                    success: function(response) {
                        alert(response.message);
                        if (response.id) {
                            $('#submitResult').text("Database ID: " + response.id);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
