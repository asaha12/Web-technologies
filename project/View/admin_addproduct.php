<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header("Location: ../View/login.php");
    exit();
}
?>

<?php include 'admin_header.php';?>
    <title>Add Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        h1 {
            text-align: center;
        }
        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px #ccc;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"], input[type="file"] {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        .error {
            display: none;
            color: red;
            margin-bottom: 10px;
        }
        input.error {
            border-color: red;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }
        input[type="submit"]:hover {
            background-color: #3e8e41;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Hide error messages on page load
            $(".error").hide();

            // Function to remove error message when input is typed in
            $("input[type='text'], input[type='number'], input[type='file']").on("input", function() {
                var id = $(this).attr("id");
                $("#" + id + "-error").hide();
                $(this).removeClass("error");
            });

            $("#add-product-form").submit(function(event) {
                // Stop form from submitting normally
                event.preventDefault();

                // Get form data
                var formData = new FormData($(this)[0]);

                // Check for required fields
                var name = $("input[name='name']").val();
                var quantity = $("input[name='quantity']").val();
                var price = $("input[name='price']").val();
                var image = $("input[name='image']").val();

                var valid = true;
                if (name == "") {
                    valid = false;
                    $("input[name='name']").addClass("error");
                    $("#name-error").show();
                }
                if (quantity == "") {
                    valid = false;
                    $("input[name='quantity']").addClass("error");
                    $("#quantity-error").show();
                }
                if (price == "") {
                    valid = false;
                    $("input[name='price']").addClass("error");
                    $("#price-error").show();
                }
                if (image != "") {
                    var extension = image.split('.').pop().toLowerCase();
                    if (jQuery.inArray(extension, ['jpg', 'jpeg', 'png', 'gif']) == -1) {
                        valid = false;
                        $("input[name='image']").addClass("error");
                        $("#image-error").show().text("Error: Only JPG, JPEG, PNG, and GIF files are allowed.");
                    }
                }

                if (valid) {
                    // Send form data using AJAX
                    $.ajax({
                        url: "../Controller/admin_addproductC.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            alert(data);
                            $("#add-product-form")[0].reset();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert("Error adding product: " + errorThrown);
                        }
                    });
                }
            });
        });
    </script>
</head>
<body>
    <h1>Add Product</h1>
    <form id="add-product-form" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name"><br>
        <span class="error" id="name-error">Please enter a name.</span><br>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" min="1" id="quantity"><br>
        <span class="error" id="quantity-error">Please enter an amount greater than zero.</span><br>
        
        <label for="price">Price:</label>
    <input type="number" name="price" min="0.01" step="0.01" id="price"><br>
    <span class="error" id="price-error">Please enter a price greater than zero.</span><br>

    <label for="image">Image:</label>
    <input type="file" name="image" id="image"><br>
    <span class="error" id="image-error"></span><br>

    <input type="submit" value="Add Product">
</form>
