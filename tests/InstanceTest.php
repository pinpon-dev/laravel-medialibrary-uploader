<?php

use PinPon\Uploader\MediaUploader;

it('can be initialized', function () {
    expect(MediaUploader::upload([]))->toBeInstanceOf(MediaUploader::class);
});

it('stores requested keys', function () {
    expect(invade(MediaUploader::upload(['one', 'two'])))->keys->toBe(['one', 'two']);
});
