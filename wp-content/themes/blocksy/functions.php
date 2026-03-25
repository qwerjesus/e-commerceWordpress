<?php
/**
 * Blocksy functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Blocksy
 */

if (version_compare(PHP_VERSION, '5.7.0', '<')) {
	require get_template_directory() . '/inc/php-fallback.php';
	return;
}

require get_template_directory() . '/inc/init.php';

// --- 1. ELIMINAR CAMPOS INNECESARIOS (CRO DROPSHIPPING) ---
add_filter( 'woocommerce_checkout_fields' , 'eliminar_campos_checkout_colombia' );

function eliminar_campos_checkout_colombia( $fields ) {
    unset($fields['billing']['billing_company']); // Empresa
    unset($fields['billing']['billing_postcode']); // Código Postal
    unset($fields['order']['order_comments']); // Notas
    return $fields;
}

// --- 2. FORZAR TEXTOS DE DIRECCIÓN (JERARQUÍA SUPERIOR) ---
add_filter( 'woocommerce_default_address_fields' , 'editar_textos_direccion_colombia' );

function editar_textos_direccion_colombia( $fields ) {
    // Corregimos el error de traducción de España a LATAM
    $fields['city']['label'] = 'Ciudad';
    
    // Optimizamos Dirección 1
    $fields['address_1']['label'] = 'Dirección de entrega';
    $fields['address_1']['placeholder'] = 'Ej: Carrera 23 # 45 - 67';
    
    // Optimizamos Dirección 2
    $fields['address_2']['label'] = 'Barrio, Conjunto o Apartamento (Recomendado)';
    $fields['address_2']['placeholder'] = 'Ej: Barrio Bocagrande, Edificio Altamar Apto 23';
    
    return $fields;
}    	

// --- 4. DESTRUIR SECCIÓN DE INFORMACIÓN ADICIONAL COMPLETA (TÍTULO INCLUIDO) ---
add_filter( 'woocommerce_enable_order_notes_field', '__return_false', 9999 );

