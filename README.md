# UberspaceMM
The Uberspace Mail Manager Class is written in PHP and provides some essential functions to administrate the mail server with VMailMgr.

*Please note*: The class is still in development and as soon as it is finished, more information will be added to this repo.

## Function Overview
* `UberspaceMM::getUsernames($onlyUsernames = false)` - Lists all usernames including forwarding destinations (if `$onlyUsernames = true` it only returns an array of usernames)
* `UberspaceMM::addNewUser($strMailbox, $strPassword)` - Adds new mailbox with the given credentials
* `UberspaceMM::deleteUser($strMailboxes)` - Deletes the mailbox(es) with the given name(s)
* `UberspaceMM::setNewPassword($strMailbox, $strPassword)` - Sets the given password for the given mailbox
* `UberspaceMM::addNewAlias($strMailbox, $strDestinations)` - Adds new alias account which redirects mails - which were sent to the given mailbox - to the given destinations(s)
* `UberspaceMM::changeForwards($strMailbox, $strDestinations)` - Replaces the forwarding destinations of the given mailbox with the given destination(s)

## Examples
Currently there are two examples; a small example of the `UberspaceMM::getUsernames()` function and a bigger example of all currently supported functions compressed into a control panel. Just have a look at the folder **examples**.

## Prerequisites
Please be sure you ran `vsetup` in the shell or already setup virtual mailboxes in the dashboard of your account.

## Installation
Since Uberspace offers **git** on their machines, you can simply clone this repo by using the command `git clone https://github.com/LucaKling/UberspaceMM`. There is no further configuration needed. Just have a look at the folder **examples**. If you want to use the examples, clone it into a folder which is reachable trough the web and if you want to use the class in your own script, just include the file **UberspaceMM.class.php** in the root folder.
