<? //This file is the property of «Duckcode», Russia ?>
<!DOCTYPE html>
    <html class="no-js" lang="ru">
<head>
    <base href="<?=BASE_URL?>">
    <? foreach($styles as $style):?>
        <link rel="stylesheet" type="text/css" media="screen" href="/<?=CSS_DIR . $style?>.css" />
    <? endforeach ?>
    <title><?=$title?></title>
</head>

<body>

<?=$content?>

</body>

</html>