<div class="feature-product py-4">
    <div class="container">
        <div class="row align-items-center justify-content-center justify-content-sm-between mb-5 mb-sm-0">
            <div class="col-12 col-sm-auto text-center text-sm-left mb-2 mb-sm-0">
                <a href="<?php echo base_url() . 'category/p/' . remove_space($block['category_name']) . '/' . $block['block_cat_id']; ?>" class="text-black"><h3 class="category-headding fs-23"><?php echo html_escape($cat_pro[0]->category_name) ?></h3></a>
            </div>
            <div class="col-8 col-sm-5 col-md-4 col-lg-3">
                <?php echo form_open('web/Category/search_catproduct', array('method' => 'GET')) ?>
                <div class="input-group-overlay">
                    <div class="input-group-prepend-overlay">
                        <button class="input-group-text" type="submit"><i data-feather="search"></i></button>
                    </div>
                    <input class="form-control prepended-form-control appended-form-control" name="product_name" type="text" placeholder="<?php echo display('search') ?>...." />
                    <input type="hidden" name="category_id" value="<?php echo html_escape($block['block_cat_id']) ?>">
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
        <div class="headding-border position-relative mb-4 d-none d-sm-block"></div>
        
        <?php 
        // Check if this is Laptop Accessories category
        $is_laptop_accessories = (stripos($cat_pro[0]->category_name, 'Laptop Accessories') !== false || stripos($cat_pro[0]->category_name, 'Laptop Accessaries') !== false);
        ?>
        
        <?php if ($is_laptop_accessories) { ?>
            <!-- Horizontal Scrollable Layout for Laptop Accessories (Max 6 visible) -->
            <div class="position-relative">
                <div class="laptop-accessories-scroll" style="display: flex; overflow-x: auto; overflow-y: hidden; -webkit-overflow-scrolling: touch; scrollbar-width: thin; padding-bottom: 10px; gap: 15px;">
                <?php
                foreach ($cat_pro as $product) { 
                    $prodlink =  base_url('/product/' . remove_space($product->product_name) . '/' . $product->product_id);
                ?>
                    <div class="laptop-accessory-item" style="flex: 0 0 auto; min-width: calc((100% - 75px) / 6); max-width: calc((100% - 75px) / 6);">
                        <div class="feature-card card border-0 border h-100">
                            <div class="card-body">
                                <a href="<?php echo $prodlink; ?>" class="product-img d-block">
                                    <?php if (@getimagesize($product->image_thumb) === false) { ?>
                                        <img src="<?php echo base_url() . '/my-assets/image/no-image.jpg' ?>" class="media-object img-fluid" alt="image">
                                    <?php } else { ?>
                                        <img class="img-fluid" src="<?php echo base_url() . $product->image_thumb ?>" alt="image">
                                    <?php } ?>
                                </a>
                                <h3 class="product-name fs-15 font-weight-600 overflow-hidden mt-2">
                                    <a href="<?php echo $prodlink; ?>" class="text-black"><?php echo html_escape($product->product_name) ?></a>
                                </h3>
                                <div class="star-rating">
                                    <?php
                                    $result = $this->db->select('IFNULL(SUM(rate),0) as t_rates, count(rate) as t_reviewer')
                                        ->from('product_review')
                                        ->where('product_id', $product->product_id)
                                        ->where('status', 1)
                                        ->get()
                                        ->row();
                                    $p_review = (!empty($result->t_reviewer)?$result->t_rates / $result->t_reviewer:0);
                                    for($s=1; $s<=5; $s++){
                                        if($s <= floor($p_review)) {
                                            echo '<i class="fas fa-star"></i>';
                                        } else if($s == ceil($p_review)) {
                                            echo '<i class="fas fa-star-half-alt"></i>';
                                        }else{
                                            echo '<i class="far fa-star"></i>';
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="product-price font-weight-bolder font-italic">
                                    <?php
                                    if ($product->onsale == 1 && !empty($product->onsale_price)) {
                                        $price_val = $product->onsale_price * $target_con_rate;
                                    }else{
                                        $price_val = $product->price * $target_con_rate;
                                    }
                                    echo  (($position1 == 0) ? $currency1 . number_format($price_val, 2, '.', ',') : number_format($price_val, 2, '.', ',') . $currency1); ?> / <?php echo display('unit') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
            <style>
                /* Laptop Accessories Scrollable Container */
                .laptop-accessories-scroll {
                    scrollbar-width: thin;
                    scrollbar-color: #888 #f1f1f1;
                }
                .laptop-accessories-scroll::-webkit-scrollbar {
                    height: 8px;
                }
                .laptop-accessories-scroll::-webkit-scrollbar-track {
                    background: #f1f1f1;
                    border-radius: 10px;
                }
                .laptop-accessories-scroll::-webkit-scrollbar-thumb {
                    background: #888;
                    border-radius: 10px;
                }
                .laptop-accessories-scroll::-webkit-scrollbar-thumb:hover {
                    background: #555;
                }
                
                /* Responsive adjustments for different screen sizes */
                @media (max-width: 1200px) {
                    .laptop-accessory-item {
                        min-width: calc((100% - 60px) / 5) !important;
                        max-width: calc((100% - 60px) / 5) !important;
                    }
                }
                @media (max-width: 992px) {
                    .laptop-accessory-item {
                        min-width: calc((100% - 45px) / 4) !important;
                        max-width: calc((100% - 45px) / 4) !important;
                    }
                }
                @media (max-width: 768px) {
                    .laptop-accessory-item {
                        min-width: calc((100% - 30px) / 3) !important;
                        max-width: calc((100% - 30px) / 3) !important;
                    }
                }
                @media (max-width: 576px) {
                    .laptop-accessory-item {
                        min-width: calc((100% - 15px) / 2) !important;
                        max-width: calc((100% - 15px) / 2) !important;
                    }
                }
            </style>
        <?php } else { ?>
            <!-- Original Layout for Other Categories -->
        <div class="row">
            <?php
            $bpro=1;
             foreach ($cat_pro as $product) { 
                if($bpro < 12){
                ?>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3">
                <div class="feature-card card border-0 border">
                    <div class="card-body">
                        <?php $prodlink =  base_url('/product/' . remove_space($product->product_name) . '/' . $product->product_id) ?>
                        <a href="<?php echo $prodlink; ?>"  class="product-img d-block">
                            <?php if (@getimagesize($product->image_thumb) === false) { ?>
                                <img src="<?php echo base_url() . '/my-assets/image/no-image.jpg' ?>" class="media-object img-fluid"
                                     alt="image">
                            <?php } else { ?>
                                <img class="img-fluid" src="<?php echo base_url() . $product->image_thumb ?>" alt="image">
                            <?php } ?>
                        </a>
                        <h3 class="product-name fs-15 font-weight-600 overflow-hidden mt-2">
                            <a href="<?php echo $prodlink; ?>"  class="text-black"><?php echo html_escape($product->product_name) ?></a>
                        </h3>

                        <div class="star-rating">
                            <?php
                             $result = $this->db->select('IFNULL(SUM(rate),0) as t_rates, count(rate) as t_reviewer')
                             ->from('product_review')
                            ->where('product_id', $product->product_id)
                            ->where('status', 1)
                            ->get()
                            ->row();
                            $p_review = (!empty($result->t_reviewer)?$result->t_rates / $result->t_reviewer:0);
                            for($s=1; $s<=5; $s++){

                                if($s <= floor($p_review)) {
                                    echo '<i class="fas fa-star"></i>';
                                } else if($s == ceil($p_review)) {
                                    echo '<i class="fas fa-star-half-alt"></i>';
                                }else{
                                    echo '<i class="far fa-star"></i>';
                                }
                            }
                        ?>
                        </div>
                        <div class="product-price font-weight-bolder font-italic">
                        <?php

                        if ($product->onsale == 1 && !empty($product->onsale_price)) {
                            $price_val = $product->onsale_price * $target_con_rate;
                        }else{
                            $price_val = $product->price * $target_con_rate;
                        }

                        echo  (($position1 == 0) ? $currency1 . number_format($price_val, 2, '.', ',') : number_format($price_val, 2, '.', ',') . $currency1); ?> / <?php echo display('unit') ?> </div>
                    </div>
                </div>
            </div>
            <?php }else{ ?>
                <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3">
                    <div class="deals-item-inner deals-item-all bg-white overflow-hidden border position-absolute top-0 left-0 right-0 bottom-0 d-flex align-items-center text-center">
                        <div>
                            <h3 class="fs-18 mb-3"><?php echo count(@$cat_pro) ?> + <?php echo display('items') ?> <?php echo display('available') ?></h3>
                            <a href="<?php echo base_url() . 'category/p/' . remove_space($block['category_name']) . '/' . $block['block_cat_id']; ?>" class="btn btn-primary btn-sm text-white font-weight-500"><?php echo display('view_all') ?><i data-feather="arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            <?php break; }  ?>
            <?php $bpro++; } ?>
        </div>
        <?php } ?>
    </div>
</div>