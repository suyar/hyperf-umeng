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

namespace Suyar\UMeng\OpenApi;

use Suyar\UMeng\Excention\UMengException;
use Suyar\UMeng\Transport\Http;

/**
 * U-App-移动统计.
 *
 * @see https://developer.umeng.com/open-api/ns/com.umeng.uapp/apply
 *
 * @method array createApp(array $data) U-App新建数据源
 * @method array getNewAccounts(array $data) 获取新增账号
 * @method array getActiveAccounts(array $data) 获取活跃账号
 * @method array createEvent(array $data) 创建自定义事件
 * @method array getLaunchesByChannelOrVersion(array $data) 根据渠道或版本条件，获取App启动次数
 * @method array getActiveUsersByChannelOrVersion(array $data) 根据渠道或版本条件，获取App活跃用户数
 * @method array getNewUsersByChannelOrVersion(array $data) 根据渠道或版本条件，获取App新增用户数
 * @method array getEventParamValueDurationList(array $data) 获取事件参数值时长列表
 * @method array getTodayYesterdayData(array $data) 获取App今天与昨天的统计数据
 * @method array getYesterdayData(array $data) 获取App昨天统计数据
 * @method array getTodayData(array $data) 获取App今天统计数据
 * @method array getEventUniqueUsers(array $data) 获取自定义事件的独立用户数
 * @method array getAllAppData() 获取所有App统计数据
 * @method array getAppCount() 获取App数量
 * @method array getChannelData(array $data) 获取渠道维度统计数据
 * @method array getVersionData(array $data) 获取版本维度统计数据
 * @method array getEventParamData(array $data) 获取事件参数值统计数据
 * @method array getEventParamValueList(array $data) 获取事件参数值列表
 * @method array getEventData(array $data) 获取事件统计数据
 * @method array getEventParamList(array $data) 获取事件参数列表
 * @method array getEventList(array $data) 获取事件列表
 * @method array getRetentions(array $data) 获取App新增用户留存率
 * @method array getDurations(array $data) 获取App使用时长
 * @method array getLaunches(array $data) 获取App启动次数
 * @method array getActiveUsers(array $data) 获取App活跃用户数
 * @method array getNewUsers(array $data) 获取App新增用户数
 * @method array getDailyData(array $data) 获取App统计数据
 * @method array getAppList(array $data) 获取App列表
 */
class UApp
{
    public function __construct(protected Http $http)
    {
    }

    /**
     * @throws UMengException
     */
    public function __call(string $name, array $arguments)
    {
        [$version, $function] = match ($name) {
            'createApp' => [1, 'umeng.uapp.createApp'],
            'getNewAccounts' => [1, 'umeng.uapp.getNewAccounts'],
            'getActiveAccounts' => [1, 'umeng.uapp.getActiveAccounts'],
            'createEvent' => [1, 'umeng.uapp.event.create'],
            'getLaunchesByChannelOrVersion' => [1, 'umeng.uapp.getLaunchesByChannelOrVersion'],
            'getActiveUsersByChannelOrVersion' => [1, 'umeng.uapp.getActiveUsersByChannelOrVersion'],
            'getNewUsersByChannelOrVersion' => [1, 'umeng.uapp.getNewUsersByChannelOrVersion'],
            'getEventParamValueDurationList' => [1, 'umeng.uapp.event.param.getValueDurationList'],
            'getTodayYesterdayData' => [1, 'umeng.uapp.getTodayYesterdayData'],
            'getYesterdayData' => [1, 'umeng.uapp.getYesterdayData'],
            'getTodayData' => [1, 'umeng.uapp.getTodayData'],
            'getEventUniqueUsers' => [1, 'umeng.uapp.event.getUniqueUsers'],
            'getAllAppData' => [1, 'umeng.uapp.getAllAppData'],
            'getAppCount' => [1, 'umeng.uapp.getAppCount'],
            'getChannelData' => [1, 'umeng.uapp.getChannelData'],
            'getVersionData' => [1, 'umeng.uapp.getVersionData'],
            'getEventParamData' => [1, 'umeng.uapp.event.param.getData'],
            'getEventParamValueList' => [1, 'umeng.uapp.event.param.getValueList'],
            'getEventData' => [1, 'umeng.uapp.event.getData'],
            'getEventParamList' => [1, 'umeng.uapp.event.param.list'],
            'getEventList' => [1, 'umeng.uapp.event.list'],
            'getRetentions' => [1, 'umeng.uapp.getRetentions'],
            'getDurations' => [1, 'umeng.uapp.getDurations'],
            'getLaunches' => [1, 'umeng.uapp.getLaunches'],
            'getActiveUsers' => [1, 'umeng.uapp.getActiveUsers'],
            'getNewUsers' => [1, 'umeng.uapp.getNewUsers'],
            'getDailyData' => [1, 'umeng.uapp.getDailyData'],
            'getAppList' => [1, 'umeng.uapp.getAppList'],
        };

        $data = $arguments[0] ?? [];

        return $this->request($version, $function, is_array($data) ? $data : []);
    }

    /**
     * @throws UMengException
     */
    protected function request(int|string $version, string $function, array $params = []): array
    {
        return $this->http->request($version, 'com.umeng.uapp', $function, $params);
    }
}
