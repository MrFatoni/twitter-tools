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

// Connect to Account
$connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
$connection->get('account/verify_credentials');

if ($connection->getLastHttpCode() == 200) {
  // Get Reply from File
  $tweet = randomTweet('list_tweet.txt');

  // Reply to Tweet
  $connection->post('statuses/update', ['status' => $tweet]);

  // Tweet with Media
  // $tweet = randomTweet('list_tweet.txt');
  // $media = $connection->upload('media/upload', ['media' => 'zetbot.jpg']);
  // $data = [
  //   'status' => $tweet,
  //   'media_ids' => $media->media_id_string
  // ];
  // $connection->post('statuses/update', $data);

  if ($connection->getLastHttpCode() == 200) {
    echo 'Successfully tweet | ' . $tweet;
  } else {
    echo 'Failed to create tweet!';
  }
} else {
  echo 'Invalid API key!';
}
