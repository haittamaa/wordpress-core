<?php
/*
Plugin Name: SimpleUuid
Plugin URI: http://www.csps.com
Description: Adds UUIDs to WordPress posts.
Version: 1.0
Author: Jeremy Stark
Author URI: http://www.csps.com
*/

$uuid_key = 'simple-uuid';

// Add save hook
add_action('save_post', 'add_post_uuid');

function add_post_uuid($id)
{
    global $uuid_key;
    $uuid = get_post_meta($id, $uuid_key, true);
    if(! $uuid)
    {
      $uuid = new_uuid();
      add_post_meta($id, $uuid_key, $uuid, true);
    }
    return $id;
}

function new_uuid($prefix='')
{
    $chars = md5(uniqid(rand()));
    $uuid  = substr($chars,0,8) . '-';
    $uuid .= substr($chars,8,4) . '-';
    $uuid .= substr($chars,12,4) . '-';
    $uuid .= substr($chars,16,4) . '-';
    $uuid .= substr($chars,20,12);
                                
    return $prefix . $uuid;
}

?>
