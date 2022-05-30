<?php

namespace PinPon\Uploader;

use Closure;
use Illuminate\Support\Arr;
use Spatie\MediaLibrary\HasMedia;

class MediaUploader
{
    private ?Closure $mockRequest;

    public function __construct(private readonly array $keys)
    {
    }

    public static function upload(string|array $keys): MediaUploader
    {
        return new self(Arr::wrap($keys));
    }

    public function to(HasMedia $model): void
    {
        $model->registerMediaCollections();

        $collections = collect(
            property_exists($model, 'mediaCollections')
                ? $model->mediaCollections
                : []
        );

        collect($this->keys)->each(function ($key) use ($collections, $model) {
            if (! $collections->firstWhere('name', $key)) {
                return;
            }

            if ($this->getRequest()->file($key) !== null) {
                $this->addToCollection($model, $key);
            } elseif ($this->getRequest()->input($key) === false) {
                $this->removeFromCollection($model, $key);
            }
        });
    }

    public function setMockRequest(Closure $mockRequest): MediaUploader
    {
        $this->mockRequest = $mockRequest;

        return $this;
    }

    private function getRequest()
    {
        return is_callable($this->mockRequest) ? call_user_func($this->mockRequest) : request()();
    }

    private function addToCollection(HasMedia $model, string $key): void
    {
        $files = Arr::wrap($this->getRequest()->file($key));

        foreach ($files as $index => $file) {
            $fileName = $key;

            if (count($files) > 1) {
                $fileName .= "_$index";
            }

            $extension = $file
                ->extension();

            $model->addMedia($file)
                  ->usingFileName("$fileName.$extension")
                  ->toMediaCollection($key);
        }
    }

    private function removeFromCollection(HasMedia $model, string $key): void
    {
        $model->getMedia($key)
              ->each
            ->delete();
    }
}
