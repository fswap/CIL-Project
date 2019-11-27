<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Departments extends CI_Controller{ 
	var $data;

	public function __construct(){
		parent :: __construct();
		if($this->session->userdata('isLogged') !== true){
			redirect();
		}
		// else{
		// 	echo "Logged in ; id : ".$this->session->userdata('id');
		// }
		$data = [
			'isLogged'	=>	$this->session->userdata('isLogged'),
			'userType'	=>	$this->session->userdata('userType'),
		];
		$this->data=array(
			'title' => "Coal India Limited",
			'header' => "Coal India Limited<br>Departments",
			'error' => ''
		);

		$this->load->model('pages/model_departments','', TRUE);

		$this->load->view('templates/header');
	} 

	public function index(){    
		$this->data['departments']=$this->model_departments->departments();
		$this->load->view('pages/view_departments',$this->data);
		$this->load->view('templates/footer');
	}

	public function add_dept(){
		$dept_data=array(
			'title'		=>	"Coal India Limited",
			'header'	=>	"Add New Department",
			'error'		=>	""
		);
		$this->load->view("pages/view_add_dept", $dept_data);
		$this->load->view('templates/footer');
	}

	public function save_dept(){
		$save_dept=array(
			'department'	=>	$this->input->post('department')
		);

        $this->db->trans_start();
		$this->model_departments->insert_data($save_dept, 'department');
		$this->db->trans_complete();
  		redirect(site_url('departments'));
	}

	 public function select_delete_dept(){
	 	//$this->load->view('templates/header');
	 	$dept_data=array(
	 		'title'		=>	"Coal India Limited",
	 		'header'	=>	"Delete Department",
	 		'error'		=>	""
	 	);
	 	$dept_data['depts']=$this->model_departments->departments();
	 	$this->load->view("Pages/view_select_delete_dept", $dept_data);
	 	$this->load->view("templates/footer");
	 }

	 public function delete_dept($dept_id=""){
		 	$this->model_departments->delete_dept($dept_id);
		 	//echo 'Deleted successfully!';
		 	redirect(site_url('departments'));

		 }

	public function edit_dept($dept_id=""){
		$data=array(
			'title'		=>	"Coal India Limited",
			'header'	=>	"Edit Department",
			'error'		=>	""
		);
		//var_dump($dept_id);
		$data['dept']=$this->model_departments->dept_name($dept_id);
		$this->load->view('pages/view_edit_dept', $data);
		//$this->model_departments->edit_dept($dept_id);
		//redirect(site_url('departments'));
	}

	public function update_dept(){
		//var_dump($_POST);
		$sno=$this->input->post('sno');
		$dept=$this->input->post('department');
		$this->db->trans_start();
		$this->model_departments->update_dept($sno, $dept);
		$this->db->trans_complete();
  		redirect(site_url('departments'));
	}

} 
?>