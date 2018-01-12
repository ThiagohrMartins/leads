<?php $this->load->view('dashboard/header.php')?>
<div class="col-md-4">&nbsp;</div>
<div class="col-md-4">
	<h2><?php echo $h2; ?></h2>
	<table class="table">
		<thead>
		</thead>
			<tr>
				<th>Estatistícas</th>
			</tr>
		<tbody>
			<tr>
				<th>Total de Leads:</th>
				<th><?php echo sizeof($leads)?></th>
			</tr>
		</tbody>
	</table>
</div>
<div class="col-md-4">&nbsp;</div>
<?php $this->load->view('dashboard/footer.php')?>
