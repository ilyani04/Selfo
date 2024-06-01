<?php
// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$servername = "localhost";
$username = "root";
$password = "";
$database = "educationdb2";

// Database connection
$conn = new mysqli($servername, $username, $password, $database);

$errorMessage = "";

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if 'basic_id' is set
        if (isset($_POST['basic_id'])) {
            $id = $_POST['basic_id']; // ID to delete (VARCHAR)
        } else {
            throw new Exception("Error: 'basic_id' not set.");
        }

        // Prepare a delete statement
        $stmt = $conn->prepare("DELETE FROM basic_user WHERE basic_id = ?");
        $stmt->bind_param("s", $id); // "s" indicates the parameter is a string

        // Execute the statement
        $stmt->execute();

        // Check if any row was deleted
        if ($stmt->affected_rows > 0) {
            // Record deleted successfully, redirect to listBasicUser.php
            header("Location: listBasicUser.php");
            exit;
        } else {
            $errorMessage = "No record found with the specified ID.";
        }

        // Close the statement and connection
        $stmt->close();
    }
    $conn->close();
} catch (mysqli_sql_exception $e) {
    $errorMessage = "Error: " . $e->getMessage();
} catch (Exception $e) {
    $errorMessage = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>
    <div class="container my-5">
        <h2>Delete User</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <form method="post" onsubmit="return confirmDelete()">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="basic_id" value="">
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-secondary" href="listBasicUser.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>