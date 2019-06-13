<?php

namespace patterns\strategy;

abstract class QueryAbstract{
	
	public abstract function preparar($Q, $pos = 0);
}
