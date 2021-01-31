<?php

require 'vendor/autoload.php';

use Abraham\TwitterOAuth\TwitterOAuth;

// Function Get Random Line
function randomTweet($tweets)
{
  $lines = file($tweets);
  return $lines[array_rand($lines)];
}

// API KEY TWITTER
$consumer_key         = '##################################################';
$consumer_secret      = '##################################################';
$access_token         = '##################################################';
$access_token_secret  = '##################################################';

/**************************************************************************/
/*                       Sell Account Twitter Dev                         */
/*                                                                        */
/* On P-Store.net : https://p-store.net/akun/55410/akun-twitter-developer */
/* Donation       : https://saweria.co/zckyachmd                          */
/*                                                                        */
/*   Created by Zacky Achmad | Powered by Zetbot Indonesia (zetbot.org)   */
/**************************************************************************/

// Config Auto Reply
$total_tweet = 3; // Tweet per Action

// Connect to Account
$connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
$connection->get('account/verify_credentials');

if ($connection->getLastHttpCode() == 200) {
  // Get Tweet Status
  $get_status = $connection->get('statuses/home_timeline', ['count' => $total_tweet]);

  foreach ($get_status as $status) {
    $i = 0;

    // Get Reply from File
    $tweet = '@' . $status->user->screen_name . ' ' . randomTweet('tweet_reply.txt');

    // Reply to Tweet
    $connection->post('statuses/update', ['in_reply_to_status_id' => $status->id, 'status' => $tweet]);

    if ($connection->getLastHttpCode() == 200) {
      echo 'Successfully replied to ' . $tweet . '</br>';
      $i++;
    } else {
      echo 'Failed to reply to the tweet!';
      break;
    }
  }

  if ($i >= 1) {
    echo '</br> Success ' . $i . ' replies';
  }
} else {
  echo 'Invalid API key!';
}
