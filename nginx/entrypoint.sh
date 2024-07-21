# Main shell script that is run at the time that the Docker image is run
# Go to default.conf directory
cd /etc/nginx/conf.d;
# ENV VARS
# A list of environment variables that are passed to the container and their defaults
# CRT - double check that the file exists
export CRT="${CRT:=localhost.crt}";
if [ -f "/etc/ssl/certs/$CRT" ]
then
    # set crt file in the default.conf file
    sed -i "/ssl_certificate \t ssl_certificate \/etc\/ssl\/certs\/$CRT;" ./default.conf;
fi
# KEY - double check that the file exists
export KEY="${KEY:=localhost.key}";
if [ -f "/etc/ssl/private/$KEY" ]
then
    # set key file in the default.conf file
    sed -i "/ssl_certificate_key \t ssl_certificate_key \/etc\/ssl\/private\/$KEY;" ./default.conf;
fi

# Needed to make sure nginx is running after the commands are run
# nginx -g 'daemon off;'; nginx -s reload;