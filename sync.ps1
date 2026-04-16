# -----------------------------------------------------------------
#  Livia Med Spa Theme -- Git Sync Helper
#  Usage:
#    .\sync.ps1          -> PULL latest from GitHub
#    .\sync.ps1 "msg"    -> COMMIT all changes + PUSH to GitHub
# -----------------------------------------------------------------

$env:PATH = "C:\Program Files\Git\cmd;" + $env:PATH
$repo = $PSScriptRoot

if ($args.Count -eq 0) {
    Write-Host ""
    Write-Host "[PULL] Pulling latest from GitHub..." -ForegroundColor Cyan
    git -C $repo pull origin main
    Write-Host "[DONE] Up to date!" -ForegroundColor Green
    Write-Host ""
} else {
    $msg = $args[0]
    Write-Host ""
    Write-Host "[STAGE] Staging all changes..." -ForegroundColor Cyan
    git -C $repo add -A
    Write-Host "[COMMIT] $msg" -ForegroundColor Cyan
    git -C $repo commit -m $msg
    Write-Host "[PUSH] Pushing to GitHub..." -ForegroundColor Cyan
    git -C $repo push origin main
    Write-Host "[DONE] Pushed!" -ForegroundColor Green
    Write-Host ""
}
