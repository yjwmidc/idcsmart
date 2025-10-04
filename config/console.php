<?php
// +----------------------------------------------------------------------
// | 控制台配置
// +----------------------------------------------------------------------
return [
    // 指令定义
    'commands' => [
	    'cron' => 'app\command\Cron',
	    'task' => 'app\command\Task',
	    'on_demand_cron' => 'app\command\OnDemandCron',
	    'cron_sub' => 'app\command\CronSub',
	    'task_client_care' => 'app\command\TaskClientCare',
    ],
];
