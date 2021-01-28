<?php

require_once(ABSPATH . "wp-admin" . '/includes/image.php');
require_once(ABSPATH . "wp-admin" . '/includes/file.php');
require_once(ABSPATH . "wp-admin" . '/includes/media.php');

function career_update() {
    global $wpdb;
    $table_name = $wpdb->prefix . "career";
    $parent_cat_table = $wpdb->prefix . "career_category";
    $results = $wpdb->get_results ("SELECT * FROM $parent_cat_table");
    $id = isset($_GET["id"])?$_GET["id"]:'';
    $name = isset($_POST["name"])?$_POST["name"]:'';    
    $location = isset($_POST["location"])?$_POST["location"]:'';   
    $description = isset($_POST["description"])?$_POST["description"]:'';
    $parent_category_id = isset($_POST["parent_category_id"])?$_POST["parent_category_id"]:'';
    $bunit = "";
    foreach ($results as $result) {
        if( $parent_category_id == $result->id){
            $bunit = $result->business_units;
        }
    }
    $slug =  sanitize_title_with_dashes( $name . ' ' .$bunit);

    if (isset($_POST['update'])) {
        
         if($_FILES['file-upload']['tmp_name'] != '')
        {
            $attachment_id = media_handle_upload('file-upload', 1);
            $imageurl = wp_get_attachment_url($attachment_id);

            $wpdb->update(
                    $table_name,
                    array('name' => $name, 
                         'slug' =>  sanitize_title_with_dashes( $slug ),
                         'location' => $location,
                         'description' => $description,
                         'image' => $imageurl,
                         'parent_category_id' => $parent_category_id), 
                    array('id' => $id)
            );
        }
        else
        {
            $wpdb->update(
                    $table_name,
                    array('name' => $name,
                          'slug' =>  sanitize_title_with_dashes( $slug ),
                          'location' => $location,
                          'description' => $description,
                          'parent_category_id' => $parent_category_id
                          ),
                    array('id' => $id)
            );
        }
        
    }

//delete
    else if (isset($_POST['delete'])) {
        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %s", $id));
    } else {
        $products = $wpdb->get_results($wpdb->prepare("SELECT * from $table_name where id=%s", $id));
        foreach ($products as $product) {
            $name = $product->name;
            $location = $product->location;
            $description = $product->description;
            $image = $product->image;
            $parent_category_id = $product->parent_category_id;
        }
    }
   
    ?>

    <div class="wrap">
        <h2>Update Career</h2>

        <?php if (isset($_POST['delete'])) { ?>
            <div class="updated"><p>Career deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=career-list') ?>">&laquo; Back to Career list</a>

        <?php } else if (isset($_POST['update'])) { ?>
            <div class="updated"><p>Career updated</p></div>
            <a href="<?php echo admin_url('admin.php?page=career-list') ?>">&laquo; Back to Career list</a>

        <?php } else { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
                <table class='wp-list-table widefat fixed'>
                    
                    <tbody>
                    <tr>
                        <th>Business Units</th>
                            <td>
                                <select name="parent_category_id" class="form-control">
                                <?php
                                    global $wpdb;
                                    $parent_cat_table = $wpdb->prefix . "career_category";
                                    $results = $wpdb->get_results ("SELECT * FROM $parent_cat_table");
                                    foreach ($results as $result) { ?>
                                        <option value="<?php echo $result->id; ?>" <?php echo (($result->id== $parent_category_id)?"selected":"") ?> ><?php echo $result->business_units; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                    </tr>
                    <tr>
                        <th class="ss-th-width">Name</th>
                        <td><input type="text" name="name" value="<?php echo $name; ?>" class="form-control"/></td>
                    </tr>
                    
                    <tr>
                        <th class="ss-th-width">Location</th>
                        <td><input type="text" name="location" value="<?php echo $location; ?>"  class="form-control" /></td>
                    </tr>
                   
                     <tr>
                        <th>Description</th>
                        <td> <?php wp_editor( html_entity_decode(stripslashes($description)), 'description', array('description' => 'description')); ?></td>
                    </tr>
<?php
     /*                <tr>
                        <th>Image</th>
                        <td>
                            <input type="file" name="file-upload"  accept="image/*"  id="file-upload" /><br>
                            <span class="img">
                                  <?php if(isset($image)) echo "<img src='$image'/>" ; ?>
                             </span>
                        </td>
                    </tr>
*/ 
?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">
                                 <input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
                         <input type='submit' name="delete" value='Delete' class='button' onclick="return confirm('Are you sure you want to Delete?')">
                            </td>
                        </tr>
                        
                    </tfoot>
                </table>
               
            </form>
        <?php } ?>

    </div>
    <?php
}

