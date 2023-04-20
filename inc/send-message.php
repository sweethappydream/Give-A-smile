<?php
/**
 * @package givesmile.org
 */

//composer require twilio/sdk
use Twilio\Rest\Client;


// Send message
function send_sms_card($number, $card_url, $auth_data, $sender_data)
{
    $sid = $auth_data['sid'];
    $token = $auth_data['token'];
    $number_from = $auth_data['number_from'];

    if ($sender_data['lang'] === 'he-IL') {
        $msg = 'היי #recipientName#,
איזה כיף! הנה המתנה שלך מ#customerName#, 
מאחלים לך יום מלא חיוכים.
#cardLink# ';
        
        $msg = str_replace(
            [
                '#recipientName#',
                '#customerName#',
                '#cardLink#',
            ],
            [
                $sender_data['receiver-name'] ? $sender_data['receiver-name'] : '',
                $sender_data['name'] ? $sender_data['name'] : '',
                '
' . $card_url,
            ],
            $msg
        );
    } else {
        $msg = 'Hi #recipientName#,
You’ve just received a Smile Gift from #customerName#.
Wishing you a lot of smiles today! #cardLink#';

        $msg = str_replace(
            [
                ' #recipientName#',
                ' from #customerName#',
                '#cardLink#',
            ],
            [
                $sender_data['receiver-name'] ? ' ' . $sender_data['receiver-name'] : '',
                $sender_data['name'] ? ' from ' . $sender_data['name'] : '',
                '
' . $card_url,
            ],
            $msg
        );
    }

    if (!empty($sender_data['couponCode'])) {
        if ($sender_data['lang'] === 'he-IL') {
            $msg = "איזה כיף לך! קיבלת סמייל גיפט מ #customerName# מאחלים לך יום מלא חיוכים #cardLink# קוד הקופון שלך:  #couponCode# www.giveasmile.me/using-magic-gift/ היכנס לאתר למימוש הקוד";
        } else {
            $msg = "You have just received a Smile Gift from #customerName#. Wishing you a lot of smiles today! #cardLink# Your Coupon Code: #couponCode#. Enter here to use your coupon www.giveasmile.org/using-magic-gift/.";
        }
        $msg = str_replace(
            [
                '#customerName#',
                '#cardLink#',
                '#couponCode#'
            ],
            [
                $sender_data['name'] ? ' '  . $sender_data['name'] : ' ',
                $card_url, ''
                . $sender_data['couponCode'],
            ],
            $msg
        );
    }

    if (!str_contains($number, '+')) {
        $number = substr_replace($number, '+', 0, 0);
    }
    $twilio = new Client($sid, $token);

    $message = $twilio->messages
        ->create($number, // to
            array(
                "from" => $number_from,
                "body" => $msg
            )
        );
}

//Send whatsapp
function send_whatsapp_card($number, $card_url, $auth_data, $sender_data)
{
    $sid = $auth_data['sid'];
    $token = $auth_data['token'];
    $number_from = $auth_data['number_from'];


//    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
//    $dotenv->load();
    $twilio = new Client($sid, $token);


    $msg = 'You have just received a Smile Gift from {{1}}. {{2}} *If this is your first Smile Gift, don’t forget to click on CONTINUE below to be able to open the link.*';

    if ($sender_data['lang'] === 'he-IL') {
        $msg = 'איזה כיף לך! קיבלת סמייל גיפט מ{{1}} . לפתיחה בקישור {{2}} *פעם ראשונה בסמייל גיפט? יש ללחוץ על הכפתור המשך *למטה על מנת לפתוח את הקישור';
    }

    $msg = str_replace(
        [
            '{{1}}',
            '{{2}}',
        ],
        [
            $sender_data['name'] ?: ' ',
            $card_url ?: ' ',
        ],
        $msg
    );




    if (!empty($sender_data['couponCode'])) {
        if ($sender_data['lang'] === 'he-IL') {
            $msg = 'איזה כיף לך! קיבלת סמייל גיפט מ {{1}}. {{2}} קוד הקופון שלך: {{3}} *פעם ראשונה בסמייל גיפט? יש ללחוץ על הכפתור המשך למטה על מנת לפתוח את הקישור.*';
        } else {
            $msg = 'You have just received a Smile Gift from {{1}}. {{2}} Your Coupon Code: {{3}}. *If this is your first Smile Gift, don’t forget to click on CONTINUE below to be able to open the link.*';
        }
        $msg = str_replace(
            [
                '{{1}}',
                '{{2}}',
                '{{3}}'
            ],
            [
                $sender_data['name'] ?  $sender_data['name'] : ' ',
                $card_url, ''
                . $sender_data['couponCode'],
            ],
            $msg
        );
    }

    $message = $twilio->messages
        ->create("whatsapp:" . $number, // to
            array(
                "from" => "whatsapp:" . $number_from,
                "body" => $msg
            )
        );
}

function send_email_card($to, $card_url, $sender_data, $file_url = null)
{

    $email = $to;
    $to = "<$email>";
    $subject = __("You received a Smile Gift", THEME_TD);

    $eol = PHP_EOL;
    $headers = [
        'From: <info@giveasmile.me>' . "\r\n",
        'Content-Type: text/html; charset=UTF-8'
    ];


    ob_start();

    if ($sender_data['lang'] == 'he-IL') {
        get_template_part('template-parts/mail-template-he','',array('code' => $sender_data['couponCode']));
    } else {
        get_template_part('template-parts/mail-template','',array('code' => $sender_data['couponCode']));
    }

    $massage = ob_get_contents();
    ob_end_clean();


    $msg = "<p style='white-space: pre-wrap;'>Your certificate is attached to mail</p>" . $eol . $eol;



    if ($massage) {
        $msg = $massage;


        $msg = str_replace('#name#', !empty($sender_data['name']) ? $sender_data['receiver-name'] : '', $msg);


        $msg = str_replace('#gift_url#', !empty($file_url) ? $file_url : '', $msg);


    }
    $attachment = array();
    if ($card_url) $attachment = array($card_url);

    smile_wp_mail($to, $subject, $msg, $headers, $attachment);
}

function wpse27856_set_content_type()
{
    return "text/html";
}

add_filter('wp_mail_content_type', 'wpse27856_set_content_type');

add_filter( 'wp_mail_from', 'smile_sender_email' );
function smile_sender_email( $original_email_address ) {
    return 'info@giveasmile.me';
}

add_filter( 'wp_mail_from_name', 'smile_sender_name' );
function smile_sender_name( $original_email_from ) {
    return 'Smile Gift';
}

