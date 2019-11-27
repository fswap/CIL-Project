<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Pages extends CI_Controller{ 
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
			'header' => "Designation<br>Executives of Coal India Limited",
			'error' => ''
		);

		$this->load->helper(array('form', 'url', 'date','array', 'file'));
		$this->load->library('form_validation');

		$this->load->view('templates/header',$data);
		$this->load->model('pages/model_designation','', TRUE);
		$this->load->library('csvimport');
	} 

	public function mine_mcode(){

		//$this->data=array(
		//	'title' => "Coal India Limited",
		//	'header' => "Mine Type & Mcode<br>",
		//	'error' => ''
		//);
		//$this->load->view('templates/header',$data);
		$data['values']=$this->model_designation->get_mine_mcode();
		$this->load->view('pages/mine_mcode', $data);
		$this->load->view('templates/footer');

	}

	//this function for matching data ;ankit;
	public function match_data(){
		$data['mine'] = $this->model_designation->all_mines();
		$data['sub_name']=$this->model_designation->fetch_subsidiary();
		$this->load->view('pages/match_data', $data);

	//var_dump($data['mine']);
		
		$this->load->view('templates/footer');


	}



			public function fetch_area()
		{
			
				if($this->input->post('sub_id'))
					  {
					   echo $this->model_designation->fetch_area($this->input->post('sub_id'));
					  }
		}



		public function fetch_subarea()
		{
			if($this->input->post('area_id'))
					  {
					   echo $this->model_designation->fetch_subarea($this->input->post('area_id'));
					  }

		}



		public function fetch_mines()
		{
			if($this->input->post('subarea_id'))
					  {
					   echo $this->model_designation->fetch_mines($this->input->post('subarea_id'));
					  }

		}

		public function fetch_minetype()
		{
			if($this->input->post('mine_id'))
					  {
					   echo $this->model_designation->fetch_minetype_new($this->input->post('mine_id'));
					  }

		}


		public function about_us()
		{
			$this->load->view('pages/about');

		}





        public function select_edit_standard_data(){
			//$this->load->view('templates/header');

			// -- CALL MODEL FUNCTION GET CADER //

			$this->load->model('pages/model_cadre');
			$cadredata = $this->model_cadre->all_cadre();

			//print_r($cadredata); exit();

			$this->session->set_userdata('getcadredata',$cadredata);

			$this->load->model('pages/model_departments');
			$departmentdata = $this->model_departments->departments();
			$this->session->set_userdata('getdepartmentdata',$departmentdata);


			$this->load->model('pages/model_designation');
			$gradedata = $this->model_designation->all_grade();
			$this->session->set_userdata('getgradedata',$gradedata);

		// -- CALL MODEL FUNCTION GET CADER //
	   // var_dump($_POST);
		$mine_prod = $this->session->userdata('mine_production');
		$mine_code = $this->session->userdata('mine_code');
		$data['values'] = $this->model_designation->get_std_values($mine_code,$mine_prod);
		$mine_type=-1;
	    if(is_null($data['values'])){
		$mine_type = $data['values'][0]['mine_id'];
			}
		//$mine_production = $_POST['mine_production'];
	     
		//$temp= $this->model_designation->get_minetype_from_code($_POST["submine"]);
		//dump($temp);
		
		//$data['production']= $mine_production.' ('.$temp[0]["munit"].')' ;
		//$data['mine_type']= $temp[0]["minecategory"] ;

		$data['production']= $this->session->userdata('mine_production_new') ;
		$data['mine_type']= $this->session->userdata('mine_code_new');

		$datamine = $this->model_designation->fetch_mineid($data['mine_type']);

		//print_r($datamine); //exit();

		$dataproduction = explode("(",$data['production']);
		
       //echo $dataproduction['0']; exit;

		

		$this->session->set_userdata('mine_prod',$dataproduction['0']);
	     
		
		$this->session->set_userdata('mine_code',$datamine['0']['mine_id']);


		$this->load->view("pages/view_select_edit_standard_data", $data);
		$this->load->view("templates/footer");

	}
	public function edit_standard_data($standard_id=""){
			//$this->load->view('templates/header');
			$standard_data=array(
				'title'		=>	"Coal India Limited",
				'header'	=>	"Edit Standard Data",
				'error'		=>	""
			);
			$standard_data['prev']=$this->model_designation->prev_standard_data($standard_id);
			$this->load->view("pages/view_edit_standard_data", $standard_data);
			$this->load->view('templates/footer');
		}

		public function update_standard_data(){
			$this->form_validation->set_rules('no_of_emp','Req. of emp.','required');
			$this->form_validation->set_rules('department','Department','required');
	        $this->form_validation->set_rules('cadre','Cadre','required');
	        $this->form_validation->set_rules('info','Info.','required');
			$update_standard=array(
				'sno'		 =>	$this->input->post('sno'),
				'department' => $this->input->post('department'),
				'cadre'      => $this->input->post('cadre'),
				'grade'      => $this->input->post('grade'),
				'no_of_emp'	 =>	$this->input->post('no_of_emp'),
				'info'       => $this->input->post('info')
				//'design'	=>	$this->input->post('design'),
				//'remark'	=>	$this->input->post('remark'),
				//'discipline'=>	$this->input->post('discipline')
			);



			if($this->form_validation->run()==false){
	            $this->data['error']=validation_errors();
	            $this->edit_standard_data($update_standard['sno']);
	        }

	        $this->db->trans_start();
			$this->model_designation->update_data_standard($update_standard);
			$this->db->trans_complete();

			//	$message = "Grade added successfully.";
	  		//	$this->session->set_flashdata("flashSuccess",$message);
	  		redirect(site_url('pages/select_edit_standard_data'));
		}
	//ankit ; action of match_form 
	// public function match_data_form_submit()
	// {
	// 	if($this->input->post('mine_type') && $this->input->post('mine_name') && $this->input->post('mine_location')&& $this->input->post('mine_production')  )
	// 	{
	// 		$mine_type =	$this->input->post('mine_type');
	// 		$mine_name = $this->input->post('mine_name');
	// 		$mine_loc = 	$this->input->post('mine_location');
	// 		$mine_prod = $this->input->post('mine_production') ;

	// 		$mine_submine_type = $this->model_designation->get_submine_type($mine_type,$mine_prod);

	// 		$this->session->set_userdata('mine_code',$mine_submine_type);
	// 		$this->session->set_userdata('mine_production',$mine_prod);


	// 		$data['submine']= $mine_submine_type;
	// 		$data['submine_data']= $this->model_designation->get_submine_type_data($mine_submine_type);

	// 					$this->load->view('pages/match_data_view',$this->data);
	// 		$this->load->view('templates/footer');

	// 	}
	// 	else 
	// 	{  
	// 		echo "Fill Form correctly ";
	// 		redirect();

	// 	}

	// }


	// public function designation(){
	// 	$this->data['grades']=$this->model_designation->all_grade();
	// 	$this->load->view('pages/view_designation',$this->data);
	// 	$this->load->view('templates/footer');
	// }

	public function designation(){
		$this->data['grades']=$this->model_designation->all_grade();
		//$this->load->view('templates/header');
		$this->load->view('pages/view_designation',$this->data);
		$this->load->view('templates/footer');
	}

		public function add_grade(){
			//$this->load->view('templates/header');
			$grade_data=array(
				'title'		=>	"Coal India Limited",
				'header'	=>	"Add New Grade/Designation",
				'error'		=>	""
			);
			$grade_data['error'].=$this->data['error'];
			$this->load->view("pages/view_add_grade", $grade_data);
			$this->load->view('templates/footer');
		}

	public function save_grade(){
		$this->form_validation->set_rules('grade','Grade','trim');
		$this->form_validation->set_rules('design','Designation','trim');
        $this->form_validation->set_rules('discipline','Discipline','trim');
		$save_grade=array(
			'grade'		=>	$this->input->post('grade'),
			'design'	=>	$this->input->post('design'),
			'remark'	=>	$this->input->post('remark'),
			'discipline'=>	$this->input->post('discipline')
		);

		if($this->form_validation->run()==false){
            $this->$data['error']=validation_errors();
            $this->add_grade();
        }

        $this->db->trans_start();
		$this->model_designation->insert_data($save_grade, 'designation');
		$this->db->trans_complete();

		//	$message = "Grade added successfully.";
  		//	$this->session->set_flashdata("flashSuccess",$message);
  		redirect(site_url('pages/designation'));
	}

	public function select_edit_grade(){
			//$this->load->view('templates/header');
			$grade_data=array(
				'title'		=>	"Coal India Limited",
				'header'	=>	"Edit Grade/Designation",
				'error'		=>	""
			);
			$grade_data['grades']=$this->model_designation->all_grade();
			$this->load->view("pages/view_select_edit_grade", $grade_data);
			$this->load->view("templates/footer");
		}

		public function edit_grade($grade_id=""){
			//$this->load->view('templates/header');
			$grade_data=array(
				'title'		=>	"Coal India Limited",
				'header'	=>	"Edit Grade/Designation",
				'error'		=>	""
			);
			$grade_data['prev']=$this->model_designation->prev_grade($grade_id);
			$this->load->view("pages/view_edit_grade", $grade_data);
			$this->load->view('templates/footer');
		}

		public function update_grade(){
			$this->form_validation->set_rules('grade','Grade','trim');
			$this->form_validation->set_rules('design','Designation','trim');
	        $this->form_validation->set_rules('discipline','Discipline','trim');
			$update_grade=array(
				'sno'		=>	$this->input->post('sno'),
				'grade'		=>	$this->input->post('grade'),
				'design'	=>	$this->input->post('design'),
				'remark'	=>	$this->input->post('remark'),
				'discipline'=>	$this->input->post('discipline')
			);

			if($this->form_validation->run()==false){
	            $this->data['error']=validation_errors();
	            $this->edit_grade($update_grade['sno']);
	        }

	        $this->db->trans_start();
			$this->model_designation->update_data_desig($update_grade);
			$this->db->trans_complete();

			//	$message = "Grade added successfully.";
	  		//	$this->session->set_flashdata("flashSuccess",$message);
	  		redirect(site_url('pages/designation'));
		}

		//functions related to delete a grade
		 public function select_delete_grade(){
		 	//$this->load->view('templates/header');
		 	$grade_data=array(
		 		'title'		=>	"Coal India Limited",
		 		'header'	=>	"Delete Grade/Designation",
		 		'error'		=>	""
		 	);
		 	$grade_data['grades']=$this->model_designation->all_grade();
		 	$this->load->view("Pages/view_select_delete_grade", $grade_data);
		 	$this->load->view("templates/footer");
		 }

		 public function delete_grade($grade_id=""){
		 	$this->model_designation->delete_grade($grade_id);
		 	//echo 'Deleted successfully!';
		 	redirect(site_url('Pages/designation'));

		 }

//Ankit
	public function entry_data($value=''){
		$data['values'] = $this->model_designation->get_values();
			//dump($data);
		//if(is_null($data['values'])){
		$this->session->set_userdata('mine_code',$data['values'][0]['mine_id']);
	     //}
		$production= $this->input->post('mine_production');
		$this->session->set_userdata('mine_production',$production);
		//dump($data);
		$this->load->view('pages/entry_data',$data);
	}

	public function existing_particular_mine()
	{
		$data['minecategory'] = $this->model_designation->fetch_minetype();
		$data['sub_name']=$this->model_designation->fetch_subsidiary();
		$data['year_name']=$this->model_designation->fetch_year();

		$this->load->view('pages/existing_particular_mine',$data);
		$this->load->view('templates/footer');
	}
	public function existing_subarea_wise()
	{
		//$data['minecategory'] = $this->model_designation->fetch_minetype();
		$data['sub_name']=$this->model_designation->fetch_subsidiary();
		$data['year_name']=$this->model_designation->fetch_year();

		$this->load->view('pages/existing_subarea_wise',$data);
		$this->load->view('templates/footer');
	}
	public function existing_subarea_office()
	{
		//$data['minecategory'] = $this->model_designation->fetch_minetype();
		$data['sub_name']=$this->model_designation->fetch_subsidiary();
		$data['year_name']=$this->model_designation->fetch_year();

		$this->load->view('pages/existing_subarea_office',$data);
		$this->load->view('templates/footer');
	}
	public function existing_area_wise()
	{
		//$data['minecategory'] = $this->model_designation->fetch_minetype();
		$data['sub_name']=$this->model_designation->fetch_subsidiary();
		$data['year_name']=$this->model_designation->fetch_year();

		$this->load->view('pages/existing_area_wise',$data);
		$this->load->view('templates/footer');
	}
	public function existing_area_office()
	{
		//$data['minecategory'] = $this->model_designation->fetch_minetype();
		$data['sub_name']=$this->model_designation->fetch_subsidiary();
		$data['year_name']=$this->model_designation->fetch_year();

		$this->load->view('pages/existing_area_office',$data);
		$this->load->view('templates/footer');
	}
	public function existing_subsidiary_wise()
	{
		//$data['minecategory'] = $this->model_designation->fetch_minetype();
		$data['sub_name']=$this->model_designation->fetch_subsidiary();
		$data['year_name']=$this->model_designation->fetch_year();

		$this->load->view('pages/existing_subsidiary_wise',$data);
		$this->load->view('templates/footer');
	}
	public function get_existing_for_mine()
	{
		$data['values']=$this->model_designation->get_existing_for_mine();

		$temp1= $this->model_designation->get_subsidiary($_POST["sub_name"]);
		$temp2= $this->model_designation->get_area($_POST["area_name"]);
		$temp3= $this->model_designation->get_subarea($_POST["subarea_name"]);
		$temp4= $this->model_designation->get_mine($_POST["mine_name"]);
		$temp5= $this->model_designation->get_minetype($_POST["minecategory"]);
		$temp6= $this->model_designation->get_year($_POST["year_name"]);
		//print_r($temp5);die();
		$temp7= $this->model_designation->get_production($_POST["mine_name"],$_POST["year_name"]);

		//print_r($temp1);
		// exit();
		$data['production']= $temp7[0]["production"].' ('.$temp5[0]["munit"].')' ;
		$data['sub_name']=$temp1[0]["sub_name"];
		$data['area_name']=$temp2[0]["area_name"];
		$data['subarea_name']=$temp3[0]["subarea_name"];
		$data['mine_name']=$temp4[0]["mine_name"];
		$data['year_name']=$temp6[0]["year_name"];
		$data['mine_type']=$temp5[0]["minecategory"];
		$data['munit']=$temp5[0]["munit"];
		//print_r($data['munit']);die();
		$this->load->view('pages/display_existing_for_mine',$data);
	}
	public function get_existing_for_subarea()
	{
		$data['values']=$this->model_designation->get_existing_for_subarea();

		$temp1= $this->model_designation->get_subsidiary($_POST["sub_name"]);
		$temp2= $this->model_designation->get_area($_POST["area_name"]);
		$temp3= $this->model_designation->get_subarea($_POST["subarea_name"]);
		$temp6= $this->model_designation->get_year($_POST["year_name"]);
		//print_r($temp5);die();
		$data['sub_name']=$temp1[0]["sub_name"];
		$data['area_name']=$temp2[0]["area_name"];
		$data['subarea_name']=$temp3[0]["subarea_name"];
		$data['year_name']=$temp6[0]["year_name"];
		//print_r($data['munit']);die();
		$this->load->view('pages/display_existing_for_subarea',$data);
	}
	public function get_existing_for_subarea_office()
	{
		$data['values']=$this->model_designation->get_existing_for_subarea_office();

		$temp1= $this->model_designation->get_subsidiary($_POST["sub_name"]);
		$temp2= $this->model_designation->get_area($_POST["area_name"]);
		$temp3= $this->model_designation->get_subarea($_POST["subarea_name"]);
		$temp6= $this->model_designation->get_year($_POST["year_name"]);
		//print_r($temp5);die();
		$data['sub_name']=$temp1[0]["sub_name"];
		$data['area_name']=$temp2[0]["area_name"];
		$data['subarea_name']=$temp3[0]["subarea_name"];
		$data['year_name']=$temp6[0]["year_name"];
		//print_r($data['munit']);die();
		$this->load->view('pages/display_existing_for_subarea_office',$data);
	}
	public function get_existing_for_area()
	{
		$data['values']=$this->model_designation->get_existing_for_area();

		$temp1= $this->model_designation->get_subsidiary($_POST["sub_name"]);
		$temp2= $this->model_designation->get_area($_POST["area_name"]);
		$temp6= $this->model_designation->get_year($_POST["year_name"]);
		//print_r($temp5);die();
		$data['sub_name']=$temp1[0]["sub_name"];
		$data['area_name']=$temp2[0]["area_name"];
		$data['year_name']=$temp6[0]["year_name"];
		//print_r($data['munit']);die();
		$this->load->view('pages/display_existing_for_area',$data);
	}

	public function get_existing_for_area_office()
	{
		$data['values']=$this->model_designation->get_existing_for_area_office();

		$temp1= $this->model_designation->get_subsidiary($_POST["sub_name"]);
		$temp2= $this->model_designation->get_area($_POST["area_name"]);
		$temp6= $this->model_designation->get_year($_POST["year_name"]);
		//print_r($temp5);die();
		$data['sub_name']=$temp1[0]["sub_name"];
		$data['area_name']=$temp2[0]["area_name"];
		$data['year_name']=$temp6[0]["year_name"];
		//print_r($data['munit']);die();
		$this->load->view('pages/display_existing_for_area_office',$data);
	}

	public function get_existing_for_subsidiary()
	{
		$data['values']=$this->model_designation->get_existing_for_subsidiary();

		$temp1= $this->model_designation->get_subsidiary($_POST["sub_name"]);
		$temp6= $this->model_designation->get_year($_POST["year_name"]);
		//print_r($temp5);die();
		$data['sub_name']=$temp1[0]["sub_name"];
		$data['year_name']=$temp6[0]["year_name"];
		//print_r($data['munit']);die();
		$this->load->view('pages/display_existing_for_subsidiary',$data);
	}
	public function standard_data()
	{   $data['mine'] = $this->model_designation->all_mines();
		$data['sub_name']=$this->model_designation->fetch_subsidiary();
		$data['year_name']=$this->model_designation->fetch_year();
		// $data['values'] = $this->model_designation->get_values();

		$this->load->view('pages/standard_data',$data);
		$this->load->view('templates/footer');
	}
	public function mine_wise_compare_data()
	{
		$data['minecategory'] = $this->model_designation->fetch_minetype();
		$data['sub_name']=$this->model_designation->fetch_subsidiary();
		$data['year_name']=$this->model_designation->fetch_year();

		$this->load->view('pages/mine_wise_compare_data',$data);
		$this->load->view('templates/footer');
	}
	public function subarea_wise_compare_data()
	{
		//$data['minecategory'] = $this->model_designation->fetch_minetype();
		$data['sub_name']=$this->model_designation->fetch_subsidiary();
		$data['year_name']=$this->model_designation->fetch_year();

		$this->load->view('pages/subarea_wise_compare_data',$data);
		$this->load->view('templates/footer');
	}
	public function subarea_office_compare_data()
	{
		//$data['minecategory'] = $this->model_designation->fetch_minetype();
		$data['sub_name']=$this->model_designation->fetch_subsidiary();
		$data['year_name']=$this->model_designation->fetch_year();

		$this->load->view('pages/subarea_office_compare_data',$data);
		$this->load->view('templates/footer');
	}

	public function area_wise_compare_data()
	{
		//$data['minecategory'] = $this->model_designation->fetch_minetype();
		$data['sub_name']=$this->model_designation->fetch_subsidiary();
		$data['year_name']=$this->model_designation->fetch_year();

		$this->load->view('pages/area_wise_compare_data',$data);
		$this->load->view('templates/footer');
	}

	public function area_office_compare_data()
	{
		//$data['minecategory'] = $this->model_designation->fetch_minetype();
		$data['sub_name']=$this->model_designation->fetch_subsidiary();
		$data['year_name']=$this->model_designation->fetch_year();

		$this->load->view('pages/area_office_compare_data',$data);
		$this->load->view('templates/footer');
	}

	public function subsidiary_wise_compare_data()
	{
		//$data['minecategory'] = $this->model_designation->fetch_minetype();
		$data['sub_name']=$this->model_designation->fetch_subsidiary();
		$data['year_name']=$this->model_designation->fetch_year();

		$this->load->view('pages/subsidiary_wise_compare_data',$data);
		$this->load->view('templates/footer');
	}

	public function get_compare_for_mine()
	{
		$data['values']=$this->model_designation->get_compare_for_mine();

		$temp1= $this->model_designation->get_subsidiary($_POST["sub_name"]);
		$temp2= $this->model_designation->get_area($_POST["area_name"]);
		$temp3= $this->model_designation->get_subarea($_POST["subarea_name"]);
		$temp4= $this->model_designation->get_mine($_POST["mine_name"]);
		$temp5= $this->model_designation->get_minetype($_POST["minecategory"]);
		$temp6= $this->model_designation->get_year($_POST["year_name"]);
		//print_r($temp5);die();
		$temp7= $this->model_designation->get_production($_POST["mine_name"],$_POST["year_name"]);

		//print_r($temp1);
		// exit();
		$data['production']= $temp7[0]["production"].' ('.$temp5[0]["munit"].')' ;
		$data['sub_name']=$temp1[0]["sub_name"];
		$data['area_name']=$temp2[0]["area_name"];
		$data['subarea_name']=$temp3[0]["subarea_name"];
		$data['mine_name']=$temp4[0]["mine_name"];
		$data['minecategory']=$temp5[0]["minecategory"];
		$data['munit']=$temp5[0]["munit"];
		$data['year_name']=$temp6[0]["year_name"];
		//print_r($data['munit']);die();
		$this->load->view('pages/display_compare_for_mine',$data);
	}

	public function get_compare_for_subarea()
	{
		$data['values']=$this->model_designation->get_compare_for_subarea();

		$temp1= $this->model_designation->get_subsidiary($_POST["sub_name"]);
		$temp2= $this->model_designation->get_area($_POST["area_name"]);
		$temp3= $this->model_designation->get_subarea($_POST["subarea_name"]);
		$temp6= $this->model_designation->get_year($_POST["year_name"]);
		//print_r($temp5);die();
		$data['sub_name']=$temp1[0]["sub_name"];
		$data['area_name']=$temp2[0]["area_name"];
		$data['subarea_name']=$temp3[0]["subarea_name"];
		$data['year_name']=$temp6[0]["year_name"];
		//print_r($data['munit']);die();
		$this->load->view('pages/display_compare_for_subarea',$data);
	}

	public function get_compare_for_subarea_office()
	{
		$data['values']=$this->model_designation->get_compare_for_subarea_office();

		$temp1= $this->model_designation->get_subsidiary($_POST["sub_name"]);
		$temp2= $this->model_designation->get_area($_POST["area_name"]);
		$temp3= $this->model_designation->get_subarea($_POST["subarea_name"]);
		$temp6= $this->model_designation->get_year($_POST["year_name"]);
		//print_r($temp5);die();
		$data['sub_name']=$temp1[0]["sub_name"];
		$data['area_name']=$temp2[0]["area_name"];
		$data['subarea_name']=$temp3[0]["subarea_name"];
		$data['year_name']=$temp6[0]["year_name"];
		//print_r($data['munit']);die();
		$this->load->view('pages/display_compare_for_subarea_office',$data);
	}
	public function get_compare_for_area()
	{
		$data['values']=$this->model_designation->get_compare_for_area();

		$temp1= $this->model_designation->get_subsidiary($_POST["sub_name"]);
		$temp2= $this->model_designation->get_area($_POST["area_name"]);
		$temp6= $this->model_designation->get_year($_POST["year_name"]);
		//print_r($temp5);die();
		$data['sub_name']=$temp1[0]["sub_name"];
		$data['area_name']=$temp2[0]["area_name"];
		$data['year_name']=$temp6[0]["year_name"];
		//print_r($data['munit']);die();
		$this->load->view('pages/display_compare_for_area',$data);
	}
	public function get_compare_for_area_office()
	{
		$data['values']=$this->model_designation->get_compare_for_area_office();

		$temp1= $this->model_designation->get_subsidiary($_POST["sub_name"]);
		$temp2= $this->model_designation->get_area($_POST["area_name"]);
		$temp6= $this->model_designation->get_year($_POST["year_name"]);
		//print_r($temp5);die();
		$data['sub_name']=$temp1[0]["sub_name"];
		$data['area_name']=$temp2[0]["area_name"];
		$data['year_name']=$temp6[0]["year_name"];
		//print_r($data['munit']);die();
		$this->load->view('pages/display_compare_for_area_office',$data);
	}
	public function get_compare_for_subsidiary()
	{
		$data['values']=$this->model_designation->get_compare_for_subsidiary();

		$temp1= $this->model_designation->get_subsidiary($_POST["sub_name"]);
		$temp6= $this->model_designation->get_year($_POST["year_name"]);
		//print_r($temp5);die();
		$data['sub_name']=$temp1[0]["sub_name"];
		$data['year_name']=$temp6[0]["year_name"];
		//print_r($data['munit']);die();
		$this->load->view('pages/display_compare_for_subsidiary',$data);
	}
	public function subarea_wise_standard_data()
	{
		$data['sub_name']=$this->model_designation->fetch_subsidiary();
		$data['year_name']=$this->model_designation->fetch_year();
		$this->load->view('pages/subarea_wise_standard_data',$data);
		$this->load->view('templates/footer');
	}

	public function subarea_office_standard_data()
	{
		$data['sub_name']=$this->model_designation->fetch_subsidiary();
		$data['year_name']=$this->model_designation->fetch_year();
		$this->load->view('pages/subarea_office_standard_data',$data);
		$this->load->view('templates/footer');
	}

	public function area_wise_standard_data()
	{
		$data['sub_name']=$this->model_designation->fetch_subsidiary();
		$data['year_name']=$this->model_designation->fetch_year();
		$this->load->view('pages/area_wise_standard_data',$data);
		$this->load->view('templates/footer');
	}

	public function area_office_standard_data()
	{
		$data['sub_name']=$this->model_designation->fetch_subsidiary();
		$data['year_name']=$this->model_designation->fetch_year();
		$this->load->view('pages/area_office_standard_data',$data);
		$this->load->view('templates/footer');
	}

	public function subsidiary_wise_standard_data()
	{
		$data['sub_name']=$this->model_designation->fetch_subsidiary();
		$data['year_name']=$this->model_designation->fetch_year();
		$this->load->view('pages/subsidiary_wise_standard_data',$data);
		$this->load->view('templates/footer');
	}

	public function select_mines_for_subarea($value='')
	{
		$data['values']=$this->model_designation->get_mine_for_subarea();
		$sub_name=$_POST['sub_name'];
		$area_name=$_POST['area_name'];
		$subarea_name=$_POST['subarea_name'];
		$year_name=$_POST['year_name'];

		$temp1= $this->model_designation->get_subsidiary($_POST["sub_name"]);
		$temp2= $this->model_designation->get_area($_POST["area_name"]);
		$temp3= $this->model_designation->get_subarea($_POST["subarea_name"]);
		$temp4= $this->model_designation->get_year($_POST["year_name"]);

		//print_r($temp1[0]);print_r($temp2[0]);print_r($temp3[0]);print_r($temp4[0]);
		//exit();
		$data['sub_name']=$temp1[0]["sub_name"];
		$data['area_name']=$temp2[0]["area_name"];
		$data['subarea_name']=$temp3[0]["subarea_name"];
		$data['year_name']=$temp4[0]["year_name"];

		$this->load->view('pages/new_display_standard_data_subarea_wise',$data);

	}
	public function select_office_for_subarea($value='')
	{
		$data['values']=$this->model_designation->get_office_for_subarea();
		$sub_name=$_POST['sub_name'];
		$area_name=$_POST['area_name'];
		$subarea_name=$_POST['subarea_name'];
		$year_name=$_POST['year_name'];

		$temp1= $this->model_designation->get_subsidiary($_POST["sub_name"]);
		$temp2= $this->model_designation->get_area($_POST["area_name"]);
		$temp3= $this->model_designation->get_subarea($_POST["subarea_name"]);
		$temp4= $this->model_designation->get_year($_POST["year_name"]);

		//print_r($temp1[0]);print_r($temp2[0]);print_r($temp3[0]);print_r($temp4[0]);
		//exit();
		$data['sub_name']=$temp1[0]["sub_name"];
		$data['area_name']=$temp2[0]["area_name"];
		$data['subarea_name']=$temp3[0]["subarea_name"];
		$data['year_name']=$temp4[0]["year_name"];

		$this->load->view('pages/display_standard_data_subarea_office',$data);

	}
	public function select_mines_for_area($value='')
	{
		$data['values']=$this->model_designation->get_mine_for_area();
		$sub_name=$_POST['sub_name'];
		$area_name=$_POST['area_name'];
		$year_name=$_POST['year_name'];

		$temp1= $this->model_designation->get_subsidiary($_POST["sub_name"]);
		$temp2= $this->model_designation->get_area($_POST["area_name"]);
		$temp4= $this->model_designation->get_year($_POST["year_name"]);

		//print_r($temp1[0]);print_r($temp2[0]);print_r($temp3[0]);print_r($temp4[0]);
		//exit();
		$data['sub_name']=$temp1[0]["sub_name"];
		$data['area_name']=$temp2[0]["area_name"];
		$data['year_name']=$temp4[0]["year_name"];

		$this->load->view('pages/new_display_standard_data_area_wise',$data);

	}
		public function select_office_for_area($value='')
	{
		$data['values']=$this->model_designation->get_office_for_area();
		$sub_name=$_POST['sub_name'];
		$area_name=$_POST['area_name'];
		$year_name=$_POST['year_name'];

		$temp1= $this->model_designation->get_subsidiary($_POST["sub_name"]);
		$temp2= $this->model_designation->get_area($_POST["area_name"]);
		$temp4= $this->model_designation->get_year($_POST["year_name"]);

		//print_r($temp1[0]);print_r($temp2[0]);print_r($temp3[0]);print_r($temp4[0]);
		//exit();
		$data['sub_name']=$temp1[0]["sub_name"];
		$data['area_name']=$temp2[0]["area_name"];
		$data['year_name']=$temp4[0]["year_name"];

		$this->load->view('pages/display_standard_data_area_office',$data);

	}
	public function select_mines_for_subsidiary($value='')
	{
		$data['values']=$this->model_designation->get_mine_for_subsidiary();
		$sub_name=$_POST['sub_name'];
		$year_name=$_POST['year_name'];

		$temp1= $this->model_designation->get_subsidiary($_POST["sub_name"]);
		$temp4= $this->model_designation->get_year($_POST["year_name"]);

		//print_r($temp1[0]);print_r($temp2[0]);print_r($temp3[0]);print_r($temp4[0]);
		//exit();
		$data['sub_name']=$temp1[0]["sub_name"];
		$data['year_name']=$temp4[0]["year_name"];

		$this->load->view('pages/new_display_standard_data_subsidiary_wise',$data);

	}


	

	public function get_standard_data($value='')
	{
	   // var_dump($_POST);
		$data['values'] = $this->model_designation->get_values();
		//print_r($data['values']);die();
		$mine_type=-1;
	    if(is_null($data['values'])){
		$mine_type = $data['values'][0]['mine_id'];
			}
		//$mine_production = $_POST['mine_production'];
	   // $mine_name=$_POST['minename'];
		$sub_name=$_POST['sub_name'];
		$area_name=$_POST['area_name'];
		$subarea_name=$_POST['subarea_name'];
		$mine_name=$_POST['mine_name'];
		$year_name=$_POST['year_name'];
		//print_r($sub_name); die();
		//$temp= $this->model_designation->get_minetype_from_code($_POST["submine"]);
		//dump($temp);
		$temp=$this->model_designation->get_minetype($_POST["minecategory"]);
		$temp1= $this->model_designation->get_subsidiary($_POST["sub_name"]);
		$temp2= $this->model_designation->get_area($_POST["area_name"]);
		$temp3= $this->model_designation->get_subarea($_POST["subarea_name"]);
		$temp4= $this->model_designation->get_mine($_POST["mine_name"]);
		$temp5= $this->model_designation->get_year($_POST["year_name"]);
		$temp6= $this->model_designation->get_production($_POST["mine_name"],$_POST["year_name"]);

		//print_r($temp1);
		// exit();
		$data['production']= $temp6[0]["production"].' ('.$temp[0]["munit"].')' ;
		$data['mine_type']= $temp[0]["minecategory"] ;
		//$data['minename']=$mine_name;
		$data['sub_name']=$temp1[0]["sub_name"];
		$data['area_name']=$temp2[0]["area_name"];
		$data['subarea_name']=$temp3[0]["subarea_name"];
		$data['mine_name']=$temp4[0]["mine_name"];
		$data['year_name']=$temp5[0]["year_name"];
		$this->session->set_userdata('mine_production_new',$data['production']);
	     
		
		$this->session->set_userdata('mine_code_new',$data['mine_type']);

		$this->session->set_userdata('sub_name',$data['sub_name']);
		$this->session->set_userdata('area_name',$data['area_name']);
		$this->session->set_userdata('subarea_name',$data['subarea_name']);
		$this->session->set_userdata('mine_name',$data['mine_name']);
		$this->session->set_userdata('year_name',$data['year_name']);
		$datamine = $this->model_designation->fetch_mineid($data['mine_type']);

		//print_r($datamine); //exit();

		$dataproduction = explode("(",$data['production']);
		
       //echo $dataproduction['0']; exit;

		

		$this->session->set_userdata('mine_production',$dataproduction['0']);
	     
		
		$this->session->set_userdata('mine_code',$datamine['0']['mine_id']);

		
		
		$this->load->view('pages/new_display_standard_data',$data);

	}

	public function get_filter_standard_data()
	{
	   // var_dump($_POST);
		$mine_prod = $this->session->userdata('mine_production');
		$mine_code = $this->session->userdata('mine_code');
		$sub_name = $this->session->userdata('sub_name');
		$area_name = $this->session->userdata('area_name');
		$subarea_name = $this->session->userdata('subarea_name');
		$mine_name = $this->session->userdata('mine_name');
		$year_name = $this->session->userdata('mine_name');
		$data['values'] = $this->model_designation->get_filter_values($mine_code,$mine_prod);
		$mine_type=-1;
	    if(is_null($data['values'])){
		$mine_type = $data['values'][0]['mine_id'];
			}
		//$mine_production = $_POST['mine_production'];
	     
		//$temp= $this->model_designation->get_minetype_from_code($_POST["submine"]);
		//dump($temp);
		
		//$data['production']= $mine_production.' ('.$temp[0]["munit"].')' ;
		//$data['mine_type']= $temp[0]["minecategory"] ;

		$data['production']= $this->session->userdata('mine_production_new') ;
		$data['mine_type']= $this->session->userdata('mine_code_new');
		$data['sub_name']= $this->session->userdata('sub_name');
		$data['area_name']= $this->session->userdata('area_name');
		$data['subarea_name']= $this->session->userdata('subarea_name');
		$data['mine_name']= $this->session->userdata('mine_name');
		$data['year_name']= $this->session->userdata('year_name');
		$datamine = $this->model_designation->fetch_mineid($data['mine_type']);

		//print_r($datamine); //exit();

		$dataproduction = explode("(",$data['production']);
		
       //echo $dataproduction['0']; exit;

		

		$this->session->set_userdata('mine_prod',$dataproduction['0']);
	     
		
		$this->session->set_userdata('mine_code',$datamine['0']['mine_id']);


		
		$this->load->view('pages/display_filter_standard_data',$data);

	}



	public function finalize(){
		$mine_type = $this->session->userdata('mine_code');
		//dump("MineCode".$mine_type);
		$data['mine_type']=$mine_type;
		$mine_production = $this->session->userdata('mine_production');
		$data['production']=$mine_production;
	        //$data['submine_data']= $this->model_designation->get_submine_type_data($mine_type);
	       // dump($data);
		//$surplus = [] ;
		//$deficent = [];
		$post_data = $_POST;
		$combine = [];
			// unset($post_data['submit_data']);
		//dump($post_data);
		foreach ($post_data as $key => $value) {
			$arr = explode('-', $key);
				//dump($arr);

				#dump($value);
			if(count($arr)==4)
			{	
				$result = $this->model_designation->get_value_to_match($mine_type, $arr[0], $arr[1], $arr[2]);

				
					$depart = $this->model_designation->get_department_from_code($arr[0]);
					$combine[] = [ $depart, $arr[1],$arr[2],$result, $value];

				
			}

		}
			#dump("surplus");
			#dump($surplus);
			#dump("deficent");
			#dump($deficent);
	    
		$temp= $this->model_designation->get_minetype_from_code($mine_type);
		//dump($temp);
		
		$data['production']= $mine_production.' ('.$temp[0]["munit"].')' ;
		$data['mine_type']= $temp[0]["minecategory"] ;
		    
		#$data['surplus'] = $surplus;
		#$data['deficent'] = $deficent;
		$data['combine'] = $combine;
			//dump($mine_production);
		
		$this->load->view('pages/finalize_report',$data);
		//dump($data);
	}

	public function print_report(){
		$this->load->view('pages/print_css');
		$this->finalize();
	}

	public function logout(){
		$this->session->unset_userdata('isLogged');
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('userType');
		redirect();
	}



	public function importcsv()
 	{

 	//echo 'hii';//exit();
  $file_data= $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
  //$dd=
  //print_r($file_data); exit();
  foreach($file_data as $row)
  {
  	//$d1=$this->model_designation->get_dept_std_import($row["Departme"]);
  	$d2=$this->model_designation->get_cadre_std_import($row["Cadre"]);
  	//$d3=$this->model_designation->get_grade_std_import($row["Grade"],$row["Discipline"]);
  	//print_r($d1[0]['sno']);exit();
   $data[] = array(
    	  'mcode' => $row["Mcode"],
          //'department'  => $d1[0]["sno"],
          'cadre'   => $d2[0]["sno"],
          //'grade'   => $d3[0]["sno"],
          'E1'   => $row["E1"],
          'E2'   => $row["E2"],
          'E3'   => $row["E3"],
          'E4'   => $row["E4"],
          'E5'   => $row["E5"],
          'E6'   => $row["E6"],
          'E7'   => $row["E7"],
          'E8'   => $row["E8"],
          'status'=>$row["Status"]
          
   );
  }

  $this->model_designation->insertcsv($data);

  $message = "Data added successfully.";
  $this->session->set_flashdata("flashSuccess",$message);

  redirect(base_url().'index.php/pages/standard_data');
 }

 		public function importcsv_dynamic()
 	{

 	//echo 'hii';//exit();
  $file_data= $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
  //$dd=
  //print_r($file_data); exit();
  foreach($file_data as $row)
  {
  	//$d1=$this->model_designation->get_dept_std_import($row["Departme"]);
  	$d2=$this->model_designation->get_cadre_std_import($row["Cadre"]);
  	//$d3=$this->model_designation->get_grade_std_import($row["Grade"],$row["Discipline"]);
  	//print_r($d1[0]['sno']);exit();
   $data[] = array(
    	  'mcode' => $row["Mcode"],
          //'department'  => $d1[0]["sno"],
          'cadre'   => $d2[0]["sno"],
          //'grade'   => $d3[0]["sno"],
          'min_prod' =>$row["min_productio"],
          'max_prod' =>$row["max_productio"],
          'E1'   => $row["E1"],
          'E2'   => $row["E2"],
          'E3'   => $row["E3"],
          'E4'   => $row["E4"],
          'E5'   => $row["E5"],
          'E6'   => $row["E6"],
          'E7'   => $row["E7"],
          'E8'   => $row["E8"],
                  
   );
  }

  $this->model_designation->insertcsv_dynamic($data);

  $message = "Data added successfully.";
  $this->session->set_flashdata("flashSuccess",$message);

  redirect(base_url().'index.php/pages/standard_data');
 }

 	public function import_existing_manpower()
 	{
 		 $file_data= $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
  //$dd=
 		 
  		//print_r($d); exit();
       	$d1=$_POST["sub_name"];
       	$d2=$_POST["area_name"];
       	$d3=$_POST["subarea_name"];
       	$d4=$_POST["mine_name"];
       	$d5=$_POST["minecategory"];
       	$d6=$_POST["year_name"];
       	//$d7=$_POST["production"];
       	//print_r($d5);exit();
  foreach($file_data as $row)
  {
  	
  	$d8=$this->model_designation->get_cadre_std_import($row["Cadre"]);
  	//print_r($d8[0]['sno']);exit();
   $data[] = array(
    	  'sub_id' => $d1,
          'area_id'  => $d2,
          'subarea_id'   => $d3,
          'mine_id'   => $d4,
          'mine_type'   => $d5,
          'year_id'   => $d6,
          //'production' =>$d7,
          'cadre' =>$d8[0]['sno'],
          'E1' =>$row["E1"],
          'E2' =>$row["E2"],
          'E3' =>$row["E3"],
          'E4' =>$row["E4"],
          'E5' =>$row["E5"],
          'E6' =>$row["E6"],
          'E7' =>$row["E7"],
          'E8' =>$row["E8"]
   );
  }

  $this->model_designation->insert_existing_manpower($data);

  $message = "Data added successfully.";
  $this->session->set_flashdata("flashSuccess",$message);

  redirect(base_url().'index.php/pages/upload_existing_data');
 	}

 	public function import_mine_csv()
 	{

 	//echo 'hii';//exit();
  $file_data= $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
  //$dd=
  //print_r($file_data); exit();
  foreach($file_data as $row)
  {
  	$d1=$this->model_designation->get_subsidiary_import($row["Subsidiary"]);
  	$d2=$this->model_designation->get_area_import($row["Area"]);
  	$d3=$this->model_designation->get_subarea_import($row["Subarea"]);
  	$d4=$this->model_designation->get_minetype_import($row["MineType"]);
  	$d5=$this->model_designation->get_year_import($row["Yea"]);
  	//print_r($d4);exit();
   $data[] = array(
    	  'subarea_id' => $d3[0]["subarea_id"],
          'area_id'  => $d2[0]["area_id"],
          'sub_id'   => $d1[0]["sub_id"],
          'mine_name'   => $row["MineName"],
          'mine_type'   => $d4[0]["mine_id"],
          'year_id'   => $d5[0]["year_id"],
          'SR'        => $row["SR"],
          'coal'      => $row["Coal"],
          'OBR'       => $row["OBR"],
          'tot_excavation' => $row["Tot_excavatio"],
          'production'   => $row["Productio"]
   );
  }

  $this->model_designation->insert_mine_csv($data);

  $message = "Data added successfully.";
  $this->session->set_flashdata("flashSuccess",$message);

  redirect(base_url().'index.php/allmines');
 }

 	public function import_area_csv()
 	{

 	//echo 'hii';//exit();
  $file_data= $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
  //$dd=
  //print_r($file_data); exit();
  foreach($file_data as $row)
  {
  	$d1=$this->model_designation->get_subsidiary_import($row["Subsidiary"]);
  	//print_r($d4);exit();
   $data[] = array(
    	  
          'sub_id'   => $d1[0]["sub_id"],
          'area_name'   => $row["Area"]
   );
  }

  $this->model_designation->insert_area_csv($data);

  $message = "Data added successfully.";
  $this->session->set_flashdata("flashSuccess",$message);

  redirect(base_url().'index.php/area');
 }

 	public function import_subarea_csv()
 	{

 	//echo 'hii';//exit();
  $file_data= $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
  //$dd=
  //print_r($file_data); exit();
  foreach($file_data as $row)
  {
  	$d1=$this->model_designation->get_subsidiary_import($row["Subsidiary"]);
  	$d2=$this->model_designation->get_area_import($row["Area"]);
  	//print_r($d4);exit();
   $data[] = array(
    	  
          'area_id'  => $d2[0]["area_id"],
          'sub_id'   => $d1[0]["sub_id"],
          'subarea_name'   => $row["Subarea"],
   );
  }

  $this->model_designation->insert_subarea_csv($data);

  $message = "Data added successfully.";
  $this->session->set_flashdata("flashSuccess",$message);

  redirect(base_url().'index.php/subarea');
 }


	public function department_cadre_excel()
	{
		$data['dept']=$this->model_designation->get_department_for_excel();
		$data['cadre']=$this->model_designation->get_cadre_for_excel();
		//$data['grade']=$this->model_designation->get_grade_for_excel();
		//print_r($data['grade']);die();
		$sub_name=$_POST['sub_name'];
		$area_name=$_POST['area_name'];
		$subarea_name=$_POST['subarea_name'];
		$mine_name=$_POST['mine_name'];

		$temp1= $this->model_designation->get_subsidiary($sub_name);
		$temp2= $this->model_designation->get_area($area_name);
		$temp3= $this->model_designation->get_subarea($subarea_name);
		$temp4= $this->model_designation->get_mine($mine_name);

		$data['sub_name']=$temp1[0]["sub_name"];
		$data['area_name']=$temp2[0]["area_name"];
		$data['subarea_name']=$temp3[0]["subarea_name"];
		$data['mine_name']=$temp4[0]["mine_name"];
		//print_r($data['sub_name']);die();
		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');
		//$this->load->library("excel");
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()->setTitle("");
		$objPHPExcel->getProperties()->setSubject(""); 
		$objPHPExcel->getProperties()->setDescription("");
		$from = "A6"; // or any value
		$to = "J6"; // or any value
		$objPHPExcel->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold( true );

	    
	    $objPHPExcel->setActiveSheetIndex(0);

	    
	    $objPHPExcel->getActiveSheet()->SetCellValue('A1','Subsidiary - ');
	    $objPHPExcel->getActiveSheet()->SetCellValue('A2','Area - ');
	    $objPHPExcel->getActiveSheet()->SetCellValue('A3','Subarea - ');
	    $objPHPExcel->getActiveSheet()->SetCellValue('A4','Mine - ');
	    $objPHPExcel->getActiveSheet()->SetCellValue('B1',$data['sub_name']);
	    $objPHPExcel->getActiveSheet()->SetCellValue('B2',$data['area_name']);
	    $objPHPExcel->getActiveSheet()->SetCellValue('B3',$data['subarea_name']);
	    $objPHPExcel->getActiveSheet()->SetCellValue('B4',$data['mine_name']);
	   // $objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
	    //$objPHPExcel->getActiveSheet()->mergeCells('A2:B2');
	    //$objPHPExcel->getActiveSheet()->mergeCells('A3:B3');
	    //$objPHPExcel->getActiveSheet()->mergeCells('A4:B4');
	    $objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold( true );
	    $objPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setBold( true );
	    $objPHPExcel->getActiveSheet()->getStyle("A3")->getFont()->setBold( true );
	    $objPHPExcel->getActiveSheet()->getStyle("A4")->getFont()->setBold( true );
	    $objPHPExcel->getActiveSheet()->getStyle("B1")->getFont()->setBold( true );
	    $objPHPExcel->getActiveSheet()->getStyle("B2")->getFont()->setBold( true );
	    $objPHPExcel->getActiveSheet()->getStyle("B3")->getFont()->setBold( true );
	    $objPHPExcel->getActiveSheet()->getStyle("B4")->getFont()->setBold( true );

	 
	    $objPHPExcel->getActiveSheet()->SetCellValue('A6','Cadre');
	    $objPHPExcel->getActiveSheet()->SetCellValue('B6','E1');
	    $objPHPExcel->getActiveSheet()->SetCellValue('C6','E2');
	    $objPHPExcel->getActiveSheet()->SetCellValue('D6','E3');
	    $objPHPExcel->getActiveSheet()->SetCellValue('E6','E4');
	    $objPHPExcel->getActiveSheet()->SetCellValue('F6','E5');
	    $objPHPExcel->getActiveSheet()->SetCellValue('G6','E6');
	    $objPHPExcel->getActiveSheet()->SetCellValue('H6','E7');
	    $objPHPExcel->getActiveSheet()->SetCellValue('I6','E8');

	    $row = 7;

	    //foreach ($data['dept'] as $key => $value1) {
	     //	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$value1['department']);
	     	foreach($data['cadre'] as $key =>$value2)
	     	{
	     		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$value2['cil_cadre']);
	     		$row++;
	     	}
	     	
	     	$row++;
	     
	     //} 
	    
	     
	   
	    $new_file_name = "StandardMineData".date("d-m-Y-H-i-s "). '.xlsx';
	    
	    //if(move_uploaded_file($_FILES["result_file"]["tmp_name"], $file_directory . $new_file_name))
	   header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	   //   header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="'.$new_file_name.'"');
	     // header('Content-Disposition: attachment;filename="StandardMineData.xml"');
	    //header('Cache-Control: max-age=0');
	    // If you're serving to IE 9, then the following may be needed
	    header('Cache-Control: max-age=0');

	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

	    $objWriter->save('php://output');
	    exit;
	}
	public function excel()
	{   
		$mine_type = $this->session->userdata('mine_code');
		$mine_production = $this->session->userdata('mine_production');

		//exit();
		
		$data['values'] = $this->model_designation->get_values_for_excel($mine_type,$mine_production);
		//dump($data['values']);

		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');
		//$this->load->library("excel");
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()->setTitle("");
		$objPHPExcel->getProperties()->setSubject(""); 
		$objPHPExcel->getProperties()->setDescription("");
		$from = "A1"; // or any value
		$to = "E1"; // or any value
		$objPHPExcel->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold( true );
	    
	    $objPHPExcel->setActiveSheetIndex(0);

	    

	    $objPHPExcel->getActiveSheet()->SetCellValue('A1','Department');
	    $objPHPExcel->getActiveSheet()->SetCellValue('B1','Cadre');
	    $objPHPExcel->getActiveSheet()->SetCellValue('C1','Info');
	    $objPHPExcel->getActiveSheet()->SetCellValue('D1','Grade');
	    $objPHPExcel->getActiveSheet()->SetCellValue('E1','No. of Employee');
	    //$objPHPExcel->getActiveSheet()->SetCellValue('F1','Curr. of Employee');

	   /* $table_columns = array("Department", "Cadre", "Grade", "Req. of emp.", "Info");

  		$column = 0;

  		foreach($table_columns as $field)
 		 {
  		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
  		$column++;
 		}*/

	    $row = 2;

	    foreach ($data['values'] as $key => $value) {
	     	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$value['dept_name']);
	     	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$value['cadre']);
	     	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$value['info']);
	     	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$value['grade']);
	     	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,$value['no_of_emp']);
	     	$row++;
	     
	     } 
	    
	     
	   
	    $new_file_name = "StandardMineData".date("d-m-Y-H-i-s "). '.xlsx';
	    
	    //if(move_uploaded_file($_FILES["result_file"]["tmp_name"], $file_directory . $new_file_name))
	   header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	   //   header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="'.$new_file_name.'"');
	     // header('Content-Disposition: attachment;filename="StandardMineData.xml"');
	    //header('Cache-Control: max-age=0');
	    // If you're serving to IE 9, then the following may be needed
	    header('Cache-Control: max-age=0');

	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

	    $objWriter->save('php://output');
	    exit;

	} 


	public function excelfilter()
	{   
		$mine_type = $this->session->userdata('mine_code');
		$mine_production = $this->session->userdata('mine_production');

		//exit();
		
		$data['values'] = $this->model_designation->get_values_for_excel_filter($mine_type,$mine_production);
		//dump($data['values']);

		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');
		//$this->load->library("excel");
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()->setTitle("");
		$objPHPExcel->getProperties()->setSubject(""); 
		$objPHPExcel->getProperties()->setDescription("");
		$from = "A1"; // or any value
		$to = "D1"; // or any value
		$objPHPExcel->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold( true );
	    
	    $objPHPExcel->setActiveSheetIndex(0);

	    

	    $objPHPExcel->getActiveSheet()->SetCellValue('A1','Cadre');
	    $objPHPExcel->getActiveSheet()->SetCellValue('B1','Grade');
	    $objPHPExcel->getActiveSheet()->SetCellValue('C1','Info');
	    $objPHPExcel->getActiveSheet()->SetCellValue('D1','Tot. Req. of Employee');
	   
	    //$objPHPExcel->getActiveSheet()->SetCellValue('F1','Curr. of Employee');

	   /* $table_columns = array("Department", "Cadre", "Grade", "Req. of emp.", "Info");

  		$column = 0;

  		foreach($table_columns as $field)
 		 {
  		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
  		$column++;
 		}*/

	    $row = 2;

	    foreach ($data['values'] as $key => $value) {
	     	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$value['cadre']);
	     	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$value['grade']);
	     	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$value['info']);
	     	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$value['sum']);
	     	
	     	$row++;
	     
	     } 
	    
	     
	   
	    $new_file_name = "StandardMineData".date("d-m-Y-H-i-s "). '.xlsx';
	    
	    //if(move_uploaded_file($_FILES["result_file"]["tmp_name"], $file_directory . $new_file_name))
	   header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	   //   header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="'.$new_file_name.'"');
	     // header('Content-Disposition: attachment;filename="StandardMineData.xml"');
	    //header('Cache-Control: max-age=0');
	    // If you're serving to IE 9, then the following may be needed
	    header('Cache-Control: max-age=0');

	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

	    $objWriter->save('php://output');
	    exit;

	}

	public function excel_subarea_wise()
	{   
		$mine_type = $this->session->userdata('mine_code');
		$mine_production = $this->session->userdata('mine_production');

		//exit();
		
		$data['values'] = $this->model_designation->get_values_for_excel_filter($mine_type,$mine_production);
		//dump($data['values']);

		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');
		//$this->load->library("excel");
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()->setTitle("");
		$objPHPExcel->getProperties()->setSubject(""); 
		$objPHPExcel->getProperties()->setDescription("");
		$from = "A1"; // or any value
		$to = "D1"; // or any value
		$objPHPExcel->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold( true );
	    
	    $objPHPExcel->setActiveSheetIndex(0);

	    

	    $objPHPExcel->getActiveSheet()->SetCellValue('A1','Cadre');
	    $objPHPExcel->getActiveSheet()->SetCellValue('B1','Grade');
	    $objPHPExcel->getActiveSheet()->SetCellValue('C1','Info');
	    $objPHPExcel->getActiveSheet()->SetCellValue('D1','Tot. Req. of Employee');
	   
	    //$objPHPExcel->getActiveSheet()->SetCellValue('F1','Curr. of Employee');

	   /* $table_columns = array("Department", "Cadre", "Grade", "Req. of emp.", "Info");

  		$column = 0;

  		foreach($table_columns as $field)
 		 {
  		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
  		$column++;
 		}*/

	    $row = 2;

	    foreach ($data['values'] as $key => $value) {
	     	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$value['cadre']);
	     	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$value['grade']);
	     	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$value['info']);
	     	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$value['sum']);
	     	
	     	$row++;
	     
	     } 
	    
	     
	   
	    $new_file_name = "StandardMineData".date("d-m-Y-H-i-s "). '.xlsx';
	    
	    //if(move_uploaded_file($_FILES["result_file"]["tmp_name"], $file_directory . $new_file_name))
	   header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	   //   header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="'.$new_file_name.'"');
	     // header('Content-Disposition: attachment;filename="StandardMineData.xml"');
	    //header('Cache-Control: max-age=0');
	    // If you're serving to IE 9, then the following may be needed
	    header('Cache-Control: max-age=0');

	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

	    $objWriter->save('php://output');
	    exit;

	}

	public function excel_area_wise()
	{   
		$mine_type = $this->session->userdata('mine_code');
		$mine_production = $this->session->userdata('mine_production');

		//exit();
		
		$data['values'] = $this->model_designation->get_values_for_excel_filter($mine_type,$mine_production);
		//dump($data['values']);

		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');
		//$this->load->library("excel");
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()->setTitle("");
		$objPHPExcel->getProperties()->setSubject(""); 
		$objPHPExcel->getProperties()->setDescription("");
		$from = "A1"; // or any value
		$to = "D1"; // or any value
		$objPHPExcel->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold( true );
	    
	    $objPHPExcel->setActiveSheetIndex(0);

	    

	    $objPHPExcel->getActiveSheet()->SetCellValue('A1','Cadre');
	    $objPHPExcel->getActiveSheet()->SetCellValue('B1','Grade');
	    $objPHPExcel->getActiveSheet()->SetCellValue('C1','Info');
	    $objPHPExcel->getActiveSheet()->SetCellValue('D1','Tot. Req. of Employee');
	   
	    //$objPHPExcel->getActiveSheet()->SetCellValue('F1','Curr. of Employee');

	   /* $table_columns = array("Department", "Cadre", "Grade", "Req. of emp.", "Info");

  		$column = 0;

  		foreach($table_columns as $field)
 		 {
  		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
  		$column++;
 		}*/

	    $row = 2;

	    foreach ($data['values'] as $key => $value) {
	     	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$value['cadre']);
	     	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$value['grade']);
	     	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$value['info']);
	     	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$value['sum']);
	     	
	     	$row++;
	     
	     } 
	    
	     
	   
	    $new_file_name = "StandardMineData".date("d-m-Y-H-i-s "). '.xlsx';
	    
	    //if(move_uploaded_file($_FILES["result_file"]["tmp_name"], $file_directory . $new_file_name))
	   header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	   //   header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="'.$new_file_name.'"');
	     // header('Content-Disposition: attachment;filename="StandardMineData.xml"');
	    //header('Cache-Control: max-age=0');
	    // If you're serving to IE 9, then the following may be needed
	    header('Cache-Control: max-age=0');

	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

	    $objWriter->save('php://output');
	    exit;

	}

	public function excel_subsidiary_wise()
	{   
		$mine_type = $this->session->userdata('mine_code');
		$mine_production = $this->session->userdata('mine_production');

		//exit();
		
		$data['values'] = $this->model_designation->get_values_for_excel_filter($mine_type,$mine_production);
		//dump($data['values']);

		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');
		//$this->load->library("excel");
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()->setTitle("");
		$objPHPExcel->getProperties()->setSubject(""); 
		$objPHPExcel->getProperties()->setDescription("");
		$from = "A1"; // or any value
		$to = "D1"; // or any value
		$objPHPExcel->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold( true );
	    
	    $objPHPExcel->setActiveSheetIndex(0);

	    

	    $objPHPExcel->getActiveSheet()->SetCellValue('A1','Cadre');
	    $objPHPExcel->getActiveSheet()->SetCellValue('B1','Grade');
	    $objPHPExcel->getActiveSheet()->SetCellValue('C1','Info');
	    $objPHPExcel->getActiveSheet()->SetCellValue('D1','Tot. Req. of Employee');
	   
	    //$objPHPExcel->getActiveSheet()->SetCellValue('F1','Curr. of Employee');

	   /* $table_columns = array("Department", "Cadre", "Grade", "Req. of emp.", "Info");

  		$column = 0;

  		foreach($table_columns as $field)
 		 {
  		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
  		$column++;
 		}*/

	    $row = 2;

	    foreach ($data['values'] as $key => $value) {
	     	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$value['cadre']);
	     	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$value['grade']);
	     	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$value['info']);
	     	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$value['sum']);
	     	
	     	$row++;
	     
	     } 
	    
	     
	   
	    $new_file_name = "StandardMineData".date("d-m-Y-H-i-s "). '.xlsx';
	    
	    //if(move_uploaded_file($_FILES["result_file"]["tmp_name"], $file_directory . $new_file_name))
	   header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	   //   header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="'.$new_file_name.'"');
	     // header('Content-Disposition: attachment;filename="StandardMineData.xml"');
	    //header('Cache-Control: max-age=0');
	    // If you're serving to IE 9, then the following may be needed
	    header('Cache-Control: max-age=0');

	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

	    $objWriter->save('php://output');
	    exit;

	}

	public function std_data_excel_format()
	{

		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');
		//$this->load->library("excel");
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()->setTitle("");
		$objPHPExcel->getProperties()->setSubject(""); 
		$objPHPExcel->getProperties()->setDescription("");
		$from = "A1"; // or any value
		$to = "K1"; // or any value
		$objPHPExcel->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold( true );
	    
	    $objPHPExcel->setActiveSheetIndex(0);

	    

	    $objPHPExcel->getActiveSheet()->SetCellValue('A1','Mcode');
	    $objPHPExcel->getActiveSheet()->SetCellValue('B1','Cadre');
	    $objPHPExcel->getActiveSheet()->SetCellValue('C1','E1');
	    $objPHPExcel->getActiveSheet()->SetCellValue('D1','E2');
	    $objPHPExcel->getActiveSheet()->SetCellValue('E1','E3');
	    $objPHPExcel->getActiveSheet()->SetCellValue('F1','E4');
	    $objPHPExcel->getActiveSheet()->SetCellValue('G1','E5');
	    $objPHPExcel->getActiveSheet()->SetCellValue('H1','E6');
	    $objPHPExcel->getActiveSheet()->SetCellValue('I1','E7');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1','E8');
	    $objPHPExcel->getActiveSheet()->SetCellValue('K1','Status');

	   /* $row = 2;

	    foreach ($data['dept'] as $key => $value1) {
	     	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$value1['department']);
	     	foreach($data['cadre'] as $key =>$value2)
	     	{
	     		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$value2['cil_cadre']);
	     		$row++;
	     	}
	     	
	     	$row++;
	     
	     } */
	    
	     
	   
	    $new_file_name = "StandardMineData".date("d-m-Y-H-i-s "). '.xlsx';
	    
	    //if(move_uploaded_file($_FILES["result_file"]["tmp_name"], $file_directory . $new_file_name))
	   header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	   //   header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="'.$new_file_name.'"');
	     // header('Content-Disposition: attachment;filename="StandardMineData.xml"');
	    //header('Cache-Control: max-age=0');
	    // If you're serving to IE 9, then the following may be needed
	    header('Cache-Control: max-age=0');

	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

	    $objWriter->save('php://output');
	    exit;
	}

	public function std_data_dynamic_excel_format()
	{

		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');
		//$this->load->library("excel");
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()->setTitle("");
		$objPHPExcel->getProperties()->setSubject(""); 
		$objPHPExcel->getProperties()->setDescription("");
		$from = "A1"; // or any value
		$to = "L1"; // or any value
		$objPHPExcel->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold( true );
	    
	    $objPHPExcel->setActiveSheetIndex(0);

	    

	    $objPHPExcel->getActiveSheet()->SetCellValue('A1','Mcode');
	    $objPHPExcel->getActiveSheet()->SetCellValue('B1','Cadre');
	    $objPHPExcel->getActiveSheet()->SetCellValue('C1','min_production');
	    $objPHPExcel->getActiveSheet()->SetCellValue('D1','max_production');
	    $objPHPExcel->getActiveSheet()->SetCellValue('E1','E1');
	    $objPHPExcel->getActiveSheet()->SetCellValue('F1','E2');
	    $objPHPExcel->getActiveSheet()->SetCellValue('G1','E3');
	    $objPHPExcel->getActiveSheet()->SetCellValue('H1','E4');
	    $objPHPExcel->getActiveSheet()->SetCellValue('I1','E5');
	    $objPHPExcel->getActiveSheet()->SetCellValue('J1','E6');
	    $objPHPExcel->getActiveSheet()->SetCellValue('K1','E7');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1','E8');

	   /* $row = 2;

	    foreach ($data['dept'] as $key => $value1) {
	     	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$value1['department']);
	     	foreach($data['cadre'] as $key =>$value2)
	     	{
	     		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$value2['cil_cadre']);
	     		$row++;
	     	}
	     	
	     	$row++;
	     
	     } */
	    
	     
	   
	    $new_file_name = "StandardMineData".date("d-m-Y-H-i-s "). '.xlsx';
	    
	    //if(move_uploaded_file($_FILES["result_file"]["tmp_name"], $file_directory . $new_file_name))
	   header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	   //   header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="'.$new_file_name.'"');
	     // header('Content-Disposition: attachment;filename="StandardMineData.xml"');
	    //header('Cache-Control: max-age=0');
	    // If you're serving to IE 9, then the following may be needed
	    header('Cache-Control: max-age=0');

	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

	    $objWriter->save('php://output');
	    exit;
	}

	public function mine_data_excel_format()
	{

		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');
		//$this->load->library("excel");
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()->setTitle("");
		$objPHPExcel->getProperties()->setSubject(""); 
		$objPHPExcel->getProperties()->setDescription("");
		$from = "A1"; // or any value
		$to = "G1"; // or any value
		$objPHPExcel->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold( true );
	    
	    $objPHPExcel->setActiveSheetIndex(0);

	    

	    $objPHPExcel->getActiveSheet()->SetCellValue('A1','Subsidiary');
	    $objPHPExcel->getActiveSheet()->SetCellValue('B1','Area');
	    $objPHPExcel->getActiveSheet()->SetCellValue('C1','Subarea');
	    $objPHPExcel->getActiveSheet()->SetCellValue('D1','MineName');
	    $objPHPExcel->getActiveSheet()->SetCellValue('E1','MineType');
	    $objPHPExcel->getActiveSheet()->SetCellValue('F1','Year');
	    $objPHPExcel->getActiveSheet()->SetCellValue('G1','Production');
	   

	   /* $row = 2;

	    foreach ($data['dept'] as $key => $value1) {
	     	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$value1['department']);
	     	foreach($data['cadre'] as $key =>$value2)
	     	{
	     		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$value2['cil_cadre']);
	     		$row++;
	     	}
	     	
	     	$row++;
	     
	     } */
	    
	     
	   
	    $new_file_name = "StandardMineData".date("d-m-Y-H-i-s "). '.xlsx';
	    
	    //if(move_uploaded_file($_FILES["result_file"]["tmp_name"], $file_directory . $new_file_name))
	   header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	   //   header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="'.$new_file_name.'"');
	     // header('Content-Disposition: attachment;filename="StandardMineData.xml"');
	    //header('Cache-Control: max-age=0');
	    // If you're serving to IE 9, then the following may be needed
	    header('Cache-Control: max-age=0');

	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

	    $objWriter->save('php://output');
	    exit;
	}

	public function area_excel_format()
	{

		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');
		//$this->load->library("excel");
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()->setTitle("");
		$objPHPExcel->getProperties()->setSubject(""); 
		$objPHPExcel->getProperties()->setDescription("");
		$from = "A1"; // or any value
		$to = "B1"; // or any value
		$objPHPExcel->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold( true );
	    
	    $objPHPExcel->setActiveSheetIndex(0);

	    

	    $objPHPExcel->getActiveSheet()->SetCellValue('A1','Subsidiary');
	    $objPHPExcel->getActiveSheet()->SetCellValue('B1','Area');
	   

	   /* $row = 2;

	    foreach ($data['dept'] as $key => $value1) {
	     	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$value1['department']);
	     	foreach($data['cadre'] as $key =>$value2)
	     	{
	     		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$value2['cil_cadre']);
	     		$row++;
	     	}
	     	
	     	$row++;
	     
	     } */
	    
	     
	   
	    $new_file_name = "StandardMineData".date("d-m-Y-H-i-s "). '.xlsx';
	    
	    //if(move_uploaded_file($_FILES["result_file"]["tmp_name"], $file_directory . $new_file_name))
	   header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	   //   header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="'.$new_file_name.'"');
	     // header('Content-Disposition: attachment;filename="StandardMineData.xml"');
	    //header('Cache-Control: max-age=0');
	    // If you're serving to IE 9, then the following may be needed
	    header('Cache-Control: max-age=0');

	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

	    $objWriter->save('php://output');
	    exit;
	}

	public function subarea_excel_format()
	{

		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');
		//$this->load->library("excel");
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()->setTitle("");
		$objPHPExcel->getProperties()->setSubject(""); 
		$objPHPExcel->getProperties()->setDescription("");
		$from = "A1"; // or any value
		$to = "C1"; // or any value
		$objPHPExcel->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold( true );
	    
	    $objPHPExcel->setActiveSheetIndex(0);

	    

	    $objPHPExcel->getActiveSheet()->SetCellValue('A1','Subsidiary');
	    $objPHPExcel->getActiveSheet()->SetCellValue('B1','Area');
	    $objPHPExcel->getActiveSheet()->SetCellValue('C1','Subarea');

	   /* $row = 2;

	    foreach ($data['dept'] as $key => $value1) {
	     	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$value1['department']);
	     	foreach($data['cadre'] as $key =>$value2)
	     	{
	     		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$value2['cil_cadre']);
	     		$row++;
	     	}
	     	
	     	$row++;
	     
	     } */
	    
	     
	   
	    $new_file_name = "StandardMineData".date("d-m-Y-H-i-s "). '.xlsx';
	    
	    //if(move_uploaded_file($_FILES["result_file"]["tmp_name"], $file_directory . $new_file_name))
	   header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	   //   header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="'.$new_file_name.'"');
	     // header('Content-Disposition: attachment;filename="StandardMineData.xml"');
	    //header('Cache-Control: max-age=0');
	    // If you're serving to IE 9, then the following may be needed
	    header('Cache-Control: max-age=0');

	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

	    $objWriter->save('php://output');
	    exit;
	}

	public function upload_existing_data()
	{   $data['minecategory'] = $this->model_designation->fetch_minetype();
		$data['sub_name']=$this->model_designation->fetch_subsidiary();
		$data['year_name']=$this->model_designation->fetch_year();
		// $data['values'] = $this->model_designation->get_values();

		$this->load->view('pages/upload_existing_data',$data);
		$this->load->view('templates/footer');
	}

	public function upload_standard_data()
	{   

		$this->load->view('pages/upload_standard_data');
		$this->load->view('templates/footer');
	}
	public function upload_standard_dynamic_data()
	{   

		$this->load->view('pages/upload_standard_dynamic_data');
		$this->load->view('templates/footer');
	}
	/*public function excelmatchdata()
	{   
		$mine_type = $this->session->userdata('mine_code');
		$mine_production = $this->session->userdata('mine_production');
		
		$data['values'] = $this->model_designation->get_values_for_excel($mine_type,$mine_production);
		//dump($data['values']);

		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');
		//$this->load->library("excel");
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()->setTitle("");
		$objPHPExcel->getProperties()->setSubject(""); 
		$objPHPExcel->getProperties()->setDescription("");
	    
	    $objPHPExcel->setActiveSheetIndex(0);

	    

	    $objPHPExcel->getActiveSheet()->SetCellValue('A1','Department');
	    $objPHPExcel->getActiveSheet()->SetCellValue('B1','Cadre');
	    $objPHPExcel->getActiveSheet()->SetCellValue('C1','Info');
	    $objPHPExcel->getActiveSheet()->SetCellValue('D1','Grade');
	    $objPHPExcel->getActiveSheet()->SetCellValue('E1','No. of Employee');
	    //$objPHPExcel->getActiveSheet()->SetCellValue('F1','Curr. of Employee');

	   /* $table_columns = array("Department", "Cadre", "Grade", "Req. of emp.", "Info");

  		$column = 0;

  		foreach($table_columns as $field)
 		 {
  		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
  		$column++;
 		}

	    $row = 2;

	    foreach ($data['values'] as $key => $value) {
	     	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$value['dept_name']);
	     	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$value['cadre']);
	     	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$value['info']);
	     	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$value['grade']);
	     	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,$value['no_of_emp']);
	     	$row++;
	     
	     } 
	    
	     
	   
	    $new_file_name = "MatchedMineData".date("d-m-Y-H-i-s "). '.xlsx';
	    
	    //if(move_uploaded_file($_FILES["result_file"]["tmp_name"], $file_directory . $new_file_name))
	   header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	   //   header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="'.$new_file_name.'"');
	     // header('Content-Disposition: attachment;filename="StandardMineData.xml"');
	    //header('Cache-Control: max-age=0');
	    // If you're serving to IE 9, then the following may be needed
	    header('Cache-Control: max-age=0');

	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

	    $objWriter->save('php://output');
	    exit;




	}*/
}

// public function excel()
// {
// 	required(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
// 	required(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExel/Writer/Excel2007.php');

// } 
?>