<?php
/**
 * WP_UnitTestCase.php
 *
 * PHP version 5.5.6
 *
 * @category Na
 * @package  blog
 * @author   freefri <courseticket@freefri.es>
 * @license  http://www.courseticket.com/imprint CT
 * @link     Na
 * @since    2016-02-15
 */

/**
 * Class WP_UnitTestCase
 *
 * PHP version 5.5.6
 *
 * @category Na
 * @package  blog
 * @author   freefri <courseticket@freefri.es>
 * @license  http://www.courseticket.com/imprint CT
 * @link     Na
 * @since    2016-02-15
 */
abstract class WP_UnitTestCase extends PHPUnit_Framework_TestCase
{
    public function __construct($name = null, $data = array(), $dataName = '')
    {
        $class = substr(get_class($this), 0, strpos(get_class($this), 'Test'));
        preg_match_all('/((?:^|[A-Z])[a-z]+)/', $class, $matches);
        $fileName = strtolower(implode('-', $matches[0]));
        $classFile = dirname( __FILE__ ) . '/../includes/class.' . $fileName . '.php';
        if (file_exists($classFile)) {
            require_once($classFile);
        }
        parent::__construct($name, $data, $dataName);
    }
}