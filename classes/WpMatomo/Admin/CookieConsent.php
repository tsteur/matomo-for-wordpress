<?php

namespace WpMatomo\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // if accessed directly
}

class CookieConsent {

	const REQUIRE_COOKIE_CONSENT = 'cookie';

	const REQUIRE_TRACKING_CONSENT = 'tracking';

	const REQUIRE_NONE = 'none';

	/**
	 * @return string[]
	 */
	public static function getAvailableOptions() {
		return [
			self::REQUIRE_NONE => __( 'None', 'matomo' ),
			self::REQUIRE_COOKIE_CONSENT => __('Require cookie consent', 'matomo'),
			self::REQUIRE_TRACKING_CONSENT => __('Require tracking consent', 'matomo')
		];

	}
	/**
	 * @param string $tracking_mode
	 * @see CookieConsent::REQUIRE_COOKIE_CONSENT
	 * @see CookieConsent::REQUIRE_NONE
	 * @see CookieConsent::REQUIRE_TRACKING_CONSENT
	 * @return string
	 */
	public function getTrackingConsentOption( $tracking_mode ) {
		switch( $tracking_mode ) {
			case self::REQUIRE_TRACKING_CONSENT:
				$tracking_code = <<<JAVASCRIPT
_paq.push(['requireConsent']);
JAVASCRIPT;
;
				break;
			case self::REQUIRE_COOKIE_CONSENT:
				$tracking_code = <<<JAVASCRIPT
_paq.push(['requireCookieConsent']);
JAVASCRIPT;
				break;
			case self::REQUIRE_NONE:
			default:
			$tracking_code = '';
		}
		return $tracking_code;
	}
}
