<?php

namespace Tests\Architecture;

use PHPat\Selector\Selector;
use PHPat\Test\PHPat;

class ArchitectureTest
{
    public function test_domain_does_not_depend_on_other_layers(): \PHPat\Test\Builder\TargetExcludeOrBuildStep
    {
        return PHPat::rule()
            ->classes(Selector::namespace('App\Models'))
            ->shouldNotDependOn()
            ->classes(
                Selector::namespace('App\Providers'),
                Selector::namespace('App\Console'),
            );
    }
}
