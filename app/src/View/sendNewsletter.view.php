<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <select name="select_newsletter">
            <option value=""></option>
            <?php
                foreach($newsletters as $newsletter) {
                    echo "<option value=\"$newsletter->id\"";
                    echo ">$newsletter->title</option>";
                }
            ?>
        </select>
        <input type="submit" name="submit" value="submit">
    </form>
</body>
</html>