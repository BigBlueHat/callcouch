<?php
/**
   Copyright 2011 BigBlueHat

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
**/

/**
 * This file is for hosting inside Tropo. There are no includes
 * as the Tropo API is included automagically when you host your
 * app with Tropo.
 *
 * This will *not* work if you host it on your own server.
 **/

// TODO: change this to the CouchDB database you want docs pulled from
$couch_url = 'http://callcouch.couchone.com:5984/example/';

if ($currentCall->channel == 'TEXT') {
  if (preg_match('/^send ([0-9].*) (.*)/', $currentCall->initialText, $matches)) {
    // send ###-###-#### documentName
    $doc = str_replace('@', '', $matches[2]);
    $number = $matches[1];
    $j = json_decode($json = file_get_contents($couch_url.$doc));
    if ($j->error != 'not_found') {
      $event=call('+1'.$number, array("network" => "SMS"));
      // TODO: if your JSON does not follow this format, change this line
      $event->value->say($j->name.' - '.$j->email.' - '.$j->url);
    } else {
      say('sorry, nothing for that person');
    }
  } else if (preg_match('/^get (.*)/', $currentCall->initialText, $matches)) {
    // get documentName
    $twitter_name = str_replace('@', '', $matches[1]);
    $j = json_decode(file_get_contents($couch_url.$twitter_name));
    if ($j->error != 'not_found') {
      // TODO: if your JSON does not follow this format, change this line
      say($j->name.' - '.$j->email.' - '.$j->url);
    } else {
      say('sorry, nothing for that person');
    }
  } else {
    // if there was no verb, assume "get"
    $twitter_name = str_replace('@', '', $currentCall->initialText);
    $j = json_decode(file_get_contents($couch_url.$twitter_name));
    if ($j->error != 'not_found') {
      // TODO: if your JSON does not follow this format, change this line
      say($j->name.' - '.$j->email.' - '.$j->url);
    } else {
      say('sorry, nothing for that person');
    }
  }
} else {
  say('sorry, voice is not yet supported');
}

