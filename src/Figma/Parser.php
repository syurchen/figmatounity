<?php

namespace App\Figma;

use Tree\Node\Node;

class Parser {

	static function parse (string $string): FiPage{

		$array = json_decode($string, true);
		$name = $array['name'];
		$version = $array['version'];
		$styles = $array['styles'];

		$document = $array['document'];
		$docNode = self::parseNode($document);
		echo "\n\n{$docNode->getSize()}\n\n";
		echo "\n\n{$docNode->getHeight()}\n\n";
		echo "\n\n" . count($docNode->getChildren()) . "\n\n";

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