<?php

require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request.");
}

$achievement_id = $_POST["achievement_id"] ?? "";
$competition = trim($_POST["competition"] ?? "");
$award = trim($_POST["award"] ?? "");
$year = $_POST["year"] ?? "";
$level = trim($_POST["level"] ?? "");

/* Server-side validation */
if (
    !filter_var($achievement_id, FILTER_VALIDATE_INT) ||
    $competition === "" ||
    $award === "" ||
    $year === "" ||
    $level === ""
) {
    die("Please enter valid achievement details.");
}

if (!filter_var($year, FILTER_VALIDATE_INT)) {
    die("Please enter a valid year.");
}

/* Secure UPDATE using prepared statement */
$sql = "UPDATE achievements
        SET competition = ?, award = ?, year = ?, level = ?
        WHERE achievement_id = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Unable to update the achievement.");
}

mysqli_stmt_bind_param(
    $stmt,
    "ssisi",
    $competition,
    $award,
    $year,
    $level,
    $achievement_id
);

if (mysqli_stmt_execute($stmt)) {

    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "<title>Achievement Updated</title>";
    echo "<link rel='stylesheet' href='style.css'>";
    echo "</head>";
    echo "<body>";

    echo "<header>";
    echo "<h1>Student Achievement Record System</h1>";
    echo "</header>";

    echo "<main>";
    echo "<section class='form-container'>";
    echo "<h2>Achievement Updated Successfully</h2>";
    echo "<p>The achievement record has been updated.</p>";
    echo "<a href='view.php'>View Records</a>";
    echo "</section>";
    echo "</main>";

    echo "</body>";
    echo "</html>";

} else {
    die("Unable to update the achievement.");
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>