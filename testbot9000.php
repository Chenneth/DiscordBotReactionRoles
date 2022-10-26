<?php

use Discord\Discord;
use Discord\Parts\WebSockets\MessageReaction;
use Discord\WebSockets\Event;
use Discord\WebSockets\Intents;

require __DIR__.'/vendor/autoload.php';

//vars to fill out
$token = '';
$roleEmoji = [
  /*'EmojiID'=>'RoleID'*/
];

$roleReactMessageID = [
    /*'MessageID'=>['EmojiID'=>'RoleID']*/
];

$loop = \React\EventLoop\Factory::create();

$discord = new Discord([
        'token' => $token,
        'loop' => $loop,
        'intents'=> Intents::getDefaultIntents() | Intents::GUILD_MEMBERS, //requires guild members intent to remove roles from remove react message even
        'loadAllMembers'=>true //requires loadAllMembers in order to remove roles from a member
        ]
);


$discord->on(Event::MESSAGE_REACTION_ADD,function(MessageReaction $reaction, Discord $discord) use ($roleReactMessageID) {
    if(!array_key_exists($reaction->message_id,$roleReactMessageID)) return;
    if(array_key_exists($reaction->emoji->id,$roleReactMessageID[$reaction->message_id]))
    {
        $reaction->member->addRole($roleReactMessageID[$reaction->message_id][$reaction->emoji->id], 'Reacted to message.');
    }
});
$discord->on(Event::MESSAGE_REACTION_REMOVE,function(MessageReaction $reaction, Discord $discord) use ($roleReactMessageID) {
    if(!array_key_exists($reaction->message_id,$roleReactMessageID)) return;
    if(array_key_exists($reaction->emoji->id,$roleReactMessageID[$reaction->message_id]))
    {
        $reaction->member->removeRole($roleReactMessageID[$reaction->message_id][$reaction->emoji->id], 'Reacted to message.');
    }
});


$discord->run();