<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('option_model', 'option');
	}

	public function index(){
		if($this->option->get_option('setup_executado') == 1){
			//setup ok, mostrar tela para editar os dados setup
			redirect('setup/alterar','refresh');
		}else{
			//Não instalado, mostra a tela setup
			redirect('setup/instalar','refresh');
		}
	}

	public function instalar(){
		if($this->option->get_option('setup_executado') == 1){
			//setup ok, mostrar tela para editar os dados setup
			redirect('setup/alterar','refresh');
		}

		//Regras de Validação Formulário
		$this->form_validation->set_rules('login', 'Nome', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('email', 'EMAIL', 'trim|required|valid_email');
		$this->form_validation->set_rules('senha', 'SENHA', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('senha2', 'REPITA A SENHA', 'trim|required|min_length[6]|matches[senha]');

		//Verifica a validação
		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg((validation_errors()));
			}
		}else{
			$dados_form = $this->input->post();
			$this->option->update_option('user_login', $dados_form['login']);
			$this->option->update_option('user_email', $dados_form['email']);
			$this->option->update_option('user_pass', password_hash($dados_form['senha'], PASSWORD_DEFAULT));
			$inserido = $this->option->update_option('setup_executado',1);
			if($inserido){
				set_msg("<p>Sistema instalado, use os dados cadastrados para logar no sistema</p>");
				redirect('setup/login','refresh');
			}
			
		}
		//carrega view
		$dados['titulo'] = 'Leads - Beeleads';
		$dados['h2'] = 'Setup Sistema';
		$this->load->view('dashboard/login',$dados);
	}

	public function login(){
		
		if($this->option->get_option('setup_executado') != 1){
			//setup não está ok, mostrar tela para instalar o sistema
			redirect('setup/instalar','refresh');
		}

		$this->form_validation->set_rules('login', 'Nome', 'trim|required|min_length[5]');	
		$this->form_validation->set_rules('senha', 'SENHA', 'trim|required|min_length[6]');
		//Verifica a validação
		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				set_msg((validation_errors()));
			}
		}else{
			$dados_form = $this->input->post();
			if($this->option->get_option('user_login') == $dados_form['login']){
				//Usuario existe
				if(password_verify($dados_form['senha'], $this->option->get_option('user_pass'))){
					//Senha OK, fazer Login
					$this->session->set_userdata('logged',TRUE);
					$this->session->set_userdata('user_login', $dados_form['login']);
					$this->session->set_userdata('user_email',$this->option->get_option('user_email'));
					// Fazer redirect para home da dashboard
					redirect('dashboard','refresh');
				}else{
					//Senha incorreta
					set_msg('<p>Senha Incorreta!</p>');
				}
			}else{
				//Usuario não existe
				set_msg('<p>Usuário inexistente!</p>');
			}
			
		}

		$dados['titulo'] = 'Leads - Acesso Beeleads';
		$dados['h2'] = 'Acessar Sistema';
		$this->load->view('dashboard/login',$dados);
	}

	public function alterar(){
		//Verifica se usuario logado
		verifica_login();

		//carrega a view


	}
}
