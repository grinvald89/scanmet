<?php /* @var $this CabinetController */ ?>
<div class='wrap'>

	<?php include_once "menu_provider.php"; ?>

<?php echo "<div class='table' style='width:100%;'><table>";

foreach( $file_excell as $row ) {
    echo "<tr>";
    foreach( $row as $column )
        echo "<td>$column</td>";
    echo "</tr>";
}
 
echo "</table></div>";?>

	<br>

	<ul class="menu_provider">
		<div class="button admin one"><li><a href="cabinet/saveFromFile">Загрузить в базу данных</a></li></div>
	</ul>
</div>