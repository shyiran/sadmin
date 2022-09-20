<?php /*a:3:{s:47:"D:\SwiftAdmin\app\admin\view\index\monitor.html";i:1663670423;s:47:"D:\SwiftAdmin\app\admin\view\public\header.html";i:1659669829;s:47:"D:\SwiftAdmin\app\admin\view\public\footer.html";i:1659669829;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SwiftAdmin 后台管理开发框架</title>
	<link href="/favicon.ico" rel="icon">
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="/static/system/layui/css/layui.css?v=<?php echo release(); ?>" rel="stylesheet" type="text/css" />
	 <link href="/static/system/css/style.css?v=<?php echo release(); ?>" rel="stylesheet" type="text/css" />
	<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<script>
	var _global_ = {
		app: "<?php echo htmlentities((isset($app) && ($app !== '')?$app:'admin.php')); ?>",
		controller: "<?php echo htmlentities((isset($controller) && ($controller !== '')?$controller:'index')); ?>",
		action: "<?php echo htmlentities((isset($action) && ($action !== '')?$action:'index')); ?>",
		api: "<?php echo config('app.api_url'); ?>"
	};

	var _upload_chunkSize =  <?php echo saenv('upload_chunk_size'); ?>;
</script>

<body>
<!-- 正文开始 -->
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-xs12 layui-col-md8">
            <div class="layui-card" style="">
                <div class="layui-card-header">活动实时交易情况</div>
                <div class="layui-card-body">
                    <div class="layui-row">
                        <div class="layui-col-xs12 layui-col-sm6 layui-col-lg3 text-center">
                            <div class="numberInfoSubTitle">今日交易总额</div>
                            <div class="numberInfoValue"> 124,543,233<em class="numberInfoSuffix">元</em></div>
                        </div>
                        <div class="layui-col-xs12 layui-col-sm6 layui-col-lg3 text-center">
                            <div class="numberInfoSubTitle">销售目标完成率</div>
                            <div class="numberInfoValue">92%</div>
                        </div>
                        <div class="layui-col-xs12 layui-col-sm6 layui-col-lg3 text-center">
                            <div class="numberInfoSubTitle">活动剩余时间</div>
                            <div class="numberInfoValue">00:57:10</div>
                        </div>
                        <div class="layui-col-xs12 layui-col-sm6 layui-col-lg3 text-center">
                            <div class="numberInfoSubTitle">每秒交易总额</div>
                            <div class="numberInfoValue">234<em class="numberInfoSuffix">元</em></div>
                        </div>
                    </div>
                    <div style="text-align: center;padding: 30px 0 10px 0;">
                        <img src="https://gw.alipayobjects.com/zos/rmsportal/HBWnDEUXCnGnGrRfrpKa.png" style="max-height: 437px; max-width: 100%;" alt="map">
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-col-xs12 layui-col-md4">
            <div class="layui-card">
                <div class="layui-card-header">活动情况预测</div>
                <div class="layui-card-body" style="height: 240px;overflow: hidden;">
                    <div id="hdqkyc" style="width: 100%;height: 260px;"></div>
                </div>
            </div>
            <div class="layui-card">
                <div class="layui-card-header">券核效率</div>
                <div class="layui-card-body" style="height: 222px;overflow: hidden;">
                    <div id="hjxl" style="width: 100%;height: 280px;margin-top: -20px;"></div>
                </div>
            </div>
        </div>
        <div class="layui-col-xs12">
            <div class="layui-card">
                <div class="layui-card-body">
                    <div class="layui-tab layui-tab-brief" lay-filter="tabZZT">
                        <ul class="layui-tab-title">
                            <li class="layui-this">销售额</li>
                            <li>访问量</li>
                        </ul>
                        <div class="layui-tab-content">
                            <div class="layui-tab-item layui-show">
                                <div class="layui-row layui-col-space30">
                                    <div class="layui-col-xs12 layui-col-md8">
                                        <div id="xse" style="height: 300px;margin-top: 20px;"></div>
                                    </div>
                                    <div class="layui-col-xs12 layui-col-md4">
                                        <table class="layui-table" lay-skin="nob">
                                            <colgroup>
                                                <col width="50">
                                                <col>
                                                <col width="96">
                                            </colgroup>
                                            <thead>
                                            <tr style="background: none;color: #333;">
                                                <th colspan="3">门店销售额排名</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><span class="layui-badge layui-bg-cyan">1</span></td>
                                                <td>工专路 0 号店</td>
                                                <td>323,234</td>
                                            </tr>
                                            <tr>
                                                <td><span class="layui-badge layui-bg-cyan">2</span></td>
                                                <td>工专路 1 号店</td>
                                                <td>323,234</td>
                                            </tr>
                                            <tr>
                                                <td><span class="layui-badge layui-bg-cyan">3</span></td>
                                                <td>工专路 2 号店</td>
                                                <td>323,234</td>
                                            </tr>
                                            <tr>
                                                <td><span class="layui-badge layui-bg-gray">4</span></td>
                                                <td>工专路 4 号店</td>
                                                <td>323,234</td>
                                            </tr>
                                            <tr>
                                                <td><span class="layui-badge layui-bg-gray">5</span></td>
                                                <td>工专路 5 号店</td>
                                                <td>323,234</td>
                                            </tr>
                                            <tr>
                                                <td><span class="layui-badge layui-bg-gray">6</span></td>
                                                <td>工专路 6 号店</td>
                                                <td>323,234</td>
                                            </tr>
                                            <tr>
                                                <td><span class="layui-badge layui-bg-gray">7</span></td>
                                                <td>工专路 7 号店</td>
                                                <td>323,234</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-tab-item">
                                <div class="layui-row layui-col-space30">
                                    <div class="layui-col-xs12 layui-col-md8">
                                        <div id="fwl" style="height: 300px;margin-top: 20px;"></div>
                                    </div>
                                    <div class="layui-col-xs12 layui-col-md4">
                                        <table class="layui-table" lay-skin="nob">
                                            <colgroup>
                                                <col width="50">
                                                <col>
                                                <col width="96">
                                            </colgroup>
                                            <thead>
                                            <tr style="background: none;color: #333;">
                                                <th colspan="3">门店访问量排名</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><span class="layui-badge layui-bg-cyan">1</span></td>
                                                <td>工专路 0 号店</td>
                                                <td>323,234</td>
                                            </tr>
                                            <tr>
                                                <td><span class="layui-badge layui-bg-cyan">2</span></td>
                                                <td>工专路 1 号店</td>
                                                <td>323,234</td>
                                            </tr>
                                            <tr>
                                                <td><span class="layui-badge layui-bg-cyan">3</span></td>
                                                <td>工专路 2 号店</td>
                                                <td>323,234</td>
                                            </tr>
                                            <tr>
                                                <td><span class="layui-badge layui-bg-gray">4</span></td>
                                                <td>工专路 4 号店</td>
                                                <td>323,234</td>
                                            </tr>
                                            <tr>
                                                <td><span class="layui-badge layui-bg-gray">5</span></td>
                                                <td>工专路 5 号店</td>
                                                <td>323,234</td>
                                            </tr>
                                            <tr>
                                                <td><span class="layui-badge layui-bg-gray">6</span></td>
                                                <td>工专路 6 号店</td>
                                                <td>323,234</td>
                                            </tr>
                                            <tr>
                                                <td><span class="layui-badge layui-bg-gray">7</span></td>
                                                <td>工专路 7 号店</td>
                                                <td>323,234</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- js部分 -->
<!--// 加载Markdown编辑器-->
<script src="/static/js/markdown/cherry-markdown.min.js?v=<?php echo release(); ?>"></script>
<link href="/static/js/markdown/cherry-markdown.css?v=<?php echo release(); ?>" rel="stylesheet" type="text/css"/>
<!--// 加载CommonJS-->
<script src="/static/system/layui/layui.js?v=<?php echo release(); ?>"></script>
<script src="/static/system/js/common.js?2v=<?php echo release(); ?>"></script>

<!-- // 全局加载第三方JS -->
<script src="/static/system/js/cascadata.js?v=<?php echo release(); ?>"></script>
<script src="/static/js/tinymce/tinymce.min.js?v=<?php echo release(); ?>"></script>
<script src="/static/system/module/xmselect/xmselect.js?v=<?php echo release(); ?>"></script>
<!-- // 加载font-awesome图标 -->
<link href="/static/system/layui/css/font-awesome.css?v=<?php echo release(); ?>" rel="stylesheet" type="text/css" />
<script src="/static/system/module/echarts/echarts.js"></script>

<script>
    layui.use(['layer','element'], function () {
        var $ = layui.jquery;
        var layer = layui.layer;
        var element = layui.element;

        // 渲染活动情况预测
        var myCharts = echarts.init(document.getElementById('hdqkyc'));
        var mData = [50, 100, 150, 80, 120, 150, 200, 250, 220, 250, 300, 350, 400, 380, 440, 450, 500, 550, 500];
        var option = {
            title: {
                text: '有望达到预期',
                subtext: '目标评估',
                textStyle: {
                    color: '#000'
                }
            },
            color: ['#1890ff','#666'], 
            tooltip: {
                trigger: "axis"
            },
            xAxis: [{
                type: "category",
                boundaryGap: !1,
                data: ["06:00", "06:30", "07:00", "07:30", "08:00", "08:30", "09:00", "09:30", "10:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00"]
            }],
            yAxis: [{
                type: "value"
            }],
            series: [{
                name: "金额",
                type: "line",
                smooth: !0,
                itemStyle: {
                    normal: {
                        areaStyle: {
                            type: "default"
                        }
                    }
                },
                data: mData
            }]
        };
        myCharts.setOption(option);

        // 动态改变图表1数据
        setInterval(function () {
            for (var i = 0; i < mData.length; i++) {
                mData[i] += (Math.random() * 50 - 25);
                if (mData[i] < 0) {
                    mData[i] = 0;
                }
            }
            myCharts.setOption({
                series: [{
                    data: mData
                }]
            });
        }, 1000);

        // 渲染券核效率图表
        var myCharts2 = echarts.init(document.getElementById('hjxl'));
        var option2 = {
            tooltip: {
                formatter: "{a} <br/>{b} : {c}%"
            },

            color: ['#1890ff','#666'],    
            series: [
                {
                    name: '券核效率',
                    type: 'gauge',
                    detail: {
                    	formatter: '{value}%',
                    	fontSize: 14,
                    	color: "#1890ff",
                    },
                    data: [{value: 80, name: '跳出率'}],
					axisLine: {
						lineStyle: {
							color: [[.2, "#2ec7c9"], [.8, "#5ab1ef"], [1, "#d87a80"]], 
							width: 10,
						}
					},
					splitLine: {
						length: 5, 
						lineStyle: {
							color: "auto"
						}
					},
					pointer: {
						width: 5
					},
                }
            ]
        };

        myCharts2.setOption(option2);

        // 设置定时案例
		setInterval(function () {
		    option2.series[0].data[0].value = (Math.random() * 100).toFixed(2) - 0;
		    myCharts2.setOption(option2, true);
		}, 2000);

        // 渲染销售额图表
        var myCharts3 = echarts.init(document.getElementById('xse'));
        var option3 = {
            title: {
                text: '销售趋势',
                textStyle: {
                    color: '#000',
                    fontSize: 14
                }
            },
            color: ['#1890ff','#666'],
            tooltip: {},
            grid: {
                left: '0',
                right: '0',
                bottom: '0',
                containLabel: true
            },
            xAxis: {
                data: ['1月', '2月', '3月', '4月', '6月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
                // show:false,
            },
            yAxis: {
                // show:false 
            },
            series: [{
                type: 'bar',
                data: [726, 1013, 690, 892, 982, 570, 536, 546, 988, 1002, 206, 506],
                barMaxWidth: 45
            }]
        };
        myCharts3.setOption(option3);

        // 渲染访问量图表
        var myCharts4 = echarts.init(document.getElementById('fwl'));
        var option4 = {
            title: {
                text: '访问量趋势',
                textStyle: {
                    color: '#000',
                    fontSize: 14
                }
            },
            tooltip: {},
            color: ['#1890ff','#666'],
            grid: {
                left: '0',
                right: '0',
                bottom: '0',
                containLabel: true
            },
            xAxis: {
                data: ['1月', '2月', '3月', '4月', '6月', '6月', '7月', '8月', '9月', '10月', '11月', '12月']
            },
            yAxis: {},
            series: [{
                type: 'bar',
                data: [558, 856, 880, 1325, 982, 856, 655, 546, 988, 985, 568, 302],
                barMaxWidth: 45
            }]
        };
        myCharts4.setOption(option4);

        // 切换选项卡重新渲染
        element.on('tab(tabZZT)', function (data) {
            if (data.index == 0) {
                myCharts3.resize();
            } else {
                myCharts4.resize();
            }
        });

        // 窗口大小改变事件
        window.onresize = function () {
            myCharts.resize();
            myCharts2.resize();
            myCharts3.resize();
            myCharts4.resize();
        };

    });
</script>
</body>

</html>