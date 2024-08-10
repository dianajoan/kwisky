<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phonebook System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSkt6tJdUCOk+P39IGyIYQgGII0yAnsTBmL50egPAsi" crossorigin="anonymous">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 50px;
        }

        h1, h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-control {
            margin-bottom: 15px;
        }

        #searchButton, #submitButton {
            width: 100%;
        }

        #searchResult, #submitResult {
            margin-top: 15px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Phonebook System</h1>

        <!-- Search Form -->
        <div>
            <h2>Search Contact</h2>
            <input type="text" id="searchPhoneNumber" class="form-control" placeholder="Enter phone number">
            <button id="searchButton" class="btn btn-primary">Search</button>
            <div id="searchResult" class="alert alert-info" role="alert" style="display:none;"></div>
        </div>

        <!-- Submit Form -->
        <div>
            <h2>Add Contact</h2>
            <input type="text" id="submitPhoneNumber" class="form-control" placeholder="Enter phone number">
            <input type="text" id="submitName" class="form-control" placeholder="Enter name">
            <button id="submitButton" class="btn btn-success">Submit</button>
            <div id="submitResult" class="alert alert-info" role="alert" style="display:none;"></div>
        </div>
    </div>

    <!-- jQuery (for AJAX) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS (Optional, for additional features) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzLzScYtvYtvPsTy2RYGmgYkG9JDiTZPlFQ2ALsN45ZB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93b0CavALB0d2dFFi57Qw7FadIp8B5RZlA85fP8uM4ocKzFEe+f5S5pF6tKT3L" crossorigin="anonymous"></script>

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
                        $('#searchResult').show();
                        if (response.name) {
                            $('#searchResult').text("Name: " + response.name).removeClass('alert-info').addClass('alert-success');
                        } else {
                            $('#searchResult').text(response.message).removeClass('alert-success').addClass('alert-warning');
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
                        $('#submitResult').show();
                        if (response.id) {
                            $('#submitResult').text("Database ID: " + response.id).removeClass('alert-warning').addClass('alert-success');
                        } else {
                            $('#submitResult').text(response.message).removeClass('alert-success').addClass('alert-warning');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
