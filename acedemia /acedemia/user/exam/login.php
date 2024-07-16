<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .outer-container {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
        }
        .inner-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
        }
        .btn-custom {
            background-color: #7a6ad8;
            color: white;
            border-radius: 25px;
        }
        .btn-custom:hover {
            background-color: #695bc3;
        }
        .tagline-text {
            font-size: 0.875rem;
            font-weight: 400;
            color: #7a6ad8;
            margin-top: -10px;
            animation: fadeIn 2s ease-in-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Registration form -->
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="outer-container">
                    <div class="logo-text">ACADEMIA</div>
                    <div class="tagline-text">GEEK ENTRY!</div>
                    <div class="inner-container">
                        <form method="post" id="registrationForm">
                            <!-- Name input -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" name="name" required>
                                <label for="name">Name</label>
                            </div>
                            <!-- College/University input (auto-fetch) -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="college" name="college" list="colleges" required>
                                <label for="college">College/University</label>
                                <datalist id="colleges"></datalist>
                            </div>
                            <!-- Phone Number input -->
                            <div class="form-floating mb-3">
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                                <label for="phone">Phone Number</label>
                            </div>
                            <!-- Email input -->
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email" required>
                                <label for="email">Email</label>
                            </div>
                            <button type="submit" class="btn btn-custom py-3 w-100 mb-4" name="register">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Test window -->
        <div id="testWindow" class="row h-100 align-items-center justify-content-center" style="min-height: 100vh; display: none;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="outer-container">
                    <div class="logo-text">Test Window</div>
                    <div class="tagline-text">Test will start on 11 May</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Your scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fetch colleges/universities in India
            fetch('https://api.collegeapi.com/autocomplete?q=india')
                .then(response => response.json())
                .then(data => {
                    const collegesList = document.getElementById('colleges');
                    data.forEach(college => {
                        const option = document.createElement('option');
                        option.value = college.name;
                        collegesList.appendChild(option);
                    });
                });

            // Form submission handling
            $('#registrationForm').submit(function(event) {
                event.preventDefault(); // Prevent form submission

                // Simulate registration success (you would handle this on the server)
                // For demonstration, we'll just show the test window
                showTestWindow();
            });

            // Function to show the test window
            function showTestWindow() {
                $('#testWindow').fadeIn(); // Show the test window
            }
        });
    </script>
</body>
</html>
