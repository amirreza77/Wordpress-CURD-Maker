<?php

$txt .=' 
if (!defined('."'ABSPATH'".')) {
 die('."'Invalid request.');"."}".'

if ($_GET["id"]) {
 add_action("admin_notices", "my_error_notice");
 global $wpdb;
 $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}'.$Table_name .' where id = " . $_GET["id"], OBJECT);
 $result = $result[0];
 if ($_POST["status"] == '."'edited'".') {

     $tableName = $wpdb->prefix .'. "'".$Table_name . "';";
    $txt .= '$id = $_GET['."'id'".'] ; ';
foreach ($data as $da){
    $text .= "'". $da['table_key'] . "' => $".$da['table_key'].',';
/********
 * POST *
 ********/
 $post .= '
 $'.$da['table_key']  . ' = $_POST[' ."'".$da['table_key'] ."'".'] ; ';
}

$txt .= $post;
$text = mb_substr($text,0, -1);
$text = 'array('.$text.')';
  $txt .='
  $wpdb->update($tableName '.','.$text.', array('."'id'".' => $id));
  header("Location: ?page='.$dirname.'&notice=edited");
 }

} else {
 if ($_POST[' ."'status'" . '] == ' . "'newadded'" . ') {';
$post = '';
    foreach ($data as $da) {
 $post .= '$' . $da['table_key'] . ' = $_POST[' . "'" . $da['table_key'] . "'" . '] ; ';
}
 $txt .=  $post;
 $txt .= '
  global $wpdb;
   $tableName = $wpdb->prefix .'. "'".$Table_name . "';";
   $txt .= '
   $wpdb->insert($tableName'.','. $text. ');
  header("Location: ?page=' . $dirname . '&notice=addnew");

 }

}

?>
<div class="wrap">
    <h2>'. $view_title . ' EDIT</h2>
    <form method="post">
        <table class="form-table">
            <tbody>';
                foreach ($data as $da) {
                $txt .= '<tr>
                    <th scope="row"><label for="userid">' . $da["table_title"].'</label></th>
                    '.
                    '<td><input name="'. $da['table_key'] .'" type="text" id="'.$da['table_key'].'"
                            value="<?php echo $result->'.$da['table_key'].' ?>" class="regular-text">
                    </td>
                <tr>';

                    }
                    $txt .='<?php
if (!$_GET[' . "'id'" . ']) {?>

                    <input type="hidden" name="status" value="newadded" />
                    <?php } elseif ($_GET['. "'id'" .']) {?>

                    <input type="hidden" name="status" value="edited" />
                    <inpu ttype="hidden" name="id" value="<?php echo $_GET['. "'id'" .'] ?>" />'.
                    ' <?php } ?>
            </tbody>
            <tfoot>';
                $txt .= '<tr>
                    <td>
                        <button class="button button-primary" type="submit">Submit</button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </form>
</div> ';