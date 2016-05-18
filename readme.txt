README FOR simple php chat

Short chat i made as a little test.
It uses html css php javascript jquery and ajax
It would be much more effective to use databases to make chats but i wanted to test without it. 

Installation
Put chat folder to root of your hosted folder and files folder one level down from that, for example.
/var/www/html/chat
and
/var/www/files

there are input cheks to prevent people breaking the chat, however there is no input limit or cooldowns so depending on server it can be easily spammed down.
Passwords are encrypted whit sha256 with some salt.
anyone can create new users and login with them, Both usernames and passwords are input checked so they dont mess things up.

Use
Press new user to make user, test user is included with password test.
In chat enter send message, bin deletes all chatlogs and door logs user out. Shift enter makes linebreak in textfield.

Everything in this program can be used freely for anything. There is no warranty.
