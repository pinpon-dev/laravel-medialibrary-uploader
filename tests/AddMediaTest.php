<?php

use PinPon\Uploader\MediaUploader;

it('adds media from request key', function () {
    $this->testModel->registerMediaCollections();

    invade(MediaUploader::upload([])->setMockRequest(static fn () => fake_request()))->addToCollection($this->testModel, 'avatar');

    expect($this->testModel->fresh()->getMedia('avatar'))->toHaveLength(1);
});

it('adds multiple media from request key', function () {
    $this->testModel->registerMediaCollections();

    invade(MediaUploader::upload([])->setMockRequest(static fn () => fake_request(3)))->addToCollection($this->testModel, 'avatar');

    expect($this->testModel->fresh()->getMedia('avatar'))->toHaveLength(3);
});

it('does nothing if collection does not exists', function () {
    MediaUploader::upload(['inexistant'])->setMockRequest(static fn () => fake_request())->to($this->testModel);

    expect($this->testModel->dirty)->toBeFalsy();
});
