#del /F /S /Q ..\cache\api_v3\*
#del /F /S /Q ..\cache\generator\*

php generate.php

xcopy /Y /S /R C:\web\content\clientlibs\adminConsoleClient\* ..\admin_console\lib\Kaltura
xcopy /Y /S /R C:\web\content\clientlibs\batchClient\* ..\batch\client