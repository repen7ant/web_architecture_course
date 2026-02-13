## 1. Создание виртуальной машины

_параметры VM_

![vm name](screenshots/01-vm-settings-name.png)

![vm ram](screenshots/01-vm-settings-ram.png)

![vm disk](screenshots/01-vm-settings-disk.png)

_командная строка после запуска_

![vm console](screenshots/02-vm-console.png)

## 2. Информация о системе

_вывод `cat ~/report/01-system.txt`_

![system info 1](screenshots/03-system-info-1.png)

![system info 2](screenshots/03-system-info-2.png)

![system info 3](screenshots/03-system-info-3.png)

## 3. Сеть: IP-адрес и открытые порты

_вывод `ip addr show`_

![ip addr](screenshots/04-ip-addr.png)

_вывод `sudo ss -tlnp`_

![ports](screenshots/05-ports.png)

## 4. Сервис SSH

_вывод `sudo systemctl status ssh`_

![ssh status](screenshots/06-ssh-status.png)

_вывод `sudo ss -tlnp | grep ssh`_

![ssh report](screenshots/07-ssh-port.png)

## 5. Пользователи и группы

_вывод `grep '/bin/bash' /etc/passwd`_

![users](screenshots/08-users-1.png)

![users](screenshots/08-users-2.png)

_процесс создания пользователя `boardy`_

![new user](screenshots/09-new-user.png)

_вывод `id boardy`_

![user check](screenshots/10-user-check.png)

## 6. Дерево каталогов

_вывод `ls -la /`_

![root tree](screenshots/11-root-tree.png)

_вывод `ls -la ~`_

![home tree](screenshots/12-home-tree.png)

## 7. Права доступа

_вывод `ls -ld / /etc /var /tmp /home`_

![permissions](screenshots/13-permissions.png)

_три состояния `testfile.txt` (до, после chmod 755, после chmod 600)_

![chmod](screenshots/14-chmod.png)

## 8. Установленные пакеты и сервисы

_вывод `dpkg -l | grep -E 'openssh|python3.12|git|curl|vim|nano'`_

**я добавил в команду версию для python, потому что иначе выводит слишком много пакетов**

![packages](screenshots/15-packages.png)

_вывод `systemctl list-units --type=service --state=running`_

![services](screenshots/16-services.png)

## 9. Конвейер и перенаправление

_вывод `ps aux --sort=-%mem | head -11`_

![top processes](screenshots/17-top-processes.png)

_вывод подсчёта процессов по пользователям_

![process count](screenshots/18-process-count.png)

_вывод топ-10 больших файлов в /var_

![big files](screenshots/19-big-files.png)

## 10. Итоговый файл

_вывод `ls -lh ~/report/`_

![report files](screenshots/20-report-files.png)
