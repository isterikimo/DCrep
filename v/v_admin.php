<? //This file is the property of «Duckcode», Russia?>
<!DOCTYPE html>
<html>
<head>
    <? foreach($styles as $style): ?>
    <link rel="stylesheet" type="text/css" media="screen" href="<?=CSS_DIR . $style?>.css">
    <? endforeach; ?>

    <? foreach($scripts as $script): ?>
        <script type="text/javascript" href="<?=JS_DIR . $style?>.js"></script>
    <? endforeach; ?>
    <title>
        <?=$title?>
    </title>
</head>
<body>

    <div id="user-panel">
        <b>Пользователь:</b> <?=$user['name']?><br/>
        <b>Статус:</b> Авторизован<br/>
        <b>Привелегии:</b> Администратор<br/>
        <p><input type="button" value="Выйти"/></p>
    </div>

    <h1>Панель администрирования сайта</h1>

    <?=$content?>
</body>
</html>