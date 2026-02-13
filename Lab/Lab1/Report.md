## 1. Создание виртуальной машины

<div style="text-align: center;">
_параметры VM_
![vm name](screenshots/01-vm-settings-name.png)
![vm ram](screenshots/01-vm-settings-ram.png)
![vm disk](screenshots/01-vm-settings-disk.png)
</div>

<div style="text-align: center;">
_командная строка после запуска_
![vm console](screenshots/02-vm-console.png)
</div>

## 2. Информация о системе

<div style="text-align: center;">
_вывод `cat ~/report/01-system.txt`_
![system info 1](screenshots/03-system-info-1.png)
![system info 2](screenshots/03-system-info-2.png)
![system info 3](screenshots/03-system-info-3.png)
</div>

## 3. Сеть: IP-адрес и открытые порты

<div style="text-align: center;">
_вывод `ip addr show`_
![ip addr](screenshots/04-ip-addr.png)
</div>

<div style="text-align: center;">
_вывод `sudo ss -tlnp`_
![ports](screenshots/05-ports.png)
</div>

## 4. Сервис SSH

<div style="text-align: center;">
_вывод `sudo systemctl status ssh`_
![ssh status](screenshots/06-ssh-status.png)
</div>

<div style="text-align: center;">
_вывод `sudo ss -tlnp | grep ssh`_
![ssh report](screenshots/07-ssh-port.png)
</div>

## 5. Пользователи и группы

<div style="text-align: center;">
_вывод `grep '/bin/bash' /etc/passwd`_
![users](screenshots/08-users.png)
</div>

<div style="text-align: center;">
_процесс создания пользователя `boardy`_
![new user](screenshots/09-new-user.png)
</div>

<div style="text-align: center;">
_вывод `id boardy`_
![user check](screenshots/10-user-check.png)
</div>

## 6. Дерево каталогов

<div style="text-align: center;">
_вывод `ls -la /`_
![root tree](screenshots/11-root-tree.png)
</div>

<div style="text-align: center;">
_вывод `ls -la ~`_
![home tree](screenshots/12-home-tree.png)
</div>

## 7. Права доступа

<div style="text-align: center;">
_вывод `ls -ld / /etc /var /tmp /home`_
![permissions](screenshots/13-permissions.png)
</div>

<div style="text-align: center;">
_три состояния `testfile.txt` (до, после chmod 755, после chmod 600)_
![chmod](screenshots/14-chmod.png)
</div>

## 8. Установленные пакеты и сервисы

<div style="text-align: center;">
_вывод `dpkg -l | grep -E 'openssh|python3.12|git|curl|vim|nano'`_
![packages](screenshots/15-packages.png)
</div>

<div style="text-align: center;">
_вывод `systemctl list-units --type=service --state=running`_
![services](screenshots/16-services.png)
</div>

## 9. Конвейер и перенаправление

<div style="text-align: center;">
_вывод `ps aux --sort=-%mem | head -11`_
![top processes](screenshots/17-top-processes.png)
</div>

<div style="text-align: center;">
_вывод подсчёта процессов по пользователям_
![process count](screenshots/18-process-count.png)
</div>

<div style="text-align: center;">
_вывод топ-10 больших файлов в /var_
![big files](screenshots/19-big-files.png)
</div>

## 10. Итоговый файл

<div style="text-align: center;">
_вывод `ls -lh ~/report/`_
![report files](screenshots/20-report-files.png)
</div>
