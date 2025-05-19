<?php

namespace App;

use Cron\CronExpression;
use App\Message\StatusMessage;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Component\Scheduler\RecurringMessage;
use Symfony\Component\Scheduler\Attribute\AsSchedule;
use Symfony\Component\Scheduler\ScheduleProviderInterface;
use Symfony\Component\Scheduler\Schedule as SymfonySchedule;
use Symfony\Component\Scheduler\Trigger\CronExpressionTrigger;

#[AsSchedule]
class ScheduleProvider implements ScheduleProviderInterface
{
    private ?SymfonySchedule $schedule = null;
    public function __construct(
        private CacheInterface $cache,
    ) {
    }

    public function getSchedule(): SymfonySchedule
    {
        return $this->schedule ??= (new SymfonySchedule())
            ->stateful($this->cache) // ensure missed tasks are executed
            ->processOnlyLastMissedRun(true) // ensure only last missed task is run
            ->with(
                RecurringMessage::trigger(
                    new CronExpressionTrigger(
                        new CronExpression('*/5 * * * *') // Every 5 minutes
                    ),
                    new StatusMessage()
                )
            );

    }
}
