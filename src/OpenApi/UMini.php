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
 * U-MiniProgram-小程序统计.
 *
 * @see https://developer.umeng.com/open-api/ns/com.umeng.umini/apply
 *
 * @method array getH5ElementValueList(array $data) 获取H5曝光元素的属性的统计数据
 * @method array getH5ElementList(array $data) 获取H5曝光元素统计数据
 * @method array getH5SceneOverview(array $data) 获取H5场景来源统计数据
 * @method array createCampaign(array $data) 添加推广链接
 * @method array getSceneInfoList(array $data) 获取渠道或活动信息列表
 * @method array getRetentionByDataSourceId(array $data) 获取应用的留存数据
 * @method array getCustomerSourceOverview(array $data) 获取获客来源的指标数据
 * @method array getMultiIndiceList(array $data) 获取分组指标列表
 * @method array getMultiOverview(array $data) 获取分组指标数据
 * @method array initMultiLevelTree(array $data) 上传层级分组结构
 * @method array getMultiLevelTree(array $data) 获取层级分组结构
 * @method array getLandingPageList(array $data) 获取页面分析-入口页面列表
 * @method array getShareUserList(array $data) 获取分享用户列表
 * @method array getVisitPageList(array $data) 获取页面分析-受访页面列表
 * @method array editPathDisplayName(array $data) 编辑页面路径显示名称
 * @method array batchCreateEvent(array $data) 批量创建事件
 * @method array editMiniApp(array $data) 编辑小程序数据源
 * @method array getShareOverview(array $data) 获取小程序某天的分享数据
 * @method array getSharePageOverview(array $data) 获取页面分享概况数据
 * @method array getAllPropertyValueCount(array $data) 获取某事件属性下全部属性值数据
 * @method array getEventOverview(array $data) 获取某自定义事件统计数据
 * @method array getEventProvertyList(array $data) 获取某自定义事件的属性列表
 * @method array getEventList(array $data) 获取自定义事件列表
 * @method array getChannelOverview(array $data) 获取某推广渠道的统计数据
 * @method array getCampaignOverview(array $data) 获取某推广活动的统计数据
 * @method array getSceneOverview(array $data) 获取某场景值的统计数据
 * @method array getAppList(array $data) 获取用户的小程序列表及数量
 * @method array createMiniApp(array $data) 新建小程序数据源
 * @method array getOverview(array $data) 获取应用概况数据
 * @method array getTotalUser(array $data) 获取应用的累计用户数
 */
class UMini
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
            'getH5ElementValueList' => [1, 'umeng.umini.h5.getElementValueList'],
            'getH5ElementList' => [1, 'umeng.umini.h5.getElementList'],
            'getH5SceneOverview' => [1, 'umeng.umini.h5.getSceneOverview'],
            'createCampaign' => [1, 'umeng.umini.createCampaign'],
            'getSceneInfoList' => [1, 'umeng.umini.getSceneInfoList'],
            'getRetentionByDataSourceId' => [1, 'umeng.umini.getRetentionByDataSourceId'],
            'getCustomerSourceOverview' => [1, 'umeng.umini.getCustomerSourceOverview'],
            'getMultiIndiceList' => [1, 'umeng.umini.getMultiIndiceList'],
            'getMultiOverview' => [1, 'umeng.umini.getMultiOverview'],
            'initMultiLevelTree' => [1, 'umeng.umini.initMultiLevelTree'],
            'getMultiLevelTree' => [1, 'umeng.umini.getMultiLevelTree'],
            'getLandingPageList' => [1, 'umeng.umini.getLandingPageList'],
            'getShareUserList' => [1, 'umeng.umini.getShareUserList'],
            'getVisitPageList' => [1, 'umeng.umini.getVisitPageList'],
            'editPathDisplayName' => [1, 'umeng.umini.editPathDisplayName'],
            'batchCreateEvent' => [1, 'umeng.umini.batchCreateEvent'],
            'editMiniApp' => [1, 'umeng.umini.editMiniApp'],
            'getShareOverview' => [1, 'umeng.umini.getShareOverview'],
            'getSharePageOverview' => [1, 'umeng.umini.getSharePageOverview'],
            'getAllPropertyValueCount' => [1, 'umeng.umini.getAllPropertyValueCount'],
            'getEventOverview' => [1, 'umeng.umini.getEventOverview'],
            'getEventProvertyList' => [1, 'umeng.umini.getEventProvertyList'],
            'getEventList' => [1, 'umeng.umini.getEventList'],
            'getChannelOverview' => [1, 'umeng.umini.getChannelOverview'],
            'getCampaignOverview' => [1, 'umeng.umini.getCampaignOverview'],
            'getSceneOverview' => [1, 'umeng.umini.getSceneOverview'],
            'getAppList' => [1, 'umeng.umini.getAppList'],
            'createMiniApp' => [1, 'umeng.umini.createMiniApp'],
            'getOverview' => [1, 'umeng.umini.getOverview'],
            'getTotalUser' => [1, 'umeng.umini.getTotalUser'],
        };

        $data = $arguments[0] ?? [];

        return $this->request($version, $function, is_array($data) ? $data : []);
    }

    /**
     * @throws UMengException
     */
    protected function request(int|string $version, string $function, array $params = []): array
    {
        return $this->http->request($version, 'com.umeng.umini', $function, $params);
    }
}
