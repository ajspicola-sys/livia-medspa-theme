import paramiko
import time

transport = paramiko.Transport(('145.223.77.204', 65002))
transport.connect(username='u779437173', password='Coolkid1978!')

channel = transport.open_session()
channel.set_combine_stderr(True)

# Bypass the nologin shell by directly exec'ing bash
theme_path = '/home/u779437173/public_html/wp-content/themes/livia-medspa-theme'
cmd = f'/bin/bash -c "cd {theme_path} && git pull origin main 2>&1"'
channel.exec_command(cmd)

time.sleep(15)
output = ''
while channel.recv_ready():
    output += channel.recv(4096).decode('utf-8', errors='replace')

print("Exit status:", channel.recv_exit_status())
print("Output:", output if output else "(empty)")

channel.close()
transport.close()
