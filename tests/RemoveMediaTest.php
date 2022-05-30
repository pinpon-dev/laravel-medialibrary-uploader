<?php

use Illuminate\Http\UploadedFile;
use PinPon\Uploader\MediaUploader;

it('removes all media', function () {
    $this->testModel
        ->registerMediaCollections();

    $this->testModel
        ->addMedia(
            UploadedFile::fake()
                ->image('file1.png')
        )
        ->preservingOriginal()
        ->toMediaCollection('avatar');
    $this->testModel
        ->addMedia(
            UploadedFile::fake()
                ->image('file2.png')
        )
        ->preservingOriginal()
        ->toMediaCollection('avatar');

    invade(MediaUploader::upload([]))->removeFromCollection($this->testModel, 'avatar');

    expect($this->testModel->fresh()
                           ->getMedia('avatar'))->toBeEmpty();
});

it('removes media from request', function () {
    MediaUploader::upload(['avatar'])
                 ->setMockRequest(static fn () => fake_request())
                 ->to($this->testModel);

    MediaUploader::upload(['avatar'])
                 ->setMockRequest(static fn () => fake_request(1, ['avatar']))
                 ->to($this->testModel);

    expect($this->testModel->fresh()
                           ->getMedia('avatar'))->toBeEmpty();
});
