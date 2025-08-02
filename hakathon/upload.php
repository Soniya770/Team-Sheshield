<?php 
// upload.php
// $uploadMessage = '';
// $uploadDir = 'images/';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if (!is_dir($uploadDir)) {
//         mkdir($uploadDir, 0755, true);
//     }

//     if (!empty($_FILES)) {
//         if (isset($_FILES['incidentImage'])) {
//             $file = $_FILES['incidentImage'];
//         } elseif (isset($_FILES['incidentVideo'])) {
//             $file = $_FILES['incidentVideo'];
//         } else {
//             http_response_code(400);
//             echo "No valid file uploaded.";
//             exit;
//         }

//         if ($file['error'] === UPLOAD_ERR_OK) {
//             $tmpName = $file['tmp_name'];
//             $originalName = $file['name'];
//             $extension = pathinfo($originalName, PATHINFO_EXTENSION);
//             $newFileName = uniqid('upload_', true) . '.' . $extension;
//             $destination = $uploadDir . $newFileName;

//             if (move_uploaded_file($tmpName, $destination)) {
//                 echo "File uploaded successfully as: " . htmlspecialchars($newFileName);
//             } else {
//                 http_response_code(500);
//                 echo "Failed to move uploaded file.";
//             }
//         } else {
//             http_response_code(400);
//             echo "Upload error code: " . $file['error'];
//         }
//     } else {
//         http_response_code(400);
//         echo "No file uploaded.";
//     }
// } else {
//     http_response_code(405);
//     echo "Method not allowed";
// }
// ?>


<?php
$uploadMessage = '';
$uploadDirImages = 'images/';
$uploadDirVideos = 'videos/';
$uploadDirVoices = 'voices/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create folders if they don't exist
    if (!is_dir($uploadDirImages)) mkdir($uploadDirImages, 0755, true);
    if (!is_dir($uploadDirVideos)) mkdir($uploadDirVideos, 0755, true);
    if (!is_dir($uploadDirVoices)) mkdir($uploadDirVoices, 0755, true);

    if (!empty($_FILES)) {
        if (isset($_FILES['incidentImage'])) {
            $file = $_FILES['incidentImage'];
            $destinationFolder = $uploadDirImages;
        } elseif (isset($_FILES['incidentVideo'])) {
            $file = $_FILES['incidentVideo'];
            $destinationFolder = $uploadDirVideos;
        } elseif (isset($_FILES['voiceRecord'])) {
            $file = $_FILES['voiceRecord'];
            $destinationFolder = $uploadDirVoices;
        } else {
            echo "No valid file uploaded.";
            exit;
        }

        if ($file['error'] === UPLOAD_ERR_OK) {
            $tmpName = $file['tmp_name'];
            $originalName = $file['name'];
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
            $newFileName = uniqid('upload_', true) . '.' . $extension;
            $destination = $destinationFolder . $newFileName;

            if (move_uploaded_file($tmpName, $destination)) {
                echo "File uploaded successfully as: " . htmlspecialchars($newFileName);
                exit;
            } else {
                echo "Failed to move uploaded file.";
                exit;
            }
        } else {
            echo "Upload error code: " . $file['error'];
            exit;
        }
    } else {
        echo "No file uploaded.";
        exit;
    }
}
?>
