<?php

namespace LaravelBladeKit\Support;

use Illuminate\Filesystem\Filesystem;

trait CopiesFiles
{
    private function copyFile(Filesystem $files, string $from, string $to, bool $force): void
    {
        if (! $files->exists($from)) {
            $this->components->twoColumnDetail($this->relative($to), '<fg=red>missing stub</>');

            return;
        }

        if ($files->exists($to) && ! $force) {
            $this->components->twoColumnDetail($this->relative($to), '<fg=yellow>SKIPPED (exists)</>');

            return;
        }

        $files->ensureDirectoryExists(dirname($to));
        $files->copy($from, $to);
        $this->components->twoColumnDetail($this->relative($to), '<fg=green>copied</>');
    }

    private function mergeLangJson(Filesystem $files, string $from, string $to): void
    {
        $incoming = json_decode($files->get($from), true) ?? [];

        if ($files->exists($to)) {
            $existing = json_decode($files->get($to), true) ?? [];
            $incoming = array_merge($incoming, $existing);
        }

        $files->ensureDirectoryExists(dirname($to));
        $files->put($to, json_encode($incoming, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)."\n");
        $this->components->twoColumnDetail($this->relative($to), '<fg=green>merged</>');
    }

    private function relative(string $path): string
    {
        return str_replace(base_path().'/', '', $path);
    }
}
