<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class MY_Email extends CI_Email {

    var $senderEmail = "support@relayy.net";
    var $senderName = "Relayy.io";
    public function __construct()
    {
        parent::__construct();
    }

    public function sendEmail($fromEmail, $fromName, $toEmail, $title, $subtitle, $content, $type = 0)
    {
    	
    	$config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html'; // Append This Line
        $this->initialize($config);
		
    	$this->from($fromEmail, $fromName);
		$this->to(array($toEmail));
		$this->reply_to($fromEmail, $fromName);

		if ($type == 0) {
			$this->subject($title);	
		} else {
			$this->subject('You got Email');	
		}
		
		$mailContent = '
			<html>

<head>
    <meta charset="UTF-8">
    <title>'.$title.'</title>
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
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse;color:#4d4d4d;font-size:16px;line-height:23px; font-family:Helvetica, Arial, Tahoma, Verdana, sans-serif;">';
if (strlen($title) > 0) {

$mailContent .= '               <tr>
                                    <td align="left">
                                        <span style="font-size:25px;line-height:30px;">'.$subtitle.'</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" height="30">
                                        <img src="'. asset_base_url().'/images/mail/blank.gif" height="30" />
                                    </td>
                                </tr>';
                            }
$mailContent .= '               <tr>
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
                                                <span class="locality">Garner</span>, <span class="region">NC</span>  <span class="postal-code">USA</span>
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

    public function inviteUser($inviterEmail, $inviterName, $inviteLink, $toEmail)
    {
        $this->sendEmail(
            $this->senderEmail, 
            $this->senderName, 
            $toEmail,
            "You are invited!", 
            $inviterName." sent you invite to relayy.io",
            "Please open following link and register your details!<br> $inviteLink <br><br> If you have questions, please contact this email: ". $inviterEmail ." !"
        );   
    }

    public function inviteChat($inviterEmail, $inviterName, $inviteLink, $toEmail, $toName, $chatTitle)
    {
        $title = '';
        if ($toName == '') $title = "Hi! ".$inviterName." sent you invite to chat: ".$chatTitle.".";
        else $title = "Hi, $toName! ".$inviterName." sent you invite to chat: ".$chatTitle.".";

        $this->sendEmail(
            $this->senderEmail, 
            $this->senderName, 
            $toEmail, 
            "You are invited to a new chat!",
            $title,
            "Please open following link and register your details!<br> $inviteLink <br><br> If you have questions, please contact this email: ". $inviterEmail ." !"
        );   
    }

    public function approveUser($adminEmail, $adminName, $toEmail)
    {
        $this->sendEmail(
            $this->senderEmail, 
            $this->senderName, 
            $toEmail, 
            "Your account has been approved!",
            "Your account has been activated by $adminName!",
            "If you have questions, please contact this email: ". $adminEmail ." !"
        );   
    }

    public function approveChat($adminEmail, $adminName, $toEmail, $toName, $inviteLink, $chatTitle)
    {
        $title = '';
        if ($toName == '') $title = "Hi! ".$adminName." approved this chat: ".$chatTitle.".";
        else $title = "Hi, $toName! ".$adminName." approved chat: ".$chatTitle.".";

        $this->sendEmail(
            $this->senderEmail, 
            $this->senderName, 
            $toEmail, 
            "Your chat room has been approved!",
            $title,
            "Please open following link and chat with ur partner!<br> $inviteLink <br><br> If you have questions, please contact this email: ". $adminEmail ." !"
        );   
    }

    public function removeUser($adminEmail, $adminName, $toEmail)
    {
        $this->sendEmail(
            $this->senderEmail, 
            $this->senderName, 
            $toEmail, 
            "Your account has been removed!",
            "Your account has been removed by $adminName!",
            "If you have questions, please contact this email: ". $adminEmail ." !"
        );   
    }

    public function removeChat($adminEmail, $adminName, $toEmail, $toName, $chatTitle)
    {
        $title = '';
        if ($toName == '') $title = "Hi! ".$adminName." removed this chat: ".$chatTitle.".";
        else $title = "Hi, $toName! ".$adminName." removed chat: ".$chatTitle.".";

        $this->sendEmail(
            $this->senderEmail, 
            $this->senderName, 
            $toEmail, 
            "Your chat room has been removed!",
            $title,
            "If you have questions, please contact this email: ". $adminEmail ." !"
        );   
    }

    public function leftChat($toEmail, $toName, $chatTitle)
    {
        $title = '';
        if ($toName == '') $title = "Hi! You left this chat: ".$chatTitle.".";
        else $title = "Hi, $toName! You left chat: ".$chatTitle.".";

        $this->sendEmail(
            $this->senderEmail, 
            $this->senderName, 
            $toEmail, 
            "You has just left chat room!",
            $title,
            "If you have questions, please contact this email: ". $adminEmail ." !"
        );   
    }

    public function alert($toEmail, $toName, $alertContent)
    {
        $title = '';
        if ($toName == '') $title = "Hi!";
        else $title = "Hi, $toName!";

        $this->sendEmail(
            $this->senderEmail, 
            $this->senderName, 
            $toEmail, 
            "Relayy Notification!",
            $title,
            "$alertContent <br>If you have questions, please contact this email: ". $adminEmail ." !"
        );   
    }

    public function register($toEmail, $toName)
    {
        $title = '';
        if ($toName == '') $title = "Hi!";
        else $title = "Hi, $toName!";

        $this->sendEmail(
            $this->senderEmail, 
            $this->senderName, 
            $toEmail, 
            "Welcome To Relayy!",
            $title,
            "Congratulations!<br>You've been registered on Relayy with email ". $toEmail ." !"
        );   
    }

    public function linkedin($toEmail, $toName)
    {
        $title = '';
        if ($toName == '') $title = "Hi!";
        else $title = "Hi, $toName!";

        $this->sendEmail(
            $this->senderEmail, 
            $this->senderName, 
            $toEmail, 
            "Welcome To Relayy!",
            $title,
            "You've been signed in Relayy with this LinkedIn email ". $toEmail ." !"
        );   
    }

    public function profile($toEmail, $toName)
    {
        $title = '';
        if ($toName == '') $title = "Hi!";
        else $title = "Hi, $toName!";

        $this->sendEmail(
            $this->senderEmail, 
            $this->senderName, 
            $toEmail, 
            "You've just updated ur profile!",
            $title,
            "You've just updated your profile on Relayy!"
        );   
    }
}