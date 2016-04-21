<?php /* @var $this CabinetController */ ?>

<div class="wrap">
	<?php include_once "menu_provider.php"; ?>

	<div class="table cabinet requests">
		<table>
			<tr>
				<th style="width:20px;">№</th>
				<th style="width:80px;">Дата</th>
				<th style="width:150px;">Пользователь</th>
				<th style="width:600px;">Наименования</th>
				<th style="width:300px;">Сообщение</th>
				<th style="width:120px;">Статус</th>
			</tr>
			<?php $number = 1;
			foreach ($data as $row) { ?>
			<tr>
				<td><?php echo $number; $number++; ?></td>
				<td><?php echo $row->date; ?></td>
				<td><?php echo $row->id_provider; ?></td>
				<td><?php 
						$a = explode('//', $row->categories);
						$a = array_unique($a);
						$str = '';
						foreach ($a as $aa) 
							$str .= '<br>'.$aa;
						echo substr_replace($str, '', 0, 4);
				?></td>
				<td><?php echo $row->text; ?></td>
				<td><?php if($row->viewed != 0) echo "просмотрено"; else echo "новая"; ?></td>
			</tr>
			<?php }?>
		</table>
	</div>
</div>