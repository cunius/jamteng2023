<?php
function handleFileUpload() {
    $uploadStatus = [
        "error" => false,
        "filePath" => null,
        "errorMessage" => ""
    ];

    if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] == 0) {
        $target_directory = "upload/"; // Ensure this directory exists and is writable
        $target_file = $target_directory . basename($_FILES["fileUpload"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            $uploadStatus["error"] = true;
            $uploadStatus["errorMessage"] = "오잉 이미 올렸자낭!";
            return $uploadStatus;
         }

        // Check file size
        if ($_FILES["fileUpload"]["size"] > 10000000) { // 10000KB limit
            $uploadStatus["error"] = true;
            $uploadStatus["errorMessage"] = "미안행 나의 사이즈는 10000kb 바께 안돼...";
            return $uploadStatus;
         }

        // Allow certain file formats
        if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif") {
            $uploadStatus["error"] = true;
            $uploadStatus["errorMessage"] = "유애나 편지는 JPG, JPEG, PNG, GIF 만 가능해용 🫣";
            return $uploadStatus;
         }

        if ($uploadOk == 0) {
            $uploadStatus["error"] = true;
            $uploadStatus["errorMessage"] = "오잉? 편지가 안 보내져떠 🙀";
        } else {
            if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
                $uploadStatus["filePath"] = $target_file;
            } else {
                $uploadStatus["error"] = true;
                $uploadStatus["errorMessage"] = "유애나 편지 전송 실패 🥲";
            }
        }
    }

    return $uploadStatus;
}
?>
