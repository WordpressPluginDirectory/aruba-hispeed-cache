<?php
if(array_key_exists('ahsc_static_cache',AHSC_CONSTANT['ARUBA_HISPEED_CACHE_OPTIONS'])){
    if(isset(AHSC_CONSTANT['ARUBA_HISPEED_CACHE_OPTIONS']['ahsc_static_cache'])){
        if(AHSC_CONSTANT['ARUBA_HISPEED_CACHE_OPTIONS']['ahsc_static_cache']){
            add_action( 'admin_init', 'AHSC_edit_htaccess' );
        }else{
            add_action( 'admin_init', 'AHSC_remove_htaccess' );
        }
    }
}

/**
 * ADD directives from .htaccess file
 */
function AHSC_edit_htaccess(){
		if ( ! is_multisite() ) {
			
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
			
			$htaccess_location = get_home_path() . '.htaccess';
			
			$AHSC_rules=array(
	'<IfModule mod_expires.c>',
	'ExpiresActive on',
	'ExpiresDefault "access plus 1 month"',
	'# CSS',
	'ExpiresByType text/css "access plus 1 year"',
	'# Data interchange',
	'ExpiresByType application/json "access plus 0 seconds"',
	'ExpiresByType application/xml "access plus 0 seconds"',
	'ExpiresByType text/xml "access plus 0 seconds"',
	'# Favicon (cannot be renamed!)',
	'ExpiresByType image/x-icon "access plus 1 week"',
	'# HTML components (HTCs)',
	'ExpiresByType text/x-component "access plus 1 month"',
	//'# HTML',
	//'ExpiresByType text/html "access plus 0 seconds"',
	'# JavaScript',
	'ExpiresByType application/javascript "access plus 1 year"',
	'# Manifest files',
	'ExpiresByType application/x-web-app-manifest+json "access plus 0 seconds"',
	'ExpiresByType text/cache-manifest "access plus 0 seconds"',
	'# Media',
	'ExpiresByType audio/ogg "access plus 1 month"',
	'ExpiresByType image/gif "access plus 1 month"',
	'ExpiresByType image/jpeg "access plus 1 month"',
	'ExpiresByType image/png "access plus 1 month"',
	'ExpiresByType image/webp "access plus 1 month"',
	'ExpiresByType video/mp4 "access plus 1 month"',
	'ExpiresByType video/ogg "access plus 1 month"',
	'ExpiresByType video/webm "access plus 1 month"',
	'# Web feeds',
	'ExpiresByType application/atom+xml "access plus 1 hour"',
	'ExpiresByType application/rss+xml "access plus 1 hour"',
	'# Web fonts',
	'ExpiresByType application/font-woff2 "access plus 1 month"',
	'ExpiresByType application/font-woff "access plus 1 month"',
	'ExpiresByType application/vnd.ms-fontobject "access plus 1 month"',
	'ExpiresByType application/x-font-ttf "access plus 1 month"',
	'ExpiresByType font/opentype "access plus 1 month"',
	'ExpiresByType image/svg+xml "access plus 1 month"',
	'</IfModule>',
	'# Set the cache-control max-age',
'# 1 year',
'<FilesMatch ".(ico|pdf|flv|jpg|jpeg|png|gif|js|css|swf|webp|woff2|woff|ttf)$">',
            'Header set Cache-Control "max-age=31449600, public"',
                                     '</FilesMatch>',
'# 2 DAYS',
'<FilesMatch ".(xml|txt)$">',
            'Header set Cache-Control "max-age=172800, public, must-revalidate"',
                                     '</FilesMatch>',
'# 4 HOURS',
'<FilesMatch ".(html|htm)$">',
            'Header set Cache-Control "max-age=14400, must-revalidate"',
                                     '</FilesMatch>',
	'<IfModule mod_deflate.c>',
	'# Compress HTML, CSS, JavaScript, Text, XML and fonts',
	'AddOutputFilterByType DEFLATE application/javascript',
	'AddOutputFilterByType DEFLATE application/rss+xml',
	'AddOutputFilterByType DEFLATE application/vnd.ms-fontobject',
	'AddOutputFilterByType DEFLATE application/x-font',
	'AddOutputFilterByType DEFLATE application/x-font-opentype',
	'AddOutputFilterByType DEFLATE application/x-font-otf',
	'AddOutputFilterByType DEFLATE application/x-font-truetype',
	'AddOutputFilterByType DEFLATE application/x-font-ttf',
	'AddOutputFilterByType DEFLATE application/x-javascript',
	'AddOutputFilterByType DEFLATE application/xhtml+xml',
	'AddOutputFilterByType DEFLATE application/xml',
	'AddOutputFilterByType DEFLATE font/opentype',
	'AddOutputFilterByType DEFLATE font/otf',
	'AddOutputFilterByType DEFLATE font/ttf',
	'AddOutputFilterByType DEFLATE image/svg+xml',
	'AddOutputFilterByType DEFLATE image/x-icon',
	'AddOutputFilterByType DEFLATE text/css',
	'AddOutputFilterByType DEFLATE text/html',
	'AddOutputFilterByType DEFLATE text/javascript',
	'AddOutputFilterByType DEFLATE text/plain',
	'AddOutputFilterByType DEFLATE text/xml',
	'# Remove browser bugs (only needed for really old browsers)',
	'BrowserMatch ^Mozilla/4 gzip-only-text/html',
	'BrowserMatch ^Mozilla/4\.0[678] no-gzip',
	'BrowserMatch \bMSIE !no-gzip !gzip-only-text/html',
	'Header append Vary User-Agent',
	'</IfModule>'
);

			insert_with_markers( $htaccess_location, 'AHSC_RULES', $AHSC_rules );
		}

}

/**
 * REMOVE directives from .htaccess file
 */
function AHSC_remove_htaccess() {
		if ( ! is_multisite() ) {
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
			$htaccess = get_home_path() . '.htaccess';
			insert_with_markers( $htaccess, 'AHSC_RULES', array(' ') );
		}

}