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
        $install_pkg_code = $this->ask('选择需要安装的扩展 【 Code 】');
        $this->installPkg($pkg_group_code, $install_pkg_code);
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

    protected function installPkg(string $pkg_group_code, string $code): void
    {
        $this->info('开始安装扩展===========================');
        $base_path = base_path();
        $this->info('当前扩展目录：' . $base_path);
        $this->info('当前扩展组：' . $pkg_group_code);
        $pkg_title = '';
        foreach ($this->source_data as $val) {
            if ($val['code'] == $pkg_group_code) {
                foreach ($val['source'] as $v) {
                    if ($v['code'] == $code) {
                        $pkg_title = $v['pkg_title'] ?? '';
                    }
                }
            }
        }
        if (!$pkg_title) {
            $this->error('扩展组不存在');
            return;
        }
        $shell_cmd = 'cd ' . $base_path . '&& composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/ && composer require ' . $pkg_title;
        $this->info('执行命令：' . $shell_cmd);
        $this->info('执行结果：');
        $this->info(shell_exec($shell_cmd));
    }

}
