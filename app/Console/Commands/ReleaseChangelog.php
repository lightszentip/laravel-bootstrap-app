<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class ReleaseChangelog extends Command
{
    private static $ar_name = 'releasename';
    private static $ar_type = 'type';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'changelog:release {--rn|releasename= : Name of release} {--t|type= : Which update the current version - patch, minor, major, rc}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Release version in file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if(!file_exists($this->path()) ) {
            $this->error("Please create a empty file:  " . $this->path());
            return CommandAlias::FAILURE;
        }

        try {
            $type = trim($this->getArgument(ReleaseChangelog::$ar_type));
            $name = trim($this->getArgument(ReleaseChangelog::$ar_name));

            if ( $type != 'rc' && $type != 'patch' && $type != 'minor' && $type != 'major') {
                $this->error('Please use rc, patch, minor or major for a release');
                return CommandAlias::FAILURE;
            }

            $jsonString = file_get_contents($this->path());
            $decoded_json = json_decode($jsonString);
            if ($decoded_json == null || !property_exists($decoded_json, 'unreleased')) {
                $this->error('No release changelog exists to update');
                return CommandAlias::FAILURE;
            } else {
                if($type =='patch') app('pragmarx.version')->incrementPatch();
                if($type =='minor') app('pragmarx.version')->incrementMinor();
                if($type =='major') app('pragmarx.version')->incrementMajor();

                $version = ($type == "rc") ? app('pragmarx.version')->format('changelog-rc') : app('pragmarx.version')->format('changelog');
                $decoded_json->$version = $decoded_json->unreleased;
                $decoded_json->$version->name = $name;
                $decoded_json->$version->release = true;
                $decoded_json->$version->date = new \DateTime();
                $decoded_json->unreleased= array('name' => 'tbd', 'date' => '', 'release' => false, $type => array());
            }

            file_put_contents($this->path(), json_encode($decoded_json));
            return CommandAlias::SUCCESS;
        } catch (\InvalidArgumentException $e) {
            return CommandAlias::FAILURE;
        } catch (\Exception $e2) {
            $this->error("Error:  $e2 ");
            return CommandAlias::INVALID;
        }

        //TODO
        // 1. Update unreleased version
        // 2. move current changelog file into resource dir

      //  $this->info( app('pragmarx.version')->incrementMinor());
        $this->info( app('pragmarx.version')->current());
        $this->info( app('pragmarx.version')->format('changelog'));
        //{--n|name= : Name of release} {--v|version= : Version of release}
        return Command::SUCCESS;
    }

    private function path(): string
    {
        return config('changelog.path')
            .DIRECTORY_SEPARATOR.'.changes'.DIRECTORY_SEPARATOR.'changelog.json';
    }

    private function getArgument(string $key, bool $optional = false): string
    {
        $result = $this->option($key);

        if (!$optional && is_null($result)) {
            $result = $this->ask($key);
        }

        if($result == null && $optional) {
            return '';
        } else if ($result == null && !$optional) {
            $this->error("No input for key:  $key ");
            throw new \InvalidArgumentException();
        }

        return $result;
    }


}
