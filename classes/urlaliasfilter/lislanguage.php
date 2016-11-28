<?php
/**
 * File containing the eZURLAliasFilter class.
 *
 * @copyright Copyright (C) 2016 land in sicht AG All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version  1.0.0
 * @package kernel
 */

class lislanguageFilter extends eZURLAliasFilter
{
    /*
     * var array eZLanguage string  => mappingValue
     */
    protected $languageMap;

    /**
     * @var array list of class identifiers
     */
    protected $applyOnClassList;

    function lislanguageFilter()
    {
        $ini = eZINI::instance('site.ini');
        $this->languageMap = $ini->variable('lisurlalias','LanguageMap');
        $this->applyOnClassList = $ini->variable( 'lisurlalias', 'ApplyOnClass' );
        $this->locale = $ini->variable('RegionalSettings','Locale');
    }

    /**
     * Append a language mapping of the object being published
     * So its URL alias will look like :
     * someurlalias-<languageMapping>
     *
     * @param string The text of the URL alias
     * @param object The eZContentObject object being published
     * @params object The eZContentObjectTreeNode in which the eZContentObject is published
     * @return string The transformed URL alias with the languageMapping
     */
    function process($text, &$languageObject, &$caller)
    {
        if( !$caller instanceof eZContentObjectTreeNode )
        {
            eZDebug::writeError( 'The caller variable was not an eZContentObjectTreeNode', __METHOD__ );
            return $text;
        }

        $classIdentifier = $caller->attribute( 'class_identifier' );
        $language = $languageObject->attribute('locale') ;
        if (isset($this->languageMap[$language]) && in_array($classIdentifier,$this->applyOnClassList))
        {
            $separator  = eZCharTransform::wordSeparator();
            $text .= $separator . $this->languageMap[$language];
        }
        return $text;
    }
}