<?php
function handleFileUpload() {
    $uploadStatus = [
        "error" => false,
        "filePath" => null,
        "errorMessage" => ""
    ];

    if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] == 0) {
        $target_directory = "uploads/"; // Ensure this directory exists and is writable
        $target_file = $target_directory . basename($_FILES["fileUpload"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        // if (file_exists($target_file)) {
        //     $uploadStatus["error"] = true;
        //     $uploadStatus["errorMessage"] = "Sorry, file already exists.";
        //     return $uploadStatus;
        // }

        // Check file size
        // if ($_FILES["fileUpload"]["size"] > 500000) { // 500KB limit
        //     $uploadStatus["error"] = true;
        //     $uploadStatus["errorMessage"] = "Sorry, your file is too large.";
        //     return $uploadStatus;
        // }

        // Allow certain file formats
        // if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif") {
        //     $uploadStatus["error"] = true;
        //     $uploadStatus["errorMessage"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        //     return $uploadStatus;
        // }

        if ($uploadOk == 0) {
            $uploadStatus["error"] = true;
            $uploadStatus["errorMessage"] = "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
                $uploadStatus["filePath"] = $target_file;
            } else {
                $uploadStatus["error"] = true;
                $uploadStatus["errorMessage"] = "Sorry, there was an error uploading your file.";
            }
        }
    }

    return $uploadStatus;
}
?>
