<?php

require_once "config.php";

if (!isset($_GET["id"]) || !filter_var($_GET["id"], FILTER_VALIDATE_INT)) {
    die("Invalid achievement record.");
}

$achievement_id = (int) $_GET["id"];

$sql = "SELECT competition, award, year, level
        FROM achievements
        WHERE achievement_id = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Unable to retrieve the achievement record.");
}

mysqli_stmt_bind_param($stmt, "i", $achievement_id);
mysqli_stmt_execute($stmt);

mysqli_stmt_bind_result($stmt, $competition, $award, $year, $level);

if (!mysqli_stmt_fetch($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    die("Achievement record not found.");
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Achievement</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Student Achievement Record System</h1>
        <p>Edit achievement record.</p>
    </header>

    <nav>
        <a href="index.php">Add Achievement</a>
        <a href="view.php">View Records</a>
        <a href="search.php">Search Records</a>
    </nav>

    <main>
        <section class="form-container">

            <h2>Edit Achievement</h2>

            <form action="update.php" method="POST">

                <input
                    type="hidden"
                    name="achievement_id"
                    value="<?php echo htmlspecialchars($achievement_id); ?>"
                >

                <label for="competition">Competition:</label>
                <input
                    type="text"
                    id="competition"
                    name="competition"
                    value="<?php echo htmlspecialchars($competition); ?>"
                    required
                >

                <label for="award">Award:</label>
                <input
                    type="text"
                    id="award"
                    name="award"
                    value="<?php echo htmlspecialchars($award); ?>"
                    required
                >

                <label for="year">Year:</label>
                <input
                    type="number"
                    id="year"
                    name="year"
                    value="<?php echo htmlspecialchars($year); ?>"
                    required
                >

                <label for="level">Level:</label>
                <input
                    type="text"
                    id="level"
                    name="level"
                    value="<?php echo htmlspecialchars($level); ?>"
                    required
                >

                <button type="submit">Update Achievement</button>

            </form>

        </section>
    </main>

</body>
</html>