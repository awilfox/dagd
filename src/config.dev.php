<?php
// This is the general config file for DaGd stuff.
class DaGdConfig {
  public static $config = array(
    'general.environment' => 'development',

    'general.debug' => false,

    'general.display_errors' => false,

    'general.baseurl' => 'http://dagd.local', // DO *NOT* include trailing '/'.

    'general.useragent' => 'da.gd/1.0',

    // These are the "Accept:" headers we return html for.
    // Any of these can match anywhere in the Accept header.
    // These are imploded by "|", so all |'s should be escaped.
    'general.html_accept' => array(
      'text/html',
      'application/xhtml+xml'
    ),

    'general.applications' => array(
      'ip',
      'useragent',
      'comingsoon',
      'help',
      'whois',
      'editcount',
      'shorten',
      'pastebin',
      'headers',
      'up',
      'host',
      'break',
      'commander',
      'image',
      'status',
      'isp',
      'dns',
    ),

    'general.routemap' => array(
      '/help/?$' => 'DaGdHelpController',
      '/ua/?$' => 'DaGdUserAgentController',
      '/ip/?$' => 'DaGdIPController',
      '/w/(.+)/?$' => 'DaGdWhoisController',
      '/ec/(.+)/?$' => 'DaGdEditCountController',
      '/up/(.+)/?$' => 'DaGdIsItUpController',
      '/host/(.+)/?$' => 'DaGdHostController',
      '/headers/?(.+)?/?$' => 'DaGdHeadersController',
      '/break/?$' => 'DaGdBreakController',
      '/c/(store)/(.+?)/(.+?)/?$' => 'DaGdCommanderController',
      '/c/(.+?)(?:/| )(.+?)/?$' => 'DaGdCommanderController',
      '/c/?(json|)?/?$' => 'DaGdCommanderController',
      '/dns/(.+)/?$' => 'DaGdDNSController',
      '/status/(\d+)/?(.+)?/?' => 'DaGdStatusController',
      '/image/([0-9x*]+)(?:\.|/|)(\w+)?/?$' => 'DaGdImageController',
      '/(?:p|paste|pastebin)/?(\d+)?/?$' => 'DaGdPastebinController',
      '/isp/?(.+)?/?$' => 'DaGdISPController',
      '/coshorten/([^/]+)?/?(.*)?$' => 'DaGdCoShortenController',
      '/(?:(?:shorten|s|)(?:/|$))?([^/]+)?/?(.*)?$' => 'DaGdShortenController',
    ),

    // These routes take place on CLI useragents only.
    'general.cli_routemap' => array(
      '/$' => 'DaGdHelpController',
    ),

    // These are just full-out redirects.
    'general.redirect_map' => array(
      '/et/(\d+)/?$' => 'http://www.etsy.com/listing/$1',
    ),

    // These are extra headers that get applied globally
    'general.extra_headers' => array(
      'Cache-Control: no-cache',
      'Access-Control-Allow-Origin: *', // CORS
    ),

    // Required PHP extensions
    // We fatal if these aren't found.
    'general.required_extensions' => array(
      'gd',
    ),

    // Regexes we blacklist on
    'shorten.longurl_blacklist' => array(),

    // The default transient whois server.
    'whois.transient_server' => array(
      'server' => 'whois.arin.net',
      'query' => 'n +',
    ),

    // A hardcoded map of whois servers to use for certain domains.
    'whois.hardcode_map' => array(
      // tld (WITHOUT '.') => server
      'gd' => array(
        'server' => 'whois.nic.gd',
      ),
      'io' => array(
        'server' => 'io.whois-servers.net',
      ),
      'ly' => array(
        'server' => 'whois.nic.ly',
      ),
      'de' => array(
        'server' => 'whois.denic.de',
        'query' => '-T dn,ace',
      ),
      'so' => array(
        'server' => 'whois.nic.so',
      ),
    ),

    // These referral servers are blacklisted. If we hit one of them, we simply
    // bail out and return the transient result.
    'whois.referral_blacklist' => array(
      'rwhois.eng.bellsouth.net', // Service Not Available: exceeded max client sessions
    ),

    // Should error emails get sent out?
    'exceptions.email' => false,

    // Only send emails in non-debug mode. 'exceptions.email' must be true.
    'exceptions.email_in_debug' => false,

    // The list of people to email on exceptions.
    'exceptions.mail_to' => array(
      'ricky@elrod.me',
    ),

    // MySQL settings
    'mysql.host' => 'localhost',
    'mysql.user' => 'root',
    'mysql.password' => '',
    'mysql.database' => 'dagd',

    // IsItUp Settings
    'isitup.max_redirects' => 5,
    'isitup.timeout' => 3,

    // Image settings
    'image.max_height' => 7000,
    'image.max_width' => 7000,
    'image.fontpath' => '/usr/share/fonts/dejavu/DejaVuSansMono.ttf',
    'image.fontsize' => 20,
    'image.default_bg_rgb' => array(44, 44, 44),
    'image.default_text_rgb' => array(150, 150, 150),
    'image.default_filetype' => 'png', // Must be a key of the below array.
    'image.imagetypes' => array(
      // extension => ('contenttype' => $a, 'phpfunction' => $b)
      'png' => array(
        'contenttype' => 'image/png',
        'phpfunction' => 'imagepng',
      ),
      'jpg' => array(
        'contenttype' => 'image/jpeg',
        'phpfunction' => 'imagejpeg',
      ),
      'jpeg' => array(
        'contenttype' => 'image/jpeg',
        'phpfunction' => 'imagejpeg',
      ),
      'gif' => array(
        'contenttype' => 'image/gif',
        'phpfunction' => 'imagegif',
      ),
      'xbm' => array(
        'contenttype' => 'image/x-xbitmap',
        'phpfunction' => 'imagexbm',
      ),
      'wbmp' => array(
        'contenttype' => 'image/vnd.wap.wbmp',
        'phpfunction' => 'imagewbmp',
      ),
    ),
  );

  public static function get($key) {
    return self::$config[$key];
  }
}
