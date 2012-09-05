#!/usr/bin/php
<?php
/**
 * User: Dean Vaughan
 * Date: 9/4/12
 * Time: 10:22 AM
 * This should not be called by a web browser
 */

// Since we're going to call this script from init, lets make sure we chdir to the directory the script resides in
// That way I know how to find class_dicom.php relatively.
chdir(dirname(__FILE__));

require_once('../class_dicom_php/class_dicom.php');

// We're going to build up the command and arguments we're going to use to run DCMTK's store server.
$storescp_cmd = TOOLKIT_DIR . "/storescp -v -dhl -td 20 -ta 20 --fork " . // Be verbose, set timeouts, fork into multiple processes
  "-xf ./storescp.cfg Default " . // Our config file
  "-od ./temp/ " . // Where to put images we receive
  "-xcr \" ./import.php \"#p\" \"#f\" \"#c\" \"#a\"\" " . // Run this script with these args after image reception
  "1104 "; // Listen on this port

system($storescp_cmd);

?>

