<?php

class ExampleTest extends TestCase {

    public function setUp(){
        parent::setUp();
        parent::setUpDatabase();
    }

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample() {
		$response = $this->call('GET', '/');
		$this->assertEquals(200, $response->getStatusCode());
	}

}
