<?php


use PinPon\Uploader\MediaUploader;

it('loads model collections', function () {
    MediaUploader::upload([])->to($this->testModel);

    expect($this->testModel->mediaCollections)->not()->toBeEmpty();
});
