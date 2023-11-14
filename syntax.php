<?php
/**
 * DokuWiki Plugin heimu (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author Xenolies <3116372735@qq.com>
 *
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

class syntax_plugin_heimu extends DokuWiki_Syntax_Plugin
{

    function getType()
    {
        return 'substition';
    }

//    function getAllowedTypes() {
//        return array();
//    }

//    function getPType(){
//        return 'normal';
//    }


    function getSort()
    {
        return 234;
    }


    function connectTo($mode)
    {
        $this->Lexer->addSpecialPattern('\{\{heimu\|[^}]*\}\}', $mode, 'plugin_heimu');
    }


    function handle($match, $state, $pos, Doku_Handler $handler)
    {
        $data = explode('|', substr($match, strlen('{{heimu|'), -2));
        return $data;
    }


    function render($mode, Doku_Renderer $renderer, $data)
    {
        if ($data[0] == null) {
            $data[0] = "你知道的太多了";
        }
        // 获取title
        $heimu_title = ' title="' . hsc($data[0]) . '"';
        // 整合成 span 标签
        $html = '<span class="heimu" ' .  $heimu_title . '>' . hsc($data[1]) . '</span>';

        if ($mode == 'xhtml') {
            $renderer->doc .= $html;
            return true;
        }
        return false;
    }
}