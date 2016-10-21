# daily-disk-check

windows磁盘空间检查脚本

通过此脚本可以实现对多台windows主机的磁盘空间的监测。

程序分为两部分：

1、daily_disk_check.bat   客户端   在要监测的主机上定时执行

2、diskspace.php   服务端  网页上打开即可 （没有美化）

客户端记得先建好日志保存文件夹"C:\diskspace\logs"。

服务端搭建一个php的web服务器还有个FTP服务器。有一键搭建工具网上很多。

博文地址：http://zpblog.cn/windows/windows-disk-check.html
