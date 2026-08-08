<?php 
// Include the database connection
include('db.php');

// Check if parentId is set
if (isset($_POST['parentId'])) {
    $parentId = $_POST['parentId'];

    // Fetch children based on parentId
    $sql = "SELECT * FROM countrydata WHERE parentId = :parentId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':parentId', $parentId, PDO::PARAM_INT);
    $stmt->execute();

    $countries = array();

    // Fetch results as associative array
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $countries[] = $row;
    }

    echo json_encode($countries); // Return data as JSON
} else {
    // Fetch the top-level parents (where parentId is NULL)
    $sql = "SELECT * FROM countrydata WHERE parentId = 0";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $parents = array();

    // Fetch results as associative array
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $parents[] = $row;
    }

    echo json_encode($parents); // Return data as JSON
}
?>
