<div id="main_banner">
	<img src="img/banner.jpg"/>
	<span>
		Доверьте нам<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		самое дорогое!
	</span>
</div>

<div id="menu">
	<ul>

	<?foreach($menu as $val):?>

		<li><?=$val?></li>
		<table>
			<tr align="center">
			
				<td width="40%">
					<hr class="m_line"/>
				</td>
				
				<td width="20%">
					<div class="m_circle">
					</div>
					<div class="m_circle_small">
					</div>
					<div class="m_circle">
					</div>
				</td>
				
				<td width="40%">
					<hr class="m_line"/>
				</td>
				
			</tr>
		</table>

	<?endforeach;?>

	</ul>
</div>
