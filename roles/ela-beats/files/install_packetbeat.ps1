# Check if Chocolatey is installed
try {
    choco --version
    $chocoInstalled = $true
} catch {
    $chocoInstalled = $false
}

# Install Chocolatey if not present
if (-not $chocoInstalled) {
    Set-ExecutionPolicy Bypass -Scope Process -Force
    [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072
    iex ((New-Object System.Net.WebClient).DownloadString('https://community.chocolatey.org/install.ps1'))
}

# Install nmap via Chocolatey
try {
    choco install nmap -y
} catch {
    Write-Warning "Failed to install Nmap"
}

# Uninstall nmap via Chocolatey
try {
    choco uninstall nmap -y
} catch {
    Write-Warning "Failed to uninstall Nmap"
}

# Download Packetbeat
$packetbeatUrl = 'https://artifacts.elastic.co/downloads/beats/packetbeat/packetbeat-8.17.3-windows-x86_64.zip'
$packetbeatZip = 'C:\Users\Public\Downloads\packetbeat-8.17.3-windows-x86_64.zip'
Invoke-WebRequest -Uri $packetbeatUrl -OutFile $packetbeatZip

# Create Packetbeat installation directory
$packetbeatInstallDir = 'C:\Program Files\packetbeat'
if (-not (Test-Path $packetbeatInstallDir)) {
    New-Item -Path $packetbeatInstallDir -ItemType Directory | Out-Null
}

# Unzip to temporary folder
$extractDir = 'C:\Users\Public\Downloads\packetbeat_extract'
Expand-Archive -Path $packetbeatZip -DestinationPath $extractDir -Force
Remove-Item -Path $packetbeatZip -Force

# Copy contents of nested folder to final destination
$sourceDir = Join-Path $extractDir 'packetbeat-8.17.3-windows-x86_64'
Copy-Item -Path "$sourceDir\*" -Destination $packetbeatInstallDir -Recurse -Force

# Copy custom packetbeat.yml configuration file
Copy-Item -Path ".\packetbeat.yml" -Destination "$packetbeatInstallDir\packetbeat.yml" -Force

$content = Get-Content -Path "$packetbeatInstallDir\packetbeat.yml"
$content = $content | ForEach-Object {
    [regex]::Replace($_, '10\.USER_SECOND_OCTET\.20\.11', '10.5.20.11', 'None')
}
$content = $content | ForEach-Object {
    [regex]::Replace($_, 'USERNAME', 'elastic', 'None')
}
$content = $content | ForEach-Object {
    [regex]::Replace($_, 'PASSWORD', 'S3cur3P@ss?', 'None')
}
$content = $content | ForEach-Object {
    [regex]::Replace($_, 'any', '0', 'None')
}
$content | Set-Content -Path 'C:\Program Files\packetbeat\packetbeat.yml'

# Install Packetbeat as a service
Push-Location $packetbeatInstallDir
powershell.exe -ExecutionPolicy Bypass -File .\install-service-packetbeat.ps1
Pop-Location

# Setup Packetbeat
Push-Location $packetbeatInstallDir
.\packetbeat.exe setup -e
Pop-Location

# Start Packetbeat service
Start-Service -Name packetbeat

rm .\packetbeat.yml
rm .\install_packetbeat.ps1