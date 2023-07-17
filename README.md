# OpenAI/ChatGPT 免翻墙代理
据很多朋友反应，OpenAI 检测到中国的 API 访问时，会直接限制访问或者封号。最近正好遇到这个问题，利用国内的腾讯云函数快速的搭建了一个代理，用于访问 OpenAI/ChatGPT 的 API。

## 安装步骤如下：

### 一、创建云函数

函数类型：web云函数

地域：选择支持openai的地域就可以，这里我选择的新加坡

运行环境：php7.4

函数代码：本地上传文件夹即可

<img width="1276" alt="image" src="https://github.com/niemingxing/openai_proxy/assets/7400829/ef923675-5036-4c20-a1cd-a848708ec189">

### 二、发布与代码切换

部署切换：部署成功后、获取云函数地址，替换成代码里面openai sdk，baseUrl或者customUrl 即可。

![carbon (39)](https://github.com/niemingxing/openai_proxy/assets/7400829/af3af679-90e7-4d16-9cc4-d8452655c9b1)

## 联系方式：

![微信](https://i.ibb.co/hMbTs1G/a3779b33-bfe2-4ff9-a592-f0ec090a3055-1-2.jpg)
