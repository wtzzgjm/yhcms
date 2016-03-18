<?php return array ('URL_MODEL' => 2,'URL_MODEL__INDEX' => 2,'URL_PATHINFO_DEPR' => '/','URL_ROUTER_ON' => true,'URL_ROUTER_ON__INDEX' => true,'URL_ROUTE_RULES' => array (
  'Mobile$' => 'Mobile/Index/index',
  'Special/:id\d' => 'Special/shows',
  ':e/p/:p\d' => 'List/index',
  ':e/:id\d' => 'Show/index',
  '/^(\w+)$/' => 'List/index?e=:1',
),'HTML_CACHE_ON__INDEX' => false,'HTML_CACHE_ON__NOBILE' => false,'HTML_CACHE_RULES' => array (
),);?>