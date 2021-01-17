<?php

$html = "";
$unique_id = rand(0, 100000);
$holder_id = 'map_canvas_' . $unique_id;
$map_pin = "";

if ($pin != "") {
    $map_pin = wp_get_attachment_image_src($pin, 'full', true);
    $map_pin = $map_pin[0];
} else {
    $map_pin = get_template_directory_uri() . "/img/pin.png";
}


$data_attribute = '';
if ($address1 != "" || $address2 != "" || $address3 != "" || $address4 != "" || $address5 != "") {
    $data_attribute .= "data-addresses='[\"";
    $addresses_array = array();
    if ($address1 != "") {
        array_push($addresses_array, esc_attr($address1));
    }
    if ($address2 != "") {
        array_push($addresses_array, esc_attr($address2));
    }
    if ($address3 != "") {
        array_push($addresses_array, esc_attr($address3));
    }
    if ($address4 != "") {
        array_push($addresses_array, esc_attr($address4));
    }
    if ($address5 != "") {
        array_push($addresses_array, esc_attr($address5));
    }
    $data_attribute .= implode('","', $addresses_array);
    $data_attribute .="\"]'";
}

$data_attribute .= " data-custom-map-style='" . $custom_map_style . "'";
$data_attribute .= " data-color-overlay='" . $color_overlay . "'";
$data_attribute .= " data-saturation='" . $saturation . "'";
$data_attribute .= " data-lightness='" . $lightness . "'";
$data_attribute .= " data-zoom='" . $zoom . "'";
$data_attribute .= " data-pin='" . $map_pin . "'";
$data_attribute .= " data-unique-id='" . $unique_id . "'";
$data_attribute .= " data-google-maps-scroll-wheel='" . $google_maps_scroll_wheel . "'";
$data_attribute .= " data-snazzy-map-style='" . $snazzy_map_style . "'";

if ($map_height != "") {
    $data_attribute .= " data-map-height='" . $map_height . "'";
}

if(is_numeric($map_height)){
    $html .= "<div class='google_map_shortcode_holder' style='height:" . $map_height . "px;'><div class='qode_google_map' style='height:" . $map_height . "px;' id='" . $holder_id . "' " . $data_attribute . "></div>";
} else {
    $html .= "<div class='google_map_shortcode_holder' style='height:" . $map_height . "'><div class='qode_google_map' style='height:" . $map_height . "' id='" . $holder_id . "' " . $data_attribute . "></div>";
}

if($snazzy_map_style == 'yes'){
    //alternate snazzy map code due to Elementor's different code formation
    if( isset( $is_elementor ) && $is_elementor ){
        $snazzy_map_code = str_replace( array("[", "]", '"'), array("`{`", "`}`", '``'), $snazzy_map_code );
    }

    $html .= '<input type="hidden" class="qode-snazzy-map" value="' . str_replace( '<br />', '', $snazzy_map_code ) . ' " />';
}

if ($google_maps_scroll_wheel == "false") {
    $html .= "<div class='google_map_shortcode_overlay'></div>";
}
$html .= "</div>";
echo bridge_qode_get_module_part( $html );