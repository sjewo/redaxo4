<?php

/**
 * RSS Reader Addon
 * 
 * @author markus[dot]staab[at]redaxo[dot]de Markus Staab
 * @author <a href="http://www.redaxo.de">www.redaxo.de</a>
 *
 * @package redaxo4
 * @version svn:$Id$
 */

class rex_rss_reader_component extends rex_dashboard_component
{
  var $feedUrl;
  function rex_rss_reader_component($feedUrl)
  {
    $this->feedUrl = $feedUrl;
    
    // default cache lifetime in seconds
    $cache_options['lifetime'] = 3600;
    
    parent::rex_dashboard_component('', '', $cache_options);
  }
  
  /*protected*/ function prepare()
  {
    global $I18N;
    
    $feed = new rex_rssReader($this->feedUrl);
    $encoding = $feed->get_encoding();
    
    $title = rex_a656_convert($feed->get_title(), $encoding);
    $title = $I18N->msg('rss_feed') .': ' . $title;
    $content = rex_a656_rss_teaser($this->feedUrl);
    
    $this->setTitle($title);
    $this->setContent($content);
  }
}