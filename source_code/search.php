<?php

require_once "config.php";

$search = trim($_GET["search"] ?? "");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Achievement Records</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Student Achievement Record System</h1>
        <p>Search achievement records.</p>
    </header>

    <nav>
        <a href="index.php">Add Achievement</a>
        <a href="view.php">View Records</a>
        <a href="search.php">Search Records</a>
    </nav>

    <main>
        <section class="form-container">

            <h2>Search Achievement Records</h2>

            <form action="search.php" method="GET">

                <label for="search">Search:</label>

                <input
                    type="text"
                    id="search"
                    name="search"
                    value="<?php echo htmlspecialchars($search); ?>"
                    placeholder="Enter competition, award, year or level"
                >

                <button type="submit">Search</button>

            </form>

            <?php

            if ($search !== "") {

                $sql = "SELECT achievement_id, competition, award, year, level
                        FROM achievements
                        WHERE competition LIKE ?
                        OR award LIKE ?
                        OR CAST(year AS CHAR) LIKE ?
                        OR level LIKE ?
                        ORDER BY achievement_id DESC";

                $stmt = mysqli_prepare($conn, $sql);

                if (!$stmt) {
                    die("Unable to perform the search.");
                }

                $search_value = "%" . $search . "%";

                mysqli_stmt_bind_param(
                    $stmt,
                    "ssss",
                    $search_value,
                    $search_value,
                    $search_value,
                    $search_value
                );

                mysqli_stmt_execute($stmt);

                mysqli_stmt_bind_result(
                    $stmt,
                    $achievement_id,
                    $competition,
                    $award,
                    $year,
                    $level
                );

                $found = false;

                echo "<h2>Search Results</h2>";

                echo "<table border='1' cellpadding='10' cellspacing='0' width='100%'>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Competition</th>";
                echo "<th>Award</th>";
                echo "<th>Year</th>";
                echo "<th>Level</th>";
                echo "</tr>";

                while (mysqli_stmt_fetch($stmt)) {

                    $found = true;

                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($achievement_id) . "</td>";
                    echo "<td>" . htmlspecialchars($competition) . "</td>";
                    echo "<td>" . htmlspecialchars($award) . "</td>";
                    echo "<td>" . htmlspecialchars($year) . "</td>";
                    echo "<td>" . htmlspecialchars($level) . "</td>";
                    echo "</tr>";
                }

                echo "</table>";

                if (!$found) {
                    echo "<p>No matching achievement records found.</p>";
                }

                mysqli_stmt_close($stmt);
            }

            mysqli_close($conn);

            ?>

        </section>
    </main>

</body>
</html>