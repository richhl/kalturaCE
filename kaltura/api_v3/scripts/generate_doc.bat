cd c:\web\kaltura\api_v3\

phpdoc -tb "phpDocumentor" --output "HTML:frames:earthli" -ct filter,readonly -d lib,services  --ignore .svn/* -t web\docs -ti "Kaltura API do cumentation" -po api -q

cd c:\web\kaltura\api_v3\scripts