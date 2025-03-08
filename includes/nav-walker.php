<?php

class Custom_Nav_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '<ul aria-hidden="true" class="navigation__submenu">';
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '</ul>';
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        
        // Check if item has children
        $has_children = in_array('menu-item-has-children', $classes);
        
        // Add our custom classes
        $class_names = ' class="navigation__item';
        if ($has_children) {
            $class_names .= ' js-has-submenu';
        }
        
        $class_names .= '"';
        
        // Start the list item
        $output .= '<li' . $class_names . '>';
        
        // Add the link
        $output .= '<a href="' . esc_url($item->url) . '" class="navigation__link';
        
        // Special button class for cart
        if (strpos($item->title, 'Cart') !== false || strpos($item->url, 'cart') !== false) {
            $output .= ' button button--red';
        }
        
        $output .= '">';
        
        // For cart item, use the SVG icon
        if (strpos($item->title, 'Cart') !== false || strpos($item->url, 'cart') !== false) {
            $output .= '<svg aria-hidden="true" width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg" role="presentation">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M2 2.5V3.5H18V2.5H2ZM0 2.25V4.5V15.75C0 16.7165 0.783502 17.5 1.75 17.5H18.25C19.2165 17.5 20 16.7165 20 15.75V4.5V2.25C20 1.2835 19.2165 0.5 18.25 0.5H1.75C0.783502 0.5 0 1.2835 0 2.25ZM18 15.5V5.5H2V15.5H18ZM7.25 7.5C7.25 6.94772 6.80228 6.5 6.25 6.5C5.69772 6.5 5.25 6.94772 5.25 7.5C5.25 8.75978 5.75044 9.96796 6.64124 10.8588C7.53204 11.7496 8.74022 12.25 10 12.25C11.2598 12.25 12.468 11.7496 13.3588 10.8588C14.2496 9.96796 14.75 8.75978 14.75 7.5C14.75 6.94772 14.3023 6.5 13.75 6.5C13.1977 6.5 12.75 6.94772 12.75 7.5C12.75 8.22935 12.4603 8.92882 11.9445 9.44454C11.4288 9.96027 10.7293 10.25 10 10.25C9.27065 10.25 8.57118 9.96027 8.05546 9.44454C7.53973 8.92882 7.25 8.22935 7.25 7.5Z" fill="currentColor"/>
            </svg>';
            $output .= '<span class="sr-only">' . esc_html($item->title) . '</span>';
        } else {
            // Normal menu item
            $output .= esc_html($item->title);
            
            // Add screen reader only text for submenu items if needed
            if ($depth == 1) {
                $parent = get_post_meta($item->menu_item_parent, '_menu_item_object_id', true);
                if ($parent) {
                    $parent_title = get_the_title($parent);
                    $output .= '<span class="sr-only"> ' . esc_html(strtolower($parent_title)) . '</span>';
                }
            }
        }
        
        $output .= '</a>';
        
        // Add dropdown button for items with children
        if ($has_children) {
            $output .= '<button class="navigation__button js-button" aria-label="Submenu of ' . strtolower(esc_attr($item->title)) . '" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" role="presentation">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <polyline points="6 9 12 15 18 9" />
                </svg>
            </button>';
        }
    }

    function end_el(&$output, $item, $depth = 0, $args = array()) {
        $output .= '</li>';
    }
}