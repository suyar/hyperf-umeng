<?php

declare(strict_types=1);
/**
 * This file is part of suyar/hyperf-umeng.
 *
 * @link     https://github.com/suyar/hyperf-umeng
 * @document https://github.com/suyar/hyperf-umeng/blob/main/README.md
 * @contact  su@zorzz.com
 * @license  https://github.com/suyar/hyperf-umeng/blob/master/LICENSE
 */

namespace Suyar\Umeng\OpenApi;

/**
 * AppTrack-移动广告监测.
 *
 * @see https://developer.umeng.com/open-api/ns/com.umeng.apptrack/apply
 *
 * @method array backReportData(array $data) 合作渠道报表数据回传
 * @method array getActiveDetailData(array $data) 获得用户app激活数据信息明细【pro】
 * @method array getPayAnalysisData(array $data) 获得付费订单数据
 * @method array getOrderAnalysisData(array $data) 获得拍下订单数据
 * @method array getRegisterAnalysisData(array $data) 获得注册事件分析数据
 * @method array getMonitoringList(array $data) 获得监测单元列表
 * @method array getPlanList(array $data) 获得用户计划列表
 * @method array getMyEventData(array $data) 获取用户自定义事件
 * @method array getClickActiveData(array $data) 获得点击激活数据
 * @method array getRegisterLoginData(array $data) 获得计划注册登录相关数据
 * @method array getStayTrendData(array $data) 获取留存数据
 */
class AppTrack
{
    public function __construct(protected Client $client)
    {
    }

    public function __call(string $name, array $arguments)
    {
        [$version, $function] = match ($name) {
            'backReportData' => [1, 'umeng.apptrack.backReportData'],
            'getActiveDetailData' => [1, 'umeng.apptrack.getActiveDetailData'],
            'getPayAnalysisData' => [1, 'umeng.apptrack.getPayAnalysisData'],
            'getOrderAnalysisData' => [1, 'umeng.apptrack.getOrderAnalysisData'],
            'getRegisterAnalysisData' => [1, 'umeng.apptrack.getRegisterAnalysisData'],
            'getMonitoringList' => [1, 'umeng.apptrack.getMonitoringList'],
            'getPlanList' => [1, 'umeng.apptrack.getPlanList'],
            'getMyEventData' => [1, 'umeng.apptrack.getMyEventData'],
            'getClickActiveData' => [1, 'umeng.apptrack.getClickActiveData'],
            'getRegisterLoginData' => [1, 'umeng.apptrack.getRegisterLoginData'],
            'getStayTrendData' => [1, 'umeng.apptrack.getStayTrendData'],
        };

        $data = $arguments[0] ?? [];

        return $this->request($version, $function, is_array($data) ? $data : []);
    }

    protected function request(int|string $version, string $function, array $params = []): array
    {
        return $this->client->request($version, 'com.umeng.apptrack', $function, $params);
    }
}
