<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	function __construct(){
		parent:: __construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('option_model', 'option');
		$this->load->model('lead_model','lead');
	}

	public function index(){
		$dados['h2'] = 'Dashboard';
		$dados['leads'] = $this->lead->get();
		$this->load->view('dashboard/main',$dados);
	}


	public function configuracao(){
		//Verifca login
		verifica_login();
		//Regras de Validação Formulário
		$this->form_validation->set_rules('login', 'Nome', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('email', 'EMAIL', 'trim|required|valid_email');
		$this->form_validation->set_rules('senha', 'SENHA', 'trim|min_length[6]');
		if(isset($_POST['senha']) && $_POST['senha'] != "" ){
			$this->form_validation->set_rules('senha2', 'REPITA A SENHA', 'trim|required|min_length[6]|matches[senha]');
		}

		//Verifica a validação
		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg((validation_errors()));
			}
		}else{
			$dados_form = $this->input->post();
			$this->option->update_option('user_login', $dados_form['login']);
			$this->option->update_option('user_email', $dados_form['email']);
			if(isset($dados_form['senha']) && $dados_form['senha'] != "" ){
				$this->option->update_option('user_pass', password_hash($dados_form['senha'], PASSWORD_DEFAULT));
			}
			set_msg('<p>Dados alterados com sucesso!</p>');			
		}
		

		//carrega view
		$_POST['login'] =$this->option->get_option('user_login');
		$_POST['email'] =$this->option->get_option('user_email');
		$dados['titulo'] = 'Configuração';
		$dados['h2'] = 'Alterar configuração do sistema';
		$this->load->view('dashboard/config',$dados);
	}

	public function logout(){
		//Destroi as sessões de login
		$this->session->unset_userdata('logged');
		$this->session->unset_userdata('user_email');
		$this->session->unset_userdata('user_login');

		set_msg('<p>Usuario foi deslogado!</p>');

		redirect('setup/login','refresh');
	}
	
}
