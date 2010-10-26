SELECT CONCAT('rename table ', table_name, ' to ' , UPPER(table_name) , ';') 
FROM information_schema.tables WHERE table_schema = 'kalturaetl';