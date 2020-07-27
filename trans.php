<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php
/*перевод файлов  на любой язык  GTranslate API */
require '/vendor/autoload.php';

use \Dejurin\GoogleTranslateForFree;

function getDirContents($dir, &$results = array(),$pattern='/.*\.php/m') {
    $files = scandir($dir);

    foreach ($files as $key => $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path)) {
			if (preg_match($pattern,$path)){
				preg_match('/(?<=\\\\in\\\\).*/m',$path,$out);
				$results[] = $out[0];
			}
            
        } else if ($value != "." && $value != "..") {
			
            getDirContents($path, $results);
			//add dir
            //$results[] = $path;
        }
    }

    return $results;
}
$infiles = getDirContents('in');
print_r($infiles);

function fopenwithdirs($pathToFile,$acess){
	//$pathToFile = 'test1/test2/test3/test4/test.txt';
	$fileName = basename($pathToFile);
	$folders = explode('/', str_replace('/' . $fileName, '', $pathToFile));

	if(!file_exists(dirname($pathToFile)))
		mkdir(dirname($pathToFile), 0777, true);
//do stuff with $file.
//file_put_contents($pathToFile, 'test');
	return fopen($pathToFile,$acess);
}

$source = 'en';
$target = 'ru';
$attempts = 5;
$arr = ['hello','world'];

$tr = new GoogleTranslateForFree();
$result = $tr->translate($source, $target, $arr, $attempts);

var_dump($result); 


foreach($infiles as $key => $value){
	
require ('in/'.$value);
	
		echo $key."   ".$value."<br>";
		$myfile = fopenwithdirs("out\\".$value, "w");
		fwrite($myfile,"<?php");
	foreach($_ as $key=>$val){
		$res = $tr->translate($source, $target, $val, $attempts);
		fwrite($myfile,"\$_['".$key."']          = '".$res."'; ".PHP_EOL);
		
		
	}
	unset($_);


}
?>
</body>