<?php
/*
Plugin Name: Display Attached File Size
Plugin URI: http://www.elegants.biz/Products/DisplayAttachedFileSize
Description: メディアライブラリの一覧にファイルサイズを表示するプラグイン
Version: 1.0
Author: 木綿
Author URI: http://www.elegants.biz/
License: GPLv2 or later
 */

/*  Copyright 2014 木綿 (email : momen.yutaka@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

function muc_column( $cols ) {
    
    $cols["media_url"] = "ファイルサイズ";
    return $cols;
}
function muc_value( $column_name, $id ) {
    if ( $column_name == "media_url" )
        echo formatSizeUnits(filesize(get_attached_file($id)));
}
add_filter( 'manage_media_columns', 'muc_column' );
add_action( 'manage_media_custom_column', 'muc_value', 10, 2 );

function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824)
    {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    }
    elseif ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    }
    elseif ($bytes > 1)
    {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1)
    {
        $bytes = $bytes . ' byte';
    }
    else
    {
        $bytes = '0 bytes';
    }

    return $bytes;
}