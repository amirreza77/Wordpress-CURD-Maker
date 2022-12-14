<?php
foreach ($data as $da) { 
  $text2 .= "'" . $da['table_key'] . "' => $" . $da['table_key'] . ',
  
  ';
  $text3 .= "'" . $da['table_key'] . "' => '" . $da['table_title'] . "'". ',
  ';
  /********
   * POST *
   ********/
  $post .= '$' . $da['table_key'] . ' = $_POST[' . "'" . $da['table_key'] . "'" . '] ; ';
  /********
   * CASE *
   *    case 'userid':
   case 'aclid':
   ********/
  $case .= 'case ' . "'" . $da['table_key'] . "'" . ":
  ";
}
$txt .='
if (!class_exists('. "'WP_List_Table'" .')) {
 require_once ABSPATH .'. "'wp-admin/includes/class-wp-list-table.php'".';
} 

// Extending class
class '. $className.'_Table extends WP_List_Table
{

 private $table_name;
 public $table_data;
 public $found_data;

 public function set_table($var)
 { // You can then perform check on the data etc here
  $this->table_name = $var;
 }

 public function get_columns()
 {
  $columns = array(
   ';
   $txt .= "'cb'".   "  => '" .'<input type="checkbox"/>'. "'".' ,
   '. $text3 . ');';
  $txt .='
  return $columns;
 }

 private function get_table_data($search =' . "''" .')
 {
  global $wpdb;

  $table_name = $this->table_name;
  $query      = "'.'SELECT * FROM {$wpdb->prefix}$table_name'. '";
  if (!empty($search)) {
   $query = $query . " WHERE ';
   foreach ($data as $da) {
   $makeSearch[]= $da['table_key'] . ' like ' . '%{$search}%';
   }
$makeSearch = implode ( ' OR ' , $makeSearch);
   $txt .= $makeSearch .' ";
  }
  $orderby = (!empty($_GET['. "'orderby'" . '])) ? $_GET['. "'orderby'" .'] : '. "'id'" .';
  $order   = (!empty($_GET['. "'order'" .'])) ? $_GET['. "'order'" .'] :'. "'desc'" .';
  $query   = $query . " ORDER BY " . $orderby . '.  "' '"  . ' . $order;
  $res     = $wpdb->get_results($query, ARRAY_A);
  return $res;
 }

 public function get_sortable_columns()
 {
  ';
/* $sortable_columns = array(
  'id' => array('id', false),
  'userid'    => array('userid', false),
  'aclid'      => array('aclid', false),
); */
$txt .='
  $sortable_columns = array(
  '. "'id'" .'     => array(' . "'id'" .', false),';
  foreach ($data as $da){
    $array .= "
    '". $da['table_key'] ."' => array(" . "'" . $da['table_key'] . "' ,true" . '),';
  }
  $txt .= $array . ');
  return $sortable_columns;
 }';
  
$editableColums = $data[0]['table_key'];
 $txt .='
 public function column_'. $editableColums.'($item)
 {
  $actions = array(
   '. "'editList'" . ' => sprintf(' . "'" . '<a href="?page=%s&action=%s&id=%s">Edit</a>'. "'" .
   ', $_REQUEST[' . "'page'" .'],'. "'" .'editlist'. "',". '$item[' . "'id'" .']),
   '. "'" .'delete'. "'" .   "=> sprintf(" . "'" . '<a href="?page=%s&action=%s&id=%s">Delete</a>'. "'".
   ', $_REQUEST['. "'page'" .'], '. "'" . 'delete' ."'" .', $item['. "'id'" .']),
  );

  return sprintf('. "'". '%1$s %2$s' ."'" .', $item['."'". $editableColums."'".'], $this->row_actions($actions));
 }
 public function column_cb($item)
 {
  return sprintf(
   '."'".'<input type="checkbox" name="id[]" value="%s" />'. "'" .',
   $item['. "'id'" .']
  );
 }

 public function get_bulk_actions()
 {
  $actions = array(
  '. "'delete'" .' =>'. "'Delete'" .',
  );
  return $actions;
 }
 public function doAction($action)
 {
  if ($action =='.  "'delete'" .') {
   $id = $_GET['. "'id'" .'];
   global $wpdb;
   $table_name = $this->table_name;
   $wpdb->query(
    "DELETE FROM {$wpdb->prefix}$table_name WHERE id = $id"
   );
  }

 }
 public function doActionBulk($action)
 {
  if ($action == '. "'delete'" .') {
   $ids = $_POST['. "'id'" .'];
   global $wpdb;
   $table_name = $this->table_name;
   
   for ($i = 0; $i < count($ids); $i++) {
    $del_id = $ids[$i];
    $wpdb->query(
     "DELETE FROM {$wpdb->prefix}$table_name WHERE id IN ($del_id)"
    );
    $message ='. "'" .'<div class="updated error"><p>' . "'" 
    . '. _e("Record Is Deleted", "textdomain") .' . '"</p></div>";
   }
  }
 }

 public function prepare_items()
 {
  if (isset($_POST['. "'s'" .'])) {
   $this->table_data = $this->get_table_data($_POST['. "'s'" .']);
  } else {
   $this->table_data = $this->get_table_data();
  }
  $columns               = $this->get_columns();
  $hidden                = array();
  $sortable              = $this->get_sortable_columns();
  $this->_column_headers = array($columns, $hidden, $sortable);
  $this->items           = $this->table_data;
  /**************
   * PAGINITION *
   **************/

  $per_page = 20;

  $current_page = $this->get_pagenum();

  $total_items = count($this->table_data);
  $start       = ($current_page - 1) * $per_page;

  // only ncessary because we have sample data
  $this->found_data = array_slice($this->table_data, $start, $per_page);
  $this->set_pagination_args(array(
   ' ."'" .'total_items' ."'" . ' => $total_items, //WE have to calculate the total number of items
  ' . "'" . 'per_page' ."'" .' => $per_page, //WE have to determine how many items to show on a page
  ));
  $this->items = $this->found_data;
 }

 public function column_default($item, $column_name)
 {
  switch ($column_name) {
   case'. "'id'" .':
    ';
   $txt .= $case ;
    $txt .= 'return $item[$column_name];
   default:
    return print_r($item, true); //Show the whole array for troubleshooting purposes
  }
 }
}
';