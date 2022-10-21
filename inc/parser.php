<?php

namespace WPPerformance\RelatedQueryBlock\inc\parser;

/** determine if string is json */
function isJSON($string)
{
    return is_string($string) && is_array(json_decode($string, true)) ? true : false;
}

/** find image with classes nolazy for replace lazy to eager */
function parse($string)
{
    // return all request json or empty
    if (isJSON($string) || !$string) {
        return $string;
    }

    $document = new \DOMDocument();
    // hide error syntax warning
    libxml_use_internal_errors(true);

    $document->loadHTML($string);
    $xpath = new \DOMXpath($document);

    parseQueryRelated($xpath);

    return $document->saveHTML();
}


/**
 * parse query with class wpp-related-query
 */
function parseQueryRelated(\DOMXpath $xpath): void
{
    $id = get_the_ID();
    if ($id) {
        $posts = $xpath->query("//*[contains(@class, 'wpp-related-query')]/ul/li[contains(@class, ' post-{$id} ')]");
        foreach ($posts as $key => $node) {
            $node->parentNode->removeChild($node);
        }
    }
}


function parsing_end(string $string): string
{
    return parse($string);
}


function parsing_start(): void
{
    ob_start(__NAMESPACE__ . '\parsing_end');
}
