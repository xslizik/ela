Register-WmiEvent -Query "SELECT * FROM __InstanceCreationEvent WITHIN 1 WHERE TargetInstance ISA 'Win32_Process'" -Action {
    $p = $Event.SourceEventArgs.NewEvent.TargetInstance
    Write-Host "[$($p.CreationDate)] $($p.ProcessId): $($p.CommandLine)"
}