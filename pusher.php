<?php
/**
 * 
 * Include Pusher in your form input
 */
require __DIR__ . '/vendor/autoload.php';
/**
 * @var 
 * $pusher Pusher instance
 */
$options = array(
  'cluster' => 'ap1',
  'useTLS' => true
);


$app_id = '1837546';
$app_secret = '6ae7db84a049ecefb695';
$app_key = 'e760aea9751a1d7d3e85';
$pusher = new Pusher\Pusher(
  $app_key,
  $app_secret,
  $app_id,
  $options
);
/**
 * Data pushed to channel
 */
$data['message'] = 'hello world';
$pusher->trigger('my-channel', 'my-event', $data);
?>