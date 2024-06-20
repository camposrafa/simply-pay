FROM php:8.2-fpm

ARG PROGRAM_NAME="laravel_worker"
ENV PROGRAM_NAME ${PROGRAM_NAME}

ARG PROCESS_NUM=8
ENV PROCESS_NUM ${PROCESS_NUM}

ARG QUEUE_CONNECTION="sync"
ENV QUEUE_CONNECTION ${QUEUE_CONNECTION}

ARG QUEUES="default"
ENV QUEUES ${QUEUES}

ARG TIMEOUT=0
ENV TIMEOUT ${TIMEOUT}

ARG MAX_TIME=3600
ENV MAX_TIME ${MAX_TIME}

ARG LOG_FILE="queue_worker"
ENV LOG_FILE ${LOG_FILE}

USER root

RUN apt-get update && apt-get install -y supervisor

RUN mkdir -p /var/log/supervisor

COPY build/super/template.conf /etc/supervisor/conf.d/supervisord.conf
COPY build/super/setup.sh /setup.sh

RUN chmod +x /setup.sh && /bin/bash -c "/setup.sh"

CMD ["/usr/bin/supervisord"]
