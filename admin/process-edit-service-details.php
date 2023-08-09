<?php
include '../include/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $detailsText = $_POST['details_text'];
    $additionalInfo = $_POST['additional_info'];
    $persyaratan = $_POST['persyaratan'];

    // Handle the uploaded document
    if (!empty($_FILES['document']['name'])) {
        $documentName = $_FILES['document']['name'];
        $documentTmpPath = $_FILES['document']['tmp_name'];
        $documentNewPath = '../uploads/documents/' . $documentName;

        if (move_uploaded_file($documentTmpPath, $documentNewPath)) {
            // Update the document path in the database
            $updateDocumentQuery = "UPDATE service_details SET document_path = '$documentName' WHERE id = $id";
            mysqli_query($conn, $updateDocumentQuery);
        }
    }

    // Update other fields in the database
    $updateQuery = "UPDATE service_details SET details_text = '$detailsText', additional_info = '$additionalInfo', persyaratan = '$persyaratan' WHERE id = $id";
    if (mysqli_query($conn, $updateQuery)) {
        header("Location: detail-service.php"); // Redirect to the details page after updating
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
