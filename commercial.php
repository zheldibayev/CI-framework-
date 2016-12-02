<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commercial extends CI_Controller {

	public function index()
	{
		$data = array();
		$this->load->model('page_model');
		$data['uko'] = $this->page_model->getNews('1');
		$data['kaz'] = $this->page_model->getNews('2');
		$data['zar'] = $this->page_model->getNews('3');
		$data['title'] = "Коммерческие предложения";
		$this->load->view('pre_header',$data);
		$this->load->view('header');
		$this->load->view('commercial');
		$this->load->view('footer');
	}
	
}

/* End of file Commercial.php */
/* Location: ./application/controllers/Commercial.php */