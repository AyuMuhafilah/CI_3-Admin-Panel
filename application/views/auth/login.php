<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="<?= base_url('Auth/login') ?>" method="post">
        <input type="text" name="username" placeholder="username">
        <input type="text" name="password">
        <button type="submit">Submit</button>
    </form>
</body>

</html>