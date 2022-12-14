 <?php
    $txt .= '
if (!defined("ABSPATH")) {
 die(' . "'Invalid request'" . ');
}
function noticenew()
{?>
 <div class="updated notice">
     <p><?php _e("New Record Is Added", "textdomain");?></p>
 </div>';
 $txt .= ' ' . '<?php }  
function noticeedit()
{?>';
 $txt .= '<div class="updated notice">' .
     '<p><?php _e("Record Is Updated", "textdomain");?></p>
 </div>';
 $txt .= '<?php } ';
$txt .=  '
$Notice = $_GET["notice"];
if ($Notice == "addnew") {
 noticenew();
}
if ($Notice == "edited") {
 noticeedit();
}
$getAction = $_GET["action"];
if (($getAction == "editlist") || ($getAction == "new")) {
 include_once plugin_dir_path(__FILE__) . "edit.php";
} else {
 include_once "functions/'.$dirname.'-class.php";
 $table = new '.str_replace(' ', '_', $view_title).'_Table();
 $table->set_table("' . $Table_name . '");
 $table->doActionBulk($_POST["action"]);
 if ($getAction == "delete") {
  $table->doAction($_GET["action"]);
 }
 echo ' . "'" . '<div class="wrap"><h2>'.$view_title.'</h2>' . "';" .
    'echo "<form method=' . "'" . 'post' . "'>" . '";';
$txt .= '
 ?>
 <p>
     <a href="?page=' . $dirname . '&action=new" style="margin:0 20px" class="button button-primary">New</a>
 </p>
 <?php
// Prepare table
 $table->prepare_items();
 // Search form
 $table->search_box("search", "search_id");
 // Display table
 $table->display();
 echo "</div></form>";
} ';