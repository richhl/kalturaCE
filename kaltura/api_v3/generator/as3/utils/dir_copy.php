<?php
 
 /* Copies a dir to another. Optionally caching the dir/file structure, used to synchronize similar destination dir (web farm).
     *
     * @param $src_dir str Source directory to copy. 
     * @param $dst_dir str Destination directory to copy to. 
     * @param $verbose bool Show or hide file copied messages
     * @param $use_cached_dir_trees bool Set to true to cache src/dst dir/file structure. Used to sync to web farms
     *                     (avoids loading the same dir tree in web farms; making sync much faster). 
     * @return Number of files copied/updated.
     * @example 
     *     To copy a dir: 
     *         dircopy("c:\max\pics", "d:\backups\max\pics"); 
     *
     *     To sync to web farms (webfarm 2 to 4 must have same dir/file structure (run once with cache off to make sure if necessary)): 
     *        dircopy("//webfarm1/wwwroot", "//webfarm2/wwwroot", false, true); 
     *        dircopy("//webfarm1/wwwroot", "//webfarm3/wwwroot", false, true); 
     *        dircopy("//webfarm1/wwwroot", "//webfarm4/wwwroot", false, true); 
     */
    function dircopy($src_dir, $dst_dir, $verbose = false, $use_cached_dir_trees = false) 
    {    
        static $cached_src_dir;
        static $src_tree; 
        static $dst_tree;
        $num = 0;

        if (($slash = substr($src_dir, -1)) == "\\" || $slash == "/") $src_dir = substr($src_dir, 0, strlen($src_dir) - 1); 
        if (($slash = substr($dst_dir, -1)) == "\\" || $slash == "/") $dst_dir = substr($dst_dir, 0, strlen($dst_dir) - 1);  

        if (!$use_cached_dir_trees || !isset($src_tree) || $cached_src_dir != $src_dir)
        {
            $src_tree = get_dir_tree($src_dir);
            $cached_src_dir = $src_dir;
            $src_changed = true;  
        }
        if (!$use_cached_dir_trees || !isset($dst_tree) || $src_changed)
            $dst_tree = get_dir_tree($dst_dir);
        if (!is_dir($dst_dir)) mkdir($dst_dir, 0777, true);  

          foreach ($src_tree as $file => $src_mtime) 
        {
            if (!isset($dst_tree[$file]) && $src_mtime === false) // dir
                mkdir("$dst_dir/$file"); 
            elseif (!isset($dst_tree[$file]) && $src_mtime || isset($dst_tree[$file]) && $src_mtime > $dst_tree[$file])  // file
            {
                if (copy("$src_dir/$file", "$dst_dir/$file")) 
                {
                    if($verbose) echo "Copied '$src_dir/$file' to '$dst_dir/$file'<br>\r\n";
                    touch("$dst_dir/$file", $src_mtime); 
                    $num++; 
                } else 
                    echo "<font color='red'>File '$src_dir/$file' could not be copied!</font><br>\r\n";
            }        
        }

        return $num; 
    }

    /* Creates a directory / file tree of a given root directory
     *
     * @param $dir str Directory or file without ending slash
     * @param $root bool Must be set to true on initial call to create new tree. 
     * @return Directory & file in an associative array with file modified time as value. 
     */
    function get_dir_tree($dir, $root = true) 
    {
        static $tree;
        static $base_dir_length; 

        if ($root)
        { 
            $tree = array();  
            $base_dir_length = strlen($dir) + 1;  
        }

        if (is_file($dir)) 
        {
            //if (substr($dir, -8) != "/CVS/Tag" && substr($dir, -9) != "/CVS/Root"  && substr($dir, -12) != "/CVS/Entries")
            $tree[substr($dir, $base_dir_length)] = filemtime($dir); 
        } elseif (is_dir($dir) && $di = dir($dir)) // add after is_dir condition to ignore CVS folders: && substr($dir, -4) != "/CVS"
        {
            if (!$root) $tree[substr($dir, $base_dir_length)] = false;  
            while (($file = $di->read()) !== false) 
                if ($file != "." && $file != "..")
                    get_dir_tree("$dir/$file", false);  
            $di->close(); 
        }

        if ($root)
            return $tree;     
    }

?>
