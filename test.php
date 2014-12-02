<?php 
	
	namespace Tests;
	use \Router\Router;
	use Symfony\Component\Yaml\Yaml;
	
	class RouterTest extends \PHPUnit_Framework_TestCase {

		protected $router;

		public function setUp() {

			$this->router = new Router; 

		}
		public function assertPreConditions() {

			$this->assertEquals(0, count($this->router)); 
		}
		public function testAddRoute() {
			$this->router->addRoute(Yaml::parse(__DIR__.'/Fixtures/routes.yml'));
			$this->assertEquals(1, count($this->router)); 
		}
}