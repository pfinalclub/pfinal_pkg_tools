<?php
/**
 * Author: PFinal南丞
 * Date: 2022/4/12
 * Email: <lampxiezi@163.com>
 */

namespace Pfinalclub\PkgTools\Console;

use Illuminate\Console\Command;
use Pfinalclub\PkgTools\Pkg;


class PkgCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pkg';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all pkg commands';

    /**
     * @var string
     */
    public static $logo = <<<LOGO
  _____  _                      _   _
 |  __ \| |           /\       | | (_)
 | |__) | | ____ _   /  \   ___| |_ _  ___  _ __
 |  ___/| |/ / _` | / /\ \ / __| __| |/ _ \| '_ \
 | |    |   < (_| |/ ____ \ (__| |_| | (_) | | | |
 |_|    |_|\_\__, /_/    \_\___|\__|_|\___/|_| |_|
              __/ |
             |___/
LOGO;

    public $source_data = [];

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->source_data = config('pfinal-pkg-tools');
        $this->line(static::$logo);
        $this->line(Pkg::getLongVersion());
        $this->listPkgCommands();
        $pkg_group_code = $this->ask('选择需要的扩展 【 Code 】');
        if (!preg_match('/^[0-9]*$/', $pkg_group_code)) {
            $this->comment('');
            $this->comment('扩展code 错误');
        }
        $this->listPkgInfo($pkg_group_code);
    }

    protected function listPkgCommands(): void
    {

        $table_data = [];
        foreach ($this->source_data as $k => $val) {
            $table_data[] = [$val['code'], $val['title'], $val['pkg_desc']];
        }
        $this->table(
            ['Code', 'Name', 'PkgDesc'],
            $table_data
        );
    }

    protected function listPkgInfo(string $code): void
    {
        $table_data = [];
        foreach ($this->source_data as $val) {
            if ($val['code'] == $code) {
                foreach ($val['source'] as $v) {
                    $table_data[] = [$v['code'], $v['pkg_title'], $v['pkg_url']];
                }
            }
        }
        $this->table(
            ['Code', 'Pkg_title', 'PkgUrl'],
            $table_data
        );
    }

}
