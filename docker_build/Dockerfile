FROM kalilinux/kali-last-release
RUN apt update && apt -y install sudo acl cron apache2 nano python3 xz-utils php php-mysql
COPY assets /assets
RUN bash /assets/setup.sh
EXPOSE 80
ENTRYPOINT bash /assets/startup.sh 
STOPSIGNAL SIGKILL