
echo "moving to nc-workflow directory";
# move to nc-workflow directory.

cd /opt/lampp/htdocs/nc-workflow;
#execute artisan worker script

echo "Processing Jobs";
/opt/lampp/bin/php artisan queue:work;
echo "chilling a bit before i go";
sleep 30;
echo "bye";
sleep 3;
exit;
