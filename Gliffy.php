<?php
$wgExtensionCredits['parserhook'][] = array(
  'name'         => 'Gliffy',
  'version'      => '1.0',
  'author'       => 'Nick Townsend', 
  'url'          => 'http://www.mediawiki.org/wiki/Extension:Gliffy',
  'description'  => 'Render public Gliffy diagrams'
);
 
if ( defined( 'MW_SUPPORTS_PARSERFIRSTCALLINIT' ) ) {
  $wgHooks['ParserFirstCallInit'][] = 'gliffySetup';
} else {
  $wgExtensionFunctions[] = 'gliffySetup';
}
 
function gliffySetup() {
  global $wgParser;
  $wgParser->setHook( 'gliffy', 'gliffyRender' );
  return true;
}
 
function gliffyRender( $input, $args, $parser) {
  $parser->disableCache();

  if( isset( $args['did'] ) ) {
    $did= $args['did'];
    $html = <<<HTML
<a href="https://www.gliffy.com/go/html5/$did" target="_blank">edit with Gliffy</a>
<br/>
<script src="http://www.gliffy.com/diagramEmbed.js" type="text/javascript"> </script>
<script type="text/javascript"> gliffy_did = "$did"; embedGliffy(); </script>
HTML;
  }
  else
    $html = "<b>Gliffy drawing ID (did) not supplied</b>";

  return array( $html, "markerType" => 'nowiki' );
 
}
// vim: set ts=8 sw=2 sts=2:
?>
