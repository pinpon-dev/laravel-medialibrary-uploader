<?php

namespace PinPon\Uploader\Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase as Orchestra;
use PinPon\Uploader\UploaderServiceProvider;
use Spatie\MediaLibrary\MediaLibraryServiceProvider;

class TestCase extends Orchestra
{
    public function createApplication()
    {
        require_once __DIR__ . '/helpers.php';

        return parent::createApplication();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app);

        $this->testModel = TestModel::first();
    }

    protected function getEnvironmentSetUp($app)
    {
        $this->initializeDirectory($this->getTempDirectory());

        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        config()->set('filesystems.disks.public', [
            'driver' => 'local',
            'root' => $this->getTempDirectory('media'),
            'url' => '/media',
        ]);


        $app->bind('path.public', $this->getTempDirectory());

        config()->set('app.key', '6rE9Nz59bGRbeMATftriyQjrpF7DcOQm');
    }

    protected function setUpDatabase($app)
    {
        $app['db']->connection()
                  ->getSchemaBuilder()
                  ->create('test_models', function (Blueprint $table) {
                      $table->increments('id');
                      $table->string('name');
                      $table->integer('width')
                            ->nullable();
                      $table->softDeletes();
                  });

        TestModel::create(['name' => 'test']);

        $mediaTableMigration = require(__DIR__ . '/../vendor/spatie/laravel-medialibrary/database/migrations/create_media_table.php.stub');

        $mediaTableMigration->up();
    }

    protected function getPackageProviders($app): array
    {
        return [
            UploaderServiceProvider::class,
            MediaLibraryServiceProvider::class,
        ];
    }

    public function getTempDirectory(string $suffix = ''): string
    {
        return __DIR__ . '/temp' . ($suffix == ''
                ? ''
                : '/' . $suffix);
    }

    protected function initializeDirectory($directory)
    {
        if (File::isDirectory($directory)) {
            File::deleteDirectory($directory);
        }
        File::makeDirectory($directory);
    }
}
