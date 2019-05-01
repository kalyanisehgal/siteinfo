<?php
/**
 * @file
 * Contains \Drupal\siteinfo\Controller\SiteInfoController.
 *
 */
namespace Drupal\siteinfo\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\node\Entity\Node;

/**
   * Display node data if node type is page and API key is correct.
   * @param  $siteapikey and $nodeid
   *   Site APi Key and Node ID
   * @return JSON
   *   JSON representation of node.
   */
class SiteInfoController extends ControllerBase {

  public static function json($siteapikey, $nodeid) {
  	//Check the whether the node with given node id exists or not
  	$values = \Drupal::entityQuery('node')->condition('nid', $nodeid)->execute();
	$node_exists = count($values);

	if($node_exists) {
		//Check the node type
	  	$node = Node::load($nodeid);
		$type = $node->type->entity->id();

		//check whether the node type is page and Site API key is correct
		if($type == "page" && \Drupal::state()->get('siteapikey') == $siteapikey) {
			//Serialize the node
			$serializer = \Drupal::service('serializer');
		
			$response = $serializer->serialize($node, 'json', ['plugin_id' => 'entity']);

			$response = json_decode($response, TRUE);

			$json_response = new JsonResponse($response);

			$json = $json_response->setEncodingOptions( $json_response->getEncodingOptions() | JSON_PRETTY_PRINT );
		} else {
			//Return access denied if in case requirements does not match
			$json = array('#markup' => 'Access Denied.');
		}
	} else {
		//Return access denied if in case node does not exist
		$json = array('#markup' => 'Access Denied.');
	}	
	
	//return response
	return $json;
  }
}