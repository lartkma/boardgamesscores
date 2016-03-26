<?php

use Illuminate\Support\Facades\Artisan;

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	/**
	 * Creates the application.
	 *
	 * @return \Illuminate\Foundation\Application
	 */
	public function createApplication() {
        // https://laracasts.com/discuss/channels/testing/how-to-specify-a-testing-database-in-laravel-5
        putenv('DB_CONNECTION=sqlite');
        $app = require __DIR__.'/../bootstrap/app.php';
		$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
		return $app;
	}

    protected function setUpDatabase($seederClass = 'DatabaseSeeder'){
        Artisan::call('migrate');
        $this->seed($seederClass);
    }

}
