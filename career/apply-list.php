<?php
function apply_list() {
    ?>
	 
    <div class="wrap padd">
        <h2>Career Applied Candidates List</h2>
        <div class="tablenav top">
            <br class="clear">
        </div>
        <?php
            global $wpdb;
             $table_name = $wpdb->prefix . "career_contact";
            $rows = $wpdb->get_results("SELECT * from $table_name");
        ?>

        <table class='wp-list-table widefat fixed striped posts' id="example_datatable">
		<thead>
            <tr>
                <th class="manage-column ss-list-width">ID</th>
                 
                <th class="manage-column ss-list-width">FirstName</th>
                <th class="manage-column ss-list-width">LastName</th>
                <th class="manage-column ss-list-width">Email</th>
                <th class="manage-column ss-list-width">Date</th>
                <th class="manage-column ss-list-width">CoverLetter</th>
                <th class="manage-column ss-list-width">Resume</th>
                
               
                
            </tr>
			</thead>
			<tbody>
            <?php
            $i=1;
            $upload_dir = wp_upload_dir();
            $target_dir = $upload_dir['baseurl'].'/'.'resumeimages/';
            $resumeimages = $upload_dir['baseurl'].'/'.'resumeimages/';
            foreach ($rows as $row) { ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo $i; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->firstname; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->lastname; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->email; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->created_at; ?></td>

                    <td class="manage-column ss-list-width"><a target="_blank" href="<?php echo $target_dir. $row->coverletter; ?>">View</a></td>
                    <td class="manage-column ss-list-width"><a target="_blank" href="<?php echo $resumeimages. $row->resume; ?>">View</a></td>
                    </td>
                </tr>
            <?php $i++; } ?>
			</tbody>
        </table>
    </div>
	 
	
    <?php
}
