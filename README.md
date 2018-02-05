Powermail Export Permissions
============================

By default, an editor who has read access to a page in TYPO3, access to Powermail mails and answers and permissions to
 use the Powermail module can read and export the submitted form data. If you're working with a page where every editor
 can see every page but only edit those he has permissions for, this might not be desirable.

This simple extension hooks into the Powermail and the List module and check for write access to the page. If there is
 no write access, the mails cannot be exported.

Installation
------------

Get it from composer:

    composer require visol/powermail-exportperms

Usage
-----

The list view doesn't display records from the tables tx_powermail_domain_model_mails and tx_powermail_domain_model answers
if the user doesn't have at least content editing permissions on a page. This is done by using a hook in the TYPO3 core.

To use this functionality in the Powermail backend module, copy the backend templates to your template extension (or anywhere you want)
and configure the module to use them:

	module.tx_powermail {
		view {
			templateRootPath = path/to/Templates
			partialRootPath = path/to/Partials
			layoutRootPath = path/to/Layouts
		}
	}

Then, import the namespace of the extension's ViewHelper:

    {namespace pmep=Visol\PowermailExportperms\ViewHelpers}

And wrap whatever you want to show and hide depending on the editing rights with an if condition using the UserHasWritePermissionForPage ViewHelper:

	<f:if condition="{pmep:userHasWritePermissionForPage()}">
		<f:then>
			[Show stuff]
		</f:then>
		<f:else>
			Access denied.
		</f:else>
	</f:if>


Security considerations
-----------------------

Be aware that this extension merely hides records from the user. It does not prevent fetching the records with other views
  providing database listing or by manipulating URL parameters from the edit/show record functionalities in the TYPO3 backend.

Do not use the extension if you are obliged to make the records completely inaccessible for a user.

Requirements
------------

* TYPO3 8.7 LTS+
* Tested with Powermail 5.3
