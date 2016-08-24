<?php
/**
 * @link https://github.com/nirvana-msu/yii2-helpers
 * @copyright Copyright (c) 2016 Alexander Stepanov
 * @license MIT
 */

namespace nirvana\helpers;

use Yii;

/**
 * HTMLHelper provides convenient shortcut methods for working with HTML
 *
 * @author Alexander Stepanov <student_vmk@mail.ru>
 */
class HtmlHelper
{
    const TAG_OPENING = 1;
    const TAG_CLOSING = 2;

    const POS_BEFORE = 1;
    const POS_AFTER = 2;

    /**
     * Injects arbitrary code into existing HTML structure, before or after a chosen opening/closing tag
     * @param string $code code to inject
     * @param string $html original HTML
     * @param string $tag the tag to inject near
     * @param integer $tagType whether we're looking for opening/closing tag
     * @param integer $position inject before/after the tag
     * @throws \Exception
     * @return string HTML with injected code
     */
    public static function inject($code, $html, $tag, $tagType, $position)
    {
        if ($tagType === self::TAG_OPENING) {
            $pattern = "/(<$tag.*?>)/i";
        } elseif ($tagType === self::TAG_CLOSING) {
            $pattern = "/(<\/$tag.*?>)/i";
        } else {
            throw new \Exception("Unknown tag type: $tagType");
        }

        // Split the string contained in $html in three parts:
        // - everything before the tag
        // - the tag itself with any attributes in it
        // - everything following the tag
        $matches = preg_split($pattern, $html, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

        // assemble HTML back with the required code embedded in specified position
        if ($position === self::POS_BEFORE) {
            $html = $matches[0] . $code . $matches[1] . $matches[2];
        } elseif ($position === self::POS_AFTER) {
            $html = $matches[0] . $matches[1] . $code . $matches[2];
        } else {
            throw new \Exception("Unknown position: $position");
        }

        return $html;
    }

    /**
     * Converts HTML to plain text.
     * @param string $html original HTML
     * @return string plain text
     */
    public static function htmlToPlainText($html)
    {
        // Replace &nbsp; with spaces
        $html = str_replace("\xC2\xA0", ' ', html_entity_decode($html));
        // Strip out HTML tags
        $text = strip_tags($html);
        // Replace excessive whitespace (spaces, tabs, and line breaks) with single space
        $text = preg_replace('/\s+/S', ' ', $text);

        return $text;
    }
}
