<section id="news_block" class="clearfix">
<style>
#news_block div.content1{
	margin-top:0px;
}
</style>
	<div class="breadcrumb clearfix">
		<a href="http://kasipker.info/" class="inactiv">главная</a>
		<a href="http://kasipker.info/blog" class="activ">блог</a>
	</div>
<div class="content1">
<?php
$thisfile=$_SERVER['PHP_SELF']; ?>
<form method="post" >
                  <p><label>Имя: </label> <input type="text" name="blog_title"></p>
                   <p><label>Вопрос: </label> </p>
                  <p><textarea rows="10" cols="45" name="blog_body"></textarea></p>
                  <p><input type="submit" name="submit"></p>
</form>

<?php
  if (!empty($_POST["submit"])) {

    header("Location: ".$_SERVER["REQUEST_URI"]);
    exit;
  }

?>

             	<ul class="list" style="-webkit-padding-start: 0px;">
    <?php foreach($blog as $row):?>
               <p>ВОПРОС №  <span style="  font-weight: bold;"><?=$row['id']?> </span>/ИМЯ: <span style="  font-weight: bold;"><?=$row['blog_title']?></span>/Дата: <span style="  font-weight: bold;"><?=$row['blog_time']?></span></p>
<p><?=$row['blog_body']?></p> 
<p><span style="  font-weight: bold;">ОТВЕТ:  </span>  <?=$row['answer']?></p>
 <hr>
    <?php endforeach;?>
	</ul>

                  

</div>
<?=$this->pagination->create_links();?>

</section>