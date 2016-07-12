<?php

class OverviewReplacerTest extends WP_UnitTestCase
{
    protected $lastChar = "\n";

    public function setUp()
    {
        update_option('embed_html', '');
    }

    public function testReplace() {
        $txt = $this->_getPost('    ');
        $expected = $this->_getLink();
        $this->assertEquals($expected, OverviewReplacer::replace($txt));
    }

    public function testReplace_shouldAcceptLinkWithoutWww() {
        $txt = $this->_getPost('https://ct.com/en/e/6606');
        $expected = $this->_getLink();

        $this->assertEquals($expected, OverviewReplacer::replace($txt));
    }

    private function _getPost($link)
    {
        return "Post text!\n" . $link . Setup::getOverviewText() . "\n&nbsp;";
    }

    private function _getLink()
    {
        return '<div class="courseticket-events" data-uid="24325" data-options="limit:9;hidesearch:0;lang:en;order:event_price;showmenu:1"></div>';
    }
}

