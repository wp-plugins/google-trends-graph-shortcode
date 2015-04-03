<?php
/*
Plugin Name: Google Trends Graph Shortcode
Version: 0.1
Plugin URI: http://www.beliefmedia.com/wp-plugins/google-trends-graph-shortcode.php
Description: Display Google Trends. Use shortcode of &#91;trends q="wordpress, wordpress plugin, wp snippets, wordpress themes&#93; to graph search trends (up to 5 terms separated by comma). Define region using &#91;trends q="wordpress, wordpress plugin" geo="AU"&#93; (usage details on website).
Author: Marty Khoury
Author URI: http://www.beliefmedia.com/
*/


function internoetics_google_trends($atts){
  extract( shortcode_atts( array(
    'w' => '550', /* Width */
    'h' => '330', /* Height */
    'q' => '', /* Query string */
    'geo' => '', /* http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2 */
    'align' => 'center',
  ), $atts ) );

 $terms = explode(",", $q); $q = '';
  foreach ($terms as $term) {
    $term = str_replace(' ', '+', trim($term));
    $q .= $term . ',';
  } 
 $q = rtrim($q, ',');

ob_start();
?>
<p align="<?php echo $align;?>"><script type="text/javascript" src="http://www.google.com/trends/embed.js?hl=en-US&q=<?php echo $q;?><?php if ($geo) echo "&geo=$geo";?>&cmpt=q&content=1&cid=TIMESERIES_GRAPH_0&export=5&w=<?php echo $w;?>&h=<?php echo $h;?>"></script></p>
<?php
return ob_get_clean();
}
add_shortcode("trends","internoetics_google_trends");


/* Menu Links */
function internoetics_trends_action_links($links, $file) {
static $this_plugin;
 if (!$this_plugin) {
  $this_plugin = plugin_basename(__FILE__);
 }
  if ($file == $this_plugin) {
   $links[] = '<a href="http://www.internoetics.com/" target="_blank">Internoetics</a>';
   $links[] = '<a href="http://www.internoetics.com/2015/04/05/google-trends-api-and-wordpress-shortcode/" target="_blank">Support</a>';
  }
  return $links;
 }
add_filter('plugin_action_links', 'internoetics_trends_action_links', 10, 2);