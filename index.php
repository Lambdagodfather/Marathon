<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Layout</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card img {
            height: 75vh;
            object-fit: cover;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
        }
        .btn-continue {
            background-color: black;
            color: white;
            border: none;
            width: 100%;
        }
        .btn-continue:hover {
            background-color: #333;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row text-center">
            <!-- Đăng Kí Thi -->
            <div class="col-md-4">
                <div class="card">
                    <img src="images/1.png" class="card-img-top" alt="Đăng Kí Thi">
                    <div class="card-body">
                        <h5 class="card-title">Đăng Kí Thi</h5>
                        <a href="register.php" class="btn btn-continue">Continue</a>
                    </div>
                </div>
            </div>
            <!-- Danh sách đăng kí -->
            <div class="col-md-4">
                <div class="card">
                    <img src="images/2.png" class="card-img-top" alt="Danh sách đăng kí">
                    <div class="card-body">
                        <h5 class="card-title">Danh sách đăng kí</h5>
                        <input type="email" class="form-control mb-3" id="email" placeholder="Enter your email">
                        <a href="search.php" class="btn btn-continue" id="search">Continue</a>
                    </div>
                </div>
            </div>
            <!-- Event -->
            <div class="col-md-4">
                <div class="card">
                    <img src="images/3.png" class="card-img-top" alt="Event">
                    <div class="card-body">
                        <h5 class="card-title">Event</h5>
                        <a href="listcourse.php" class="btn btn-continue">Continue</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const search = document.getElementById("search");
        const email = document.getElementById("email");
        // Add event listener for email input
        email.addEventListener("input", function() {
            // Check if the email is valid
            if (email.validity.valid) {
                search.href = `search.php?email=${email.value}`;
            } else {
                search.href = "search.php";
            }
        });
    </script>
</body>
</html>
