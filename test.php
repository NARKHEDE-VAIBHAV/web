



<?php

/* Error Message: Deprecated: mysqli_connect(): The mysqli extension is deprecated and will be removed in the future: use mysqlii or PDO instead in C:\wamp64\www\kblog\resources\init.php on line 4 */

error_reporting(1); //handles error to accept deprecated mysqli extension



$config['db_host']  = 'localhost';
$config['db_user']  = 'root';
$config['db_pass']  = '';
$config['db_name']  = 'blog';

foreach($config as $k => $v){
    define(strtoupper($k),$v);
}

$conn=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);


function get_tbl_blog_posts($id = null, $visibility = null){
  global $conn;
    $tbl_blog_posts = array();
    $query = "SELECT
              `tbl_blog_posts`.`id` AS `post_id` ,
               `tbl_categories`.`id` AS `category_id`,
               `title`,`content`,`pub_date`,
               `tbl_categories`.`name`
               FROM `tbl_blog_posts`
               INNER JOIN `tbl_categories` ON `tbl_categories`.`id` = `tbl_blog_posts`.`visibility` " ;
    if(isset($id)){
        $id = (int)$id;
        $query .= " WHERE `tbl_blog_posts`.`id` = {$id} ";
             }
    if(isset($visibility)){
        $visibility = (int)$visibility;
        $query .= " WHERE `visibility` = {$visibility} ";
             }         
        
    $query .= "ORDER BY `post_id` DESC";
    
    $query = mysqli_query($conn,$query);
    
    while($row = mysqli_fetch_assoc($query)){
    $tbl_blog_posts[] = $row;
   }
   return $tbl_blog_posts;
}

function get_tbl_categories($id = null){
  global $conn;
   $tbl_categories = array();
   
   $query = mysqli_query($conn,"SELECT `id`,`name` FROM `tbl_categories`");
   
   while($row = mysqli_fetch_assoc($query)){
    $tbl_categories[] = $row;
   }
   
   return $tbl_categories;
}

function category_exists($field,$name){
  global $conn;
    $name = mysqli_real_escape_string($conn,$name);
    $field = mysqli_real_escape_string($conn,$field);
    $query = mysqli_query($conn,"SELECT * FROM tbl_categories WHERE `{$field}` = '{$name}'");
    // var_dump(mysqli_num_rows($query));exit;
    
    return(mysqli_num_rows($query) == 0)?false : true;
}




$tbl_blog_posts = get_tbl_blog_posts((isset($_GET['id']))? $_GET['id'] : null); 
?>	