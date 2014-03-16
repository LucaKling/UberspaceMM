# UberspaceMM
The Uberspace Mail Manager Class is written in PHP and provides some essential functions to administrate the mail server with VMailMgr.

Thanks to [Fabian Laule](http://www.fabianlaule.de/) aka [@fabil](https://github.com/fabil) for his `setNewPassword`-function which I kind of "stole" from his [UberspaceMPC](https://github.com/fabil/uberspacempc)-Repo. :)

## Function Overview
* `UberspaceMM::setupVirtualMailboxes()` - Sets up virtual mailboxes
* `UberspaceMM::getUsernames($onlyUsernames = false)` - Lists all usernames including forwarding destinations (if `$onlyUsernames = true` it only returns an array of usernames)
* `UberspaceMM::addNewUser($strMailbox, $strPassword)` - Adds new mailbox with the given credentials
* `UberspaceMM::deleteUser($strMailboxes)` - Deletes the mailbox(es) with the given name(s)
* `UberspaceMM::setNewPassword($strMailbox, $strPassword)` - Sets the given password for the given mailbox
* `UberspaceMM::addNewAlias($strMailbox, $strDestinations)` - Adds new alias account which redirects mails - which were sent to the given mailbox - to the given destinations(s)
* `UberspaceMM::changeForwards($strMailbox, $strDestinations)` - Replaces the forwarding destinations of the given mailbox with the given destination(s)

## Examples
Currently there are two examples; a small example of the `UberspaceMM::getUsernames()` function and a bigger example of all currently supported functions compressed into a control panel. Just have a look at the folder **examples**.

## Prerequisites
None, `vsetup` can be run trough `UberspaceMM::setupVirtualMailboxes()` if not already done trough the Uberspace Dashboard or the shell.

## Installation
Since Uberspace offers **git** on their machines, you can simply clone this repo by using the command `git clone https://github.com/LucaKling/UberspaceMM`. There is no further configuration needed. Just have a look at the folder **examples**. If you want to use the examples, clone it into a folder which is reachable trough the web and if you want to use the class in your own script, just include the file **UberspaceMM.class.php** in the root folder.
