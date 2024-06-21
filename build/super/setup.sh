#!/bin/bash

sed -i 's/PROGRAM_NAME/'"$PROGRAM_NAME"'/g;
        s/PROCESS_NUM/'"$PROCESS_NUM"'/g;
        s/QUEUE_CONNECTION/'"$QUEUE_CONNECTION"'/g;
        s/QUEUES/'"$QUEUES"'/g;
        s/TIMEOUT/'"$TIMEOUT"'/g;
        s/MAX_TIME/'"$MAX_TIME"'/g;
        s/LOG_FILE/'"$LOG_FILE"'/g ' \
        /etc/supervisor/conf.d/supervisord.conf
