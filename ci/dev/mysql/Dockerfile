FROM percona:5.6.27
RUN echo "Europe/Moscow" > /etc/timezone && dpkg-reconfigure --frontend noninteractive tzdata

COPY ./config/my.cnf /etc/mysql/my.cnf

EXPOSE 3306
CMD ["mysqld --initialize"]
