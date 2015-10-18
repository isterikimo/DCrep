<!-- Форма для добавления новой новости -->
<form method="post">
	<fieldset>
		<legend> Добавить новость </legend>
		<table>
		
			<tr valign="top">
			
				<td>
				
					<p>Название новости</p>
					<input type="text" name="title" value="<?=$news['title']?>" />
					<br />
					<p>Содержание новости</p>
					<textarea name="content"><?=$news['content']?></textarea>
					<br />
					<input type="submit" value="Отправить" name="new"/>
					
				</td>
				
				<td>
					<p>Акция <input type="checkbox" name="action" <?=$news["action"]?>>
				</td>
				
			</tr>
			
		</table>
	</fieldset>
</from>
<p>