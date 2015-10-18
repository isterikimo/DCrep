<!-- Страница отдельной новости-->
<?
	foreach($news as $s_news)
	{
		if(!empty($s_news['action']))
		{
			//
			// Добавление оформления для новости
			// участвующей в акции
			//
?>
			<h3>Акция!</h3>
<?	}
			//
			// Отрисовка новости
			//
?>
			<h1><?=$s_news["title"]?></h1>
			<?=$s_news["content"]?>
			<p>
			<i>Опубликовано: 
			<?=$s_news["pubdate"]?></i>

<?//----------------------------------------Только для администратора-----------------------------

	//
	// Форма с кнопками Редактировать и Удалить
	//
?>
	<form method="post">
		<input type="hidden" name="id_news" value="<?=$s_news['id']?>">
		<input type="submit" name="edit" value="Редактировать">
		<input type="submit" name="del" value="Удалить">
	</form>
			
	<hr>
<?
	}