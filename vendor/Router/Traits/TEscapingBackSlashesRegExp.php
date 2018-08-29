<?php 

namespace Service\Router\Traits;

trait TEscapingBackSlashesRegExp {

	protected static function escapeBackSlashes( $string ) {
		return str_replace('/', '\/', $string );
	}

	protected static function unescapeBackSlashes( $string ) {
		return str_replace('\/', '/', $string );
	}

}