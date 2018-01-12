<?php $this->load->view('dashboard/header.php')?>
<div class="container">
<div class="col-md-3">
	<ul class="nav nav-pills nav-stacked">
	<li role="presentation"><a href="<?php echo base_url('lead/incluir');?>">Incluir</a></li>
	<li role="presentation"><a href="<?php echo base_url('lead/listar');?>">Listar</a></li>
	</ul>
</div>

	<div class="col-md-9">
		<h2><?php echo $h2; ?></h2>
		<?php 
		if($msg = get_msg()){
			echo '<div>'.$msg.'</div>';
		}
		switch ($tela) {
			case 'listar':
				if(isset($leads) && sizeof($leads) > 0){
					?>
				<table class="table table-hover">
					<thead>
						<tr>
							<th align="left" >#</th>
							<th align="center" >Nome</th>
							<th align="center" >Fonte</th>							
							<th align="center" >Contato</th>
							<th align="center" >Ação</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($leads as $lead) {							
							?>
							<tr>
								<td><?php echo $lead->id;?></td>
								<td><?php echo $lead->name;?></td>
								<td><?php echo $lead->source;?></td>								
								<td><?php echo $lead->contact;?></td>
								<td><?php echo anchor('lead/editar/'.$lead->id,'Editar')?> | <?php echo anchor('lead/deletar/'.$lead->id,'Deletar')?></td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>		
			<?php
				}
				echo '<p>Nenhum Lead Cadastrado</p>';
				break;
			case 'editar':
			echo form_open();
			?>
			<div class="form-group">
				<?php
				echo form_label('Nome','name');
				echo form_input('name',set_value('name',$lead->name),array('class'=>'form-control'));
				?>
			</div>
			<div class="form-group">
				<?php
				echo form_label('Fonte','source');
				echo form_input('source',set_value('source',$lead->source),array('class'=>'form-control'));
				?>
			</div>			
			<div class="form-group">
				<?php
				echo form_label('Contato','contact');
				echo form_input('contact',set_value('contact',$lead->contact),array('class'=>'form-control'));
				?>
			</div>
			<?php
			echo form_submit('enviar','Editar', array('class'=>'btn btn-primary'));
			echo form_close();
				break;
			case 'incluir':
				echo form_open();
				?>
				<div class="form-group">
					<?php
					echo form_label('Nome','name');
					echo form_input('name',set_value('name'),array('class'=>'form-control'));
					?>
				</div>
				<div class="form-group">
					<?php
					echo form_label('Fonte','source');
					echo form_input('source',set_value('source'),array('class'=>'form-control'));
					?>
				</div>
				<div class="form-group">
					<?php
					echo form_label('Contato','contact');
					echo form_input('contact',set_value('contact'),array('class'=>'form-control'));
					?>
				</div>
				<?php
				echo form_submit('enviar','Incluir', array('class'=>'btn btn-primary'));
				echo form_close();
				break;
			case 'delete':
			echo form_open();
			?>
			<div class="form-group">
				<?php
				echo form_label('Nome','name');
				echo form_input('name',set_value('name',$lead->name),array('class'=>'form-control'));
				?>
			</div>
			<div class="form-group">
				<?php
				echo form_label('Fonte','source');
				echo form_input('source',set_value('source',$lead->source),array('class'=>'form-control'));
				?>
			</div>
			<div class="form-group">
				<?php
				echo form_label('Contato','contact');
				echo form_input('contact',set_value('contact',$lead->contact),array('class'=>'form-control'));
				?>
			</div>
			<?php
			echo form_submit('enviar','Excluir', array('class'=>'btn btn-primary'));
			echo form_close();
				break;
			
			default:
				# code...
				break;
		}
		?>		
	</div>
</div>
<?php $this->load->view('dashboard/footer.php')?>
