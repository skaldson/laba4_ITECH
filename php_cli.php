<?php
error_reporting(0);
function is_correct_args()
{
	if(isset($argv[1]) and (is_dir($argv[1])))
		return false;
	else
		return true;
	
}

function is_image($image)
{
	if(is_array(getimagesize($image)))
		return true;
	else
		return false;
}
?>

<?php
ini_set('exif.encode_unicode', 'UTF-8');

if(is_correct_args())
	$init_folder=$argv[1];
else
	exit(0);

chdir($init_folder);

mkdir("$init_folder/dop_ex", 0777);

$initial_array = scandir($init_folder);
$current_dir = getcwd();
$new_file_dir ="$current_dir/dop_ex";

foreach($initial_array as $file){
	if(is_image($file))
	{
		if(!exif_read_data($file))
			continue;
		else
		{
			$exif = exif_read_data($file, 'IFD0', true);
			if(!isset($exif['IFD0']['DateTime']))
				continue;
			else
			{
				$current_file_dir = "$current_dir/$file";
				$img_date_time = $exif['IFD0']['DateTime'];
				$img_date = substr($img_date_time, 0, 10);
				$img_date = str_replace(':', '.', $img_date);
				$img_destination = "$new_file_dir/$img_date";
				if(is_dir($img_destination))
					rename($current_file_dir, "$img_destination/$file");
				else{
					mkdir($img_destination, 0777);
					rename($current_file_dir, "$img_destination/$file");
				}
			}
		}
	}
}
