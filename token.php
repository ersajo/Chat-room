<?php

// ADD TWILIO REQURIED LIBRARIES
require_once('twilio/Services/Twilio.php');

// TWILIO CREDENTIALS
$TWILIO_ACCOUNT_SID = 'your account sid here';
$TWILIO_CONFIGURATION_SID = 'your configuration sid here';
$TWILIO_API_KEY = 'your API key here';
$TWILIO_API_SECRET = 'your API secret here';

// CREATE TWILIO TOKEN
// $id will be the user name used to join the chat
$id = $_GET['id'];

$token = new Services_Twilio_AccessToken(
    $TWILIO_ACCOUNT_SID,
    $TWILIO_API_KEY,
    $TWILIO_API_SECRET,
    3600,
    $id
);

// GRANT ACCESS TO CONVERSTATION
$grant = new Services_Twilio_Auth_ConversationsGrant();
$grant->setConfigurationProfileSid($TWILIO_CONFIGURATION_SID);
$token->addGrant($grant);

// JSON ENCODE RESPONSE
echo json_encode(array(
    'id'    => $id,
    'token' => $token->toJWT(),
));
