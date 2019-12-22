<?php
namespace App\Shell;

use Cake\Console\Shell;

/**
 * DatabaseBackup shell command.
 */
class ChangeServicePlanShell extends Shell
{
    public $tasks = ['ChangeServicePlan']; // ← タスクの読み込み
    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        $this->out($this->OptionParser->help());
        // タスクの実行
        $this->ChangeServicePlan->main();
    }
}
