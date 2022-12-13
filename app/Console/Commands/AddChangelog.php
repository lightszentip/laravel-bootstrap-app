<?php

namespace App\Console\Commands;

use App\Dto\ChangelogItem;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class AddChangelog extends Command
{
    private static $ar_message = 'message';
    private static $ar_type = 'type';
    private static $ar_issue = 'issue';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'changelog:add {--t|type= : Type of change} {--i|issue=} {--m|message= : Changelog Message} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new item to changelog';

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
            $issue = $this->getArgument(AddChangelog::$ar_issue, true);
            $type = trim($this->getArgument(AddChangelog::$ar_type));
            $message = trim($this->getArgument(AddChangelog::$ar_message));

            $changelogItem = new ChangelogItem($message, $issue);

            $jsonString = file_get_contents($this->path());
            $decoded_json = json_decode($jsonString);
            if ($decoded_json == null || !property_exists($decoded_json, 'unreleased')) {
                $content = array('name' => 'tbd', 'date' => '', 'release' => false, $type => array($changelogItem->build()));;
                if ($decoded_json == null) {
                    $decoded_json['unreleased'] = $content;
                } else {
                    $decoded_json->unreleased = $content;
                }
            } else {
                $decoded_json->unreleased->$type[] = $changelogItem->build();
            }

            file_put_contents($this->path(), json_encode($decoded_json));
            return CommandAlias::SUCCESS;
        } catch (\InvalidArgumentException $e) {
            return CommandAlias::FAILURE;
        } catch (\Exception $e2) {
            $this->error("Error:  $e2 ");
            return CommandAlias::INVALID;
        }

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
