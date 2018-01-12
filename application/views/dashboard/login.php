<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>" />
</head>
<body>
	<div class="col-md-4">&nbsp;</div>
	<div class="col-md-4">
		<h2><?php echo $h2; ?></h2>
		<?php
			if($msg = get_msg()){
				echo '<div class="bg-danger">'.$msg.'</div>';	
			}
			echo form_open();
			?>
			<div class="form-group">
			<?php
			echo form_label('Nome para Login:', 'login');
			echo form_input('login', set_value('login'),array('autofocus' => 'autofocus','placeholder'=>'Login','class'=>'form-control'));
			?>
			</div>
			<div class="form-group">
			<?php			
			echo form_label('Senha:', 'senha');
			echo form_password(array('class'=>'form-control','placeholder'=>'Senha','name'=>'senha'));
			?>
			</div>
			<div class="form-group">
			<?php
			echo form_submit('enviar', 'Logar', array('class' => 'btn btn-primary'));
			echo form_close();

		?>
	</div>
	<div class="col-md-4">&nbsp;</div>

</body>
</html>
