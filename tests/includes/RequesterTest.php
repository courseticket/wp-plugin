<?php

class RequesterTest extends WP_UnitTestCase
{
    public function testHtmlRequest() {
        $_SERVER['HTTP_HOST'] = 'blog.ct.com';
        $_SERVER['REQUEST_URI'] = '/index/32';
        
        $input = Array ( '',
            '',
            'Book now',
            'showOrganizer;smallLayout',
            'en',
            '290');
        $expected = 'https://www.courseticket.com/en/widgets/button/?btn-href=https%3A%2F%2Fwww.courseticket.com%2Fen%2Fe%2F290&btn-referer=blog.ct.com%2Findex%2F32&btn-text=Book+now&btn-options=showOrganizer%3BsmallLayout';

        $this->assertEquals($expected, Request::htmlRequest($input));
    }

    public function testGetHtml() {
        $input = 'https://www.courseticket.com/en/widgets/button/?btn-href=https%3A%2F%2Fwww.courseticket.com%2Fen%2Fe%2F290&btn-referer=blog.ct.com%2Findex%2F32&btn-text=Book+now&btn-options=showOrganizer%3BsmallLayout';
        $string = Request::getHtml($input);
        $this->assertStringStartsWith('<div', $string);
        $this->assertStringEndsWith('</div>', $string);
    }

    public function testGetBody() {
        $input = '<html><div id="main"><div></div></div></html>';
        $expected = '<div id="main"><div></div></div>';

        $this->assertEquals($expected, Request::getBody($input));
    }

}
