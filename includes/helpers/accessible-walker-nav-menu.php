<?php
/**
 * Custom Walker class for creating accessible navigation menus
 */
class Accessible_Walker_Nav_Menu extends Walker_Nav_Menu {
    /**
     * Starts the element output.
     */
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        
        // Check if item has children
        $has_children = in_array( 'menu-item-has-children', $classes );
        
        // Create unique ID for Alpine component
        $menu_id = 'menu-item-' . $item->ID;
        
        // Add Alpine data attributes if has children
        $alpine_data = $has_children ? ' x-data="{ open: false }" @keydown.escape="open = false"' : '';
        
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        
        // ID for the menu item
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
        
        $output .= $indent . '<li' . $id . $class_names . $alpine_data . '>';
        
        // Link attributes
        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target ) ? $item->target : '';
        $atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
        $atts['href']   = ! empty( $item->url ) ? $item->url : '';
        
        // Add aria-current for current menu item
        if ( in_array( 'current-menu-item', $classes ) || in_array( 'current_page_item', $classes ) ) {
            $atts['aria-current'] = 'page';
        }
        
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
        
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        // Link output
        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
        
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        
        // Add toggle button for submenus
        if ( $has_children ) {
            $expanded_text = sprintf( __( 'Toggle submenu for %s', 'minimal-theme' ), $title );
            $item_output .= '<button class="submenu-toggle ml-1" @click="open = !open" :aria-expanded="open ? \'true\' : \'false\'" aria-haspopup="true" aria-label="' . esc_attr( $expanded_text ) . '">';
            $item_output .= '<span class="screen-reader-text">' . esc_html__( 'Expand', 'minimal-theme' ) . '</span>';
            $item_output .= '<svg class="w-4 h-4" :class="{ \'rotate-180\': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">';
            $item_output .= '<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />';
            $item_output .= '</svg>';
            $item_output .= '</button>';
        }
        
        $item_output .= $args->after;
        
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
    
    /**
     * Starts the list before the elements are added.
     */
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat( "\t", $depth );
        
        // Add Alpine x-show directive
        $output .= "\n$indent<ul class=\"sub-menu\" x-show=\"open\" x-transition:enter=\"transition ease-out duration-100\" x-transition:enter-start=\"transform opacity-0 scale-95\" x-transition:enter-end=\"transform opacity-100 scale-100\" x-transition:leave=\"transition ease-in duration-75\" x-transition:leave-start=\"transform opacity-100 scale-100\" x-transition:leave-end=\"transform opacity-0 scale-95\" @click.away=\"open = false\">\n";
    }
}