<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */

    protected $layout = 'layout.master';

    const PAGE_NUMBER = 15;

    const SIDEBAR_LIMITS = 5;

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
}
