sudo systemctl status tools-farpse


````pash
# https://pypi.org/project/vping/
pip3 install vping

# https://pypi.org/project/python-whois/
pip3 install python-whois

# 
pip3 install PySocks

# https://www.ip2location.com/developers/python
wget https://github.com/chrislim2888/IP2Location-Python/archive/master.zip
unzip master.zip 
cd IP2Location-Python-master
python3 setup.py build
python3 setup.py install

# https://blog.miguelgrinberg.com/post/the-flask-mega-tutorial-part-iv-database
pip3 install flask-sqlalchemy
pip3 install flask-migrate

pip3 install python-dotenv

pip3 install flask-login

````

````bash
export FLASK_APP=app.py
flask run
````
https://www.digitalocean.com/community/tutorials/how-to-serve-flask-applications-with-gunicorn-and-nginx-on-ubuntu-18-04
https://www.8host.com/blog/obsluzhivanie-prilozhenij-flask-s-pomoshhyu-gunicorn-i-nginx-v-ubuntu-16-04/

```bash
pip3 install gunicorn
gunicorn app:app
```

```ini
server {
    listen 80;
    server_name tool.farpse.com;
 
    root /var/www/tool.farpse.com;
 
    access_log /var/log/access-tool.farpse.com.log;
    error_log /var/log/error-tool.farpse.com.log;
 
    location / {
        proxy_set_header X-Forward-For $proxy_add_x_forwarded_for;
        proxy_set_header Host $http_host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_redirect off;
        if (!-f $request_filename) {
            proxy_pass http://127.0.0.1:8000;
            break;
        }
    }
}
```

http://docs.gunicorn.org/en/stable/deploy.html


http://flask.pocoo.org/docs/1.0/quickstart/#a-minimal-application

http://jinja.pocoo.org/docs/2.10/templates/


npm install -g vue-cli

-------------------------------

## Install

``` bash
# git clone
# create virtual env
python3 -m venv env
source env/bin/activate
# install python modules
pip3 install -r requirements.txt
deactivate
```

## Start up
```
# setup database
python manage.py deploy
# create roles and Admin user
python manage.py initrole
# start development server
python manage.py runserver
```
Bingo! Check app in your web browser at: http://localhost:5000, and http://localhost:5000/admin

## deploy to Heroku Server
ready for deploy to [Heroku](https://www.heroku.com), `Procfile` and `runtime.txt` are included.
```
# create app in heroku
# git push to heroku
# configure env. variables
# init database by using manage.py
```
for details, refer to: https://devcenter.heroku.com/articles/getting-started-with-python

## Expansion
For production app, you can easily expand functions as you wish, such as:
- Flask_Compress
- Flask_Cache
- Flask_Redis


> For a detailed explanation on how things work, check out the [guide (CHN)](https://www.jianshu.com/p/f37871e31231).



