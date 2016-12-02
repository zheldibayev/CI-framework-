<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {

	public function index()
	{
		$this->load->model('product_model');
		$data = array();
		$data['products'] = $this->product_model->getProducts();

                  if (isset($_GET['category']))
                    {

                   $cat = $_GET['category'];                   
                   $data['tools'] = $this->product_model->getTools($cat);
                   $tools = $data['tools'];
                  
                    }
	   
		$data['category'] = $this->product_model->getTable('category_industry');
		$data['region'] = $this->product_model->getTable('region');
		$data['uko'] = $this->product_model->getNews('1');
		$data['kaz'] = $this->product_model->getNews('2');
		$data['zar'] = $this->product_model->getNews('3');
		$data['title'] = "Продукция региона";
		
		if(isset($_POST['searchButton']))
		{
			
			$data['products'] = $this->product_model->search();
                 
		}
		
		$this->load->view('pre_header',$data);
		$this->load->view('header');
		$this->load->view('products');
		$this->load->view('footer2');
	}
           public function product_page($id = NULL)
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
		$this->load->view('footer2');
	}

    public function category($page,$id = NULL)
    {
        $this->load->model('page_model');
        $data = array();
		$data['page'] = $this->product_model->getPage($page);
		$data['uko'] = $this->product_model->getNews('1');
		$data['kaz'] = $this->product_model->getNews('2');
		$data['zar'] = $this->product_model->getNews('3');
		$data['categories'] = $this->product_model->getCategories();
		if(empty($data['page'])){ redirect(base_url()); }
        $data['industry'] = $this->page_model->getSubcategory($page);
        if ($id == NULL) {
			$data['title'] = $data['page']['name'];
            $this->load->view('pre_header',$data);
    		$this->load->view('header');
    		$this->load->view('products');
			$this->load->view('content');
    		$this->load->view('footer2');
        }else {
		
      	if(!is_numeric($id)) redirect(base_url());
            $data['industrypage'] = $this->page_model->getSubcategoryPage($id);
			if(empty($data['industrypage'])){
				redirect(base_url());
			}
			$data['title'] = $data['industrypage']['title'];
            $this->load->view('pre_header',$data);
    		$this->load->view('header');
            $this->load->view('subproducts');
			$this->load->view('content');
    		$this->load->view('footer2');
        }
    }
    
}


/* End of file page.php */
/* Location: ./application/controllers/invest.php */