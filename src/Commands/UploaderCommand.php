<?php

namespace PinPon\Uploader\Commands;

use Illuminate\Console\Command;

class UploaderCommand extends Command
{
    public $signature = 'simple-uploader';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
