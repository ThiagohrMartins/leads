<?php $this->load->view('dashboard/header')?>
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
		echo form_input('login', set_value('login'),array('autofocus' => 'autofocus','class'=>'form-control'));
		?>
		</div>
		<div class="form-group">
		<?php
		echo form_label('Email do administrador do site:', 'email');
		echo form_input('email', set_value('email'),array('class'=>'form-control'));
		?>
		</div>
		<div class="form-group">
		<?php
		echo form_label('Senha (deixe em branco para não alterar)', 'senha');
		echo form_password(array('class'=>'form-control','name'=>'senha2'));
		?>
		</div>
		<div class="form-group">
		<?php
		echo form_label('Repita a senha:', 'senha2');
		echo form_password(array('class'=>'form-control','name'=>'senha2'));
		?>
		</div>
		<div class="form-group">
		<?php
		echo form_submit('enviar', 'Salvar dados', array('class' => 'btn btn-primary'));
		echo form_close();

	?>
</div>
<div class="col-md-3">&nbsp;</div>

<?php $this->load->view('dashboard/footer')?>
