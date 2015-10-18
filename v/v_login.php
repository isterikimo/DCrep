<?  //This file is the property of «Duckcode», Russia
    // Шаблон авторизации пользователя
$mUsers = M_Users::instance();
$mUsers->clearSession();
$user = $mUsers->get();
if($user == null):
?>

<h1>Авторизация</h1>
<form method="post">

    <label>
        Email:
        <br/>
        <input name="login" type="text" value=""/>
        <br/>
    </label>

    <label>
        Пароль:
        <br/>
        <input name="password" type="password" value=""/>
        <br/>
    </label>

    <label>
        <input type="checkbox" name="remember" /> запомнить меня
    </label>

    <br/>
    <input name="enter" type="submit" value="Войти"/>
    <br/>
    <br/>
    <a href="/">Главная страница</a>
</form>
<? else: ?>

<h3> Вход выполнен</h3>
<p> Добро пожаловать, <?=$user['name']?></P>
<form method="post">
    <input name="exit" type="submit" value="Выйти">
</form>
<PRE>
<? endif;

$privs = $mUsers->can('str');

print_r($privs);
?>
    </PRE>