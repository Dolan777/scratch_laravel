@extends('admin.layouts.main')
@section('content')
<style>
    .box-body li{list-style: none;}
</style>

<!-- END PAGE HEAD-->
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Settings</span>
    </li>
</ul>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">Settings</span>
            <!--<span class="caption-helper">form actions without bg color</span>-->
        </div>

    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->

        <div class="form-body">
            <div class="tabbable-custom ">
                <ul class="nav nav-tabs ">

                    <?php
                    $selected_tab = $tab;
                    foreach (array_keys($modules) as $index => $module_name) {
                        $class = ($selected_tab == $index) ? 'active' : '';
                        ?>
                        <li class="<?php echo $class; ?>">
                            <a href="#tab_s_<?php echo $index; ?>" data-toggle="tab"><?php echo $module_name ?></a>
                        </li>
                    <?php } ?>

                </ul>
                <div class="tab-content">
                    <?php
                    $count = 0;
                    foreach ($modules as $module_name => $module) {
                        $class = ($selected_tab == $count) ? 'active' : '';
                        ?>
                        <div class="tab-pane <?php echo $class; ?>" id="tab_s_<?php echo $count; ?>">
                            <form method="post" action="{{Route('settings')}}" id="save_<?php echo $module_name ?>" >
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <?php
                                    $html = '';
                                    //'text','textarea','password','select','select-multiple','radio','checkbox'
                                    foreach ($module as $settings) {
                                        $html .= "<div class=\"form-group\" id=\"$settings->slug\">";
                                        $html .= '<label for="' . $settings->slug . '">' . $settings->title . '</label>';
                                        if (isset($_GET['debug'])) {
                                            $show_slug = '<br/><span class="show_slug"><input type="text" value="Settings::get(\'' . $settings->slug . '\')"/></span>&nbsp;&nbsp;&nbsp;<a href="' . base_url("settings/edit/$settings->slug") . '">Edit</a>';
                                        } else {
                                            $show_slug = '';
                                        }


                                        switch ($settings->type) {
                                            case 'text':
                                                $html .="<div class=\"input type-{$settings->type}\">";
                                                $html .= "<input type=\"text\" class=\"form-control\" id=\"{$settings->slug}\" name=\"settings[{$settings->slug}]\" value=\"{$settings->value}\">";
                                                $html .=$show_slug;
                                                $html .="</div>";
                                                break;
                                            case 'textarea':
                                                $html .="<div class=\"input type-{$settings->type}\">";
                                                // $html .= "<div class = \"widgetbox inlineblock\">";
                                                // $html .= "<h3><span>Editor</span></h3>";
                                                //  $html .= "<div class = \"content nopadding\">";
                                                $html .= "<textarea rows = \"3\" class='form-control'  name = \"settings[{$settings->slug}]\" id = \"{$settings->slug}\">{$settings->value}</textarea>";
                                                $html .=$show_slug;
                                                $html .="</div>";
                                                break;
                                            case 'password':
                                                $html .="<div class=\"input type-{$settings->type}\">";
                                                $html .= "<input type=\"password\" class=\"form-control\" id=\"{$settings->slug}\" name=\"settings[{$settings->slug}]\" value=\"{$settings->value}\">";
                                                $html .=$show_slug;
                                                $html .="</div>";
                                                break;
                                            case 'select':
                                                $html .="<div class=\"input type-{$settings->type}\">";
                                                // $html .= form_dropdown($settings->slug, $settings->options, $settings->value, "id=\"{$settings->slug}\" class=\"sf chzn-select\"");
                                                $html .=$show_slug;
                                                $html .="</div>";
                                                break;
                                            case 'select-multiple':
                                                $html .="<div class=\"input type-{$settings->type}\">";
                                                // $html .= form_dropdown($settings->slug, $settings->options, $settings->value, "id=\"{$settings->slug}\" class=\"sf chzn-select\" multiple=\"multiple\"");
                                                $html .=$show_slug;
                                                $html .="</div>";
                                                break;
                                            case 'radio':
                                                $options = explode('|', $settings->options);
                                                $html .="<div class=\"input type-{$settings->type}\">";
                                                foreach ($options as $row) {
                                                    $row_data = explode('=', $row);
                                                    $k2 = $row_data[0];
                                                    $v2 = $row_data[1];
                                                    $checked = $k2 == $settings->value ? "checked=checked\"" : "";
                                                    $html .="<label class=\"inline\">";
                                                    $html .="<input type=\"radio\" name=\"settings[$settings->slug]\" value=\"{$k2}\" {$checked}>&nbsp;{$v2}";
                                                    $html .="</label>";
                                                }
                                                $html .=$show_slug;
                                                $html .="</div>";
                                                break;
                                            case 'checkbox':
                                                $html .="<div class=\"input type-{$settings->type}\">";
                                                $data_arr = explode('|', $settings->options);
                                                foreach ($data_arr as $row) {
                                                    $option = explode('=', $row);
                                                    $k2 = $option[0];
                                                    $v2 = $option[1];
                                                    $n3 = $option[2];
                                                    $checked = ($v2 == $settings->value) ? "checked=\checked\"" : "";
                                                    $html .="<label class=\"inline\">";
//                                                                $html .="<input style='display:none;' type=\"checkbox\" checked name=\"settings[$settings->slug][]\" value=\"0\">";
                                                    $html .="<input type=\"checkbox\" name=\"settings[$settings->slug][]\" value=\"{$v2}\" {$checked}>&nbsp;{$n3}";
                                                    $html .="</label>";
                                                }
                                                $html .=$show_slug;
                                                $html .="</div>";
                                                break;
                                            default : $html .="<div class=\"input type-{$settings->type}\">";
                                                $html .="<label class=\"inline\">";
                                                $html .="$settings->value";
                                                $html .="</label>";
                                                $html .=$show_slug;
                                                $html .="</div>";
                                        }
                                        $html .='</div>';
                                    }
                                    echo $html;
                                    ?>
                                    <input type="hidden" value="<?php echo $module_name ?>" name="save_module_settings"/>
                                    <input type="hidden" value="<?php echo $count; ?>" name="tab"/>
                                    <?php
                                    if ($module_name !== 'System') {
                                        ?>

                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn green">Submit</button>
                                                    <a href="{{Route('admin-dashboard')}}" class="btn default">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </form>
                        </div>
                        <?php
                        $count++;
                    }
                    ?>                
                </div>
            </div>
        </div>
       

        <!-- END FORM-->
    </div>
</div>



@endsection

@section('page_js')
<script>
    $(document).ready(function () {
        var current_tab = $('.nav-tabs').find('.active').find('a').text();

        if ($(".breadcrumb").find('li').length == 3) {
            $(".breadcrumb").find('li').last().text(current_tab);
        } else {
            $(".breadcrumb").append('<li>' + current_tab + '</li>');
        }



        $('[data-toggle="tab"]').click(function () {
            setTimeout(function () {

                var current_tab = $('.nav-tabs').find('.active').find('a').text();

                if ($(".breadcrumb").find('li').length == 3) {
                    $(".breadcrumb").find('li').last().text(current_tab);
                } else {
                    $(".breadcrumb").append('<li>' + current_tab + '</li>');
                }

            }, 500);


        });
    });

</script>

@endsection