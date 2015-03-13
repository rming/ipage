# ipage
&emsp;&emsp;&emsp;&emsp;基于 DNSPod API 的域名解析管理系统，可以分享二级域名给注册用户，前提是你有个还算有意思的顶级域名，比如 `about.me`  etc. 

####要求
- 一个待分享的顶级域名
- 独立 IP 的 VPS
- 一些 `WEB` 开发常识

####部署
1. 部署代码，导入数据库  
2. 要分享的域名 **泛解析** 到该服务器 IP  
3. 设置 `vhost` 支持泛解析  
4. 设置 `crontab` 跑脚本 `/j/resolve_domains`，频率自定 
5. 注册账户，解析域名

####已知 BUG
- 一次设置多个域名的时候会出现`FORM` 提交问题
