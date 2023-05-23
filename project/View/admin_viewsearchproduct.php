<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header("Location: ../View/login.php");
    exit();
}
?>

<?php include 'admin_header.php';?>
    <title>View/Search Products</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            text-align: left;
            padding: 8px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        img {
            max-width: 100px;
        }
        .search-box {
            margin-top: 20px;
        }
        .suggestions {
            margin-top: 5px;
            position: absolute;
            background-color: #f1f1f1;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ccc;
            z-index: 1;
        }
        .suggestion {
            padding: 5px;
            cursor: pointer;
        }
        .suggestion:hover {
            background-color: #ccc;
        }
    </style>
</head>
<body>
    <?php
        include('../Model/dbconnection.php');
        // Fetch all products from the database
        $sql = "SELECT * FROM products";
        $result = mysqli_query($conn, $sql);
    ?>

    <h1>View/Search Products</h1>

    <div class="search-box">
    <input type="text" id="search-box-input" placeholder="Search by name...">
    <button id="search-button">Search</button>
    <div class="suggestions"></div>
</div>


    <table id="product-table">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
        </tr>
        <?php while ($row = mysqli_fetch_array($result)) { ?>
            <tr class="product-row">
    <td><?php echo $row['id']; ?></td>
    <td><img src="<?php echo $row['image']; ?>"></td>
    <td><?php echo $row['name']; ?></td>
    <td>$<?php echo $row['price']; ?></td>
</tr>
<?php } ?>
    </table>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $('#search-button').on('click', function() {
    searchProducts($('#search-box-input').val());
    function searchProducts(query) {
    $('.product-row').hide(); // hide all products
    $('.product-row').filter(function() {
        return $(this).find('td:nth-child(3)').text().toLowerCase().includes(query.toLowerCase());
    }).show(); // show only the matching products
}

    $('#search-box-input').autocomplete({
    source: function(request, response) {
        var query = request.term.toLowerCase();
        var suggestions = [];
        $('.product-row').each(function() {
            var name = $(this).find('td:nth-child(3)').text().toLowerCase();
            if (name.includes(query) && !suggestions.includes(name)) {
                suggestions.push(name);
            }
        });
        response(suggestions);
    },
    select: function(event, ui) {
        searchProducts(ui.item.value);
    }
});

});
</script><br>
<?php include 'footer.php';?>