@echo off
::
set IPADDR=192.168.1.1
set FTPSVR=192.168.1.1
set FTPUSER=ftpuser
set FTPPASSWORD=123456
:: timestamp YYYY-MM-DD_HH-MM-SS
for /f "delims=" %%a in ('wmic OS Get localdatetime  ^| find "."') do set dt=%%a
set day=%dt:~0,8%
set time=%dt:~8,6%
::echo %day%-%time%
:: save dir
set saveDir="C:\diskspace\logs"
set RESULT=%saveDir%\%IPADDR%-%day%-%time%-diskspace.txt
echo IP:%IPADDR% > %RESULT%
echo PLATFORM:WINDOWS >> %RESULT%
:: daily_disk_check.bat
wmic logicaldisk Where DriveType="3" get caption,FreeSpace,size |find ":" >>%RESULT%
:: delete file for 7 days ago  
forfiles /P %saveDir% /M "*diskspace.txt" /D -7 /C "cmd /C del /Q /F @file"
echo open %FTPSVR% >upload.src
echo user %FTPUSER% %FTPPASSWORD% >>upload.src
echo lcd %saveDir% >>upload.src
echo bin >>upload.src
echo put %RESULT% >>upload.src
echo bye >>upload.src
ftp -n -s:upload.src
del /Q /F upload.src
