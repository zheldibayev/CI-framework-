<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends CI_Controller {

	public function index()

	{
		$data = array();
                 	$this->load->model('product_model');
		$this->load->model('page_model');
		$data['uko'] = $this->page_model->getNews('1');
		$data['kaz'] = $this->page_model->getNews('2');
		$data['zar'] = $this->page_model->getNews('3');
		$data['title'] = "Продукция";
                  $id=$_GET['id'];
                    $icategory=$_GET['icategory'];
if (isset($_GET['id']) && isset($_GET['icategory']) ) {
$data['products'] = $this->product_model->getProducts();

} 


		$this->load->view('pre_header',$data);
		$this->load->view('header');
		$this->load->view('company');
		$this->load->view('footer2');
	}	
}

/* End of file Commercial.php */
/* Location: ./application/controllers/Commercial.php */