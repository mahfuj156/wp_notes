
        <?php 
        
        /*
        Note: 
        1. Custom post type query
        2. Custom post type query by category name
        3. get post thumbail url
        5. ACF custom field print
        */
             
         $args=array(
    'posts_per_page' => 50, 
    'post_type' => 'manage_list',
    'managemen_cat' => "Special advisor", //multiple category seperate by comma
);
$special_advisors = new WP_Query( $args ); 
                ?>

                <div class="row">

                    <div class="col-md-6 ceo-column">
                        <div class="ms-special-heading">
                            <h4 style="text-align: left;">Special advisor</h4>
                        </div>

                        <?php
                      
                    if ( $special_advisors->have_posts() ):
                       while($special_advisors -> have_posts()) : $special_advisors -> the_post();
                      
                            $mgmtid1 = get_the_ID().'_'.slugify(get_the_title());
                            $positon = get_field('position'); 
                            $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
                            ?>

                            <div class="team-item ">
                                <a data-toggle="modal" data-target="#<?php echo $mgmtid1; ?>"><p></p>
                                    <div class="team-image taizo">
                                        <p>
                                            <img class="alignnone size-full wp-image-1950"  src="<?php   echo $featured_img_url ; ?>" alt="" width="160" height="200">
                                        </p>
                                        <div class="team-content">
                                            <h5>Read More</h5>
                                        </div>
                                    </div>
                                </a>
                                <p><a data-toggle="modal" data-target="#<?php echo $mgmtid1; ?>"></a></p>
                            </div>
                            <div class="info-section ceo-item">
                            <h4><?php the_title(); ?></h4>
                            <h6><?php  echo $positon; ?></h6>
                            </div>
                        </div>

                        <div class="modal fade" id="<?php echo $mgmtid1; ?>" >
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header" style="display: inline-block;">
                                        <button type="button" class="close" data-dismiss="modal"  data-closed="<?php echo $mgmtid1; ?>">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="member-thumb">
                                            <img class="alignnone size-full wp-image-1950" src="<?php echo $featured_img_url; ?>" alt="" width="160" height="200">
                                        </div>
                                        <div class="member-info">
                                            <h5 class="col-xs-12 member-name"><?php the_title(); ?></h5>
                                            <p><span class="col-xs-12 member-position"><?php  echo $positon; ?></span></p>
                                           <?php  echo stripslashes(get_the_content()); ?> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php 
                    endwhile;
                    endif;
                    wp_reset_query() ;  ?>
                </div>
