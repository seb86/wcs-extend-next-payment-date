=== WooCommerce Subscriptions - Extend Next Payment Date === 
Author URI: https://sebastiendumont.com
Plugin URI: https://github.com/seb86/wcs-extend-next-payment-date
Contributors: sebd86
Tags: woocommerce, subscriptions, orders
Requires at least: 4.9
Requires PHP: 5.6
Tested up to: 5.3.2
Stable tag: 1.0.0
WC requires at least: 3.6.0
WC tested up to: 4.0.1
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Extends the next payment date of any new subscription defined by your `wp-config.php`. **PHP v7+ is required!**

== Description ==

The purpose of this small plugin is to offer an extension on a subscriptions next payment. It doesn't matter if you sell subscriptions on yearly basis or any other billing period. Your extending the date of the next payment, **NOT** the subscription.

By default, the plugin will extend any subscription by additional 2 months until the 31st July 2020.

## Settings

Open your `wp-config.php` file and set the constants you wish to override.

#### Billing Period By

```php
define( 'WCS_EXTEND_PERIOD_BY', 'month' ); // options: day, week, month or year
```

#### Billing Length

```php
define( 'WCS_EXTEND_LENGTH_BY', '2' ); // e.g. 2 x billing period by
```

### Subscription extension offer expires**

Specify a date if you wish to only extend subscriptions that were ordered before it.

#### Day

```php
define( 'WCS_EXTEND_UNTIL_DAY', '31' ); // e.g. 31st of July
```

#### Month

```php
define( 'WCS_EXTEND_UNTIL_MONTH', '07' ); // options: 01, 02, 03, 04, 05, 06, 07, 08, 09, 10, 11, 12
```

#### Year

```php
define( 'WCS_EXTEND_UNTIL_YEAR', '2020' );
```

#### Subscription Product ID's

List the product id's of the subscriptions that can only be extended.

```php
define( 'WCS_EXTEND_PRODUCTS', array(
	'32', '127'
) );
```

### Bug reports

Bug reports for CoCart are welcomed in the [CoCart repository on GitHub](https://github.com/seb86/wcs-extend-next-payment-date). Please note that GitHub is not a support forum, and that issues that aren’t properly qualified as bugs will be closed.

#### Credits

This plugin is created by [Sébastien Dumont](https://sebastiendumont.com).

== Installation ==

= Minimum Requirements =

You need to be using WooCommerce Subscriptions product extension.

= Manual installation =

The manual installation method involves downloading the plugin and uploading it to your webserver via your favourite FTP application. The WordPress codex contains [instructions on how to do this here](https://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation).

= Updating =

Automatic updates should work like a charm if you are using the GitHub updater plugin; as always though, ensure you backup your site just in case.


== Changelog ==

= v1.0.0 - 24th March, 2020 =

*[View the full changelog here](https://github.com/seb86/wcs-extend-next-payment-date/blob/master/CHANGELOG.md).
