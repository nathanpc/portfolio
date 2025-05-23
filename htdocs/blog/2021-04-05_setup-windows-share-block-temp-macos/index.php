<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>Setup File Screens to Block macOS System Files Being Created </title>
</head>
<body>
	<?php include_template('header'); ?>

	<div id="blog-post" class="section">
		<h2>Setup File Screens to Block macOS System Files Being Created </h2>
		<div id="published-date">2021-04-05</div>
	</div>

<p>
	If you've ever had an Apple computer or has worked with someone that uses
	one you're more than likely familiar with the infamous
	<code><a href="https://en.wikipedia.org/wiki/.DS_Store">.DS_Store</a></code>,
	<code><a href="https://superuser.com/questions/1067054/what-is-the-point-of-the-trashes-file-in-mac-os-x">.Trashes</a></code>,
	and other files that macOS leaves absolutely everyone. These files are akin
	to <code><a href="https://en.wikipedia.org/wiki/Windows_thumbnail_cache">Thumbs.db</a></code>,
	and <code><a href="https://www.digitalcitizen.life/why-are-there-two-desktopini-files-my-desktop-what-do-they-do/">desktop.ini</a></code>
	on Windows, they are used by the operating system as either cache,
	temporary/special storage, or as a way to store special attributes that are
	not natively supported by the underlying filesystem. They are, for the most
	part, completely optional, and shouldn't be hanging around your file server,
	littering your folders and causing confusion. Thankfully deleting and
	blocking these files from being created is quite a trivial task under
	Windows Server if you have the
	<a href="https://docs.microsoft.com/en-us/windows-server/storage/fsrm/fsrm-overview">
	File Server Resource Manager</a> role installed.
</p>

<p>
	Before we begin, make sure that you have the FSRM role installed in your
	file server by going to the <code>Server Manager</code> and selecting the
	<code>File and Storage Services &gt; File and iSCSI Services &gt; File
	Server Resource Manager</code> role from the <code>Add Roles and Features
	Wizard</code> like this:
</p>

<?= compat_image('./Add-Roles-and-Features-Wizard.png', 'Installing FSRM role using the GUI', [], [
	'caption' => true
]) ?>

<p>
	Alternatively if you're running
	<a href="https://en.wikipedia.org/wiki/Server_Core">Windows Server Core</a>,
	like I am in this case, you can install this role by running the following
	PowerShell command:
</p>

<?php compat_code_begin('powershell'); ?>Install-WindowsFeature -Name FS-Resource-Manager -IncludeManagementTools<?php compat_code_end(); ?>

<p>
	After you have everything installed and properly setup let's focus our
	attention to the files that we want to block/remove from our network shares.
	The most common ones that are created by macOS are:
</p>

<ul>
	<li><code>._*</code></li>
	<li><code>.DS_Store</code></li>
	<li><code>.Trashes</code> (Directory)</li>
	<li><code>.TemporaryItems</code> (Directory)</li>
	<li><code>.apdisk</code></li>
</ul>

<p>
	All of these files are completely optional and can be blocked from being
	created without any problems to the users of your network shares. From here
	you can block the files from this list using the GUI or PowerShell by
	<a href="https://docs.microsoft.com/en-us/windows-server/storage/fsrm/file-screening-management">
	following this tutorial from Microsoft</a> or, since this is quite a tedious
	task, run my PowerShell script to setup all of the file screening rules and
	delete any of these files that are already in your network shares. This way
	you can easily set this up even on Server Core installations, which is the
	case of my file server.
</p>

<?php compat_code_begin('powershell'); ?># Block-FsrmMacJunk.ps1
# Sets up file screens to block junk files from Mac OS from your network shares.
#
# Author: Nathan Campos 

# Variables
$MacJunkPatterns = @("._*", "*.DS_Store", "*._.DS_Store", "*.Trashes",
    "*.apdisk", "*.TemporaryItems")

<#
.SYNOPSIS
Comfirms an action with the user.

.PARAMETER Message
Message that will be shown for the user to accept or reject.

.OUTPUTS
True if the user confirmed the action.
#>
Function Confirm-WithUser {
    Param(
        [Parameter(Mandatory = $true)]
        [String]$Message
    )

    $Response = Read-Host -Prompt "$Message [y/n]"
    While ($Response -NotMatch "[YyNn]") {
        $Response = Read-Host -Prompt "$Message [y/n]"
    }

    Return $Response -Match "[Yy]"
}

<#
.SYNOPSIS
Creates the file group describing all the junk files a Mac can place on a file system.

.DESCRIPTION
Creates the file group describing all the junk files a Mac can place on a file system.

.INPUTS
None.

.OUTPUTS
Nothing.

.LINK
New-FsrmFileGroup
#>
Function New-MacJunkFileGroup {
    Write-Output "Creating junk Mac files file group..."
    New-FsrmFileGroup -Name "Mac Files" -IncludePattern $MacJunkPatterns | Out-Null
}

<#
.SYNOPSIS
Creates the file screen template to block all the junk files from Macs.

.DESCRIPTION
Creates the file screen template to block all the junk files from Macs.

.INPUTS
None.

.OUTPUTS
Nothing.

.LINK
New-FsrmFileScreenTemplate

.LINK
New-MacJunkFileGroup
#>
Function New-MacJunkFileScreenTemplate {
    Write-Output "Creating junk Mac files file screen template..."
    New-FsrmFileScreenTemplate -Name "Block Mac Junk Files" -IncludeGroup "Mac Files" `
        -Active | Out-Null
}

<#
.SYNOPSIS
Creates the file screen to block all the junk files from Macs in a particular directory.

.DESCRIPTION
Creates the file screen to block all the junk files from Macs in a particular directory.

.PARAMETER Path
Path of the directory that you want to screen for Mac junk.

.INPUTS
Path of the directory that you want to screen for Mac junk.

.OUTPUTS
Nothing.

.LINK
New-FsrmFileScreen

.LINK
New-MacJunkFileScreenTemplate
#>
Function New-MacJunkFileScreen {
    [CmdletBinding()]
    Param(
        [Parameter(ValueFromPipeline, Position = 0, Mandatory = $true)]
        [String]$Path
    )

    Write-Output "Creating junk Mac files screen in `"$Path`"..."
    New-FsrmFileScreen -Path $Path -Template "Block Mac Junk Files" -Active | Out-Null
}

# Check for the required arguments.
If ($args.Count -lt 1) {
    Write-Error "No directory to create the Mac junk file screen was passed to the script."
    Write-Output "Usage: Block-FsrmMacJunk "
    Write-Output
    Write-Output "    PathToScreen    Path of the directory that you want to screen for Mac junk."
    Exit
}
$SharePath = $args[0]

# Create everything needed for the file screen.
New-MacJunkFileGroup
New-MacJunkFileScreenTemplate
New-MacJunkFileScreen $SharePath

# Delete any existing Mac junk.
If (Confirm-WithUser "Do you want to delete the Mac junk files that are already in the directory?") {
    Write-Output "Deleting all of the Mac junk for your network share..."
    Get-ChildItem -Path $SharePath -Include $MacJunkPatterns -Recurse -Force | Remove-Item -Force
}

Write-Output "All done!"<?php compat_code_end(); ?>

<p>
	When you run this script please remember to specify the network share that
	you want to setup the file screening in (e.g. <code>.\Block-FsrmMacJunk.ps1
	E:\Shares</code>), but don't worry that the script will throw an error and
	remind you of this in case you forget. The script will also ask if you want
	to delete any of these files that might already be in your network shares.
</p>

	<?php include_template('footer'); ?>
</body>
</html>
