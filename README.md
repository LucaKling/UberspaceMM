# UberspaceMM
The Uberspace Mail Manager Class provides some essential functions to administrate the mail server the german Webhoster [Uberspace](https://uberspace.de) is using.

*Please note*: The class is still in development and as soon as it is finished, more information will be added to this repo.

## Function Overview
* **UberspaceMM::getUsernames($onlyUsernames = false)** - Lists all usernames including forwarding destinations (if *$onlyUsernames = true* it only returns an array of usernames)
* **UberspaceMM::addNewUser($strMailbox, $strPassword)** - Adds new mailbox with the given credentials
* **UberspaceMM::deleteUser($strMailboxes)** - Deletes the mailbox(es) with the given name(s)
* **UberspaceMM::setNewPassword($strMailbox, $strPassword)** - Sets the given password for the given mailbox
* **UberspaceMM::addNewAlias($strMailbox, $strDestinations)** - Adds new alias account which redirects mails - which were sent to the given mailbox - to the given destinations(s)
* **UberspaceMM::changeForwards($strMailbox, $strDestinations)** - Replaces the forwarding destinations of the given mailbox with the given destination(s)
