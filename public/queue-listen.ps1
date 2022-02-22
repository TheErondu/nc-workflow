Start-Sleep -s 6

#hit run artisan command to import the cleaned csv to database

C:/xampp/php/php.exe C:/xampp/htdocs/nc-workflow/artisan queue:listener

Start-Sleep -s 90
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
