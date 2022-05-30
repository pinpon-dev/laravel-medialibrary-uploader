<?php

use Illuminate\Http\UploadedFile;

if (! function_exists('fake_request')) {
    function fake_request(int $count = 1, array $keysToDelete = []): object
    {
        return new class ($count, $keysToDelete) {
            public function __construct(private readonly int $count, private readonly array $keysToDelete)
            {
            }

            public function file($key): ?array
            {
                if (in_array($key, $this->keysToDelete)) {
                    return null;
                }

                $files = [];

                for ($i = 0; $i < $this->count; $i++) {
                    $files[] =
                        UploadedFile::fake()
                                    ->image("$key.jpg");
                }

                return $files;
            }

            public function input($key): ?bool
            {
                return
                    in_array($key, $this->keysToDelete)
                        ? false
                        : null;
            }
        };
    }
}
