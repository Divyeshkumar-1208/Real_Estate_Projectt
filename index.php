<?php
include 'db.php';

$sql = "SELECT * FROM properties";
$result = $conn->query($sql);

// Fetch distinct locations for the dropdown options
$locationQuery = "SELECT DISTINCT location FROM properties";
$locationResult = $conn->query($locationQuery);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Real Estate Listings</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Real Estate</a>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Available Properties</h1>

        <!-- Search Form -->
        <form method="GET" action="search.php" class="mb-4">
            <div class="form-row">
                <div class="col-md-6">
                    <select name="location" class="form-control">
                        <option value="">All Locations</option>
                        <?php while ($locationRow = $locationResult->fetch_assoc()): ?>
                            <option value="<?= $locationRow['location']; ?>">
                                <?= $locationRow['location']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
              
                <div class="col-md-4">
                    <select name="type" class="form-control">
                        <option value="">All Types</option>
                        <option value="Apartment">Apartment</option>
                        <option value="House">House</option>
                        <option value="Office">Office</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-block">Search</button>
                </div>
            </div>
        </form>

        <!-- Properties Grid -->
        <div class="row">
            <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="images/<?= $row['image']; ?>" class="card-img-top" alt="<?= $row['title']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['title']; ?></h5>
                        <p class="card-text">
                            <strong>Location:</strong> <?= $row['location']; ?><br>
                            <strong>Price:</strong> $<?= number_format($row['price'], 2); ?><br>
                            <strong>Type:</strong> <?= $row['type']; ?><br>
                            <strong>Description:</strong> <?= $row['description']; ?>
                        </p>
                        <a href="property.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-block">View Details</a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-primary text-white text-center py-3">
        <p>&copy; <?= date('Y'); ?> Real Estate. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
