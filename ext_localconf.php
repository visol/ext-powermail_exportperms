<?php
use Visol\PowermailExportperms\Hooks\RecordListGetTableHook;
if (!defined('TYPO3')) {
    die ('Access denied.');
}

// Implement the getTable hook in the RecordList to manipulate the result of the query if the user doesn't have permission
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/class.db_list_extra.inc']['getTable']['powermail_exportperms'] = RecordListGetTableHook::class;
