<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
</head>

<body>

    <h1>Student List</h1>

    <ul>
        <?php foreach ($students as $student): ?>

            <li><?= esc($student) ?></li>

        <?php endforeach; ?>
    </ul>

</body>
</html>