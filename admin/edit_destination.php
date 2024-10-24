<?php
include 'db.php';
include 'add_edit_style.php';

$id = $_GET['id'];
$query = $conn->prepare("SELECT * FROM destinations WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$destination = $query->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $highlights = $_POST['highlights'];
    $itinerary = $_POST['itinerary'];
    $included = $_POST['included'];
    $excluded = $_POST['excluded'];
    $address = $_POST['address'];

    // Handle file upload if a new image is selected
    $uploadOk = 1;
    $target_file = null;
    $image = $destination['image']; // Default to existing image

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 5000000) { // 5MB limit
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
                $image = $target_file; // Update image path
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    $query = $conn->prepare("UPDATE destinations SET name=?, location=?, image=?, description=?, highlights=?, itinerary=?, included=?, excluded=?, address=? WHERE id=?");
    $query->bind_param("sssssssssi", $name, $location, $image, $description, $highlights, $itinerary, $included, $excluded, $address, $id);
    $query->execute();

    header("Location: list-destination.php");
    exit(); // Ensure no further code execution after redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Destination</title>
    <style>
        .back-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 2px;
            cursor: pointer;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"], input[type="file"], textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 2px;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <button type="button" class="back-button" onclick="window.location.href='list-destination.php'">Back</button>
    <h2>Edit Destination</h2>

    <div class="container">
        <form method="POST" action="edit_destination.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo $destination['name']; ?>" required>

            <label for="location">Location</label>
            <input type="text" id="location" name="location" value="<?php echo $destination['location']; ?>" required>

            <!-- Input field to select image -->
            <label for="image">Choose Image</label>
            <input type="file" id="image" name="image">
            <?php if (!empty($destination['image']) && file_exists($destination['image'])): ?>
                <img src="<?php echo $destination['image']; ?>" alt="Current Image" style="max-width: 100px; margin-top: 10px;">
            <?php else: ?>
                <p>No image uploaded yet.</p>
            <?php endif; ?>

            <label for="description">Description</label>
            <textarea id="description" name="description" required><?php echo $destination['description']; ?></textarea>

            <label for="highlights">Highlights</label>
            <textarea id="highlights" name="highlights" required><?php echo $destination['highlights']; ?></textarea>

            <label for="itinerary">Itinerary</label>
            <textarea id="itinerary" name="itinerary" required><?php echo $destination['itinerary']; ?></textarea>

            <label for="included">Included</label>
            <textarea id="included" name="included" required><?php echo $destination['included']; ?></textarea>

            <label for="excluded">Excluded</label>
            <textarea id="excluded" name="excluded" required><?php echo $destination['excluded']; ?></textarea>

            <label for="address">Address</label>
            <textarea id="address" name="address" required><?php echo $destination['address']; ?></textarea>

            <button type="submit">Update Destination</button>
        </form>
    </div>
</body>
</html>