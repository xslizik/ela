# Define folder and executable path
$folderPath = "C:\Users\Public\Disk Sorter Enterprise"
$exePath = "$folderPath\dsservice.exe"

# Create the folder
New-Item -ItemType Directory -Force -Path $folderPath

# Copy dummy executable
Copy-Item "C:\Windows\System32\notepad.exe" -Destination $exePath

# Create the unquoted service
$serviceName = "DiskSorter"
$serviceDisplayName = "Disk Sorter Enterprise"
$binaryPath = $exePath  # still unquoted on purpose

# Vulnerable: no quotes around path
sc.exe create $serviceName binPath= $binaryPath DisplayName= "$serviceDisplayName" start= auto obj= "ludus\domainadmin" password= "password"

# Set permissions
$SDDL = "D:(A;;CCLCSWRPWPDTLOCRRC;;;WD)"
sc.exe sdset $serviceName $SDDL