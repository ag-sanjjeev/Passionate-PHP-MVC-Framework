<?php

namespace app\core;

/**
 * Class Cookie
 *
 * This is an routing class file. Which has information about all routes
 * given in this application
 *
 * @copyright 2023 ag-sanjjeev
 * @license url MIT
 * @version Release: @1.0@
 * @link url
 * @since Class available since Release 1.0
 */
class Cookie {

    /**
     * Set cookie
     *
     * @param cookie name $name This is a valid cookie name
     * @param cookie value $value This is a valid cookie value
     * @param expiry time $expire This is a valid expiry time in milli-seconds
     * @param url path $path This is a valid url path by default current path
     * @param domain name $domain This is a valid domain name that cookie going to use
     * @param security $secure This is boolean value for whether cookie accessible in secure or not
     * @param http $httponly This is boolean value whether accessible in http or https 
     * @author ag-sanjjeev 
     */
    public static function set($name, $value, $expire = 0, $path = '/', $domain = '', $secure = false, $httponly = false) {
        setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
    }

    /**
     * Get cookie
     *
     * @param cookie name $name This is a valid cookie name
     * @author ag-sanjjeev 
     * @return cookie
     */
    public static function get($name) {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
    }

    /**
     * Checks if cookie exist
     *
     * @param cookie name $name This is a valid cookie name
     * @author ag-sanjjeev 
     * @return bool
     */
    public static function has($name) {
        return isset($_COOKIE[$name]);
    }

    /**
     * Delete a cookie
     *
     * @param cookie name $name This is a valid cookie name
     * @param url path $path This is a valid url path by default current path
     * @param domain name $domain This is a valid domain name that cookie going to use
     * @author ag-sanjjeev 
     */
    public static function delete($name, $path = '/', $domain = '') {
        if (self::has($name)) {
            setcookie($name, '', time() - 3600, $path, $domain);
            unset($_COOKIE[$name]);
        }
    }

    /**
     * Get all cookie
     *
     * @author ag-sanjjeev 
     * @return cookies
     */
    public static function all() {
        return $_COOKIE;
    }

    /**
     * Delete all cookies
     *
     * @param url path $path This is a valid url path by default current path
     * @param domain name $domain This is a valid domain name that cookie going to use
     * @author ag-sanjjeev      
     */
    public static function deleteAll($path = '/', $domain = '') {
        foreach ($_COOKIE as $name => $value) {
            self::delete($name, $path, $domain);
        }
    }

}