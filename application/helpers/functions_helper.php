<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('set_msg')){
	//seta uma mensagem via session para ser lida posteriormente
	function set_msg($msg=NULL){
		$ci = & get_instance();
		$ci->session->set_userdata('aviso', $msg);
	}
}

if(!function_exists('get_msg')){
	//retorna uma mensagem definida pela funcção set_msg
	function get_msg($destroy=TRUE){
		$ci = & get_instance();
		$retorno = $ci->session->userdata('aviso');
		if($destroy) $ci->session->unset_userdata('aviso');
		return $retorno;
	}
}

if(!function_exists('verifica_login')){
	//Verifica se usuario esta logado no sistema
	function verifica_login($redirect='setup/login'){
		$ci = & get_instance();
		if($ci->session->userdata('logged') != TRUE){
			set_msg('<p>Acesso restrito! Faça login para continuar!</p>');
			redirect($redirect,'refresh');
		}
	}
}
if(!function_exists('to_bd')){
	//Codifica html para ser salvo no Banco
	function to_bd($string=NULL){
		return htmlentities($string);
	}
}
if(!function_exists('to_html')){
	//decodifica html para ser mostrado no banco
	function to_html($string=NULL){
		return html_entity_decode($string);
	}
}
