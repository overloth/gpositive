<?php
// upload files to s3 from Heroku using PHP SDK v3
// requires config vars: AWS_ACCESS_KEY_ID, AWS_SECRET_ACCESS_KEY, S3_BUCKET
require('./../vendor/autoload.php');
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['userfile']) && $_FILES['userfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userfile']['tmp_name'])) {
    
    // try upload
    
    // for now, use existing name
    $uploadfolder = 'somefolder';
    $uploadname = $_FILES['userfile']['name'];
    
    // set up s3
    $bucket = getenv('S3_BUCKET');
    $keyname = $uploadfolder.'/'.$uploadname;
    $s3 = S3Client::factory([
        'version' => '2006-03-01',
        'region' => 'eu-west-1'
    ]);
    
    // try
    try {
        // Upload data.
        $result = $s3->putObject(array(
            'Bucket' => $bucket,
            'Key'    => $keyname,
            'Body'   => fopen($_FILES['userfile']['tmp_name'], 'rb'),
            'ACL'    => 'public-read'
        ));
    
        // Print the URL to the object.
        
        // show image
        echo('<p><img src="'.$result['ObjectURL'].'" /></p>');
        
    } catch (S3Exception $e) {
        echo $e->getMessage() . "\n";
    }
    
}
else {
    ?>
        <h2>Upload a file</h2>
        <form enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <input name="userfile" type="file"><input type="submit" value="Upload">
        </form>

    <?  
};  
?>


   



