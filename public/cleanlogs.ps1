#Copy yesterday's log  file from Server to Brave Public Folder

get-childitem -Path "Y:\" -Recurse |
Where-Object {$_.CreationTime -gt (Get-date).AddDays(-1).Date} |
copy-item -destination "C:\xampp\htdocs\brave\public\Asrun.csv"

#wait for xx seconds
Start-Sleep -s 15



# Convert the Asrun.csv to Asrun.json in UTF-8 to fix the error

$file = "C:\xampp\htdocs\brave\public\Asrun.csv"
$filename_list = $file.Split(".")[0], "json"
$filename_out = $filename_list -join '.'

$data = Get-Content $file
$new = $data | ConvertFrom-Csv -Delimiter ',' | ConvertTo-Json | Out-File $filename_out -Encoding "UTF8"



#wait for xx seconds


Start-Sleep -s 8


# Return Ecnoded Asrun.json back to Asrun-new.csv

$file = "C:\xampp\htdocs\brave\public\Asrun.json"
$filename_list = $file.Split(".")[0], "csv"
$filename_out = $filename_list -join '-new.'

$data = Get-Content $file -Raw
$json = $data | Out-String | ConvertFrom-Json
$csv = $json | ConvertTo-Csv -Delimiter ',' -NoTypeInformation
$clean = $csv | % { $_ -replace '","', ','} | % { $_ -replace "^`"",''} | % { $_ -replace "`"$",''}
$clean = $clean | Out-File $filename_out -Encoding "UTF8"

Start-Sleep -s 6

#Clean up by deleting Uneeded files

Remove-Item C:\xampp\htdocs\brave\public\Asrun.json

Start-Sleep -s 6

Remove-Item C:\xampp\htdocs\brave\public\Asrun.csv

Start-Sleep -s 6

#hit localhost/dumlogs to import the cleaned csv to database

(New-Object System.Net.WebClient).DownloadString("http://localhost/dumplogs")

Start-Sleep -s 6
#Todo Mail sending


#$From = "noreply@brave-media.tech"
#$To = "jon-snow@winterfell.com", "jorah-mormont@night.watch”
#$Cc = "tyrion-lannister@westerlands.com"
#$Attachment = "C:\xampp\htdocs\brave\public\Asrun.csv"
#$Subject = "Photos of Drogon"
#$Body = "<h2>Script has run successfully</h2><br><br>"
#$Body += “He is so cute!”
#$SMTPServer = "kewebmail.ke.nationmedia.com"
#$SMTPPort = "25"
#Send-MailMessage -From $From -to $To -Cc $Cc -Subject $Subject -Body $Body -BodyAsHtml -SmtpServer $SMTPServer -Port $SMTPPort -UseSsl -Credential (Get-Credential) -Attachments $Attachment
stop-process -Id $PID