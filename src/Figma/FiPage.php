<?php

namespace App\Figma;

use Tree\Node\Node;
use Tree\Visitor\PreOrderVisitor;

class FiPage {


	protected $name;

	protected $version;

	protected $styles;

	protected $components;

	protected $document;

	protected $scenes = [];

	public function __construct(string $name, array $components, Node $document, array $styles = [], string $version = ''){
		$this->name = $name;
		$this->version = $version;
		$this->components = $components;
		$this->document = $document;
		$this->findScenes();
	}

	private function findScenes(): void {
		$visitor = new PreOrderVisitor;
		$list = $this->document->accept($visitor);
		foreach($list as $node){
			if ($node->getDepth() == 2 && $node->getValue()['type'] == 'FRAME'){
				$location = $node->getValue()['absoluteBoundingBox'];
				if($location['x'] > 0 || $location['y'] > 0)
					$this->scenes[] = $node;
			}
		}
	}

	public function getScenes(): array {
		return $this->scenes;
	}

}