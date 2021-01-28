<?php
    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    require_once(ABSPATH . "wp-admin" . '/includes/media.php');
   
function career_create(){
global $wpdb;
        $table_name = $wpdb->prefix . "career";
$parent_cat_table = $wpdb->prefix . "career_category";
$results = $wpdb->get_results ("SELECT * FROM $parent_cat_table");
date_default_timezone_set('Asia/Kolkata');
 $date= date('Y-m-d');

    $id = isset($_POST["id"])?$_POST["id"]:'';
    $name = isset($_POST["name"])?$_POST["name"]:'';
    $location = isset($_POST["name"])?$_POST["location"]:'';
    $description = isset($_POST["description"])?$_POST["description"]:'';
    $parent_category_id = isset($_POST["parent_category_id"])?$_POST["parent_category_id"]:'';
    $bunit = "";
    foreach ($results as $result) {
        if( $parent_category_id == $result->id){
            $bunit = $result->business_units;
        }
    }
    $slug =  sanitize_title_with_dashes( $name . ' ' .$bunit);
    if (isset($_POST['insert'])) {
/*
        $attachment_id = media_handle_upload('file-upload', 1);
        $imageurl = wp_get_attachment_url($attachment_id);
*/
$imageurl = '';
        global $wpdb;
        $table_name = $wpdb->prefix . "career";
        $wpdb->insert(
                $table_name, //table
                array('id' => $id, 
                'name' => $name,
                'date' => $date,
                'slug' =>  sanitize_title_with_dashes( $slug ),
                'location' => $location,
                'description' => $description,
                'image' => $imageurl,
                'parent_category_id' => $parent_category_id), //data
                array('%s', '%s','%s','%s','%s','%s','%s') //data format          
        );
        $message.="Career inserted";
    }
    ?>

    <div class="wrap"><a href="<?php echo admin_url('admin.php?page=career-list') ?>">&laquo; Back to Career List</a>
        <h2>Add New</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
            <table class='wp-list-table widefat fixed'>
            <tbody>
                <tr>
                    <th class="ss-th-width">Businesss Units</th>
                    <td>
                        <select name="parent_category_id" class="form-control">
                            <?php
                                global $wpdb;
                                global $wpdb;
                                $parent_cat_table = $wpdb->prefix . "career_category";
                                $results = $wpdb->get_results ("SELECT * FROM $parent_cat_table");
                                foreach ($results as $result) { ?>
                                    <option value="<?php echo $result->id; ?>"><?php echo $result->business_units; ?></option>
                                    <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th class="ss-th-width">Name</th>
                    <td><input type="text" name="name" value=""  class="form-control" required/></td>
                </tr>
                 <tr>
                    <th class="ss-th-width">Location</th>
                    <td><input type="text" name="location" value=""  class="form-control" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Description</th>
                    <td>
                        <?php
                            $content   = '';
                            $editor_id = 'description';
                            $settings  = array( 'media_buttons' => true );
                            wp_editor( $content, $editor_id, $settings );
                        ?>
                    </td>
                </tr>
            <!--    <tr>
                    <th class="ss-th-width">Image</th>
                    <td><input type="file" name="file-upload" id="file-upload"  accept="image/*"  ></td>
                </tr>
-->
             </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <input type='submit' name="insert" value='Save' class='button'>
                    </td>
                </tr>
            </tfoot>
            </table>
        </form>
    </div>

    <?php

}
