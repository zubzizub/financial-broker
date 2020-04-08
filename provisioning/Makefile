ssh:
	ssh-copy-id -i ~/.ssh/id_rsa.pub root@89.223.29.115

site:
	ansible-playbook -i hosts.yml site.yml

upgrade:
	ansible-playbook -i hosts.yml upgrade.yml

authorize:
	ansible-playbook -i hosts.yml authorize.yml

docker-login:
	ansible-playbook -i hosts.yml docker-login.yml
