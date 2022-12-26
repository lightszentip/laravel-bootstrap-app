<?php

namespace App\Dto;

class ChangelogItem
{
    private string $issue;
    private string $message;

    public function __construct(string $message, string $issue = null)
    {
        $this->issue = $issue;
        $this->message = $message;
    }

    /**
     * build result
     * @return array|string[]
     */
    public function build(): array
    {
        if ($this->issue == null) {
            return array('message' => $this->message);
        }
        return array('message' => $this->message, 'issue' => $this->issue);
    }
}
