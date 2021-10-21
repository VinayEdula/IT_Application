<?php

$ename=strtoupper($_POST ['ename']);
$jobtitle=$_POST ['dep'];
$email=$_POST ['email'];
$dob=$_POST ['date'];
$univ=$_POST ['un'];
$ApprovedUniv=0;


function hide_mobile_no($number)
{
    return substr($number, 0, 1) . 'XXXX' . substr($number, 5,1). 'XXXX'."<br>";
}

$mobile= hide_mobile_no($_POST ['pn']) ;


$target_dir = "fileuploads/";

$resume_file = $target_dir . basename($_FILES["ur"]["name"]);
$resumeuploadOk = 1;
$resumeFileType = strtolower(pathinfo($resume_file,PATHINFO_EXTENSION));


$photograph_file = $target_dir . basename($_FILES["up"]["name"]);
$photographuploadOk = 1;
$photographFileType = strtolower(pathinfo($photograph_file,PATHINFO_EXTENSION));

$digitalsign_file = $target_dir . basename($_FILES["ds"]["name"]);
$digitalsignOk = 1;
$digitalsignFileType = strtolower(pathinfo($digitalsign_file,PATHINFO_EXTENSION));

$res=0;
$pot=0;
$dsign=0;
$error=0;
if($resumeFileType != "doc" && $resumeFileType != "pdf") {

    echo "<br>".'<h1>' ."Error: Upload the resume only in specified format(doc,pdf)". '</h1>'."<br>";
    $resumeuploadOk = 0;
    $error=1;
}
else{

if ($_FILES["ur"]["size"] > 5000000) {
    echo "<br>"."<br>".'<h1 >' ."Error: Your resume size is too large (>5MB)". '</h1>'."<br>";
    $resumeuploadOk = 0;
    $error=1;
}
else{

    if (move_uploaded_file($_FILES["ur"]["tmp_name"], $resume_file)) {
        $res= "The file ". basename( $_FILES["ur"]["name"]). " has been uploaded successfully"."<br>";
    } else {
        $res= "ERROR IN UPLOADING THE RESUME"."<br>";
    }

if ($_FILES["up"]["size"] > 500000) {
    echo "<br>"."<br>".'<h1>' ."Error: Your photograph size is too large (>5OO KB)". '</h1>'."<br>";
    $photographuploadOk = 0;
    $error=1;
}

else{
if($photographFileType != "jpeg" && $photographFileType != "png" && $photographFileType != "jpg") {
    echo "<br>"."<br>".'<h1>' ."Error: Upload the photograph only in specified format(jpg,png,jpeg)". '</h1>'."<br>";
    $photographuploadOk = 0;
    $error=1;
}
else{

    if (move_uploaded_file($_FILES["up"]["tmp_name"], $photograph_file)) {
        $pot= "The photograph ". basename( $_FILES["up"]["name"]). " has been uploaded successfully"."<br>";
    } else {
        $pot= "ERROR IN UPLOADING THE PHOTOGRAPH"."<br>";
    }

if ($_FILES["ds"]["size"] > 500000) {
    echo "<br>"."<br>".'<h1>' ."Error: Your digital sign size is too large(>500 KB)". '</h1>'."<br>";
    $digitalsignOk = 0;
    $error=1;
}
else{

if($digitalsignFileType != "jpeg" && $digitalsignFileType != "png" && $digitalsignFileType != "jpg") {
    echo "<br>"."<br>".'<h1>' ."Error: Upload the digital sign in only specified format(jpg,png,jpeg)". '</h1>'."<br>";
    $digitalsignOk = 0;
    $error=1;
}
else{

    if (move_uploaded_file($_FILES["ds"]["tmp_name"], $digitalsign_file)) {
        $dsign="The digital sign ". basename( $_FILES["ds"]["name"]). " has been uploaded successfully"."<br>";
    } else {
        $dsign= "ERROR IN UPLOADING THE DIGITAL SIGN"."<br>"; }


$data = file_get_contents('universitydetails.txt');
if(strpos($data, $univ) !== FALSE)
{
    $ApprovedUniv=1;
}


if($ApprovedUniv==0){
    echo "<br>"."<br>".'<h1>' ."Error: Your university ' $univ ' is not present in Approved universities file". '</h1>'."<br>";
    $error=1;
}}}}}}}
?>



<html>
<style>
    body {
        background-image: url(back.jpg);
    }

    .footer {
        position: fixed;
        text-align: center;
        bottom: 15px;
        width: 100%;
    }

    table input[type="submit"] {
        display: block;
        margin: 0 auto;
    }
    label {
   
    color: black;
    
}
</style>


<div <?php if($error==1){echo 'style="display:none;"';} ?>>
<body text="white">

 <h1 ALIGN="CENTER"><?php echo $ename; ?>'s Application for IT Recruitment</h1>

<div align="center">
         
            <fieldset>

               
                <table align="center" cellpadding="5" id="xxx">
                    <tr>
                         <td>
                            <label> <b>Job Title Applied:</b> </label>
                            <b style="margin-left:50px;"><?php echo $jobtitle; ?></b>
                        </td>
                    </tr>
                    <p></p>
                    <tr>
                        <td>
                            <label><b>Employee Name: </b></label>
                            <b style="margin-left:55px;"><?php echo $ename; ?></b>
                        </td>
                    </tr>

                    <tr>
                         <td>
                            <label><b>Mobile Number: </b></label>
                            <b style="margin-left:58px;"><?php echo $mobile; ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><b>Email: </b></label>
                           <b style="margin-left:127px;"><?php echo $email; ?></b>
                        </td>
                       
                    </tr>
                     <tr>
                        <td>
                            <label><b>Date of Birth: </b></label>
                           <b style="margin-left:78px;"> <?php echo $dob; ?></b>
                        </td>
                       
                    </tr>
      <tr>
        <td>
        <h1></h1>
    </td>
      </tr>
      <tr>
        <td>
        <h1></h1>
    </td>
      </tr>
                      <tr>
                        <td>
                           <p style="size:15; color:red"><b> <?php echo  $res; ?> </b></p>
                        </td>
                        
                    </tr>
                    <tr>
                         <td>
                           <p style="color:red"><b><?php echo $pot; ?></b></p>
                        </td>
                    </tr>
                    <tr>
                         <td>
                           <p style="color:red"><b><?php echo $dsign; ?></b></p>
                        </td>
                    </tr>
                </table>
            </div>
            </fieldset>
    </div>
    <div class="footer"><b style="color:black">Designed By Edula Vinay Kumar Reddy </b></div>
    
</body>

</html>
