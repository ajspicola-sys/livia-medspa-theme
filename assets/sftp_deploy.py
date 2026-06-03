import paramiko
import urllib.request
import ssl

# Connection details
host = '145.223.77.204'
port = 65002
username = 'u779437173'
password = 'Coolkid1978!'

local_file = 'c:/Users/ajspi_j/.gemini/antigravity/scratch/livia-medspa-theme/assets/deploy.php'
remote_path = '/home/u779437173/public_html/deploy.php'

print("Connecting to SFTP server...")
transport = paramiko.Transport((host, port))
transport.connect(username=username, password=password)

sftp = paramiko.SFTPClient.from_transport(transport)
print(f"Uploading {local_file} to {remote_path}...")
sftp.put(local_file, remote_path)
sftp.close()
transport.close()
print("Upload successful!")

# Trigger the deployment via HTTP request
url = 'https://liviamedspa.com/deploy.php?key=LiviaGitDeploy2026'
print(f"Triggering deploy script at {url}...")

# Ignore SSL verification issues just in case
ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

try:
    with urllib.request.urlopen(url, context=ctx) as response:
        html = response.read().decode('utf-8')
        print("\n=== Deployment Output ===")
        print(html)
except Exception as e:
    print(f"Error triggering deploy: {e}")
