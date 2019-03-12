<?php

namespace App\Figma;

use Tree\Node\Node;

class FiPage {


	protected $name;

	protected $version;

	protected $styles;

	protected $components;

	protected $document;

	public function __construct(string $name, array $components, Node $document, array $styles = [], string $version = ''){
		$this->name = $name;
		$this->version = $version;
		$this->components = $components;
		$this->document = $document;
	}

}