<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lead_model extends CI_Model {
	
	function __construct(){
		parent:: __construct();
	}

	public function salvar($dados){
		if(isset($dados) && $dados['id'] > 0){
			//Edita um Lead
			$this->db->where('id',$dados['id']);
			unset($dados['id']);
			$this->db->update('leads',$dados);
			return $this->db->affected_rows();
		}else{
			//Salva um novo Lead
			$this->db->insert('leads',$dados);
			return $this->db->insert_id();
		}
		
	}

	public function get($limit=0,$offset=0){
		if($limit == 0){
			$this->db->order_by('id','desc');
			$query = $this->db->get('leads');
			if($query->num_rows() > 0){
				return $query->result();			
			}
		}else{
			return NULL;
		}
	}

	public function get_lead($id = 0){
		$this->db->where('id',$id);
		$query = $this->db->get('leads');
		if($query->num_rows() == 1){
			$row = $query->row();
			return $row;			
		}else{
			return NULL;
		}
	}

	public function delete($id=0){
		$this->db->where('id',$id);
		$this->db->delete('leads');
		return $this->db->affected_rows();
	}

}
