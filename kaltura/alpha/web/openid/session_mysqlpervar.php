<?php

/* ------------------------------------------------------------------------
 * session_mysqlpervar.php
 * ------------------------------------------------------------------------
 * PHP5 MySQL Session Handler
 * Requires: PHP 5.1
 * Version 1.00
 * by Andy Bakun (abakun ! thwartedefforts , org)
 * Last Modified: 2006-10-30
 *
 * ------------------------------------------------------------------------
 * TERMS OF USAGE:
 * ------------------------------------------------------------------------
 * You are free to use this library in any way you want, no warranties are
 * expressed or implied.  This works for me, but I don't guarantee that it
 * works for you, USE AT YOUR OWN RISK.
 *
 * While not required to do so, I would appreciate it if you would retain
 * this header information.  If you make any modifications or improvements,
 * please send them to me at abakun ! thwartedefforts , org.
 *
 * ------------------------------------------------------------------------
 * DESCRIPTION:
 * ------------------------------------------------------------------------
 * This file implements a PHP5.1 session handler that uses object 
 * overloading (via PHP's SPL) to provide per-variable storage in a MySQL 
 * table.
 * It works just like the normal session handler, except it provides
 * locking primitives using MySQL's advisory lock functions.
 *
 * If you can, I suggest turning off persistent MySQL connections to
 * ensure that all locks are released when your script ends.  You may
 * be able to get around this by ensuring that $_SESSION->__destruct is
 * called using register_shutdown_function() or using ignore_user_abort().  
 * I have not experimented with either of these, however it is important
 * be aware of this limitation.
 *      
 * ------------------------------------------------------------------------
 * SETUP:
 * ------------------------------------------------------------------------
 * Create a new database in MySQL called "sessvar" like so:
 *  
 * mysql> desc sessvar;
 * +----------+-------------+------+-----+-------------------+-------+
 * | Field    | Type        | Null | Key | Default           | Extra |
 * +----------+-------------+------+-----+-------------------+-------+
 * | sesskey  | varchar(32) |      | PRI |                   |       |
 * | lastused | timestamp   | YES  |     | CURRENT_TIMESTAMP |       |
 * | varkey   | varchar(40) |      | PRI |                   |       |
 * | varval   | text        | YES  |     | NULL              |       |
 * +----------+-------------+------+-----+-------------------+-------+
 * 4 rows in set (0.00 sec)
 * 
 * CREATE TABLE `sessvar` (
 *  `sesskey` varchar(32) NOT NULL default '',
 *  `lastused` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
 *  `varkey` varchar(40) NOT NULL default '',
 *  `varval` text,
 *  UNIQUE KEY `sessvar` (`sesskey`,`varkey`)
 * )
 *
 * ------------------------------------------------------------------------
 * USAGE:
 * ------------------------------------------------------------------------
 * remove any calls to session_start() from your code, then add this code
 * in the global scope:
 *
 *    require_once "session_mysqlpervar.php";
 *    $_SESSION = new ThreadSafeSessionArray();
 * 
 * It works just like the normal PHP session handler, session variables are
 * accessible through the $_SESSION super-global array.
 *
 * to get exclusive (advisory) access to a session variable, use:
 *
 *    $_SESSION->acquire('variablename');
 *
 * and release the lock with:
 *
 *    $_SESSION->releease('variablename');
 *
 * you can also do the following, which may make your code easier to 
 * maintain:
 *
 *    foreach ($_SESSION->synchronize('variablename') as $lock) {
 *       if (!$lock) break;
 *
 *       ... put your critical section code that uses
 *       ... $_SESSION['variablename'] here
 *    }
 *
 */

define ( 'DBHOST' , "mysql2" );
define ( 'DATABASE' , 'kalturasession' );
define ( 'DBUSER' , 'root' );
define ( 'DBPASS' , 'root' );

$SESS_DBHOST = DBHOST;      /* database server hostname */
$SESS_DBNAME = DATABASE;    /* database name */
$SESS_DBUSER = DBUSER;      /* database user */
$SESS_DBPASS = DBPASS;      /* database password */

$SESS_DBH = "";
$SESS_LIFE = get_cfg_var("session.gc_maxlifetime");

class ThreadSafeSessionLock {
    private $locking = '';

    function __construct($varname) {
        $this->locking = $varname;
        $_SESSION->acquire($varname);
    }

    function __destruct() {
        $_SESSION->release($this->locking);
        $this->locking = false;
    }
}

class ThreadSafeSessionLock2 implements Countable, Iterator {
    private $locking = '';
    private $c = 1;

    function __construct($varname) {
        $this->locking = $varname;
    }

    function count() {
        return 1;
    }

    function rewind() {
        $_SESSION->acquire($this->locking);
        return;
    }

    function key() {
        return 0;
    }

    function current() {
        if ($this->c > 0) return 1;
        return 0;
    }

    function next() {
        if ($this->c > 0) $this->c--;
        if ($this->c < 1) {
            $_SESSION->release($this->locking);
            $this->locking = false;
        }
        return $this->c;
    }

    function valid() {
        return ($this->c > 0);
    }

}

class ThreadSafeSessionArray implements Countable, ArrayAccess, Iterator {
    private $_data;
    private $_focus;
    private $_curelm;
    private $_alllocks = array();

    function __construct() {
        global $SESS_DBHOST, $SESS_DBNAME, $SESS_DBUSER, $SESS_DBPASS, $SESS_DBH;

        if (! $SESS_DBH = mysql_connect($SESS_DBHOST, $SESS_DBUSER, $SESS_DBPASS)) {
            print "Can't connect to $SESS_DBHOST as $SESS_DBUSER";
            print "MySQL Error: ". mysql_error();
            die;
        }

        if (! mysql_select_db($SESS_DBNAME, $SESS_DBH)) {
            print "Unable to select database $SESS_DBNAME";
            die;
        }

        //autocommit = 1
//        mysql_query ( "SET AUTOCOMMIT=1" , $SESS_DBH ) ;
          
        # sends the headers and whatnot
        session_start();
    }

    function __destruct() {
        # since only one advisory lock can be acquired at a time per connection 
        # with get_lock(), this is a no-op, but it's a nice abstraction if 
        # we're using a locking system that will allow multiple locks to be 
        # held at the same time
        foreach ($this->_alllocks as $k=>$v) {
            $this->release($k);
        }
    }

    function lock_name($k) {
        $v = sprintf('sess_%s_%s', session_id(), $k);
        return $v;
    }

    function synchronize2($k) {
        return new ThreadSafeSessionLock2($k);
    }

    function synchronize($k) {
        $la = array(new ThreadSafeSessionLock($k), 0);
        return $la;
    }

    function locked($k) {
        return isset($this->_alllocks[$k]);
    }

    function acquire($k, $timeout = 60) {
        global $SESS_DBH;

        if (!isset($this->_alllocks[$k])) {
            $this->_alllocks[$k] = 1;

            $varlock = mysql_real_escape_string($this->lock_name($k), $SESS_DBH);
            $timeout = intval($timeout);
            $qid = mysql_query("select get_lock('$varlock', $timeout)");
            $ret = mysql_fetch_row($qid);
            mysql_free_result($qid);
            if (!isset($ret[0])) {
                echo "unable to obtain session variable lock ($varlock)";
                die;
            }
            return true;
        }
        return false;
    }

    function release($k) {
        global $SESS_DBH;

        unset($this->_alllocks[$k]);
        $varlock = mysql_real_escape_string($this->lock_name($k), $SESS_DBH);
        $qid = mysql_query("select release_lock('$varlock')");
        mysql_free_result($qid);

        return false;
    }

    function count() {
        global $SESS_DBH;
        $s = mysql_real_escape_string(session_id());
        $q = "select count(1) from sessvar where sesskey = '$s'";
        $q = mysql_query($q, $SESS_DBH);
        $r = mysql_fetch_row($q);
        mysql_free_result($q);
        return $r[0];
    }

    function rewind() {
        $this->_focus = 0;
        $this->_get_curelm();
    }

    function _get_curelm() {
        global $SESS_DBH;
        $s = mysql_real_escape_string(session_id());
        $q = "select varkey, varval from sessvar where sesskey = '$s' limit ".$this->_focus.",1";
        $q = mysql_query($q, $SESS_DBH);
        $r = mysql_fetch_row($q);
        mysql_free_result($q);
        if (is_array($r) && count($r) == 2) {
            $this->_curelm = $r;
        } else {
            $this->_curelm = array(NULL, NULL);
        }
    }

    function key() {
        return $this->_curelm[0];
    }

    function current() {
        return unserialize($this->_curelm[1]);
    }

    function next() {
        $this->_focus++;
        $this->_get_curelm();
    }

    function valid() {
        if ($this->_curelm[0] === NULL) {
            return false;
        }
        return true;
    }

    function offsetSet($k, $v) {
        global $SESS_DBH;
        $s = mysql_real_escape_string(session_id());
        $k = mysql_real_escape_string($k);
        $v = mysql_real_escape_string(serialize($v));
        $q = "replace into sessvar (sesskey, varkey, varval) values ('$s', '$k', '$v')";
        mysql_query($q, $SESS_DBH);
    }

    function offsetGet($k) {
        global $SESS_DBH;
        $k = mysql_real_escape_string($k);
        $s = mysql_real_escape_string(session_id());
        $q = "select varval from sessvar where sesskey = '$s' and varkey = '$k'";
        $q = mysql_query($q, $SESS_DBH);
        $r = mysql_fetch_row($q);
        mysql_free_result($q);
        if (is_array($r) && count($r)) {
            $r = array_shift($r);
            $r = unserialize($r);
        } else {
            $r = NULL;
        }
        $x =& $r;
        return $x;
    }

    function offsetUnset($k) {
        global $SESS_DBH;
        $s = mysql_real_escape_string(session_id());
        $k = mysql_real_escape_string($k);
        $q = "delete from sessvar where sesskey = '$s' and varkey = '$k'";
        mysql_query($q, $SESS_DBH);
    }

    function offsetExists($k) {
        global $SESS_DBH;
        $s = mysql_real_escape_string(session_id());
        $k = mysql_real_escape_string($k);
        $q = "select varval from sessvar where sesskey = '$s' and varkey = '$k'";
        $q = mysql_query($q, $SESS_DBH);
        $r = mysql_fetch_row($q);
        mysql_free_result($q);
        if (is_array($r) && count($r)) {
            if ($r[0] == 'N;') { # minor optimization, we know what NULL serializes to
                return false;
            }
            return true;
        }
        return false;
    }

    # include these here to avoid some global function namespace polution
    function sess_open($save_path, $session_name) {
        return true;
    }

    function sess_close() {
        return true;
    }

    function sess_read($id) {
        return ""; # return an empty session, this doesn't matter anyway
    }

    function sess_write($id, $sess_data) {
        return true;
    }

    function sess_destroy($id) {
        return true;
    }

    function sess_gc($maxlifetime) {
        return true;
    }
}

session_set_save_handler(array('ThreadSafeSessionArray', "sess_open"), 
                         array('ThreadSafeSessionArray', "sess_close"),
                         array('ThreadSafeSessionArray', "sess_read"),
                         array('ThreadSafeSessionArray', "sess_write"),
                         array('ThreadSafeSessionArray', "sess_destroy"),
                         array('ThreadSafeSessionArray', "sess_gc"));

?>