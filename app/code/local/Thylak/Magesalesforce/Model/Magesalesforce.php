<?php

class Thylak_Magesalesforce_Model_Magesalesforce extends Mage_Core_Model_Abstract
{
    
    //public function _construct()
    //{
        //parent::_construct();
        //$this->_init('magesalesforce/magesalesforce');
    //}
    
    private $_url;
    private $_email;
    private $_fname;
    private $_lname;
    
    public function __construct($url,$email,$fname,$lname)
    {
        $this->_url = $url;
        $this->_email = $email;
        $this->_fname = $fname;
        $this->_lname = $lname;
    }
    
    public function callCurl()
    {
        //$url = "http://173.15.158.230/timetracker/addlead.aspx?".$qrystr;
        $ch = curl_init() or die(curl_error());
        curl_setopt($ch, CURLOPT_URL,$this->_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data1=curl_exec($ch) or die(curl_error());
        //echo "<font color=black face=verdana size=3>".$data1."</font>";
        //echo curl_error($ch);
        curl_close($ch);
        return $data1;
    }    
    
    public function sendEmail()
    {
        $fname = $this->_fname;
        $lname = $this->_lname;
        $name = $fname.' '.$lname;
        $to = $this->_email;
        $subject = 'Thanks for visiting our site';
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // Additional headers
        $headers .= 'From: Thylak Soft <info@thylaksoft.com>' . "\r\n";
        $headers .= 'To: '.$fname.'<'.$to.'>' . "\r\n";
        $headers .= 'Cc: buyan@talktoaprogrammer.com; kris@talktoaprogrammer.com' . "\r\n";
        $message = "<html>
                        <head>
                            <title>Magento to Salesforce CRM</title>
                        </head>
                        <body>
                            <p>Dear ".$name.",</p><br>
                            Thanks for your interest in Salesforce to Magento Extension. We would appreciate if you could <br />answer the following questions which would help us to get this right away to you.
<br />1. What version of salesforce do you use?<br />2. Could you please tell me a few words about yourself, your role in your company and what your company does?<br />3. What is the best time and number to get in touch with you?<br />We would be contacting you soon on your request.<br />Thanks<br />Please click on this link to read further information about this extension.<br />http://www.thylaksoft.com/Retail/MagentoSoln/MagentoEnterprise.aspx<br />http://www.thylaksoft.com/Retail/MagentoSoln/Magento2Salesforce.aspx<br />
                            Regards,<br />
                            The Thylaksoft Team<br />
                            302-355-0449<br />
                            www.thylaksoft.com
                        </body>
                     </html>";
        mail($to, $subject, $message, $headers);
    }
    
}



