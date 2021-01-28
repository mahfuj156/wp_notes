<?php

function career_list() {
    ?>


    <div class="wrap padd">
        <h2>Career List</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a style="float:left" href="<?php echo admin_url('admin.php?page=career-create'); ?>" class="button">Add New</a>
                               
                <br>
            </div>
            <br class="clear">
        </div>





        <?php
            global $wpdb;
            $table_name = $wpdb->prefix . "career";
            $rows = $wpdb->get_results("SELECT * from $table_name");
        ?>
        <table class='wp-list-table widefat fixed striped posts'>
            <tr>
                <th class="manage-column ss-list-width">ID</th>
                <th class="manage-column ss-list-width">Business Units</th>
                <th class="manage-column ss-list-width">Name</th>
                <th class="manage-column ss-list-width">Date</th>               
               <!-- <th class="manage-column ss-list-width">description</th> -->
                <th class="manage-column ss-list-width">Action</th>
                
            </tr>
            <?php
            $i=1;
            foreach ($rows as $row) { ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo $i; ?></td>
                    <td class="manage-column ss-list-width"><?php  
                    $get_units = $row->parent_category_id;
                    global $wpdb;
                    $get_business_name = $wpdb->prefix."career_category";
                    $get_val = $wpdb->get_row("SELECT business_units from $get_business_name WHERE id=$get_units");
                    print_r($get_val->business_units);
                     ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->name; ?></td>
                     <td class="manage-column ss-list-width"><?php echo $row->location; ?></td>
                  <!--   <td class="manage-column ss-list-width"><?php echo substr($row->description, 0,20) . '...'; ?></td> -->
                     
                    <td  class="manage-column ss-list-width"><a href="<?php echo admin_url('admin.php?page=career-update&id=' . $row->id); ?>" class="button">Update</a>
                </tr>
            <?php $i++; } ?>
        </table>
    </div>
    <?php
}
?>
