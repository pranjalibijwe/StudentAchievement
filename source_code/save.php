<?php

require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request.");
}

$competition = trim($_POST["competition"] ?? "");
$award = trim($_POST["award"] ?? "");
$year = $_POST["year"] ?? "";
$level = trim($_POST["level"] ?? "");

/* Server-side validation */
if ($competition === "" || $award === "" || $year === "" || $level === "") {
    die("Please fill in all required fields.");
}

if (!filter_var($year, FILTER_VALIDATE_INT)) {
    die("Please enter a valid year.");
}

/* Secure INSERT using prepared statement */
$sql = "INSERT INTO achievements (competition, award, year, level)
        VALUES (?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Unable to save the achievement.");
}

mysqli_stmt_bind_param(
    $stmt,
    "ssis",
    $competition,
    $award,
    $year,
    $level
);

if (mysqli_stmt_execute($stmt)) {
    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "<title>Achievement Saved</title>";
    echo "<link rel='stylesheet' href='style.css'>";
    echo "</head>";
    echo "<body>";

    echo "<header>";
    echo "<h1>Student Achievement Record System</h1>";
    echo "</header>";

    echo "<main>";
    echo "<section class='form-container'>";
    echo "<h2>Achievement Saved Successfully</h2>";
    echo "<p>Your achievement record has been added to the database.</p>";
    echo "<a href='index.php'>Add Another Achievement</a><br><br>";
    echo "<a href='view.php'>View Records</a>";
    echo "</section>";
    echo "</main>";

    echo "</body>";
    echo "</html>";
} else {
    die("Unable to save the achievement.");
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>