<?php
$currency_new_id = $this->session->userdata('currency_new_id');
$target_con_rate = $position1 = $currency1 = 0;

if (empty($currency_new_id)) {
    $result = $cur_info = $this->db->select('*')
        ->from('currency_info')
        ->where('default_status', '1')
        ->get()
        ->row();
    $currency_new_id = $result->currency_id;
}


if (!empty($currency_new_id)) {
    $cur_info = $this->db->select('*')
        ->from('currency_info')
        ->where('currency_id', $currency_new_id)
        ->get()
        ->row();

    $target_con_rate = $cur_info->convertion_rate;
    $position1 = $cur_info->currency_position;
    $currency1 = $cur_info->currency_icon;
}

?>
<!--Topbar-->
<div class="topbar topbar-bg color5">
    <div class="container">
        <div class="topbar-text text-nowrap d-none d-md-flex align-items-center">
            <i data-feather="headphones" class="mr-2"></i>
            <span class="mr-1"><?php echo display('have_a_question') ?> <?php echo display('call_us') ?></span>
            <a class="topbar-link"
                href="tel:<?php echo html_escape($company_info[0]['mobile']) ?>"><?php echo html_escape($company_info[0]['mobile']) ?></a>
        </div>
        <div class="d-flex justify-content-between justify-content-md-end w-100">
            <?php
            if ($this->session->userdata('customer_name')) { ?>
            <div class="topbar-text dropdown disable-autohide">
                <a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                    <i data-feather="user" class="mr-2"></i>
                    <?php echo ucwords($this->session->userdata('customer_name')) ?> </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="dropdown-item">
                        <a
                            href="<?php echo base_url('customer/customer_dashboard') ?>"><?php echo display('dashboard') ?></a>
                    </li>
                    <li class="dropdown-item">
                        <a href="<?php echo base_url('logout') ?>"><?php echo display('logout') ?></a>
                    </li>
                </ul>
            </div>
            <?php } ?>

            <div class="topbar-text dropdown disable-autohide ml-3">
                <a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                    <?php
                    if (!empty($this->session->userdata('language'))) {
                        $language_id = $this->session->userdata('language');
                    } else {
                        $language_id = 'english';
                    }
                    ?>

                    <?php echo ucfirst($language_id); ?> / <?php

                                                            $currency_new_id = $this->session->userdata('currency_new_id');
                                                            if ($currency_info) {
                                                                foreach ($currency_info as $currency) {
                                                                    if (!empty($currency_new_id)) {
                                                                        if ($currency->currency_id == $currency_new_id) {
                                                                            echo html_escape($currency->currency_name);
                                                                        }
                                                                    } else {
                                                                        if ($currency->currency_id == $selected_cur_id) {
                                                                            echo html_escape($currency->currency_name);
                                                                        }
                                                                    }
                                                                }
                                                            }

                                                            ?></a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="dropdown-item">
                        <select id="change_currency" name="change_currency" class="custom-select custom-select-sm">

                            <?php

                            if ($currency_info) {
                                foreach ($currency_info as $currency) {
                            ?>
                            <option value="<?php echo $currency->currency_id ?>" <?php
                                                                                            if (!empty($currency_new_id)) {
                                                                                                if ($currency->currency_id == $currency_new_id) {
                                                                                                    echo "selected";
                                                                                                }
                                                                                            } else {
                                                                                                if ($currency->currency_id == $selected_cur_id) {
                                                                                                    echo "selected";
                                                                                                }
                                                                                            }
                                                                                            ?>>
                                <?php echo html_escape($currency->currency_name) ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </li>
                    <?php
                    if (!empty($languages)) {
                        foreach ($languages as $lkey => $lvalue) {
                    ?>
                    <li><a class="dropdown-item pb-1" id="change_language" href="#"
                            data-lang="<?php echo $lkey; ?>"><?php echo $lvalue; ?></a></li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--Navbar-->
<div class="navbar-sticky border-bottom">
    <div class="navbar navbar-expand-lg navbar-light color1">
        <div class="container">
            <a class="navbar-brand d-none d-sm-block mr-3 flex-shrink-0" href="<?php echo base_url() ?>">
                <img width="220" src="<?php if (isset($Web_settings[0]['logo'])) {
                                            echo base_url() . $Web_settings[0]['logo'];
                                        } ?>" alt="Cartzilla" />
            </a>
            <a class="navbar-brand d-sm-none mr-2" href="<?php echo base_url() ?>">
                <img width="100" src="<?php if (isset($Web_settings[0]['logo'])) {
                                            echo base_url() . $Web_settings[0]['logo'];
                                        } ?>" alt="" />
            </a>
            <!-- Search-->
            <div class="main-search input-group-overlay d-none d-lg-block flex-grow-1 mx-1 ui-widget" style="max-width: none;">
                <?php echo form_open('category_product_search', array('method' => 'GET')) ?>
                <div>
                    <div class="input-group-prepend-overlay">
                        <span class="input-group-text"><i data-feather="search"></i></span>
                    </div>
                    <input class="form-control search-input prepended-form-control appended-form-control"
                        name="product_name" id="search_product_item" type="text" placeholder="Search for products" />
                    <div class="input-group-append-overlay">
                        <button type="submit" class="btn btn-warning search_btn color4 color46 text-white"><span class="lnr
                        lnr-magnifier"></span><?php echo display('search'); ?>
                        </button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>


            <!-- Toolbar-->
            <div class="navbar-toolbar d-flex flex-shrink-0 align-items-center ml-1">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
                    <i data-feather="menu"></i>
                </button>
                <a class="navbar-tool navbar-stuck-toggler" href="#">
                    <span class="navbar-tool-tooltip">Expand menu</span>
                    <div class="navbar-tool-icon-box"><i data-feather="grid" class="navbar-tool-icon"></i></div>
                </a>
            </div>
        </div>
    </div>
    <div class="navbar navbar-expand-lg navbar-light navbar-stuck-menu py-0 color3">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <!--Navbar collapse header-->
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-8 collapse-brand">
                            <a href="<?php echo base_url(); ?>">
                                <?php if (isset($Web_settings[0]['logo'])) { ?>
                                <img src="<?php echo base_url() . $Web_settings[0]['logo']; ?>" alt="Logo"><?php } ?>
                            </a>
                        </div>
                        <div class="col-4 text-right">
                            <button type="button" class="collapse-close"><span></span><span></span></button>
                        </div>
                    </div>
                </div>
                <!-- Search-->
                <div class="input-group-overlay d-lg-none my-3">
                    <?php echo form_open('category_product_search', array('method' => 'GET')) ?>
                    <div class="input-group-prepend-overlay">
                        <span class="input-group-text"><i data-feather="search"></i></span>
                    </div>
                    <input class="form-control prepended-form-control" name="product_name" id="mobile_product_name"
                        type="text" placeholder="Search for products" />
                    <?php echo form_close() ?>
                </div>
                <!-- Departments menu-->
                <ul class="navbar-nav mega-nav departments-nav pr-lg-2 mr-lg-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle pl-0" href="#" data-toggle="dropdown"> <i data-feather="grid"
                                class="mr-2"></i><?php echo display('all_categories'); ?> </a>
                        <ul class="dropdown-menu">
                            <?php
                            if ($category_list) {
                                $i = 1;
                                $language = $Soft_settings[0]['language'];
                                foreach ($category_list as $parent_category) {
                                    if ($_SESSION["language"] != $language) {
                                        $sub_parent_cat = $this->db->select('*,IF(c.trans_name IS NULL OR c.trans_name = "",a.category_name,c.trans_name) as category_name')
                                            ->from('product_category a')
                                            ->where('a.parent_category_id', $parent_category->category_id)
                                            ->where('status', '1')
                                            ->join('category_translation c', 'a.category_id = c.category_id', 'left')
                                            ->order_by('menu_pos')
                                            ->get()
                                            ->result();
                                    } else {
                                        $sub_parent_cat = $this->db->select('*')
                                            ->from('product_category')
                                            ->where('parent_category_id', $parent_category->category_id)
                                            ->where('status', '1')
                                            ->order_by('menu_pos')
                                            ->get()
                                            ->result();
                                    }
                                    if (10 == $i) {
                                        break;
                                    }
                            ?>
                            <li class="dropdown mega-dropdown">
                                <a class="dropdown-item  d-flex align-items-center"
                                    href="<?php echo base_url('category/p/' . remove_space($parent_category->category_name) . '/' . $parent_category->category_id) ?>">
                                    <span class=""><img src="<?php echo base_url() . $parent_category->cat_favicon ?>"
                                            height="15" width="16">&nbsp; </span>
                                    <div> <?php echo html_escape($parent_category->category_name) ?></div>
                                </a>
                                <?php if ($sub_parent_cat) { 
                                    // Check if this is Accessories category for horizontal layout
                                    $is_accessories = (stripos($parent_category->category_name, 'Accessories') !== false || stripos($parent_category->category_name, 'Accessaries') !== false);
                                    // Check if this is Networking Devices or Computing Devices for vertical layout
                                    $is_networking = (stripos($parent_category->category_name, 'Networking Devices') !== false);
                                    $is_computing = (stripos($parent_category->category_name, 'Computing Devices') !== false);
                                    
                                    if ($is_accessories) { ?>
                                    <!-- Horizontal Scrollable Layout for Accessories -->
                                <div class="dropdown-menu p-2" style="min-width: 700px; max-width: 90vw;">
                                    <div class="mega-menu-scroll" style="max-height: 380px; overflow-y: hidden; overflow-x: auto; -webkit-overflow-scrolling: touch; padding-bottom: 12px;">
                                        <div class="d-flex flex-nowrap" style="gap: 15px;">
                                        <?php
                                                    $counter = 0;
                                                    $total_cats = count($sub_parent_cat);
                                                    $column_open = false;
                                                    foreach ($sub_parent_cat as $parent_cat) { 
                                                        // All columns have 4 items each
                                                        if ($counter % 4 == 0) {
                                                            echo '<div style="flex: 0 0 auto; min-width: 210px; max-width: 250px; background: #ffffff; padding: 12px;">';
                                                            $column_open = true;
                                                        }
                                        ?>
                                        <div class="widget widget-links mb-2" style="padding-bottom: 8px; border-bottom: 1px solid #ffffff;">
                                            <h6 class="mb-1 font-weight-bold text-dark" style="font-size: 14px; line-height: 1.5; word-wrap: break-word; white-space: normal; font-weight: 700;"><a
                                                    href="<?php echo base_url('category/p/' . remove_space($parent_cat->category_name) . '/' . $parent_cat->category_id) ?>" class="text-dark" style="text-decoration: none; display: block; font-weight: 700;"><?php echo html_escape($parent_cat->category_name) ?></a>
                                            </h6>
                                            <ul class="widget-list" style="font-size: 12px; list-style: none; padding-left: 0; margin-bottom: 0;">
                                                <?php
                                                                if ($_SESSION["language"] != $language) {
                                                                    $sub_cat = $this->db->select('a.*,IF(c.trans_name IS NULL OR c.trans_name = "",a.category_name,c.trans_name) as category_name')
                                                                        ->from('product_category a')
                                                                        ->where('a.parent_category_id', $parent_cat->category_id)
                                                                        ->where('a.status', '1')
                                                                        ->join('category_translation c', 'a.category_id = c.category_id', 'left')
                                                                        ->order_by('a.menu_pos')
                                                                        ->limit(6)
                                                                        ->get()
                                                                        ->result();
                                                                } else {
                                                                    $sub_cat = $this->db->select('*')
                                                                        ->from('product_category')
                                                                        ->where('parent_category_id', $parent_cat->category_id)
                                                                        ->where('status', '1')
                                                                        ->order_by('menu_pos')
                                                                        ->limit(6)
                                                                        ->get()
                                                                        ->result();
                                                                }
                                                                if ($sub_cat) {
                                                                    foreach ($sub_cat as $s_p_cat) {
                                                                ?>

                                                <li style="padding: 3px 0;"><a class="widget-list-link text-dark" style="text-decoration: none;"
                                                        onmouseover="this.style.color='#007bff';"
                                                        onmouseout="this.style.color='#000';"
                                                        href="<?php echo base_url('category/p/' . remove_space($s_p_cat->category_name) . '/' . $s_p_cat->category_id) ?>"><?php echo html_escape($s_p_cat->category_name) ?></a>
                                                </li>
                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                </ul>
                                        </div>
                                        <?php 
                                                        $counter++;
                                                        // Close column after every 4 items
                                                        if ($counter % 4 == 0 || $counter == $total_cats) {
                                                            if ($column_open) {
                                                                echo '</div>';
                                                                $column_open = false;
                                                            }
                                                        }
                                                    } ?>
                                        </div>
                                    </div>
                                    <style>
                                        .mega-menu-scroll::-webkit-scrollbar {
                                            height: 8px;
                                        }
                                        .mega-menu-scroll::-webkit-scrollbar-track {
                                            background: #f1f1f1;
                                        }
                                        .mega-menu-scroll::-webkit-scrollbar-thumb {
                                            background: #888;
                                            border-radius: 4px;
                                        }
                                        .mega-menu-scroll::-webkit-scrollbar-thumb:hover {
                                            background: #555;
                                        }
                                    </style>
                                    </div>                                <?php } elseif ($is_networking) { ?>
                                    <!-- Vertical Layout for Networking Devices - 2 per column -->
                                    <div class="dropdown-menu p-2">
                                        <div class="d-flex flex-wrap" style="gap: 0;">
                                            <?php
                                            $counter = 0;
                                            $total_cats = count($sub_parent_cat);
                                            foreach ($sub_parent_cat as $parent_cat) {
                                                if ($counter % 2 == 0) {
                                                    echo '<div style="flex: 0 0 auto; min-width: 210px; max-width: 250px; padding: 12px;">';
                                                }
                                            ?>
                                            <div class="widget widget-links mb-2" style="padding-bottom: 8px; border-bottom: 1px solid #ffffff;">
                                                <h6 class="font-weight-bold mb-1 text-dark" style="font-size: 14px; line-height: 1.4; word-wrap: break-word; white-space: normal; font-weight: 700;"><a
                                                        href="<?php echo base_url('category/p/' . remove_space($parent_cat->category_name) . '/' . $parent_cat->category_id) ?>" class="text-dark" style="text-decoration: none; display: block; font-weight: 700;"><?php echo html_escape($parent_cat->category_name) ?></a>
                                                </h6>
                                                <ul class="widget-list" style="font-size: 12px; list-style: none; padding-left: 0; margin-bottom: 0;">
                                                    <?php
                                                    if ($_SESSION["language"] != $language) {
                                                        $sub_cat = $this->db->select('a.*,IF(c.trans_name IS NULL OR c.trans_name = "",a.category_name,c.trans_name) as category_name')
                                                            ->from('product_category a')
                                                            ->where('a.parent_category_id', $parent_cat->category_id)
                                                            ->where('a.status', '1')
                                                            ->join('category_translation c', 'a.category_id = c.category_id', 'left')
                                                            ->order_by('a.menu_pos')
                                                            ->limit(6)
                                                            ->get()
                                                            ->result();
                                                    } else {
                                                        $sub_cat = $this->db->select('*')
                                                            ->from('product_category')
                                                            ->where('parent_category_id', $parent_cat->category_id)
                                                            ->where('status', '1')
                                                            ->order_by('menu_pos')
                                                            ->limit(6)
                                                            ->get()
                                                            ->result();
                                                    }
                                                    if ($sub_cat) {
                                                        foreach ($sub_cat as $s_p_cat) {
                                                    ?>

                                                    <li style="padding: 2px 0;"><a class="widget-list-link text-dark" style="text-decoration: none;"
                                                            onmouseover="this.style.color='#007bff';"
                                                            onmouseout="this.style.color='#000';"
                                                            href="<?php echo base_url('category/p/' . remove_space($s_p_cat->category_name) . '/' . $s_p_cat->category_id) ?>"><?php echo html_escape($s_p_cat->category_name) ?></a>
                                                    </li>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                            <?php
                                                $counter++;
                                                if ($counter % 2 == 0 || $counter == count($sub_parent_cat)) {
                                                    echo '</div>';
                                                }
                                            } ?>
                                        </div>
                                    </div>                                <?php } else { ?>
                                    <!-- Horizontal Layout for Other Categories - 2 per column -->
                                    <div class="dropdown-menu p-2" style="min-width: 600px; max-width: 90vw;">
                                        <div class="mega-menu-scroll" style="max-height: 380px; overflow-y: hidden; overflow-x: auto; -webkit-overflow-scrolling: touch;">
                                            <div class="d-flex flex-nowrap" style="gap: 0;">
                                            <?php
                                            $counter = 0;
                                            $total_cats = count($sub_parent_cat);
                                            $column_open = false;
                                            foreach ($sub_parent_cat as $parent_cat) {
                                                if ($counter % 2 == 0) {
                                                    echo '<div style="flex: 0 0 auto; min-width: 210px; max-width: 250px; padding: 12px;">';
                                                    $column_open = true;
                                                }
                                            ?>
                                            <div class="widget widget-links mb-2" style="padding-bottom: 8px; border-bottom: 1px solid #ffffff;">
                                                <h6 class="font-weight-bold mb-1 text-dark" style="font-size: 14px; line-height: 1.4; word-wrap: break-word; white-space: normal; font-weight: 700;"><a
                                                        href="<?php echo base_url('category/p/' . remove_space($parent_cat->category_name) . '/' . $parent_cat->category_id) ?>" class="text-dark" style="text-decoration: none; display: block; font-weight: 700;"><?php echo html_escape($parent_cat->category_name) ?></a>
                                                </h6>
                                                <ul class="widget-list" style="font-size: 12px; list-style: none; padding-left: 0; margin-bottom: 0;">
                                                    <?php
                                                    if ($_SESSION["language"] != $language) {
                                                        $sub_cat = $this->db->select('a.*,IF(c.trans_name IS NULL OR c.trans_name = "",a.category_name,c.trans_name) as category_name')
                                                            ->from('product_category a')
                                                            ->where('a.parent_category_id', $parent_cat->category_id)
                                                            ->where('a.status', '1')
                                                            ->join('category_translation c', 'a.category_id = c.category_id', 'left')
                                                            ->order_by('a.menu_pos')
                                                            ->limit(6)
                                                            ->get()
                                                            ->result();
                                                    } else {
                                                        $sub_cat = $this->db->select('*')
                                                            ->from('product_category')
                                                            ->where('parent_category_id', $parent_cat->category_id)
                                                            ->where('status', '1')
                                                            ->order_by('menu_pos')
                                                            ->limit(6)
                                                            ->get()
                                                            ->result();
                                                    }
                                                    if ($sub_cat) {
                                                        foreach ($sub_cat as $s_p_cat) {
                                                    ?>

                                                    <li style="padding: 2px 0;"><a class="widget-list-link text-dark" style="text-decoration: none;"
                                                            onmouseover="this.style.color='#007bff';"
                                                            onmouseout="this.style.color='#000';"
                                                            href="<?php echo base_url('category/p/' . remove_space($s_p_cat->category_name) . '/' . $s_p_cat->category_id) ?>"><?php echo html_escape($s_p_cat->category_name) ?></a>
                                                    </li>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                            <?php
                                                $counter++;
                                                if ($counter % 2 == 0 || $counter == count($sub_parent_cat)) {
                                                    if ($column_open) {
                                                        echo '</div>';
                                                        $column_open = false;
                                                    }
                                                }
                                            } ?>
                                            </div>
                                        </div>
                                        <style>
                                            .mega-menu-scroll::-webkit-scrollbar {
                                                height: 0px;
                                                display: none;
                                            }
                                            .mega-menu-scroll {
                                                scrollbar-width: none;
                                            }
                                        </style>
                                    </div>
                                <?php } 
                                } ?>
                            </li>
                            <?php
                                    $i++;
                                }
                            }
                            ?>

                        </ul>
                    </li>
                </ul>
                <!-- Primary menu-->
                <ul class="navbar-nav">
                    <li class="nav-item <?php echo (($this->uri->segment(1) == '') ? 'active' : '') ?>">
                        <a class="nav-link" href="<?php echo base_url(); ?>"><?php echo display('home') ?> <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <?php
                    if (!empty($category_list)) {
                        foreach ($category_list as $v_category_list) {
                            if ($v_category_list->top_menu == 1) { ?>
                    <li
                        class="nav-item <?php echo (($this->uri->segment(4) == $v_category_list->category_id) ? 'active' : '') ?>">
                        <a class="nav-link"
                            href="<?php echo base_url('/category/p/' . remove_space($v_category_list->category_name) . '/' . $v_category_list->category_id) ?>"><?php echo
                                                                                                                                                                                        html_escape($v_category_list->category_name);
                                                                                                                                                                                        ?></a>
                    </li>
                    <?php }
                        }
                    } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal register-modal" id="trackingModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="modal-body">
                <button type="button" class="close position-absolute" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="form-title_wrap mb-3">
                    <h4 class="form-title mb-0"><?php echo display('track_my_order') ?></h4>
                </div>
                <!--Login Form-->
                <?php echo form_open('track_my_order'); ?>
                <div class="form-group">
                    <input type="email" class="form-control" name="order_email"
                        placeholder="<?php echo display('email') ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="order_number"
                        placeholder="<?php echo display('order_no') ?>" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block"><?php echo display('track_my_order') ?></button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
