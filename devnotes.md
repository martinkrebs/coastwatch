# devnotes.md

## Manager-osx

- This is the manager panel for XAMPP on OS X, you start the servers here etc.

## viewing your XAMPP site
- http://localhost/<your project folder name>

> eg: http://localhost/coastwatch

## XAMPP Apache will not run if your Mac OS X already has its own system Apache server running.

### Check to see if the system Apache is running
```
$ ps aux | grep httpd
martinkrebs      5519   0.0  0.0  2432772    636 s000  S+    3:21pm   0:00.00 grep httpd
_www             5402   0.0  0.0  2460892    848   ??  S     3:18pm   0:00.00 /usr/sbin/httpd -D FOREGROUND
root             5398   0.0  0.2  2460892  10144   ??  Ss    3:18pm   0:00.29 /usr/sbin/httpd -D FOREGROUND
```

### Stop the system appache running
```
$ sudo apachectl stop    # (also start and restart)
```

## Web Root Location

Put your project folder (eg coastwatch) inside the htdocs folder:
XAMPP > htdocs

> This top level htdocs folder is simlinked to this folder:
> htdocs -> xamppfiles/htdocs
