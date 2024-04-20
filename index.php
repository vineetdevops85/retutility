<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Excel File</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Upload Excel File</h1>
    <form action="process.php" method="post" enctype="multipart/form-data">
        <input type="file" name="excel_file" accept=".xls,.xlsx">
        <button type="submit" name="upload">Upload</button>
    </form>
</body>
</html>
