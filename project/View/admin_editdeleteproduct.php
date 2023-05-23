<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header("Location: ../View/login.php");
    exit();
}
?>

<?php include 'admin_header.php';?>
	<title>Admin - Edit/Delete Products</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			// Load the list of products on page load
			loadProducts();

			// Handle form submission for editing a product
			$('#edit-product-form').submit(function(event) {
				event.preventDefault();

				var form = $(this);
				var productId = form.find('input[name="product-id"]').val();
				var name = form.find('input[name="name"]').val();
				var quantity = form.find('input[name="quantity"]').val();
				var price = form.find('input[name="price"]').val();

				// Send an AJAX request to update the product
				$.ajax({
					url: '../Controller/admin_editdeleteproductC.php',
					type: 'POST',
					data: {
						action: 'edit',
						productId: productId,
						name: name,
						quantity: quantity,
						price: price
					},
					success: function(response) {
						// Reload the list of products
						loadProducts();

						// Clear the form fields
						form.find('input[name="name"]').val('');
						form.find('input[name="quantity"]').val('');
						form.find('input[name="price"]').val('');

						// Display a success message
						alert(response);
					},
					error: function(xhr, status, error) {
						alert("Error updating product: " + xhr.responseText);
					}
				});
			});

			// Handle form submission for deleting a product
			$('#delete-product-form').submit(function(event) {
				event.preventDefault();

				var form = $(this);
				var productId = form.find('input[name="product-id"]').val();

				// Send an AJAX request to delete the product
				$.ajax({
					url: '../Controller/admin_editdeleteproductC.php',
					type: 'POST',
					data: {
						action: 'delete',
						productId: productId
					},
					success: function(response) {
						// Reload the list of products
						loadProducts();

						// Clear the form field
						form.find('input[name="product-id"]').val('');

						// Display a success message
						alert(response);
					},
					error: function(xhr, status, error) {
						alert("Error deleting product: " + xhr.responseText);
					}
				});
			});
		});

		// Load the list of products from the server
		function loadProducts() {
			$.ajax({
				url: '../Controller/admin_editdeleteproductC.php',
				type: 'POST',
				data: {
					action: 'get-products'
				},
				success: function(response) {
					$('#product-list').html(response);
				},
				error: function(xhr, status, error) {
					alert("Error loading products: " + xhr.responseText);
				}
			});
		}

		// Display the edit form for the selected product
		function editProduct(productId, name, quantity, price) {
			// Set the form values to the current product details
			$('#edit-product-form').find('input[name="product-id"]').val(productId);
			$('#edit-product-form').find('input[name="name"]').val(name);
			$('#edit-product-form').find('input[name="quantity"]').val(quantity);
			$('#edit-product-form').find('input[name="price"]').val(price);

			// Show the edit form and hide the product list
$('#edit-product-form').show();
$('#product-list').hide();
}

// Hide the edit form and show the product list
function cancelEdit() {
$('#edit-product-form').hide();
$('#product-list').show();
}
</script>

</head>
<body>
<style>
		/* Style the heading */
		h1 {
			color: navy;
			font-size: 36px;
			margin-bottom: 20px;
		}

		/* Style the form labels */
		label {
			display: block;
			font-weight: bold;
			margin-bottom: 5px;
		}

		/* Style the input fields */
		input[type="text"],
		input[type="number"] {
			padding: 5px;
			border: 1px solid #ccc;
			border-radius: 3px;
			width: 200px;
		}

		input[type="submit"],
		input[type="button"] {
			padding: 5px 10px;
			background-color: navy;
			color: #fff;
			border: none;
			border-radius: 3px;
			cursor: pointer;
		}

		input[type="submit"]:hover,
		input[type="button"]:hover {
			background-color: #0066cc;
		}

		/* Style the product list */
		#product-list {
			margin-top: 20px;
		}

		#product-list table {
			border-collapse: collapse;
			width: 100%;
		}

		#product-list th,
		#product-list td {
			padding: 5px;
			text-align: left;
			border: 1px solid #ccc;
		}

		#product-list th {
			background-color: navy;
			color: #fff;
		}

		/* Style the edit/delete forms */
		#edit-product-form,
		#delete-product-form {
			margin-top: 20px;
		}

		#edit-product-form label,
		#delete-product-form label {
			display: inline-block;
			width: 80px;
		}

		#edit-product-form input[type="submit"],
		#edit-product-form input[type="button"],
		#delete-product-form input[type="submit"] {
			margin-top: 10px;
			margin-left: 80px;
		}

		#edit-product-form input[type="button"] {
			margin-left: 10px;
		}
	</style>
	<h1>Admin - Edit/Delete Products</h1>
    <div id="product-list"></div>

<div id="edit-product-form" style="display:none;">
	<h2>Edit Product</h2>
	<form>
		<input type="hidden" name="product-id" />
		<label>Name:</label>
		<input type="text" name="name" /><br/>
		<label>Quantity:</label>
		<input type="number" name="quantity" /><br/>
		<label>Price:</label>
		<input type="number" name="price" /><br/>
		<input type="submit" value="Save" />
		<input type="button" value="Cancel" onclick="cancelEdit();" />
	</form>
</div>
<br>
<div id="delete-product-form">
	<h2>Delete Product</h2>
	<form>
		<label>Product ID:</label>
		<input type="number" name="product-id" /><br/>
		<input type="submit" value="Delete" />
	</form>
</div>
</body>
</html> <br>
<?php include 'footer.php';?>