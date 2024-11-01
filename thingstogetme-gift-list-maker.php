<?php

/*
Plugin Name: ThingsToGetMe Gift List Maker
Description: Add the ThingsToGetMe plugin to your WordPress website
Version: 1.1
Author: ThingsToGetMe
License: GPL2
*/

function thingstogetme_shortcode( $atts, $content = null )
{
    $atts = shortcode_atts(
        array(
            'host'      => '',
            'version'   => '',
            'container' => '',
            'debug'     => '',
            'list'      => '',
        ),
        $atts,
        'thingstogetme'
    );

    $thingstogetme_host = $atts['host'];

    if ( empty( $thingstogetme_host ) )
    {
        $thingstogetme_host = 'https://www.thingstogetme.com';
    }
 
    $thingstogetme_version = $atts['version'];
 
    if ( empty( $thingstogetme_version ) )
    {
        $thingstogetme_version = '20180901';
    }
  
    $thingstogetme_container = $atts['container'];
 
    if ( empty( $thingstogetme_container ) )
    {
        $thingstogetme_container = '#ttgm';
    }
 
    $thingstogetme_debug = $atts['debug'];
 
    if ( empty( $thingstogetme_debug ) )
    {
        $thingstogetme_debug = 'false';
    }

   $thingstogetme_list = $atts['list'];
 
    if ( strpos( $thingstogetme_container, '#' ) !== false )
    {
        $thingstogetme_div = str_replace( "#", "", $thingstogetme_container );
        $output = "<div id='".$thingstogetme_div."'></div>";
    }
    elseif ( strpos( $thingstogetme_container, '.' ) !== false )
    {
        $thingstogetme_div = str_replace( ".", "", $thingstogetme_container );
        $output = "<div class='".$thingstogetme_div."'></div>";
    }

    $output .= "
<script>
  (function(w,i,d,g,e,t) {
    w.ttgmArgs={container:e,host:d,debug:t,version:g,list:'$thingstogetme_list'};
    var sc=i.createElement('script');sc.type='text/javascript';
    sc.async=true;sc.setAttribute('crossorigin','anonymous');
    sc.src=w.ttgmArgs.host+'/widget/'+g+'.js'+'?p='+Math.random();
    i.getElementsByTagName('head')[0].appendChild(sc);
  })(window,document, '$thingstogetme_host', $thingstogetme_version, '$thingstogetme_container', $thingstogetme_debug );
</script>";
 
    return $output;
}

add_shortcode( 'thingstogetme', 'thingstogetme_shortcode' );
