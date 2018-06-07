<!DOCTYPE html>
<html>
<head>
    <title>Chat - Login</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1"/>
    <link href="<?php echo BASE_URL; ?>assets/css/login.css" rel="stylesheet" type="text/css">
    <style>
    </style>
</head>
<body>
    <div class="container">
        <h3>Login</h3>
        <form action="<?php echo BASE_URL; ?>login/signin" method="POST">
            <label for="username">Usuário</label>
            <input type="text" name="username"/><br/><br/>

            <label for="password">Senha</label>
            <input type="password" name="password"/><br/><br/>

            <input type="submit" value="Logar"><br/><br/>
        </form>
        <a href="<?php echo BASE_URL; ?>login/signup">Cadastre-se</a>
        <?php if (!empty($msg)): ?>
            <div class="warning"><?php echo $msg; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>