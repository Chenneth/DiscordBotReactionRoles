# DiscordBotReactionRoles

A Discord bot in [DiscordPHP](https://github.com/discord-php/DiscordPHP) that adds roles based off of a reaction on certain messages.

# How to use

There are 2 vars that need to be filled out:

1. `$token` - your bot's token (you can find it on the [Discord Applications page](https://discord.com/developers/applications/) and go to the 'Bot' tab)
2. `$roleReactMessageID` - an array that needs the following:
  * Key - *MessageID* - the ID of the message the bot needs to check.
  * Value - an array consisting of:
    * Key - *EmojiID* - the ID of the emoji
    * Value - *RoleID* - the ID of the corresponding role to be added/removed
  * Item format: ``'MessageID'=>['EmojiID'=>'RoleID']``
  * Example of item: ``'1234567890'=>['987654321'=>'001122334455']``

# Required intents

This bot needs the *Server Members Intent* and the *Message Content Intent* to function.

The reason it requires the *Server Members Intent* is because the event ``MESSAGE_REACTION_REMOVE`` does not give back a Member object (``MESSAGE_REACTION_ADD`` does however). Might be because server moderators can remove reactions?
