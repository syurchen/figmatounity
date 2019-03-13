<?php

namespace App\Figma;

use Tree\Node\Node;

class Parser {

	static function parse (array $array): FiPage{

		$name = $array['name'];
		$version = $array['version'];
		$styles = $array['styles'];

		$document = $array['document'];
		$docNode = self::parseNode($document);
		$components = [];

		return new FiPage($name, $components, $docNode, $styles, $version);

	}

	private static function parseNode(array $node){
		$nodeCopy = $node;
		if (!isset($node['id']))
			return false;
		else
			unset($nodeCopy['id']);

		$nodeNode = new Node($node['id']);
		$nodeCopy = $node;
		if (isset($nodeCopy['children'])){
			unset($nodeCopy['children']);
			foreach($node['children'] as $child){
				$childNode = self::parseNode($child);
				if ($childNode)
					$nodeNode->addChild($childNode);
			}
		}
		$nodeNode->setValue($nodeCopy);
		return $nodeNode;
	}
}