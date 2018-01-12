<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lead extends CI_Controller {
	
	function __construct(){
		parent:: __construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('option_model', 'option');
		$this->load->model('lead_model','lead');
	}

	public function index(){
		redirect('lead/listar','refresh');

	}

	public function listar(){
		//verifica login
		verifica_login();

		//carrega view
		$dados['titulo'] = 'Leads - Beeleads';
		$dados['h2'] = 'Listar Leads';
		$dados['tela'] = 'listar';

		//Carrega Leads
		$dados['leads'] = $this->lead->get();		
		$this->load->view('dashboard/lead',$dados);
	}

	public function incluir(){
		//verifica login
		verifica_login();

		//Valida campos Inserir Lead
		//Regras de Validação Formulário
		$this->form_validation->set_rules('name', 'Nome', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('source', 'FONTE', 'trim|required|valid_url');
		$this->form_validation->set_rules('contact', 'CONTATO', 'trim|required|valid_email');
		
		//Verifica a validação
		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg((validation_errors()));
			}
		}else{
			$dados_form = $this->input->post();
			$dados_insert['name'] = $dados_form['name'];
			$dados_insert['source'] = $dados_form['source'];
			$dados_insert['contact'] = $dados_form['contact'];
			//Salvar no bd
			if($id = $this->lead->salvar($dados_insert)){
				set_msg('<p>Lead Inserido com sucesso!</p>');
				redirect('lead/listar','refresh');
			}else{
				set_msg('<p>Ops! Lead não salvo</p>');
			}

		}

		//carrega view
		$dados['titulo'] = 'Leads - Beeleads';
		$dados['h2'] = 'Inserir Lead';
		$dados['tela'] = 'incluir';
		$this->load->view('dashboard/lead',$dados);
	}

	public function deletar(){
		//verifica login
		verifica_login();
		
		//testa Id
		$id = $this->uri->segment(3);

		if($id > 0){
			//Excluir Lead
			if($lead = $this->lead->get_lead($id)){
				$dados['lead'] = $lead;
			}else{
				set_msg('<p>Lead inexistente!</p>');
				redirect('dashboard/listar','refresh');
			}
		}else{
			set_msg('<p>Você deve excluir um lead para excluir</p>');
			redirect('dashboard/listar','refresh');
		}

		//Valida para confirmar exclusão
		$this->form_validation->set_rules('enviar', 'ENVIAR', 'trim|required');
		
		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg((validation_errors()));
			}
		}else{
			if($this->lead->delete($id)){
				set_msg("<p>Lead excluído</p>");
				redirect('lead/listar','refresh');
			}else{
				set_msg("<p>Erro ao excluir</p>");
			}
		}
		//carrega view
		$dados['titulo'] = 'Leads - Beeleads';
		$dados['h2'] = 'Excluir Leads';
		$dados['tela'] = 'delete';

		$this->load->view('dashboard/lead',$dados);
	}

	public function editar(){
		//verifica login
		verifica_login();
		
		//testa Id
		$id = $this->uri->segment(3);

		if($id > 0){
			//Excluir Lead
			if($lead = $this->lead->get_lead($id)){
				$dados['lead'] = $lead;
				$dados_update['id'] = $lead->id;

			}else{
				set_msg('<p>Lead inexistente!</p>');
				redirect('dashboard/listar','refresh');
			}
		}else{
			set_msg('<p>Você deve excluir um lead para excluir</p>');
			redirect('dashboard/listar','refresh');
		}

		//Valida para confirmar exclusão
		$this->form_validation->set_rules('name', 'Nome', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('source', 'FONTE', 'trim|required|valid_url');
		$this->form_validation->set_rules('contact', 'CONTATO', 'trim|required|valid_email');
		
		//Verifica a validação
		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg((validation_errors()));
			}
		}else{
			$dados_form = $this->input->post();
			$dados_update['name'] = $dados_form['name'];
			$dados_update['source'] = $dados_form['source'];
			$dados_update['contact'] = $dados_form['contact'];
			
			if($this->lead->salvar($dados_update)){
				set_msg('<p>Lead atualizado com sucesso!</p>');
				redirect('/lead/editar/'.$id,'refresh');
			}else{
				set_msg('<p>Erro! Nenhum dado foi alterado!</p>');
			}
		}
		//carrega view
		$dados['titulo'] = 'Leads - Beeleads';
		$dados['h2'] = 'Excluir Leads';
		$dados['tela'] = 'editar';

		$this->load->view('dashboard/lead',$dados);
	}
}
