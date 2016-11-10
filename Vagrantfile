Vagrant.configure("2") do |config|

  config.vm.box = "CentOS6.7"
  config.vm.define "CentOS6 APM"
  
  config.vm.network "forwarded_port", guest: 80, host: 8080

  config.vm.provision "shell", inline: <<-SHELL
    yum -y install httpd httpd-devel
    chkconfig --levels 235 httpd on
    sed -i 's#/var/www/html#/vagrant/www#' /etc/httpd/conf/httpd.conf
    sed -i 's/User apache/User vagrant/' /etc/httpd/conf/httpd.conf
    sed -i 's/Group apache/Group vagrant/' /etc/httpd/conf/httpd.conf
    sed -i 's/AllowOverride None/AllowOverride AuthConfig Limit FileInfo Options/' /etc/httpd/conf/httpd.conf
    sed -i 's/LanguagePriority en ca cs da de el eo es et fr he hr it ja ko ltz nl nn no pl pt pt-BR ru sv zh-CN zh-TW/LanguagePriority en ko ca cs da de el eo es et fr he hr it ja ltz nl nn no pl pt pt-BR ru sv zh-CN zh-TW/' /etc/httpd/conf/httpd.conf
    echo -e "\n\nSetOutputFilter DEFLATE\n" >> /etc/httpd/conf/httpd.conf
    yum -y install php php-mysql php-gd php-imap php-ldap php-odbc php-pear php-xml php-xmlrpc
    yum -y install php-mbstring php-mcrypt
    sed -i 's/short_open_tag = Off/short_open_tag = On/' /etc/php.ini
    sed -i 's/display_errors = Off/display_errors = On/' /etc/php.ini
    sed -i 's/error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT/error_reporting = E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING/' /etc/php.ini
    sed -i 's#;date.timezone =#date.timezone = Asia/Seoul#' /etc/php.ini
    echo -e "start on vagrant-mounted\nexec service httpd start" > /etc/init/vagrant-mounted.conf
    service httpd restart
    iptables -D INPUT -j REJECT --reject-with icmp-host-prohibited
    iptables -A INPUT -p tcp -m state --state NEW -m tcp --dport 80 -j ACCEPT
    iptables -A INPUT -p tcp -m state --state NEW -m tcp --dport 3306 -j ACCEPT
    iptables -A INPUT -j REJECT --reject-with icmp-host-prohibited
    service iptables save
    service iptables restart
    sed -i 's/^SELINUX=enforcing/SELINUX=disabled/' /etc/selinux/config
    setenforce 0
  SHELL

end
