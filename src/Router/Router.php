<?php

	namespace Router;

	class Router implements \Countable{

		protected $routes = [];
		protected $params = [];
		protected $matches = [];

		public function count(){
			return count($this->routes);
		}

		public function addRoute(array $routes){
			foreach ($routes as $routename =>$info) {
				if (isset($this->routes[$routename])) {
					throw new \RuntimeException(sprintf('cannot override route "%s"', $routename));
					
				}
			$this->routes[$routename] = $info;
			}
		}

		public function getRoute($url){
			$routing =[];
			foreach ($this->routes as $route) {

				if (preg_match('/^'.$route['pattern'].'$/', $url, $matches)) {
					list($controller, $action) = explode(':',$route['connect']);
					$routing = [
						'controller' => $controller,
						'action' => $action,
						'params' => $this->getParams($route, $matches)
					];
					return $routing;
				}

			}

			throw new \RuntimeException('bad route url');
		}

		public function getParams(array $route, array $matches){ 
		
			if (empty($route['params'])) {
				return;
			}

			foreach (explode(',', $route['params']) as $p) {
				$p = trim($p);
				$values[$p] = $matches[$p];
			}
			return $values;
		}

	}