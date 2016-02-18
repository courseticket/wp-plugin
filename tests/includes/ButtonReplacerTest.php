<?php

class ButtonReplacerTest extends WP_UnitTestCase
{
    public function testReplace() {
        $txt = $this->_getPost('    https://www.courseticket.com/en/e/6606');
        $expected = $this->_getLink('https://www.courseticket.com/en/e/6606');

        $this->assertEquals($expected, ButtonReplacer::replace($txt));
    }

    public function testReplace_shouldAcceptLinkWithoutWww() {
        $txt = $this->_getPost('https://courseticket.com/en/e/6606');
        $expected = $this->_getLink('https://www.courseticket.com/en/e/6606');

        $this->assertEquals($expected, ButtonReplacer::replace($txt));
    }

    public function testReplace_shouldAcceptSpanWithCourseticketClass() {
        $txt = $this->_getPost('<span class="courseticket-button">https://courseticket.com/en/e/6606</span>');
        $expected = $this->_getLink('https://www.courseticket.com/en/e/6606');

        $this->assertEquals($expected, ButtonReplacer::replace($txt));
    }

    public function testReplace_shouldNotReplaceInLink() {
        $txt = $this->_getPost('<a href="https://courseticket.com/en/e/6606');

        $this->assertEquals($txt, ButtonReplacer::replace($txt));
    }

    private function _getPost($link)
    {
        return "Post text!\n" . $link . "\n&nbsp;";
    }

    private function _getLink($url)
    {
        return "Post text!\n" . '<a class="courseticket-button" href="'
        . $url . '">Book now</a>' . "\n&nbsp;";
    }
}

