<!-- Новости-->
<h1>Новости</h1>
<?
	//----------------------------------------Только для администратора-----------------------------
	
?>
<a href="index.php?c=newnews">Добавить новость</a>
<?
	if(count($news) == 0)
	{
		//
		// Отрисовка сообщение в случае отсутствия новостей
		//
?>
		
		<h3>Нет новостей</h3>
	
<?	}
	else
	{
		foreach($news as $val)
		{
			if(!empty($val['action']))
			{
				//
				// Добавление оформления для новости
				// участвующей в акции
				//
?>
				<ul type="none" style="background: #ccc">
				
				<li>
					<h3>Акция!</h3>
				</li>
					
<?		}
			else
			{
?>
				<ul type="none">
<?		}
?>				<li>
						 <h2>
						 
							<a href="index.php?c=singlenews&id=<?=$val['id']?>">
								<?=$val["title"]?>
							</a>
							
						 </h2>
					 </li>
					 
					 <li>
						<?=$val["content"]?>
					 </li>
					 
					<li>
						<i>Опубликовано: <?=$val["pubdate"]?></i>
					</li>
				
			
			</ul>
			
			<hr>
		<?}
	}

