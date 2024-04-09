<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
        theme: {
            extend: {
            colors: {
                primary: '#000',
                'primary-foreground': '#FFF',
            }
            }
        }
        }
    </script>
    <title>Dashboard</title>
</head>
<body>
    <h1 class="text-3xl font-bold">Newsletters not sent:</h1>
    <table class="table-auto">
        <tbody>
            <tr class="border border-sky-500 divide-x divide-sky-500">
                <td>title</td>
                <td>interests</td>
                <td>users</td>
            </tr>
            <?php foreach ($newslettersPending as $newsletter): ?>
                <tr class="border border-sky-500 divide-x divide-sky-500">
                    <td><?= $newsletter->title ?></td>
                    <td>
                        <?php foreach ($newsletter->interests as $interest): ?>
                            <?= $interest ?><br>
                        <?php endforeach; ?>
                    </td>
                    <td>
                        <?php foreach ($newsletter->subscribedUsers as $user): ?>
                            <ul><?= $user->firstName ?> <?= $user->lastName ?>
                                <li>profession: <?= $user->profession ?></li>
                                <li>email: <?= $user->email ?></li>
                            </ul>
                            <br>
                        <?php endforeach; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>