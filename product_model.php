<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Product_model extends CI_Model {

	public function getProducts()
	{
		return $this->db->query("SELECT t1.*,t2.category as icategory, t3.region as iregion FROM industry t1 
								LEFT JOIN category_industry t2 ON t1.category=t2.id
								LEFT JOIN region t3 ON t1.region = t3.id ORDER BY t1.name ASC")->result_array();
	}

	public function getTools($cat)
	{
		return $this->db->query("SELECT t1.*,t2.category as icategory, t3.region as iregion FROM industry t1 
								LEFT JOIN category_industry t2 ON t1.category=t2.id
								LEFT JOIN region t3 ON t1.region = t3.id WHERE t2.category='$cat' ")->result_array();
	}
	
       public function getTool($id)
	{
		return $this->db->query("SELECT t1.*,t2.category as icategory, t3.region as iregion FROM industry t1 
								LEFT JOIN category_industry t2 ON t1.category=t2.id
								LEFT JOIN region t3 ON t1.region = t3.id WHERE t1.id='$id' ")->result_array();
	}
	public function getTable($table)
	{
		return $this->db->get($table)->result_array();
	}
	public function countAll($table)
	{
		return $this->db->count_all($table);
        }	
	public function search()
	{
		$keyword = mysql_real_escape_string(trim($this->input->post('searchInput')));
                
		$category = $this->input->post('category');
		if($category == ''){
			$category = "%%";
		}
		$region = $this->input->post('region');
		if($region == ''){
			$region = "%%";
		}
		$capacity= $this->input->post('capacity');
		if($capacity == ''){
			$capacity = "%%";
		}
        $search5= $this->input->post('search5');
	$search4= $this->input->post('search4');
$list= $this->input->post('list');
$keyword1 = mysql_real_escape_string(trim($this->input->post('searchInput1')));
		if($search4 == '' && $search5 == '' ){
			$search4 = "";
                        $search5 = "";
		}else {






		return $this->db->query("SELECT t1.*,t2.category as icategory, t3.region  as iregion FROM industry t1 
								LEFT JOIN category_industry t2 ON t1.category=t2.id
								LEFT JOIN region t3 ON t1.region = t3.id 
								WHERE capacity BETWEEN $search4 AND $search5 AND capacity like '%$list%'
								ORDER BY t1.name ASC")->result_array();


                           
	
}





	
		return $this->db->query("SELECT t1.*,t2.category as icategory, t3.region  as iregion FROM industry t1 
								LEFT JOIN category_industry t2 ON t1.category=t2.id
								LEFT JOIN region t3 ON t1.region = t3.id 
								WHERE t1.name like '%$keyword%' and t1.category like '$category' and t1.region like '$region' and type_product like '%$keyword1%'
								ORDER BY t1.name ASC")->result_array();



}

        public function get_industry($id) {
      return $this->db->query("SELECT * FROM industry WHERE id=$id")->result_array();
}
	public function getPage($page)
    {
        return $this->db->query("SELECT * FROM category_industry WHERE category='$page' LIMIT 1")->row_array();
    }
	
	public function getCategories()
	{
		return $this->db->query("SELECT id, category FROM category_industry ORDER BY id")->result_array();
	}
    
    public function getSubcategory($page)
    {
        return $this->db->query("SELECT t1.id,t1.category,t2.id,t2.name FROM category_industry t1
                          JOIN industry t2 ON t1.id=t2.category WHERE t1.category='$page'")->result_array();
    }
    
    public function getSubcategoryPage($id)
    {
        if($id != NULL)
            return $this->db->query("SELECT t1.*,t2.id,t2.category FROM industry t1, category_industry t2 WHERE t1.id=$id and t2.id=t1.category LIMIT 1")->row_array();
        else
            return FALSE;
    }


	public function getNews($category)
	{
		return $this->db->query("SELECT id,title,news_date,image,count_view FROM news WHERE category = $category ORDER BY id DESC LIMIT 5")->result_array();
	}
	
	public function getOneNews($id)
	{
		$this->db->query("UPDATE news SET count_view = count_view + 1 WHERE id=$id");
		$result = $this->db->query("SELECT * FROM news WHERE id=$id LIMIT 1")->row_array();
		return $result;
	}
	
	public function getLatestNews($limit,$start)
	{
		return $this->db->query("SELECT t1.id, t1.title, t1.image, t1.news_date,t1.count_view, t2.title as category FROM news t1, category_news t2 WHERE t1.category=t2.id ORDER BY id DESC LIMIT $start, $limit")->result_array();
	}
	public function countRecords($table)
	{
		return $this->db->count_all($table);
	}
       function register_user($name,$surname,$lastname,$user_name,$user_password,$user_email) {
	
		$this->db->query("INSERT INTO users (name,surname,lastname,user_name,user_password,user_email) VALUES ('$name','$surname','$lastname','$user_name','$user_password','$user_email')");
		
}

       function comment($name,$email,$msg) {
	
		$this->db->query("INSERT INTO msgs (name,email,msg) VALUES ('$name','$email','$msg')");
		
}

       function viewcomment() {
	
		 return $this->db->query("SELECT id,name,email,msg,UNIX_TIMESTAMP(datetime) as dt FROM msgs ORDER BY id DESC LIMIT 5")->result_array();
		
}

	public function getForum($category)
	{
		return $this->db->query("SELECT * FROM forum WHERE category = $category ORDER BY id DESC LIMIT 5")->result_array();
	}

     function viewnews($id) {
	
		 return $this->db->query("SELECT u.id, u.podcategory,u.title, u.content, d.title AS d_title FROM forum u INNER JOIN category_forum d ON u.category = d.id WHERE d.title=$id")->result_array();
	}

		function setblog($blog_title,$blog_body){
           	$this->db->query("INSERT INTO blog (blog_title,blog_body) VALUES ('$blog_title','$blog_body')");
                     }

   function getblog() {
	
		 return $this->db->query("SELECT id,blog_title,blog_body,blog_time,answer FROM blog WHERE activation=1 ORDER BY id DESC LIMIT 7")->result_array();
		
}
   function getblogfor() {
	
		 return $this->db->query("SELECT id,blog_title,blog_body,blog_time FROM blog WHERE activation=0 ORDER BY id DESC LIMIT 7")->result_array();
		
}

	function setblogfor($id,$answer){
           	$this->db->query("UPDATE blog SET answer = '$answer',activation='1'  WHERE id='$id'");
                     }

}
?>