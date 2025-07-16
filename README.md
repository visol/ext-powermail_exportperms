Powermail Export Permissions
============================

By default, an editor who has read access to a page in TYPO3, access to Powermail mails and answers and permissions to
use the Powermail module can read and export the submitted form data. If you're working with a page where every editor
can see every page but only edit those he has permissions for, this might not be desirable.

This simple extension hooks into the Powermail and the List module and check for write access to the page. If there is
no write access, the mails cannot be exported.

## Compatibility and Maintenance

This package is currently maintained for the following versions:

| TYPO3 Version | Package Version | Branch | Maintained |
|---------------|-----------------|--------|------------|
| TYPO3 13.4.x  | 4.x             | master | Yes        |
| TYPO3 11.5.x  | 3.x             | v11    | No         |
| TYPO3 8.7.x   | 2.x             | -      | No         |
| TYPO3 6.2.x   | 1.x             | -      | No         |

Installation
------------

Get it from composer:

    composer require visol/powermail-exportperms

Usage
-----

The list view doesn't display records from the tables tx_powermail_domain_model_mails and tx_powermail_domain_model answers
if the user doesn't have at least content editing permissions on a page. This is done by using a hook in the TYPO3 core.

The template `typo3/vendor/in2code/powermail/Resources/Private/Templates/Module/List.html` will be overridden by
[powermail_exportperms/Resources/Private/TemplateOverrides/Templates/Module/List.html](./Resources/Private/TemplateOverrides/Templates/Module/List.html)

by `$GLOBALS['TYPO3_CONF_VARS']['BE']['defaultPageTSconfig'] .= chr(10) . 'templates.in2code/powermail.1752658658 = visol/powermail-exportperms:Resources/Private/TemplateOverrides';` defined in [ext_localconf.php](./ext_localconf.php)


Security considerations
-----------------------

Be aware that this extension merely hides records from the user. It does not prevent fetching the records with other views
providing database listing or by manipulating URL parameters from the edit/show record functionalities in the TYPO3 backend.

Do not use the extension if you are obliged to make the records completely inaccessible for a user.

Requirements
------------

* TYPO3 13 LTS+
* Tested with Powermail 13
