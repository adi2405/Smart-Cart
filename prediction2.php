<?php
session_start();
include("connect.php");

// Regenerate session ID to prevent session fixation
if (!isset($_SESSION['regenerated'])) {
    session_regenerate_id(true);
    $_SESSION['regenerated'] = true;
}

// Check if user is logged in
if (!isset($_SESSION['Email']) && !isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['salesFile'])) {
    // File upload logic
    $file = $_FILES['salesFile'];
    $filename = $file['tmp_name'];

    // cURL to send file to Python API
    $ch = curl_init();
    $cfile = new CURLFile($filename, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'salesFile');

    $data = array('file' => $cfile);

    curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:5000/predict_hierarchical'); // Python API URL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        $response_data = json_decode($response, true);
    }

    curl_close($ch);
}

/*// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartCart / Hierarchical Prediction</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        /* Make sure body and html take full height */
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        /* Ensure content takes up all available vertical space */
        .content {
            flex-grow: 1;
        }

        /* Footer styling */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
            position: relative;
            bottom: 0;
        }

        /* Sales Data Input */
        form.salesform {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f8f9fa;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        form.salesform label {
            font-size: 1.2rem;
            color: #2c3e50;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .salesform input[type="file"] {
            font-size: 1rem;
            padding: 10px;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
            width: 100%;
            margin-bottom: 20px;
            transition: border-color 0.3s ease-in-out;
        }   
        
        /* Loading screen styles */
        #loading-screen {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
            font-size: 24px;
            padding-top: 20%;
        }

        /* Spinner styles */
        .spinner {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 80px;
            height: 80px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
            margin: 0 auto;
        }

        /* Spinner animation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Container for the prediction result */
        #predictionResult-container {
            background-color: #fff; /* White background for the box */
            padding: 20px; /* Padding inside the box */
            margin: 30px auto; /* Center the box horizontally */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow effect */
            max-width: 1300px; /* Set a max width for the container */
            text-align: center; /* Center-align the content */
        }

        /* Styling for the section title */
        #predictionResult-container h2 {
            font-size: 24px;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        #predictionResult h2{
            color: #333;
        }

        /* Styling for image titles */
        #predictionResult-container h3 {
            font-size: 20px;
            color: #34495e;
            margin-bottom: 10px;
            margin-top: 20px;
        }

        /* Styling for the images */
        #predictionResult-container img {
            width: 100%; /* Ensure the images take the full width of the container */
            max-width: 1000px; /* Set a max width for images */
            height: auto; /* Keep the aspect ratio of the images */
            margin-bottom: 20px; /* Add some space below each image */
            border-radius: 8px; /* Rounded corners for the images */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow for images */
        }

        /* General body styling for consistency */
        body {
            background-color: #f9f9f9;
            color: #333;
            padding: 0;
        }

        /* Container for the recommended products */
        #recommendations {
            background-color: #fff;
            padding: 70px;
            margin: 30px auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            text-align: center;
        }

        /* Title for the section */
        #recommendations h2 {
            font-size: 24px;
            color: #2c3e50;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Styling for the list of products */
        #recommendations ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: space-between; /* Space between the product cards */
            flex-wrap: wrap; /* Ensure responsiveness on smaller screens */
        }

        /* Each product card styling */
        #recommendations li {
            background-color: #f4f7f6;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            transition: transform 0.2s ease-in-out;
            cursor: pointer;
            width: 30%; /* Adjust width to fit three products side by side */
            box-sizing: border-box;
        }

        /* Hover effect for each product card */
        #recommendations li:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        /* Product name styling */
        #recommendations li strong {
            font-size: 18px;
            color: #34495e;
            display: block;
            margin-bottom: 10px;
        }

        /* Container for product details */
        #recommendations li .product-details {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Text for product details */
        #recommendations li .product-details span {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 170px;
            font-size: 16px;
            color: #555;
            margin-bottom: 5px;
        }

        /* Label for product details */
        #recommendations li .product-details span .label {
            text-align: left;
            width: 50%;
            font-weight: bold;
            margin-right: 10px;
        }

        /* Value for product details */
        #recommendations li .product-details span .value {
            text-align: center;
            width: 50%;
        }

        /* Special highlighting for profit */
        #recommendations li .product-details span.profit .value {
            font-weight: bold;
            color: #27ae60;
        }

        /* Product Image */
        .img-container{
            display: flex;
            justify-content: center;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .img{
            width: 200px;
            height: 200px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

    /* Style the modal background */
    #product-description-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.8);
        transition: opacity 0.4s ease-in-out;
    }

    /* Modal content box */
    .modal-content {
        background-color: #f4f7f6;
        margin: 10% auto;
        padding: 20px;
        border-radius: 10px;
        width: 80%;
        max-width: 600px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        text-align: center;
        animation: modalFadeIn 0.5s ease;
        position: relative;
    }

    /* Consistent image size for the modal product image */
    .modal-product-image {
        max-width: 100%;
        width: 300px;  /* Set a fixed width */
        height: 300px; /* Set a fixed height */
        border-radius: 8px;
        margin-bottom: 15px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    /* Close button */
    .close-btn {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        position: absolute;
        right: 15px;
        top: 10px;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .close-btn:hover,
    .close-btn:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    /* Modal title */
    .modal-content h3 {
        font-size: 24px;
        color: #333;
        margin-bottom: 15px;
        font-family: 'Roboto', sans-serif;
    }

    /* Modal description text */
    .modal-content p {
        font-size: 18px;
        color: #555;
        line-height: 1.6;
        font-family: 'Roboto', sans-serif;
    }

    /* Style the product price */
    .product-price {
        font-size: 20px;
        font-weight: bold;
        color: #28a745;
        margin-top: 10px;
    }

    /* Add a subtle animation to the modal opening */
    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: translateY(-50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive modal - Adapt the modal for smaller screens */
    @media (max-width: 768px) {
        .modal-content {
            width: 90%;
            padding: 15px;
        }
        .modal-content h3 {
            font-size: 22px;
        }
        .modal-content p {
            font-size: 16px;
        }
        .modal-product-image {
            width: 100%; /* For small screens, let the image take the full width */
            height: auto;
        }
    }
    </style>

    <!-- Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){
            w[l]=w[l]||[];w[l].push({
                'gtm.start':
                    new Date().getTime(),event:'gtm.js'
            }); var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-KPF2H97H');
    </script>
    <!-- End Google Tag Manager -->

</head>
<body>
    <header id="top">
        <div class="container">
            <h1><i class="fas fa-store"></i> Smart Cart</h1>
            <nav>
                <ul>
                    <li><a href="homepage.php">Home</a></li>
                    <li><a href="#predictionResult">Prediction</a></li>
                    <li><a href="#recommendations">Recommendations</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="prediction" class="content">
        <div class="container">
            <h2>Sales Prediction by Hierarchical Clustering Model - Visual Output</h2>
            <!-- Loading Screen -->
            <div id="loading-screen">
                <div class="spinner"></div>
                <p>Processing your document, please wait...</p>
            </div>
            <form method="POST" enctype="multipart/form-data" id="uploadForm" class="salesform">
                <label for="salesFile">Upload Sales Data (Excel):</label>
                <input type="file" id="salesFile" name="salesFile" accept=".xlsx" required>
                <button type="submit" class="btn">Predict Sales</button>
            </form>
            <br>
            <div id="predictionResult" class="result">
                <?php if (isset($response_data)) { ?>
                    <h2>Sales Analysis</h2>
                    <div id="predictionResult-container">
                        <!-- Display the images only -->
                        <h3>Dendrogram:</h3>
                        <img src="<?= htmlspecialchars($response_data['dendrogram_image']) ?>" alt="Dendrogram">

                        <h3>Cluster Plot:</h3>
                        <img src="<?= htmlspecialchars($response_data['cluster_image']) ?>" alt="Cluster Plot">
                    </div>
                <?php } ?>
            </div>
            <br>
            <!-- Display recommended products -->
            <h2>Recommended Products</h2>
            <div id="recommendations" class="result">
                <?php if (isset($response_data['top_3_products'])) { ?>
                    <ul>
                        <?php foreach ($response_data['top_3_products'] as $product) { ?>
                            <li>
                                <strong><?php echo htmlspecialchars($product['Product Name']); ?></strong>
                                <div class="img-container">
                                    <img src="<?= htmlspecialchars($product['Product Image']) ?>" alt="Product Image" class="img">
                                </div>
                                <div class="product-details">
                                    <span><span class="label">Sales:</span> <span class="value">$<?php echo htmlspecialchars($product['Sales']); ?></span></span>
                                    <span><span class="label">Quantity:</span> <span class="value"><?php echo htmlspecialchars($product['Quantity']); ?></span></span>
                                    <span><span class="label">Discount:</span> <span class="value"><?php echo htmlspecialchars($product['Discount']); ?>%</span></span>
                                    <span class="profit"><span class="label">Profit:</span> <span class="value">$<?php echo htmlspecialchars($product['Profit']); ?></span></span>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } else { ?>
                    <p>No recommendations available.</p>
                <?php } ?>
            </div>

            <!-- Detailed description modal (or section) -->
            <div id="product-description-modal" class="product-modal" style="display:none;">
                <div class="modal-content">
                    <span class="close-btn">&times;</span>
                    
                    <!-- Product Image -->
                    <img id="modal-product-image" src="#" alt="Product Image" class="modal-product-image">
                    
                    <!-- Product Name -->
                    <h3 id="modal-product-name"></h3>
                    
                    <!-- Product Description -->
                    <p id="modal-product-description"></p>
                    
                    <!-- Product Price -->
                    <p id="modal-product-price" class="product-price"></p>

                    <!-- Product Profit -->
                    <p id="modal-product-profit" class="product-profit"></p>
                    
                    <!-- Additional details can go here -->
                </div>
            </div>

        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Smart Cart. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scroll to Top Icon -->
    <a href="#" id="scrollToTopBtn" style="display: block;"><i class="fas fa-chevron-up"></i></a>

    <script src="scripts.js"></script>
    <script>
        // Get the form and loading screen elements
        var uploadForm = document.getElementById("uploadForm");
        var loadingScreen = document.getElementById("loading-screen");

        // Show loading screen when form is submitted
        uploadForm.onsubmit = function() {
            loadingScreen.style.display = "block"; // Show loading screen
        };
    </script>
    <script>
        document.querySelectorAll('#recommendations li').forEach(function(productItem, index) {
            productItem.addEventListener('click', function() {
                // Fetch product data from the list (assuming it's available)
                const product = <?php echo json_encode($response_data['top_3_products']); ?>[index];
                
                // Populate modal fields with product details
                document.getElementById('modal-product-name').textContent = product['Product Name'];
                document.getElementById('modal-product-description').textContent = product['Description'] || 'No description available'; // Default if no description
                
                // Populate the product price, or display "Price not available" if undefined
                const price = product['Price'];
                document.getElementById('modal-product-price').textContent = price ? 'Price: $' + price : 'Price not available';

                // Populate the product profit, or display "Profit not available" if undefined
                const profit = product['Profit'];
                const profitElement = document.getElementById('modal-product-profit');

                // If profit exists, wrap both the "Profit:" and the value in a span for bold and green styles
                if (profit) {
                    profitElement.innerHTML = '<span style="font-weight: bold;">Profit: <span style="color: #27ae60;">$' + profit + '</span></span>';
                } else {
                    profitElement.textContent = 'Profit not available';
                }
                
                // Set the product image (or show a placeholder if the image is missing)
                const imageUrl = product['Product Image'] || 'default-placeholder-image-url'; // Use your placeholder URL
                document.getElementById('modal-product-image').src = imageUrl;
                
                // Show the modal
                document.getElementById('product-description-modal').style.display = 'block';
            });
        });

        // Handle modal close
        document.querySelector('.close-btn').addEventListener('click', function() {
            document.getElementById('product-description-modal').style.display = 'none';
        });

        // Optionally, close modal when clicking outside the modal content
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('product-description-modal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KPF2H97H"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->  

</body>
</html>