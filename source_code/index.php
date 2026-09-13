<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Achievement Record System</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Student Achievement Record System</h1>
        <p>Add and view student achievement records.</p>
    </header>

    <nav>
        <a href="index.php">Add Achievement</a>
        <a href="view.php">View Records</a>
        <a href="search.php">Search Records</a>
    </nav>

    <main>
        <section class="form-container">
            <h2>Achievement Entry Form</h2>

            <form action="save.php" method="POST">

                <label for="competition">Competition:</label>
                <input
                    type="text"
                    id="competition"
                    name="competition"
                    required
                >

                <label for="award">Award:</label>
                <input
                    type="text"
                    id="award"
                    name="award"
                    required
                >

                <label for="year">Year:</label>
                <input
                    type="number"
                    id="year"
                    name="year"
                    required
                >

                <label for="level">Level:</label>
                <input
                    type="text"
                    id="level"
                    name="level"
                    required
                >

                <button type="submit">Add Achievement</button>

            </form>
        </section>
    </main>

</body>
</html>