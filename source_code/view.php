<?php

require_once "config.php";

$sql = "SELECT achievement_id, competition, award, year, level
        FROM achievements
        ORDER BY achievement_id DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Unable to retrieve achievement records.");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Achievement Records</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Student Achievement Record System</h1>
        <p>View saved achievement records.</p>
    </header>

    <nav>
        <a href="index.php">Add Achievement</a>
        <a href="view.php">View Records</a>
        <a href="search.php">Search Records</a>
    </nav>

    <main>
        <section class="form-container">

            <h2>Achievement Records</h2>

            <?php if (mysqli_num_rows($result) > 0): ?>

                <table border="1" cellpadding="10" cellspacing="0" width="100%">

                    <tr>
                        <th>ID</th>
                        <th>Competition</th>
                        <th>Award</th>
                        <th>Year</th>
                        <th>Level</th>
                        <th>Action</th>
                    </tr>

                    <?php while ($row = mysqli_fetch_assoc($result)): ?>

                        <tr>

                            <td>
                                <?php echo htmlspecialchars($row["achievement_id"]); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row["competition"]); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row["award"]); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row["year"]); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row["level"]); ?>
                            </td>

                            <td>
                                <a href="edit.php?id=<?php echo htmlspecialchars($row["achievement_id"]); ?>">
                                    Edit
                                </a>
                            </td>

                        </tr>

                    <?php endwhile; ?>

                </table>

            <?php else: ?>

                <p>No achievement records found.</p>

            <?php endif; ?>

        </section>
    </main>

</body>
</html>

<?php

mysqli_free_result($result);
mysqli_close($conn);

?>