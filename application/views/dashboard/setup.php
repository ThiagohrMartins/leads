<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>" />
</head>
<body>
	<div class="col-md-3">&nbsp;</div>
	<div class="col-md-6">
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
			echo form_input('login', set_value('login'),array('autofocus' => 'autofocus'));
			?>
			</div>
			<div class="form-group">
			<?php
			echo form_label('Email do administrador do site:', 'email');
			echo form_input('email', set_value('email'));
			?>
			</div>
			<div class="form-group">
			<?php
			echo form_label('Senha:', 'senha');
			echo form_password('senha', set_value('senha'));
			?>
			</div>
			<div class="form-group">
			<?php
			echo form_label('Repita a senha:', 'senha2');
			echo form_password('senha2', set_value('senha2'));
			?>
			</div>
			<div class="form-group">
			<?php
			echo form_submit('enviar', 'Salvar dados', array('class' => 'btn btn-primary'));
			echo form_close();

		?>
	</div>
	<div class="col-md-3">&nbsp;</div>

</body>
</html>
