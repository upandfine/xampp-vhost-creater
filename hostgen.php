<?php


if(isset($_GET['mode']))
{
  switch($_GET['mode'])
  {
    case 'showHost': 
          showHost($_GET);
      break;            
    default:
          showForm();          
      break;
  }
  
  
}
else
{
  showForm();
}

function showHost($data)
{
  if(isset($data['host']))
  {

$host = $data['host'];  
$template = <<< TEMP
## $host ##

<VirtualHost *:80>
    ServerName $host
    ServerAlias www.$host
    DocumentRoot "C:/xampp/htdocs/$host"
    SetEnv APPLICATION_ENV "development"
    ErrorLog "logs/$host-error.log"
    CustomLog "logs/$host-access.log" combined   
    <Directory "C:/xampp/htdocs/$host">
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>

TEMP;

echo "<pre>";
echo '<a href="/">nochmal</a><br />';
echo  htmlentities($template, ENT_QUOTES); 
echo "127.0.0.1 $host";
echo "<br />";
echo "127.0.0.1 www.$host";
echo "</pre>";
  
  }
  else
  {
    return false;
  }  
}


function showForm()
{
$action = $_SERVER['PHP_SELF'];
$form = <<< FORMT

<form action="$action" method="get">
<input type="text" name="host" id="host" />
<input type="hidden" name="mode" value="showHost" />
<input type="submit" class="submit" value="erstellen" />

</form>

<form



FORMT;
echo $form;


}






?>
