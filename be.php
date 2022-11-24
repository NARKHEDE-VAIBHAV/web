

<?php


if (isset($_GET['key'])) {
    $blog_id = $_GET['key'];
  
    function number_abbr($number)
    {
    $abbrevs = [12 => 'T', 9 => 'B', 6 => 'M', 3 => 'K', 0 => ''];
  
    foreach ($abbrevs as $exponent => $abbrev) {
      if (abs($number) >= pow(10, $exponent)) {
        $display = $number / pow(10, $exponent);
        $decimals = ($exponent >= 3 && round($display) < 100) ? 1 : 0;
        $number = number_format($display, $decimals).$abbrev;
        break;
      }
    }
  
    return $number;
    }
  
    try {
    $conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    $stmt = $conn->prepare("SELECT * FROM tbl_blog_posts LEFT JOIN tbl_categories ON tbl_blog_posts.category = tbl_categories.id  WHERE tbl_blog_posts.id = ? ");
    $stmt->execute([$blog_id]);
    $result = $stmt->fetchAll();
  
    if (count($result) < 1) {
  
      if (WBCleanURL == "true") {
      header("location:../../");
      }else{
      header("location:../");
      }
  
    }else{
      foreach($result as $row)
      {
        $title = $row[1];
        $category_id = $row[3];
        $category = $row[12];
        $media = $row[5];
        $cont = $row[6];
        $short_desc = $row[7];
        $yt_vid = $row[8];
        $tags = $row[9];
        $visibilty = $row[10];
        $post_date = $row[2];
        $post_views = number_abbr($row[4]);
  
        if (WBCleanURL == "true") {
          $st1 = preg_replace("/[^a-zA-Z]/", " ", $row[12]);
          $st2 =  preg_replace('/\s+/', ' ', $st1);
          $cat_title = strtolower(str_replace(' ', '-', $st2));
  
          $post_cat_link = "category/$category_id/$cat_title";
        }else{
          $post_cat_link = "pages/category?key=$category_id";
        }
  
      }
  
      $stmt = $conn->prepare("SELECT * FROM tbl_blog_posts WHERE id < ? ORDER BY id DESC LIMIT 1");
      $stmt->execute([$blog_id]);
      $result = $stmt->fetchAll();
      $previous_post = "";
      $prev_link = "";
    
  
  
  
  
      $stmt = $conn->prepare("SELECT * FROM tbl_blog_posts WHERE id > ? ORDER BY id ASC LIMIT 1");
      $stmt->execute([$blog_id]);
      $result = $stmt->fetchAll();
      $previous_post = "";
      $next_link = "";
      
  
  
      $stmt = $conn->prepare("SELECT * FROM tbl_admin LIMIT 1");
      $stmt->execute();
      $result = $stmt->fetchAll();
      foreach($result as $row) {
        $ad_name = ''.$row[1].' '.$row[2].'';
        $ad_email = $row[3];
        $ad_about = $row[4];
        $ad_avator = $row[6];
      }
  
  
    }
  
  
}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}

}else{
if (WBCleanURL == "true") {
header("location:../../");
}else{
header("location:../");
}
}

//Count Visitor:


$ip =  $_SERVER['REMOTE_ADDR'];
$ip_info = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
if($ip_info && $ip_info->geoplugin_countryName != null){
$country = $ip_info->geoplugin_countryName;
$country_code = $ip_info->geoplugin_countryCode;

if ($country == "") {
  $country = "N/A";
}

if ($country_code == "") {
  $country_code = "N/A";
}

}else{
$country = "N/A";
$country_code = "N/A";
}

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_cords WHERE country = ?");
$stmt->execute([$country_code]);
$result = $stmt->fetchAll();

if ($country == "N/A") {
  $latlong = "N/A";
  $view_date = date('Y-m-d');
  $country_name = "N/A";

}

foreach($result as $row)
{
$latlong = ''.$row[1].','.$row[2].'';
$view_date = date('Y-m-d h:i:s');
$country_name = $row[3];
}

$stmt = $conn->prepare("SELECT * FROM tbl_blog_views WHERE article = ? AND ip_address = ?");
$stmt->execute([$blog_id, $ip]);
$result = $stmt->fetchAll();

if (count($result) < 1) {

$stmt = $conn->prepare("INSERT INTO tbl_blog_views (article, v_date, country_domain, country, ip_address, cords) VALUES (?,?,?,?,?,?)");
$stmt->execute([$blog_id, $view_date, $country_code, $country_name, $ip, $latlong]);

$stmt = $conn->prepare("UPDATE tbl_blog_posts SET views = views + 1 WHERE id = ?");
$stmt->execute([$blog_id]);
}


}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}


  ?>
  
  







	   			