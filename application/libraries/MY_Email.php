<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class MY_Email extends CI_Email {

    public function __construct()
    {
        parent::__construct();
    }

    public function sendEmail($fromEmail, $fromName, $toEmail, $toName, $title, $oontent, $type = 0)
    {
    	
    	$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'text';
		
		$this->initialize($config);
    	$this->from($fromEmail, $fromName);
		$this->to(array($toEmail));
		$this->reply_to($fromEmail, $fromName);

		if ($type == 0) {
			$this->subject('Welcome To Relayy');	
		} else {
			$this->subject('You got Email');	
		}
		
		$mailContent = '
			<html>

<head>
    <meta charset="UTF-8">
    <title>Welcome to Relayy</title>
</head>

<body style="margin: 0; padding: 0;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse;background: #f1f1f1;">
        <tr>
            <td align="center" valign="top">
                <!-- HEADER STARTS -->
                <table width="635" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse;background: #ffffff;">
                    <tr>
                        <td align="center" height="136">
                            <img src="'. asset_base_url().'/images/mail/header.jpg" width="635" height="136" />
                        </td>
                    </tr>
                    <tr>
                        <td align="center" height="40" style="background: #ffffff;">
                            <img src="'. asset_base_url().'/images/mail/blank.gif" width="635" height="40" />
                        </td>
                    </tr>
                </table>
                <!-- HEADER END -->
                <!-- CONTENT STARTS -->
                <table width="635" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse;background: #ffffff;">
                    <tr>
                        <td align="center" width="30">
                            <img src="'. asset_base_url().'/images/mail/blank.gif" width="15" />
                        </td>
                        <td align="left" valign="top">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse;color:#4d4d4d;font-size:16px;line-height:23px; font-family:Helvetica, Arial, Tahoma, Verdana, sans-serif;">
                                <tr>
                                    <td align="left">
                                        <span style="font-size:25px;line-height:30px;">Dear '.$toName.'!</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" height="30">
                                        <img src="'. asset_base_url().'/images/mail/blank.gif" height="30" />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left">
                                        <strong>
                   '.$content.'
                  </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" height="100">
                                        <img src="'. asset_base_url().'/images/mail/blank.gif" height="100" />
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td align="center" width="30">
                            <img src="'. asset_base_url().'/images/mail/blank.gif" width="15" />
                        </td>
                    </tr>
                </table>
                <!-- CONTENT END -->
                <!-- FOOTER STARTS -->
                <table width="635" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse;background: #ffffff;">
                    <tr>
                        <td align="center" width="30">
                            <img src="'. asset_base_url().'/images/mail/blank.gif" width="15" />
                        </td>
                        <td align="left" valign="top">
                            <table width="277" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse;color:#b3b3b3;font-size:10px;line-height:12px; font-family:Helvetica, Arial, Tahoma, Verdana, sans-serif;">
                                <tr>
                                    <td align="left">
                                        Copyright &copy; 2016 Relayy. All rights reserved.
                                        <br />You are receiving this email because
                                        <br />you have registered for Relayy
                                        <br />Our mailing address is:
                                        <br />
                                        <div class="vcard">
                                            <div class="org">Relayy</div>
                                            <div class="adr">
                                                <div class="street-address">8 WARNER YARD, CLERKENWELL</div>
                                                <span class="locality">Garner</span>, <span class="region">NC</span>  <span class="postal-code">EC1R 5EY</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td align="center" width="15">
                            <img src="'. asset_base_url().'/images/mail/blank.gif" width="15" />
                        </td>
                        <td align="left" valign="top">
                        </td>
                        <td align="center" width="30">
                            <img src="'. asset_base_url().'/images/mail/blank.gif" width="15" />
                        </td>
                    </tr>
                    <tr>
                        <td align="center" height="15" colspan="5">
                            <img src="'. asset_base_url().'/images/mail/blank.gif" height="15" />
                        </td>
                    </tr>
                    <tr>
                        <td align="center" height="56" colspan="5">
                            <img src="'. asset_base_url().'/images/mail/footer.jpg" width="635" height="56" />
                        </td>
                    </tr>
                </table>
                <!-- FOOTER END -->
            </td>
        </tr>
    </table>
</body>

</html>
		';

		$this->message($mailContent);
		$this->send();
    }
}