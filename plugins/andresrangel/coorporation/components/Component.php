<?php namespace AndresRangel\Coorporation\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Lang;

class Component extends ComponentBase
{

	public function componentDetails()
	{
	}

	public function defineProperties()
	{
		return [
			'maxItems' => [
				'title'             => 'andresrangel.coorporation::lang.labels.maxItems',
				'description'       => 'andresrangel.coorporation::lang.descriptions.maxItems',
				'default'           => 20,
				'type'              => 'string',
				'validationPattern' => '^[0-9]+$',
			],
			'itemId'   => [
				'title'             => 'andresrangel.coorporation::lang.labels.itemId',
				'description'       => 'andresrangel.coorporation::lang.descriptions.itemId',
				'default'           => '',
				'type'              => 'string',
				'validationPattern' => '^[0-9]+$',
			],
			'orderBy'  => [
				'title'       => 'andresrangel.coorporation::lang.labels.orderBy',
				'description' => 'andresrangel.coorporation::lang.descriptions.orderBy',
				'type'        => 'dropdown',
				'default'     => 'id',
			],
			'sort'     => [
				'title'       => 'andresrangel.coorporation::lang.labels.sort',
				'description' => 'andresrangel.coorporation::lang.descriptions.sort',
				'type'        => 'dropdown',
				'default'     => 'desc',
			],
		];
	}

	public function getSortOptions()
	{
		return [
			'desc' => Lang::get('andresrangel.coorporation::lang.labels.descending'),
			'asc'  => Lang::get('andresrangel.coorporation::lang.labels.ascending'),
		];
	}
}
