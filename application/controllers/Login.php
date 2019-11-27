<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Login extends CI_Controller{ 
	var $data;

	public function __construct(){
		parent :: __construct();
		$this->load->model('pages/model_designation','', TRUE);

		if($this->session->userdata('isLogged') === true){
			$this->model_designation->redirectUser();
		}
		// else{
		// 	echo "Logged in ; id : ".$this->session->userdata('id');
		// }
		$this->data=array(
			'title' => "Coal India Limited",
			'header' => "Designation<br>Executives of Coal India Limited",
			'error' => ''
		);

	} 

	public function index(){
		
		// varify the login need to redesign again 
		if(isset($_POST['login'])){
			// if($this->input->post('username') === 'Suraj'){
			// 	$this->session->unset_userdata('isLogged');
			// 	$this->session->unset_userdata('id');
			// 	$this->session->unset_userdata('userType');
			// 	redirect();
			// }
			/*$this->load->library('form_validation');
  			$this->form_validation->set_rules('username','Username');
  			$this->form_validation->set_rules('password','Password');
  			if($this->form_validation->run())
  			{
  				$username = $this->input->post('username');
  				$password = $this->input->post('password');
  				$data = $this->model_designation->checkCredentials($username,$password);
  			}
  			else{

  				redirect();
  			}*/


		$data = $this->model_designation->checkCredentials($this->input->post('username'),$this->input->post('password'));
			// var_dump($data);
			// die();
			$isCorrect = $data['correct'];
			if($isCorrect){
				$this->session->set_userdata('isLogged',true);
				$this->session->set_userdata('id',$data['id']);
				$this->session->set_userdata('userType',$data['user_type']);
				
				$this->model_designation->redirectUser();
			}
			else{
				$this->session->set_userdata('isLogged',false);
				$this->session->set_userdata('id',0);
				$this->session->set_flashdata('error','Invalid Username or Password');
				redirect();
			}
		}
		if(isset($_POST['register'])){
			$data = $this->model_designation->registerUser();
			//$this->register_validation();
		}
		$this->load->view('templates/header1');
		$this->load->view('pages/mainpage');
		$this->load->view('templates/footer');
	}

  /*public function login_validation()
  {
  	$this->load->library('form_validation');
  	$this->form_validation->set_rules('username','Username','required');
  	$this->form_validation->set_rules('password','Password','required');
  	if($this->form_validation->run())
  	{
  		//true

  	}
  	else
  	{
  		$this->index();
  	}
  }*/

  /*public function register_validation()
  {
  	$this->load->library('form_validation');
  	$this->form_validation->set_rules('name','name','required|alpha');
  	$this->form_validation->set_rules('company-name','company-name','required|alpha');
  	$this->form_validation->set_rules('empolyee-id','empolyee-id','required');
  	$this->form_validation->set_rules('mine-name','mine-name','required');
  	$this->form_validation->set_rules('mine-address','mine-address','required');
  	$this->form_validation->set_rules('email','email','required|valid_email');
  	$this->form_validation->set_rules('username','username','required');
  	$this->form_validation->set_rules('password','password','required');

  	if($this->form_validation->run())
		{
			$this->load->model("pages/model_designation");
			$data = [
				'name'			=>	$this->input->post('name'),
				'company_name'	=>	$this->input->post('company-name'),
				'employee_id'	=>	$this->input->post('empolyee-id'),
				'mine_name'		=>	$this->input->post('mine-name'),
				'mine_address'	=>	$this->input->post('mine-address'),
				'email'			=>	$this->input->post('email'),
				'username'		=>	$this->input->post('username'),
				'password'		=>	$this->input->post('password'),
			];

			$this->model_designation->registerUser($data);
			//redirect();
		}

		else
		{
			$this->index();
		}
  }*/



};