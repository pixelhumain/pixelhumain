<?php
/**
 * ClientScript manages Javascript and CSS.
 */
class ClientScript extends CClientScript {
    public $scriptFileLevels = array();

    /**
     * Registers a javascript file.
     * @param string $url URL of the javascript file
     * @param integer $position the position of the JavaScript code. Valid values include the following:
     * <ul>
     * <li>CClientScript::POS_HEAD : the script is inserted in the head section right before the title element.</li>
     * <li>CClientScript::POS_BEGIN : the script is inserted at the beginning of the body section.</li>
     * <li>CClientScript::POS_END : the script is inserted at the end of the body section.</li>
     * </ul>
     * @param array $htmlOptions additional HTML attributes
     * @return CClientScript the CClientScript object itself (to support method chaining, available since version 1.1.5).
     */
    public function registerScriptFile($url,$position=null,array $htmlOptions=array(), $level = 1) {
        $this->scriptFileLevels[$url] = $level;
        return parent::registerScriptFile($url, $position, $htmlOptions);
    }
    /**
     * Renders the registered scripts.
     * Overriding from CClientScript.
     * @param string $output the existing output that needs to be inserted with script tags
     */
    public function render(&$output) {
        if (!$this->hasScripts)
            return;

        $this->renderCoreScripts();

        if (!empty($this->scriptMap))
            $this->remapScripts();

        $this->unifyScripts();

        //===================================
        //Arranging the priority
        $this->rearrangeLevels();
        //===================================

        $this->renderHead($output);
        if ($this->enableJavaScript) {
            $this->renderBodyBegin($output);
            $this->renderBodyEnd($output);
        }
    }


    /**
     * Rearrange the script levels.
     */
    public function rearrangeLevels() {
        $scriptFileLevels = $this->scriptFileLevels;
        foreach ($this->scriptFiles as $position => &$scripts) {
            $newscripts = array();
            $tempscript = array();
            foreach ($scripts as $url => $script) {
                $level = isset($scriptFileLevels[$url]) ? $scriptFileLevels[$url] : 1;
                $tempscript[$level][$url] = $script;
            }
            ksort($tempscript);
            foreach ($tempscript as $levels => $s) {
                foreach ($s as $url => $script) {
                    $newscripts[$url] = $script;
                }
            }
            $scripts = $newscripts;
        }
    }
}

?>