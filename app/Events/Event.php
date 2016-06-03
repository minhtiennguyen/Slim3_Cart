<?php

namespace Cart\Events;

use Cart\Handlers\Contracts\HandlerInterface;
use Cart\Handlers\EmpyBasket;

class Event 
{
	protected $handlers = [];

	public function attach($handlers)
	{
		if (is_array($handlers)) {
			foreach ($handlers as $handler) {
				if (!$handler instanceof HandlerInterface) {
					continue;
				}

				$this->handlers[] = $handler;
			}

			return;
		}

		if ($handlers instanceof HandlerInterface) {
			return;
		}
	}

	public function dispatch()
	{
		foreach ($this->handlers as $handler) {
			$handler->handle($this);
		}
	}
}