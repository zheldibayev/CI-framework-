<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Region extends CI_Controller {

	public function index()
	{
		$this->load->model('product_model');
		$data = array();
		$data['products'] = $this->product_model->getProducts();
		$data['category'] = $this->product_model->getTable('category_industry');
		$data['region'] = $this->product_model->getTable('region');
		$data['uko'] = $this->product_model->getNews('1');
		$data['kaz'] = $this->product_model->getNews('2');
		$data['zar'] = $this->product_model->getNews('3');
		$data['title'] = "Продукция региона";
		if(isset($_POST['searchButton'])){
			$data['products'] = $this->product_model->search();
                 
		
              }
		
		$this->load->view('pre_header',$data);
		$this->load->view('header');
		$this->load->view('region');
		$this->load->view('footer');
	}
           public function product_page($id)
	{
		if(!is_numeric($id)) redirect(base_url());
		if(empty($id)) redirect(base_url());
		$data = array();
		$this->load->model('product_model');
		$data['products'] = $this->product_model->get_industrypage($page);
		$data['products'] = $this->product_model->get_industry($id);
		$data['title'] = $data['products']['name'];
		
		if(empty($data['products'])){ redirect(base_url()); }
		
		$this->load->view('pre_header',$data);
		$this->load->view('header');
		$this->load->view('subproducts');
		$this->load->view('content');
		$this->load->view('footer');
	}

    public function category($page,$id = NULL)
    {
        $this->load->model('page_model');
        $data = array();
		$data['page'] = $this->page_model->getPage($page);
		$data['uko'] = $this->page_model->getNews('1');
		$data['kaz'] = $this->page_model->getNews('2');
		$data['zar'] = $this->page_model->getNews('3');
		$data['categories'] = $this->page_model->getCategories();
		if(empty($data['page'])){ redirect(base_url()); }
        $data['subcategory'] = $this->page_model->getSubcategory($page);
        if ($id == NULL) {
			$data['title'] = $data['page']['title'];
            $this->load->view('pre_header',$data);
    		$this->load->view('header');
    		$this->load->view('page');
			$this->load->view('content');
    		$this->load->view('footer');
        } else {
			if(!is_numeric($id)) redirect(base_url());
            $data['subcategorypage'] = $this->page_model->getSubcategoryPage($id);
			if(empty($data['subcategorypage'])){
				redirect(base_url());
			}
			$data['title'] = $data['subcategorypage']['title'];
            $this->load->view('pre_header',$data);
    		$this->load->view('header');
            $this->load->view('subpage');
			$this->load->view('content');
    		$this->load->view('footer');
        }
    }	
}

/* End of file Commercial.php */
/* Location: ./application/controllers/Commercial.php */