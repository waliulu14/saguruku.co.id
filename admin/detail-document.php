<?php
include '../include/config.php';
include 'include/navbar.php';

function formatNumberedList($content) {
    $lines = explode("\n", $content);
    $formattedContent = "";
    
    foreach ($lines as $line) {
        if (!empty($line)) {
            if (preg_match('/^\d+\./', trim($line), $matches)) {
                $formattedContent .= "</p><p>{$line}";
            } else {
                $formattedContent .= " {$line}";
            }
        }
    }

    return $formattedContent;
}

if (isset($_GET['id'])) {
    $serviceDetailId = $_GET['id'];

    $sql = "SELECT service_details.*, services.title AS service_name FROM service_details
            LEFT JOIN services ON service_details.service_id = services.id
            WHERE service_details.id = $serviceDetailId";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
?>

<div class="container-fluid" id="container-wrapper">
    <h2><?php echo "{$row['service_name']} - Detail Document"; ?></h2>
    
    <p><strong>Details Text:</strong></p>
    <p><?php echo nl2br($row['details_text']); ?></p>
    
    <p><strong>Additional Info:</strong></p>
    <p><?php echo nl2br($row['additional_info']); ?></p>
    
    <p><strong>Persyaratan:</strong></p>
    <p><?php echo formatNumberedList($row['persyaratan']); ?></p>

    <?php
    // Display a link to the document if it exists
    if (!empty($row['document_path']) && file_exists("../uploads/documents/{$row['document_path']}")) {
        echo "<p><strong>Document:</strong></p>";
        echo "<p><a href='../uploads/documents/{$row['document_path']}' target='_blank'>View Document</a></p>";
    } else {
        echo "<p>Document not found.</p>";
    }
    ?>
</div>

<?php
    } else {
        echo "Document not found.";
    }
} else {
    echo "Invalid request.";
}

include 'include/footer.php';
?>
