#!/bin/bash

PIDFILE=/var/run/$0.pid
COMMAND="@APP_DIR@/plugins/sphinx_search/scripts/watch.daemon.sh -u root"

# Source function library
#. /etc/rc.d/init.d/functions

start() {
        echo -n "Starting Sphinx Watch Daemon: "
        pgrep watch.daemon.sh  2>&1>/dev/null
        if [ $? -eq  0 ]; then
                 echo "NOT OK"
                 echo
                 exit 2;
        fi
        setsid $COMMAND &
        echo OK
    echo
}

stop() {
        echo -n "Stopping Sphinx Watch Daemon: "
        pkill watch.daemon.sh
        if [ $? -ne  0 ]; then
                echo "NOT OK"
                echo
                exit 2;
        fi
        echo "OK"
}

case "$1" in
  start)
        start
        ;;
  stop)
        stop
        ;;
  restart)
        stop
        start
        ;;
  *)
        echo "Usage: {start|stop|restart}"
        exit 1
esac

exit 0