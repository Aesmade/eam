<?php
    include 'include/php/helpers.php';

    $styles = array('%OTHER_STYLESHEET_1%' => 'rel="stylesheet" href="styles/libraries_calendar.css"',
                    '%OTHER_STYLESHEET_2%' => 'rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"'
                   );    

    echo replace_contents('include/php/header.php', $styles);
    date_default_timezone_set('Europe/Athens');
?>
	<div class="container">
        <ol class="breadcrumb">
            <li><a href="index.php">Αρχική</a></li>
            <li><span class="active">Βιβλιοθήκες</span></li>
        </ol>


		<div class="panel panel-default">
    		<div class="panel-heading">
				Ωράριο Λειτουργίας Βιβλιοθηκών
				<img class = "floatRight" src="resources/calendar.png">
				<input type="text" id="cal" class="floatRight">
			</div>
		  	<table class="table align-height highlight-day">
		  		<tr class = "decor">
			  		<td></td><td>Δευτέρα<br><?php echo date( 'd/m', strtotime( 'monday this week' )); ?></td><td>Τρίτη<br><?php echo date( 'd/m', strtotime( 'tuesday this week' )); ?></td><td>Τετάρτη<br><?php echo date( 'd/m', strtotime( 'wednesday this week' )); ?></td><td>Πέμπτη<br><?php echo date( 'd/m', strtotime( 'thursday this week' )); ?></td><td>Παρασκευή<br><?php echo date( 'd/m', strtotime( 'friday this week' )); ?></td><td>Σάββατο<br><?php echo date( 'd/m', strtotime( 'saturday this week' )); ?></td><td>Κυριακή<br><?php echo date( 'd/m', strtotime( 'sunday this week' )); ?></td>
				</tr>
			  	<tr>
			  		<td><a href="library.php?id=1">Βιβλιοθήκη Σχολής<br>Θετικών Επιστημών</a></td>
			  		<td>09:00 - 21:30</td><td>09:00 - 21:00</td><td>Αργία</td><td>09:00 - 21:00</td><td>09:00 - 21:00</td><td>09:30 - 16:30</td><td>-</td>
			  	<tr>
				  	<td><a href="library.php?id=2">Βιβλιοθήκη<br>Οικονομικών Επιστημών</a></td>
				  	<td>09:00 - 18:00</td><td>09:00 - 18:00</td><td>Αργία</td><td>09:30 - 14:30<br>16:00 - 18:00</td><td>09:00 - 18:00</td><td>09:30 - 16:30</td><td>-</td>
			  	</tr>
				<tr>
				  	<td><a href="library.php?id=3">Βιβλιοθήκη<br>Θεολογικής Σχολής</a></td>
				  	<td>08:00 - 16:00</td><td>08:00 - 16:00</td><td>Αργία</td><td>08:00 - 16:00</td><td>08:00 - 16:00</td><td>08:00 - 16:00</td><td>-</td>
			  	</tr>
			  	<tr>
				  	<td class="disabled><a href="#"">Κεντρικά Γραφεία<br>Πανεπιστημίου Αθηνών</a></td>
				  	<td>09:30 - 14:30</td><td>09:30 - 14:30</td><td>Αργία</td><td>09:30 - 14:30</td><td>09:30 - 14:30</td><td>-</td><td>-</td>
			  	</tr>
		  	</table>
		</div>
	</div>
	<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
		$(function() {
	  		$( "#cal" ).datepicker();
	  	});
	</script>
<?php
    include 'include/php/footer.php';
?>
