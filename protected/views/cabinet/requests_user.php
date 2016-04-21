<?php /* @var $this CabinetController */ ?>

<div class="wrap">
	<?php include_once "menu_user.php"; ?>

	<div class="table cabinet requests">
		<table>
			<tr>
				<th style="width:20px;">№</th>
				<th style="width:80px;">Дата</th>
				<th style="width:150px;">Поставщики</th>
				<th style="width:600px;">Наименования</th>
				<th style="width:300px;">Сообщение</th>
			</tr>
			<?php $number = 1;
			foreach ($data as $row) { ?>
			<tr>
				<td><?php echo $number; $number++; ?></td>
				<td><?php echo $row->date; ?></td>
				<td><?php 
						$a = explode('//', $row->providers);
						$str = '';
						foreach ($a as $aa) $str .= '<br>'.$aa;
						echo substr_replace($str, '', 0, 4);
				?></td>
				<td><?php 
						$a = explode('//', $row->categories);
						$a = array_unique($a);
						$str = '';
						foreach ($a as $aa) $str .= '<br>'.$aa;
						echo substr_replace($str, '', 0, 4);
				?></td>
				<td><?php echo $row->text; ?></td>
			</tr>
			<?php }?>
		</table>
	</div>
</div>