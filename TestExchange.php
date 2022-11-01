<?php
if(!defined('MEDIAWIKI')){
    die("This is a mediawiki extension and cannot be accessed directly.");
}
$wgExtensionCredits['TestExchange']['other'] = array(
    'path'=>__FILE__,
    'name'=>'TestExchange',
    'author'=>'Fabrizio Spoto',
    'description'=>'This is a test version',
    'version'=>'1.0.0',
);

// $wgHooks['EditPage::showEditForm:initial'][] = 'TestExchange::NewEditPage';
$wgHooks['BeforePageDisplay'][] = 'TestExchange::NewEditPage';
$wgHooks['ParserBeforeTidy'][] = 'wgAddJquery';

class TestExchange {
    public static function NewEditPage() {
        $title = Title::newFromText( 'Current Exchange' );
        if ( !is_null( $title ) && !$title->isKnown() && $title->canExist() ){
            $page = new WikiPage( $title );
            $content_page = '<div id="content_text"><h3>Current Exchange</h3></br></div>';
            $content_page .= '<div><h5>EUR/CZK exchange</h5></br><p id="eur_to_czk"></p></br></div>';
            $content_page .= '<div><h5>USD/CZK exchange</h5></br><p id="usd_to_czk"></p></br></div>';
            $content_page .= '<div><h5>GBP/CZK exchange</h5></br><p id="gbp_to_czk"></p></br></div>';
            $content = ContentHandler::makeContent( $content_page, $title );
            $page->doEditContent( $content, 'Edit summary' );
        }
    }
}

function wgAddJquery(&$parser, &$text) {
    global $addJqueryScripts;
    if ($addJqueryScripts === true) return true;
    $parser->mOutput->addHeadItem(
        '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script><script language="JavaScript" src="../extensions/TestExchange/request.js?v=2" type="text/javascript"></script>'
    );
    $addJqueryScripts = true;
    return true;
}
